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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        canvas {
            width: 80%;
            height: 200px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Doanh thu</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                </thead>
                <body>
                    <canvas id="myChart"></canvas>

                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "food";
                    $conn = mysqli_connect($servername, $username, $password, $database);

                    // Kiểm tra kết nối
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }
                    $query = "SELECT KH_TEN, COUNT(HD_SL) AS TongSoLuongMua
                            FROM HOADON INNER JOIN KHACHHANG ON HOADON.KH_MA = KHACHHANG.KH_MA
                            INNER JOIN BAO_GOM ON HOADON.HD_MA = BAO_GOM.HD_MA
                            GROUP BY KH_TEN
                            ORDER BY TongSoLuongMua DESC
                            LIMIT 1";
                $result = $conn->query($query);
                if (!$result) {
                    die("Truy vấn không thành công: " . $conn->error);
                }
                
                $customer_name = "";
                $total_quantity = 0;
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $customer_name = $row['KH_TEN'];
                    $total_quantity = $row['TongSoLuongMua'];
                }
                
                    // Truy vấn để lấy dữ liệu
                    $sql = "SELECT HD_NGAYLAP AS NgayLap, SUM(HD_GIA) AS TongDoanhThu
                    FROM HOADON
                    GROUP BY HD_NGAYLAP";
                    $result = $conn->query($sql);

                    // Kiểm tra nếu truy vấn không thành công
                    if (!$result) {
                        die("Truy vấn không thành công: " . mysqli_error($conn));
                    }

                    // Lưu dữ liệu vào mảng
                    $labels = [];
                    $data = [];

                    // Kiểm tra số hàng trả về
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $labels[] = $row['NgayLap'];
                            $data[] = $row['TongDoanhThu'];
                        }
                    }

                    // Đóng kết nối
                    $conn->close();
                    ?>
                    <br></br>
                     <h2>Khách hàng mua nhiều nhất: <?php echo $customer_name; ?></h2>
                    <h2>Tổng số đơn: <?php echo $total_quantity; ?></h2>

                    <script>
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($labels); ?>,
                                datasets: [{
                                    label: 'Doanh thu theo ngày',
                                    data: <?php echo json_encode($data); ?>,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                </body>
            </table>
        </div>
    </div>
</div>
