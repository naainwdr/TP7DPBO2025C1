<?php
require_once __DIR__ . '/../config/db.php';

class Studio {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function create($name, $location) {
        $stmt = $this->db->prepare("INSERT INTO studio (name, location) VALUES (?, ?)");
        return $stmt->execute([$name, $location]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM studio");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM studio WHERE studio_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $location) {
        $stmt = $this->db->prepare("UPDATE studio SET name = ?, location = ? WHERE studio_id = ?");
        return $stmt->execute([$name, $location, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM studio WHERE studio_id = ?");
        return $stmt->execute([$id]);
    }

    public function searchStudio($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM studio WHERE name LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
