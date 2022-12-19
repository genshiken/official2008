<?php

// +----------------------------------------------------------------------+
// | program library form handling              			  |
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

namespace App;

/**
  * class FormElement base class untuk komponen form element
  *
  */
class FormElement
{
	/** @private string $label label yang akan ditampilkan ( optional ) */

	var $label;

	/** @private string $type adalah tipe dari element */

	var $type;

	/** @private array $attributes adalah attribute dari element */

	var $attributes = array();

	/** @private message */

	var $message;

	/**
	  * constructor
	  * @param string $label adalah label teks yang akan ditampilkan disamping element
	  * @param string $type adalah tipe dari element
	  * @param array $attributes adalah attribut element
	  *
	  * @return void
	  */

	public function __construct()
	{
		$this->setAttributes(array('class'=>$this->type));
	}

	/**
	  * set label mengeset variabel member label
	  * @param string $label adalah label teks yang akan ditampilkan disamping element
	  *
	  * @return void
	  */

	function setLabel($label)
	{
		$this->label = $label;
	}

	/**
	  * set type dari element
	  * @param string $type adalah tipe dari element
	  *
	  * @return void
	  */

	function setType($type)
	{
		$this->type = $type;
	}

	/**
	  * set attribute dari element
	  * @param array $attributes adalah attribut element
	  *
	  * @return void
	  */

	function setAttributes($attr)
	{
		if(is_array($attr))
			$this->attributes = array_merge($this->attributes, $attr);

	}

	/**
	  * set default value dari element ( OVERIDDEN )
	  * @param string $value adalah nilai default yang akan ditampilkan
	  *
	  * @return void
	  */

	function setValue($value)
	{
		//overidden
	}

	/** @param void
	  *
	  * @return string $label label
	  */

	function getLabel()
	{
		return $this->label;
	}

	/**
	  * get type
	  * @param void
	  *
	  * @return string type type element
	  */

	function getType()
	{
		return $this->type;
	}

	/**
	  * get value ( OVERIDDEN )
	  * @param void
	  *
	  * @return string $value default value dari element
	  */

	function getValue()
	{
		//overidden
	}

	/**
	  * menghapus attribute berdasarkan element kunci
	  * @param string $attr adalah key attribute
	  *
	  * @return void
	  */

	function removeAttribute($attr)
	{
		if(array_key_exists($attr,$this->attributes))
			unset($this->attributes[$attr]);
	}

	/**
	  * menghapus attribute berdasarkan element kunci
	  * @param string $attr adalah key attribute
	  *
	  * @return void
	  */

	function updateAttribute($attr)
	{
		if(is_array($attr))
			$this->attributes = array_merge($this->attributes, $attr);
	}

	/**
	  * get attribute
	  * @param void
	  *
	  * @return string $value default value dari element
	  */

	function getAttribute($attr)
	{
		if(array_key_exists($attr,$this->attributes))
			return $this->attributes[$attr];
		else
			return;
	}

	/**
	  * mengubah ke dalam string
	  * @param void
	  *
	  * @return string element html
	  */

	function toString()
	{
		//overiden
	}
}
