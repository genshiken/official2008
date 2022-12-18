<?php

class Globals
{

  public static function getVar($var) {
     if (is_array($_GET)) {
         if (isset($_GET[$var])) {
             $result = $_GET[$var];
         }
     } else {
         GLOBAL $HTTP_GET_VARS;
         if (isset($HTTP_GET_VARS[$var])) {
             $result = $HTTP_GET_VARS[$var];
         }
     }

     if (!isset($result)) {
         if (is_array($_POST)) {
             if (isset($_POST[$var])) {
                 $result = $_POST[$var];
             }
         } else {
             GLOBAL $HTTP_POST_VAR;
             if (isset($HTTP_POST_VAR[$var])) {
                 $result = $HTTP_POST_VAR[$var];
             }
         }
     }

     if (isset($result)) {
         if (get_magic_quotes_gpc() && !is_array($result)) {
             return stripslashes($result);
         }
     } else {
         return false;
     }

     return $result;
  }

  public static function redirect($url)
  {
  	if(!headers_sent()){
  		header("Location: $url");
  	}else{
  		echo "<script>document.location = '".$url."'</script>";
  	}
  }

}
?>
