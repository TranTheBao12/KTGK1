<?php
include_once __DIR__ . "/../../controllers/DangKyController.php";
include_once __DIR__ . "/../../controllers/HocPhanController.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$MaSV = $_SESSION['user'];
$controller = new DangKyController();
$data = $controller->getRegisteredCourses($MaSV);
$hocPhanController = new HocPhanController();
$hocPhans = $hocPhanController->index();
?>

<h2>Đăng Ký Học Phần</h2>

<?php if (isset($_SESSION['success'])): ?>
    <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<!-- Form đăng ký -->
<form method="post" action="views/DangKy/register.php">
    <label>Chọn học phần:</label>
    <select name="MaHP">
        <?php while ($hp = $hocPhans->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?php echo $hp['MaHP']; ?>"><?php echo $hp['TenHP']; ?> - <?php echo $hp['SoTinChi']; ?> tín chỉ</option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Đăng Ký</button>
</form>
