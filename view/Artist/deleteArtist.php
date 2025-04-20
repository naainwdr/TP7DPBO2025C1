<?php

require_once '../../config/db.php';
require_once '../../class/Artist.php';

$artist = new Artist();

if (isset($_GET['artist_id'])) {
    $id = $_GET['artist_id'];
    $result = $artist->delete($id);

    if ($result) {
        header("Location: ../../index.php?page=artist");
        exit();
    } else {
        $error = "Gagal menghapus artis.";
    } 
} else {
    echo "ID is required.";
}
?>