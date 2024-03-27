<?php
session_start();
$active = "xulihoadon";
@include('header.php');
	
?>
<?php
if (isset($_GET['HD_MA']) && !empty($_GET['HD_MA'])) {
	$KH_MA = Session::get('KH_MA');
	$HD_MA = Session::get('HD_MA');
	$insert_order = $ct->insert_order($HD_MA,$KH_MA);
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
				<p class="breadcrumbs"><span class="mr-2"><a href="index.php">TRANG CHỦ</a></span> <span>TRẠNG THÁI HÓA ĐƠN</span></p>
				<h1 class="mb-0 bread"></h1>
			</div>
		</div>
	</div>
</div>
<div class="row" id="watch">
            <?php

            $sql = "SELECT * FROM hoadon  WHERE HD_MA = $HD_MA";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc()

                ?>

            <?php
            if ($row['HD_TRANGTHAI'] == 1) {
                echo '<div class="col-lg-4 col-md-4 text-center">
                        <div class="services services-2 w-100">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="far fa-check-circle fa-lg"></span></div>
                            <div class="text w-100">
                                <h3 class="heading mb-2">Đang chờ xác nhận</h3>
                            </div>
                            <span>Đang đặt</span>
                        </div>
                    </div>';
            } else {
                echo '<div class="col-lg-4 col-md-4 text-center">
                        <div class="services services-2 w-100">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="far fa-check-circle fa-lg"></span></div>
                            <div class="text w-100">
                                <h3 class="heading mb-2">Đang chờ xác nhận</h3>
                            </div>
                        </div>
                    </div>';
            }
            ?>

            <div class="col-md-4 text-center arrow">
                <div class="services services-2 w-100 ">
                    <div class="icon d-flex align-items-center justify-content-center  <?php if ($row['HD_TRANGTHAI'] != 2 && $row['HD_TRANGTHAI'] != 3)
                        echo 'disable' ?> ">
                            <span class="flaticon-route"></span>
                        </div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">Đang thực hiện</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center arrow">
                    <div class="services services-2 w-100">
                        <div class="icon d-flex align-items-center justify-content-center  <?php if ($row['HD_TRANGTHAI'] != 3)
                        echo 'disable' ?> ">
                            <span class="fas fa-laugh-beam"></span>
                        </div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">Đã hoàn thành</h3>
                        </div>
                    </div>
                </div>

                <?php
                    $sql = "SELECT * FROM chuyenxe  WHERE HD_MA = $HD_MA";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row["HD_TRANGTHAI"] == 3) {
                                ?>
                        <div class="container-fluid mt-4 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-secondary p-3" onclick="redirectPage()"
                                style="color:blueviolet;">Đánh giá </button>
                        </div>
                        <?php
                            }
                        }
                    } else {
                        echo '';
                    }
                    ?>
        </div>
    </div>
</section>


<?php
$active = "xulihoadon";
@include('footer.php');
	
?>