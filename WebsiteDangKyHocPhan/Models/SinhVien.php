<?php
class SinhVien {
    private $conn;
    private $table = "SinhVien";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách sinh viên
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy thông tin sinh viên theo mã
    public function getById($MaSV) {
        $query = "SELECT * FROM " . $this->table . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sinh viên mới
    public function create($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $query = "INSERT INTO " . $this->table . " VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->bindParam(":HoTen", $HoTen);
        $stmt->bindParam(":GioiTinh", $GioiTinh);
        $stmt->bindParam(":NgaySinh", $NgaySinh);
        $stmt->bindParam(":Hinh", $Hinh);
        $stmt->bindParam(":MaNganh", $MaNganh);

        return $stmt->execute();
    }

    // Cập nhật sinh viên
    public function update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $query = "UPDATE " . $this->table . " SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, Hinh = :Hinh, MaNganh = :MaNganh WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->bindParam(":HoTen", $HoTen);
        $stmt->bindParam(":GioiTinh", $GioiTinh);
        $stmt->bindParam(":NgaySinh", $NgaySinh);
        $stmt->bindParam(":Hinh", $Hinh);
        $stmt->bindParam(":MaNganh", $MaNganh);

        return $stmt->execute();
    }

    // Xóa sinh viên
    public function delete($MaSV) {
        $query = "DELETE FROM " . $this->table . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        return $stmt->execute();
    }
}
?>
