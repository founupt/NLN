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

    public function add_order(){
        $KH_MA = Session::get('KH_MA');
        $insert_hoadon = "INSERT INTO hoadon (KH_MA) 
            VALUES ('$KH_MA')";
        $insert_cart = $this->db->insert($insert_hoadon);
        $query_HD_MA = "SELECT MAX(HD_MA) as MAX_HD_MA FROM hoadon";
        $result_HD_MA = $this->db->select($query_HD_MA)->fetch_assoc();
        $set_HD_MA = Session::set('HD_MA',$result_HD_MA['MAX_HD_MA']);
    }

    public function check_order(){
        $KH_MA = Session::get('KH_MA');
        $HD_MA = Session::get('HD_MA');

        $select_order = $this->db->select("SELECT * FROM hoadon 
        WHERE KH_MA = '$KH_MA' AND HD_MA = '$HD_MA'")->fetch_assoc();
        return $select_order;
    }

    public function add_cart($MA_SL, $MA_MA)
    {
        $MA_SL      = $this->fm->validation($MA_SL);
        $MA_SL      = mysqli_real_escape_string($this->db->link, $MA_SL);
        $MA_MA      = mysqli_real_escape_string($this->db->link, $MA_MA);
        $KH_MA      = Session::get('KH_MA');
        $HD_MA      = Session::get('HD_MA');

        $query_valid = "SELECT * FROM bao_gom WHERE MA_MA = '$MA_MA' AND HD_MA = '$HD_MA'";
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
            }
        }
        //Nếu chưa thì thêm món ăn vào giỏ hàng
        else {
            $insert_bao_gom = "INSERT INTO bao_gom (HD_MA, MA_MA, MA_SL) 
            VALUES ('$HD_MA', '$MA_MA', '$MA_SL')";
            $insert_cart = $this->db->insert($insert_bao_gom);
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

            //select bao gồm
            $query_bao_gom  = "SELECT * FROM bao_gom WHERE BG_MA = '$BG_MA'";
            $select_bao_gom = $this->db->select($query_bao_gom);
            $result_bao_gom = $select_bao_gom->fetch_assoc();
            $MA_SL          = $result_bao_gom['MA_SL'];

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
      
        $HD_MA = $_SESSION['HD_MA'];
        $query = "SELECT * FROM bao_gom WHERE HD_MA = '$HD_MA'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_cart()
    {
       
        $HD_MA = $_SESSION['HD_MA'];
        $query = "DELETE FROM bao_gom WHERE HD_MA = '$HD_MA'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_empty_cart()
    {
       
        $query_empty_cart = "SELECT * FROM hoadon WHERE HD_SL = '0' AND HD_GIA = '0'";
        $select_empty_cart = $this->db->select($query_empty_cart);
        if ($select_empty_cart){
            while ($result_empty_cart = $select_empty_cart->fetch_assoc()){
                $HD_MA = $result_empty_cart['HD_MA'];
                $query = "DELETE FROM hoadon WHERE HD_MA = '$HD_MA'";
                $result = $this->db->select($query);
            }
        }
    }

    public function insert_order($HD_MA,$KH_MA) {
        $HD_MA = mysqli_real_escape_string($this->db->link, $HD_MA);
        $KH_MA = mysqli_real_escape_string($this->db->link, $KH_MA);
        $HD_SL = 0;
        $HD_GIA = 0;
    
        // Kiểm tra và lấy thông tin sản phẩm từ giỏ hàng
        $query_bao_gom = "      SELECT * FROM bao_gom
                                JOIN monan ON monan.MA_MA = bao_gom.MA_MA
                                WHERE HD_MA = '$HD_MA'";
        $select_bao_gom = $this->db->select($query_bao_gom);
        if ($select_bao_gom && $select_bao_gom->num_rows > 0){
            while ($get_bao_gom = $select_bao_gom->fetch_assoc()){
                $MA_SL = $get_bao_gom["MA_SL"];
                $MA_GIA = $get_bao_gom["MA_GIA"] * $MA_SL;
                $HD_SL += $MA_SL;
                $HD_GIA += $MA_GIA;
            }
            $HD_GIA = $HD_GIA * 1.1;
            // Kiểm tra xem hóa đơn đã tồn tại hay chưa
            $query_check_order = "SELECT * FROM hoadon WHERE HD_MA = '$HD_MA' AND KH_MA = '$KH_MA'";
            $check_order_result = $this->db->select($query_check_order);
            if ($check_order_result && $check_order_result->num_rows > 0){
                // Cập nhật tổng số sản phẩm và tổng tiền
                $query_order = "UPDATE hoadon SET HD_SL = '$HD_SL', HD_GIA = '$HD_GIA' WHERE HD_MA = '$HD_MA' AND KH_MA = '$KH_MA'";
                $update_order = $this->db->insert($query_order);
                
            }
            else {
                $query_order = "INSERT INTO hoadon (HD_MA, KH_MA, HD_SL, HD_GIA) VALUES ('$HD_MA','$KH_MA','$HD_SL','$HD_GIA')";
                $insert_cart = $this->db->insert($query_order);
            }
            unset($_SESSION['HD_MA']);
                header('Location: index.php');
                exit;
        }
        else {
            unset($_SESSION['HD_MA']);
            return "<span class='error'>Không thể thanh toán với giỏ hàng rỗng</span>";
        }
    }
    
    

    public function getproduct_payment()
    {
        $HD_MA = $_SESSION['HD_MA'];
        $query = "  SELECT * FROM bao_gom 
                    JOIN monan ON monan.MA_MA = bao_gom.MA_MA
                    WHERE HD_MA = '$HD_MA'";
        $result = $this->db->select($query);
        return $result;
    }

    
    public function show_pay (){
        $query = "SELECT * from hoadon";
        $result = $this->db->select($query);
        return $result;
    }




public function showhoadon(){
    $KH_MA = $_SESSION['KH_MA'];

    $sql = "SELECT ho.HD_MA, ho.HD_GIA, ho.KH_MA, ma.MA_TEN, ho.HD_SL
    FROM hoadon ho 
    INNER JOIN bao_gom bg ON bg.HD_MA = ho.HD_MA
    INNER JOIN monan ma ON bg.MA_MA = ma.MA_MA
    where KH_MA = '$KH_MA' ";

$result = $this->db->select($sql);
        return $result;

}
}
?>