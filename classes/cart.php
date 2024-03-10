<?php
$filepath = realpath(dirname(__FILE__));
@include_once($filepath . '/../lib/database.php');
@include_once($filepath . '/../helpers/format.php');
?>

<?php
class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_cart($GH_SL, $id)
    {
        
        $GH_SL      = $this->fm->validation($GH_SL);
        $GH_SL      = mysqli_real_escape_string($this->db->link, $GH_SL);
        $id              = mysqli_real_escape_string($this->db->link, $id);
        $GH_MASS         = session_id();

        $query = "SELECT * FROM monan WHERE MA_MA = '$id' ";
        $result = $this->db->select($query)->fetch_assoc();
        $MA_TEN = $result["MA_TEN"];
        $MA_GIA = $result["MA_GIA"];
        $MA_HINHANH = $result["MA_HINHANH"];

        $query_cart = "SELECT * FROM giohang WHERE  MA_MA = '$id' AND GH_MASS = '$GH_MASS'";
        $check_cart =  $this->db->select($query_cart);
        if ($check_cart) {
            header('Location: cartindex.php');
            $thbao = "<span class = 'error'>Sản phẩm đã có trong giỏ hàng</span>";
           
            return $thbao;
          
        } 
        else {
        $query_insert = "INSERT INTO giohang(MA_MA, GH_MASS, MA_TEN, MA_GIA, GH_SL, MA_HINHANH) 
            VALUES ('$id', '$GH_MASS','$MA_TEN', '$MA_GIA','$GH_SL', '$MA_HINHANH')";
        $insert_cart = $this->db->insert($query_insert);
        
        if ($result) {
            header('Location:cartindex.php');
        }
        else {
            header('Location:contact.php');
        }
    }
    }
  
    public function getproduct_cart()
    {
       
        $GH_MASS = session_id();
        $query = "SELECT * FROM giohang WHERE GH_MASS = '$GH_MASS'";
        $result = $this->db->select($query);
        $query_img = "SELECT monan.MA_HINHANH FROM monan INNER JOIN giohang ON monan.MA_MA = giohang.MA_MA 
                    WHERE giohang.GH_MASS = '$GH_MASS'";
        $result_img = $this->db->select($query_img);
        return array(
            'products' => $result,
            'images' => $result_img
        );
    }
    public function up_quantity_cart($GH_SL, $GH_MA)
    {
        $GH_SL      = mysqli_real_escape_string($this->db->link, $GH_SL);
        $GH_MA          = mysqli_real_escape_string($this->db->link, $GH_MA);

        $query = "UPDATE giohang SET GH_SL = '$GH_SL' WHERE GH_MA = '$GH_MA'";

        $result = $this->db->update($query);
        if ($result) {
            header('Location:cartindex.php');
        } else {
            $thbao = "<span class = 'error'>Cập nhật số lượng sản phẩm thất bại</span>";
            return $thbao;
        }
    }
    public function delete_cart($GH_MA)
    {
       
        if(isset($GH_MA)) {
        $GH_MA  = mysqli_real_escape_string($this->db->link, $GH_MA);
        $query  = "DELETE FROM giohang WHERE GH_MA = '$GH_MA'";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location:cartindex.php');
            
        } else {
            $thbao = "<span class = 'error'>Xóa sản phẩm thất bại</span>";
            return $thbao;
        }
    }
}

    public function check_cart()
    {
      
        $GH_MASS = session_id();
        $query = "SELECT * FROM giohang WHERE GH_MASS = '$GH_MASS'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_cart()
    {
       
        $GH_MASS = session_id();
        $query = "DELETE FROM giohang WHERE GH_MASS = '$GH_MASS'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_order($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $GH_MASS = session_id();
    
        // Kiểm tra và lấy thông tin sản phẩm từ giỏ hàng
        $query_sp = "SELECT * FROM giohang WHERE GH_MASS = '$GH_MASS'";
        $get_product_result = $this->db->select($query_sp);
    
        if ($get_product_result && $get_product_result->num_rows > 0) {
            $get_product = $get_product_result->fetch_assoc();
            $MA_MA = $get_product["MA_MA"];
            $MA_TEN = $get_product["MA_TEN"];
            $GH_SL = $get_product["GH_SL"];
            $MA_GIA = $get_product["MA_GIA"] * $GH_SL;
            
            // Kiểm tra xem hóa đơn đã tồn tại hay chưa
            $query_check_order = "SELECT * FROM hoadon WHERE MA_MA = '$MA_MA' AND KH_MA = '$id'";
            $check_order_result = $this->db->select($query_check_order);
    
            if ($check_order_result->num_rows == 0) {
                // Thêm hóa đơn vào CSDL
                $query_order = "INSERT INTO hoadon(MA_MA, MA_TEN, KH_MA, GH_SL, MA_GIA) VALUES ('$MA_MA', '$MA_TEN', '$id', '$GH_SL', '$MA_GIA')";
                $insert_order_result = $this->db->insert($query_order);
    
                if ($insert_order_result) {
                    header('Location: cartindex.php');
                    exit;
                } else {
                    return "<span class='error'>Thanh toán thất bại</span>";
                }
            } else {
                return "<span class='error'>Hóa đơn đã tồn tại</span>";
            }
        } else {
            return "<span class='error'>Sản phẩm không tồn tại</span>";
        }
    }
    
    

    public function getproduct_payment()
    {
        $GH_MASS = session_id();
        $query = "SELECT * FROM giohang WHERE GH_MASS = '$GH_MASS'";
        $result = $this->db->select($query);
        return $result;
    }

}

// public function get_ma(){
//     $GH_MASS = $get_product["GH_MA"];
//     $query = "SELECT * FROM chitietgiohan WHERE GH_MASS = '$GH_MASS' "; 
//     $result = $this->db->select($query);
//     return $result;
// }
// }
?>