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
      $_SESSION ["role"] = $hasil ["level"];
    // cek jika user login sebagai admin
      if(password_verify($password, $hasil['password'])){
          if($hasil['level'] == 'admin'){
      // buat session login dan username untuk admin
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
          // alihkan ke halaman dashboard user
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
    <title>Login SIG Perumahan</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css">

    <style>
    /* background */
    body{
      background-image: linear-gradient(
        rgba(0, 0, 0, 0.75),
        rgba(0, 0, 0, 0.75)
      ), url("../img-gallery/Perum-The Living Hill Residence-6024a02fe8682.jpg");
      background-size: cover;
    }

    /* form login */
    .signin{
      position: absolute;
      top:50%;
      left:50%;
      transform: translate(-50%, -50%);
      background: transparent;
      color: white;
    }

    /* header pada form login */
    .signin h2{
      color: white;
      font-weight: 500;
    }

    /* input box username & pass login */
    .signin input[type = "username"],.signin input[type = "password"]{
      border: 0;
      background: none;
      display: block;
      margin: 20px auto;
      text-align: center;
      border: 3px solid white;
      padding: 10px 10px;
      width: 250px;
      outline: none;
      color: white;
      border-radius: 24px;
      transition: 0.25s;
    }

    /* tombol submit & tombol kembali */
    .signin button[type = "submit"]{
      background: none;
      border-radius: 24px;
      margin-top: -10%;
      border-color: white;
      color: white;
    }

    .signin .btn{
      background: none;
      border-radius: 24px;
      margin-top: -10%;
      border-color: white;
      color: white;
    }

    .signin button[type = "submit"], .signin .btn{
      display: inline-block;
      vertical-align: middle;
      width: 35%;
    }

    /* ketika kursor mengarah ke tombol submit dan kembali */
    .signin button[type = "submit"]:active, .signin button[type = "submit"]:focus{
      background: #0275d8;
      border-color: #0275d8;
      cursor: pointer;
      outline: none;
    }

    .signin button[type = "submit"]:hover{
      background: #0275d8;
      border-color: #0275d8;
      transition: 0.25s;
    }

    .signin a:active, .signin a:focus{
      background:#d9534f;
      border-color:#d9534f;
      outline: none;
    }

    .signin a:hover{
      background: #d9534f;
      border-color: #d9534f;
      transition: 0.25s;
    }
    /* teks register */
    .signin .register {
      margin-top: 5px;
      color: white;
    }

    /* teks register ketika di arahkan kursor */
    .signin .register a:hover{
      color: white;
      background: none;
    }
    
    /* teks copyright */
    .signin .copyright{
      color: white;
      margin-top: 10px;
    }
    
    ::placeholder{
        color: gray;
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
      <form action="" method="post" class="signin">
        <img class="mb-1" src="../assets/brand/Kabupaten_Badung.png" alt="" width="190" height="190">
        <h4 class="mb-4">SISTEM INFORMASI GEOGRAFIS <BR> PEMETAAN PERUMAHAN <BR> KABUPATEN BADUNG</h4>
          <input type="username" name ="username" id="username" placeholder="Username" required>
          <input type="password" name ="password" id="password" placeholder="Password" required>
          <br>
        <a href="../index.php" class="btn btn-lg">Back</a>
        <button class="btn btn-lg" type="submit" name="login" >Log In</button>
        <p class="register">Belum mempunyai akun? <a href="register.php">klik disini</a></p>
        <p class="copyright">&copy; 2020</p>
      </form>
  </body>
</html>
