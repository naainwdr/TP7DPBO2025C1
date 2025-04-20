<?php
require_once __DIR__ . '/../config/db.php';

class Album {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Method untuk membuat album baru
    public function create($title, $release_date, $artist_id) {
        $stmt = $this->db->prepare("INSERT INTO album (title, release_date, artist_id) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $release_date, $artist_id]);
    }

    // Method untuk mengambil semua album dan menambahkan nama artis
    public function getAll() {
        $stmt = $this->db->query("SELECT album.album_id, album.title, album.release_date, artist.name AS artist_name 
                                  FROM album 
                                  JOIN artist ON album.artist_id = artist.artist_id
                                  ORDER BY album.album_id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mengambil album berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM album WHERE album_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk memperbarui album
    public function update($id, $title, $release_date, $artist_id) {
        $stmt = $this->db->prepare("UPDATE album SET title = ?, release_date = ?, artist_id = ? WHERE album_id = ?");
        return $stmt->execute([$title, $release_date, $artist_id, $id]);
    }

    // Method untuk menghapus album berdasarkan ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM album WHERE album_id = ?");
        return $stmt->execute([$id]);
    }

    // Method untuk mencari album berdasarkan keyword
    public function searchAlbums($keyword) {
        $stmt = $this->db->prepare("SELECT album.album_id, album.title, album.release_date, artist.name AS artist_name
                                    FROM album 
                                    JOIN artist ON album.artist_id = artist.artist_id
                                    WHERE album.title LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
