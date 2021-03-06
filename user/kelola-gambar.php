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

$idPerum = $_GET["id_perum"];

// pagination
$jumlahDataPerHalaman =  5;
$jumlahData = count(query("SELECT * FROM perum_gambar WHERE id_perum = $idPerum"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master WHERE id_perum = $idPerum")[0];
$gambarperum = mysqli_query($conn, "SELECT * FROM perum_gambar WHERE id_perum = $idPerum LIMIT $awalData, $jumlahDataPerHalaman");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../components/head.php') ?>
    <title>Detail Perum <?= $perum["nama_perum"]; ?></title>
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
                    <?php foreach ($gambarperum as $rows) : ?>
                    <tr class="show text-center" id="<?= $rows["id_gambar"]; ?>">
                        <td style="width: 75px;"><?= $i; ?></td>
                        <td data-target="gambar_perum"><img src="../img-perum/<?= $rows["gambar_perum"];?>" alt="" width="200" height="150"></td>
                        <td style="width:230px;">
                        <a href="delete_gambarperum.php?id=<?= $rows['id_gambar']; ?>" style="justify-content:center" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Gambar Rumah" onclick="return confirm('Yakin ingin hapus gambar ini?')">
                            <i class="fas fa-trash"></i>
                            Hapus Gambar Perumahan
                        </a>
                        </td>
                    </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    </table>
                    <br>
            </div>
            
            <div class="panel-footer mx-auto">
            <nav class="page">
                <ul class="pagination">
                    <?php if ($halamanAktif > 1) : ?>
                    <li class="page-item">
                        <a href="?id_perum=<?= $perum["id_perum"];?>&halaman=<?= $halamanAktif - 1 ?>" class="page-link">Previous</a>
                    </li>
                    <?php else : ?>
                    <li class="page-item">
                        <div class="page-link text-dark">Previous</div>
                    </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="?id_perum=<?= $perum["id_perum"];?>&halaman=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                        <?php else : ?>
                        <li class="page-item" aria-current="page">
                            <a class="page-link  text-dark" href="?id_perum=<?= $perum["id_perum"];?>&halaman=<?= $i; ?>""><?= $i; ?></a>
                        </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <li>
                        <a href="?id_perum=<?= $perum["id_perum"];?>&halaman=<?= $halamanAktif + 1 ?>" class="page-link" href="#">Next</a>
                    </li>
                    <?php else : ?>
                    <li class="page-item">
                        <div class="page-link text-dark">Next</div>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            </div>
        <a class="btnTambah btn btn-primary btn-block" href="tambah-gambarperum.php?id_perum=<?= $idPerum ?>">
            Tambah Gambar
        </a>
    </div>
    <br>
</div>
<script>
        function goBack() {
            window.location.href="detail.php?id=<?= $idPerum?>";
        }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>