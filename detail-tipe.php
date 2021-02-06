<?php
require "functions.php";

$idTipe = $_GET["id"];
$tipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("components/detail-head.php")?>
</head>
<body>
    <?php include_once("components/navbar.php")?>


<div class="container" style="font-size:32pt; font-weight:bold; align-content:center; vertical-align: middle;">
    <button class="btn btn-lg border-dark" style="margin-top: 10%;" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
    <center><h1>Detail Tipe Rumah</h1></center>
</div>

<!-- Main Content -->
<div class="container-fluid" style="margin-top:2%">
    <div class="row">
            <div class="card-deck mx-auto" style="width: 90%;">
                <div class="card">
                    <div class="card-header text-center">
                        <h5><?= $tipe["tipe_rumah"] ?></h5>
                    </div>
                    <div class="card-body">
                        <p style="font-weight: bold; text-align:center"> Luas Bangunan</p> <center><?= $tipe["luas_bangunan"] ?></center>
                        <br>
                        <p style="font-weight: bold; text-align:center"> Luas Tanah</p> <center><?= $tipe["luas_tanah"] ?></center>
                        <br>
                        <p style="font-weight: bold; text-align:center"> Spesifikasi</p> <center><?= $tipe["spesifikasi"] ?></center>
                        <br>
                        <p style="font-weight: bold; text-align:center"> Daya Listrik</p> <center><?= $tipe["daya_listrik"] ?></center>
                    </div>
                </div>
                <div class="card" style="width: 400px;">
                    <div class="card-header text-center">
                        <h5>Gambar Tipe Rumah</h5>
                    </div>
                    <div class="card-body">
                        <center><img src="img-perum/<?= $tipe["gambar"] ?>" alt="" width="300" height="300"></center>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>