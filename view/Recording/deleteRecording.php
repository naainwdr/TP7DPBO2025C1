<?php

require_once '../../config/db.php';
require_once '../../class/Recording.php';
require_once '../../class/Song.php';
require_once '../../class/Studio.php';


$recording = new Recording();

if (isset($_GET['recording_id'])) {
    $id = $_GET['recording_id'];
    $result = $recording->delete($id);

    if ($result) {
        header("Location: ../../index.php?page=recording");
        exit();
    } else {
        $error = "Gagal menghapus record.";
    } 
} else {
    echo "ID is required.";
}
?>