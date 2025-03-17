<?php
include_once __DIR__ . "/../../controllers/HocPhanController.php";
include_once __DIR__ . "/../../controllers/DangKyController.php";


$MaSV = $_SESSION['user'];

$controller = new HocPhanController();
$data = $controller->getByMaSV($MaSV);

$dangKyController = new DangKyController();
?>

<h2>Danh Sách Học Phần Của Bạn</h2>
<table border="1">
    <tr>
        <th>Mã HP</th>
        <th>Tên Học Phần</th>
        <th>Số Tín Chỉ</th>
        <th>Hành Động</th>
    </tr>
    <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?php echo $row['MaHP']; ?></td>
            <td><?php echo $row['TenHP']; ?></td>
            <td><?php echo $row['SoTinChi']; ?></td>
            <td>
                <a href="/WebsiteDangKyHocPhan/views/dangky/cancel.php?MaHP=<?php echo $row['MaHP']; ?>" 
                   onclick="return confirm('Bạn có chắc chắn muốn hủy học phần này?')">❌ Hủy</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
