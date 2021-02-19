<?php

require '../../functions.php';

$keyword = $_GET["keyword"];

//pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master 
            WHERE
        (nama_perum LIKE '%$keyword%' OR
        alamat LIKE '%$keyword%' OR
        status LIKE '%$keyword%') LIMIT $awalData, $jumlahDataPerHalaman
        ");
?>
<table class="table table-sm table-hover table-striped table-bordered">
                <tr class="text-center text-white bg-dark">
                    <th>No</th>
                    <th>Nama Perumahan</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($perum as $row) : ?>
                <tr class="show" id="<?= $row["id_perum"]; ?>">
                    <td class="text-center"><?= $i; ?></td>
                    <td class="text-center" data-target="nama_perum" style="width: 300px;"><?= $row["nama_perum"]; ?></td>
                    <td class="text-center" data-target="alamat" ><?= $row["alamat"]; ?></td>
                    <td class="text-center" data-target="status"><?= $row["status"]; ?></td>
                    <td class="text-center" >
                        <a href="detail.php?id=<?= $row['id_perum']?>" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i></a>
                        <a href="editdataperum.php?id=<?= $row['id_perum'] ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data Perumahan"><i class="fas fa-edit"></i></a>
                        <a href="delete_perum.php?id=<?= $row['id_perum'] ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Perumahan" onclick="return confirm('Yakin ingin hapus data perumahan?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </table>