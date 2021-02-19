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

$idTipe = $_GET["id"];
$tipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
    <title>Detail <?= $tipe["tipe_rumah"]; ?></title>
    <style>
    h1{
        text-align: center;
    }
    </style>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Tipe ' . $tipe["tipe_rumah"] ?>
    <?php include_once('../components/main-content.php') ?>

    <h1>Detail Tipe Rumah</h1>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            <p class="card-title" style="word-wrap: break-word;"><b>Tipe Rumah :</b></p>
            <p><?= $tipe["tipe_rumah"];?></p>
            <p class="card-title" style="word-wrap: break-word;"><b>Luas Bangunan (m2):</b></p>
            <p><?= $tipe["luas_bangunan"];?> m2</p>
            <p class="card-title" style="word-wrap: break-word;"><b>Luas Tanah (m2): </b></p>
            <p><?= $tipe["luas_tanah"];?>  m2</p>
            </div>
            <div class="col">
            <p class="card-title" style="word-wrap: break-word;"><b>Spesifikasi :</b></p>
            <p><?= $tipe["spesifikasi"];?></p>
            <p class="card-title" style="word-wrap: break-word;"><b>Daya Listrik :</b></p>
            <p><?= $tipe["daya_listrik"];?></p>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <h1>Gambar Tipe Rumah</h1>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <center><img class="d-block" src="../img-tiperumah/<?= $tipe["gambar"]; ?>" alt="" width="75%" height="100%"></center>
        </div>
    </div>
    <br>
</body>
</html>