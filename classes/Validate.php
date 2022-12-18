<?php

/**
 * class validate untuk validasi data
 * oleh Erick Lazuardi
 * date 7/10/2005 2:04PM
 */

class Validate
{
	var $regval = array();
	var $listError = array();

	/**
	 * function registerValue
	 * @param array $val adalah array yang berformat sbb :
	 *	array('value'=>'...','function'=>'....','error'=>'...');
	 * @return bool
	 */
	function registerValue($val)
	{
		if(!is_array($val))
			return;
		$this->regval[] = $val;
	}


	/**
	 * function processValidate
	 * @param array $val adalah array yang berformat sbb :
	 *	array('value'=>'...','function'=>'....','error'=>'...');
	 * @return bool
	 */
	function processValidate()
	{
		if(!count($this->regval))
			return true;
		foreach($this->regval as $list){
			if(method_exists($this,$list['function'])){
				if(!call_user_method_array($list['function'],$this,$list['value']))
					$this->listError[] = $list['error'];
			}
		}

		if(count($this->listError))
			return false;
		else
			return true;
	}

	/**
	 * function showError
	 * @param NULL
	 * @return string echoed
	 */
	function showError($show=1)
	{
		$str = "";
		if(count($this->listError)){
			foreach($this->listError as $list){
				$str .= "<li>$list\n";
			}
		}
		if($show)
			echo $str;
		else
			return $str;
	}

	/**
	 * function required
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
	function required($text="")
	{
		if(is_null($text) or (strlen($text) == 0))
			return "required";
		else
			return true;
	}

	/**
	 * function maxlength
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
	function maxlength($text,$opt)
	{
		if(strlen($text) > $opt)
			return "panjang teks maksimal $opt karakter";
		else
			return true;
	}

	/**
	 * function minlength
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
	function minlength($text,$opt)
	{
		if(strlen($text) < $opt)
			return "panjang teks minimal $opt karakter";
		else
			return true;
	}

	/**
	 * function rangelength
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
	function  rangelength($text,$opt)
	{
		if(!is_array($opt)){
			$low = 0;
			$high = $opt;
		}else{
			$low = $opt[0];
			$high = $opt[1];
		}

		if((strlen($text) >= $low) and (strlen($text) <= $high))
			return true;
		else
			return "panjang karakter harus diantara $low dan $high ";
	}

	/**
	 * function regex
	 * @param string $text adalah string yang akan di cek
	 * @param string $opts adalah string regex
	 * @return bool
	 */
	function regex( $val, $opts ) {
            if ( preg_match( $opts, $val ) ) {
                return true;
            } else {
                return false;
            }
        }


        /**
	 * function email
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
        function email( $val, $opts='' ) {
            if($this->regex( $val, '/^((\"[^\"\f\n\r\t\v\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/' ))
            	return true;
            else
            	return "format email tidak valid";
        }

	/**
	 * function lettersonly
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
	function lettersonly( $val, $opts='' ) {
            $result = $this->regex( $val, '/([\D^ ]+)$/' );
            if ( $result === true ) {
                $result = $this->nopunctuation( $val, array() ) ? true : false;
            }
            if($result == false)
            	return "harus berupa huruf";
            else
            	return true;
        }

        /**
	 * function character
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
        function character($text)
        {
        	if($this->lettersonly($text) && strlen(strval($text)))
        		return true;
        	else
        		return "harus berupa karakter";
        }

        /**
	 * function equal
	 * @param string $first adalah string pertama
	 * @param string $second adalah string kedua
	 * @return bool
	 */
        function equal($first,$second)
        {
        	if($first === $second)
        		return true;
        	else
        		return "$first tidak sama dengan param";
        }

        /**
	 * function numeric
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
        function numeric( $val, $opts='' ) {
            if($this->regex( $val, '/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/' ))
            	return true;
            else
            	return "harus numeric";
        }

        /**
	 * function nopunctuation
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
        function nopunctuation( $val, $opts='' ) {
            if($this->regex( $val, '/^[^().\/\*\^\?#!@$%+=,\"\'><~\[\]{}]+$/' ))
            	return true;
            else
            	return "tidak boleh mengandung karakter pemisah";
        }

        /**
	 * function digit
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
        function digit($val)
        {
        	if($this->numeric($val) && (strlen($val) == 1))
        		return true;
        	else
        		return "harus berupa digit, misal : 2";
        }

        /**
	 * function extension
	 * @param string $text adalah string yang akan di cek
	 * @return bool
	 */
        function extension( $val, $opts ) {
            if ( ! is_array( $opts ) ) {
                $opts = array( $opts );
            }
            ereg( ".*\.([a-zA-Z0-9]{0,5})$", $val['name'], $regs );
            return in_array( $regs[1], $opts );
        }

        function minchoice($val,$num)
        {
        	if(!is_array($val))
        		return true;
        	if(count($val) < $num)
        		return "pilihan sekurang-kurangnya $num buah";
        	else
        		return true;
        }

        function maxchoice($val,$num)
        {
        	if(!is_array($val))
        		return true;
        	if(count($val) > $num)
        		return "pilihan maksimal	$num buah";
        	else
        		return true;
        }

        //function checkWord($text,$num = 35){
        function checkWord($text,$num){
          $text = explode(" ",$text);
          $limit = $num;
          foreach($text as $word){
	        $numLetter = strlen($word);

   	        if($numLetter >= $limit){
  	           return "terdapat kata yang terlalu panjang";
            }
          }
          return true;
        }

        function cekNama($string){
         if(ereg("admin",$string)){
          	return "Nama admin tidak boleh digunakan";
          	}
         if(ereg("Admin",$string)){
          	return "Nama Admin tidak boleh digunakan";
          	}
          if(ereg("administrator",$string)){
          	return "Nama administrator tidak boleh digunakan";
          	}
          if(ereg("Administrator",$string)){
          	return "Nama Administrator tidak boleh digunakan";
          	}
          else{
          return true;
        	}
        }


        function isUrl($string){

           // if(ereg("^http://([a-z0-9]+\.)+[a-z]{2,5}$",$string)){
           if(ereg("^http://([a-zA-Z0-9_-]+\.)+[a-z~/]{2,25}$",$string)){
              return true;
            }else{
              return "format url tidak valid, ex : http://riset.sytes.net";
            }
        }

}
//end class
/*
$tes = new Validate;
$tes->registerValue(array("value"=>"aada123","function"=>"numeric","error"=>"harus angka"));
$tes->registerValue(array("value"=>"erick123","function"=>"character","error"=>"harus huruf"));
$tes->registerValue(array("value"=>"erickyahoo.com","function"=>"email","error"=>"email anda tidak valid"));
if(!$tes->processValidate()){
	echo "the following error has occured : ";
	$tes->showError();
}else{
	echo "no Error";
}
*/
?>
