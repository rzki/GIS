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

$idPerum = $_GET["id"];

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM tiperumah_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master WHERE id_perum = $idPerum")[0];
$tipe = query("SELECT * FROM tiperumah_master WHERE id_perum = $idPerum")[0];
$tabelTipe = mysqli_query($conn, "SELECT * FROM tiperumah_master WHERE id_perum = $idPerum");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container-fluid">
        <div class="row">
            <div class="card" style="width:100%;">
                    <h2 class="card-header" style="text-align: center;">
                        <?= $perum["nama_perum"]; ?>
                    </h2>
                <div class="card-body">
                    <p class="card-title" style="word-wrap: break-word; font-size:large"><b>Nama Perumahan :</b> <br> <?= $perum["nama_perum"];?></p>
                    <p class="card-title" style="word-wrap: break-word; font-size:large"><b>Alamat :</b> <br> <?= $perum["alamat"];?></p>
                    <p class="card-title" style="word-wrap: break-word; font-size:large"><b>Koordinat :</b>  <br> <?= $perum["koordinat"];?></p>
                </div>
            </div>
        </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Tipe Rumah</th>
                        <th>Luas Bangunan</th>
                        <th>Luas Tanah</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($tabelTipe as $rows) : ?>
                    <tr class="show text-center" id="<?= $rows["id_tipe"]; ?>">
                        <td><?= $i++; ?></td>
                        <td class="text-center" data-target="tipe_rumah"><?= $rows["tipe_rumah"]; ?></td>
                        <td class="text-center" data-target="luas_bangunan" ><?= $rows["luas_bangunan"]; ?></td>
                        <td class="text-center" data-target="luas_tanah"><?= $rows["luas_tanah"]; ?></td>
                        <td class="text-center" >
                        <a href="tipe_detail.php?id=<?= $rows['id_tipe']; ?>"class="btn btn-outline-dark btn-sm" title="Detail Tipe Rumah"><i class="fas fa-info"></i></a>
                        <a href="edit_tiperumah.php?id=<?= $rows['id_tipe']; ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Tipe Rumah"><i class="fas fa-edit"></i></a>
                        <a href="delete_tiperumah.php?id=<?= $rows['id_tipe']; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Tipe Rumah" onclick="return confirm('Yakin ingin hapus tipe perumahan?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    </table>
                    <a class="btn btn-block btn-dark" href="tambah-tipe.php?id_perum=<?= $idPerum ?>">
                    <span data-feather='plus'></span>
                        Tambah Tipe Perumahan
                    </a>
                    <br>
            </div>
    </div>
</div>
</body>
</html>