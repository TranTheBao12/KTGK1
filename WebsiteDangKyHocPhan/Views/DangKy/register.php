<?php
include_once __DIR__ . "/../../controllers/DangKyController.php";
session_start();
$MaSV = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['MaHP'])) {
    $controller = new DangKyController();
    $controller->registerCourse($MaSV, $_POST['MaHP']);
} else {
    die("Lỗi: Yêu cầu không hợp lệ!");
}
?>
