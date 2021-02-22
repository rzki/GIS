<!DOCTYPE html>
<html>
<head>
    <title>Simulasi Anuitas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 
     
<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cstyle%3E%0A%0A%09%09.zebra-table%7B%0A%0A%09box-shadow%3A%200%202px%203px%201px%20%23ddd%3B%0A%0A%09overflow%3Ahidden%3B%0A%0A%09border%3A10px%20solid%20%23fff%3B%0A%0A%09border-collapse%3A%20collapse%3B%0A%0A%7D%0A%0A%0A%0A.zebra-table%20th%2C.zebra-table%20td%7B%0A%0A%09vertical-align%3A%20top%3B%0A%0A%09padding%3A%208px%205px%3B%0A%0A%09text-align%3A%20left%3B%0A%0A%09margin%3A%200%3B%0A%0A%7D%0A%0A.zebra-table%20tbody%20th%7B%0A%0A%09background%3A%20%2334495E%3B%0A%0A%09color%3A%20%23fff%3B%0A%0A%0A%0A%7D%0A%0A.zebra-table%20tbody%20tr%3Anth-child(odd)%7B%0A%0A%20%20%09background%3A%23DADFE1%3B%0A%0A%7D%0A%0A%09%3C%2Fstyle%3E" data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="&lt;style&gt;" title="&lt;style&gt;" />
 
 
</head>
<body>
 
<?php function hitung_kredit($besar_pinjaman, $jangka, $bunga) { $bunga_bulan = ($bunga/12)/100; $pembagi = 1-(1/pow(1+$bunga_bulan,$jangka)); $hasil = $besar_pinjaman/($pembagi/$bunga_bulan); return $hasil; } function rupiah($angka) { $jadi = "Rp ".number_format($angka,2,',','.'); return $jadi; } $besar_pinjaman = $_POST["besar_pinjaman"]; $bunga = $_POST["bunga"]; $jangka = $_POST["jangka"]; $perbulan = $bunga/12; ?>
 
<pre>
    Jumlah Pinjaman         = <?php echo rupiah($besar_pinjaman);?>
    Jangka waktu            = <?php echo $jangka;?> Bulan
    Suku Bunga          = <?php echo $bunga;?>% 
  
</pre>
<table class="table zebra-table">
<tr>
<th>Angsuran ke -</th>
<th>Angsuran Pokok</th>
<th>Angsuran Bunga</th>
<th>Total Angsuran</th>
<th>Sisa Hutang</th>
</tr>
<tr>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td><b><?php echo rupiah($besar_pinjaman);?></b></td>
</tr>
 
<?php
$no = 0;
$hutang = $besar_pinjaman;
do {
    $no++;
$anuitas = hitung_kredit($besar_pinjaman, $jangka, $bunga);
$ang_bunga = $hutang*(($bunga/12)/100);
$ang_pokok = $anuitas-$ang_bunga;
$hutang = $hutang - $ang_pokok;
$cicilan = $ang_bunga+$ang_pokok;
 
echo "
<tr>";
echo "
<td>".$no."</td>
 
";
echo "
<td>".rupiah($ang_pokok)."</td>
 
";
echo "
<td>".rupiah($ang_bunga)."</td>
 
";
echo "
<td>".rupiah($cicilan)."</td>
 
";
echo "
<td>".rupiah($hutang)."</td>
 
";
echo "</tr>
 
";
} while ($no < $jangka); ?>
</table>
 
</body></html><span data-mce-type="bookmark" style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" class="mce_SELRES_start"></span>