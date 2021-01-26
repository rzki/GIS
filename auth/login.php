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

    if( isset($_POST['login'])){

    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    $queryCek = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
  // menghitung jumlah data yang ditemukan
    $result = mysqli_query($conn, $queryCek);

    if ($username == "" || $password == "") {
      echo '
          <script>
              alert("isi username atau password dengan benar!");
              window.location.href="login.php"
          </script>
      ';
      return false;
    }

  // cek apakah username dan password di temukan pada database
    if(mysqli_num_rows($result) > 0){
      $hasil = mysqli_fetch_assoc($result);
      $_SESSION ["userID"] = $hasil["id_user"];
      $_SESSION ["uname"] = $hasil ["username"];
      $_SESSION ["name"] = $hasil ["nama"];
    // cek jika user login sebagai admin
      if(password_verify($password, $hasil['password'])){
          if($hasil['level'] == 'admin'){
      // buat session login dan username
          $_SESSION['user'] = $hasil;
          $_SESSION['login'] = true;
          $_SESSION['level'] = 'admin';
      // alihkan ke halaman dashboard admin
          header('Location: ../admin/home.php');
    // cek jika user login sebagai user
      } else if($hasil['level'] == 'user'){
          $_SESSION['user'] = $hasil;
          $_SESSION['login'] = true;
          $_SESSION['level'] = 'user';
          header('Location: ../user/home.php');
      } 
    } else {
      echo '
          <script>
              alert("Username / password salah!");
              window.location.href="login.php"
          </script>
      ';
      return false;
    }
      } else {
        echo '
            <script>
                alert("Username / password salah!");
                window.location.href="login.php"
            </script>
        ';
      return false;
    }

  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css">

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
    <link href="css/login.css" rel="stylesheet">
  </head>
  <body class="text-center">

    <form action="" method="post" class="form-signin">
  <img class="mb-4" src="../assets/brand/Kabupaten_Badung.png" alt="" width="192" height="192">
  <h1 class="h4 mb-3 font-weight-bold">SISTEM INFORMASI GEOGRAFIS <BR> PEMETAAN PERUMAHAN <BR> KABUPATEN BADUNG</h1>
  <label for="username" class="sr-only">Username</label>
  <input type="username" name ="username" id="username" class="form-control" placeholder="Username" required>
  <label for="password" class="sr-only">Password</label>
  <input type="password" name ="password" id="password" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Log in</button>
  <p>Belum mempunyai akun? <a href="register.php">klik disini</a></p>
  <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
</form>
</body>
</html>
