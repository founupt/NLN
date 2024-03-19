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
    public function add_cart($MA_SL, $MA_MA)
    {
        $MA_SL      = $this->fm->validation($MA_SL);
        $MA_SL      = mysqli_real_escape_string($this->db->link, $MA_SL);
        $MA_MA      = mysqli_real_escape_string($this->db->link, $MA_MA);
        if(!isset($_SESSION['HD_MA'])) {
            $_SESSION['HD_MA'] = mt_rand();
            $HD_MA = $_SESSION['HD_MA'];
            echo "$HD_MA ";
        }
        else {
            $HD_MA = $_SESSION['HD_MA'];
        }

        $query = "SELECT * FROM monan WHERE MA_MA = '$MA_MA' ";
        $result_monan = $this->db->select($query)->fetch_assoc();
        $MA_TEN = $result_monan["MA_TEN"];
        $MA_GIA = $result_monan["MA_GIA"];
        $MA_HINHANH = $result_monan["MA_HINHANH"];
        $KH_MA = session::get('KH_MA');

        $query_cart = "SELECT * FROM hoadon WHERE HD_MA = '$HD_MA'";
        $check_cart =  $this->db->select($query_cart);
        //Kiểm tra đã có giỏ hàng này chưa
        //Nếu có thì bỏ qua bước tạo hoá đơn
        if ($check_cart) {
            //header('Location: cartindex.php');
            while($result_hoadon = $check_cart->fetch_assoc()){
                $HD_SL = $result_hoadon['HD_SL'];
                $query_valid = "SELECT * FROM bao_gom WHERE MA_MA = '$MA_MA'";
                $check_valid =  $this->db->select($query_valid);
                //Kiểm tra đã có món ăn này chưa
                //Nếu có thì cập nhật số lượng của món ăn này
                if ($check_valid) {
                    while($select_BG_MA = $check_valid->fetch_assoc()){
                    $BG_MA = $select_BG_MA["BG_MA"];
                    //Cập nhật số lượng món ăn
                    $updated_MA_SL = $select_BG_MA["MA_SL"] + $MA_SL;
                    $query_update_quantity = "UPDATE bao_gom SET MA_SL = '$updated_MA_SL' WHERE BG_MA = '$BG_MA'";
                    $update_quantity = $this->db->update($query_update_quantity);
                    //Cập nhật tổng số lượng món ăn
                    $updated_HD_SL = $HD_SL + $MA_SL;
                    $query_total_quantity = "UPDATE hoadon SET HD_SL = '$updated_HD_SL' WHERE HD_MA = '$HD_MA'";
                    $update_total_quantity = $this->db->update($query_total_quantity);
                    }
                }
                //Nếu chưa thì thêm món ăn vào giỏ hàng
                else {
                    $insert_bao_gom = "INSERT INTO bao_gom (HD_MA, MA_MA, MA_SL) 
                    VALUES ('$HD_MA', '$MA_MA', '$MA_SL')";
                    $insert_cart = $this->db->insert($insert_bao_gom);
                    //Cập nhật tổng số lượng món ăn
                    $updated_HD_SL = $HD_SL + $MA_SL;
                    $query_total_quantity = "UPDATE hoadon SET HD_SL = '$updated_HD_SL' WHERE HD_MA = '$HD_MA'";
                    $update_total_quantity = $this->db->update($query_total_quantity);
                }
            }
        } 
        //Nếu chưa thì tạo hoá đơn mới
        else {
        $insert_hoadon = "INSERT INTO hoadon (HD_MA, KH_MA, HD_SL) 
            VALUES ('$HD_MA', '$KH_MA', '$MA_SL')";
        $insert_cart = $this->db->insert($insert_hoadon);
        $insert_bao_gom = "INSERT INTO bao_gom (HD_MA, MA_MA, MA_SL) 
            VALUES ('$HD_MA', '$MA_MA', '$MA_SL')";   
        $insert_cart = $this->db->insert($insert_bao_gom);    
        
        if ($result_monan) {
            //header('Location:cartindex.php');
        }
        else {
            header('Location:contact.php');
        }
    }
    }
  
    public function getproduct_cart()
    {
       
        $HD_MA = $_SESSION['HD_MA'];
        $query = "SELECT * FROM bao_gom JOIN monan ON monan.MA_MA = bao_gom.MA_MA WHERE HD_MA = '$HD_MA'";
        $result = $this->db->select($query);
        $query_img = "SELECT monan.MA_HINHANH FROM monan JOIN bao_gom ON monan.MA_MA = bao_gom.MA_MA 
                    WHERE bao_gom.HD_MA = '$HD_MA'";
        $result_img = $this->db->select($query_img);
        return array(
            'products' => $result,
            'images' => $result_img
        );
    }
    public function up_quantity_cart($updated_MA_SL, $BG_MA)
    {
        $updated_MA_SL  = mysqli_real_escape_string($this->db->link, $updated_MA_SL);
        $BG_MA          = mysqli_real_escape_string($this->db->link, $BG_MA);
        $HD_MA          = $_SESSION['HD_MA'];

        $query_bao_gom  = "SELECT * FROM bao_gom WHERE BG_MA = '$BG_MA'";
        $select_bao_gom = $this->db->select($query_bao_gom);
        $result_bao_gom = $select_bao_gom->fetch_assoc();
        $MA_SL          = $result_bao_gom['MA_SL'];

        $query_cart     = "SELECT * FROM hoadon WHERE HD_MA = '$HD_MA'";
        $select_cart    =  $this->db->select($query_cart);
        $result_cart    = $select_cart->fetch_assoc();
        $HD_SL          = $result_cart['HD_SL'];

        if($MA_SL > $updated_MA_SL) {
            //Cập nhật tổng số lượng món ăn (Trừ)
                $updated_HD_SL = $HD_SL - ($MA_SL - $updated_MA_SL);
                $query_total_quantity = "UPDATE hoadon SET HD_SL = '$updated_HD_SL' WHERE HD_MA = '$HD_MA'";
                $update_total_quantity = $this->db->update($query_total_quantity);
        }
        else
        {
            //Cập nhật tổng số lượng món ăn (Cộng)
                $updated_HD_SL = $HD_SL + ($updated_MA_SL - $MA_SL);
                $query_total_quantity = "UPDATE hoadon SET HD_SL = '$updated_HD_SL' WHERE HD_MA = '$HD_MA'";
                $update_total_quantity = $this->db->update($query_total_quantity);
        }

        $update_bao_gom = "UPDATE bao_gom SET MA_SL = '$updated_MA_SL' WHERE BG_MA = '$BG_MA'";
        $result = $this->db->update($update_bao_gom);

        if ($result) {
            header('Location:cartindex.php');
        } else {
            $thbao = "<span class = 'error'>Cập nhật số lượng sản phẩm thất bại</span>";
            return $thbao;
        }
    }
    public function delete_cart($BG_MA)
    {
       
        if(isset($BG_MA)) {
            $BG_MA  = mysqli_real_escape_string($this->db->link, $BG_MA);
            $HD_MA          = $_SESSION['HD_MA'];

            //select hoá đơn
            $query_cart     = "SELECT * FROM hoadon WHERE HD_MA = '$HD_MA'";
            $select_cart    =  $this->db->select($query_cart);
            $result_cart    = $select_cart->fetch_assoc();
            $HD_SL          = $result_cart['HD_SL'];

            //select bao gồm
            $query_bao_gom  = "SELECT * FROM bao_gom WHERE BG_MA = '$BG_MA'";
            $select_bao_gom = $this->db->select($query_bao_gom);
            $result_bao_gom = $select_bao_gom->fetch_assoc();
            $MA_SL          = $result_bao_gom['MA_SL'];

            //Cập nhật tổng số lượng món ăn (Cộng)
            $updated_HD_SL = $HD_SL - $MA_SL;
            $query_total_quantity = "UPDATE hoadon SET HD_SL = '$updated_HD_SL' WHERE HD_MA = '$HD_MA'";
            $update_total_quantity = $this->db->update($query_total_quantity);

            //Xoá sản phẩm
            $query  = "DELETE FROM bao_gom WHERE BG_MA = '$BG_MA'";
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
      
        $HD_MA = session_id();
        $query = "SELECT * FROM bao_gom WHERE HD_MA = '$HD_MA'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_cart()
    {
       
        $HD_MA = session_id();
        $query = "DELETE FROM bao_gom WHERE HD_MA = '$HD_MA'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_order($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $HD_MA = session_id();
    
        // Kiểm tra và lấy thông tin sản phẩm từ giỏ hàng
        $query_sp = "SELECT * FROM bao_gom WHERE HD_MA = '$HD_MA'";
        $get_product_result = $this->db->select($query_sp);
    
        if ($get_product_result && $get_product_result->num_rows > 0) {
            $get_product = $get_product_result->fetch_assoc();
            $MA_MA = $get_product["MA_MA"];
            $MA_TEN = $get_product["MA_TEN"];
            $MA_SL = $get_product["MA_SL"];
            $MA_GIA = $get_product["MA_GIA"] * $MA_SL;
            
            // Kiểm tra xem hóa đơn đã tồn tại hay chưa
            $query_check_order = "SELECT * FROM hoadon WHERE MA_MA = '$MA_MA' AND KH_MA = '$id'";
            $check_order_result = $this->db->select($query_check_order);
    
            if ($check_order_result->num_rows == 0) {
                // Thêm hóa đơn vào CSDL
                $query_order = "INSERT INTO hoadon(MA_MA, MA_TEN, KH_MA, MA_SL, MA_GIA) VALUES ('$MA_MA', '$MA_TEN', '$id', '$MA_SL', '$MA_GIA')";
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
        $HD_MA = session_id();
        $query = "SELECT * FROM bao_gom WHERE HD_MA = '$HD_MA'";
        $result = $this->db->select($query);
        return $result;
    }

}

// public function get_ma(){
//     $HD_MA = $get_product["GH_MA"];
//     $query = "SELECT * FROM chitietgiohan WHERE HD_MA = '$HD_MA' "; 
//     $result = $this->db->select($query);
//     return $result;
// }
// }
?>