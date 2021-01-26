<?php

require '../functions.php';

$id = $_GET["id"];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapusDataPerum = manipulateData("DELETE FROM perumahan_master, tiperumah_master USING perumahan_master INNER JOIN tiperumah_master ON perumahan_master.id_perum = tiperumah_master.id_perum WHERE perumahan_master.id_perum = $id");
    if ($hapusDataPerum > 0) {
        echo '
            <script>
                alert("Data perumahan berhasil dihapus");
                window.location.href="dataperum-user.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Data perumahan gagal dihapus");
                window.location.href="dataperum-user.php"
            </script>
        ';
    }
} else {
    echo '
        <script>
            alert("Data perumahan gagal dihapus");
            window.location.href="home.php"
        </script>
    ';
}
?>