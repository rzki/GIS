<?php
session_start();
require '../../functions.php';

$keyword = $_GET["keyword"];
$idUser = $_SESSION["userID"];

//pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM perumahan_master"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$perum = query("SELECT * FROM perumahan_master 
            WHERE id_user = '$idUser' AND 
        (nama_perum LIKE '%$keyword%' OR
        alamat LIKE '%$keyword%' OR
        status LIKE '%$keyword%') LIMIT $awalData, $jumlahDataPerHalaman
        ");
?>
<table class="table table-sm table-hover table-striped table-bordered">
                        <tr class="text-center text-white bg-dark">
                            <th>No.</th>
                            <th>Nama Perumahan</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        <?php $i = 1; ?>
                        <?php foreach ($perum as $row) : ?>
                        <tr class="show text-center" id="<?= $row["id_perum"]; ?>">
                            <td data-target="id_perum"><?= $i; ?></td>
                            <td data-target="nama_perum"><?= $row["nama_perum"]; ?></td>
                            <td data-target="alamat"><?= $row["alamat"]; ?></td>
                            <td data-target="status"><?= $row["status"]; ?></td>
                            <td>
                                <a href="detail.php?id=<?= $row['id_perum']?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail Perumahan"><i class="fas fa-info"></i></a>
                                <a href="edit-data.php?id=<?= $row["id_perum"]; ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Perumahan"><i class="fas fa-edit"></i></a>
                                <a href="delete_perum.php?id=<?= $row["id_perum"]; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Perumahan" onclick="return confirm('Yakin ingin hapus data perumahan?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
