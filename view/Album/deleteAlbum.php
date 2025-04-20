<?php

require_once '../../config/db.php';
require_once '../../class/Artist.php';
require_once '../../class/Album.php';

$album = new Album();

if (isset($_GET['album_id'])) {
    $id = $_GET['album_id'];
    $result = $album->delete($id);

    if ($result) {
        header("Location: ../../index.php?page=album");
        exit();
    } else {
        $error = "Gagal menghapus artis.";
    } 
} else {
    echo "ID is required.";
}
?>