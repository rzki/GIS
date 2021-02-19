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
    body{
        background-image: linear-gradient(
        rgba(0, 0, 0, 0.75),
        rgba(0, 0, 0, 0.75)
    ), url("../img-gallery/Perum-The Living Hill Residence-6024a02fe8682.jpg");
    background-size: cover;
    }

    h1{
        text-align: center;
    }
    .register{
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%, -50%);
        background: transparent;
        color: white;
    }

    .register input[type = "text"],.register input[type="password"]{
        width: 100%;
        background:none;
        border: 3px solid white;
        padding: 8px 8px;
        box-sizing: border-box;
        border-radius: 20px;
        color: white;
    }

    .register input[type = "text"]:focus, .register input[type="password"]:focus{
        width: 110%;
        background:none;
        border: 3px solid white;
        padding: 8px 8px;
        box-sizing: border-box;
        color: white;
        outline: none;
    }
    
    .register .log-in a:hover{
        color: white;
        background: none;
    }

    button[type="submit"]{
        background: none;
        border-color: white;
        color: white;
        border-radius: 24px;
        width: 100%;
    }

    button[type="submit"]:hover{
        color: white;
        background: #0275d8;
        border-color: #0275d8;
        transition: 0.25s;
    }

    button[type="submit"]:active{
        background: #0275d8;
        border-color: #0275d8;
        color: white;
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
<body>
    <!-- Begin page content -->
    <form method="post" action="" class="register">
    
    <h1>Form Register</h1>
        <div class="form-group row">
            <input type="text" id="nama" name="nama" placeholder="Nama" required autofocus>
        </div>

        <div class="form-group row">
            <input type="text" id="alamat" name="alamat" placeholder="Alamat" required autofocus>
        </div>

        <div class="form-group row">
            <input type="text" id="username" name="username" placeholder="Username" required autofocus>
        </div>

        <div class="form-group row">
            <input type="text" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group row">
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group row">
            <input type="password" id="password2" name="password2" placeholder="Konfirmasi Password" required>
        </div>

        <p class="log-in">Sudah mempunyai akun? <a href="login.php">klik disini</a></p>
        <button type="submit" class="btn btn-lg" name="register">Register</button>
    </form>
</body>
</html>