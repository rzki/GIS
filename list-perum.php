<?php
require "functions.php";

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query(" SELECT * FROM perumahan_master LIMIT $awalData, $jumlahDataPerHalaman ");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("components/index-list.php")?>
    <title>Daftar Perumahan</title>
</head>
<body>
    <?php include_once("components/navbar-list.php")?>

<section id="daftarPerumHeader" class="welcomeImg">
    <div class="container">
        <div class="row">
            <div class="col mx-auto">
                <img src="assets/brand/Kabupaten_Badung.png" class="text-center" style="width: 150px; height: 150px" alt="">
                <h1 style="color: white;">Sistem Informasi Geografis <br> Pemetaan Perumahan Kabupaten Badung</h1>
                <p class="lead" style="color: white;">Selamat datang di Sistem Informasi Geografis Pemetaan Perumahan Kabupaten Badung</p>
            </div>
        </div>
    </div>
</section>
<section id="daftarPerum">
        <center><h1>Daftar Perumahan</h1></center>
        <hr class=" w-75 mx-auto">

    <div class="container">
        <div class="table-responsive mx-auto" style="width: 100%;">
            <table class="table table-lg table-hover table-striped table-bordered">
                <tr class="text-center">
                    <th>No.</th>
                    <th>Nama Perumahan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($perum as $row) : ?>
                <tr class="show" id="<?= $row["id_perum"]; ?>">
                    <td class="text-center" style="width: 50px;"><?= $i; ?></td>
                    <td class="text-center" data-target="nama_perum" style="width: 200px;"><?= $row["nama_perum"]; ?></td>
                    <td class="text-center" data-target="alamat" style="width: 500px;"><?= $row["alamat"]; ?></td>
                    <td class="text-center" style="text-align: center; width:100px">
                        <a href="detail-perum.php?id=<?= $row['id_perum']?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i> Lihat Detail</a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </table>
        </div>
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
    function goBack(){
        window.history.back();
    }
</script>
</body>
</html>