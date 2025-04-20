<?php

require_once '../../config/db.php';
require_once '../../class/Song.php';
require_once '../../class/Album.php';

$song = new Song();

if (isset($_GET['song_id'])) {
    $id = $_GET['song_id'];
    $result = $song->delete($id);

    if ($result) {
        header("Location: ../../index.php?page=song");
        exit();
    } else {
        $error = "Gagal menghapus artis.";
    } 
} else {
    echo "ID is required.";
}
?>