<?php

require_once '../../config/db.php';
require_once '../../class/Artist.php';

$artist = new Artist();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $debut_year = $_POST['debut_year'];
    $country = $_POST['country'];

    $result = $artist->create($name, $debut_year, $country);

    if ($result) {
        header("Location: ../../index.php?page=artist");
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
    <title>Add Artist</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Artist</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="addArtist.php">
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group mb-3">
                <label for="debut_year">Debut Year:</label>
                <input type="year" class="form-control" id="debut_year" name="debut_year" required>
            </div>
            <div class="form-group mb-3">
                <label for="country">Country:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <button type="submit" name="submit" class="btn-primary">Add Artist</button>
            <a href="../../index.php?page=artist" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
