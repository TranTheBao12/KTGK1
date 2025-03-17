<?php
include_once __DIR__ . "/../../controllers/SinhVienController.php";

$controller = new SinhVienController();

if (isset($_GET['MaSV'])) {
    $sinhvien = $controller->getById($_GET['MaSV']);
} else {
    die("Mã sinh viên không hợp lệ!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Hinh = $sinhvien['Hinh']; // Giữ ảnh cũ nếu không có ảnh mới
    if (!empty($_FILES["Hinh"]["name"])) {
        $uploadDir = "/WebsiteDangKyHocPhan/uploads/";
        $targetFile = $uploadDir . basename($_FILES["Hinh"]["name"]);

        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            $Hinh = $targetFile;
        }
    }

    $controller->update($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $Hinh, $_POST['MaNganh']);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sinh Viên</title>
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
    <h2 class="text-center text-primary">Chỉnh Sửa Sinh Viên</h2>

    <div class="text-center">
        <img src="<?php echo htmlspecialchars($sinhvien['Hinh']); ?>" class="profile-img" 
             onerror="this.onerror=null; this.src='/WebsiteDangKyHocPhan/assets/default-avatar.png';">
    </div>

    <form method="post" enctype="multipart/form-data" class="mt-3">
        <input type="hidden" name="MaSV" value="<?php echo $sinhvien['MaSV']; ?>">

        <div class="mb-3">
            <label class="form-label">Họ Tên:</label>
            <input type="text" name="HoTen" value="<?php echo $sinhvien['HoTen']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới Tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam" <?php echo ($sinhvien['GioiTinh'] == "Nam") ? "selected" : ""; ?>>Nam</option>
                <option value="Nữ" <?php echo ($sinhvien['GioiTinh'] == "Nữ") ? "selected" : ""; ?>>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" value="<?php echo $sinhvien['NgaySinh']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình Ảnh:</label>
            <input type="file" name="Hinh" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã Ngành:</label>
            <input type="text" name="MaNganh" value="<?php echo $sinhvien['MaNganh']; ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">💾 Lưu</button>
    </form>

    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary">🔙 Quay lại danh sách</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
