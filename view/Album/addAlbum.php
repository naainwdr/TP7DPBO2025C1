<?php

require_once '../../config/db.php';
require_once '../../class/Album.php';
require_once '../../class/Artist.php';

$album = new Album();
$artist = new Artist();
$artists = $artist->getAll();

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $release_date = $_POST['release_date'];
    $artist_id = $_POST['artist_id'];

    $result = $album->create($title, $release_date, $artist_id);
    
    if ($result) {
        header("Location: ../../index.php?page=album");
        exit();
    } else {
        $error = "Gagal menambahkan album.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Album</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Album</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="addAlbum.php">
            <div class="form-group mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group mb-3">
                <label for="release_date">Release Date:</label>
                <input type="date" class="form-control" id="release_date" name="release_date" required>
            </div>
            <div class="form-group mb-3">
                <label for="artist_id">Artist:</label>
                <select class="form-control" id="artist_id" name="artist_id" required>
                    <option value="">-- Select Artist --</option>
                    <?php foreach ($artists as $a): ?>
                        <option value="<?= $a['artist_id']; ?>"><?= $a['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn-primary">Add Album</button>
            <a href="../../index.php?page=album" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>