
<!DOCTYPE html>
<html>
<head>
    <title>Simulasi KPR</title>
    <?php include_once("components/index-list.php")?>
    <style>
    .detail-kpr-container{
        margin-top: 30px;
    }
    .detailKpr{
        border: 1px solid black;
        border-radius: 10px;
    }
    .detail1{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .total-angsuran{
        border: 5px solid black;
        border-radius: 10px;
        width: 50%;
        margin: auto;
    }
    .btn-back{
        margin-top: 7%;
        margin-left: 15%;
    }
    </style>
</head>
<body>
<?php include_once("components/navbar-simulasi.php")?>

<?php function hitung_kredit($totalpinjaman, $jangka, $bunga) { 
    $bunga_bulan = ($bunga/12)/100; 
    $pembagi = 1-(1/pow(1+$bunga_bulan,$jangka)); 
    $hasil = $totalpinjaman/($pembagi/$bunga_bulan); 
    return $hasil; 
    } 
    
function rupiah($angka) { 
    $jadi = "Rp ".number_format($angka,2,',','.'); 
    return $jadi; 
    } 
    $besar_pinjaman = $_POST["besar_pinjaman"]; 
    $bunga = $_POST["bunga"]; 
    $jangka = $_POST["jangka"];
    $dp = $_POST["uang_muka"]/100;
    $perbulan = $bunga/12;
    $totalpinjaman = $besar_pinjaman-($besar_pinjaman*$dp); 
    ?>

<button class="btn-back btn btn-lg border-dark" onclick="goBack()"><i class="fas fa-angle-left"></i>Kembali</button>
<div class="headerHasil">
    <h1 class="text-center">Hasil Simulasi KPR</h1>
</div>
<div class="detail-kpr-container container">
    <div class="detailKpr row">
        <div class="detail1 col">
            <p class="text-center font-weight-bold"> Jumlah Pinjaman</p>
            <p class="text-center"> <?php echo rupiah($besar_pinjaman);?> </p>
            <p class="text-center font-weight-bold"> Uang Muka</p>
            <p class="text-center"> <?php echo ($dp*100);?> %</p>
            <p class="text-center font-weight-bold"> Jangka waktu </p>
            <p class="text-center"> <?php echo $jangka;?> Bulan </p>
            <p class="text-center font-weight-bold"> Suku Bunga </p>
            <p class="text-center"> <?php echo $bunga;?>% </p>
            <p class="text-center font-weight-bold"> Total Pinjaman</p>
            <p class="text-center"> <?php echo rupiah($totalpinjaman);?> </p>
        </div>
        <div class=" detail2 col my-auto">
            <p class="text-center font-weight-bold" style="font-size:large"> Angsuran Pokok </p>
            <p class="text-center mb-5" style="font-size:large"> <?php echo rupiah(hitung_kredit($totalpinjaman, $jangka, $bunga)-$totalpinjaman*(($bunga/12)/100));?> </p>
            <p class="text-center font-weight-bold" style="font-size:large"> Angsuran Bunga </p>
            <p class="text-center mb-5" style="font-size:large"> <?php echo rupiah($totalpinjaman*(($bunga/12)/100));?> </p>
            <div class="total-angsuran">
                <p class="text-center font-weight-bold mt-2" style="font-size:large"> Total Angsuran </p>
                <p class="text-center mb-2" style="font-size:large"> <?php echo rupiah($totalpinjaman*(($bunga/12)/100) + hitung_kredit($totalpinjaman, $jangka, $bunga)-$totalpinjaman*(($bunga/12)/100));?> </p>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="headerTabel mx-auto">
            <h2 class="text-center">Tabel Angsuran</h2>
            <hr>
        </div>
    <table class="table table-sm table-hover table-striped table-bordered mx-auto">
        <tr class="text-center text-white bg-dark">
        <th>Bulan</th>
        <th>Angsuran Pokok</th>
        <th>Angsuran Bunga</th>
        <th>Total Angsuran</th>
        <th>Sisa Hutang</th>
        </tr>
        <tr class="text-center">
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td><b><?php echo rupiah($totalpinjaman);?></b></td>
        </tr>
        
        <?php
        $no = 0;
        $hutang = $totalpinjaman;
        do {
            $no++;
        $anuitas = hitung_kredit($totalpinjaman, $jangka, $bunga);
        $ang_bunga = $hutang*(($bunga/12)/100);
        $ang_pokok = $anuitas-$ang_bunga;
        $hutang = $hutang - $ang_pokok;
        $cicilan = $ang_bunga+$ang_pokok;
        
        echo "
        <tr class='text-center'>";
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
        
    </div>
</div>
<script>
    function goBack() {
        window.location.href="simulasi_kredit.php";
    }
</script>
</body>
</html>