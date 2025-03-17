<?php
include_once __DIR__ . "/../../controllers/SinhVienController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new SinhVienController();
    $controller->create($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $_POST['Hinh'], $_POST['MaNganh']);
    header("Location: index.php");
    exit();
} else {
    die("Yêu cầu không hợp lệ!");
}
?>
