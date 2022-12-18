<?php

// +----------------------------------------------------------------------+
// | lib query string manipulation         			  |
// +----------------------------------------------------------------------+
// | Copyright (c) 2005 Divisi Komputer HME ITB                           |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author: Erick Lazuardi  < erick@divkom.ee.itb.ac.id> 	          |
// +----------------------------------------------------------------------+


/** class QueryString
  * untuk memanipulasi query string
  */

class QueryString
{
	/** @private array $keyValuePairs adalah list pasangan key value param url
	  */
	var $keyValuePairs = array();

	/** constructor
	  * @param string $q adalah querystring
	  *
	  * @return void
	  */

	public function __construct($q=null)
	{
		if($q == null){
			$q = $_SERVER['QUERY_STRING'];
		}
		$listKeyValue = explode("&",$q);

		if(is_array($listKeyValue) && count($listKeyValue)){

			foreach($listKeyValue as $item){
				if(preg_match("/^\s*$/",$item))
					continue;

				$temp = explode("=",$item);
				$this->keyValuePairs[$temp[0]] = $temp[1];
			}
		}
	}

	/** update value berdasarkan key yang diberikan
	  * @param string $key key
	  * @param string $value value
	  *
	  * @return void
	  */

	function exist($key)
	{
		return array_key_exists($key,$this->keyValuePairs);
	}

	/** update value berdasarkan key yang diberikan
	  * @param string $key key
	  * @param string $value value
	  *
	  * @return void
	  */

	function getValue($key)
	{
		if(array_key_exists($key,$this->keyValuePairs))
			return $this->keyValuePairs[$key];
	}



	function update($key,$value)
	{
		$this->keyValuePairs[$key] = $value;

	}


	/** delete value berdasarkan key yang diberikan
	  * @param string $key key
	  *
	  * @return void
	  */

	function delete($key)
	{
		if(array_key_exists($key,$this->keyValuePairs))
			unset($this->keyValuePairs[$key]);

	}

	/** add value
	  * @param string $key key
	  * @param string $value value
	  *
	  * @return void
	  */

	function add($key,$value)
	{
		if(!array_key_exists($key,$this->keyValuePairs))
			$this->keyValuePairs[$key] = $value;
	}

	/** mengembalikan ke bentuk query string
	  * @param void
	  *
	  * @return string query string
	  */

	function toString()
	{

		$temp = array();
		foreach($this->keyValuePairs as $key => $value)
			$temp[] = "$key=$value";

		return implode("&amp;",$temp);

	}


}
?>