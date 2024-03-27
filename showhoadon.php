<?php
ob_start();
$active = "showhoadon";
@include('header.php');
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:contact.php');
}
?>

<div class="hero-wrap hero-bread" style="background-image: url('images/br.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9  text-center">
          	<!-- <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span></p> -->
            <h1 class="mb-0 bread"><span class="mr-2"><a href="index.php">TRANG CHỦ |</a></span>ĐƠN HÀNG</h1>
          
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="cart-list">

                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Mã hóa đơn</th>
                                <th>Tên sản phẩm</th>
                                <th>Số Lượng</th>
                                <th>Tổng tiền sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                        
                           // Lấy danh sách hóa đơn từ cơ sở dữ liệu và hiển thị
                           $pay = new cart();
                           $pay_list = $pay->showhoadon(); // Hàm get_pay_list() là một phương thức trong lớp Pay để lấy danh sách hóa đơn
                           if ($pay_list) {
                               $i=0;
                               while ($pay_item = $pay_list->fetch_assoc()) {
                               $i++;
                           ?>
                                   <tr class="odd gradeX">
                                   <td><?php echo $i?></td>
                                       <td><?php echo $pay_item['HD_MA']; ?></td>
                                       <td><?php echo $pay_item['MA_TEN']; ?></td>
                                 
                                       <!-- <td><?php echo $pay_item['MA_HINHANH']; ?></td> -->

                                       <td><?php echo $pay_item['HD_SL']; ?></td>
                                       <td><?php echo $pay_item['HD_GIA']; ?></td>
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

<?php
@include("footer.php")
?>