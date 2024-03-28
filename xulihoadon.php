<?php
ob_start();
$active = "xulihoadon";
@include('header.php');

// Thực hiện kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "food");

// Kiểm tra kết nối có thành công không
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if (isset($_GET['HD_MA']) && !empty($_GET['HD_MA'])) {
    $KH_MA = Session::get('KH_MA');
    $HD_MA = Session::get('HD_MA');
    $insert_order = $ct->insert_order($HD_MA, $KH_MA);
}

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location: contact.php');
}

?>

<div class="hero-wrap hero-bread" style="background-image: url('images/br.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9  text-center">
                <!-- <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span></p> -->
                <h1 class="mb-0 bread"><span class="mr-2"><a href="index.php">TRANG CHỦ |</a></span>GIỎ HÀNG</h1>
                <h1 class="mb-0 bread">ĐƠN HÀNG CỦA TÔI</h1>
            </div>
        </div>
    </div>
</div>

<!-- Tiếp tục với mã HTML của bạn -->

<div class="row" id="watch">
    <?php
    $cart = new cart();

    // Gọi hàm để hiển thị trạng thái đơn hàng
    $cart->hienThiTrangThaiDonHang($HD_MA, $conn);
    ?>
</div>

<?php
$active = "xulihoadon";
@include('footer.php');
?>
