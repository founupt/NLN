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
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "food"); // Khai báo biến $conn ở đây
                        $cart = new cart();
                        $pay_list = $cart->showhoadon(); // Hàm get_pay_list() là một phương thức trong lớp Pay để lấy danh sách hóa đơn
                        if ($pay_list) {
                            $i=0;
                            while ($pay_item = $pay_list->fetch_assoc()) {
                            $i++;
                            $HD_MA = $pay_item['HD_MA'];
                        ?>
                                <tr class="odd gradeX">
                                <td><?php echo $i?></td>
                                    <td><?php echo $pay_item['HD_MA']; ?></td>
                                    <td><?php echo $pay_item['KH_MA']; ?></td>
                                    <td><?php echo $pay_item['HD_SL']; ?></td>
                                    <td><?php echo $pay_item['HD_GIA']; ?></td>
                                    <td><?php echo $cart->hienThiTrangThaiDonHang($HD_MA, $conn); ?></td>

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
