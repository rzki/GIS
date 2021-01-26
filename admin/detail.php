<?php 
session_start();
require "../functions.php";

if (empty($_SESSION['login'])) {
    header('Location: ../auth/login.php');
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

$idPerum = $_GET["id"];

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM tiperumah_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = mysqli_query($conn, "SELECT * FROM perumahan_master WHERE id_perum = '$idPerum'");
$tipe = mysqli_query($conn, "SELECT * FROM tiperumah_master WHERE id_perum = '$idPerum'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
</head>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- Main Content --> 
    <?php $head = 'Detail Perumahan' ?>
    <?php include_once('../components/main-content.php') ?>

    
    <div class="container-fluid">
        <div class="row">
        <?php while($row = mysqli_fetch_assoc($perum)) {?>
            <div class="card w-100 border-dark">
                <div class="card-horizontal" style="display: flex; flex:auto; width:100%;">
                    <div class="card-body">
                        <h2 class="card-title" style="text-align: center;"><?php echo $row["nama_perum"]; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Tipe Rumah</th>
                        <th>Luas Bangunan</th>
                        <th>Luas Tanah</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $i = 1; ?>
                    <?php foreach ($tipe as $rows) : ?>
                    <tr class="show text-center" id="<?= $rows["id_tipe"]; ?>">
                        <td><?= $i; ?></td>
                        <td class="text-center" data-target="tipe_rumah"><?= $rows["tipe_rumah"]; ?></td>
                        <td class="text-center" data-target="luas_bangunan" ><?= $rows["luas_bangunan"]; ?></td>
                        <td class="text-center" data-target="luas_tanah"><?= $rows["luas_tanah"]; ?></td>
                        <td class="text-center" >
                        <a href="#" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#TipeModal" title="Detail Tipe Rumah"><i class="fas fa-info"></i></a>
                        <a href="edit_tiperumah.php?id=<?= $rows['id_tipe'] ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Tipe Rumah"><i class="fas fa-edit"></i></a>
                        <a href="delete_tiperumah.php?id=<?= $rows['id_tipe'] ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Tipe Rumah" onclick="return confirm('Yakin ingin hapus tipe perumahan?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    </table>
                    <a class="btn btn-block btn-dark" href="tambah-tipe.php?id_perum=<?= $idPerum ?>">
                    <span data-feather='plus'></span>
                        Tambah Tipe Perumahan
                    </a>
                    <br>
            </div>
    </div>
    <div class="card-deck">
        <div class="card">
            <h4 class="card-header">
                Detail Perumahan
            </h4>
                <div class="card-body">
                    <p class="card-title" style="word-wrap: break-word;">Alamat : <br> <?php echo $row["alamat"]?></p>
                    <p class="card-title" style="word-wrap: break-word;">Koordinat : <br> <?php echo $row["koordinat"]?></p>
                </div>
        </div>
        <div class="card">
            <h5 class="card-header">
                Gambar Perumahan
            </h5>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../img-perum/<?php echo $row["gambar"]; ?>" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Tipe Rumah : <?php echo $row["tipe_rumah"]?></h5>
                            </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../img-perum/<?php echo $row["gambar"]; ?>" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Tipe Rumah : <?php echo $row["tipe_rumah"]?></h5>
                            </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../img-perum/<?php echo $row["gambar"]; ?>" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Tipe Rumah : <?php echo $row["tipe_rumah"]?></h5>
                            </div>
                    </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
<?php }?>
<!-- Modal -->
<div class="modal fade" id="TipeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Tipe Perumahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tipe Rumah :
                <br>
                <?php echo $rows["tipe_rumah"];?>
                <br>
                <br>
                Luas Bangunan :
                <br>
                <?php echo $rows["luas_bangunan"];?>
                <br>
                <br>
                Luas Tanah :
                <br>
                <?php echo $rows["luas_tanah"];?>
                <br>
                <br>
                Spesifikasi :
                <br>
                <?php echo $rows["spesifikasi"];?>
                <br>
                <br>
                Daya Listrik :
                <br>
                <?php echo $rows["daya_listrik"];?>
                <br>
                <br>
                Gambar :
                <br>
                <img src="../img-perum/<?php echo $rows["gambar"];?>" style="max-width:470px;">
            </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
<div id="peta" style="margin-bottom: 1%; width:100%;"></div>
</body>
</html>