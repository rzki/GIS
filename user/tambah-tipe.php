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

$id_perum = $_GET["id_perum"];

if (isset($_POST['tambah'])){
    
    if( tambahtipe ($_POST) > 0) {
        if( tambahgambartipe ($_POST) > 0){
        echo 
        "
        <script>
            alert ('Tipe perumahan berhasil ditambahkan!');
            document.location.href = 'detail.php?id=$id_perum'
        </script>
        ";
    } else {
        echo
        "
        <script>
            alert ('Tipe perumahan gagal ditambahkan!');
            document.location.href = 'detail.php?id=$id_perum'
        </script>
        ";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/perum-tambah.php') ?>
    <title>Tambah Tipe Rumah</title>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php $currentPage = 'home' ?>
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content -->
    <?php $head = 'Tambah Tipe Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

<form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="nama_perum">

        <div class="form-group row">
            <label for="tipe_rumah" class="col-sm-2 col-form-label">Tipe Rumah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tipe_rumah" name="tipe_rumah" placeholder="Tipe Rumah">
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_bangunan" class="col-sm-2 col-form-label">Luas Bangunan (m2)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_bangunan" name="luas_bangunan" placeholder="Luas Bangunan">
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_tanah" class="col-sm-2 col-form-label">Luas Tanah (m2)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" placeholder="Luas Tanah">
                </div>
        </div>

        <div class="form-group row">
            <label for="spesifikasi" class="col-sm-2 col-form-label">Spesifikasi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi"></textarea>
                </div>
        </div>
        
        <div class="form-group row">
            <label for="daya_listrik" class="col-sm-2 col-form-label">Daya Listrik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="daya_listrik" name="daya_listrik" placeholder="Daya Listrik">
                </div>
        </div>

        <div class="form-group row">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
                </div>
        </div>
        
        <div class="form-group row">
            <label for="gambar_tipe[]" class="col-sm-2 col-form-label">Gambar Tipe</label>
                <div class="col-sm-10">
                    <input type="file" id="gambar_tipe[]" name="gambar_tipe[]" multiple required>
                    <p>(max. size 10MB)</p>
                </div>
        </div>

        <input type="hidden" name="id" value="<?= $id_perum ?>">
                <button type="submit" class="btn btn-primary btn-block" name="tambah">Tambah Data Perumahan</button>
    </form>
    <script>
        function goBack() {
            window.location.href="detail.php?id=<?= $id_perum?>";
        }
    </script>  
</body>
</html>