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
        <h2>Danh sách hóa đơn</h2>
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
