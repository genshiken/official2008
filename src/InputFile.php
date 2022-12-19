<?php

namespace App;

/**
  * class InputFile
  * element file upload
  *
  */

class InputFile extends FormElement
{

	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	public function __construct($name,$value,$attrib='', $label = null)
	{
		$this->setType('file');

		parent::__construct();

		$this->updateAttribute(array('class'=>'text'));

		$this->setLabel($label);
		$this->updateAttribute(array('name'=>$name));
		$this->updateAttribute(array('value'=>$value));
		if(is_array($attrib) && count($attrib))
			$this->updateAttribute($attrib);
	}

	/**
	  * set size ( MAXSIZE ) file yang boleh diupload
	  * @param string $size adalah ukuran file
	  *
	  * @return void
	  */

	function setSize($size)
	{
		$this->updateAttribute(array('size'=>$name));
	}

	/**
	  * ambil size file
	  * @param void
	  *
	  * @return string ukuran max file
	  */

	function getValue()
	{
		return $_FILES[$this->getAttribute("name")];
	}

	/**
	  * ubah ke bentuk string tag html
	  * @param void
	  *
	  * @return string tag html
	  */

	function toString()
	{
		$at = array();
		foreach($this->attributes as $name => $value)
			$at[] = "$name=\"$value\"";

		return '<input type="file" '.implode(" ",$at).'/>';
	}
}
