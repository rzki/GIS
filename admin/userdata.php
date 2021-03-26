<?php

require '../functions.php';

$usr = query("SELECT * FROM users WHERE level = 'user'");

?>

<!doctype html>
<html lang="en">
    <!-- head -->
<?php include_once('../components/head.php') ?>
<title>Data Member</title>
<style>
.box-cari{
    margin-bottom: 10px;
    width: 250px;
    text-align: center;
}
</style>
<body>
  <!-- header -->
  <?php include_once('../components/header.php') ?>

  <!-- sidebar -->
  <?php include_once('../components/sidebar-admin.php') ?>
  
  <!-- Main Content -->
  <?php $head = 'Data Member' ?>
  <?php include_once('../components/main-content.php') ?>

        <div class="container" id="container">
            <div class="row">
                <form action="" method="post" class="search-form ml-auto">
                    <input type="text" name="keyword" class="box-cari" placeholder="Masukkan keyword pencarian" id="keyword">
                </form>
                    <div class="table-responsive" id="tabel">
                        <table class="table table-sm table-hover table-striped table-bordered">
                                <tr class="text-center text-white bg-dark">
                                    <th style="text-align: center;">No.</th>
                                    <th style="text-align: center;">Nama Lengkap</th>
                                    <th style="text-align: center;">Alamat</th>
                                    <th style="text-align: center;">Username</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                                <?php $i = 1; ?>
                                <?php foreach ( $usr as $row ) : ?>
                                <tr class="show" id="<?= $row["id_user"];?>">
                                    <td style="text-align: center;"><?= $i;  ?></td>
                                    <td style="text-align: center;"><?= $row["nama"]; ?></td>
                                    <td style="text-align: center;"><?= $row["alamat"]; ?></td>
                                    <td style="text-align: center;"><?= $row["username"]; ?></td>
                                    <td style="text-align: center;"><?= $row["email"]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="password_user.php?id=<?= $row['id_user'] ?>" class="btn btn-outline-dark btn-sm" title="Reset Password Member"><i class="fas fa-key"></i></a>
                                        <a href="delete.php?id=<?= $row['id_user'] ?>" class="btn btn-outline-danger btn-sm" title="Hapus Member" onclick="return confirm('Yakin ingin hapus data pengguna?')">
                                        <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>

    <!-- close main content-->
    <?php include_once('../components/close-main-content.php') ?>
<!-- fungsi pencarian menggunakan ajax -->
<script src="js/search-datauser.js"></script>
<!--  -->
    <script>
        function goBack() {
            window.location.href="home.php";
        }
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/userdata.js"></script>
</html>
