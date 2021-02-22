<?php

session_start();
require "../functions.php";

if (empty($_SESSION['login'])) {
    header('Location: ../auth/login.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'user': 
            header('Location: ../admin/home.php');
        break;
        case 'admin': 
            $usr = $_SESSION['user'];
        break;
    }
}

$idTipe = $_GET["id_tipe"];
$tipe  = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];
$idPerum = $tipe["id_perum"];

if (isset($_POST['tambah'])){
    
    if( tambahgambar_tipe ($_POST) > 0) {
        echo 
        "
        <script>
            alert ('Gambar tipe rumah berhasil ditambahkan!');
            document.location.href = 'kelola-gambartipe.php?id_tipe=$idTipe'
        </script>
        ";
    } else {
        echo
        "
        <script>
            alert ('Gambar tipe rumah gagal ditambahkan!');
            document.location.href = 'kelola-gambartipe.php?id_tipe=$idTipe'
        </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/perum-tambah.php') ?>
    <title>Tambah Gambar Tipe Rumah</title>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php $currentPage = 'home' ?>
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- Main Content -->
    <?php $head = 'Tambah Data Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>


<form action="" method="post" enctype="multipart/form-data">
        <div class="form-group row" style="margin-top: 1%;">
            <label for="gambar_tipe[]" class="col-sm-2 col-form-label">Gambar Perumahan</label>
                <div class="col-sm-10">
                    <input type="file" id="gambar_tipe[]" name="gambar_tipe[]" multiple>
                    <p class="text-muted">(ukuran maks. 10MB)</p>
                </div>
        </div>
        <input type="hidden" name="id_tipe" value="<?= $idTipe ?>">
        <input type="hidden" name="id_perum" value="<?= $idPerum ?>">
        <button type="submit" class="btn btn-primary btn-block" name="tambah">Tambah Gambar Perumahan</button>
        <br>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>