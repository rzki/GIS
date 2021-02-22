<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("components/index-list.php")?>
    <title>Simulasi KPR</title>
    <style>
        .hasilkpr{
            margin: auto;
            text-align: center;
        }
        .hasil-simulasi{
            width: 50%;
            margin: 20px 0 0 450px;
        }
        #besar_pinjaman:disabled,#bunga:disabled,#jangka:disabled,#angsuran:disabled{
            text-align: center;
            background: none;
        }
        #angsuran{
            text-align: center;
            font-size: xx-large;
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
    $perbulan = $bunga/12; 
    
    $hutang = $besar_pinjaman;
    $anuitas = hitung_kredit($besar_pinjaman, $jangka, $bunga);
    $ang_bunga = $hutang*(($bunga/12)/100);
    $ang_pokok = $anuitas-$ang_bunga;
    $hutang = $hutang - $ang_pokok;
    $cicilan = $ang_bunga+$ang_pokok;

    ?>
    <!-- Kalkulator KPR Section -->
<section id="simulasiKPR">
<h1 class="kpr-header text-center">Hasil Simulasi KPR</h1>
    <div class="hasilkpr container-fluid">
        <div class="row">
            <form action="" method="POST" class="hasil-simulasi">
                <div class="form-group-row">
                    <div class="besarpinjaman col-sm-10">
                        <label class="col-form-label">BESAR PINJAMAN</label>
                        <input type="text" class="form-control" name="besar_pinjaman" id="besar_pinjaman" value="<?php echo rupiah($besar_pinjaman);?>" placeholder="Masukkan angka tanpa titik" disabled>
                    </div>  
                </div>
                <br>
                <div class="form-group-row">
                    <div class="bungapertahun col-sm-10">
                        <label class="col-form-label">BUNGA/TAHUN (%)</label> 
                        <input type="text" class="form-control" name="bunga" id="bunga" value="<?php echo $bunga;?> % " placeholder="Gunakan titik (.) untuk desimal" disabled>
                    </div>
                </div>
                <br>
                <div class="form-group-row">
                    <div class="lamapinjaman col-sm-10">
                        <label class="col-form-label">LAMA PINJAMAN (BULAN)</label>
                        <input type="text" class="form-control" name="jangka" id="jangka" value="<?php echo $jangka;?> Bulan" placeholder="Masukkan lama pinjaman dalam bulan" disabled>
                    </div>
                </div>
                <br>
                <div class="form-group-row">
                    <div class="angsuran col-sm-10">
                        <label class="col-form-label">ANGSURAN PER BULAN</label>
                        <input type="text" class="form-control" name="angsuran" id="angsuran" value="<?php echo rupiah($cicilan); ?>" disabled>
                    </div>
                </div>
            </form>
        </div>
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

