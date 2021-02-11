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
$bgPerum = $perum["gambar_perum"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("components/detail-head.php")?>
    <title>Detail Perumahan</title>
</head>
<body>
    <?php include_once("components/navbar-detail.php")?>

<!-- Header -->
<div class="container" style=" font-size:32pt; font-weight:bold; align-content:center;">
    <center><h1>Detail Perumahan</h1></center>
</div>
<br>
<br>

<!-- Main Content -->
<div class="container-fluid" >
    <div class="row">
        <div class="card text-center mx-auto border-dark" style="width: 80%; ">
            <h2><?= $perum["nama_perum"]; ?></h2>
        </div>
    </div>
</div>
<br>

<div id="peta" class="mx-auto"></div>

<div class="container-fluid" style="margin-top:2%">
    <div class="row">
            <div class="card mx-auto" style="width: 90%;">
                <div class="card-header text-center text-white bg-dark">
                    <h5>Detail Perumahan <?= $perum["nama_perum"] ?></h5>
                </div>
                <div class="card-body">
                    <p style="font-weight: bold; text-align:center"> Alamat :</p>
                    <p class="text-center"><?= $perum["alamat"] ?></p>
                    <br>
                    <br>
                    <p style="font-weight: bold; text-align:center"> Koordinat :</p>
                    <p class="text-center"><?= $perum["koordinat"] ?></p>
                </div>
            </div>
        </div>
</div>
<br>
<br>
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
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($tabelTipe as $row) : ?>
            <tr class="show bg-light" id="<?= $row["id_tipe"]; ?>">
                <td class="text-center" style="width: 75px;"><?= $i; ?></td>
                <td class="text-center" data-target="tipe_rumah" style="width: 150px;"><?= $row["tipe_rumah"]; ?></td>
                <td class="text-center" data-target="luas_bangunan" style="width: 200px;"><?= $row["luas_bangunan"]; ?> m2</td>
                <td class="text-center" data-target="luas_tanah" style="width: 150px;"><?= $row["luas_tanah"]; ?> m2</td>
                <td class="text-center" data-target="spesifikasi" style="width: 500px;"><?= $row["spesifikasi"]?></td>
                <td class="text-center" data-target="daya_listrik" style="width: 150px;"><?= $row["daya_listrik"]?></td>
                <td class="text-center" style="text-align: center;">
                    <a href="detail-tipe.php?id=<?= $row['id_tipe']?>" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Tipe Perumahan"><i class="fas fa-info"></i> Lihat Detail</a>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>
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
</body>
</html>