<?php

require '../../functions.php';

$keyword = $_GET["keyword"];

//pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM users"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$usr = query("SELECT * FROM users
            WHERE level = 'user' AND
            (nama LIKE '%$keyword%' OR
            alamat LIKE '%$keyword%' OR
            username LIKE '%$keyword%' OR
            email LIKE '%$keyword%') LIMIT $awalData, $jumlahDataPerHalaman
        ");
?>
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
        <td style="text-align: center;"><?= $i; ?></td>
        <td style="text-align: center;"><?= $row["nama"]; ?></td>
        <td style="text-align: center;"><?= $row["alamat"]; ?></td>
        <td style="text-align: center;"><?= $row["username"]; ?></td>
        <td style="text-align: center;"><?= $row["email"]; ?></td>
        <td style="text-align: center;">
            <a href="userdata-edit.php?id=<?= $row['id_user'] ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit" title="Edit Biodata Member"></i></a>
            <a href="password_user.php?id=<?= $row['id_user'] ?>" class="btn btn-outline-dark btn-sm" title="Ubah Password Member"><i class="fas fa-key"></i></a>
            <a href="delete.php?id=<?= $row['id_user'] ?>" class="btn btn-outline-danger btn-sm" title="Hapus Member" onclick="return confirm('Yakin ingin hapus data pengguna?')">
            <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</thead>
</table>