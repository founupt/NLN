<?php
$filepath = realpath(dirname(__FILE__));
@include_once($filepath.'/../lib/database.php');
@include_once($filepath.'/../helpers/format.php');

?>

<?php 
class type
{
    private $db;
    private $fm;

    public function __construct(){
        $this -> db = new Database();
        $this -> fm= new Format();
    }
    public function insert_type($LMA_TEN){
        $LMA_TEN = $this -> fm -> validation ($LMA_TEN);
        $LMA_TEN = mysqli_real_escape_string($this->db->link, $LMA_TEN);

        if(empty($LMA_TEN)){
            $alert = "<span class='error'> Danh mục sản phẩm không được trống!!!</span>";
            return $alert;
        }else{
            $query = "INSERT INTO loaimonan(LMA_TEN) VALUES ('$LMA_TEN')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'> Thêm danh mục sản phẩm thành công!</span>";
                return $alert; 
            }else{
                $alert = "<span class='error'> Thêm danh mục sản phẩm thất bại!!!</span>";
                return $alert; 
            }

           
        }

    }
    public function show_type (){
        $query = "SELECT * FROM loaimonan ORDER BY LMA_MA DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_type($LMA_TEN,$id){
        $LMA_TEN = $this -> fm -> validation ($LMA_TEN);
        $LMA_TEN = mysqli_real_escape_string($this->db->link, $LMA_TEN);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($LMA_TEN)){
            $alert = "<span class='error'> Danh mục sản phẩm không được trống!!!</span>";
            return $alert;
        }else{
            $query = "UPDATE loaimonan SET LMA_TEN = '$LMA_TEN' WHERE LMA_MA = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'> Cập nhật danh mục sản phẩm thành công!</span>";
                return $alert; 
            }else{
                $alert = "<span class='error'> Cập nhật danh mục sản phẩm thất bại!!!</span>";
                return $alert; 
            }

           
        }
    }

    public function delete_type($id) {
        $query = "DELETE FROM loaimonan WHERE LMA_MA = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'> Xóa danh mục sản phẩm thành công!</span>";
            return $alert; 
        }else{
            $alert = "<span class='error'> Xóa danh mục sản phẩm thất bại!!!</span>";
            return $alert; 
        }   
    }
    public function getcatbyId($id){
        $query = "SELECT * FROM loaimonan WHERE LMA_MA = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>