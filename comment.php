<?php
$activate = "comment";
@include('header.php');
?>
<?php
if (!isset($_GET['HD_MA']) || $_GET['HD_MA'] == NULL) {
} else {
    $id = $_GET['HD_MA'];
}

$KH_TEN = "";
if (isset($_GET['KH_TEN'])) {
    $KH_TEN = $_GET['KH_TEN']; 
}
?>

<?php
$rv = new review();
if (isset($_POST['submit'])) {
    $HD_MA = isset($_GET['HD_MA']) ? $_GET['HD_MA'] : '';
    $DG_NOIDUNG = isset($_POST['DG_NOIDUNG']) ? $_POST['DG_NOIDUNG'] : '';
    $DG_SAO = isset($_POST['DG_SAO']) ? $_POST['DG_SAO'] : '';
    
    if (!empty($HD_MA) && !empty($DG_NOIDUNG) && !empty($DG_SAO)) {
        $insert_data = $rv->insert_review($HD_MA, $DG_NOIDUNG, $DG_SAO);
        
        if ($insert_data) {
            echo "<script>alert('Đánh giá thành công!');</script>";
        } else {
            echo "<script>alert('Đánh giá không thành công!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}



?> 
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:contact.php');
}
?>

<!-- END nav -->

<div class="hero-wrap hero-bread" style="background-image: url('images/br.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Blog</span></p>
                <h1 class="mb-0 bread">ĐÁNH GIÁ ĐƠN HÀNG</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section contact-section bg-light" >
    <div class="container">
        <div class="row block-6">

            <div class="col-md-12 order-md-last d-flex">
                <form action="" class="bg-white p-5 contact-form" method="POST">
                    <h1 style=" text-align: center;">ĐÁNH GIÁ</h1>
                              <?php
                    $id = Session::get('KH_MA');
                    $get_customers = $cs->show_customers($id);
                    if ($get_customers) {
                      while ($result = $get_customers->fetch_assoc()) {
                    ?>
                    <div class="form-group">
                        <label for="name">Họ tên*</label>
                        <input id="name" type="text" name="KH_TEN" class="form-control" value="<?php echo $result['KH_TEN'] ?>" required>
                    </div>
                    <?php
                  }
                }
                    ?>
                    <div class="form-group">
                        <label for="email">Đơn hàng </label>
                        <input id="email" type="text" name="HD_MA" class="form-control" value="<?php echo isset($_GET['HD_MA']) ? $_GET['HD_MA'] : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Nội dung</label>
                        <textarea id="mess" name="DG_NOIDUNG" id="message" cols="10" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                  <label for="message">Đánh giá</label>
                  <div class="radio-buttons">
                      <input type="radio" id="radio1" name="DG_SAO" value="1">
                      <label for="radio1">1 sao </label>

                      <input type="radio" id="radio2" name="DG_SAO" value="2">
                      <label for="radio2">2 sao </label>

                      <input type="radio" id="radio3" name="DG_SAO" value="3">
                      <label for="radio3">3 sao </label>

                      <input type="radio" id="radio4" name="DG_SAO" value="4">
                      <label for="radio4">4 sao </label>

                      <input type="radio" id="radio5" name="DG_SAO" value="5">
                      <label for="radio5">5 sao</label>


                  </div>
              </div>
              <style>
                .radio-buttons {
                    display: flex;
                    flex-direction: row;
                }

                .radio-buttons input[type="radio"] {
                    margin-right: 10px;
                    transform: scale(0.8);
                }
            </style>
                    <div class="form-group">
                        <button type="submit" name="submit" value="" class="btn py-3 px-4 btn-primary"> Gửi đánh giá</button> 
                    </div>
                </form>
            </div>
          
		
        </div>
    </div> 
</section>
<!-- <script>
    function showMessageBox() {
        var message = "Đã đánh giá thành công!";
        alert(message);
        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('link').value = '';
        var textarea = document.getElementById("mess");
        textarea.value = "";
        console.log(document.getElementById('mess'));

    }
</script> -->

<?php
@include('footer.php');
?>
