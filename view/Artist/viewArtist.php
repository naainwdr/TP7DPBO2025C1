<?php

require_once 'config/db.php';
require_once 'class/Artist.php';

// Inisialisasi kelas
$artist = new Artist();

// Ambil query pencarian dari parameter URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Cek apakah ada pencarian
if (!empty($searchQuery)) {
    $artists = $artist->searchArtists($searchQuery);
} else {
    $artists = $artist->getAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artists</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Artists</h1>

        <!-- Form pencarian -->
        <form action="index.php" method="GET" class="mb-4">
            <input type="hidden" name="page" value="artist"> <!-- biar tetap di halaman artist -->
            <div class="d-flex justify-content-center">
                <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" class="form-control w-50" placeholder="Search by Name" />
                <button type="submit" class="btn-primary ms-3">Search</button>
            </div>
        </form>

        <a href="view/Artist/addArtist.php" class="btn btn-success mb-3">Add Artist</a>
        <table class="table table-bordered table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Debut Year</th>
                    <th>Country</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($artists)): ?>
                    <?php foreach ($artists as $artist): ?>
                        <tr>
                            <td><?php echo $artist['artist_id']; ?></td>
                            <td><?php echo htmlspecialchars($artist['name']); ?></td>
                            <td><?php echo $artist['debut_year']; ?></td>
                            <td><?php echo $artist['country']; ?></td>
                            <td>
                                <a href="view/Artist/editArtist.php?artist_id=<?php echo $artist['artist_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="view/Artist/deleteArtist.php?artist_id=<?php echo $artist['artist_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No artist found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
