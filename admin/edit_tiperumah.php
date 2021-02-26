<?php
session_start();
require "../functions.php";

if (empty($_SESSION['login'])) {
    header('Location: ../../auth/login.php');
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
$idTipe = $_GET['id'];
$previous = "javascript:history.go(-1)";

//query data perumahan berdasarkan id
$perumtipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];
$gambartipe = query("SELECT * FROM tipe_gambar WHERE id_tipe = $idTipe")[0];
$idperum = $perumtipe["id_perum"];

if(isset($_POST["update"])){

    //cek apakah data berhasil diubah atau tidak
    if(ubahtiperumah($_POST) > 0) {
            echo "
            <script>
                    alert('Berhasil mengubah tipe perumahan!');
                    window.location.href = 'detail.php?id=$idperum'
                </script>
            ";
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/head.php') ?>
    <title>Edit Tipe Perumahan</title>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php $currentPage = 'home' ?>
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- Main Content -->
    <?php $head = 'Edit Tipe Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $perumtipe["id_tipe"]; ?>">
    <input type="hidden" name="gambarLama[]" value="<?= $gambartipe["gambar_tipe"]?>">
        <div class="form-group row">
            <label for="tipe_rumah" class="col-sm-2 col-form-label">Tipe Rumah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tipe_rumah" name="tipe_rumah" placeholder="Tipe Rumah" 
                    value="<?= $perumtipe['tipe_rumah'];?>" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_bangunan" class="col-sm-2 col-form-label">Luas Bangunan (m2)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_bangunan" name="luas_bangunan" placeholder="Luas Bangunan" 
                    value="<?= $perumtipe['luas_bangunan'];?>" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="luas_tanah" class="col-sm-2 col-form-label">Luas Tanah (m2)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" placeholder="Luas Tanah"
                    value="<?= $perumtipe['luas_tanah'];?>" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="spesifikasi" class="col-sm-2 col-form-label">Spesifikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi" 
                    value="<?= $perumtipe['spesifikasi'];?>"required>
                </div>
        </div>
        
        <div class="form-group row">
            <label for="daya_listrik" class="col-sm-2 col-form-label">Daya Listrik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="daya_listrik" name="daya_listrik" placeholder="Daya Listrik" 
                    value="<?= $perumtipe['daya_listrik'];?>" required>
                </div>
        </div>
                
        <div class="form-group row">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Daya Listrik" 
                    value="<?= $perumtipe['harga'];?>" required>
                </div>
        </div>
        
        <input type="hidden" name="id_perum" id="id_perum" value="<?= $idperum ?>">
                <center><button type="submit" class="btn btn-primary btn-block" name="update">Update Tipe Perumahan</button></center>
</form>
<script>
        function goBack() {
            window.location.href="detail.php?id=<?= $idperum?>";
        }
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>