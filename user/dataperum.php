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

//pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM perumahan_master WHERE id_user = $id_user"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query(" SELECT * FROM perumahan_master WHERE id_user = '$id_user' ORDER BY id_perum DESC LIMIT $awalData, $jumlahDataPerHalaman");
?>

<!doctype html>
<html lang="en">
<!-- head -->
    <?php include_once('../components/head.php') ?>
    <title>Data Perumahan</title>
    <style>
        .box-cari{
            margin-bottom: 10px;
            width: 250px;
            text-align: center;
        }
        .pagination{
            color: white;
        }
    </style>
<body>
<!-- header -->
    <?php include_once('../components/header.php') ?>

<!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content -->
    <?php $head = 'Data Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

<div class="container-fluid">
    <div class="row">
        <form action="" method="post" class="search-form ml-auto">
            <input type="text" name="keyword" class="box-cari" placeholder="Masukkan keyword pencarian" id="keyword" autofocus>
        </form>
                <div class="table-responsive" id="tabel">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr class="text-center text-white bg-dark">
                            <th>No.</th>
                            <th>Nama Perumahan</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        <?php $i = 1; ?>
                        <?php foreach ($perum as $row) : ?>
                        <tr class="show text-center" id="<?= $row["id_perum"]; ?>">
                            <td data-target="id_perum" style="width: 50px;"><?= $i; ?></td>
                            <td data-target="nama_perum" style="width: 300px;"><?= $row["nama_perum"]; ?></td>
                            <td data-target="alamat"><?= $row["alamat"]; ?></td>
                            <td data-target="status" style="width: 100px"><?= $row["status"]; ?></td>
                            <td style="width:150px">
                                <a href="detail.php?id=<?= $row['id_perum']?>" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i></a>
                                <a href="edit-data.php?id=<?= $row["id_perum"]; ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Perumahan"><i class="fas fa-edit"></i></a>
                                <a href="delete_perum.php?id=<?= $row["id_perum"]; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Perumahan" onclick="return confirm('Yakin ingin hapus data perumahan?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
        </div>
        <div class="panel-footer">
        <nav class="page">
        <ul class="pagination justify-content-center">

            <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
                <a href="?halaman=<?= $halamanAktif - 1 ?>" class="page-link">Previous</a>
            </li>
            <?php else : ?>
            <li class="page-item">
                <div class="page-link text-dark">Previous</div>
            </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php else : ?>
                <li class="page-item" aria-current="page">
                    <a class="page-link  text-dark" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <li>
                <a href="?halaman=<?= $halamanAktif + 1 ?>" class="page-link" href="#">Next</a>
            </li>
            <?php else : ?>
            <li class="page-item">
                <div class="page-link text-dark">Next</div>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
</div>
<!-- fungsi search menggunakan ajax -->
<script src="js/search-user.js"></script>
<!--  -->
<script>
        function goBack() {
            window.location.href="home.php";
        }
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/home.js"></script>
</body>
</html>
