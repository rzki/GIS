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
    //agar tidak menampilkan error
    error_reporting(0);
    global $conn;
    
    $namaPerum      = htmlspecialchars ($data["nama_perum"]);
    $alamat         = htmlspecialchars ($data["alamat"]);
    $koordinat      = htmlspecialchars ($data["koordinat"]);
    $idUser         = $_SESSION["userID"];
    $status         = htmlspecialchars ($data["status"]);

    // ambil data perumahan
    $queryUser = "SELECT * FROM users WHERE id_user = '$idUser'";
    $resultUser = mysqli_query($conn, $queryUser);
    $dataUser = mysqli_fetch_assoc($resultUser);
    $idUser= $dataUser['id_user'];

    $queryPerum         =   "   INSERT INTO perumahan_master
                                    VALUES
                                    ('', '$namaPerum', '$alamat', '$koordinat', '$idUser', '$status')";
    mysqli_query($conn, $queryPerum);

return mysqli_affected_rows($conn);
}

function tambahtipe($data){
    global $conn;
    error_reporting(0);
    
    $namaPerum      = $data["nama_perum"];
    $tipeRumah      = htmlspecialchars ($data["tipe_rumah"]);
    $luasBangunan   = htmlspecialchars ($data["luas_bangunan"]);
    $luasTanah      = htmlspecialchars ($data["luas_tanah"]);
    $spek           = htmlspecialchars ($data["spesifikasi"]);
    $listrik        = htmlspecialchars ($data["daya_listrik"]);
    $idPerum        = $data["id"];
    $idUser         = $_SESSION["userID"];

    // upload gambar
    $gambar         = upload();
    if(!$gambar){
        return false;
    
    }
    // ambil id dan nama perumahan dari tabel data perumahan
    $queryTipe = "SELECT * FROM perumahan_master WHERE id_perum = '$idPerum'";
    $resultTipe = mysqli_query($conn, $queryTipe);
    $dataTipe = mysqli_fetch_assoc($resultTipe);
    $idPerum = $dataTipe['id_perum'];
    $namaPerum = $dataTipe['nama_perum'];

    $queryTipe         =   "   INSERT INTO tiperumah_master
                                VALUES
                                ('', '$namaPerum' ,'$tipeRumah', '$luasBangunan', '$luasTanah',
                                '$spek', '$listrik', '$gambar', '$idPerum', '$idUser')";
    mysqli_query($conn, $queryTipe);
    
    return mysqli_affected_rows($conn);
}

function ubahdataperum($data) {
    global $conn;
    $idPerum        = $data["id"];
    $namaPerum      = htmlspecialchars ($data["nama_perum"]);
    $alamat         = htmlspecialchars ($data["alamat"]);
    $koordinat      = ($data["koordinat"]);
    $status         = htmlspecialchars ($data["status"]);

    $queryPerum  =   "UPDATE perumahan_master SET 
                    nama_perum = '$namaPerum',
                    alamat = '$alamat',
                    koordinat = '$koordinat',
                    status = '$status'
                WHERE id_perum = $idPerum";
    mysqli_query($conn, $queryPerum);

    return mysqli_affected_rows($conn);
}

function ubahtiperumah($data) {
    global $conn;

    $idTipe        = $data["id"];
    $tipeRumah      = htmlspecialchars ($data["tipe_rumah"]);
    $luasBangunan   = htmlspecialchars ($data["luas_bangunan"]);
    $luasTanah      = htmlspecialchars ($data["luas_tanah"]);
    $spek           = htmlspecialchars ($data["spesifikasi"]);
    $listrik        = htmlspecialchars ($data["daya_listrik"]);
    $gambarLama     = htmlspecialchars ($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] == 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $queryTipe =   "UPDATE tiperumah_master SET
                    tipe_rumah ='$tipeRumah',
                    luas_bangunan = '$luasBangunan',
                    luas_tanah = '$luasTanah',
                    spesifikasi = '$spek',
                    daya_listrik = '$listrik',
                    gambar = '$gambar'
                WHERE id_tipe = $idTipe";
    mysqli_query($conn, $queryTipe);
    
    return mysqli_affected_rows($conn);
}

function upload() {
    global $conn;
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah gambar sudah di upload
    if ($error == 4){
        echo "
            <script>
                alert('Gambar belum dimasukkan!') 
            </script>
        ";
    return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo " 
            <script>
                alert('Format gambar tidak didukung!')
            </script>";
        return false;
    }

    if($ukuranFile > 1000000){
        echo " 
            <script>
                alert('Ukuran gambar terlalu besar!')
            </script>";
        return false;
    }   

    //ambil nama perumahan untuk dimasukkan sebagai nama gambar dari table tiperumah
    $idPerum = $_GET["id_perum"];
    $namaperumtipe = query("SELECT * FROM tiperumah_master WHERE id_perum = $idPerum")[0];
    $namaPerum = $namaperumtipe["nama_perum"];

    // jika lolos pengecekan, gambar siap di upload
    // generate nama baru
    $namaFileBaru  = $namaPerum. '-' . uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img-perum/' . $namaFileBaru);

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
    $statement = $conn->prepare( "SELECT id_perum, nama_perum, alamat, koordinat, status from perumahan_master where status = '1'");
    $statement->bind_result( $id, $name, $alamat, $koordinat, $status);
    $statement->execute();
    while ($statement->fetch()) {
        $arr[] = [ "id_perum" => $id, "nama_perum" => $name, "alamat" => $alamat, "koordinat" => $koordinat, "status" => $status];
    }
    $statement->close();
    
    return $arr;
}

function multiple_upload() {

    // Configure upload directory and allowed file types 
    $upload_dir = '../img-perum/'.DIRECTORY_SEPARATOR; 
    $allowed_types = array('jpg', 'png', 'jpeg',); 
    
    // Define maxsize for files (10MB) 
    $maxsize = 10 * 1024 * 1024;  

    // Checks if user sent an empty form  
    if(!empty(array_filter($_FILES['gambar']['name']))) { 

        // Loop through each file in files[] array 
        foreach ($_FILES['gambar']['tmp_name'] as $key => $value) { 
        
            $file_tmpname = $_FILES['gambar']['tmp_name'][$key]; 
            $file_name = $_FILES['gambar']['name'][$key]; 
            $file_size = $_FILES['gambar']['size'][$key]; 
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 

            // Set upload file path 
            $filepath = $upload_dir.$file_name; 

            // Check file type is allowed or not 
            if(in_array(strtolower($file_ext), $allowed_types)) { 

                // Verify file size - 2MB max  
                if ($file_size > $maxsize)          
                    echo "Error: File size is larger than the allowed limit.";  

                // If file with name already exist then append time in 
                // front of name of the file to avoid overwriting of file 
                if(file_exists($filepath)) { 
                    $filepath = $upload_dir.time().$file_name; 
                    
                    if( move_uploaded_file($file_tmpname, $filepath)) { 
                        echo "{$file_name} successfully uploaded <br />"; 
                    }  
                    else {                      
                        echo "Error uploading {$file_name} <br />";  
                    } 
                } 
                else { 
                
                    if( move_uploaded_file($file_tmpname, $filepath)) { 
                        echo "{$file_name} successfully uploaded <br />"; 
                    } 
                    else {                      
                        echo "Error uploading {$file_name} <br />";  
                    } 
                } 
            } 
            else { 
                
                // If file extention not valid 
                echo "Error uploading {$file_name} ";  
                echo "({$file_ext} file type is not allowed)<br / >"; 
            }  
        } 
    }  
    else { 
        
        // If no files selected 
        echo "No files selected."; 
    } 
}


/*function tambah($tambah) {
    global $conn;

    //ambil data tiap elemen dari form

    $nama       = htmlspecialchars ($tambah["nama"]);
    $username   = htmlspecialchars ($tambah["username"]);
    $level      = $tambah["level"];
    $email      = htmlspecialchars ($tambah["email"]);
    $password   = mysqli_real_escape_string($conn, $tambah["password"]);
    $password2  = mysqli_real_escape_string($conn, $tambah["password2"]);

    //cek apakah username tersedia atau tidak
    $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE
        username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "
        <script>
            alert('Username sudah digunakan, silahkan gunakan username lain!');
        </script>
        ";
        return false;
    }

    //cek konfirmasi password benar atau tidak
    if ($password !== $password2){
        echo "
        <script>
            alert(' Kedua password tidak sesuai! ');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query insert data
    $query = "INSERT INTO tb_user
                VALUES 
                ('', '$nama', '$username', '$level', '$email', '$password')
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

if(isset($_POST['update'])){
    $namaPerum      = ($_POST['nama_perum']);
    $alamat         = ($_POST['alamat']);
    $luasTanah      = ($_POST['luas_tanah']);
    $luasBangunan   = ($_POST['luas_bangunan']);
    $tipeRumah      = ($_POST['tipe_rumah']);
    $spek           = ($_POST['spesifikasi']);
    $listrik        = ($_POST['daya_listrik']);
    $gambarLama     = ($_FILES['gambarLama']);
    $gambar         = ($_FILES['gambar']);

    // cek apakah user mengupload gambar baru atau tidak
    if($_FILES['gambar']['error'] == 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $dataPerum = manipulateData("UPDATE perumahan SET 
                                nama_perum = '$namaPerum',
                                alamat = '$alamat',
                                luas_tanah = '$luasTanah',
                                luas_bangunan = '$luasBangunan',
                                tipe_rumah = '$tipeRumah',
                                spesifikasi = '$spek',
                                daya_listrik = '$listrik',
                                gambar = '$gambar'
                                WHERE id_perum = $idPerum
                                ");

    if ($dataPerum > 0) {
        echo '
            <script>
                alert("Berhasil mengubah data perumahan!");
                window.location.href="home.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal mengubah data perumahan!");
                window.location.href="home.php"
            </script>
        ';
    }




function updateData($update){
    global $conn;
    return mysqli_query($conn, $update);
}
*/

?>