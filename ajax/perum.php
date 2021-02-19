<?php

require '../functions.php';

$keyword = $_GET["keyword"];

//pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master 
            WHERE status = 'Diterima' AND
        (nama_perum LIKE '%$keyword%' OR
        alamat LIKE '%$keyword%' OR
        status LIKE '%$keyword%') LIMIT $awalData, $jumlahDataPerHalaman
        ");
?>
<table class="table table-lg table-hover table-striped table-bordered">
                <tr class="text-center text-white bg-dark">
                    <th>No.</th>
                    <th>Nama Perumahan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($perum as $row) : ?>
                <tr class="show" id="<?= $row["id_perum"]; ?>">
                    <td class="text-center" style="width: 50px;"><?= $i; ?></td>
                    <td class="text-center" data-target="nama_perum" style="width: 200px;"><?= $row["nama_perum"]; ?></td>
                    <td class="text-center" data-target="alamat" style="width: 500px;"><?= $row["alamat"]; ?></td>
                    <td class="text-center" style="text-align: center; width:100px">
                        <a href="detail-perum.php?id=<?= $row['id_perum']?>" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i> Lihat Detail</a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </table>