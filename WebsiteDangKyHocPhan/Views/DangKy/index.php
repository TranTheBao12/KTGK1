<?php
include_once __DIR__ . "/../../controllers/DangKyController.php";
include_once __DIR__ . "/../../controllers/HocPhanController.php";
include_once __DIR__ . "/../../controllers/SinhVienController.php"; // Thêm controller để lấy thông tin người dùng

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$MaSV = $_SESSION['user'];
$controller = new DangKyController();
$data = $controller->getRegisteredCourses($MaSV);
$hocPhanController = new HocPhanController();
$hocPhans = $hocPhanController->index();

// Lấy thông tin sinh viên
$sinhVienController = new SinhVienController();
$sinhVien = $sinhVienController->getById($MaSV);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .info-card {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">📚 Đăng Ký Học Phần</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Hiển thị thông tin sinh viên -->
    <div class="info-card">
        <h5>Thông Tin Sinh Viên</h5>
        <p><strong>Mã số sinh viên:</strong> <?php echo $sinhVien['MaSV']; ?></p>
        <p><strong>Họ tên:</strong> <?php echo $sinhVien['HoTen']; ?></p>
        <p><strong>Ngày sinh:</strong> <?php echo date("d/m/Y", strtotime($sinhVien['NgaySinh'])); ?></p>
      
    </div>

    <!-- Form đăng ký học phần -->
    <form method="post" action="views/DangKy/register.php" class="mb-3">
        <label class="form-label">Chọn học phần:</label>
        <div class="d-flex">
            <select name="MaHP" class="form-control me-2">
                <?php while ($hp = $hocPhans->fetch(PDO::FETCH_ASSOC)) : ?>
                    <option value="<?php echo $hp['MaHP']; ?>">
                        <?php echo $hp['TenHP']; ?> - <?php echo $hp['SoTinChi']; ?> tín chỉ
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="btn btn-primary">✅ Đăng Ký</button>
        </div>
    </form>

    <!-- Danh sách học phần đã đăng ký -->
    <h5>Danh Sách Học Phần Đã Đăng Ký</h5>
    <ul class="list-group mb-3">
        <?php foreach ($data as $row): ?>
            <li class="list-group-item"><?php echo $row['TenHP'] . " (" . $row['SoTinChi'] . " tín chỉ)"; ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Nút lưu danh sách đăng ký -->
  

    <!-- Nút xóa tất cả học phần -->
    <form method="post" action="views/DangKy/delete_all.php" 
          onsubmit="return confirm('Bạn có chắc chắn muốn hủy tất cả học phần đã đăng ký?');">
        <button type="submit" class="btn btn-danger w-100 mt-3">❌ Hủy Tất Cả Học Phần</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
