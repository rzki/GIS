<?php

require '../functions.php';

$id = $_GET["id"];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapusUser = manipulateData("DELETE FROM users WHERE id_user = $id");
    if ($hapusUser > 0) {
        echo '
            <script>
                alert("User berhasil dihapus");
                window.location.href="userdata.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("User berhasil dihapus");
                window.location.href="userdata.php"
            </script>
        ';
    }
} else {
    echo '
        <script>
            alert("User gagal dihapus");
            window.location.href="userdata.php"
        </script>
    ';
}
?>