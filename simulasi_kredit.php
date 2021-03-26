
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("components/index-list.php")?>
    <title>Simulasi KPR</title>
	<style>
	#simulasiKPR{
		margin: -50px 0 -50px 0;
	}
	.btnSubmit{
		margin: 20px 200px 0 0;
	}
	.form-simulasi{
		width: 100%;
		margin: 0 0 0 200px;
	}
	.besarpinjaman,.bungapertahun,.lamapinjaman{
		margin-top: 10px;
	}
	</style>
</head>
<body>
    <?php include_once("components/navbar-simulasi.php")?>

<!-- Kalkulator KPR Section -->
<section id="simulasiKPR">
<h1 class="text-bold text-center">Simulasi KPR</h1>
<div class="container-fluid">
	<div class="row">
	<form action="hasil_simulasi.php" method="post" class="form-simulasi">
		<div class="form-group-row">
			<div class="besarpinjaman col-sm-10">
				<label class="col-form-label">Harga Rumah</label>
				<input type="text" class="besar_pinjaman form-control" name="besar_pinjaman" id="besar_pinjaman" placeholder="Masukkan angka tanpa titik">
				<p class="besar-pinjaman text-muted"></p>
			</div>  
		</div>
		<div class="form-group-row">
			<div class="bungapertahun col-sm-10">
				<label class="col-form-label">Bunga/tahun (%)</label> 
				<input type="text" class="bunga form-control" name="bunga" placeholder="Gunakan titik (.) untuk desimal">
			</div>
		</div>
		<div class="form-group-row">
			<div class="lamapinjaman col-sm-10">
				<label class="col-form-label">Lama Pinjaman (bulan)</label>
				<input type="text" class="jangka form-control" name="jangka" placeholder="Masukkan lama pinjaman dalam bulan">
			</div>
		</div>
		<div class="form-group-row">
			<div class="lamapinjaman col-sm-10">
				<label class="col-form-label">Uang Muka (%)</label>
				<input type="text" class="uang_muka form-control" name="uang_muka" placeholder="Masukkan uang muka dalam persen">
			</div>
		</div>
		<br>
		<p class="text-muted">* Perhitungan simulasi diatas menggunakan rumus perhitungan bunga anuitas</p>
			<center><button class="btnSubmit btn btn-lg btn-primary " type="submit">Simulasikan</button></center>
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
</body>
</html>