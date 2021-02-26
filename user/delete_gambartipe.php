<?php

require '../functions.php';

$id = $_GET["id"];

$previous = "javascript:history.go(-1)";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $hapusDataGambar = manipulateData("DELETE FROM tipe_gambar WHERE id_gambar = $id");
    if ($hapusDataGambar > 0) {
        echo "
            <script>
                alert('Gambar tipe rumah berhasil dihapus');
                document.location.href='$previous'
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gambar tipe rumah gagal dihapus');
                window.location.href='$previous'
            </script>
        ";
    }
} else {
    echo "
        <script>
            alert('Gambar tipe rumah gagal dihapus');
            window.location.href='$previous'
        </script>
        ";
}

?>