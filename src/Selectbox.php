<?php

namespace App;

/**
  * class Selectbox
  * element Selectbox
  *
  */

class Selectbox extends FormElement
{
	/** nilai yang akan selected ketika ditampilkan */

	var $matchValue;

	/** pilihan yang akan ditampilkan */

	var $options = array();

	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param array $options adalah pilihan
	  * @param string $value adalah def value dari element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	public function __construct($name,$options,$value='',$attrib='')
	{

		$this->setType('select');

		parent::__construct();

		$this->updateAttribute(array('name'=>$name));
		if(is_array($attrib) && count($attrib))
			$this->updateAttribute($attrib);
		if(is_array($options) && count($options))
			$this->options = $options;
		$this->matchValue = $value;
	}

	/**
	  * set default value dari element ( OVERIDDEN )
	  * @param string $value adalah nilai default yang akan ditampilkan
	  *
	  * @return void
	  */

	function setValue($value)
	{
		$this->matchValue = $value;
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

		return $this->matchValue;
	}

	/**
	  * ubah ke bentuk string tag html
	  * @param void
	  *
	  * @return string tag html
	  */

	function toString()
	{
		/** tag <select> */
		$at = array();
		foreach($this->attributes as $name => $value)
			$at[] = "$name=\"$value\"";
		$strOutput = '<select '.implode(" ",$at).' value="'.$this->matchValue.'">';

		/** tag <option>*</option> */
		if(count($this->options)){

			foreach($this->options as $value => $display){
				$selected = '';
				if($this->matchValue == $value)
					$selected = ' selected ';
				$strOutput .= "<option value=\"$value\" $selected>".$display.'</option>';
			}
		}else{
			$strOuput .= "<option value=\"\" $selected>empty</option>";
		}
		/** tag </select> */
		$strOutput .= '</select>';
		return $strOutput;
	}
}
