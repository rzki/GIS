<?php

require '../functions.php';

$id = $_GET["id"];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapusDataPerum = manipulateData("DELETE FROM perumahan_master WHERE id_perum = $id");
    if ($hapusDataPerum > 0) {
        echo '
            <script>
                alert("Data perumahan berhasil dihapus");
                window.location.href="dataperum-all.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Data perumahan berhasil dihapus");
                window.location.href="dataperum-all.php"
            </script>
        ';
    }
} else {
    echo '
        <script>
            alert("Data perumahan gagal dihapus");
            window.location.href="dataperum-all.php"
        </script>
    ';
}
?>