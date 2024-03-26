<?php
$actitive = "product-single";
@include('header.php');
?>
    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang chủ</a></span> <span class="mr-2"><a href="index.php">Product</a></span> <span>Product Single</span></p>
            <h1 class="mb-0 bread">Món ăn</h1>
          </div>
        </div>
      </div>
    </div> 

	<?php
if (!isset($_GET['maid']) || $_GET['maid'] == NULL) {
} else {
	$id = $_GET['maid'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$MA_SL = $_POST['MA_SL'];
	$MA_MA = $_POST['MA_MA'];
	$addcart = $ct->add_cart($MA_SL, $MA_MA);
}
?>
<section class="ftco-section">
	<div class="container">
		<div class="row">
			<?php
			// Kiểm tra xem có dữ liệu tìm kiếm được gửi từ header không
			if(isset($_GET['timkiem'])) {
			    // Lấy từ khóa tìm kiếm từ URL
			    $keyword = $_GET['timkiem'];

			    // Thực hiện truy vấn để tìm kiếm sản phẩm dựa trên từ khóa
			    $result = $product->searchProduct($keyword);

			    if($result) {
			        // Hiển thị kết quả tìm kiếm
			        while($row = $result->fetch_assoc()) {
			            // Hiển thị thông tin sản phẩm
			?>
			<div class="col-lg-6 mb-5 ftco-animate">
				<a class="image-popup"><img src="images/<?php echo $row['MA_HINHANH'] ?>" class="img-fluid" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3><?php echo $row['MA_TEN'] ?></h3>
				<p class="price"><span><?php echo number_format($row['MA_GIA']) . ' ' . 'vnđ' ?></span></p>
				<p><?php echo $row['MA_MOTA'] ?></p>
				<form method="POST" action="">
					<input type="hidden" name="MA_MA" Value="<?php echo ($row['MA_MA'])?>">
						<div class="input-group col-md-6 d-flex mb-3">
							<input type="number" name="MA_SL" class="form-control" value="1" min="1" max="100">
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn" name="submit">Thêm vào giỏ hàng</button>
						</div>
				</form>
	<?php
			        }
			    } else {
			        // Nếu không có kết quả tìm kiếm
			        echo "<p>Không tìm thấy sản phẩm nào phù hợp.</p>";
			    }
			} else {
			    // Nếu không có dữ liệu tìm kiếm, bạn có thể hiển thị thông tin sản phẩm theo một cách nào đó
			}
			?>

		</div>
	</div>
</section>

<?php
$actitive = "product-single";
@include('footer.php');
?>
