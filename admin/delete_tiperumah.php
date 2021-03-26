<?php

require '../functions.php';

$id = $_GET["id_tipe"];

$previous = "javascript:history.go(-1)";

if (isset($_GET['id_tipe'])) {
    $id = $_GET['id_tipe'];
    
    $hapusDataPerum = manipulateData("DELETE FROM tiperumah_master WHERE id_tipe = $id");
    if ($hapusDataPerum > 0) {
        echo "
            <script>
                alert('Data perumahan berhasil dihapus');
                document.location.href='$previous'
            </script>
        ";
    }  else {
        echo "
            <script>
                alert('Data perumahan gagal dihapus');
                window.location.href='$previous'
            </script>
        ";
    }
} else {
    echo "
        <script>
            alert('Data perumahan gagal dihapus');
            window.location.href='$previous'
        </script>
        ";
}

?>