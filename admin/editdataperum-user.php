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

//ambil data di URL
$idPerum = $_GET['id'];
$areaPerum = getAreaListbyID();

//query data perumahan berdasarkan id
$perum = query("SELECT * FROM perumahan_master WHERE id_perum = $idPerum")[0];

if(isset($_POST["update"])){

    //cek apakah data berhasil diubah atau tidak
    if(ubahdataperum($_POST) > 0) {
        echo '
        <script>
                alert("Berhasil mengubah data perumahan!");
                window.location.href="dataperum-user.php"
            </script>
        ';
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/perum-tambah.php') ?>
    <title>Edit Data Perumahan</title>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php $currentPage = 'home' ?>
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- Main Content -->
    <?php $head = 'Edit Data Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

<div id="peta" style="margin-bottom: 1%; width:100%; height: 600px;"></div>

<div class="row justify-content-center">
    <input type="button" onclick="drawArea();" class="btn btn-primary" style="margin-bottom: 1%; margin-right: 1%;" value="Gambar Area Perumahan">
    <input type="button" onclick="resetArea();" class="btn btn-danger" style="margin-bottom: 1%; margin-right: 1%;" value="Hapus Area Perumahan">
</div>

<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $perum["id_perum"]; ?>">
    <input type="hidden" name="gambarLama" value="<?= $perum["gambar_perum"]; ?>">
        <div class="form-group row">
            <label for="nama_perum" class="col-sm-2 col-form-label">Nama Perumahan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_perum" name="nama_perum" placeholder="Nama Perumahan" 
                    value="<?= $perum['nama_perum'];?>" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" 
                    value="<?= $perum['alamat'];?>" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="koordinat" class="col-sm-2 col-form-label">Koordinat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="margin-bottom: 1%;" id="koordinat" name="koordinat" placeholder="Koordinat" 
                    value="<?= $perum['koordinat'];?>" required>
                    <input type="button" onclick="getGeoPoints();" class="btn btn-dark btn-block" value="Update Koordinat"></input>
                </div>
        </div>

        <div class="form-group row">
            <label for="no_telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Telepon">
                </div>
        </div>

        <div class="form-group row" style="margin-top: 1%;">
            <label for="gambar_perum" class="col-sm-2 col-form-label">Gambar Perumahan</label>
                <div class="col-sm-10">
                    <input type="file" id="gambar_perum" name="gambar_perum" value="<?= $perum['gambar_perum'];?>">
                    <p class="text-muted">(ukuran maks. 10MB)</p>
                </div>
        </div>
        
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="form-control">
                    <?php $status = $perum['status']?>
                    <option <?=($status == "Pending")?'selected="selected"':''?>>Pending</option>
                    <option <?=($status == "Diterima")?'selected="selected"':''?>>Diterima</option>
                    </select>
                </div>
        </div>
                <center><button type="submit" class="btn btn-primary btn-block" name="update">Edit Data Perumahan</button></center>
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
            mymap.setView([-8.61499 , 115.17297], 18);
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
    $('#koordinat').val(points.join(','));
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