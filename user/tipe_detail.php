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
$idUser = $_SESSION["userID"];
$tipe = query("SELECT * FROM tiperumah_master WHERE id_tipe = $idTipe")[0];
$carousel = mysqli_query($conn, "SELECT * FROM tipe_gambar WHERE id_tipe = $idTipe");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
    <title>Detail <?= $tipe["tipe_rumah"]; ?></title>
    <style>
    h1{
        text-align: center;
    }
    img{
        justify-content: center;
    }
    .btnGambar{
        margin-top: 10px;
        float: right;
        margin-right: -50px;
    }
    </style>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-user.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Tipe ' . $tipe["tipe_rumah"] ?>
    <?php include_once('../components/main-content.php') ?>

    <?php if($tipe["id_user"] != $idUser) {?>
    <?php } else {?>
    <div class="container">
        <a class="btnGambar btn btn-primary" href="kelola-gambartipe.php?id_tipe=<?= $idTipe ?>">
            Kelola Gambar
        </a>
    </div>
    <?php }?>
    <h1>Gambar Tipe Rumah</h1>
    <hr>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-7">
                <!— Banner SlideShow nya —>
                <div id="dmbannerhead" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <ol class="carousel-indicators">
                            <?php
                            $count = mysqli_query($conn, "SELECT * FROM tipe_gambar WHERE id_tipe = $idTipe");
                            $res = mysqli_num_rows($count);
                            for($i=0; $i<$res;$i++){
                                echo '<li data-target="#dmbannerhead" data-slide-to="'.$i.'"'; if($i==0){ echo 'class="active"'; } echo '></li>';
                            }
                            ?>
                        </ol>
                        <?php
                            if($result = $carousel) {
                            $y = 0;
                            while ($rows = mysqli_fetch_assoc($result)) {
                        if($y==0) $aktif = "active";
                            else $aktif = '';
                            ?>
                            <div class="carousel-item <?php echo $aktif ?>  text-center">
                            <a href="../img-tiperumah/<?php echo $rows['gambar_tipe'] ?>" target="_blank">
                                <img src="../img-tiperumah/<?php echo $rows['gambar_tipe'] ?>" alt="" title="<?php echo $rows['gambar_tipe'] ?>" width="600" height="400">
                            </a>
                        </div>
                    <?php 
                        $y++;
                        } // tutup while
                    }	// tutup if
                    ?>
                    </div>
                    <a class="carousel-control-prev" href="#dmbannerhead" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#dmbannerhead" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!— /Banner Slideshow nya —>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <h1>Detail Tipe Rumah</h1>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Tipe Rumah</b></p>
            <p class="text-center" style="font-size:medium"><?= $tipe["tipe_rumah"];?></p>
            <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Luas Bangunan (m2)</b></p>
            <p class="text-center" style="font-size:medium"><?= $tipe["luas_bangunan"];?> m2</p>
            <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Luas Tanah (m2)</b></p>
            <p class="text-center" style="font-size:medium"><?= $tipe["luas_tanah"];?>  m2</p>
            </div>
            <div class="col">
            <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Spesifikasi</b></p>
            <p class="text-center" style="font-size:medium"><?= $tipe["spesifikasi"];?></p>
            <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Daya Listrik</b></p>
            <p class="text-center " style="font-size:medium"><?= $tipe["daya_listrik"];?></p>
            <p class="card-title text-center" style="word-wrap: break-word; font-size:large"><b>Harga</b></p>
            <p class="text-center" style="font-size:medium"><?= rupiah($tipe["harga"]);?></p>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <script>
        function goBack() {
            window.location.href="detail.php?id=<?=$tipe["id_perum"];?>";
        }
    </script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>