<?php

require_once '../../config/db.php';
require_once '../../class/Studio.php';

$studio = new Studio();

if (isset($_GET['studio_id'])) {
    $id = $_GET['studio_id'];
    $result = $studio->delete($id);

    if ($result) {
        header("Location: ../../index.php?page=studio");
        exit();
    } else {
        $error = "Gagal menghapus artis.";
    } 
} else {
    echo "ID is required.";
}
?>