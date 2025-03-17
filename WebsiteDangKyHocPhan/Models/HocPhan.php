<?php
class HocPhan {
    private $conn;
    private $table = "HocPhan";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả học phần
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy danh sách học phần mà sinh viên đã đăng ký
    public function getByMaSV($MaSV) {
        $query = "SELECT HocPhan.* 
                  FROM HocPhan
                  JOIN ChiTietDangKy ON HocPhan.MaHP = ChiTietDangKy.MaHP
                  JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
                  WHERE DangKy.MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->execute();
        return $stmt;
    }
    public function cancel($MaSV, $MaHP) {
        // Lấy MaDK của sinh viên và học phần
        $query = "SELECT DangKy.MaDK 
                  FROM DangKy 
                  JOIN ChiTietDangKy ON DangKy.MaDK = ChiTietDangKy.MaDK
                  WHERE DangKy.MaSV = :MaSV AND ChiTietDangKy.MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->bindParam(":MaHP", $MaHP);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false; // Không tìm thấy đăng ký
        }

        $MaDK = $result['MaDK'];

        // Xóa khỏi bảng ChiTietDangKy
        $query = "DELETE FROM ChiTietDangKy WHERE MaDK = :MaDK AND MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaDK", $MaDK);
        $stmt->bindParam(":MaHP", $MaHP);
        $stmt->execute();

        // Kiểm tra nếu MaDK không còn học phần nào khác thì xóa khỏi bảng DangKy
        $query = "SELECT * FROM ChiTietDangKy WHERE MaDK = :MaDK";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaDK", $MaDK);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $query = "DELETE FROM DangKy WHERE MaDK = :MaDK";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":MaDK", $MaDK);
            $stmt->execute();
        }

        return true;
    }
}
?>
