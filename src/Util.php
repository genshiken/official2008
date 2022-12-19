<?php
///////////////////////////////////////////////////////////////////////////////
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// | Copyright (C) 2005 Mitra Informatika Indonesia                         |
// | http://www.mii-tech.com                                                |
// | All Rights Reserved                                                    |
// |                                                                        |
// | API         : Utility class                                            |
// | Description : Some common utility functions needed by application      |
// |                                                                        |
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// | Author   : Lorensius W. L. T                                           |
// | Email    : lorenz@londatiga.net                                        |
// | Homepage : http://www.londatiga.net                                    |
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/////////////////////////////////////////////////////////////////////////////
//                              class.Util.php
//                          ---------------------------
//    Last updated         : October 25, 2005, 12:07 PM
// //////////////////////////////////////////////////////////////////////////

namespace App;

/** This class contains some common utility functions needed by application
  * @author Lorensius W. L. T (lorenz@londatiga.net)
  * @version 1.0
  */
class Util {

      /** Add leading zero to a digit number
     	* @param integer $s Digit number to be added leading zero
     	* @param integer $n Length of digit number after adding leading zero
     	* @return Digit number with leading zero
     	*/
  	function zeroExtend($s, $n) {
     		for ($i = 0; $i < $n; $i++) {
          	if (strlen($s) == $n) return $s;
          		$s = "0".$s;
     		}

     	return $s;
  	}

      /** show alert end redirect to another page
     	* @param string $msg Digit number to be added leading zero
     	* @param integer $url Length of digit number after adding leading zero
     	* @return Digit number with leading zero
     	*/
  	function alertRedirect($msg, $url) {
	     echo "
	     <script language=Javascript>
	     alert('$msg');
	     document.location='$url';
	     </script>";

  	}

  	/** show alert end redirect to another page
     	* @param string $msg Digit number to be added leading zero
     	* @param integer $url Length of digit number after adding leading zero
     	* @return Digit number with leading zero
     	*/

  	function parseAdd($array)
  	{
		if(!is_array($array) or !count($array))
			return;
		$field = array();
		$value = array();

		foreach($array as $f => $v) {
			$field[] = $f;
			$value[] = addslashes($v);
		}
		return "(".implode(",",$field).") values ('".implode("','",$value)."')";

	}

	/** show alert end redirect to another page
     	* @param string $msg Digit number to be added leading zero
     	* @param integer $url Length of digit number after adding leading zero
     	* @return Digit number with leading zero
     	*/

	function parseEdit($array)
	{
		if(!is_array($array) or !count($array))
			return;
		$value = array();

		foreach($array as $f => $v) {
			$value[] = "$f = '".addslashes($v)."'";

		}

		return  implode(" , ",$value);

	}

	/** show alert end redirect to another page
     	* @param string $msg Digit number to be added leading zero
     	* @param integer $url Length of digit number after adding leading zero
     	* @return Digit number with leading zero
     	*/

	function parseClause($array,$bool = "OR")
	{
		if(!is_array($array) or !count($array))
			return;
		$value = array();

		foreach($array as $f => $v) {
			$value[] = "$f = '$v'";

		}

		return  implode(" $bool ",$value);

	}

	function includeFile($filename,$return = true) {
		if(file_exists($filename) ){
			if($return) {
				ob_start();
				include $filename;
				$retVal = ob_get_contents();
				ob_end_clean();

				return $retVal;
			}else{
				include $filename;
			}
		}
	}

	function displayErrBox($msg) {
		echo "<div align=center style='border:1px solid red;font-family:verdana;font-size:11px;text-align:center;padding:5px;'><font color=red>ERROR</font> : $msg</div>";

	}

	function getNextID(&$adoObj,$table,$id){
		$sql = "select max($id) from $table";
		return (int)$adoObj->GetOne($sql) + 1;
	}

}
?>
