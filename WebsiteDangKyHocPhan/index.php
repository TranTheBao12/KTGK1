<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /WebsiteDangKyHocPhan/views/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đăng Ký Học Phần</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav { background: #007bff; padding: 10px; text-align: center; }
        nav a { color: white; text-decoration: none; padding: 10px; font-size: 18px; margin: 0 10px; }
        nav a:hover { background: #0056b3; padding: 10px; border-radius: 5px; }
        h2 { color: #007bff; }
        .content { margin-top: 20px; }
    </style>
</head>
<body>

    <nav>
        <a href="?page=sinhvien">Sinh Viên</a>
        <a href="?page=hocphan">Học Phần</a>
        <a href="?page=dangky">Đăng Ký Học Phần</a>
        <a href="/WebsiteDangKyHocPhan/routes.php?action=logout">Đăng xuất</a>
    </nav>

    <div class="content">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == "sinhvien") {
                include __DIR__ . "/views/sinhvien/index.php";
            } elseif ($page == "sinhvien_create") {
                include __DIR__ . "/views/sinhvien/create.php";
            } elseif ($page == "sinhvien_edit" && isset($_GET['MaSV'])) {
                include __DIR__ . "/views/sinhvien/edit.php";
            } elseif ($page == "sinhvien_detail" && isset($_GET['MaSV'])) {
                include __DIR__ . "/views/sinhvien/detail.php";
            } elseif ($page == "sinhvien_delete" && isset($_GET['MaSV'])) {
                include __DIR__ . "/views/sinhvien/delete.php";
            } elseif ($page == "hocphan") {
                include __DIR__ . "/views/hocphan/index.php";
            } elseif ($page == "dangky") {
                include __DIR__ . "/views/dangky/index.php"; // Hiển thị trang đăng ký học phần
            } elseif ($page == "dangky_register" && isset($_POST['MaHP'])) {
                include __DIR__ . "/views/dangky/register.php"; // Xử lý đăng ký
            } elseif ($page == "dangky_cancel" && isset($_GET['MaHP'])) {
                include __DIR__ . "/views/dangky/cancel.php"; // Xử lý hủy đăng ký
            } else {
                echo "<h2>Chào mừng, " . $_SESSION['user'] . "!</h2>";
            }
        } else {
            echo "<h2>Chào mừng, " . $_SESSION['user'] . "!</h2>";
        }
        ?>
    </div>

</body>
</html>
