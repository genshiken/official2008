<?php

namespace App;

/**
  * class Textarea
  * element textarea
  *
  */

class Textarea extends FormElement
{
        var $value;

        /**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	public function __construct($name,$value,$attrib='')
	{
		$this->setType('textarea');

		parent::__construct();

		$this->updateAttribute(array('name'=>$name));
		$this->value = $value;
		if(is_array($attrib) && count($attrib))
			$this->updateAttribute($attrib);
	}

	/**
	  * set default value dari element ( OVERIDDEN )
	  * @param string $value adalah nilai default yang akan ditampilkan
	  *
	  * @return void
	  */

	function setValue($value)
	{
		$this->value = $value;
	}

	/**
	  * ambil nilai dari element
	  * @param void
	  *
	  * @return string nilai element
	  */

	function getValue()
	{

        $name = $this->getAttribute('name');
		if(isset($_GET[$name]))
			return $_GET[$name];
		elseif(isset($_POST[$name]))
			return $_POST[$name];

		return $this->value;
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
		foreach($this->attributes as $name => $value){
			$at[] = "$name=\"$value\"";
		}
		return "<textarea ".implode(" ",$at).">".$this->value."</textarea>";
	}
}
