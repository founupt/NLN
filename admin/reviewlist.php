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
<?php
	$rv = new review();
	if (isset($_GET['reviewid'])) {
        $id = $_GET['reviewid'];
		$delete_pro = $rv -> delete_review($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách bài đăng</h2>
        <div class="block">  
			<?php
			if(isset($delete_pro)){
				echo $delete_pro;
			}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Mã hóa đơn</th>
					<th>Mã bài đăng</th>
					<th style="width: 1163px; text-align: center;">Nội dung </th>
					<th>Sao </th>
					<th>Thao tác</th>
			</tr>
			</thead>
			<tbody>

			<?php
                        $conn = new mysqli("localhost", "root", "", "food"); // Khai báo biến $conn ở đây
						$review = new review();
						$rv_list = $review->show_dg(); // Hàm get_pay_list() là một phương thức trong lớp Pay để lấy danh sách hóa đơn
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
									<td><span class="full-content"><?php echo $pay_item['DG_NOIDUNG']; ?></span></td>
                                    <td><?php echo $pay_item['DG_SAO']; ?></td>
									<td><a onclick="return confirm('Bạn có chắc muốn xóa không???')" href="?reviewid=<?php echo $pay_item['DG_MA'] ?>">Delete</a></td>

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
<style>
    .full-content {
        max-height: 100px; /* Đặt chiều cao tối đa của cột "Nội dung" */
        overflow: hidden; /* Ẩn nội dung tràn ra ngoài */
        text-overflow: ellipsis; /* Hiển thị dấu chấm ba (...) khi nội dung bị cắt */
        white-space: nowrap; /* Ngăn chặn việc xuống dòng trong cột */
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
 