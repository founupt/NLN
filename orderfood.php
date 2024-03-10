<?php
$actitive = "index";
@include('header.php');
?>

<?php
$id = Session::get('KH_MA');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $add_cart = $ct->add_cart($_POST, $id);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment'])) {
  $add_order = $ct->add_order($_POST, $id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateta'])) {
  $GH_MA_update = $_POST['GH_MA'];
  $GH_SL_update = $_POST['GH_SL'];
  foreach ($GH_MA_update as $index => $gh_ma) {
    $gh_sl = $GH_SL_update[$index];
    $product_info = $ct->get_product_info($gh_ma);
    if ($gh_sl == 0) {
      $delete_cart = $ct->delete_cart($gh_ma);
    } else {
      $new_price = $product_info['GH_GIA'] * ($gh_sl / $product_info['GH_SL']);
      $up_quantity_cart = $ct->up_quantity_cart($gh_sl, $gh_ma, $new_price);
    }
  }
  }
  // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment'])) {
  //   header('Location: payment.php');
  // }
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate text-center mb-4">
        <h1 class="mb-2 bread">Order food</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
          <span>Orderfood <i class="ion-ios-arrow-forward"></i></span>
        </p>
      </div>
    </div>
  </div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container-fluid px-0">
    <div class="row d-flex no-gutters">
      <div class="col-md-6 order-md-last ftco-animate makereservation p-4 p-md-5 pt-5">
        <div class="py-md-5">
          <div class="heading-section ftco-animate mb-5">
            <span class="subheading">Order food</span>
            <h2 class="mb-4">New order</h2>
          </div>
          <form onsubmit="" action="" method="post">
            <?php
            if (isset($add_cart)) {
              echo $add_cart;
            }
            ?>
            <div class="row">
              <?php
              $get_user = $us->get_usersid($id);
              if ($get_user) {
                while ($result_user = $get_user->fetch_assoc()) {
              ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="KH_TEN" class="form-control" value="<?php echo $result_user['KH_TEN'] ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input id="email" type="text" name="KH_EMAILKH" class="form-control" value="<?php echo $result_user['KH_EMAIL'] ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Phone</label>
                      <input id="sdt" type="text" name="KH_SDT" class="form-control" value="<?php echo $result_user['KH_SDT'] ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Address</label>
                      <input id="dc" type="text" name="KH_DIACHI" class="form-control" value="<?php echo $result_user['KH_DIACHI'] ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Meals</label>
                      <div class="select-wrap one-third">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select id="meal" name="TA_MA" class="form-control" onchange="updatePrice()">
                          <option>Chọn thức ăn</option>
                          <?php
                          $getpd = $product->getproduct_name();
                          if ($getpd) {
                            while ($result_name = $getpd->fetch_assoc()) {
                              $selected = ($_POST['TA_MA'] == $result_name['TA_MA']) ? 'selected' : '';
                              echo '<option value="' . $result_name['TA_MA'] . '" ' . $selected . '>' . $result_name['TA_TEN'] . '</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Price</label>
                      <span id="price-display" type="number" name="GH_GIA" class="form-control">
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Quality</label>
                      <input id="number" type="number" name="GH_SL" class="form-control" placeholder="Quality" min="1">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Notice</label>
                      <textarea id="note" type="text" name="GH_GHICHU" class="form-control" placeholder="Notice..."></textarea>
                    </div>
                  </div>

                  <div class="col-md-12 mt-3">
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary py-3 px-5">Add order</button>
                    </div>
                  </div>
            </div>
        <?php
                }
              }
        ?>
          </form>
        </div>
      </div>
      <div class="col-md-6 order-md-last ftco-animate makereservation p-4 p-md-5 pt-5">
        <div class="py-md-5">
          <div class="heading-section ftco-animate mb-5">
            <span class="subheading">Order food</span>
            <h2 class="mb-4">Your order</h2>
          </div>
          <form onsubmit="" action="" method="post">
            <?php
            if (isset($up_quantity_cart)) {
              echo $up_quantity_cart;
            }
            ?>
            <?php
            if (isset($delete_cart)) {
              echo $delete_cart;
            }
            ?>
            <?php
            if (isset($add_order)) {
              echo $add_order;
            }
            ?>
            <div class="row">
              <?php
              $get_dishes = $ct->getproduct_cart();
              $get_name = $product->getname();

              $total_price = 0;

              if ($get_dishes && $get_name) {
                while ($result_dishes = $get_dishes->fetch_assoc()) {
                  $resultname = $get_name->fetch_assoc();
                  $total_price += $result_dishes['GH_GIA'];
              ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tên món ăn</label>
                      <input type="hidden" name="TA_MA[]" class="form-control" value="<?php echo $resultname['TA_MA']; ?>">
                      <input type="text" name="TA_TEN[]" class="form-control" value="<?php echo $resultname['TA_TEN']; ?>">
                      <label for="">Giá tiền</label>
                      <input type="text" name="GH_GIA[]" class="form-control" value="<?php echo number_format($result_dishes['GH_GIA']) .' '. 'VNĐ'; ?>">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Số lượng</label>
                      <input type="hidden" name="GH_MA[]" class="form-control" value="<?php echo $result_dishes['GH_MA']; ?>">
                      <input type="number" name="GH_SL[]" class="form-control" value="<?php echo $result_dishes['GH_SL']; ?>" min="0">
                      <button type="submit" name="updateta[]" class="btn btn-dark">Cập nhật số lượng</button>
                    </div>
                  </div>
              <?php
                }
                echo '<div class="col-md-6">
                        <div class="form-group">
                          <label for="">Tổng giá đơn hàng</label>
                          <input type="text" name="total_price" class="form-control" value="' . number_format($total_price) .' '. 'VNĐ'.'" readonly>
                        </div>
                      </div>
                      <div class="col-md-12 mt-3">
                        <div class="form-group">
                          <button type="submit" name="payment" class="btn btn-primary py-3 px-5">Payment</button>
                        </div>
                      </div>';
              } else {
                echo '<div class="col-md-6">
                        <div class="form-group">
                          <label for="">Bạn chưa có đơn hàng!!!</label>
                        </div>
                      </div>';
              }
              ?>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</section>


<?php 
@include('footer.php');
?>