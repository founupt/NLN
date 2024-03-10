<?php
$filepath = realpath(dirname(__FILE__));
@include_once($filepath.'/../lib/database.php');
@include_once($filepath.'/../helpers/format.php');
?>

<?php 
class feedback
{
    private $db;
    private $fm;

    public function __construct(){
        $this -> db = new Database();
        $this -> fm= new Format();
    }

    public function insert_feedback($data){
        $MA_TEN       = mysqli_real_escape_string($this->db->link, $data['FB_TEN']);
        $MA_GIA       = mysqli_real_escape_string($this->db->link, $data['FB_NOIDUNG']);
    }

    public function show_feedback (){
        $query = "SELECT * from feedback";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_feedback($id) {
        $query = "DELETE FROM feadback WHERE FB_MA = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'> Xóa feadback thành công!</span>"; 
            return $alert; 
        }else{
            $alert = "<span class='error'> Xóa feadback thất bại!!!</span>";
            return $alert; 
        }   
    }

    public function getfeedback_new(){
        $query = "SELECT * FROM feedback ORDER BY FB_MA DESC";
        $result = $this->db->select($query);
        return $result;
    }

  
    
}