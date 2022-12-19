<?php

namespace App;

/**
  * class InputRadio
  * element radio
  *
  */

class InputRadio extends FormElement
{
	var $name;
	var $value;
	var $label;
	var $matchvalue;

	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari textbox
	  * @param string $label label element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	public function __construct($name,$value,$matchvalue,$attrib='',$label='')
	{
		$this->setType('radio');

		parent::__construct();

		$this->setLabel($label);
		$this->name = $name;
		$this->value = $value;
		$this->matchvalue = $matchvalue;
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
		$this->matchvalue = $value;
	}

	/**
	  * ambil nilai dari element
	  * @param void
	  *
	  * @return string nilai element
	  */

	function getValue()
	{
		$name = $this->name;
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
		$at = implode(" ",$at);

		foreach($this->value as $value => $label){
			$str .= "<input type=radio $at name=".$this->name." value=\"".$value."\" ".($value == $this->matchvalue ? " checked " : "")." >$label&nbsp;\n";
		}

		if(!empty($this->label))
			$str = "<fieldset><legend>".$this->label."</legend>$str</fieldset>";

		return $str;
	}
}
