<?php
$conn = new mysqli("localhost", "root", "", "food");

if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HD_MA = $_POST['HD_MA'];
    $HD_TRANGTHAI = $_POST['HD_TRANGTHAI'];

    $sql = "UPDATE hoadon SET HD_TRANGTHAI = $HD_TRANGTHAI WHERE HD_MA = $HD_MA";

    if ($conn->query($sql) === TRUE) {
        // Đóng kết nối
        $conn->close();
        echo "<script>alert('Cập nhật trạng thái thành công'); window.location.href = 'showhoadon.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
