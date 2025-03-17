<?php
include_once __DIR__ . "/../../controllers/DangKyController.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$MaSV = $_SESSION['user'];
$controller = new DangKyController();

if ($controller->saveRegistration($MaSV)) {
    $_SESSION['success'] = "Lưu đăng ký thành công!";
} else {
    $_SESSION['error'] = "Lỗi khi lưu đăng ký!";
}

header("Location: index.php");
exit();
