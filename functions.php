<?php
//koneksi ke database
$conn = mysqli_connect('localhost:3306', 'root', '', 'sig-perum');

function query($query) {
    error_reporting(0);
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function getData($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function manipulateData($query) {
    global $conn;
    return mysqli_query($conn, $query);
}

function tambahdataperum($data) {
    // //agar tidak menampilkan error
    // error_reporting(0);
    global $conn;
    
    $namaPerum      = htmlspecialchars ($data["nama_perum"]);
    $alamat         = htmlspecialchars ($data["alamat"]);
    $koordinat      = htmlspecialchars ($data["koordinat"]);
    $noTelp         = htmlspecialchars ($data["no_telp"]);
    $idUser         = $_SESSION["userID"];
    $status         = htmlspecialchars ($data["status"]);

    // ambil data perumahan
    $queryUser = "SELECT * FROM users WHERE id_user = '$idUser'";
    $resultUser = mysqli_query($conn, $queryUser);
    $dataUser = mysqli_fetch_assoc($resultUser);
    $idUser= $dataUser['id_user'];

    $queryPerum         =   "   INSERT INTO perumahan_master
                                    VALUES
                                    ('', '$namaPerum', '$alamat', '$koordinat', '$noTelp', '$idUser', '$status')";
    mysqli_query($conn, $queryPerum);
    
    return mysqli_affected_rows($conn);
}

function tambahdataperum_member($data) {
    //agar tidak menampilkan error
    error_reporting(0);
    global $conn;
    
    $namaPerum      = htmlspecialchars ($data["nama_perum"]);
    $alamat         = htmlspecialchars ($data["alamat"]);
    $koordinat      = htmlspecialchars ($data["koordinat"]);
    $noTelp         = htmlspecialchars ($data["no_telp"]);
    $idUser         = $_SESSION["userID"];
    $status         = htmlspecialchars ($data["status"]);

    // ambil data perumahan
    $queryUser = "SELECT * FROM users WHERE id_user = '$idUser'";
    $resultUser = mysqli_query($conn, $queryUser);
    $dataUser = mysqli_fetch_assoc($resultUser);
    $idUser= $dataUser['id_user'];

    $queryPerum         =   "   INSERT INTO perumahan_master
                                    VALUES
                                    ('', '$namaPerum', '$alamat', '$koordinat', '$noTelp', '$idUser', '$status')";
    mysqli_query($conn, $queryPerum);

return mysqli_affected_rows($conn);
}

function tambahtipe($data){
    global $conn;
    
    $namaPerum      = $data["nama_perum"];
    $tipeRumah      = htmlspecialchars ($data["tipe_rumah"]);
    $luasBangunan   = htmlspecialchars ($data["luas_bangunan"]);
    $luasTanah      = htmlspecialchars ($data["luas_tanah"]);
    $spek           = htmlspecialchars ($data["spesifikasi"]);
    $listrik        = htmlspecialchars ($data["daya_listrik"]);
    $harga          = htmlspecialchars ($data["harga"]);
    $idPerum        = $data["id"];
    $idUser         = $_SESSION["userID"];

    // ambil id dan nama perumahan dari tabel data perumahan
    $queryTipe = "SELECT * FROM perumahan_master WHERE id_perum = '$idPerum'";
    $resultTipe = mysqli_query($conn, $queryTipe);
    $dataTipe = mysqli_fetch_assoc($resultTipe);
    $idPerum = $dataTipe['id_perum'];
    $namaPerum = $dataTipe['nama_perum'];

    $queryTipe         =   "   INSERT INTO tiperumah_master
                                VALUES
                                ('', '$namaPerum' ,'$tipeRumah', '$luasBangunan', '$luasTanah',
                                '$spek', '$listrik','$harga', '$idPerum', '$idUser')";
    mysqli_query($conn, $queryTipe);
    
    return mysqli_affected_rows($conn);
}

function tambahgambarperum(){
    global $conn;

    $gambarperum = uploadperum();
    if(!$gambarperum){
        return false;
    }

    return mysqli_affected_rows($conn);
}

function tambahgambartipe(){
    global $conn;

    $gambartipe = uploadtipe();
    if(!$gambartipe){
        return false;
    }

    return mysqli_affected_rows($conn);
}

function ubahdataperum($data) {
    global $conn;
    $idPerum        = $data["id"];
    $namaPerum      = htmlspecialchars ($data["nama_perum"]);
    $alamat         = htmlspecialchars ($data["alamat"]);
    $koordinat      = ($data["koordinat"]);
    $noTelp         = htmlspecialchars ($data["no_telp"]);
    $status         = htmlspecialchars ($data["status"]);

    $queryPerum  =   "UPDATE perumahan_master SET 
                    nama_perum = '$namaPerum',
                    alamat = '$alamat',
                    koordinat = '$koordinat',
                    no_telp = '$noTelp',
                    status = '$status'
                WHERE id_perum = $idPerum";
    mysqli_query($conn, $queryPerum);

    return mysqli_affected_rows($conn);
}

function ubahdataperum_member($data) {
    global $conn;
    $idPerum        = $data["id"];
    $namaPerum      = htmlspecialchars ($data["nama_perum"]);
    $alamat         = htmlspecialchars ($data["alamat"]);
    $koordinat      = ($data["koordinat"]);

    $queryPerum  =   "UPDATE perumahan_master SET 
                    nama_perum = '$namaPerum',
                    alamat = '$alamat',
                    koordinat = '$koordinat'
                WHERE id_perum = $idPerum";
    mysqli_query($conn, $queryPerum);

    return mysqli_affected_rows($conn);
}

function ubahtiperumah($data) {
    global $conn;

    $idTipe         = $data["id"];
    $tipeRumah      = htmlspecialchars ($data["tipe_rumah"]);
    $luasBangunan   = htmlspecialchars ($data["luas_bangunan"]);
    $luasTanah      = htmlspecialchars ($data["luas_tanah"]);
    $spek           = htmlspecialchars ($data["spesifikasi"]);
    $listrik        = htmlspecialchars ($data["daya_listrik"]);
    $harga          = htmlspecialchars ($data["harga"]);

    $queryTipe =   "UPDATE tiperumah_master SET
                    tipe_rumah ='$tipeRumah',
                    luas_bangunan = '$luasBangunan',
                    luas_tanah = '$luasTanah',
                    spesifikasi = '$spek',
                    daya_listrik = '$listrik',
                    harga = '$harga'
                WHERE id_tipe = $idTipe";
    mysqli_query($conn, $queryTipe);
    
    return mysqli_affected_rows($conn);
}

function ubahgambarperum($data){
    global $conn;

    $gambarLama     = htmlspecialchars ($data["gambarLama"]);
    $gambar         = tambahgambar_perum();
    //cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] == 4){
        $gambar = $gambarLama;
    } else {
        $gambar;
    }
    return mysqli_affected_rows($conn);
}

function ubahgambartipe($data) {
    global $conn;

    $gambarLama     = htmlspecialchars ($data["gambarLama"]);
    //cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] == 4){
        $gambar = $gambarLama;
    } else {
        $gambar = uploadtipe();
    }
}

function uploadperum() {
    global $conn;

    $sizeGambar = 10 * 1024 * 1024;
    $idPerum =  mysqli_insert_id($conn);
    foreach($_FILES["gambar_perum"]["tmp_name"] as $x=>$tmp_name){
    $namaFile = $_FILES['gambar_perum']['name'][$x];
    $ukuranFile = $_FILES['gambar_perum']['size'][$x];
    $tmpName = $_FILES['gambar_perum']['tmp_name'][$x];
    $tipe_file = pathinfo($namaFile, PATHINFO_EXTENSION);
    $error = $_FILES['gambar_perum']['error'];

    // cek apakah gambar sudah di upload
    if ($error == 4){
        echo "
            <script>
                alert('Gambar belum dimasukkan!') 
            </script>
        ";
    return false;
    }

    $ekstensiGambarValid = array('jpg', 'jpeg', 'png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo " 
            <script>
                alert('Format gambar tidak didukung!')
            </script>";
        return false;
    }

    if($ukuranFile > $sizeGambar){
        echo " 
            <script>
                alert('Ukuran gambar terlalu besar!')
            </script>";
        return false;
    }   

    //ambil nama perumahan untuk dimasukkan sebagai nama gambar dari table tiperumah
    $namaPerum   = $_POST["nama_perum"];

    // jika lolos pengecekan, gambar siap di upload
    // generate nama baru
    $namaFileBaru  = 'Perum'.'-'. $namaPerum . '-'. $x;
    $namaFileBaru .= '.';
    $namaFileBaru .= $tipe_file;

    move_uploaded_file($tmpName, '../img-perum/' . $namaFileBaru);
    $queryGambar      =   "   INSERT INTO perum_gambar
                                VALUES
                                ('', '$namaFileBaru', '$idPerum')";
    mysqli_query($conn, $queryGambar);
    }
    return $namaFileBaru;
}

function tambahgambar_perum() {
    global $conn;

    $sizeGambar = 10 * 1024 * 1024;
    $idperum     = $_POST["id"];
    foreach($_FILES["gambar_perum"]["tmp_name"] as $x=>$tmp_name){
    $namaFile = $_FILES['gambar_perum']['name'][$x];
    $ukuranFile = $_FILES['gambar_perum']['size'][$x];
    $tmpName = $_FILES['gambar_perum']['tmp_name'][$x];
    $tipe_file = pathinfo($namaFile, PATHINFO_EXTENSION);
    $error = $_FILES['gambar_perum']['error'];

    // cek apakah gambar sudah di upload
    if ($error == 4){
        echo "
            <script>
                alert('Gambar belum dimasukkan!') 
            </script>
        ";
    return false;
    }

    $ekstensiGambarValid = array('jpg', 'jpeg', 'png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo " 
            <script>
                alert('Format gambar tidak didukung!')
            </script>";
        return false;
    }

    if($ukuranFile > $sizeGambar){
        echo " 
            <script>
                alert('Ukuran gambar terlalu besar!')
            </script>";
        return false;
    }   

    //ambil nama perumahan untuk dimasukkan sebagai nama gambar dari table tiperumah
    $getPerum    = query("SELECT * FROM perumahan_master WHERE id_perum = $idperum")[0];
    $namaPerum   = $getPerum["nama_perum"];

    // jika lolos pengecekan, gambar siap di upload
    // generate nama baru
    $namaFileBaru  = 'Perum'.'-'. $namaPerum . '-'. $x;
    $namaFileBaru .= '.';
    $namaFileBaru .= $tipe_file;

    move_uploaded_file($tmpName, '../img-perum/' . $namaFileBaru);
    $queryGambar      =   "   INSERT INTO perum_gambar
                                VALUES
                                ('', '$namaFileBaru', '$idperum')";
    mysqli_query($conn, $queryGambar);
    }
    return $namaFileBaru;
}

function uploadtipe() {
    global $conn;

    $sizeGambar = 10 * 1024 * 1024;
    $idPerum = $_POST["id"];
    $idTipe =  mysqli_insert_id($conn);
    foreach($_FILES["gambar_tipe"]["tmp_name"] as $y=>$tmp_name){
    $namaFile = $_FILES['gambar_tipe']['name'][$y];
    $ukuranFile = $_FILES['gambar_tipe']['size'][$y];
    $tmpName = $_FILES['gambar_tipe']['tmp_name'][$y];
    $tipe_file = pathinfo($namaFile, PATHINFO_EXTENSION);
    $error = $_FILES['gambar_tipe']['error'];

    // cek apakah gambar sudah di upload
    if ($error == 4){
        echo "
            <script>
                alert('Gambar belum dimasukkan!') 
            </script>
        ";
    return false;
    }

    $ekstensiGambarValid = array('jpg', 'jpeg', 'png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo " 
            <script>
                alert('Format gambar tidak didukung!')
            </script>";
        return false;
    }

    if($ukuranFile > $sizeGambar){
        echo " 
            <script>
                alert('Ukuran gambar terlalu besar!')
            </script>";
        return false;
    }   

    //ambil nama perumahan untuk dimasukkan sebagai nama gambar dari table tiperumah
    $namaTipe   = $_POST["tipe_rumah"];
    $tipeQuery  = query("SELECT * FROM perumahan_master WHERE id_perum = '$idPerum'")[0];
    $idPerum    = $tipeQuery["id_perum"];
    $namaPerum  = $tipeQuery["nama_perum"];

    // jika lolos pengecekan, gambar siap di upload
    // generate nama baru
    $namaFileBaru  = 'Perum' . $namaPerum . '-' . 'Tipe'. '-' . $namaTipe. '-' . $y;
    $namaFileBaru .= '.';
    $namaFileBaru .= $tipe_file;

    move_uploaded_file($tmpName, '../img-tiperumah/' . $namaFileBaru);
    $queryTipe      = "INSERT INTO tipe_gambar
                            VALUES 
                            ('', '$namaFileBaru', '$idPerum', '$idTipe')";
    mysqli_query($conn, $queryTipe);
    }
    return $namaFileBaru;
}

function upload_tipe() {
    global $conn;

    $sizeGambar = 10 * 1024 * 1024;
    $idPerum = $_POST["id"];
    $idTipe =  mysqli_insert_id($conn);
    foreach($_FILES["gambar_tipe"]["tmp_name"] as $y=>$tmp_name){
    $namaFile = $_FILES['gambar_tipe']['name'][$y];
    $ukuranFile = $_FILES['gambar_tipe']['size'][$y];
    $tmpName = $_FILES['gambar_tipe']['tmp_name'][$y];
    $tipe_file = pathinfo($namaFile, PATHINFO_EXTENSION);
    $error = $_FILES['gambar_tipe']['error'];

    // cek apakah gambar sudah di upload
    if ($error == 4){
        echo "
            <script>
                alert('Gambar belum dimasukkan!') 
            </script>
        ";
    return false;
    }

    $ekstensiGambarValid = array('jpg', 'jpeg', 'png');
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo " 
            <script>
                alert('Format gambar tidak didukung!')
            </script>";
        return false;
    }

    if($ukuranFile > $sizeGambar){
        echo " 
            <script>
                alert('Ukuran gambar terlalu besar!')
            </script>";
        return false;
    }   

    //ambil nama perumahan untuk dimasukkan sebagai nama gambar dari table tiperumah
    $namaTipe   = $_POST["tipe_rumah"];
    $tipeQuery  = query("SELECT * FROM perumahan_master WHERE id_perum = '$idPerum'")[0];
    $idPerum    = $tipeQuery["id_perum"];
    $namaPerum  = $tipeQuery["nama_perum"];

    // jika lolos pengecekan, gambar siap di upload
    // generate nama baru
    $namaFileBaru  = 'Perum' . $namaPerum . '-' . 'Tipe'. '-' . $namaTipe. '-' . $y;
    $namaFileBaru .= '.';
    $namaFileBaru .= $tipe_file;

    move_uploaded_file($tmpName, '../img-tiperumah/' . $namaFileBaru);
    $queryTipe      = "INSERT INTO tipe_gambar
                            VALUES 
                            ('', '$namaFileBaru', '$idPerum', '$idTipe')";
    mysqli_query($conn, $queryTipe);
    }
    return $namaFileBaru;
}

function getAreaList() //mendapatkan dan menampilkan koordinat dari seluruh area perumahan
{
    global $conn;
	$arr = array();
    $statement = $conn->prepare( "SELECT id_perum, nama_perum, alamat, koordinat, status from perumahan_master order by nama_perum ASC");
    $statement->bind_result( $id, $name, $alamat, $koordinat, $status);
	$statement->execute();
	while ($statement->fetch()) {
		$arr[] = [ "id_perum" => $id, "nama_perum" => $name, "alamat" => $alamat, "koordinat" => $koordinat, "status" => $status];
	}
	$statement->close();
	
	return $arr;
}

function getAreaListbyuserID() //mendapatkan dan menampilkan koordinat dari seluruh area perumahan (diperuntukkan untuk member)
{
    global $conn;

    $idUser = $_SESSION["userID"];
    $arr = array();
    $statement = $conn->prepare( "SELECT id_perum, nama_perum, alamat, koordinat, id_user, status from perumahan_master where id_user = $idUser");
    $statement->bind_result($id, $name, $alamat, $koordinat, $idUser, $status);
	$statement->execute();
	while ($statement->fetch()) {
		$arr[] = [ "id_perum" => $id, "nama_perum" => $name, "alamat" => $alamat, "koordinat" => $koordinat, "id_user" => $idUser, "status" => $status];
	}
	$statement->close();
	
	return $arr;
}

function getAreaListbyID() //mendapatkan dan menampilkan koordinat dari seluruh area perumahan pada halaman detail perumahan
{
    global $conn;

    $idPerum = $_GET["id"];
    $arr = array();
    $statement = $conn->prepare( "SELECT id_perum, nama_perum, alamat, koordinat, id_user, status from perumahan_master where id_perum = $idPerum");
    $statement->bind_result($id, $name, $alamat, $koordinat, $idUser, $status);
	$statement->execute();
	while ($statement->fetch()) {
		$arr[] = [ "id_perum" => $id, "nama_perum" => $name, "alamat" => $alamat, "koordinat" => $koordinat, "id_user" => $idUser, "status" => $status];
	}
	$statement->close();
	
	return $arr;
}
    
function getAreaListbyStatus() //mendapatkan dan menampilkan koordinat dari seluruh area perumahan pada halaman index ketika statusnya sudah diterima
{
    global $conn;
    $arr = array();
    $statement = $conn->prepare( "SELECT id_perum, nama_perum, alamat, koordinat, status from perumahan_master where status = 'Diterima'");
    $statement->bind_result( $id, $name, $alamat, $koordinat, $status);
    $statement->execute();
    while ($statement->fetch()) {
        $arr[] = [ "id_perum" => $id, "nama_perum" => $name, "alamat" => $alamat, "koordinat" => $koordinat, "status" => $status];
    }
    $statement->close();
    
    return $arr;
}
?>