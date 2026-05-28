<?php
require_once 'Database.php';
require_once 'Response.php';

class RateLimitMiddleware {
    private $db;
    private $limit = 5; // Limite de 5 requisições
  private $window = 300; // 5 minutos

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function check($endpoint) {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $stmt = $this->db->prepare("SELECT request_count, last_request FROM rate_limits WHERE ip_address = ? AND endpoint = ?");
        $stmt->execute([$ip, $endpoint]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $last_request = strtotime($row['last_request']);
            if (time() - $last_request < $this->window) {
                if ($row['request_count'] >= $this->limit) {
                    Response::json(false, "Limite de requisições excedido. Tente novamente em 1 minuto.", null, 429);
                    exit;
                }
                $this->db->prepare("UPDATE rate_limits SET request_count = request_count + 1 WHERE ip_address = ? AND endpoint = ?")
                         ->execute([$ip, $endpoint]);
            } else {
                $this->db->prepare("UPDATE rate_limits SET request_count = 1, last_request = NOW() WHERE ip_address = ? AND endpoint = ?")
                         ->execute([$ip, $endpoint]);
            }
        } else {
            $this->db->prepare("INSERT INTO rate_limits (ip_address, endpoint) VALUES (?, ?)")
                     ->execute([$ip, $endpoint]);
        }
    }
}
