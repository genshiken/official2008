<?php

namespace App;

/**
  * class Selectbox
  * element Selectbox
  *
  */

class InputSubmit extends FormElement
{
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
		$this->setType('submit');

		parent::__construct();

		$this->updateAttribute(array('name'=>$name));
		$this->updateAttribute(array('value'=>$value));
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
		$this->updateAttribute(array('value'=>$value));
	}

	/**
	  * ambil nilai dari element
	  * @param void
	  *
	  * @return string nilai element
	  */

	function getValue()
	{
		if(isset($_GET[$name]))
			return $_GET[$name];
		elseif(isset($_POST[$name]))
			return $_POST[$name];

		return $this->getAttribute('value');
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

		return '<input type="submit" '.implode(" ",$at).'/>';
	}
}
