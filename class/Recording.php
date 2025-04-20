<?php
require_once __DIR__ . '/../config/db.php';

class Recording {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Tambah data recording
    public function create($song_id, $studio_id, $recording_date) {
        $stmt = $this->db->prepare("INSERT INTO recording (song_id, studio_id, recording_date) VALUES (?, ?, ?)");
        return $stmt->execute([$song_id, $studio_id, $recording_date]);
    }

    // Ambil semua data recording lengkap dengan nama lagu dan studio
    public function getAll() {
        $stmt = $this->db->query("SELECT recording.recording_id, recording.recording_date, 
                                         song.title AS song_title, 
                                         studio.name AS studio_name
                                  FROM recording
                                  JOIN song ON recording.song_id = song.song_id
                                  JOIN studio ON recording.studio_id = studio.studio_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu data recording berdasarkan id
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM recording WHERE recording_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update data recording
    public function update($id, $song_id, $studio_id, $recording_date) {
        $stmt = $this->db->prepare("UPDATE recording 
                                    SET song_id = ?, studio_id = ?, recording_date = ? 
                                    WHERE recording_id = ?");
        return $stmt->execute([$song_id, $studio_id, $recording_date, $id]);
    }

    // Hapus data recording
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM recording WHERE recording_id = ?");
        return $stmt->execute([$id]);
    }

    // Cari recording berdasarkan tanggal
    public function searchRecordings($date) {
        $stmt = $this->db->prepare("SELECT recording.recording_id, recording.recording_date, 
                                           song.title AS song_title, 
                                           studio.name AS studio_name
                                    FROM recording
                                    JOIN song ON recording.song_id = song.song_id
                                    JOIN studio ON recording.studio_id = studio.studio_id
                                    WHERE recording.recording_date = ?");
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
