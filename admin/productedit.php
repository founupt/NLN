<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php @include('../classes/brand.php');?>
<?php @include('../classes/type.php');?>
<?php @include('../classes/product.php');?>

<?php 
    $pd = new product();
    if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
        echo "<script>window.location = 'productlist.php'</script>";
    } else {
        $id = $_GET['productid'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $update_pro = $pd->update_product($_POST,$_FILES,$id);
    }   
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
        <?php 
            if(isset($update_pro)){
                echo $update_pro;
            }
        ?>
        <?php 
            $get_product_byid = $pd ->getproductbyId($id);
            if($get_product_byid){
                while($result_product = $get_product_byid->fetch_assoc()){               
        ?>        
         <form action=" " method="post" enctype="multipart/form-data">
            <table class="form">
         
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name = "MA_TEN" value="<?php echo $result_product['MA_TEN']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Loại món ăn</label>
                    </td>
                    <td>
                        <select id="select" name="LMA_MA">
                            <option>Chọn mã loại</option>
                            <?php
                                $cat = new type();
                                $catlist = $cat->show_type();
                                if($catlist){
                                    while($result = $catlist -> fetch_assoc()){
                            ?>
                            <option 
                            <?php if($result['LMA_MA']==$result_product['LMA_MA']) { echo 'selected'; }?>
                            value="<?php echo $result['LMA_MA']?>"><?php echo $result['LMA_TEN']?></option>
                            <?php
                               }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả món ăn</label>
                    </td>
                    <td>
                        <textarea name="MA_MOTA" class="tinymce" <?php echo $result_product['MA_MOTA']?>></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá gốc</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result_product['MA_GIA']?>" name="MA_GIA"  class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh sản phẩm</label>
                    </td>
                    <td>
                        <img src="../images/ <?php echo $result_product['MA_HINHANH']?>" width="80px"><br>
                        <input type="file" name="MA_HINHANH"/>
                    </td>
                </tr>

				<!-- <tr>
                    <td>
                        <label>Màu sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" value="" name="SP_MAU"  class="medium" />
                    </td>
                </tr> -->

                
                <tr>
                    <td>
                        <label>Tình trạng sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="MA_TINHTRANG">
                            <option>Chọn tình trạng</option>
                            <?php
                            if($result_product['MA_TINHTRANG']==0){
                            ?>
                                <option selected value="0">Còn món</option>
                                <option value="1">Hết món</option>
                            <?php
                            }else{
                                ?> 
                                <option value="0">Còn món</option>
                                <option selected value="1">Hết món</option>
                            <?php
                            }
                            ?>   
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


