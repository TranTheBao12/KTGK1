<?php
include_once __DIR__ . "/../../controllers/DangKyController.php";
session_start();
$MaSV = $_SESSION['user'];

if (isset($_GET['MaHP'])) {
    $controller = new DangKyController();
    $controller->cancelCourse($MaSV, $_GET['MaHP']);
    header("Location: index.php?page=hocphan");
    exit();
} else {
    $_SESSION['error'] = "Lỗi: Không thể hủy đăng ký!";
    header("Location: views/HocPhan/index.php?page=hocphan");
    exit();
}
?>
