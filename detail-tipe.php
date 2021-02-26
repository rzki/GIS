<?php
require "functions.php";

$idTipe = $_GET["id"];
$tipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];
$carousel = mysqli_query($conn, "SELECT * FROM tipe_gambar WHERE id_tipe = $idTipe");
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
        border: 2px solid black;
        border-radius: 24px;
        width: 50%;
    }
    .btn-back{
        margin-top: 8%;
        margin-left: 10%;
    }
    .detailtipe-box{
        margin: auto;
        margin-top: 20px;
        border: 3px solid black;
        width: 75%;
        border-radius: 24px;
    }
    hr{
        border: 1px solid black;
        background-color: black;
    }
    .lbangunan,.ltanah,.spesifikasi,.listrik,.harga{
        font-weight: bold;
        text-align: center;
    }
    .lbangunan,.spesifikasi{
        margin: 20px 0 0 0;
    }
    .listrik{
        margin: 60px 0 0 0 ;
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
    .lbangunan-text,.ltanah-text,.spesifikasi-text,.listrik-text,.harga-text{
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
    <button class="btn-back btn btn-lg border-dark" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
<div class="detailtipe container">
    <center><h1>Detail Tipe <?= $tipe["tipe_rumah"];?></h1></center>
</div>
<br>
<br>
<!-- Main Content -->
<!-- Gambar Tipe Rumah -->
<div class="gbr-text container-fluid">
    <center><h1>Gambar Tipe Rumah</h1></center>
</div>
<hr class="w-75">
<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-7">
                <!— Banner SlideShow nya —>
                <div id="dmbannerhead" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <ol class="carousel-indicators">
                        <?php

                        $count = mysqli_query($conn, "SELECT * FROM tipe_gambar WHERE id_tipe = $idTipe");
                        $res = mysqli_num_rows($count);
                        for($i=0; $i<$res;$i++){
                            echo '<li data-target="#dmbannerhead" data-slide-to="'.$i.'"'; if($i==0){ echo 'class="active"'; } echo '></li>';
                        }
                        ?>
                    </ol>
                <?php
                    if($result = $carousel) {
                    $y = 0;
                    while ($rows = mysqli_fetch_assoc($result)) {
                if($y==0) $aktif = "active";
                    else $aktif = '';
                    ?>
                    <div class="carousel-item <?php echo $aktif ?>  text-center">
                    <img src="img-tiperumah/<?php echo $rows['gambar_tipe'] ?>" alt="" title="<?php echo $rows['gambar_tipe'] ?>" width="600" height="400">
                </div>
            <?php 
                $y++;
                } // tutup while
            }	// tutup if
            ?>
                </div>
                    <a class="carousel-control-prev" href="#dmbannerhead" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#dmbannerhead" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            <!— /Banner Slideshow nya —>
            </div>
        </div>
    </div>
    <br>
    <br>
<!-- Detail Tipe -->
<div class="detail container">
    <center><h1>Detail Tipe Rumah</h1></center>
</div>
<div class="detailtipe-box container-fluid">
        <div class="row w-75 mx-auto">
            <div class="luas col">
                <p class="lbangunan card-title">Luas Bangunan (m2)</p> 
                <p class="lbangunan-text card-title"><?= $tipe["luas_bangunan"] ?> m2</p>
                <p class="ltanah card-title">Luas Tanah (m2)</p>
                <p class="ltanah-text card-title"><?= $tipe["luas_tanah"] ?> m2</p>
                <p class="spesifikasi card-title">Spesifikasi</p>
                <p class="spesifikasi-text card-title"><?= $tipe["spesifikasi"] ?></p>
            </div>
            <div class="speklistrik col">
                <p class="listrik card-title">Daya Listrik</p> 
                <p class="listrik-text card-title"><?= $tipe["daya_listrik"] ?></p>
                <p class="harga card-title">Harga</p>
                <p class="harga-text card-title"><?= rupiah($tipe["harga"])?></p>
            </div>

        </div>
</div>
<br>

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
        window.location.href="detail-perum.php?id=<?= $tipe["id_perum"]; ?>";
    }
</script>
</body>
</html>