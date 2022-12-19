<?php

namespace App;

/**
  * class InputEditor
  * element WYSIWYG editor
  *
  */

class InputEditor extends FormElement
{

	var $width;
	var $height;
	var $name;
	var $value;
	var $style="office2003";
	var $path;


	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	public function __construct($name,$value="",$width="",$height="500",$path="FCKeditor/")
	{
		/** initialitation */
		$this->name = $name;
		$this->value = $value;
		$this->width = $width;
		$this->height = $height;
		$this->path = $path;
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
        $editor = new FCKeditor($this->name);
        $editor->BasePath = $this->path;
        $editor->Value = $this->value;
        $editor->Width = "100%";
        $editor->Height = $this->height;


        $editor->Config['SkinPath'] = $this->path."editor/skins/".$this->style."/";

        return $editor->CreateHtml();
	}
}
