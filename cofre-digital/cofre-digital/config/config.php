<?php
// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'cofre_digital');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configurações Globais
define('BASE_URL', 'http://localhost/cofre-digital/');
define('SESSION_EXPIRE', 3600); // 1 hora

// Iniciar sessão se não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
