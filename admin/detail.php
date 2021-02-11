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

$idPerum = $_GET["id"];
$areaPerum = getAreaListbyID();

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM tiperumah_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master WHERE id_perum = $idPerum")[0];
$tipe = query("SELECT * FROM tiperumah_master WHERE id_perum = $idPerum")[0];
$tabelTipe = mysqli_query($conn, "SELECT * FROM tiperumah_master WHERE id_perum = $idPerum");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
    <title>Detail Perum <?= $perum["nama_perum"]; ?></title>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

    <div id="peta" style="margin-bottom: 1%; width:100%; height:50%"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="card-deck">
                <div class="card">
                        <h2 class="card-header text-white bg-dark" style="text-align: center;">
                            <?= $perum["nama_perum"]; ?>
                        </h2>
                    <div class="card-body">
                        <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Nama Perumahan :</b></p>
                        <p style="font-size: medium; text-align: center;"><?= $perum["nama_perum"];?></p>
                        <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Alamat :</b></p>
                        <p style="font-size: medium; text-align: center;"><?= $perum["alamat"];?></p>
                        <p class="card-title text-center" style="word-wrap: break-word; font-size:large;"><b>Koordinat :</b></p>
                        <p style="font-size: medium; text-align: center;"><?= $perum["koordinat"];?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-white bg-dark" style="text-align: center;">
                        <h2>Gambar Perumahan</h2>
                    </div>
                    <div class="card-body">
                        <center><img class="d-block justify-content-center" src="../img-perum/<?= $perum["gambar_perum"]; ?>" alt="" width="100%" height="100%"></center>
                    </div>
                </div>
            </div>
        </div>
    <br>
    <h1 class="text-center">Tipe Rumah</h1>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered">
                    <tr class="text-center text-white bg-dark">
                        <th>No</th>
                        <th>Tipe Rumah</th>
                        <th>Luas Bangunan (m2)</th>
                        <th>Luas Tanah (m2)</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($tabelTipe as $rows) : ?>
                    <tr class="show text-center" id="<?= $rows["id_tipe"]; ?>">
                        <td style="width: 75px;"><?= $i; ?></td>
                        <td class="text-center" data-target="tipe_rumah"><?= $rows["tipe_rumah"]; ?> (<?= $rows["luas_bangunan"]; ?>/<?= $rows["luas_tanah"]; ?>)</td>
                        <td class="text-center" data-target="luas_bangunan" style="width: 150px;"><?= $rows["luas_bangunan"]; ?> m2</td>
                        <td class="text-center" data-target="luas_tanah" style="width: 125px;"><?= $rows["luas_tanah"]; ?> m2</td>
                        <td class="text-center" style="width: 125px;">
                        <a href="tipe_detail.php?id=<?= $rows['id_tipe']; ?>"class="btn btn-outline-dark btn-sm" title="Detail Tipe Rumah"><i class="fas fa-info"></i></a>
                        <a href="edit_tiperumah.php?id=<?= $rows['id_tipe']; ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Tipe Rumah"><i class="fas fa-edit"></i></a>
                        <a href="delete_tiperumah.php?id=<?= $rows['id_tipe']; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Tipe Rumah" onclick="return confirm('Yakin ingin hapus tipe perumahan?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    </table>
                    <a class="btn btn-block btn-primary" href="tambah-tipe.php?id_perum=<?= $idPerum ?>">
                    <span data-feather='plus'></span>
                        Tambah Tipe Perumahan
                    </a>
                    <br>
            </div>
    </div>
</div>
<script>
        //membuat mapOptions
        var mapOptions = {
            center: [-8.61510 , 115.17349],
            zoom: 14
        }
        //membuat layer map
        var mymap = new L.map('peta', mapOptions);
        //membuat titik awal pada peta
        mymap.setView([-8.61499 , 115.17297], 14);
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