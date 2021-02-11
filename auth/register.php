<?php

session_start();
require '../functions.php';

if (isset($_SESSION['login'])) {
    switch ($_SESSION['level']) {
        case 'admin' : 
            header('Location: ../admin/home.php');
        break;
        case 'user' : 
            header('Location: ../user/home.php');
        break;
    }
} 

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST['register'])) {
    $nama = trim(htmlspecialchars($_POST['nama']));
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $passwordConfirm = trim(htmlspecialchars($_POST['password2']));

    if ($nama == "" || $alamat == "" || $username == "" || $email == "" || $password == "" || $passwordConfirm == "") {
        echo '
            <script>
                alert("Harap isi data yang benar!");
                window.location.href="register.php"
            </script>
        ';
        return false;
    }

    $queryCek = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $queryCek);

    // cek username atau email apakah sudah digunakan atau belum
    if(mysqli_num_rows($result) > 0){
        echo '
                <script>
                alert("Username / Email telah digunakan!");
                window.location.href="register.php"
                </script>
        ';
        return false;
    }
    
    // cek konfirmasi password
    if($password != $passwordConfirm){
        echo '
            <script>
                alert("Konfirmasi password tidak sesuai!");
                window.location.href="register.php"
                </script>
        ';
        return false;
    }

    // enkripsi password ketika register
    $password = password_hash($password, PASSWORD_DEFAULT);
    $register = "INSERT INTO users(nama, alamat, username, email, password) VALUES ('$nama', '$alamat', '$username', '$email', '$password')";
    $resultReg = mysqli_query($conn, $register);

    if ($resultReg == true) {
        echo '
            <script>
                alert("Registrasi berhasil!");
                window.location.href="login.php"
            </script>
        ';
    }
}
?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Register Member SIG Perumahan</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sticky-footer/">

    <!-- Bootstrap core CSS -->
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    <!-- Begin page content -->
<main role="main" class="flex-shrink-0">
<div class="container">
    <h1 class="mt-5 text-center" >Form Register</h1>
    <form method="post" action="">

        <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required autofocus>
                </div>
        </div>

        <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required autofocus>
                </div>
        </div>

        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
        </div>

        <div class="form-group row">
            <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" required>
                </div>
        </div>

        <p class="text-center">Sudah mempunyai akun? <a href="login.php">klik disini</a></p>
        <button type="submit" class="btn btn-primary form-control" name="register">Register</button>
        </div>
</div>
</form>
</div>
</main>
</body>
</html>