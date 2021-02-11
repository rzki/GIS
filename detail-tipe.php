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
</head>
<body>
    <?php include_once("components/navbar-tipe.php")?>

<div class="container" style="font-size:32pt; font-weight:bold; align-content:center; vertical-align: middle;">
    <button class="btn btn-lg border-dark" style="margin-top: 10%;" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
    <center><h1>Detail Tipe Rumah</h1></center>
</div>

<!-- Main Content -->
<div class="container-fluid" style="margin-top:2%">
    <div class="row">
            <div class="card-deck mx-auto" style="width: 90%;">
                <div class="card">
                    <div class="card-header text-white bg-dark text-center">
                        <h2><?= $tipe["tipe_rumah"] ?></h2>
                    </div>
                    <div class="card-body">
                        <p style="font-weight: bold; text-align:center"> Luas Bangunan (m2)</p> 
                        <center><p><?= $tipe["luas_bangunan"] ?> m2</p></center>
                        <p style="font-weight: bold; text-align:center"> Luas Tanah (m2)</p>
                        <center><p><?= $tipe["luas_tanah"] ?> m2</p></center>
                        <p style="font-weight: bold; text-align:center"> Spesifikasi</p>
                        <center><p><?= $tipe["spesifikasi"] ?></p></center>
                        <p style="font-weight: bold; text-align:center"> Daya Listrik</p> 
                        <center><p><?= $tipe["daya_listrik"] ?></p></center>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-white bg-dark" style="text-align: center;">
                        <h2>Gambar Perumahan</h2>
                    </div>
                    <div class="card-body">
                        <center><img class="d-block" src="img-tiperumah/<?= $tipe["gambar"]; ?>" alt="" width="100%" height="100%"></center>
                    </div>
                </div>
            </div>
        </div>
</div>
<br>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Rizky Dhani 2020</p>
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