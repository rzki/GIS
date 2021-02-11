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
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query(" SELECT * FROM perumahan_master WHERE id_user = '$id_user' LIMIT $awalData, $jumlahDataPerHalaman ");
?>

<!doctype html>
<html lang="en">
<!-- head -->
        <?php include_once('../components/head.php') ?>
        <title>Data Perumahan</title>
<body>
<!-- header -->
    <?php include_once('../components/header.php') ?>

<!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content -->
    <?php $head = 'Data Perumahan' ?>
    <?php include_once('../components/homepage.php') ?>

        <div class="row">
                <div class="table-responsive">
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
                        <tr class="show text-center" id="<?= $row["id_perum"]; ?>">
                            <td data-target="id_perum"><?= $i; ?></td>
                            <td data-target="nama_perum"><?= $row["nama_perum"]; ?></td>
                            <td data-target="alamat"><?= $row["alamat"]; ?></td>
                            <td data-target="status"><?php if($row["status"] == '1') {?>
                            <p>Diterima</p>
                            <?php } else {?>
                            <p>Pending</p>
                            <?php }?></td>
                            <td>
                                <a href="detail.php?id=<?= $row['id_perum']?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i></a>
                                <a href="edit-data.php?id=<?= $row["id_perum"]; ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Perumahan"><i class="fas fa-edit"></i></a>
                                <a href="delete_perum.php?id=<?= $row["id_perum"]; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Perumahan" onclick="return confirm('Yakin ingin hapus data perumahan?')">
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/home.js"></script></body>
</html>
