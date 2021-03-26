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

$idTipe = $_GET["id_tipe"];

// pagination
$jumlahDataPerHalaman =  11;
$jumlahData = count(query("SELECT * FROM tipe_gambar WHERE id_tipe = $idTipe"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$tipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];
$gambartipe = mysqli_query($conn, "SELECT * FROM tipe_gambar WHERE id_tipe = $idTipe LIMIT $awalData, $jumlahDataPerHalaman");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
    <title>Detail Tipe Rumah <?= $tipe["tipe_perum"]; ?></title>
    <!-- <style>
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
    </style> -->
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Kelola Gambar Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered">
                    <tr class="text-center text-white bg-dark">
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($gambartipe as $rows) : ?>
                    <tr class="show text-center" id="<?= $rows["id_gambar"]; ?>">
                        <td style="width: 75px;"><?= $i; ?></td>
                        <td data-target="gambar_tipe"><img src="../img-tiperumah/<?= $rows["gambar_tipe"];?>" alt="" width="200" height="100"></td>
                        <td>
                        <a href="delete_gambartipe.php?id=<?= $rows['id_gambar']; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Gambar Rumah" onclick="return confirm('Yakin ingin hapus gambar ini?')">
                            <i class="fas fa-trash"></i>
                            Hapus Gambar Tipe Rumah
                        </a>
                        </td>
                    </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    </table>
                    <br>
            </div>
        <a class="btnTambah btn btn-primary btn-block" href="tambah-gambartipe.php?id_tipe=<?= $idTipe ?>">
            Tambah Gambar Tipe Rumah
        </a>
    </div>
</div>
<script>
    function goBack() {
        window.location.href="tipe_detail.php?id_tipe=<?= $idTipe?>";
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>