<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    @include('../classes/brand.php');
?>
<?php
    @include('../classes/type.php');
?>
<?php
    @include('../classes/product.php');
?>
<?php
    @include_once('../helpers/format.php');
?>
<?php
	$pd = new product();
	if (isset($_GET['productid'])) {
        $id = $_GET['productid'];
		$delete_pro = $pd -> delete_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách món ăn</h2>
        <div class="block">  
			<?php
			if(isset($delete_pro)){
				echo $delete_pro;
			}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Mã món ăn</th>
					<th>Tên món ăn</th>
					<th>Mã loại món ăn</th>
					<th>Giá món ăn</th>
					<th>Hình ảnh món ăn</th>
					<th>Trạng thái món ăn</th>
					<th>Chỉnh sửa sản phẩm</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$pdlist = $pd -> show_product();
				if($pdlist){
					$i = 0;
					while($result = $pdlist ->fetch_assoc()){
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['MA_TEN']?></td>
					<td><?php echo $result['LMA_MA']?></td>
					<td><?php echo $result['MA_GIA']?></td>
					<td><img src="../images/<?php echo $result['MA_HINHANH']?>" width="80px"></td>
					<td><?php 
						if($result['MA_TINHTRANG'] == 0){
							echo 'Còn món';
						}else{
							echo 'Hết món';
						}
					?></td>
					<td><a href="productedit.php?productid=<?php echo $result['MA_MA'] ?>">Edit</a> || 
					<a onclick =  "return confirm ('Bạn có chắc muốn xóa không???')" href="?productid=<?php echo $result['MA_MA'] ?>">Delete</a></td>
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

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
