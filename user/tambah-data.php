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

$id = $_SESSION["userID"];

if (isset($_POST['tambah'])){
    
    if( tambahdataperum ($_POST) > 0) {
        echo 
        "
        <script>
            alert ('Data perumahan berhasil ditambahkan. Silahkan menunggu persetujuan admin!');
            document.location.href = 'dataperum.php';
        </script>
        ";
    } else {
        echo
        "
        <script>
            alert ('Data perumahan gagal ditambahkan!');
            document.location.href = 'home.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/perum-tambah.php') ?>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php $currentPage = 'home' ?>
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content -->
    <?php $head = 'Tambah Data Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

<div id="peta" style="margin-bottom: 1%; "></div>

<div class="row justify-content-center">
    <input type="button" onclick="drawArea();" class="btn btn-primary" style="margin-bottom: 1%; margin-right: 1%;" value="Gambar Area">
    <input type="button" onclick="resetArea();" class="btn btn-danger" style="margin-bottom: 1%; margin-right: 1%;" value="Hapus Area">
</div>

<form method="post" action="" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="nama_perum" class="col-sm-2 col-form-label">Nama Perumahan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_perum" name="nama_perum" placeholder="Nama Perumahan" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                </div>
        </div>

        <!-- <div class="form-group row">
            <label for="tipe_rumah" class="col-sm-2 col-form-label">Tipe Rumah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tipe_rumah" name="tipe_rumah" placeholder="Tipe Rumah" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_tanah" class="col-sm-2 col-form-label">Luas Tanah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" placeholder="Luas Tanah" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_bangunan" class="col-sm-2 col-form-label">Luas Bangunan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_bangunan" name="luas_bangunan" placeholder="Luas Bangunan" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="spesifikasi" class="col-sm-2 col-form-label">Spesifikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi" required>
                </div>
        </div>
        
        <div class="form-group row">
            <label for="daya_listrik" class="col-sm-2 col-form-label">Daya Listrik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="daya_listrik" name="daya_listrik" placeholder="Daya Listrik" required>
                </div>
        </div> -->

        <div class="form-group row">
            <label for="koordinat" class="col-sm-2 col-form-label">Koordinat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="margin-bottom: 1%;" id="koordinat" name="koordinat" placeholder="Koordinat" required>
                    <input type="button" onclick="getGeoPoints();" class="btn btn-dark btn-block" value="Ambil Koordinat"></input>
                </div>
        </div>

        <div class="form-group row">
            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    <input type="file" id="gambar" name="gambar" required>
                    <p>(max. size 10MB)</p>
                </div>
        </div>
        <input type="hidden" name="id_user" value="<?= $id ?>">
        <button type="submit" class="btn btn-primary btn-block" name="tambah">Tambah Data Perumahan</button>
</form>
<script>
        //membuat mapOptions
        var mapOptions = {
            center: [-8.61510 , 115.17349],
            zoom: 13
        }
        //membuat layer map
        var mymap = new L.map('peta', mapOptions);
        var polygon;
        var draggableAreaMarkers = new Array();

        //membuat titik awal pada peta
        mymap.setView([-8.61499 , 115.17297], 15);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 20,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        function resetArea() {
    if(polygon != null) {
        mymap.removeLayer( polygon );
    }
    for(i=0; i < draggableAreaMarkers.length; i++) {
        mymap.removeLayer( draggableAreaMarkers[i] );
    }
    draggableAreaMarkers = new Array();
    }
    
    function addMarkerAreaPoint(latLng) {
    var areaMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900 }).addTo(mymap);
    
    areaMarker.arrayId = draggableAreaMarkers.length;

    areaMarker.on('click', function() {
        mymap.removeLayer( draggableAreaMarkers[ this.arrayId ]);
        draggableAreaMarkers[ this.arrayId ] = "";
    });

    draggableAreaMarkers.push( areaMarker );
    }
    
    function drawArea() {
    if(polygon != null) {
        mymap.removeLayer( polygon );
    }

    var latLngAreas = new Array();

    for(i=0; i < draggableAreaMarkers.length; i++) {
        if(draggableAreaMarkers[ i ]!="") {
        latLngAreas.push( L.latLng( draggableAreaMarkers[ i ].getLatLng().lat, draggableAreaMarkers[ i ].getLatLng().lng));
        }
    }

    if(latLngAreas.length > 1) {
        // create a blue polygon from an array of LatLng points
        polygon = L.polygon( latLngAreas, {color: 'blue'}).addTo(mymap);
    }

    }
    
    function getGeoPoints() {
    var points = new Array();
    for(var i=0; i < draggableAreaMarkers.length; i++) {
        if(draggableAreaMarkers[i] != "") {
        points[i] =  draggableAreaMarkers[ i ].getLatLng().lng + "," + draggableAreaMarkers[ i ].getLatLng().lat;
        }
    }
    $('#koordinat').val(points.join(', '));
    }
    
    $( document ).ready(function() {
    mymap.on('click', function(e) {
        addMarkerAreaPoint( e.latlng);
    });
    });

    function putDraggable() {
    /* create a draggable marker in the center of the map */
    draggableMarker = L.marker([ map.getCenter().lat, map.getCenter().lng], {draggable:true, zIndexOffset:900}).addTo(map);
    
    /* collect Lat,Lng values */
    draggableMarker.on('dragend', function(e) {
        $("#lat").val(this.getLatLng().lat);
        $("#lng").val(this.getLatLng().lng);
    });
    }
    
    $( document ).ready(function() {
    putDraggable();
    });

    </script>
</body>
</html>