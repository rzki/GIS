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

$areas = getAreaList();
$id_user = $_SESSION ["userID"];
$namaUser = $usr["nama"];

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query(" SELECT * FROM perumahan_master WHERE perumahan_master.status = '1' LIMIT $awalData, $jumlahDataPerHalaman ");
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
    <?php include_once('../components/sidebar-admin.php') ?>
    
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
        </div>
<?php } ?>
    </div>
</div>
<br>
<br>
<!-- Daftar Perumahan yang sudah di approve -->
<h1 class="head">Daftar Perumahan</h1>
<hr style="margin-top: -3px;">

    <div class="row">
        <div class="table-responsive mx-auto d-block">
            <table class="table table-sm table-hover table-striped table-bordered">
                <tr class="text-center">
                    <th>No.</th>
                    <th>Nama Perumahan</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($perum as $row) : ?>
                <tr class="show" id="<?= $row["id_perum"]; ?>">
                    <td class="text-center"><?= $i; ?></td>
                    <td class="text-center" data-target="nama_perum"><?= $row["nama_perum"]; ?></td>
                    <td class="text-center" data-target="alamat" ><?= $row["alamat"]; ?></td>
                    <td class="text-center" data-target="status"><?php if($row["status"] == '1') {?>
                    <p>Diterima</p>
                    <?php } else {?>
                    <p>Pending</p>
                    <?php }?></td>
                    <td class="text-center" >
                        <a href="detail.php?id=<?= $row['id_perum']?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i></a>
                        <a href="editdataperum.php?id=<?= $row['id_perum'] ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data Perumahan"><i class="fas fa-edit"></i></a>
                        <a href="delete_perum.php?id=<?= $row['id_perum'] ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Perumahan" onclick="return confirm('Yakin ingin hapus data perumahan?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </table>
                <a class="btn btn-block btn-primary" href="tambah-data.php">
                    <span data-feather='plus'></span>
                        Tambah Data Perumahan
                    </a>
                </div>
            </div>

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
</html>
