<?php 
$filepath = realpath(dirname(__FILE__));
@include_once($filepath.'/../lib/database.php');
@include_once($filepath.'/../helpers/format.php');
?>

<?php
class review {
    private $db;
    private $fm;

    public function __construct()
    {
        $this -> db = new Database();
        $this -> fm = new Format();
    }
    public function insert_review($data, $file) {
        $HD_MA = mysqli_real_escape_string($this->db->link, $data['HD_MA']); 
        $FB_NOIDUNG = mysqli_real_escape_string($this->db->link, $data['FB_NOIDUNG']);
        $FB_SAO = mysqli_real_escape_string($this->db->link, $data['FB_SAO']);
        
        // Sử dụng câu lệnh JOIN để kiểm tra xem HD_MA có trong bảng hoadon hay không
        $sql = "SELECT * FROM feedback JOIN hoadon ON hoadon.HD_MA = feedback.HD_MA WHERE hoadon.HD_MA = '$HD_MA'";
        $selectsql = $this->db->select($sql);
        
        if ($selectsql) {
            if ($FB_NOIDUNG == "" || $FB_SAO == "") {
                $alert = "<span class='error'> Vui lòng nhập đầy đủ thông tin !!!</span>";
                return $alert;
            } else {
                $query = "INSERT INTO feedback(FB_NOIDUNG, FB_SAO, HD_MA) 
                          VALUES ('$FB_NOIDUNG', '$FB_SAO', '$HD_MA')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'> Thêm bài viết thành công!</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'> Thêm bài viết thất bại!!!</span>";
                    return $alert;
                }
            }
        } else {
            // Nếu không có HD_MA trong bảng hoadon
            $alert = "<span class='error'> HD_MA không hợp lệ!</span>";
            return $alert;
        }
    }
    

    
    
    
    
    
     

    public function show_review (){
        $query = "SELECT * from feedback";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_review($data,$files,$id){

        $FB_TEN    = mysqli_real_escape_string($this->db->link, $data['FB_TEN']);
        $FB_NOIDUNG   = mysqli_real_escape_string($this->db->link, $data['FB_NOIDUNG']);
        if($FB_TEN == "" || $FB_NOIDUNG=="" ){
            $alert = "<span class='error'> Vui lòng nhập đủ thông tin!!!</span>";
            return $alert;
        } else{
            $query = "UPDATE feedback SET 
            FB_TEN = '$FB_TEN', 
            FB_NOIDUNG = '$FB_NOIDUNG'
            WHERE FB_MA = '$id';";
        }
        $result = $this->db->update($query);
        if($result){
            $alert = "<span class='success'> Sửa bài viết thành công!</span>";
            return $alert; 
        }else{
            $alert = "<span class='error'> Sửa bài viết thất bại!!!</span>";
            return $alert; 
        }
    }

       
           
           

    public function delete_review($id) {
        $query = "DELETE FROM feedback WHERE FB_MA = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'> Xóa bài viết thành công!</span>"; 
            return $alert; 
        }else{
            $alert = "<span class='error'> Xóa bài viết thất bại!!!</span>";
            return $alert; 
        }   
    }


    public function getreviewbyId($id){
        $query = "SELECT * FROM feedback WHERE FB_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //end back-end
    public function getreview_feathered(){
        $query = "SELECT * FROM feedback WHERE FB_TRANGTHAI = '0'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getreview_new(){
        $query = "SELECT * FROM feedback ORDER BY FB_MA DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getreview_details($id){
        $query = "SELECT * FROM feedback
        WHERE feedback.FB_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
 }
?>