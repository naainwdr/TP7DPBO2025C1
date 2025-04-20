<?php
// Include necessary files for database connection and fetching data
require_once 'config/db.php';
require_once 'class/Artist.php';
require_once 'class/Album.php';
require_once 'class/Song.php';
require_once 'class/Studio.php';
require_once 'class/Recording.php';

// Initialize class
$artist = new Artist();
$album = new Album();
$song = new Song();
$studio = new Studio();
$recording = new Recording();

// Fetch all records from the database
$artists = $artist->getAll();
$albums = $album->getAll();
$songs = $song->getAll();
$studios = $studio->getAll();
$recordings = $recording->getAll();

// Handle search functionality
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $artists = $artist->searchArtists($searchQuery);
    $albums = $album->searchAlbums($searchQuery);
    $songs = $song->searchSongs($searchQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP7DPBO2025C1</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Song Recording Database</h1>

        <div class="nav-buttons mb-20">
            <a href="?page=artist" class="nav-button">Artists</a>
            <a href="?page=album" class="nav-button">Albums</a>
            <a href="?page=song" class="nav-button">Songs</a>
            <a href="?page=studio" class="nav-button">Studios</a>
            <a href="?page=recording" class="nav-button">Recordings</a>
        </div>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'artist') include 'view/Artist/viewArtist.php';
            elseif ($page == 'album') include 'view/Album/viewAlbum.php';
            elseif ($page == 'song') include 'view/Song/viewSong.php';
            elseif ($page == 'studio') include 'view/Studio/viewStudio.php';
            elseif ($page == 'recording') include 'view/Recording/viewRecording.php';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
