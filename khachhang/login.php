<?php 
    @include('../classes/customers.php');

?>
<head>
    <title>ĐĂNG NHẬP</title>


    <link href="login.css" rel="stylesheet" type="text/css" media="all" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>

<body>
    <!--header start here-->
    <?php
    $class = new customers();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $KH_USERNAME = $_POST["user"];
        $KH_PASS = $_POST["pass"];
        
        $login_check = $class->login_customers ($KH_USERNAME, $KH_PASS);
    }
    ?>
   
    <div class="header">
       
        <div class="header-main">
            <br><br>
            <h3>ĐĂNG NHẬP</h3><br><br>
            <span><?php
            if(isset($login_check)){
                echo $login_check;
            }
            ?></span>
            <div class="header-bottom">
                <div class="header-right w3agile">
                    <div class="header-left-bottom agileinfo">
                        <form action="login.php" method="post">
                            <p>Username:</p>
                            <input type="text" id="user" name="user" placeholder="Nhập tên đăng nhập tại đây " />
                            <p>Password:</p>
                            <input type="password" id="pass" name="pass" placeholder="Nhập mật khẩu tại đây" />
                            <div class="col-md-12">      
                                <button type="submit"  class="btn btn-primary py-3 px-5"  name="login">Đăng nhập</button>
                            </div>
                            <p>Bạn chưa có tài khoản? <a href="dangky.php">Đăng ký tại đây</a></p>
                        </form>
                    </div>


                </div>
            </div>

        </div>
    </div>
    </div>
   
</body>

