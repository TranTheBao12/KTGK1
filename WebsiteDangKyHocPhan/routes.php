<?php
session_start();
require_once __DIR__ . "/Controllers/AuthController.php";

if (isset($_GET['action'])) {
    $auth = new AuthController();

    if ($_GET['action'] == 'login' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $auth->login($_POST['username'], $_POST['password']);
    } elseif ($_GET['action'] == 'logout') {
        $auth->logout();
    }
}
?>
