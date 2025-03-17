<?php
include_once __DIR__ . "/../../controllers/SinhVienController.php";

$controller = new SinhVienController();

if (isset($_GET['MaSV'])) {
    $sinhvien = $controller->getById($_GET['MaSV']);
} else {
    die("Mã sinh viên không hợp lệ!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->update($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $_POST['Hinh'], $_POST['MaNganh']);
    header("Location: index.php");
    exit();
}
?>

<h2>Chỉnh Sửa Sinh Viên</h2>
<form method="post">
    <input type="hidden" name="MaSV" value="<?php echo $sinhvien['MaSV']; ?>">
    <label>Họ Tên:</label>
    <input type="text" name="HoTen" value="<?php echo $sinhvien['HoTen']; ?>" required>
    <label>Giới Tính:</label>
    <select name="GioiTinh">
        <option value="Nam" <?php echo ($sinhvien['GioiTinh'] == "Nam") ? "selected" : ""; ?>>Nam</option>
        <option value="Nữ" <?php echo ($sinhvien['GioiTinh'] == "Nữ") ? "selected" : ""; ?>>Nữ</option>
    </select>
    <label>Ngày Sinh:</label>
    <input type="date" name="NgaySinh" value="<?php echo $sinhvien['NgaySinh']; ?>" required>
    <label>Hình:</label>
    <input type="text" name="Hinh" value="<?php echo $sinhvien['Hinh']; ?>">
    <label>Mã Ngành:</label>
    <input type="text" name="MaNganh" value="<?php echo $sinhvien['MaNganh']; ?>" required>
    <button type="submit">Lưu</button>
</form>
<a href="index.php">Quay lại danh sách</a>
