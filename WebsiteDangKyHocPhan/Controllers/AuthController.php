<?php
require_once __DIR__ . "/../config/database.php";

class AuthController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function login($username, $password) {
        // Kiểm tra trong bảng SinhVien (username = MaSV)
        $query = "SELECT * FROM SinhVien WHERE MaSV = :MaSV";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaSV", $username);
        $stmt->execute();
        $sinhvien = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sinhvien) {
            // Đăng nhập thành công
            session_start();
            $_SESSION['user'] = $sinhvien['MaSV']; // Lưu MaSV vào session
            $_SESSION['HoTen'] = $sinhvien['HoTen']; // Lưu tên sinh viên vào session
            header("Location: /WebsiteDangKyHocPhan/index.php");
            exit();
        } else {
            // Sai thông tin đăng nhập
            session_start();
            $_SESSION['error'] = "Sai mã sinh viên!";
            header("Location: /WebsiteDangKyHocPhan/views/auth/login.php");
            exit();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /WebsiteDangKyHocPhan/views/auth/login.php");
        exit();
    }
}
?>
