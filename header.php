<?php 
	// @include('config/config.php');
	@include('lib/session.php');
	session::init();
	ob_start()
	

?>
<?php
	@include_once('lib/database.php');
	@include_once('helpers/format.php');
	@include_once('./getfeedback.php');
	
	spl_autoload_register(function ($class) {
		include 'classes/' . $class . '.php';
	});
	
	$db = new Database();
	$fm = new Format();
	$product = new product();
	$feedback = new feedback();
	$ct = new cart();
	$cs = new customers();
	$rv = new review();
?>
<?php
if(!isset($_SESSION['KH_MA'])) {
	$_SESSION['KH_MA']=8;
	}
?>
<?php


if(!isset($_SESSION['HD_MA'])) {
		$addorder = $ct->add_order();
		
	}
	else {
		$HD_MA = $_SESSION['HD_MA'];
	}

	
	
	
?>
<!DOCTYPE HTML>
<HTML lang="en">
  <head>
  <!-- <link rel="icon" href="images/12.png" type="image/x-icon"> -->
  <link rel="icon" type="" sizes="16x16"  href="images/NLNLOGO.png">

    <title>FOXFOOD</title>
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="goto-here">
		<div class="py-1 bg-primary">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">24032002</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">foxfood@email.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <!-- <span class="text">3-5 Business days delivery &amp; Free Returns</span> -->
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">FOXFOOD</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
				<div class="form-group">
					<form action="product-single.php" method="GET">
						<input class="input" name="timkiem" placeholder="Tìm món ăn...">
						<button type="submit" class="search-btn">Tìm kiếm</button>
					</form>
				</div>
		
	          <li class="nav-item active"><a href="index.php" class="nav-link">Trang chủ</a></li>
			  <li class="nav-item active"><a href="shop.php" class="nav-link">Món ăn</a></li>
	         
	          <li class="nav-item active"><a href="cartindex.php" class="nav-link">Giỏ hàng</a></li>
			  <li class="nav-item active"><a href="showhoadon.php" class="nav-link">Đơn hàng </a></li>

			  <li class="nav-item dropdown">
				<?php
					$login = session::get ('customer_login');
					if($login == false) {
						echo '									
								<li class="nav-item"><a href="contact.php" class="nav-link">Đăng nhập</a></li>';
					}	
					else {
						echo '	<li class="nav-item"><a class="nav-link">Xin chào '.session::get('KH_TEN').'</a></li>
						<li class="nav-item"><a href="logout.php" class="nav-link">Đăng xuất</a></li>';
					}
				?>     
	        </ul>
	      </div>

	    </div>
	  </nav>

	  <!-- <script>
function searchFood() {
    // Get the search keyword
    var keyword = document.getElementById("searchInput").value.trim().toLowerCase();
    
    // Perform search logic here (replace with your own logic)
    // For demonstration, I'll just display a message with the searched keyword
    var searchResults = document.getElementById("searchResults");
    searchResults.innerHTML = "<p>Kết quả tìm kiếm cho: <strong>" + keyword + "</strong></p>";
}
</script> -->
    <!-- END nav -->
<?php
// <a class="nav-link" href="congtacvien/login.php" >Đăng nhập cộng tác viên</a>
	// echo Session::get('KH_MA');
	// echo Session::get('HD_MA');
?>