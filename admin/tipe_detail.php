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

$idTipe = $_GET["id"];

$tipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
    <title>Detail Tipe <?= $tipe["tipe_rumah"]; ?></title>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Tipe Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

    
    <div class="container-fluid">
        <div class="row">
        <div class="card-deck mx-auto">
                <div class="card h-100">
                    <h2 class="card-header text-white bg-dark" style="text-align: center;">
                        Tipe <?= $tipe["tipe_rumah"]; ?>
                    </h2>
                    <div class="card-body">
                        <p class="card-title" style="word-wrap: break-word;"><b>Tipe Rumah :</b></p>
                        <p><?= $tipe["tipe_rumah"];?></p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Luas Bangunan (m2):</b></p>
                        <p><?= $tipe["luas_bangunan"];?> m2</p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Luas Tanah (m2): </b></p>
                        <p><?= $tipe["luas_tanah"];?>  m2</p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Spesifikasi :</b></p>
                        <p><?= $tipe["spesifikasi"];?></p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Daya Listrik :</b></p>
                        <p><?= $tipe["daya_listrik"];?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-white bg-dark" style="text-align: center;">
                        <h2>Gambar Perumahan</h2>
                    </div>
                    <div class="card-body">
                        <center><img class="d-block" src="../img-tiperumah/<?= $tipe["gambar"]; ?>" alt="" width="100%" height="100%"></center>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>