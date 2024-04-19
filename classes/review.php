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
    public function insert_review($HD_MA, $DG_NOIDUNG, $DG_SAO) {
        $HD_MA = mysqli_real_escape_string($this->db->link, $HD_MA); 
        $DG_NOIDUNG = mysqli_real_escape_string($this->db->link, $DG_NOIDUNG);
        $DG_SAO = mysqli_real_escape_string($this->db->link, $DG_SAO);
        
        // Kiểm tra xem các trường không rỗng
        if (!empty($HD_MA) && !empty($DG_NOIDUNG) && !empty($DG_SAO)) {
            // Kiểm tra xem HD_MA có hợp lệ không
            $sql = "SELECT * FROM hoadon WHERE HD_MA = '$HD_MA'";
            $select_result = $this->db->select($sql);
            
            if ($select_result->num_rows > 0) {
                // Thực hiện chèn dữ liệu vào bảng danhgia
                $query = "INSERT INTO danhgia (DG_NOIDUNG, DG_SAO, HD_MA) 
                          VALUES ('$DG_NOIDUNG', '$DG_SAO', '$HD_MA')";
                $insert_result = $this->db->insert($query);
                
                if ($insert_result) {
                    return "<span class='success'>Thêm bài viết thành công!</span>";
                } else {
                    return "<span class='error'>Thêm bài viết thất bại!!!</span>";
                }
            } else {
                return "<span class='error'>HD_MA không hợp lệ!</span>";
            }
        } else {
            return "<span class='error'>Vui lòng nhập đầy đủ thông tin!!!</span>";
        }
    }
    
    
    

    
    
    
    
    
     

    public function show_review (){
        $query = "SELECT * from danhgia";
        $result = $this->db->select($query);
        return $result;
    }

    // public function update_review($data,$files,$id){

    //     $DG_TEN    = mysqli_real_escape_string($this->db->link, $data['DG_TEN']);
    //     $DG_NOIDUNG   = mysqli_real_escape_string($this->db->link, $data['DG_NOIDUNG']);
    //     if($DG_TEN == "" || $DG_NOIDUNG=="" ){
    //         $alert = "<span class='error'> Vui lòng nhập đủ thông tin!!!</span>";
    //         return $alert;
    //     } else{
    //         $query = "UPDATE danhgia SET 
    //         DG_TEN = '$DG_TEN', 
    //         DG_NOIDUNG = '$DG_NOIDUNG'
    //         WHERE DG_MA = '$id';";
    //     }
    //     $result = $this->db->update($query);
    //     if($result){
    //         $alert = "<span class='success'> Sửa bài viết thành công!</span>";
    //         return $alert; 
    //     }else{
    //         $alert = "<span class='error'> Sửa bài viết thất bại!!!</span>";
    //         return $alert; 
    //     }
    // }

       
           
           

    public function delete_review($id) {
        $query = "DELETE FROM danhgia WHERE DG_MA = '$id'";
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
        $query = "SELECT * FROM danhgia WHERE DG_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //end back-end
    public function getreview_feathered(){
        $query = "SELECT * FROM danhgia WHERE DG_TRANGTHAI = '0'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getreview_new(){
        $query = "SELECT * FROM danhgia ORDER BY DG_MA DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getreview_details($id){
        $query = "SELECT * FROM danhgia
        WHERE danhgia.DG_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_dg (){
        $query = "SELECT * from danhgia";
        $result = $this->db->select($query);
        return $result;
    }

 }
?>