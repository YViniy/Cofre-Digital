<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/Response.php';

class AuthMiddleware {
    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            Response::json(false, "Não autorizado. Por favor, faça login.", null, 401);
        }
        return $_SESSION['user_id'];
    }
}
?>
