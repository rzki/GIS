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
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Tipe Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

    
    <div class="container-fluid">
        <div class="row">
        <div class="card-deck mx-auto" style="width:100%">
                <div class="card" style="height: 100%;">
                    <h2 class="card-header text-white bg-dark" style="text-align: center;">
                        <?= $tipe["tipe_rumah"]; ?>
                    </h2>
                    <div class="card-body">
                        <p class="card-title" style="word-wrap: break-word;"><b>Tipe Rumah :</b> &nbsp; <?= $tipe["tipe_rumah"];?></p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Luas Bangunan :</b>  &nbsp; <?= $tipe["luas_bangunan"];?></p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Luas Tanah :</b>  &nbsp; <?= $tipe["luas_tanah"];?></p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Spesifikasi :</b>  &nbsp; <?= $tipe["spesifikasi"];?></p>
                        <p class="card-title" style="word-wrap: break-word;"><b>Daya Listrik :</b>  &nbsp; <?= $tipe["daya_listrik"];?></p>
                    </div>
                </div>
                <div class="card">
                    <h2 class="card-header text-white bg-dark" style="text-align: center;">
                        Gambar Perumahan
                    </h2>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="imgPerum d-block w-100" src="../img-perum/<?= $tipe["gambar"]; ?>" alt="">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Tipe Rumah : <?= $tipe["tipe_rumah"];?></h5>
                                    </div>
                            </div>
                            <div class="carousel-item">
                                <img class="imgPerum d-block w-100" src="../img-perum/<?= $tipe["gambar"]; ?>" alt="">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Tipe Rumah : <?= $tipe["tipe_rumah"];?></h5>
                                    </div>
                            </div>
                            <div class="carousel-item">
                                <img class="imgPerum d-block w-100" src="../img-perum/<?= $tipe["gambar"]; ?>" alt="">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Tipe Rumah : <?= $tipe["tipe_rumah"];?></h5>
                                    </div>
                            </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
</body>
</html>