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

/**
  * class InputText
  * element textbox
  *
  */

class InputText extends FormElement
{
	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari textbox
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */
	function InputText($name,$value,$attrib='')
	{
		$this->setType('text');

		parent::FormElement();
                $this->updateAttribute(array('class'=>'text'));
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
	  * get value ( OVERIDDEN )
	  * @param void
	  *
	  * @return string $value default value dari element
	  */

	function getValue()
	{
		$name = $this->getAttribute('name');
		if(isset($_GET[$name]))
			return $_GET[$name];
		elseif(isset($_POST[$name]))
			return $_POST[$name];

		return $this->getAttribute('value');
	}

	/**
	  * mengubah ke dalam string
	  * @param void
	  *
	  * @return string element html
	  */

	function toString()
	{
		$at = array();
		foreach($this->attributes as $name => $value)
			$at[] = "$name=\"$value\"";

		return '<input type="text" '.implode(" ",$at).'/>';
	}
}

class InputDate extends FormElement
{
        /**
          * constructor
          * @param string $name adalah attribute name
          * @param string $value adalah def value dari textbox
          * @param string $attrib adalah attribute tambahan
          *
          * @return void
          */
        function InputDate($name,$value)
        {
                $this->setType('date');

                parent::FormElement();
                $this->updateAttribute(array('class'=>'text'));
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
          * get value ( OVERIDDEN )
          * @param void
          *
          * @return string $value default value dari element
          */

        function getValue()
        {
                $name = $this->getAttribute('name');
                if(isset($_GET[$name]))
                        return $_GET[$name];
                elseif(isset($_POST[$name]))
                        return $_POST[$name];

                return $this->getAttribute('value');
        }

        /**
          * mengubah ke dalam string
          * @param void
          *
          * @return string element html
          */

        function toString()
        {
                $at = array();
                foreach($this->attributes as $name => $value)
                        $at[] = "$name=\"$value\"";

                return '<input type="text" '.implode(" ",$at).'/>&nbsp;<input type=button class="button" value="get date" onClick="'."showCalendar('".$this->getAttribute('name')."','y-mm-dd')".'">';
        }
}


class InputPassword extends FormElement
{
        /**
          * constructor
          * @param string $name adalah attribute name
          * @param string $value adalah def value dari textbox
          * @param string $attrib adalah attribute tambahan
          *
          * @return void
          */
        function InputPassword($name,$value,$attrib='')
        {
                $this->setType('text');

                parent::FormElement();
                $this->updateAttribute(array('class'=>'text'));
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
          * get value ( OVERIDDEN )
          * @param void
          *
          * @return string $value default value dari element
          */

        function getValue()
        {
                $name = $this->getAttribute('name');
                if(isset($_GET[$name]))
                        return $_GET[$name];
                elseif(isset($_POST[$name]))
                        return $_POST[$name];

                return $this->getAttribute('value');
        }

        /**
          * mengubah ke dalam string
          * @param void
          *
          * @return string element html
          */

        function toString()
        {
                $at = array();
                foreach($this->attributes as $name => $value)
                        $at[] = "$name=\"$value\"";

                return '<input type="password" '.implode(" ",$at).'/>';
        }
}


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


	function InputCheck($name,$value,$matchvalue,$attrib='',$label='')
	{
		$this->setType('checkbox');

		parent::FormElement();

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

	function InputRadio($name,$value,$matchvalue,$attrib='',$label='')
	{
		$this->setType('radio');

		parent::FormElement();

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

	function InputFile($name,$value,$attrib='')
	{
		$this->setType('file');

		parent::FormElement();

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

/**
  * class InputHidden
  * element hidden
  *
  */

class InputHidden extends FormElement
{
	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	function InputHidden($name,$value,$attrib='')
	{
		$this->setType('hidden');

		parent::FormElement();

		$this->setLabel($label);
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
		$this->getAttribute('value');
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

		return '<input type="hidden" '.implode(" ",$at).'/>';
	}
}

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

	function Textarea($name,$value,$attrib='')
	{
		$this->setType('textarea');

		parent::FormElement();

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

	function Selectbox($name,$options,$value='',$attrib='')
	{

		$this->setType('select');

		parent::FormElement();

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


/**
  * class Selectbox
  * element Selectbox
  *
  */

class SelectOrder extends FormElement
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

	function SelectOrder($name,$options,$value='',$attrib='')
	{

		$this->setType('selectorder');

		parent::FormElement();

		$this->updateAttribute(array('name'=>$name."[]"));
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
		$strOutput = "<table  cellpadding=3 cellspacing=0 ><tr><td>";
		$strOutput .= '<select '.implode(" ",$at).' size=5 multiple style=\'width:300px;\'>';

		/** tag <option>*</option> */
		if(count($this->options)){

			foreach($this->options as $value => $display){
				$selected = '';
				if($this->matchValue == $value)
					$selected = ' selected ';
				$strOutput .= "<option value=\"$value\" $selected >".$display.'</option>';
			}
		}else{
			$strOuput .= "<option value=\"\" $selected>empty</option>";
		}
		/** tag </select> */
		$strOutput .= '</select>';
		$strOutput .= '</td></tr>';
		$strOutput .= "<tr><td align=center><input type=button value=\"pull up  \" onClick=\"moveOptionUp(this.form['".$this->getAttribute('name')."'])\"/>".
		               "&nbsp;<input type=button value=\"pull down\" onClick=\"moveOptionDown(this.form['".$this->getAttribute('name')."'])\"/></td></tr></table>";

		return $strOutput;
	}
}

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

	function InputSubmit($name,$value,$attrib='')
	{
		$this->setType('submit');

		parent::FormElement();

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

/**
  * class InputReset
  * element button Reset
  *
  */

class InputReset extends FormElement
{
	/**
	  * constructor
	  * @param string $name adalah attribute name
	  * @param string $value adalah def value dari element
	  * @param string $attrib adalah attribute tambahan
	  *
	  * @return void
	  */

	function InputReset($name,$value,$attrib='')
	{
		$this->setType('reset');

		parent::FormElement();

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

		return '<input type="reset" '.implode(" ",$at).'/>';
	}
}

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

	function InputEditor($name,$value="",$width="",$height="500",$path="FCKeditor/")
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
		if(class_exists("FCKeditor")) {
			$editor = new FCKeditor($this->name);
			$editor->BasePath = $this->path;
			$editor->Value = $this->value;
			$editor->Width = "100%";
			$editor->Height = $this->height;


			$editor->Config['SkinPath'] = $this->path."editor/skins/".$this->style."/";

			return $editor->CreateHtml();
		}else {
			return "Error : class FCKeditor not found";
		}
	}
}
?>