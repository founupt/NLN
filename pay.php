<?php
session_start();
$active = "pay";
@include('header.php');
?>
<?php
if (isset($_GET['GH_MA']) && $_GET['GH_MA']=='GH_MA' ) {
	$id = Session::get('KH_MA');
	$get_customers = $cs->get_customersid($id);
	$insert_order = $ct->insert_order($id);
}
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
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>PAYMENT</span></p>
				<h1 class="mb-0 bread">PAYMENT</h1>
			</div>
		</div>
	</div>
</div>


<!-- SECTION -->
<section class="ftco-section contact-section bg-light">
	<!-- container -->
	<?php
			if (isset($insert_order)) {
				echo $insert_order;
			}
			?>
	<div class="container">

		<!-- row -->
		<!-- <div class="row"> -->
			
		<div class="row block-9">
			<div class="col-md-6 order-md-last d-flex">
				<form class="bg-white p-5 contact-form">
						<h3 class="title" style="text-align: center;">Địa chỉ của bạn</h3>
					<?php
					$id = Session::get('KH_MA');
					$get_customers = $cs->show_customers($id);
					if ($get_customers) {
						while ($result = $get_customers->fetch_assoc()) {
					?>
							<div class="form-group">
								<input class="form-control1" type="text" name="KH_TEN" value="<?php echo $result['KH_TEN'] ?>">
							</div>
							<div class="form-group">
								<input class="form-control1" type="email" name="KH_EMAIL" value="<?php echo $result['KH_EMAIL'] ?>">
							</div>
							<div class="form-group">
								<input class="form-control1" type="text" name="KH_DIACHI" value="<?php echo $result['KH_DIACHI'] ?>">
							</div>
							<div class="form-group">
								<input class="form-control1" type="tel" name="KH_SDT" value="<?php echo $result['KH_SDT'] ?>">
							</div>
							<div class="order-notes">
					<textarea class="input" type="text" name="HD_GHICHU" placeholder="Ghi chú cho chúng tôi"></textarea>
			</form>
		</div>
				
		<?php
						}
					}
		?>
		<!-- /Order notes -->
	</div>

			<!-- Order Details -->
		
          <div class="col-md-6 order-md-last d-flex">
		  	<form class="bg-white p-5 contact-form">

					<h3 class="title">Đơn hàng của bạn</h3>
				
				<div class="form-group">
					<?php
					$getproduct_payment = $ct->getproduct_payment();
					if ($getproduct_payment) {
						$subtotal = 0;
						$sl = 0;
						while ($result = $getproduct_payment->fetch_assoc()) {
					?>
							<div class="order-products">
								<div class="order-col">
								<p class="form-control1">
									<?php 
										echo "Số lượng món: " . $result['GH_SL'] . " phần " . $result['MA_TEN'];
									?>
								</p>

								<p class="form-control1">
										<?php 
											$total = $result['MA_GIA'] * $result['GH_SL'];
											echo "Giá tiền: " . number_format($total) . " VNĐ";
										?>
									</p>

								</div>
							</div>
					<?php
							$subtotal += $total;
							$sl = $sl + $result['GH_SL'];
						}
					}
					?>

					
					<!-- <div class="form-group">
						<?php
						$check_cart = $ct->check_cart();
						if ($check_cart) {
							echo '<div class="form-control1">Tổng tiền đơn hàng</div>
										<div><strong> ' . number_format($subtotal) . ' ' . 'VNĐ</strong></div>';
							Session::set("sum", $subtotal);
							Session::set("sl", $sl);
						} else {
							echo '';
						}
						?>
					</div> -->
			
					<div class="form-group">
					<?php
						$check_cart = $ct->check_cart();
						if ($check_cart) {
							$vat = $subtotal * 0.1;
							echo '<div class="form-control1">Phí Ship: </div>
								<span class="shipping-amount"><strong>' . number_format($vat) . ' VNĐ</strong></span>';
						} else {
							echo '';
						}
						?>
					</div>
					<div class="form-group">
						<?php
						$check_cart = $ct->check_cart();
						if ($check_cart) {
							$vat = $subtotal * 0.1;
							$gtotal = $subtotal + $vat;
							echo '<div><strong>Tổng đơn hàng gồm phí ship</strong></div>
											<div><strong class="order-total">' . number_format($gtotal) . ' VNĐ</strong></div>';
						} else {
							echo 'Giỏ hàng trống! Hãy đặt hàng <3';
						}
						?>
					</div>
				</div>
				<div style="text-align: left;" class="payment-method">
					<div class="input-radio">
						<input  style="text-align: left;" type="radio" name="payment" id="payment-1">

						<span style="text-align: left;">Thanh toán khi nhận hàng</span>



					</div>
				</div>
				<div class="input-checkbox" style="text-align: left;">
					<input type="checkbox"  id="terms"> <a>Tôi đã đọc và chấp nhận <a href="#">điều khoản và điều kiện</a></a>
					<label for="terms">
						<span></span>

					</label>
				</div>
				<h4>
					<a href="?GH_MA=GH_MA" name="GH_MA" class="primary-btn order-submit">Đặt hàng</a>
				</h4>
					</form>
					
			</div>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</section>
<!-- /SECTION -->
<?php
@include('footer.php');
?>