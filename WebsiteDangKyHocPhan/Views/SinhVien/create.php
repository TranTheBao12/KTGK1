<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
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
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">Thêm Sinh Viên</h2>

    <form method="post" action="store.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Mã SV:</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Họ Tên:</label>
            <input type="text" name="HoTen" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới Tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình Ảnh:</label>
            <input type="file" name="Hinh" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã Ngành:</label>
            <input type="text" name="MaNganh" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">➕ Thêm Sinh Viên</button>
    </form>

    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary">🔙 Quay lại danh sách</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
