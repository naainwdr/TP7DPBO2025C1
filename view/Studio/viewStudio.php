<?php
require_once 'class/Studio.php';
require_once 'config/db.php';

$studio = new Studio();

// Ambil query pencarian dari parameter URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Cek apakah ada pencarian
if (!empty($searchQuery)) {
    $studios = $studio->searchStudio($searchQuery);
} else {
    $studios = $studio->getAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studios</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Studios</h1>

        <form action="index.php" method="GET" class="mb-4">
            <input type="hidden" name="page" value="studio"> <!-- biar tetap di halaman -->
            <div class="d-flex justify-content-center">
                <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" class="form-control w-50" placeholder="Search by Name" />
                <button type="submit" class="btn-primary ms-3">Search</button>
            </div>
        </form>

        <a href="view/Studio/addStudio.php" class="btn btn-success mb-3">Add Studio</a>
        <table class="table table-bordered table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($studios)): ?>
                    <?php foreach ($studios as $studio): ?>
                        <tr>
                            <td><?php echo $studio['studio_id']; ?></td>
                            <td><?php echo htmlspecialchars($studio['name']); ?></td>
                            <td><?php echo $studio['location']; ?></td>
                            <td>
                                <a href="view/Studio/editStudio.php?studio_id=<?php echo $studio['studio_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="view/Studio/deleteStudio.php?studio_id=<?php echo $studio['studio_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No studio found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

