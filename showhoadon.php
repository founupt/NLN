<?php
ob_start();
$active = "showhoadon";
@include('header.php');

$conn = new mysqli("localhost", "root", "", "food");

// Kiểm tra kết nối có thành công không
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

$cart = new cart();

if (isset($_GET['HD_MA']) && !empty($_GET['HD_MA'])) {
    $KH_MA = Session::get('KH_MA');
    $HD_MA = Session::get('HD_MA');
    $insert_order = $cart->insert_order($HD_MA, $KH_MA);
}

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location: contact.php');
}

?>
<script>
    <?php if (isset($_GET['success']) && $_GET['success'] == true): ?>
        alert('Cập nhật trạng thái thành công');
    <?php endif; ?>
</script>

<div class="hero-wrap hero-bread" style="background-image: url('images/br.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9  text-center">
                <h1 class="mb-0 bread"><span class="mr-2"><a href="index.php">TRANG CHỦ |</a></span>ĐƠN HÀNG</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Mã hóa đơn</th>
                                <th>Tên sản phẩm</th>
                                <th>Số Lượng</th>
                                <th>Tổng tiền sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pay_list = $cart->showhoadon();
                            if ($pay_list) {
                                $i = 0;
                                while ($pay_item = $pay_list->fetch_assoc()) {
                                    $i++;
                                    $trangThai = $pay_item['HD_TRANGTHAI'];
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $pay_item['HD_MA']; ?></td>
                                        <td><?php echo $pay_item['MA_TEN']; ?></td>
                                        <td><?php echo $pay_item['HD_SL']; ?></td>
                                        <td><?php echo $pay_item['HD_GIA']; ?></td>
                                        <td><?php echo $cart->hienThiTrangThaiDonHang($HD_MA, $conn); ?></td>
                                        <td>
                                            <?php if ($trangThai == 0): ?>
                                                <form action="updatetrangthai.php" method="post"> 
                                                    <input type="hidden" name="HD_MA" value="<?php echo $pay_item['HD_MA']; ?>">
                                                    <input type="hidden" name="HD_TRANGTHAI" value="1"> 
                                                    <button type="submit" class="btn btn-danger">Hủy</button>
                                                </form>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
@include("footer.php")
?>
