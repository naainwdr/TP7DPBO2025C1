<?php
require_once __DIR__ . '/../config/db.php';

class Artist {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function create($name, $debut_year, $country) {
        $stmt = $this->db->prepare("INSERT INTO artist (name, debut_year, country) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $debut_year, $country]);
    }
    
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM artist");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM artist WHERE artist_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($id, $name, $debut_year, $country) {
        $stmt = $this->db->prepare("UPDATE artist SET name = ?, debut_year = ?, country = ? WHERE artist_id = ?");
        return $stmt->execute([$name, $debut_year, $country, $id]);
    }    

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM artist WHERE artist_id = ?");
        return $stmt->execute([$id]);
    }
    
    public function searchArtists($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM artist WHERE name LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
