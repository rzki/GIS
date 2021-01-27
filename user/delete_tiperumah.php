<?php

require '../functions.php';

$id = $_GET["id"];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $hapusDataPerum = manipulateData("DELETE FROM tiperumah_master WHERE id_tipe = $id");
    if ($hapusDataPerum > 0) {
        echo "
            <script>
                alert('Data perumahan berhasil dihapus');
                window.location.href='detail.php?id=$id_perum'
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data perumahan gagal dihapus');
                window.location.href='$idperum'
            </script>
        ";
    }
} else {
    echo "
        <script>
            alert('Data perumahan gagal dihapus');
            window.location.href='$id_perum'
        </script>
        ";
}

?>