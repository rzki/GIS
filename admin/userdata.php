<?php

require '../functions.php';

$usr = query("SELECT * FROM users WHERE level = 'user'");

?>

<!doctype html>
<html lang="en">
    <!-- head -->
<?php include_once('../components/head-userdata.php') ?>
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
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped table-bordered">
                                <tr>
                                    <th style="text-align: center;">No.</th>
                                    <th style="text-align: center;">Nama Lengkap</th>
                                    <th style="text-align: center;">Alamat</th>
                                    <th style="text-align: center;">Username</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                                <?php $i = 1; ?>
                                <?php foreach ( $usr as $row ) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $i ?></td>
                                    <td style="text-align: center;"><?= $row["nama"]; ?></td>
                                    <td style="text-align: center;"><?= $row["alamat"]; ?></td>
                                    <td style="text-align: center;"><?= $row["username"]; ?></td>
                                    <td style="text-align: center;"><?= $row["email"]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="userdata-edit.php?id=<?= $row['id_user'] ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="delete.php?id=<?= $row['id_user'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin hapus data pengguna?')">
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
        </div>

    <!-- close main content-->
    <?php include_once('../components/close-main-content.php') ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
