<?php
$filepath = realpath(dirname(__FILE__));
@include_once($filepath.'/../lib/session.php');
session::init();
@include_once($filepath.'/../lib/database.php');
@include_once($filepath.'/../helpers/format.php');
?>

<?php 
class customers
{
    private $db;
    private $fm;

    public function __construct(){
        $this -> db = new Database();
        $this -> fm= new Format();
    }
    public function insert_customers($data){
        $KH_USERNAME = mysqli_real_escape_string($this->db->link, $data['KH_USERNAME']);
        $KH_SDT = mysqli_real_escape_string($this->db->link, $data['KH_SDT']);
        $KH_EMAIL = mysqli_real_escape_string($this->db->link, $data['KH_EMAIL']);
        $KH_DIACHI = mysqli_real_escape_string($this->db->link, $data['KH_DIACHI']);
        $KH_PASS = mysqli_real_escape_string($this->db->link, md5($data['KH_PASS']));

        if($KH_USERNAME == "" || $KH_SDT == "" || $KH_EMAIL == "" || $KH_DIACHI == "" || $KH_PASS == ""){
            $alert = "<span class='error'>Các thành phần này không được trống!!!</span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM khachhang WHERE KH_EMAIL ='$KH_EMAIL' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class='error'>Email đã tồn tại!!!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO khachhang(KH_USERNAME, KH_SDT, KH_EMAIL, KH_DIACHI, KH_PASS) 
                VALUES ('$KH_USERNAME','$KH_SDT','$KH_EMAIL','$KH_DIACHI','$KH_PASS')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'> Đăng ký thành công!</span>";
                    return $alert; 
                }else{
                    $alert = "<span class='error'> Đăng ký thất bại!!!</span>";
                    return $alert; 
                }
            }
        }
    }
    public function login_customers($KH_USERNAME,$KH_PASS){
        $KH_USERNAME = $this -> fm -> validation($KH_USERNAME);
        $KH_PASS = $this -> fm ->  validation($KH_PASS);

        $KH_USERNAME = mysqli_real_escape_string($this->db->link, $KH_USERNAME);
        $KH_PASS = mysqli_real_escape_string($this->db->link, $KH_PASS);

        if($KH_USERNAME == "" || $KH_PASS == ""){
            $alert = "<span class='error'>Tên hoặc mật khẩu không được trống!!!</span>";
            return $alert;
        }else{
            $check_login = "SELECT * FROM khachhang WHERE KH_USERNAME = '$KH_USERNAME' AND KH_PASS = '$KH_PASS'";
            $result_check = $this->db->select($check_login);
            if($result_check != false){
                $value = $result_check ->fetch_assoc();
                session::set("customer_login",true);
                session::set('KH_MA',$value['KH_MA']);
                session::set('KH_USERNAME',$value['KH_USERNAME']);
                session::set('KH_TEN',$value['KH_TEN']);
                session::check_Customer_Login();
                header('location: index.php');
            }else{
                $alert = "<span class='error'>Tên hoặc mật khẩu không đúng!!!</span>";
            return $alert;
            }
        }
    }
    public function show_customers($id){
        $query = "SELECT * FROM khachhang WHERE KH_MA ='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_customersid($id){
        $query = "SELECT * FROM khachhang WHERE KH_MA ='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    // public function update_customers(){
        
    // }
}
?>