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
    <?php include_once("components/index-head.php")?>
</head>
<body>
    <?php include_once("components/navbar.php")?>

<div class="container-fluid" style="font-size:32pt; font-weight:bold; margin-bottom:2%; align-content:center">
    <button class="btn btn-lg border-dark" style="margin-top: 8%; margin-left:8%" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
    <center><h1>Daftar Perumahan</h1></center>
</div>
<div class="container-fluid">
    <div class="table-responsive mx-auto" style="width: 90%;">
        <table class="table table-lg table-hover table-striped table-bordered">
            <tr class="text-center">
                <th>No.</th>
                <th>Nama Perumahan</th>
                <th>Alamat</th>
                <th>Koordinat</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($perum as $row) : ?>
            <tr class="show" id="<?= $row["id_perum"]; ?>">
                <td class="text-center" style="width: 50px;"><?= $i; ?></td>
                <td class="text-center" data-target="nama_perum" style="width: 200px;"><?= $row["nama_perum"]; ?></td>
                <td class="text-center" data-target="alamat" style="width: 500px;"><?= $row["alamat"]; ?></td>
                <td class="text-center" data-target="koordinat"style="width: 700px;"><?= $row["koordinat"]; ?></td>
                <td class="text-center" style="text-align: center;">
                    <a href="perum-detail.php?id=<?= $row['id_perum']?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i> Lihat Detail</a>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<script>
    function goBack(){
        window.history.back();
    }
</script>
</body>
</html>