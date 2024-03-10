

<head>
    <title>ĐĂNG KÝ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="dangky.css" />
</head>

<body>
    <?php
		// require_once("../connect.php");
		if (isset($_POST["dangky"])) {
  			//lấy thông tin từ các form bằng phương thức POST
			    $KH_TEN = $_POST["KH_TEN"];
			    $KH_SDT = $_POST["KH_SDT"];
			    $KH_EMAIL = $_POST["KH_EMAIL"];
  			    $KH_USERNAME = $_POST["KH_USERNAME"];
  			    $KH_PASSWORD = $_POST["KH_PASS"];
                $KH_DIACHI= $_POST["KH_DIACHI"];
			    

  			//Kiểm tra điều kiện bắt buộc đối với các field KHông được bỏ trống
			  if ($KH_USERNAME == "" || $KH_PASSWORD == ""||$KH_DIACHI == "" || $KH_TEN == "" || $KH_SDT == ""|| $KH_EMAIL == "" ) {
				   echo "bạn vui lòng nhập đầy đủ thông tin";
				//    if ($KH_PASSWORD !== $confirm_password) {
				// 	echo "Mật khẩu và xác nhận mật khẩu không trùng khớp";
				// }
  			}else{
  					// Kiểm tra tài khoản đã tồn tại chưa
                      $sql = "SELECT KH_PASSWORD FROM khachhang WHERE KH_USERNAME = '".$KH_USERNAME."'";
					$kt=mysqli_query($conn, $sql);
					if(mysqli_num_rows($kt)  > 0){
						echo "Tài khoản đã tồn tại";
					}else{
						//thực hiện việc lưu trữ dữ liệu vào db
	    				$sql = "INSERT INTO khachhang(
							
							KH_USERNAME,
							KH_PASSWORD,
							KH_DIACHI,
                            KH_HOTEN,
                            KH_SDT,
							KH_EMAIL
						) VALUES (
							'$KH_USERNAME',
							'$KH_PASSWORD',
							'$KH_DIACHI',
                            '$KH_HOTEN',
                            '$KH_SDT',
							'$KH_EMAIL'
						)";
					    // thực thi câu $sql với biến conn lấy từ file connection.php
                        if (mysqli_query($conn, $sql)) {
							echo '<script>alert("Đăng ký thành công! Vui lòng đăng nhập lại!");
                            location="login.php";</script>'; 
							
                            exit();
                        } else {
                            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                        }
                        
					}
									    
					
			  }
	}
	?>
      
        <div style="text-align:center" >
            
            <div class="row">
            <form  action="lienlac.php" method="post">
                <div class="col-12">
                    <label for="hoten" class="form-label">Họ và tên:<span class="error"></span> </label>
                    <input type="text" class="form-control" id="hoten" placeholder="Nhập tên của bạn" name="ten" required>
                </div>
                <div class="col-12">
                    <label for="mail" class="form-label">Email:<span class="error">*</span> </label>
                    <input type="mail" class="form-control" id="mail" placeholder="Nhập địa chỉ email của bạn" name="mail" required>
                </div>
                <div class="col-md-6">
                    <label for="inputNumberl4" class="form-label">Số điện thoại:<span class="error" ></span></label>
                    <input type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại của bạn" name="sdt" required>
                </div>
                <div class="col-md-12">
                    <label for="diachi" class="form-label">Địa chỉ:<span class="error">                                          </span></label>
                    <input type="text" class="form-control" id="diachi" placeholder="Nhập địa chỉ của bạn" name="diachi" required>
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">Tên đăng nhập:<span class="error">*                                           </span></label>
                    <input type="text" class="form-control" id="username" placeholder="Nhập tên đăng nhập" name="tk" required>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Mật khẩu:<span class="error">*</span></label>
                    <input type="password" class="form-control" id="matkhau" placeholder="Nhập mật khẩu" name="mk" required>
                </div>
                <!-- <div class="col-md-6">
                    <label for="confirm_password" class="form-label">Nhập lại mật khẩu:<span class="error">*</span></label>
                    <input type="password" class="form-control" id="confirm_mk" placeholder="Nhập lại mật khẩu" name="confirm_mk" required>
                </div> -->
                <!-- <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Quận Huyện<span class="error">*</span></label>
                    <select class="form-select form-control" id="qh" name="qh">
                        <option value="" selected>Chọn quận/huyện</option>
                           
                                            
                                // Truy vấn để lấy danh sách quận/huyện
                                // $sql = "SELECT q_ma,q_ten FROM quan_huyen";
                                // $result = $conn->query($sql);

                                // if ($result->num_rows > 0) {
                                // while ($row = $result->fetch_assoc()) {
                                //     echo '<option value="' . $row["q_ma"] . '">' . $row["q_ten"] . '</option>';
                                //     }
                                // }

                    // Đóng kết nối đến cơ sở dữ liệu
                    $conn->close();
                        ?>
                        </select> -->
                <!-- </div> -->
            <div class="col-md-12">      
                <button type="submit"  class="btn btn-primary py-3 px-5"  name="dangky">Đăng ký</button>
            </div>
            </form>
           
            </div>
        </div>
        <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
</body>

</html>
<script>
				 function showMessageBox() {
    			var message = "Đăng kí thành công !";
    			alert(message);
            }
		 </script>
