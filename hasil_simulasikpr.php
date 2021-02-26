<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("components/index-list.php")?>
    <title>Simulasi KPR</title>
    <style>
        .hasilkpr{
            text-align: center;
        }
        .kpr-header{
            margin-top: -75px;
            justify-content: center;
            text-align: center;
        }
        .hasil-simulasi{
            width: 50%;
            margin-right: 0px;
            margin: auto;
        }
        #besar_pinjaman:disabled,#bunga:disabled,#jangka:disabled,#bungaangsuran:disabled,#angsuranpokok:disabled,#angsuran:disabled,#uang_muka:disabled,#total_pinjaman:disabled{
            text-align: center;
            background: none;
        }
        #angsuran,#total_pinjaman{
            text-align: center;
            font-size: large;
        }
        .bunga_bulan,.pinjam_tahun{
            margin-bottom:-10px;
        }
        .besarpinjaman,.bungapertahun,.lamapinjaman,.uangmuka,.totalpinjaman,.bungaangsuran,.angsuranpokok,.angsuranperbulan{
            margin: auto;
        }
        #besar_pinjaman,.besarpinjaman-text{
            font-size: medium;
            text-align: center;
            
        }
        .besarpinjaman{
            margin-bottom: 15px;
        }
        .besarpinjaman-text,.bungapertahun-text,.lamapinjaman-text,.uangmuka-text,.totalpinjaman-text,.bungaangsuran-text,.angsuranpokok-text,.angsuranperbulan-text{
            font-size: medium;
            text-align: center;
            font-weight: bold;
        }
        .biaya,.biaya2{
            margin: 20px 0 20px 0;
        }
        .total{
            margin-top: -20px;
            margin-bottom: -50px;
        }
        .angsuranperbulan-text,#angsuran{
            font-size: x-large;
        }
    </style>
</head>
<body>
    <?php include_once("components/navbar-simulasi.php")?>
 
<?php 

function hitung_kredit($besar_pinjaman, $jangka, $bunga) { 

    $bunga_bulan = ($bunga/12)/100; 
    $pembagi = 1-(1/pow(1+$bunga_bulan,$jangka)); 
    $hasil = $besar_pinjaman/($pembagi/$bunga_bulan); 
    
    return $hasil; 
} 

function rupiah($angka) { 

    $jadi = "Rp ".number_format($angka,2,',','.'); 
    return $jadi; 
} 
    
    $besar_pinjaman = $_POST["besar_pinjaman"]; 
    $bunga = $_POST["bunga"]; 
    $jangka = $_POST["jangka"];
    $dp = $_POST["uang_muka"] / 100; 
    $perbulan = $bunga/12; 
    
    $hutang = $besar_pinjaman;
    $totalpinjaman = $besar_pinjaman-($besar_pinjaman*$dp);
    $anuitas = hitung_kredit($totalpinjaman, $jangka, $bunga);
    $ang_bunga = $hutang*(($bunga/12)/100);
    $ang_pokok = $anuitas-$ang_bunga;
    $hutang = $hutang - $ang_pokok;
    $cicilan = $ang_bunga+$ang_pokok;

    ?>
    <!-- Kalkulator KPR Section -->
<section id="simulasiKPR">
<h1 class="kpr-header">Hasil Simulasi KPR</h1>
        <div class="form-kpr">
            <form action="" method="POST" class="hasil-simulasi">
                <div class="row">
                    <div class="biaya col">
                        <div class="form-group-row">
                            <div class="besarpinjaman col-lg-10">
                                <p class="besarpinjaman-text">HARGA RUMAH</p>
                                <input type="text" class="form-control" name="besar_pinjaman" id="besar_pinjaman" value="<?php echo rupiah($besar_pinjaman);?>" disabled>
                            </div>  
                        </div>
                        <br>
                        <div class="form-group-row">
                            <div class="bungapertahun col-lg-10">
                                <p class="bungapertahun-text">BUNGA/TAHUN (%)</p> 
                                <input type="text" class="form-control" name="bunga" id="bunga" value="<?php echo $bunga;?> % " disabled>
                                <p class="text-muted  text-center">(<?php echo round($bunga/12, 2);?>%/ bulan)</p>
                            </div>
                        </div>
                        </div>
                        <br>
                        <div class="biaya2 col">
                        <div class="form-group-row">
                            <div class="lamapinjaman col-lg-10">
                                <p class="lamapinjaman-text">LAMA PINJAMAN (BULAN)</p>
                                <input type="text" class="form-control" name="jangka" id="jangka" value="<?php echo $jangka;?> Bulan" disabled>
                                <p class="bunga_bulan text-muted  text-center">(<?php echo round($jangka/12, 2);?> tahun)</p>
                            </div>
                        </div>
                        <br>
                        <div class="form-group-row">
                            <div class="uangmuka col-lg-10">
                                <p class="uangmuka-text">UANG MUKA</p>
                                <input type="text" class="form-control" name="uang_muka" id="uang_muka" value="<?php echo rupiah($besar_pinjaman - $totalpinjaman); ?>" disabled>
                                <p class="text-muted text-center"> (<?php echo $dp * 100?>%)</p>
                            </div>
                        </div>
                        </div>
                    </div>
                <br>
                <div class="total col">
                    <div class="form-group-row">
                            <div class="totalpinjaman col-lg-10">
                                <p class="totalpinjaman-text">TOTAL PINJAMAN</p>
                                <input type="text" class="form-control" name="total_pinjaman" id="total_pinjaman" value="<?php echo rupiah($totalpinjaman);?>" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="form-group-row">
                            <div class="bungaangsuran col-lg-10">
                                <p class="bungaangsuran-text">BUNGA ANGSURAN</p>
                                <input type="text" class="form-control" name="bungaangsuran" id="bungaangsuran" value="<?php echo rupiah($ang_bunga); ?>" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="form-group-row">
                            <div class="angsuranpokok col-lg-10">
                                <p class="angsuranpokok-text">ANGSURAN POKOK</p>
                                <input type="text" class="form-control" name="angsuranpokok" id="angsuranpokok" value="<?php echo rupiah($ang_pokok); ?>" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="form-group-row">
                            <div class="angsuranperbulan col-lg-10">
                                <p class="angsuranperbulan-text"> TOTAL ANGSURAN PER BULAN</p>
                                <input type="text" class="form-control" name="angsuran" id="angsuran" value="<?php echo rupiah($cicilan); ?>" disabled autofocus>
                            </div>
                        </div>
                </div>
            </form>
        </div>
</section>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; 2020</p>
    </div>
    <!-- /.container -->
</footer>
<script src="js/search.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom JavaScript for this theme -->
<script src="js/scrolling-nav.js"></script>
<script>
    function goBack(){
        window.history.back();
    }
</script>

