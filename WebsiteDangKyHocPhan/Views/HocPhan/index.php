<?php
include_once __DIR__ . "/../../controllers/HocPhanController.php";
include_once __DIR__ . "/../../controllers/DangKyController.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$MaSV = $_SESSION['user'];
$controller = new HocPhanController();
$data = $controller->getByMaSV($MaSV);
$dangKyController = new DangKyController();

// Biến đếm số học phần và tổng số tín chỉ
$totalCourses = 0;
$totalCredits = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Học Phần Của Bạn</title>
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
        .stats {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">📚 Danh Sách Học Phần Của Bạn</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th>Mã HP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                <?php 
                    $totalCourses++; 
                    $totalCredits += $row['SoTinChi'];
                ?>
                <tr>
                    <td><?php echo $row['MaHP']; ?></td>
                    <td><?php echo $row['TenHP']; ?></td>
                    <td><?php echo $row['SoTinChi']; ?></td>
                    <td>
                        <a href="/WebsiteDangKyHocPhan/views/dangky/cancel.php?MaHP=<?php echo $row['MaHP']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn hủy học phần này?')">❌ Hủy</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Hiển thị tổng số học phần và tổng số tín chỉ -->
    <div class="stats mt-3">
        📝 <strong>Tổng số học phần:</strong> <?php echo $totalCourses; ?><br>
        🎓 <strong>Tổng số tín chỉ:</strong> <?php echo $totalCredits; ?>
    </div>

    <!-- Nút xóa tất cả học phần -->
    <form method="post" action="/WebsiteDangKyHocPhan/views/dangky/delete_all.php" 
          onsubmit="return confirm('Bạn có chắc chắn muốn hủy tất cả học phần đã đăng ký?');">
        <button type="submit" class="btn btn-danger w-100 mt-3">❌ Hủy Tất Cả Học Phần</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
