<?php
require_once 'class/Recording.php';
require_once 'config/db.php';

$recording = new Recording();

// Ambil query pencarian dari parameter URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Cek apakah ada pencarian
if (!empty($searchQuery)) {
    $recordings = $recording->searchRecordings($searchQuery);
} else {
    $recordings = $recording->getAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordings</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Recordings</h1>

        <form action="index.php" method="GET" class="mb-4">
            <input type="hidden" name="page" value="recording"> <!-- biar tetap di halaman -->
            <div class="d-flex justify-content-center">
                <input type="date" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" class="form-control w-50" placeholder="Search by Date" />
                <button type="submit" class="btn-primary ms-3">Search</button>
            </div>
        </form>

        <a href="view/Recording/addRecording.php" class="btn btn-success mb-3">Add Recording</a>
        <table class="table table-bordered table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Song</th>
                    <th>Studio</th>
                    <th>Date Recording</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recordings)): ?>
                    <?php foreach ($recordings as $recording): ?>
                        <tr>
                            <td><?php echo $recording['recording_id']; ?></td>
                            <td><?php echo htmlspecialchars($recording['song_title']); ?></td>
                            <td><?php echo htmlspecialchars($recording['studio_name']); ?></td>
                            <td><?php echo $recording['recording_date']; ?></td>
                            <td>
                                <a href="view/Recording/editRecording.php?recording_id=<?php echo $recording['recording_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="view/Recording/deleteRecording.php?recording_id=<?php echo $recording['recording_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No recording found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>