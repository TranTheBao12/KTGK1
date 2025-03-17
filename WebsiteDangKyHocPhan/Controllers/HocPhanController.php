<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../Models/HocPhan.php";

class HocPhanController {
    private $db;
    private $hocphan;

    public function __construct() {
        $this->db = (new Database())->connect();
        $this->hocphan = new HocPhan($this->db);
    }

    public function index() {
        return $this->hocphan->getAll();
    }
    public function getByMaSV($MaSV) {
        return $this->hocphan->getByMaSV($MaSV);
    }
    
}
?>
