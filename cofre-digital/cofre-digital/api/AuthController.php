<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/../models/User.php';

$action = $_GET['action'] ?? '';

$userModel = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'register') {
        $username = Security::sanitize($_POST['username'] ?? '');
        $email = Security::sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($email) || empty($password)) {
            Response::json(false, "Todos os campos são obrigatórios.");
        }

        if (!Security::validateEmail($email)) {
            Response::json(false, "E-mail inválido.");
        }

        if ($userModel->findByEmail($email)) {
            Response::json(false, "E-mail já cadastrado.");
        }

        if ($userModel->create($username, $email, $password)) {
            Response::json(true, "Usuário registrado com sucesso!");
        } else {
            Response::json(false, "Erro ao registrar usuário.");
        }
    }

    if ($action === 'login') {
        $email = Security::sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            Response::json(true, "Login realizado com sucesso!", ['username' => $user['username']]);
        } else {
            Response::json(false, "E-mail ou senha incorretos.");
        }
    }
}

if ($action === 'logout') {
    session_destroy();
    Response::json(true, "Logout realizado com sucesso.");
}

if ($action === 'check') {
    if (isset($_SESSION['user_id'])) {
        Response::json(true, "Autenticado", ['username' => $_SESSION['username']]);
    } else {
        Response::json(false, "Não autenticado");
    }
}
?>
