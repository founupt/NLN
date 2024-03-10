<?php
/**
*Session Class
**/

/**
*Session Class
**/

class Session{
 public static function init(){
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }

 public static function set($key, $val){
    $_SESSION[$key] = $val;
 }

 public static function get($key){
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }

 public static function checkSession(){
    self::init();
    if (self::get("adminlogin")== false) {
     self::destroy();
     header("Location:login.php");
    }
 }

 public static function checkLogin(){
    self::init();
    if (self::get("adminlogin") == true) {
     header("Location:index.php");
    }
 }

 public static function destroy(){
  session_destroy();
  header("Location:index.php");
 }
 public static function check_CTV_Session(){
   self::init();
   if (self::get("CTVlogin")== false) {
    self::destroy();
    header("Location:login.php");
   }
}

public static function check_CTV_Login(){
   self::init();
   if (self::get("CTVlogin") == true) {
    header("Location:index.php");
   }
}

public static function check_Customer_Session(){
   self::init();
   if (self::get("customer_login") == false) {
    self::destroy();
    header("Location:/../food/khachhang/login.php");
   }
}

public static function check_Customer_Login(){
   self::init();
   if (self::get("customer_login") == true) {
    header("Location:index.php");
   }
}


}

?>
