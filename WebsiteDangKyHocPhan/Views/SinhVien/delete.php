<?php
include_once __DIR__ . "/../../controllers/SinhVienController.php";

if (isset($_GET['MaSV'])) {
    $controller = new SinhVienController();
    $controller->delete($_GET['MaSV']);
    header("Location: index.php");
    exit();
} else {
    die("Mã sinh viên không hợp lệ!");
}
?>
