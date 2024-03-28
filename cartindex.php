<?php
ob_start();
$active = "cartindex";
@include('header.php');

//Cập nhật số lượng món ăn
if (isset($_POST['update_product_quantity'])){
    $update_value = $_POST['update_quantity_MA_SL'];
    $update_product = $_POST['update_quantity_BG_MA'];
    // echo $update_value;
    // echo $update_product;
    $update_quantity_query = $ct->up_quantity_cart($update_value,$update_product);
};

//Xoá món ăn
if (isset($_GET['remove'])){
    $delete_value  = $_GET['remove'];
    //echo $delete_value;
    $delete_product = $ct->delete_cart($delete_value);
    //echo $delete_product;
};
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:contact.php');
}
?>
<!-- Nội dung trang -->
<div class="hero-wrap hero-bread" style="background-image: url('images/br.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9  text-center">
          	<!-- <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span></p> -->
            <h1 class="mb-0 bread"><span class="mr-2"><a href="index.php">TRANG CHỦ |</a></span>GIỎ HÀNG</h1>
            <h1 class="mb-0 bread">GIỎ HÀNG CỦA TÔI</h1> 
          </div>
        </div>
      </div>
    </div>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="cart-list">
                    <?php
                    if (isset($up_quantity_cart)) {
                        echo $up_quantity_cart;
                        
                    }
                    ?>
                    <?php
                    if (isset($delete_cart)) {
                        echo $delete_cart;
                    }
                    ?>
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Hình ảnh</th>
                                <th>Số Lượng</th>
                                <th>Tổng tiền sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                            $get_cart = $ct->getproduct_cart();
                            $products = $get_cart['products'];
                            $images = $get_cart['images'];
                            $subtotal = 0;
                            $sl = 0;
                            if (!$products || !$images) {
                                    echo "<tr><td colspan='7'>Giỏ hàng của bạn đang trống</td></tr>";
                                }
                            else {
                                while ($result = $products->fetch_assoc()) {
                                    $product_id = $result['MA_MA'];
                                    $image_row = $images->fetch_assoc();
                            ?>

                                    <tr class="text-center">
                                        <td class="product-remove">
                                            <a onclick="return confirm ('Bạn có muốn xóa?')" href="cartindex.php?remove=<?php echo $result['BG_MA'] ?> " >
                                                <span class="ion-ios-close"></span>
                                            </a>
                                        </td>


                                        <td class="product-name">
                                            <h3><?php echo $result['MA_TEN']; ?></h3>
                                        </td>
                                        <td class="quantity">
                                            <?php echo number_format($result['MA_GIA']) . ' vnđ'; ?>
                                        </td>
                                        <td class="img"><img src="images/<?php echo $image_row['MA_HINHANH'] ?> " width="100px"></td>

                                        <td>
                                            <form class="update_quantity" action="" method="post">
                                                <input type="hidden" name="update_quantity_BG_MA" value="<?php echo $result['BG_MA'] ?>" >
                                                <input type="number" name="update_quantity_MA_SL" value="<?php echo $result['MA_SL']; ?>" min="1">
                                                <input type="submit" name="update_product_quantity" value="Cập nhật">
                                            </form>
                                        </td>

                                        <td class="total">
                                            <?php
                                            $total = $result['MA_GIA'] * $result['MA_SL'];
                                            echo number_format($total) . ' ' . 'VNĐ' ?>
                                        </td>
                                        
                                    </tr>

                            <?php
                                    $subtotal += $total;
                                    $sl = $sl + $result['MA_SL'];
                                }
                            }
                             
                        ?>
                            
                        </tbody>
                    </table>

                
                    <?php
                    $check_cart = $ct->check_cart();
                    if ($check_cart) {
                    }
                    ?>
                </div>
         
<br></br>
            <table class="pay" style="text-align: right;">
                    <tr>
                            <th>Thuế VAT : </th>
                            <td>10%</td>
                    </tr>
                        <!-- <br></br> -->
                    <tr>
                        <th>Tổng tiền : </th>
                        <td> <?php 
                        $vat = $subtotal*0.1;
                        $gtotal = $subtotal + $vat;
                        echo number_format($gtotal).' '.'VNĐ'?></td>
                    </tr>
                    
                </table>
                     <h4>
                        <a href="payment.php">THANH TOÁN</a>
                    </h4>
            </div>
        </div>
    </div>
</section>
<?php
@include('footer.php');
?>
<!-- <tbody>
                          