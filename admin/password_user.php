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
$idUser = $_GET["id"];
$user = query("SELECT * FROM users WHERE id_user = '$idUser'")[0];

if(isset($_POST['register'])){
    $newPassword = $_POST['password'];
    $repeatNewPassword = $_POST['password2'];
    // cek konfirmasi password
    if ($newPassword != $repeatNewPassword) {
        echo '
            <script>
                alert("Konfirmasi password tidak sesuai!");
                window.location.href="userdata.php"
            </script>
        ';
        return false;
    } 

    $passwordUpdate = password_hash($newPassword, PASSWORD_DEFAULT);
    $result = manipulateData("UPDATE users SET
                password = '$passwordUpdate' WHERE id_user = $idUser");

    if ($result > 0) {
        echo '
            <script>
                alert("Berhasil update password!");
                window.location.href="home.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal update password!");
                window.location.href="password.php"
            </script>
        ';
    }
}
    
?>

<!doctype html>
<html lang="en">
    <!-- head -->
    <?php include_once('../components/head.php') ?>
    <title>Pengaturan Akun</title>
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
    <?php $head = 'Reset Password Member' ?>    
    <?php include_once('../components/main-content.php') ?>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $user["id_user"]; ?>">

    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" minlength="8" maxlength="16" placeholder="Password Baru">
                <p class="min text-muted">(Minimal 8 karakter)</p>
            </div>
    </div>

    <div class="pwd2 form-group row">
        <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password2" name="password2" minlength="8" maxlength="16" placeholder="Konfirmasi Password Baru">
            </div>
    </div>

    <div class="form-group row text-center">
        <div class="col-sm-10">
            <a class="btn btn-dark" href="home.php">Back</a>
            <button type="submit" class="btn btn-primary" name="register" onclick="return confirm('Yakin ingin update password member?')">Update Password</button>
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