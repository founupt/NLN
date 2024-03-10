<?php 
@include('../classes/ctvlogin.php');
?>
<?php 
$class= new CTVlogin();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$CTV_username 	= $_POST['CTV_username'];
	$CTV_pass 		= $_POST['CTV_pass'];

	$login_check = $class->login_CTV($CTV_username,$CTV_pass);
  }
?>
<div class="slider-item" style="background-image: url(../images/background.jpg);">

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Cộng tác viên</h1>
			<span> <?php
			if(isset($login_check)){
				echo $login_check;
			}
			?></span>
			<div>
				<input type="text" placeholder="Username"  name="CTV_username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="CTV_pass"/>
			</div>
			<div>
				<input type="submit" value="Đăng nhập" />
			</div>
		</form><!-- form -->
		<!-- <div class="button">
			<a href="#">Ngue</a>
		</div>button -->
	</section><!-- content -->
</div><!-- container -->
</div>
</body>
</html>