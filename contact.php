
<?php
$actitive = "contact";
@include('header.php');
@include('../classes/customers.php');
?>

<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "food"; 

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Kết nối đến CSDL thất bại: " . mysqli_connect_error());
}
?>
   <!-- END nav -->
   <?php
		
      if (isset($_POST["dangky"])) {
          //lấy thông tin từ các form bằng phương thức POST
			    $KH_TEN = $_POST["KH_TEN"];
			    $KH_SDT = $_POST["KH_SDT"];
			    $KH_EMAIL = $_POST["KH_EMAIL"];
  			  $KH_USERNAME = $_POST["KH_USERNAME"];
  			  $KH_PASS = $_POST["KH_PASS"];
          $KH_DIACHI= $_POST["KH_DIACHI"];
			    

			  if ($KH_USERNAME == "" || $KH_PASS == ""||$KH_DIACHI == "" || $KH_TEN == "" || $KH_SDT == ""|| $KH_EMAIL == "" ) {
				   echo "bạn vui lòng nhập đầy đủ thông tin";
			
  			}else{
  					
          $sql = "SELECT * FROM khachhang WHERE KH_USERNAME = '".$KH_USERNAME."'";
					$kt=mysqli_query($conn, $sql);
					if(mysqli_num_rows($kt)  > 0){
						echo "Tài khoản đã tồn tại";
					}else{
						//thực hiện việc lưu trữ dữ liệu vào db
	    				$sql = "INSERT INTO khachhang(
							KH_USERNAME,
							KH_PASS,
							KH_DIACHI,
              KH_TEN,
              KH_SDT,
							KH_EMAIL
						) VALUES (
							'$KH_USERNAME',
							'$KH_PASS',
							'$KH_DIACHI',
              '$KH_TEN',
              '$KH_SDT',
							'$KH_EMAIL'
						)";
					    // thực thi câu $sql với biến conn lấy từ file connection.php
                        if (mysqli_query($conn, $sql)) {
							              echo '<script>alert("Đăng ký thành công! Vui lòng đăng nhập lại!");
                            location="contact.php";</script>';
                            exit();
                        } else {
                            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                        }
					}
									    
					
			  }
	}
  $class = new customers();
    if (isset($_POST["dangnhap"])) {
        $KH_USERNAME = $_POST["KH_USERNAME"];
        $KH_PASS = $_POST["KH_PASS"];
        
        $login_check = $class->login_customers ($KH_USERNAME, $KH_PASS);
        unset($_SESSION['HD_MA']);
        $del_empty_cart = $ct->del_empty_cart();
    }
	?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/br.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>ĐĂNG KÍ</span></p>
            <h1 class="mb-0 bread">ĐĂNG KÍ KHÁCH HÀNG THÀNH VIÊN</h1>
          </div>
        </div>
      </div>
    </div>
   
    <section class="ftco-section contact-section bg-light">
      <div class="container">
        
   <!-- dangki -->
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form onsubmit="showMessageBox()" action="#" class="bg-white p-5 contact-form" method="post">
                    <h1 style=" text-align: center;">ĐĂNG KÍ</h1>
              <div class="form-group">
                <input id="name" name="KH_TEN" type="text" class="form-control" placeholder="Họ và tên" required>
              </div>
              <div class="form-group">
                <input id="email" name="KH_EMAIL" type="text" class="form-control" placeholder=" Email" required>
              </div>
              <div class="form-group">
                <input id="sdt" type="text" name="KH_SDT" class="form-control" placeholder="Số điện thoại" required>
              </div>
              <div class="form-group">
                <input id="username" type="text" name="KH_USERNAME" class="form-control" placeholder="Tên đăng nhập" required>
              </div>
              <div class="form-group">
                <input id="password" type="text" name="KH_PASS" class="form-control" placeholder="Mật khẩu" required>
              </div>
              <div class="form-group">
                <textarea id="address" name="KH_DIACHI"  cols="30" rows="7" class="form-control" placeholder="Địa chỉ" required></textarea>
              </div>
              <div class="form-group">
              
                <button onsubmit="showMessageBox()" class="btn btn-primary py-3 px-5" type="submit" name="dangky">Đăng kí</button>         
            <!-- <script>
						    function showMessageBox() {
    						var message = "Đã đăng kí thành công!";
    						alert(message);
                document.getElementById('name').value = '';
                document.getElementById('email').value = '';
                document.getElementById('sdt').value = '';
                document.getElementById('username').value = '';
                document.getElementById('password').value = '';
                var textarea = document.getElementById("address");
                    textarea.value = "";
                console.log(document.getElementById('address'));
             
							}
              
					    </script> -->
            
              </div>
            </form>
          </div>
          <!-- đangnhap -->
          <div class="col-md-6 order-md-last d-flex">
          <form action="#" class="bg-white p-5 contact-form" method="post">
          
          <h1 style=" text-align: center;">ĐĂNG NHẬP</h1>
              <span>
                <?php
                if(isset($login_check)){
                  echo $login_check;
                }
                ?>
              </span>
              <div class="form-group">
              
                <p>Tên đăng nhập: </p>
                <span><input type="text" class="form-control" id="KH_USERNAME" name="KH_USERNAME" placeholder="Tên đăng nhập" /></span>
              </div>
              <div class="form-group">
              
              </div>
              <div class="form-group">
              <p>Mật khẩu:</p>
              <input type="password" class="form-control" id="KH_PASS" name="KH_PASS" placeholder="Mật khẩu" />
              </div>
              
              <div class="col-md-12">      
                  <button type="submit"  class="btn btn-primary py-3 px-5"  name="dangnhap">Đăng nhập</button>
              </div>
              <p>Bạn chưa có tài khoản? <a href="contact.php">Đăng ký tại đây</a></p>
          </form>
          </div> 
        </div>

      </div>
    </section>

 

<?php
   @include('footer.php');
?>