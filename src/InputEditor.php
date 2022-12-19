<?php

namespace App;

/**
  * class InputEditor
  * element WYSIWYG editor
  *
  */

class InputEditor extends FormElement
{

	var $height;
	var $name;
	var $value;


	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	public function __construct($name,$value="",$height="500")
	{
		/** initialitation */
		$this->name = $name;
		$this->value = $value;
		$this->height = $height;
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
		$name = $this->name;
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
        return tag('textarea', [
            'height' => $this->height,
            'id' => $this->name,
            'name' => $this->name,
            'width' => '100%',
        ], e($this->value))
            .tag('script', ['src' => 'vendor/ckeditor/ckeditor/ckeditor.js'])
            .tag('script', null, "
                CKEDITOR.replace('{$this->name}')
            ");
	}
}
