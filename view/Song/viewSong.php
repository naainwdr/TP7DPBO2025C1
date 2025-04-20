<?php

require_once 'config/db.php';
require_once 'class/Song.php';

$song = new Song();

// Ambil query pencarian dari parameter URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Cek apakah ada pencarian
if (!empty($searchQuery)) {
    $songs = $song->searchSongs($searchQuery);
} else {
    $songs = $song->getAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Songs</h1>

        <form action="index.php" method="GET" class="mb-4">
            <input type="hidden" name="page" value="song"> <!-- biar tetap di halaman -->
            <div class="d-flex justify-content-center">
                <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" class="form-control w-50" placeholder="Search by Tittle" />
                <button type="submit" class="btn-primary ms-3">Search</button>
            </div>
        </form>

        <a href="view/Song/addSong.php" class="btn btn-success mb-3">Add Song</a>
        <table class="table table-bordered table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Genre</th>
                    <th>Album</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($songs)): ?>
                    <?php foreach ($songs as $song): ?>
                        <tr>
                            <td><?php echo $song['song_id']; ?></td>
                            <td><?php echo htmlspecialchars($song['title']); ?></td>
                            <td><?php echo $song['duration']; ?></td>
                            <td><?php echo $song['genre']; ?></td>
                            <td><?php echo htmlspecialchars($song['album_title']); ?></td>
                            <td>
                                <a href="view/song/editSong.php?song_id=<?php echo $song['song_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="view/song/deleteSong.php?song_id=<?php echo $song['song_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">No song found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>