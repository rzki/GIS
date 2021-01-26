<?php 
// mengaktifkan session php
session_start();

if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
// menghapus semua session
session_unset();
session_destroy();

// mengalihkan halaman ke halaman login
header("location: login.php");
?>