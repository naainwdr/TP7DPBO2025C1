<?php

require_once '../../config/db.php';
require_once '../../class/Recording.php';
require_once '../../class/Song.php';
require_once '../../class/Studio.php';

$recording = new Recording();

$song = new Song();
$songs = $song->getAll();
$studio = new Studio();
$studios = $studio->getAll();

if (isset($_GET['recording_id'])) {
    $id = $_GET['recording_id'];
    $recordingData = $recording->getById($id);

    if (!$recordingData) {
        // Handle jika Recording tidak ditemukan
        echo "Recording not found.";
        exit();
    }
} else {
    // Handle jika tidak ada ID yang diberikan
    echo "ID is required.";
    exit();
}

if (isset($_POST['submit'])) {
    $song_id = $_POST['song_id'];
    $studio_id = $_POST['studio_id'];
    $recording_date = $_POST['recording_date'];

    $result = $recording->update($id, $song_id, $studio_id, $recording_date);
    
    if ($result) {
        header("Location: ../../index.php?page=recording");
        exit();
    } else {
        $error = "Gagal menambahkan record.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recordings</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Recording</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="editRecording.php?recording_id=<?php echo $id; ?>">
            <div class="form-group mb-3">
                <label for="song_id">Song:</label>
                <select class="form-control" id="song_id" name="song_id" required>
                    <option value="">-- Select Song --</option>
                    <?php foreach ($songs as $a): ?>
                        <option value="<?= $a['song_id']; ?>" <?= $a['song_id'] == $recordingData['song_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($a['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="studio_id">Studio:</label>
                <select class="form-control" id="studio_id" name="studio_id" required>
                    <option value="">-- Select Studio --</option>
                    <?php foreach ($studios as $a): ?>
                        <option value="<?= $a['studio_id']; ?>" <?= $a['studio_id'] == $recordingData['studio_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($a['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="recording_date">Recording Date:</label>
                <input type="date" class="form-control" id="recording_date" name="recording_date" value="<?php echo $recordingData['recording_date']; ?>"required>
            </div>
            <button type="submit" name="submit" class="btn-primary">Update Recording</button>
            <a href="../../index.php?page=recording" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
