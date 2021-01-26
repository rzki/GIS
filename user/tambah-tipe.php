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

if (isset($_POST['tambah'])){
    
    if( tambahtipe ($_POST) > 0) {
        echo 
        "
        <script>
            alert ('Data perumahan berhasil ditambahkan!');
            document.location.href = 'home.php';
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

<form action="" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="tipe_rumah" class="col-sm-2 col-form-label">Tipe Rumah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tipe_rumah" name="tipe_rumah" placeholder="Tipe Rumah">
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_bangunan" class="col-sm-2 col-form-label">Luas Bangunan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_bangunan" name="luas_bangunan" placeholder="Luas Bangunan">
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_tanah" class="col-sm-2 col-form-label">Luas Tanah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" placeholder="Luas Tanah">
                </div>
        </div>

        <div class="form-group row">
            <label for="spesifikasi" class="col-sm-2 col-form-label">Spesifikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi">
                </div>
        </div>
        
        <div class="form-group row">
            <label for="daya_listrik" class="col-sm-2 col-form-label">Daya Listrik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="daya_listrik" name="daya_listrik" placeholder="Daya Listrik">
                </div>
        </div>
                <button type="submit" class="btn btn-primary btn-block" name="tambah">Tambah Data Perumahan</button>
    </form>
</body>
</html>