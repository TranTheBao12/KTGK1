<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../Models/DangKy.php";

class DangKyController {
    private $db;
    private $dangky;

    public function __construct() {
        $this->db = (new Database())->connect();
        $this->dangky = new DangKy($this->db);
    }

    public function getRegisteredCourses($MaSV) {
        return $this->dangky->getByMaSV($MaSV);
    }
    public function saveRegistration($MaSV) {
        return $this->dangky->save($MaSV);
    }
    
    public function deleteAllCourses($MaSV) {
        return $this->dangky->deleteAll($MaSV);
    }
    
    public function registerCourse($MaSV, $MaHP) {
        $result = $this->dangky->register($MaSV, $MaHP);
        if ($result) {
            $_SESSION['success'] = "Đăng ký học phần thành công!";
        } else {
            $_SESSION['error'] = "Bạn đã đăng ký học phần này rồi!";
        }
        header("Location: /WebsiteDangKyHocPhan/index.php?page=dangky");
        exit();
    }
    public function cancelCourse($MaSV, $MaHP) {
        $result = $this->dangky->cancel($MaSV, $MaHP);
        if ($result) {
            $_SESSION['success'] = "Hủy đăng ký học phần thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: Không thể hủy đăng ký!";
        }
        header("Location: /WebsiteDangKyHocPhan/index.php?page=hocphan");
        exit();
    }
}
?>
