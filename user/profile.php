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

//ambil data di URL
$idUser = $usr['id_user'];

$user = getData("SELECT * FROM users WHERE id_user = $idUser");;


if (isset($_POST['register'])) {
    $nama        = $_POST['nama'];
    $alamat      = $_POST['alamat'];

    $result = manipulateData("UPDATE users SET
                nama = '$nama',
                alamat = '$alamat'
                WHERE id_user = $idUser");

    if ($result > 0) {
        echo '
            <script>
                alert("Berhasil update profil!");
                window.location.href="profile.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal update profil!");
                window.location.href="profile.php"
            </script>
        ';
    }
}
?>

<!doctype html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/head.php') ?>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

<!-- sidebar -->
<?php $currentPage = 'home' ?>
<?php include_once('../components/sidebar-user.php') ?>

    <!-- Begin page content -->
    <?php $head = 'Pengaturan Profil' ?>    
    <?php include_once('../components/main-content.php') ?>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $usr["id_user"]; ?>">

    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required
                    value="<?= $user["nama"]; ?>">
            </div>
    </div>

    <div class="form-group row">
        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Email" required
                    value="<?= $user["alamat"]; ?>">
            </div>
    </div>

    <div class="form-group row text-center">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" name="register">Update Profil</button>
        </div>
    </div>
</form>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="js/home.js"></script></body>
</body>
</html>