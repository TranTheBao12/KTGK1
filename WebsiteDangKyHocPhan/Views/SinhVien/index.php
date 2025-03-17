<?php
include_once __DIR__ . "/../../controllers/SinhVienController.php";
$controller = new SinhVienController();
$data = $controller->index();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table img {
            border-radius: 50%;
            object-fit: cover;
        }
        .btn-action {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">Danh Sách Sinh Viên</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="views/sinhvien/create.php" class="btn btn-success">➕ Thêm Sinh Viên</a>
    </div>

    <table class="table table-striped table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Hình</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['MaSV']; ?></td>
                    <td><?php echo $row['HoTen']; ?></td>
                    <td><?php echo $row['GioiTinh']; ?></td>
                    <td><?php echo $row['NgaySinh']; ?></td>
                    <td>
    <?php 
        $imagePath = $row['Hinh'];
        // Kiểm tra xem đường dẫn ảnh có phải là URL không
        if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
            // Nếu không phải URL hợp lệ, giả định ảnh nằm trong thư mục local
            $imagePath = "/WebsiteDangKyHocPhan/" . ltrim($imagePath, "/");
        }
    ?>
    <img src="<?php echo htmlspecialchars($imagePath); ?>" width="50" height="50" 
         onerror="this.onerror=null; this.src='https://tse2.mm.bing.net/th?id=OIP.Qnje5EC5kiOVGF8';">
</td>

                    <td class="btn-action">
                        <a href="views/sinhvien/detail.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">👁 Xem</a>
                        <a href="views/sinhvien/edit.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                        <a href="views/sinhvien/delete.php?MaSV=<?php echo $row['MaSV']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑 Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
