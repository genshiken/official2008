<?php

namespace App;

/**
  * class InputCheck
  * element checkbox
  *
  */

class InputCheck extends FormElement
{

	var $name;
	var $value = array();
	var $matchvalue = array();


	public function __construct($name,$value,$matchvalue,$attrib='',$label='')
	{
		$this->setType('checkbox');

		parent::__construct();

		parent::setLabel($label);
		$this->name = $name;
		$this->setAttributes("name",$name."[]");
		$this->value = $value;

		/** match value bisa berupa array atau skalar */
		if(!is_array($matchvalue))
			$this->matchvalue[] = $matchvalue;
		else
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

	function setValue($matchvalue)
	{
    if(!is_array($matchvalue))
			$this->matchvalue[] = $matchvalue;
		else
			$this->matchvalue = $matchvalue;
	}

	/**
	  * apakah dicheck ato tidak
	  * @param void
	  *
	  * @return bool apakah dicheck ato tidak
	  */

	function getChecked()
	{
		return (bool)  $this->getAttribute('checked');
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
			$str .= "<input type=\"checkbox\" name=\"".$this->name."[]\" value=\"$value\" ".(in_array($value,$this->matchvalue) ? " checked " : "" ).">$label &nbsp";
		}

		if(!empty($this->label))
			$str = "<fieldset><legend>".$this->label."</legend>$str</fieldset>";

		return $str;
	}
}

