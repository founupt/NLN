<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    @include('../classes/brand.php');
?>
<?php
    @include('../classes/type.php');
?>
<?php
    @include('../classes/cart.php');
?>
<?php
    @include_once('../helpers/format.php');
?>

<?php 
    // Gọi hàm insert_order khi cần thiết
    if (isset($_POST['submit_button_name'])) { // Thay 'submit_button_name' bằng tên của nút hoặc biểu mẫu
        // Lấy dữ liệu cần thiết từ $_POST nếu cần
        // Ví dụ: $HD_MA = $_POST['HD_MA'];
        //       $KH_MA = $_POST['KH_MA'];
        // Gọi hàm insert_order
        // Ví dụ: $result = insert_order($HD_MA, $KH_MA);
        // Xử lý kết quả nếu cần
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách hóa đơn</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
						<th>STT</th>
					
                        <th>Mã hóa đơn</th>
                        <th>Mã khách hàng</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lấy danh sách hóa đơn từ cơ sở dữ liệu và hiển thị
                    $pay = new cart();
                    $pay_list = $pay->show_pay(); // Hàm get_pay_list() là một phương thức trong lớp Pay để lấy danh sách hóa đơn
                    if ($pay_list) {
						$i=0;
                        while ($pay_item = $pay_list->fetch_assoc()) {
						$i++;
                    ?>
                            <tr class="odd gradeX">
							<td><?php echo $i?></td>
                                <td><?php echo $pay_item['HD_MA']; ?></td>
                                <td><?php echo $pay_item['KH_MA']; ?></td>
                                <td><?php echo $pay_item['HD_SL']; ?></td>
                                <td><?php echo $pay_item['HD_GIA']; ?></td>
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
