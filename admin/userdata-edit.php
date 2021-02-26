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

//ambil data di URL
$idUser = $_GET['id'];

$user = getData("SELECT * FROM users WHERE id_user = $idUser");

if (isset($_POST['register'])) {
    $nama        = $_POST['nama'];
    $alamat      = $_POST['alamat'];
    $username    = $_POST['username'];
    $email       = $_POST['email'];

    $result = manipulateData("UPDATE users SET
                nama = '$nama',
                alamat = '$alamat',
                username = '$username',
                email = '$email'
                WHERE id_user = $idUser");

    if ($result > 0) {
        echo '
            <script>
                alert("Berhasil update data!");
                window.location.href="userdata.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal update data!");
                window.location.href="userdata.php"
            </script>
        ';
    }
}
?>

<!doctype html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/head.php') ?>
    <title>Edit Data Member</title>
    <style>
    .pwd2{
        margin-top: -20px;
    }
    .min{
        margin-top: 2px;
        margin-left: px;
    }

    </style>
<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

<!-- sidebar -->
<?php $currentPage = 'home' ?>
<?php include_once('../components/sidebar-admin.php') ?>

    <!-- Begin page content -->
    <?php $head = 'Pengaturan Akun Member' ?>    
    <?php include_once('../components/main-content.php') ?>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $user["id_user"]; ?>">

    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                    value="<?= $user["nama"]; ?>">
            </div>
    </div>

    <div class="form-group row">
        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                    value="<?= $user["alamat"]; ?>">
            </div>
    </div>

    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                    value="<?= $user["username"]; ?>">
            </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                    value="<?= $user["email"]; ?>">
            </div>
    </div>

    <div class="form-group row text-center">
        <div class="col-sm-10">
            <a class="btn btn-secondary" href="userdata.php">Back</a>
            <button type="submit" class="btn btn-primary" name="register">Update Data</button>
        </div>
    </div>
</form>
</main>
<script>
        function goBack() {
            window.location.href="userdata.php";
        }
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="js/home.js"></script></body>
</body>
</html>