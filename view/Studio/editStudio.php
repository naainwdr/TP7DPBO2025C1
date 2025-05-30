<?php

require_once '../../config/db.php';
require_once '../../class/Studio.php';

$studio = new Studio();

if (isset($_GET['studio_id'])) {
    $id = $_GET['studio_id'];
    $studioData = $studio->getById($id);

    if (!$studioData) {
        // Handle jika studio tidak ditemukan
        echo "Studio not found.";
        exit();
    }
} else {
    // Handle jika tidak ada ID yang diberikan
    echo "ID is required.";
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $result = $studio->update($id, $name, $location);

    if ($result) {
        header("Location: ../../index.php?page=studio");
        exit();
    } else {
        $error = "Gagal menambahkan artis.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Studio</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Studio</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="editStudio.php?studio_id=<?php echo $id; ?>">
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $studioData['name']; ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $studioData['location']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn-primary">Update Studio</button>
            <a href="../../index.php?page=studio" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
