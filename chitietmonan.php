<?php
$activate = "product";
ob_start();
@include('header.php');


?>

<?php
if (!isset($_GET['maid']) || $_GET['maid'] == NULL) {
} else {
	$id = $_GET['maid'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$MA_SL = $_POST['MA_SL'];
	$MA_MA = $_POST['MA_MA'];
	$addcart = $ct->add_cart($MA_SL, $MA_MA);
	if (isset($addcart)) {
		echo $addcart;
	}
}


?>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<?php
			if (isset($addcart)) {
				echo $addcart;
			}
			?>
			<?php
			$get_product = $product->getproductbyId($id);
			if (isset($get_product)) {
				while ($result = $get_product->fetch_assoc()) {
			?>
					<div class="col-lg-6 mb-5 ftco-animate">
						<a class="image-popup"><img src="images/<?php echo $result['MA_HINHANH'] ?>" class="img-fluid" alt="Colorlib Template"></a>
					</div>
					<div class="col-lg-6 product-details pl-md-5 ftco-animate">
						<h3><?php echo $result['MA_TEN'] ?></h3>
						<p class="price"><span><?php echo number_format($result['MA_GIA']) . ' ' . 'vnđ' ?></span></p>
						<p><?php echo $result['MA_MOTA'] ?></p>
						<form method="POST" action="">
							<input type="hidden" name="MA_MA" Value="<?php echo ($result['MA_MA'])?>">
								<div class="input-group col-md-6 d-flex mb-3">
									<input type="number" name="MA_SL" class="form-control" value="1" min="1" max="100">
								</div>
								<div class="col-md-12">
									<button type="submit" class="btn" name="submit">Thêm vào giỏ hàng</button>
								</div>
						</form>
			<?php
				}
			}
			?>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Các sản phẩm khác</span>
				<h2 class="mb-4">Có thể bạn muốn xem </h2>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="mitron.php" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">
						<span class="status">30%</span>
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="mitron.php">Mì trộn MH</a></h3>
						<div class="d-flex">
							<div class="pricing">
								<p class="price"><span class="mr-2 price-dc">30.000vnd</span><span class="price-sale">23.000vnd</span></p>
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
									<span><i class="ion-ios-menu"></i></span>
								</a>
								<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
									<span><i class="ion-ios-cart"></i></span>
								</a>
								<a href="#" class="heart d-flex justify-content-center align-items-center ">
									<span><i class="ion-ios-heart"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-2.jpg" alt="Colorlib Template">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="#">Mì cay Itada</a></h3>
						<div class="d-flex">
							<div class="pricing">
								<p class="price"><span>30.000vnd</span></p>
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
									<span><i class="ion-ios-menu"></i></span>
								</a>
								<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
									<span><i class="ion-ios-cart"></i></span>
								</a>
								<a href="#" class="heart d-flex justify-content-center align-items-center ">
									<span><i class="ion-ios-heart"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-3.jpg" alt="Colorlib Template">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="goicuon.php">Gỏi cuốn</a></h3>
						<div class="d-flex">
							<div class="pricing">
								<p class="price"><span>6.000vnd</span></p>
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
									<span><i class="ion-ios-menu"></i></span>
								</a>
								<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
									<span><i class="ion-ios-cart"></i></span>
								</a>
								<a href="#" class="heart d-flex justify-content-center align-items-center ">
									<span><i class="ion-ios-heart"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-4.jpg" alt="Colorlib Template">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="#">Bún đậu mắm tôm</a></h3>
						<div class="d-flex">
							<div class="pricing">
								<p class="price"><span>65.000vnd</span></p>
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
									<span><i class="ion-ios-menu"></i></span>
								</a>
								<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
									<span><i class="ion-ios-cart"></i></span>
								</a>
								<a href="#" class="heart d-flex justify-content-center align-items-center ">
									<span><i class="ion-ios-heart"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- </section> -->

<?php
@include('footer.php');
?>

	<!-- <div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2">4.8</a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;"><?php echo $result['MA_DANHGIA'] ?> <span style="color: #bbb;">Đã đánh giá</span></a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2" style="color: #000;"><?php echo $result['MA_LUOTBAN'] ?><span style="color: #bbb;">Lượt bán</span></a>
							</p>
						</div> -->