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

$areas = getAreaList();

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('../components/head-peta.php') ?>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-admin.php') ?>
    
    <!-- Main Content -->
    <?php $head = 'Peta Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>
    

    <div id="peta" style="width:100%; height: 550px;"></div>

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
                // membuat variabel polygon dan menampilkannya di peta
                var polygon = L.polygon( stringToGeoPoints(areas[i]['koordinat']), { color: 'blue'}).addTo(mymap);
                // membuat variabel custom style dari popup
                var customPopUp = "<center><b style='font-size: large;'>"
                                    + areas[i]['nama_perum'] +"</b><br>"+ areas[i]['alamat'] +
                                    "<br><a href='detail.php?id="+ areas[i]['id_perum'] +"'>Lihat detail perumahan</a></center>";
                var customOptions = {
                    'maxWidth': '500',
                    'className': 'custom',
                    closeButton: true,
                    autoClose: false
                };
                // menyematkan popup beserta variabel customnya ke dalam map
                polygon.bindPopup(customPopUp, customOptions).addTo(mymap);
            }
        }
        var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );
    </script>
    <script>
        function goBack() {
            window.location.href="home.php";
        }
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>