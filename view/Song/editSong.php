<?php

require_once '../../config/db.php';
require_once '../../class/Song.php';
require_once '../../class/Album.php';

$song = new Song();
$album = new Album();
$albums = $album->getAll();

if (isset($_GET['song_id'])) {
    $id = $_GET['song_id'];
    $songData = $song->getById($id);

    if (!$songData) {
        // Handle jika Song tidak ditemukan
        echo "Song not found.";
        exit();
    }
} else {
    // Handle jika tidak ada ID yang diberikan
    echo "ID is required.";
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $album_id = $_POST['album_id'];

    $result = $song->update($id, $title, $duration, $genre, $album_id);
    
    if ($result) {
        header("Location: ../../index.php?page=song");
        exit();
    } else {
        $error = "Gagal memperbarui lagu.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Songs</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Song</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="editSong.php?song_id=<?php echo $id; ?>">
            <div class="form-group mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $songData['title']; ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="duration">Duration:</label>
                <input type="time" class="form-control" id="duration" name="duration" value="<?php echo $songData['duration']; ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="genre">Genre:</label>
                <input type="text" class="form-control" id="genre" name="genre" value="<?php echo $songData['genre']; ?>" required>
            </div>  
            <div class="form-group mb-3">
                <label for="album_id">Album:</label>
                <select class="form-control" id="album_id" name="album_id" required>
                    <option value="">-- Select Album --</option>
                    <?php foreach ($albums as $a): ?>
                        <option value="<?= $a['album_id']; ?>" <?= $a['album_id'] == $songData['album_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($a['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>  
            <button type="submit" name="submit" class="btn-primary">Update Album</button>
            <a href="../../index.php?page=song" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

