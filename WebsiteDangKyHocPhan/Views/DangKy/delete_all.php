<?php
include_once __DIR__ . "/../../controllers/DangKyController.php";
session_start();

$MaSV = $_SESSION['user'];
$controller = new DangKyController();

if ($controller->deleteAllCourses($MaSV)) {
    $_SESSION['success'] = "Đã hủy tất cả học phần thành công!";
} else {
    $_SESSION['error'] = "Lỗi: Không thể hủy học phần!";
}

header("Location: index.php");
exit();
?>
