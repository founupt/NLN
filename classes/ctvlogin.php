<?php
$filepath = realpath(dirname(__FILE__));
@include($filepath.'/../lib/session.php');
session::check_CTV_Login();
@include_once($filepath.'/../lib/database.php');
@include_once($filepath.'/../helpers/format.php');
?>

<?php 
class CTVlogin
{
    private $db;
    private $fm;

    public function __construct(){
        $this -> db = new Database();
        $this -> fm= new Format();
    }
    public function login_CTV($CTV_username,$CTV_pass){
        $CTV_username = $this -> fm -> validation ($CTV_username);
        $CTV_pass = $this -> fm -> validation ($CTV_pass);

        $CTV_username = mysqli_real_escape_string($this->db->link, $CTV_username);
        $CTV_pass = mysqli_real_escape_string($this->db->link, $CTV_pass);

        if(empty($CTV_username)||empty($CTV_pass)){
            $alert = " Vui lòng kiểm tra lại username và password!!!";
            return $alert;
        }else{
            $query = "SELECT * FROM congtacvien WHERE CTV_username = '$CTV_username' AND CTV_pass = '$CTV_pass'";
            $result = $this->db->select($query);
            if($result != false){
                $value = $result->fetch_assoc();
                session::set('CTVlogin', true);
                session::set('CTV_ma',$value['CTV_ma']);
                session::set('QA_ma',$value['QA_ma']);
                session::set('CTV_username',$value['CTV_username']);
                session::set('CTV_ten',$value['CTV_ten']);
                header('location:index.php');
            }else{
                $alert = "Tài khoản hoặc mật khẩu sai!!!";
                return $alert;
            }
        }

    }
}
?>