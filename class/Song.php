<?php
require_once __DIR__ . '/../config/db.php';

class Song {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Menambahkan lagu baru
    public function create($title, $duration, $genre, $album_id) {
        $stmt = $this->db->prepare("INSERT INTO song (title, duration, genre, album_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $duration, $genre, $album_id]);
    }

    // Mengambil semua lagu + nama album
    public function getAll() {
        $stmt = $this->db->query("SELECT song.song_id, song.title, song.duration, song.genre, 
                                         album.title AS album_title
                                  FROM song
                                  JOIN album ON song.album_id = album.album_id
                                  ORDER BY song.song_id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil lagu berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM song WHERE song_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update data lagu
    public function update($id, $title, $duration, $genre, $album_id) {
        $stmt = $this->db->prepare("UPDATE song SET title = ?, duration = ?, genre = ?, album_id = ? WHERE song_id = ?");
        return $stmt->execute([$title, $duration, $genre, $album_id, $id]);
    }

    // Hapus lagu
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM song WHERE song_id = ?");
        return $stmt->execute([$id]);
    }

    // Cari lagu berdasarkan judul
    public function searchSongs($keyword) {
        $stmt = $this->db->prepare("SELECT song.song_id, song.title, song.duration, song.genre, 
                                           album.title AS album_title
                                    FROM song
                                    JOIN album ON song.album_id = album.album_id
                                    WHERE song.title LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
