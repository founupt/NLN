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
        $BV_TIEUDE  = mysqli_real_escape_string($this->db->link, $data['BV_TIEUDE']);
        $BV_NOIDUNG  = mysqli_real_escape_string($this->db->link, $data['BV_NOIDUNG']);
        $BV_TINHTRANG  = mysqli_real_escape_string($this->db->link, $data['BV_TINHTRANG']);
 //Kiểm tra và lấy hình ảnh cho vào thư mục uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['BV_HINHANH']['name'];  
        $file_size = $_FILES['BV_HINHANH']['size'];  
        $file_temp = $_FILES['BV_HINHANH']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../images/".$unique_image;

        if($BV_TIEUDE == "" || $BV_NOIDUNG=="" || $BV_TINHTRANG=="" || $BV_HINHANH =""){
            $alert = "<span class='error'> Vui lòng nhập đầy đủ thông tin !!!</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "  INSERT INTO baiviet(BV_TIEUDE, BV_NOIDUNG, BV_TINHTRANG, BV_HINHANH)
                        VALUES ('$BV_TIEUDE','$BV_NOIDUNG','$BV_TINHTRANG','$unique_image')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'> Thêm bài viết thành công!</span>";
                return $alert; 
            }else{
                $alert = "<span class='error'> Thêm bài viết thất bại!!!</span>";
                return $alert; 
            }
           
            }
    }   

    public function show_review (){
        $query = "SELECT * from baiviet";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_review($data,$files,$id){

        $BV_TIEUDE    = mysqli_real_escape_string($this->db->link, $data['BV_TIEUDE']);
        $BV_NOIDUNG   = mysqli_real_escape_string($this->db->link, $data['BV_NOIDUNG']);
        $BV_TINHTRANG = mysqli_real_escape_string($this->db->link, $data['BV_TINHTRANG']);
        
        //Kiểm tra và lấy hình ảnh cho vào thư mục uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['BV_HINHANH']['name'];  
        $file_size = $_FILES['BV_HINHANH']['size'];  
        $file_temp = $_FILES['BV_HINHANH']['tmp_name'];
        
        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../images/".$unique_image;

        if($BV_TIEUDE == "" || $BV_NOIDUNG=="" || $BV_TINHTRANG=="" || $file_name ="" ){
            $alert = "<span class='error'> Vui lòng nhập đủ thông tin!!!</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //Chọn ảnh để up || $MA_HINHANH == ""
                if($file_size > 404800){
                    $alert = "<span class='error'> Kích thước ảnh quá lớn!!! Bạn chỉ được upload ảnh dưới 40GB</span>";
                    return $alert;
                }elseif(in_array($file_ext, $permited) == false)
                {
                    $alert = "<span class='error'> Bạn chỉ được upload hình thuộc định dạng: - ".implode(',',$permited)."</span>";
                    return $alert;
                }
                $query = "UPDATE baiviet SET 
                BV_TIEUDE = '$BV_TIEUDE', 
                BV_NOIDUNG = '$BV_NOIDUNG',
                BV_TINHTRANG = '$BV_TINHTRANG', 
                BV_HINHANH = '$unique_image'
                WHERE BV_MA = '$id';";
            }else{
                //Không chọn ảnh
                $query = "UPDATE baiviet SET 
                BV_TIEUDE = '$BV_TIEUDE', 
                BV_NOIDUNG = '$BV_NOIDUNG',
                BV_TINHTRANG = '$BV_TINHTRANG'
                WHERE BV_MA = $id;";
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
    }

    public function delete_review($id) {
        $query = "DELETE FROM baiviet WHERE BV_MA = '$id'";
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
        $query = "SELECT * FROM baiviet WHERE BV_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //end back-end
    public function getreview_feathered(){
        $query = "SELECT * FROM baiviet WHERE BV_TRANGTHAI = '0'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getreview_new(){
        $query = "SELECT * FROM baiviet ORDER BY BV_MA DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getreview_details($id){
        $query = "SELECT * FROM baiviet
        WHERE baiviet.BV_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
 }
?>