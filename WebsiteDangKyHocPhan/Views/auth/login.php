<?php session_start(); ?>
<h2>Đăng Nhập</h2>

<?php if (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<form method="post" action="/WebsiteDangKyHocPhan/routes.php?action=login">
    <label>Mã Sinh Viên:</label>
    <input type="text" name="username" required>
    <br>
    <button type="submit">Đăng nhập</button>
</form>
