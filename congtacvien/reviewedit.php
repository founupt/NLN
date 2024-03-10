<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php @include('../classes/type.php');?>
<?php @include('../classes/review.php');?>

<?php 
    $pd = new review();
    if (!isset($_GET['reviewid']) || $_GET['reviewid'] == NULL) {
        echo "<script>window.location = 'reviewlist.php'</script>";
    } else {
        $id = $_GET['reviewid'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $update_review = $pd->update_review($_POST,$_FILES,$id);
    }   
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa review</h2>
        <div class="block">
        <?php 
        
            if(isset($update_review)){
                echo $update_review;
            }
        ?>
        <?php 
            $get_review_byid = $pd ->getreviewbyId($id);
            if($get_review_byid){
                while($result_review = $get_review_byid->fetch_assoc()){               
        ?>        
         <form action=" " method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tiêu đề</label>
                    </td>
                    <td>
                        <input type="text" name = "BV_TIEUDE" value="<?php echo $result_review['BV_TIEUDE']?>" class="medium" />
                    </td>
                </tr>
				
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Nội dung bài viết</label>
                    </td>
                    <td>
                        <textarea name="BV_NOIDUNG" class="tinymce" <?php echo $result_review['BV_NOIDUNG']?>></textarea>
                    </td>
                </tr>
				<!-- <tr>
                    <td>
                        <label>Giá gốc</label>
                    </td>
                    <td>
                        <input type="text" value="" name="MA_GIA"  class="medium" />
                    </td>
                </tr>
             -->
                <tr>
                    <td>
                        <label>Hình ảnh sản phẩm</label>
                    </td>
                    <td>
                        <img src="../images/ <?php echo $result_review['BV_HINHANH']?>" width="80px"><br>
                        <input type="file" name="BV_HINHANH"/>
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
                        <select id="select" name="BV_TINHTRANG">
                            <option>Chọn tình trạng</option>
                            <?php
                            if($result_review['BV_TINHTRANG']==0){
                            ?>
                                <option selected value="0"> Duyệt </option>
                                <option value="1">Không Duyệt</option>
                            <?php
                            }else{
                                ?> 
                                <option value="0">Duyệt</option>
                                <option selected value="1">Không duyệt</option>
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


