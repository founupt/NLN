<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    @include('../classes/brand.php');
?>
<?php
    @include('../classes/type.php');
?>
<?php
    @include('../classes/review.php');
?>
<?php
    @include_once('../helpers/format.php');
?>
 <?php
        @include('../classes/cart.php');
    ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Chi tiết bài đăng</h2>
        <div class="block">  
             <?php
            if (!isset($_GET['DG_MA']) || $_GET['DG_MA'] == NULL) {
            } else {
                $id = $_GET['DG_MA'];
            }
            $KH_TEN = "";
            if (isset($_GET['KH_TEN'])) {
                $KH_TEN = $_GET['KH_TEN']; 
            }
            ?>
            <?php
            $pd = new review();
            if (isset($_GET['DG_MA'])) {
                $id = $_GET['DG_MA'];
                $delete_pro = $pd -> delete_review($id);
            }
        ?>
            <?php
            $rv = new review();
			$get_review = $rv->getreviewbyId($id);
			if ($get_review) {
				while ($result = $get_review->fetch_assoc()) {
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Mã hóa đơn</th>
					<th>Mã bài đăng</th>
					<th>Nội dung </th>
					<th>Sao </th>
				</tr>
			</thead>
			<tbody>

			<?php
                        $conn = new mysqli("localhost", "root", "", "food"); 
						$review = new review();
						$rv_list = $review->show_dg(); 
                        if ($rv_list) {
                            $i=0;
                            while ($pay_item = $rv_list->fetch_assoc()) {
                            $i++;
                            $HD_MA = $pay_item['HD_MA'];
                ?>
						  <tr class="odd gradeX">
                                <td><?php echo $i?></td>
									<td><?php echo $pay_item['HD_MA']; ?></td>
									<td><?php echo $pay_item['DG_MA']; ?></td>
                                    <td><?php echo $pay_item['DG_NOIDUNG']; ?></td>
                                    <td><?php echo $pay_item['DG_SAO']; ?></td>
                                    <td><a onclick =  "return confirm ('Bạn có chắc muốn xóa không???')" href="?DG_MA=<?php echo $result['DG_MA'] ?>">Delete</a></td>

                                </tr>
			<?php
				}
			}
			?>
			</tbody>
		</table>

       </div>
    </div>
</div>
<?php
				}
			}
			?>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
 