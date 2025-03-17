<?php
include_once __DIR__ . "/../../controllers/SinhVienController.php";

if (isset($_GET['MaSV'])) {
    $controller = new SinhVienController();
    $sinhvien = $controller->getById($_GET['MaSV']);
} else {
    die("Mã sinh viên không hợp lệ!");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">Chi Tiết Sinh Viên</h2>
    <div class="text-center">
        <img src="<?php echo htmlspecialchars($sinhvien['Hinh']); ?>" class="profile-img" 
             onerror="this.onerror=null; this.src='/WebsiteDangKyHocPhan/assets/default-avatar.png';">
    </div>
    
    <ul class="list-group mt-3">
        <li class="list-group-item"><strong>Mã SV:</strong> <?php echo $sinhvien['MaSV']; ?></li>
        <li class="list-group-item"><strong>Họ Tên:</strong> <?php echo $sinhvien['HoTen']; ?></li>
        <li class="list-group-item"><strong>Giới Tính:</strong> <?php echo $sinhvien['GioiTinh']; ?></li>
        <li class="list-group-item"><strong>Ngày Sinh:</strong> <?php echo $sinhvien['NgaySinh']; ?></li>
        <li class="list-group-item"><strong>Mã Ngành:</strong> <?php echo $sinhvien['MaNganh']; ?></li>
    </ul>

    <!-- Form Upload Ảnh -->
  

    <div class="text-center mt-3">
        <a href="/WebsiteDangKyHocPhan/views/sinhvien/index.php" class="btn btn-secondary">🔙 Quay lại danh sách</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
