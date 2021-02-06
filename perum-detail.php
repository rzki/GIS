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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("components/detail-head.php")?>
</head>
<body>
    <?php include_once("components/navbar.php")?>

<!-- Header -->
<div class="container" style=" font-size:32pt; font-weight:bold; align-content:center;">
    <button class="btn btn-lg border-dark" style="margin-top: 10%;" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
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
                <div class="card-header text-center">
                    <h5>Detail Perumahan <?= $perum["nama_perum"] ?></h5>
                </div>
                <div class="card-body">
                    <p style="font-weight: bold; text-align:center"> Alamat</p> <center><?= $perum["alamat"] ?></center>
                    <br>
                    <br>
                    <p style="font-weight: bold; text-align:center"> Koordinat</p> <center><?= $perum["koordinat"] ?></center>
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
            <tr class="text-center">
                <th>No.</th>
                <th>Tipe Rumah</th>
                <th>Luas Bangunan</th>
                <th>Luas Tanah</th>
                <th>Spesifikasi</th>
                <th>Daya Listrik</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($tabelTipe as $row) : ?>
            <tr class="show" id="<?= $row["id_tipe"]; ?>">
                <td class="text-center" style="width: 75px;"><?= $i; ?></td>
                <td class="text-center" data-target="tipe_rumah" style="width: 150px;"><?= $row["tipe_rumah"]; ?></td>
                <td class="text-center" data-target="luas_bangunan" style="width: 150px;"><?= $row["luas_bangunan"]; ?></td>
                <td class="text-center" data-target="luas_tanah" style="width: 150px;"><?= $row["luas_tanah"]; ?></td>
                <td class="text-center" data-target="spesifikasi" style="width: 500px;"><?= $row["spesifikasi"]?></td>
                <td class="text-center" data-target="daya_listrik" style="width: 150px;"><?= $row["daya_listrik"]?></td>
                <td class="text-center" style="text-align: center;">
                    <a href="detail-tipe.php?id=<?= $row['id_tipe']?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Tipe Perumahan"><i class="fas fa-info"></i> Lihat Detail</a>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
    <script>
        //membuat mapOptions
        var mapOptions = {
            center: [-8.61510 , 115.17349],
            zoom: 18
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