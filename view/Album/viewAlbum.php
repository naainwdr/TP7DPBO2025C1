<?php
require_once 'class/Album.php';
require_once 'config/db.php';

$album = new Album();

// Ambil query pencarian dari parameter URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Cek apakah ada pencarian
if (!empty($searchQuery)) {
    $albums = $album->searchAlbums($searchQuery);
} else {
    $albums = $album->getAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Albums</h1>

        <form action="index.php" method="GET" class="mb-4">
            <input type="hidden" name="page" value="album"> <!-- biar tetap di halaman -->
            <div class="d-flex justify-content-center">
                <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" class="form-control w-50" placeholder="Search by Tittle" />
                <button type="submit" class="btn-primary ms-3">Search</button>
            </div>
        </form>

        <a href="view/Album/addAlbum.php" class="btn btn-success mb-3">Add Album</a>
        <table class="table table-bordered table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date Release</th>
                    <th>Artist</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($albums)): ?>
                    <?php foreach ($albums as $album): ?>
                        <tr>
                            <td><?php echo $album['album_id']; ?></td>
                            <td><?php echo htmlspecialchars($album['title']); ?></td>
                            <td><?php echo $album['release_date']; ?></td>
                            <td><?php echo htmlspecialchars($album['artist_name']); ?></td>
                            <td>
                                <a href="view/Album/editAlbum.php?album_id=<?php echo $album['album_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="view/Album/deleteAlbum.php?album_id=<?php echo $album['album_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No album found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>