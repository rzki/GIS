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
$carousel = mysqli_query($conn, "SELECT * FROM perum_gambar WHERE id_perum = $idPerum");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
    <title>Detail Perum <?= $perum["nama_perum"]; ?></title>
    <style>
    .gambar-perum{
        text-align: center;
        margin-left: 100px;
        margin-right: 50px;
    }
    .btnGambar,.btnTipe{
        margin-top: 10px;
        float: right;
        margin-right: -30px;
    }
    hr{
        border: 1px solid gray;
        background-color: gray;
    }
    #btnGambar{
        margin: auto;
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
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

    <div id="peta" style="margin-bottom: 1%; width:100%; height:45%"></div>
    <!-- jika data perumahan tidak diinput oleh user yang sedang login -->
    <!-- maka user tidak bisa memakai fungsi input ke dalam data tersebut -->
    <?php if($perum["id_user"] != $_SESSION["userID"]) {?>
    <?php } else {?>
            <div class="container">
        <a class="btnGambar btn btn-primary" href="kelola-gambar.php?id_perum=<?= $idPerum ?>">
            Kelola Gambar
        </a>
    </div> 
    <?php }?> 
    <h1 class="text-center">Gambar Perumahan</h1>
    <hr>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-7">
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
                            <a href="../img-perum/<?php echo $row['gambar_perum'] ?>" target="_blank">
                                <img src="../img-perum/<?php echo $row['gambar_perum'] ?>" alt="" title="<?php echo $row['gambar_perum'] ?>" width="600" height="400">
                            </a>
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
    <h1 class="text-center">Detail Perumahan</h1>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <p class="card-title text-center" style="word-wrap: break-word; font-size:x-large"><b>Nama Perumahan</b></p>
                <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><?= $perum["nama_perum"];?></p>
                <p class="card-title text-center" style="word-wrap: break-word; font-size:x-large"><b>Alamat</b></p>
                <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><?= $perum["alamat"];?></p>
                <p class="card-title text-center" style="word-wrap: break-word; font-size:x-large"><b>Nomor Telepon</b></p>
                <p class="card-title text-center" style="word-wrap: break-word; font-size:large;"><?= $perum["no_telp"];?>
                (<a href="tel:<?= $perum["no_telp"];?>">call</a>)</p>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <!-- jika data perumahan tidak diinput oleh user yang sedang login -->
    <!-- maka user tidak bisa memakai fungsi input ke dalam data tersebut -->
    <?php if($perum["id_user"] != $_SESSION["userID"]) {?>
    <?php } else {?>
    <div class="container">
        <a class="btnTipe btn btn-primary" href="tambah-tipe.php?id_perum=<?= $idPerum ?>">
            Tambah Tipe
        </a>
    </div>
    <?php }?> 
    <h1 class="text-center">Tipe Rumah</h1>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered">
                    <tr class="text-center text-white bg-dark">
                        <th>No.</th>
                        <th>Tipe Rumah</th>
                        <th>Luas Bangunan (m2)</th>
                        <th>Luas Tanah (m2)</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($tabelTipe as $rows) : ?>
                    <tr class="show text-center" id="<?= $rows["id_tipe"]; ?>">
                        <td style="width: 75px;"><?= $i; ?></td>
                        <td class="text-center" data-target="tipe_rumah"><?= $rows["tipe_rumah"]; ?> (<?= $rows["luas_bangunan"]; ?>/<?= $rows["luas_tanah"]; ?>)</td>
                        <td class="text-center" data-target="luas_bangunan" style="width: 175px;"><?= $rows["luas_bangunan"]; ?> m2</td>
                        <td class="text-center" data-target="luas_tanah" style="width: 175px;"><?= $rows["luas_tanah"]; ?> m2</td>
                        <td class="text-center" data-target="harga" style="width: 200px;"><?= rupiah($rows["harga"]) ?></td>
                        <td class="text-center" style="width: 125px;">
                        <a href="tipe_detail.php?id_tipe=<?= $rows['id_tipe']; ?>"class="btn btn-outline-dark btn-sm" title="Detail Tipe Rumah"><i class="fas fa-info"></i></a>
                        <!-- jika data perumahan tidak diinput oleh user yang sedang login -->
                        <!-- maka user tidak bisa memakai fungsi input/update ke dalam data tersebut, hanya melihat detailnya saja -->   
                        <?php if($perum["id_user"] != $_SESSION["userID"]) {?>
                        <?php } else {?>
                        <a href="edit_tiperumah.php?id_tipe=<?= $rows['id_tipe']; ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Tipe Rumah"><i class="fas fa-edit"></i></a>
                        <a href="delete_tiperumah.php?id_tipe=<?= $rows['id_tipe']; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Tipe Rumah" onclick="return confirm('Yakin ingin hapus tipe perumahan?')">
                            <i class="fas fa-trash"></i>
                        </a>
                        <?php }?>
                    </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    </table>
                    <br>
            </div>
    </div>
</div>
<script>
        //membuat mapOptions
        var mapOptions = {
            center: [-8.61510 , 115.17349],
            zoom: 18
        }
        //membuat layer map
        var mymap = new L.map('peta', mapOptions);
        //membuat titik awal pada peta
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
            window.location.href="dataperum.php";
        }
    </script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>