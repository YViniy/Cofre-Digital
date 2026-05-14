<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/../core/AuthMiddleware.php';
require_once __DIR__ . '/../models/Secret.php';

$userId = AuthMiddleware::check();
$secretModel = new Secret();
$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'create') {
        $title = Security::sanitize($_POST['title'] ?? '');
        $content = Security::sanitize($_POST['content'] ?? '');

        if (empty($title) || empty($content)) {
            Response::json(false, "Título e conteúdo são obrigatórios.");
        }

        if ($secretModel->create($userId, $title, $content)) {
            Response::json(true, "Segredo salvo com sucesso!");
        } else {
            Response::json(false, "Erro ao salvar segredo.");
        }
    }

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        if ($secretModel->delete($id, $userId)) {
            Response::json(true, "Segredo excluído com sucesso!");
        } else {
            Response::json(false, "Erro ao excluir segredo.");
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'list') {
        $secrets = $secretModel->getAllByUser($userId);
        Response::json(true, "Lista de segredos", $secrets);
    }
}
?>
