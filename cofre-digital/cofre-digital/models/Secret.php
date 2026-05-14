<?php
require_once __DIR__ . '/../core/Database.php';

class Secret {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($userId, $title, $content) {
        $stmt = $this->db->prepare("INSERT INTO secrets (user_id, title, content) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $title, $content]);
    }

    public function getAllByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM secrets WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id, $userId) {
        $stmt = $this->db->prepare("DELETE FROM secrets WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }
}
?>
