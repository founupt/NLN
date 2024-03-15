<?php
$activate = "comment";
@include('header.php');
?>
	 
    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/br.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Blog</span></p>
            <h1 class="mb-0 bread">FEEDBACK</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light" >
      <div class="container">
        <div class="row block-9">
     
          <div class="col-md-6 order-md-last d-flex">
           <form onsubmit="showMessageBox()" action="" class="bg-white p-5 contact-form" method="POST">
              <h1 style=" text-align: center;">ĐÁNH GIÁ</h1>
                  <div class="form-group">
                    <label for="name">Họ tên*</label>
                    <input id="name" type="text" class="form-control"  required>
                  </div>
                  <div class="form-group">
                    <label for="email">Đơn hàng </label>
                    <input id="email" type="email" class="form-control"  required>
                  </div>
                  <div class="form-group">
                    <label for="website">Hình ảnh</label>
                    <input id="link" type="url" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label for="message">Ghi chú</label>
                    <textarea id="mess" name="" id="message" cols="30" rows="10" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <button onsubmit="showMessageBox()" type="submit" value="" class="btn py-3 px-4 btn-primary"> Post comment</button> 
                  </div>
            </form>
          </div>

              
            </div>
          </div> 
     </section>
          <script>
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
              
					    </script>

    <?php
    @include('footer.php');
    ?>