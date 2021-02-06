<?php 
session_start();
require "../functions.php";

if (empty($_SESSION['login'])) {
    header('Location: ../auth/login.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            header('Location: ../admin/home.php');
        break;
        case 'user': 
            $usr = $_SESSION['user'];
        break;
    }
}

$areas = getAreaListbyuserID();
$id_user = $_SESSION ["userID"];
$namaUser = $usr["nama"];

//pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query(" SELECT * FROM perumahan_master WHERE id_user = '$id_user' LIMIT $awalData, $jumlahDataPerHalaman ");
$user = mysqli_query($conn, " SELECT * FROM users WHERE id_user = '$id_user'");
?>

<!doctype html>
<html lang="en">
<!-- head -->
    <?php include_once('../components/head.php') ?>
<body>
<!-- header -->
    <?php include_once('../components/header.php') ?>

<!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content -->
    <?php $head = 'Selamat Datang, ' . $_SESSION['name'] . '!' ?>
    <?php include_once('../components/homepage.php') ?>

<!-- Biodata -->
<div class="container-fluid">
    <div class="row">
    <?php while($row = mysqli_fetch_assoc($user)) {?>
        <div class="card w-100 border-dark">
            <div class="card-horizontal" style="display: flex; flex:auto; width:100%;">
                <div class="card-body">
                    <h2 class="text-center"><b> Biodata</b></h2>
                    <hr class="solid" style="border: solid;">
                    <br>
                    <h5 class="card-text"><b>Nama</b>&emsp;&emsp;: <?php echo $row["nama"];?></h5>
                    <h5 class="card-text"><b>Alamat</b>&emsp;&nbsp;: <?php echo $row["alamat"];?></h5>
                    <h5 class="card-text"><b>Email</b>&emsp;&emsp;: <?php echo $row["email"];?></h5>
                    
            </div>
</div>
<?php } ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    </script>
    <?php include_once('../components/close-main-content.php') ?>
</body>
</html>
