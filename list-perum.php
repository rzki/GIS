<?php
require "functions.php";

// pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master WHERE status = 'Diterima' LIMIT $awalData, $jumlahDataPerHalaman");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("components/index-list.php")?>
    <title>Daftar Perumahan</title>
    <style>
    .box-cari{
        margin-bottom: 10px;
        width: 250px;
        text-align: center;
    }
    #daftarPerum{
        margin-bottom: -50px;
    }
    </style>
</head>
<body>
    <?php include_once("components/navbar-list.php")?>

<!-- List Perumahan Section -->
<section id="daftarPerum">
    <div class="daftarPerumHeader container">
        <center><h1>Daftar Perumahan</h1></center>
        <hr class=" w-75 mx-auto">
    </div>
    <div class="container">
        <div class="row">
        <form action="" method="post" class="search-form ml-auto">
            <input type="text" name="keyword" class="box-cari" placeholder="Masukkan keyword pencarian" id="keyword">
        </form>
            <div class="table-responsive mx-auto" style="width: 100%;" id="tabel">
                <table class="table table-lg table-hover table-striped table-bordered">
                    <tr class="text-center text-white bg-dark">
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
                            <a href="detail-perum.php?id=<?= $row['id_perum']?>" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i> Lihat Detail</a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <div class="panel-footer">
    <nav class="page">
        <ul class="pagination justify-content-center">
            <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
                <a href="?halaman=<?= $halamanAktif - 1 ?>#daftarPerum" class="page-link">Previous</a>
            </li>
            <?php else : ?>
            <li class="page-item">
                <div class="page-link text-dark" disabled>Previous</div>
            </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="?halaman=<?= $i; ?>#daftarPerum"><?= $i; ?></a>
                </li>
                <?php else : ?>
                <li class="page-item" aria-current="page">
                    <a class="page-link  text-dark" href="?halaman=<?= $i; ?>#daftarPerum"><?= $i; ?></a>
                </li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <li>
                <a href="?halaman=<?= $halamanAktif + 1 ?>" class="page-link" href="#">Next</a>
            </li>
            <?php else : ?>
            <li class="page-item">
                <div class="page-link text-dark">Next</div>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
    </div>
</div>
</section>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; 2020</p>
    </div>
    <!-- /.container -->
</footer>
<script src="js/search.js"></script>
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