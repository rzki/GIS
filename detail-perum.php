<?php
require "functions.php";

$idPerum = $_GET["id"];
$areaPerum = getAreaListbyID();

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM tiperumah_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master WHERE id_perum = $idPerum")[0];
$tabelTipe = mysqli_query($conn, "SELECT * FROM tiperumah_master WHERE id_perum = $idPerum");
$carousel = mysqli_query($conn, "SELECT * FROM perum_gambar WHERE id_perum = $idPerum");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("components/detail-head.php")?>
    <title>Detail Perumahan</title>
    <style>
        .detailperum-container{
            font-size: 32pt;
            font-weight: bold;
            align-content: center;
            vertical-align: middle;
            border: 2px solid black;
            border-radius: 24px;
            width: 50%;
        }
        .detailperum-box{
            margin:auto;
            border: 3px solid black;
            width: 75%;
            height:75%;
            border-radius: 24px;
        }
        .perumdetail{
            margin: 0 0 0 -100px;
        }
        .gambarperum{
            margin: 0 -100px 0 0;
        }
        .btn-back{
        margin-top: 8%;
        margin-left: 10%;
        }
        hr{
            border: 1px solid black;
            background-color: black;
        }
        .namaperum,.alamatperum,.notelp{
            word-wrap: break-word;
            font-size: large;
            font-weight: bold;
            text-align: center;
            margin: 20px 0 20px 0;
        }
        .namaperum-text,.alamatperum-text{
            word-wrap: break-word;
            font-size: large;
            text-align: center;
        }
        .wa-div{
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .wa-link{
            color: black;
        }
        .wa-link a:hover a:focus{
            color: blue;
        }
        .wa-text{
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php include_once("components/navbar-detail.php")?>

<!-- Header -->
<button class="btn-back btn btn-lg border-dark" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
<div class="detailperum-container container">
    <center><h1>Detail Perumahan</h1></center>
</div>
<br>
<br>

<!-- Main Content -->

<!-- Peta Area Perumahan -->
<h1 class="text-center">Peta Area Perumahan</h1>
<hr class="w-75">
<div id="peta" class="mx-auto"></div>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="gambarperum col">
            <!-- Gambar Perumahan -->
            <h1 class="text-center">Gambar Perumahan</h1>
            <hr class="w-75">
            <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-8">
                            <!— Banner SlideShow nya —>
                            <div id="dmbannerhead" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <ol class="carousel-indicators">
                                        <?php

                                        $count = mysqli_query($conn, "SELECT * FROM perum_gambar WHERE id_perum = $idPerum");
                                        $res = mysqli_num_rows($count);
                                        for($i=0; $i<$res;$i++){
                                            echo '<li data-target="#dmbannerhead" data-slide-to="'.$i.'"'; if($i==0){ echo 'class="active"'; } echo '></li>';
                                        }
                                        ?>
                                    </ol>
                            <?php
                                if($res = $carousel) {
                                $x = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                if($x==0) $aktif = "active";
                                    else $aktif = '';
                                    ?>
                                    <div class="carousel-item <?php echo $aktif ?>  text-center">
                                    <a href="img-perum/<?php echo $row['gambar_perum'] ?>" target="_blank">
                                    <img src="img-perum/<?php echo $row['gambar_perum'] ?>" alt="" title="<?php echo $row['gambar_perum'] ?>" width="600" height="400">
                                    <a href="img-perum/<?php echo $row['gambar_perum'] ?>" target="_blank">
                                </div>
                            <?php 
                                $x++;
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
        </div>
        <div class="perumdetail col">
            <!-- Detail Perumahan -->
            <h1 class="text-center">Detail Perumahan</h1>
            <hr class="w-75">
                <div class="detailperum-box container-fluid">
                    <div class="row w-100 mx-auto">
                            <div class="col">
                                <p class="namaperum card-title"><b>Nama Perumahan</b></p>
                                <p class="namaperum-text card-title"><?= $perum["nama_perum"];?></p>
                                <p class="alamatperum card-title"><b>Alamat</b></p>
                                <p class="alamatperum-text card-title"><?= $perum["alamat"];?></p>
                                <p class="notelp card-title"><b>Nomor Telepon</b></p>
                                <div class="wa-div">
                                    <p class="wa-text card-title text-center" style="word-wrap: break-word; font-size:large;">
                                    <?= $perum["no_telp"];?> (<a href="tel:<?= $perum["no_telp"];?>">call</a>)
                                    </p>
                            </div>
                            </div>
                        </div>
                </div>
            <br>
        </div>
    </div>
</div>

<!-- Tabel Tipe Rumah -->
<h1 class="text-center">Tipe Rumah</h1>
<hr class="w-75">
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
        <table class="table table-lg table-hover table-striped table-bordered mx-auto" style="width: 90%;">
            <tr class="text-center text-white bg-dark">
                <th>No.</th>
                <th>Tipe Rumah</th>
                <th>Luas Bangunan (m2)</th>
                <th>Luas Tanah (m2)</th>
                <th>Spesifikasi</th>
                <th>Daya Listrik</th>
                <th>Harga Rumah</th>
                <th>Aksi</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($tabelTipe as $row) : ?>
            <tr class="show bg-light" id="<?= $row["id_tipe"]; ?>">
                <td class="text-center" style="width: 75px;"><?= $i; ?></td>
                <td class="text-center" data-target="tipe_rumah" style="width: 150px;"><?= $row["tipe_rumah"]; ?></td>
                <td class="text-center" data-target="luas_bangunan" style="width: 150px;"><?= $row["luas_bangunan"]; ?> m2</td>
                <td class="text-center" data-target="luas_tanah" style="width: 150px;"><?= $row["luas_tanah"]; ?> m2</td>
                <td class="text-center" data-target="spesifikasi" style="width: 500px;"><?= $row["spesifikasi"]?></td>
                <td class="text-center" data-target="daya_listrik" style="width: 100px;"><?= $row["daya_listrik"]?></td>
                <td class="text-center" data-target="harga" style="width: 200px;"><?= rupiah($row["harga"])?></td>
                <td class="text-center" style="text-align: center;width: 150px;">
                    <a href="detail-tipe.php?id=<?= $row['id_tipe']?>" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Tipe Perumahan"><i class="fas fa-info"></i> Lihat Detail</a>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>
<br>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <?php echo date('Y'); ?></p>
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
        //membuat mapOptions
        var mapOptions = {
            center: [-8.61510 , 115.17349],
            zoom: 14
        }
        //membuat layer map
        var mymap = new L.map('peta', mapOptions);
        //membuat titik awal pada peta
        mymap.setView([-8.8081 , 115.1657], 14);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 20,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);
        
        $( document ).ready(function() {
            tambahArea();
        });

        function stringToGeoPoints( geo ) {
            var linesPin = geo.split(",");
            var linesLat = new Array();
            var linesLng = new Array();

            for(i=0; i < linesPin.length; i++) {
                if(i % 2) {
                linesLat.push(linesPin[i]);
                }else{
                linesLng.push(linesPin[i]);
                }
            }

            var latLngLine = new Array();

            for(i=0; i<linesLng.length;i++) {
                latLngLine.push( L.latLng( linesLat[i], linesLng[i]));
            }
            
            return latLngLine;
        }

        function tambahArea() {
            for(var i=0; i < areas.length; i++) {
                var polygon = L.polygon( stringToGeoPoints(areas[i]['koordinat']), { color: 'blue'}).addTo(mymap);
            mymap.fitBounds(polygon.getBounds());  
            }
        }
        var areas = JSON.parse( '<?php echo json_encode($areaPerum) ?>' );
    </script>
<script>
    function goBack() {
        window.location.href="list-perum.php";
    }
</script>
</body>
</html>