<?php
$filepath = realpath(dirname(__FILE__));
@include_once($filepath.'/../lib/database.php');
@include_once($filepath.'/../helpers/format.php');
?>

<?php 
class product
{
    private $db;
    private $fm;

    public function __construct(){
        $this -> db = new Database();
        $this -> fm= new Format();
    }
    public function insert_product($data,$files){
        $MA_TEN       = mysqli_real_escape_string($this->db->link, $data['MA_TEN']);
        $MA_GIA       = mysqli_real_escape_string($this->db->link, $data['MA_GIA']);
        $LMA_MA      = mysqli_real_escape_string($this->db->link, $data['LMA_MA']);
        $MA_MOTA      = mysqli_real_escape_string($this->db->link, $data['MA_MOTA']);
        $MA_TINHTRANG = mysqli_real_escape_string($this->db->link, $data['MA_TINHTRANG']);
        
        // $danhmuc      = mysqli_real_escape_string($this->db->link, $data['danhmuc']);
        // $loai_sp      = mysqli_real_escape_string($this->db->link, $data['loai_sp']);
        
        // $SP_MAU       = mysqli_real_escape_string($this->db->link, $data['SP_MAU']);
        // $SP_TRANGTHAI = mysqli_real_escape_string($this->db->link, $data['SP_TRANGTHAI']);
        

        //Kiểm tra và lấy hình ảnh cho vào thư mục uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['MA_HINHANH']['name'];  
        $file_size = $_FILES['MA_HINHANH']['size'];  
        $file_temp = $_FILES['MA_HINHANH']['tmp_name'];
        
        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../images/".$unique_image;

        if($MA_TEN == "" || $LMA_MA=="" || $MA_GIA == "" || $MA_MOTA == "" || $MA_TINHTRANG =="" ){
            $alert = "<span class='error'> Các thành phần này không được trống!!!</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO monan(MA_TEN, LMA_MA, MA_GIA, MA_MOTA, MA_TINHTRANG, MA_HINHANH)
            VALUES ('$MA_TEN','$LMA_MA','$MA_GIA','$MA_MOTA', '$MA_TINHTRANG','$unique_image')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'> Thêm sản phẩm thành công!</span>";
                return $alert; 
            }else{
                $alert = "<span class='error'> Thêm sản phẩm thất bại!!!</span>";
                return $alert; 
            }
           
        }

    }
    public function show_product (){
        $query = "SELECT * from monan";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data,$files,$id){

        $MA_TEN       = mysqli_real_escape_string($this->db->link, $data['MA_TEN']);
        $MA_GIA       = mysqli_real_escape_string($this->db->link, $data['MA_GIA']);
        $LMA_MA       = mysqli_real_escape_string($this->db->link, $data['LMA_MA']);
        $MA_MOTA      = mysqli_real_escape_string($this->db->link, $data['MA_MOTA']);
        $MA_TINHTRANG = mysqli_real_escape_string($this->db->link, $data['MA_TINHTRANG']);
        
        //Kiểm tra và lấy hình ảnh cho vào thư mục uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['MA_HINHANH']['name'];  
        $file_size = $_FILES['MA_HINHANH']['size'];  
        $file_temp = $_FILES['MA_HINHANH']['tmp_name'];
        
        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../images/".$unique_image;

        if($MA_TEN == "" || $MA_GIA == "" || $LMA_MA=="" || $MA_MOTA == "" || $MA_TINHTRANG =="" ){
            $alert = "<span class='error'> Các thành phần này không được trống!!!</span>";
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
                $query = "UPDATE monan SET 
                MA_TEN = '$MA_TEN', 
                MA_GIA = '$MA_GIA',
                LMA_MA = '$LMA_MA',
                MA_TINHTRANG = '$MA_TINHTRANG', 
                MA_HINHANH = '$unique_image'
                WHERE MA_MA = '$id'";
            }else{
                //Không chọn ảnh
                $query = "UPDATE monan SET 
                MA_TEN = '$MA_TEN',
                MA_GIA = '$MA_GIA',
                LMA_MA = '$LMA_MA',
                MA_TINHTRANG = '$MA_TINHTRANG' 
                WHERE MA_MA = '$id'";
            }
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'> Sửa sản phẩm thành công!</span>";
                return $alert; 
            }else{
                $alert = "<span class='error'> Sửa sản phẩm thất bại!!!</span>";
                return $alert; 
            }
            
        }
    }
    public function delete_product($id) {
        $query = "DELETE FROM monan WHERE MA_MA = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'> Xóa sản phẩm thành công!</span>"; 
            return $alert; 
        }else{
            $alert = "<span class='error'> Xóa sản phẩm thất bại!!!</span>";
            return $alert; 
        }   
    }
    public function getproductbyId($id){
        $query = "SELECT * FROM monan WHERE MA_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //end back-end
    public function getproduct_limit(){
        $query = "SELECT * FROM monan ORDER BY MA_MA DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_new(){
        $query = "SELECT * FROM monan ORDER BY MA_MA DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_details($id){
        $query = "SELECT * FROM chitietmonan
        WHERE chitietmonan.MA_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

}
?>