<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/SinhVien.php";

class SinhVienController {
    private $db;
    private $sinhvien;

    public function __construct() {
        $this->db = (new Database())->connect();
        $this->sinhvien = new SinhVien($this->db);
    }

    public function index() {
        return $this->sinhvien->getAll();
    }

    public function getById($MaSV) {
        return $this->sinhvien->getById($MaSV);
    }

    public function create($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        return $this->sinhvien->create($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    }

    public function update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        return $this->sinhvien->update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    }

    public function delete($MaSV) {
        return $this->sinhvien->delete($MaSV);
    }
}
?>
