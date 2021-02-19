<?php 
session_start();
require "../functions.php";

if (empty($_SESSION['login'])) {
    header('Location: ../auth/login.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            $usr = $_SESSION['user'];
        break;
        case 'user': 
            header('Location: ../user/home.php');
        break;
    }
}

$id_user = $_SESSION ["userID"];

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$userBio = mysqli_query($conn,"SELECT * FROM users WHERE id_user = '$id_user'");
$user = query("SELECT * FROM users WHERE id_user = '$id_user'")[0];
?>

<!doctype html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/head.php') ?>
    <title>Dashboard Admin</title>
    <style>
    .search{
        margin-bottom: 10px;
    }
    .btn-cari{
        margin-left: 10px;
    }
    .btn-cari{
        background: #292b2c;
        border-color:#292b2c;
        color: white;
    }
    .box-cari,.btn-cari{
        margin-bottom: 10px;
    }
    </style>
<body>

    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-admin.php') ?>
    
    <!-- Main Content -->
    <?php $head = 'Selamat Datang, ' . $user["nama"] . '!' ?>
    <?php include_once('../components/homepage.php') ?>
    
<!-- Biodata -->
<div class="container-fluid">
    <div class="row">
    <?php while($row = mysqli_fetch_assoc($userBio)) {?>
        <div class="card w-100 border-dark">
            <div class="card-horizontal" style="display: flex; flex:auto; width:100%;">
                <div class="card-body">
                    <h2 class="text-center"><b> Biodata</b></h2>
                    <hr class="solid" style="border: solid;">
                    <p class="card-text" style="font-size: large;"><b>Nama</b>&emsp;&emsp;:&nbsp; <?php echo $row["nama"];?></p>
                    <p class="card-text" style="font-size: large;"><b>Alamat</b>&emsp;&nbsp;:&nbsp; <?php echo $row["alamat"];?></p>
                    <p class="card-text" style="font-size: large;"><b>Email</b>&emsp;&emsp;:&nbsp; <?php echo $row["email"];?></p>
                    
                </div>
            </div>
        </div>
<?php } ?>
    </div>
</div>
<br>
<br>
    <script>
    // mengaktifkan tooltips
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    });
    </script>
    <!-- close main content-->
<?php include_once('../components/close-main-content.php') ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
