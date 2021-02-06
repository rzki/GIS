<?php
require "functions.php";

$areas = getAreaListbyStatus();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once("components/index-head.php")?>
</head>

<body id="page-top">
  <?php include_once("components/navbar-index.php")?>

<section id="welcomeHeader" class="welcomeImg">
    <div class="container">
      <div class="row">
          <div class="col-xl-12 mx-auto">
            <img src="assets/brand/Kabupaten_Badung.png" class="text-center" style="width: 150px; height: 150px" alt="">
            <h1 style="color: white;">Sistem Informasi Geografis <br> Pemetaan Perumahan Kabupaten Badung</h1>
            <p class="lead" style="color: white;">Selamat datang di Sistem Informasi Geografis Pemetaan Perumahan Kabupaten Badung</p>
          </div>
      </div>
    </div>
</section>

<section id="about" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 style="text-align: left;">Tentang Kabupaten Badung</h2>
          <p class="lead" style="text-align: justify;">&emsp;&emsp;&emsp;Kabupaten Badung adalah sebuah kabupaten yang terletak di provinsi Bali, Indonesia. 
                                                                  Kabupaten Badung juga meliputi Kuta dan Nusa Dua, sebuah daerah objek wisata yang terkenal.
          </p>
          <p class="lead" style="text-align: justify;">&emsp;&emsp;&emsp;Kabupaten Badung terdiri dari 6 Kecamatan, yaitu Kuta Selatan, Kuta, Kuta Utara, Mengwi, Abiansemal,
                                                                  dan Petang. Jumlah penduduk yang ada di Kabupaten Badung adalah 683,200 jiwa*.</p>
          <p class="text-muted" style="font-size:smaller">*merujuk kepada data dari BPS Kab. Badung tahun 2020.</p>
        </div>
      </div>
    </div>
    <br>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 style="text-align: right;">Tentang Sistem</h2>
          <p class="lead" style="text-align: justify;">&emsp;&emsp;&emsp;Sistem Informasi Geografis Pemetaan Perumahan Kabupaten Badung ini dibangun untuk memetakan perumahan yang berada di Kabupaten Badung.
                          Untuk saat ini, ruang lingkup pemetaan perumahan dari sistem ini hanya berada di kawasan Kuta Selatan.
          </p>
          <p class="lead" style="text-align: justify;">&emsp;&emsp;&emsp;Nantinya sistem ini diharapkan dapat
                          memberikan informasi yang berguna kepada masyarakat tentang perumahan dan informasi rinci tentang perumahan yang terletak di Kabupaten Badung.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="daftar-perum">
    <div class="container">
      <h2 style="text-align:center">Daftar Perumahan</h2>
      <br>
        <p class="lead text-center">Daftar lengkap dari perumahan yang berada di Kabupaten Badung bisa dilihat dengan mengklik tombol dibawah</p>
        <br>
        <center><a href="list-perum.php" class="btn btn-lg btn-outline-dark">Klik disini</a></center>   
    </div>
  </section>

  <section id="peta-perum" class="bg-light">
    <h2 style="text-align:center">Peta Perumahan</h2>
    <div class="container">
      <div id="peta" style="width: 100%; height: 600px;"></div>
    </div>
  </section>


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
                                    "<br><a href='perum-detail.php?id="+ areas[i]['id_perum'] +"'>Lihat detail perumahan</a></center>";
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
</body>

</html>
