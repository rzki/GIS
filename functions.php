<?php
//koneksi ke database
$conn = mysqli_connect('localhost:3306', 'root', '', 'sig-perum');

function query($query) {
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
    // $tipeRumah      = htmlspecialchars ($data["tipe_rumah"]);
    // $luasBangunan   = htmlspecialchars ($data["luas_bangunan"]);
    // $luasTanah      = htmlspecialchars ($data["luas_tanah"]);
    // $spek           = htmlspecialchars ($data["spesifikasi"]);
    // $listrik        = htmlspecialchars ($data["daya_listrik"]);
    $koordinat      = htmlspecialchars ($data["koordinat"]);
    $idUser         = $_SESSION["userID"];
    $status         = htmlspecialchars ($data["status"]);

    // upload gambar
    $gambar         = upload();
    if(!$gambar){
        return false;
    }

    // ambil data perumahan
    $queryUser = "SELECT * FROM users WHERE id_user = '$idUser'";
    $resultUser = mysqli_query($conn, $queryUser);
    $dataUser = mysqli_fetch_assoc($resultUser);
    $idUser= $dataUser['id_user'];

    $queryPerum         =   "   INSERT INTO perumahan_master
                                    VALUES
                                    ('', '$namaPerum', '$alamat', '$koordinat', '$gambar', '$idUser', '$status')";
    mysqli_query($conn, $queryPerum);

    // // ambil data perumahan
    // $queryPerum = "SELECT * FROM perumahan_master WHERE nama_perum = '$namaPerum'";
    // $resultPerum = mysqli_query($conn, $queryPerum);
    // $dataPerum = mysqli_fetch_assoc($resultPerum);
    // $idPerum = $dataPerum['id_perum'];

    // $queryTipe         =   "   INSERT INTO tiperumah_master
    //                             VALUES
    //                             ('', '$namaPerum', '$tipeRumah', '$luasBangunan', '$luasTanah',
    //                             '$spek', '$listrik', '$idPerum', '$idUser')";
    // $resultTipe        =     mysqli_query($conn, $queryTipe);
return mysqli_affected_rows($conn);
}

function tambahtipe($data){
    global $conn;
    
    $tipeRumah      = htmlspecialchars ($data["tipe_rumah"]);
    $luasBangunan   = htmlspecialchars ($data["luas_bangunan"]);
    $luasTanah      = htmlspecialchars ($data["luas_tanah"]);
    $spek           = htmlspecialchars ($data["spesifikasi"]);
    $listrik        = htmlspecialchars ($data["daya_listrik"]);
    $idPerum        = $data["id"];
    $idUser         = $_SESSION["userID"];

    // ambil id perumahan dari tabel data perumahan
    $queryTipe = "SELECT * FROM perumahan_master WHERE id_perum = '$idPerum'";
    $resultTipe = mysqli_query($conn, $queryTipe);
    $dataTipe = mysqli_fetch_assoc($resultTipe);
    $idPerum = $dataTipe['id_perum'];

    $queryTipe         =   "   INSERT INTO tiperumah_master
                                VALUES
                                ('', '$tipeRumah', '$luasBangunan', '$luasTanah',
                                '$spek', '$listrik', '$idPerum', '$idUser')";
    mysqli_query($conn, $queryTipe);

        // if($resultTipe == true) {
        //     echo '
        //     <script>
        //         alert ("Tipe perumahan berhasil ditambahkan")
        //         window.location.href="home.php"
        //     </script>';
        // }
    
    return mysqli_affected_rows($conn);
}

function ubahdataperum($data) {
    global $conn;
    $idPerum        = $data["id"];
    $namaPerum      = htmlspecialchars ($data["nama_perum"]);
    $alamat         = htmlspecialchars ($data["alamat"]);
    $koordinat      = ($data["koordinat"]);
    $gambarLama     = htmlspecialchars ($data["gambarLama"]);
    $status         = htmlspecialchars ($data["status"]);

    //cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] == 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $queryPerum  =   "UPDATE perumahan_master SET 
                    nama_perum = '$namaPerum',
                    alamat = '$alamat',
                    koordinat = '$koordinat',
                    gambar = '$gambar',
                    status = '$status'
                WHERE id_perum = $idPerum";
    $editPerum = mysqli_query($conn, $queryPerum);

    if($editPerum == true){
        echo '
        <script>
            alert ("Data perumahan berhasil di edit")
            window.location.href="dataperum-user.php"
        </script>';
    }
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

    $queryTipe =   "UPDATE tiperumah_master SET
                    tipe_rumah ='$tipeRumah',
                    luas_bangunan = '$luasBangunan',
                    luas_tanah = '$luasTanah',
                    spesifikasi = '$spek',
                    daya_listrik = '$listrik'
                WHERE id_tipe = $idTipe";
    $editTipe = mysqli_query($conn, $queryTipe);

    if($editTipe == true){
        echo '
        <script>
            alert ("Tipe perumahan berhasil di edit")
            window.location.href="detail.php"
        </script>';
    }
    
    return mysqli_affected_rows($conn);
}

function upload() {
    
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

    // jika lolos pengecekan, gambar siap di upload
    // generate nama baru
    $namaFileBaru  = $_POST["nama_perum"] . '-' .  uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img-perum/' . $namaFileBaru);

    return $namaFileBaru;
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

function hapusperum($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM perumahan WHERE id_perum = $id");
    return mysqli_affected_rows($conn);
}

function hapusperum_user($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM perumahan_user WHERE id_perum = $id");
    return mysqli_affected_rows($conn);
}

function getAreaList()
	{
        global $conn;
		$arr = array();
		$statement = $conn->prepare( "SELECT id_perum, nama_perum, alamat, koordinat, gambar from perumahan_master order by nama_perum ASC");
		$statement->bind_result( $id, $name, $alamat, $koordinat, $gambar);
		$statement->execute();
		while ($statement->fetch()) {
			$arr[] = [ "id_perum" => $id, "nama_perum" => $name, "alamat" => $alamat, "koordinat" => $koordinat, "gambar" => $gambar];
		}
		$statement->close();
		
		return $arr;
    }
    
function getAreaList_member()
{
    global $conn;
    $arr = array();
    $statement = $conn->prepare( "SELECT id_perum, nama_perum, alamat, koordinat, gambar, status from perumahan_master order by nama_perum ASC");
    $statement->bind_result( $id, $name, $alamat, $koordinat, $gambar, $status);
    $statement->execute();
    while ($statement->fetch()) {
        $arr[] = [ "id_perum" => $id, "nama_perum" => $name, "alamat" => $alamat, "koordinat" => $koordinat, "gambar" => $gambar, "status" => $status];
    }
    $statement->close();
    
    return $arr;
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