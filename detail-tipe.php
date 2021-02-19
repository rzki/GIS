<?php
require "functions.php";

$idTipe = $_GET["id"];
$tipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("components/detail-head.php")?>
    <title>Detail Tipe <?= $tipe["tipe_rumah"]; ?></title>
    <style>
    .detailtipe{
        font-size: 32pt;
        font-weight: bold;
        align-content: center;
        vertical-align: middle;
    }
    .btn-back{
        margin-top: 10%;
    }
    .detailtipe-box{
        margin: auto;
        margin-top: 20px;
        border: 3px solid black;
        width: 75%;
        border-radius: 24px;
    }
    .lbangunan,.ltanah,.spesifikasi,.listrik{
        font-weight: bold;
        text-align: center;
    }
    .lbangunan,.spesifikasi{
        margin: 20px 0 0 0;
    }
    .lbangunan-text,.spesifikasi-text{
        margin: 0 0 20px 0;
    }
    .ltanah,.listrik{
        margin-bottom: 0;
    }
    .ltanah-text,.listrik-text{
        margin: 0 0 20px 0;
    }
    .lbangunan-text,.ltanah-text,.spesifikasi-text,.listrik-text{
        text-align: center;
    }
    .luas{
        margin: 0 50px 0 -75px;
    }
    .speklistrik{
        margin: 0 -75px 0 50px;
    }
    .gbr-text{
        margin:auto;
        text-align: center;
    }
    .gbrtipe{
        margin: 20px 0 0 0;
        align-content: center;
    }
    .gbr-box{
        margin: 0 0 0 350px;
    }
    .Tipe-box{
        margin: 0 0 50px 0;
    }
    </style>
</head>
<body>
    <?php include_once("components/navbar-tipe.php")?>

    <!-- Detail Tipe Rumah Header -->
<div class="detailtipe container">
    <button class="btn-back btn btn-lg border-dark" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
    <center><h1>Detail Tipe Rumah</h1></center>
</div>

<!-- Main Content -->
<div class="detailtipe-box container-fluid">
        <div class="row w-75 mx-auto">
            <div class="luas col">
                <p class="lbangunan card-title">Luas Bangunan (m2)</p> 
                <p class="lbangunan-text card-title"><?= $tipe["luas_bangunan"] ?> m2</p>
                <p class="ltanah card-title">Luas Tanah (m2)</p>
                <p class="ltanah-text card-title"><?= $tipe["luas_tanah"] ?> m2</p>
            </div>
            <div class="speklistrik col">
                <p class="spesifikasi card-title">Spesifikasi</p>
                <p class="spesifikasi-text card-title"><?= $tipe["spesifikasi"] ?></p>
                <p class="listrik card-title">Daya Listrik</p> 
                <p class="listrik-text card-title"><?= $tipe["daya_listrik"] ?></p>
            </div>
        </div>
</div>
<br>
<br>

<!-- Gambar Tipe Rumah -->
<div class="gbr-text container-fluid">
    <center><h1>Gambar Tipe Rumah</h1></center>
</div>
<div class="Tipe-box container-fluid">
    <div class="row w-75 mx-auto">
        <div class="gbr-box">
            <img class="gbrtipe" src="img-tiperumah/<?= $tipe["gambar"];?>" alt="" width="50%" height="100%">
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; 2020</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom JavaScript for this theme -->
<script src="js/scrolling-nav.js"></script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>