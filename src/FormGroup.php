<?php

namespace App;

/**
  * class InputReset
  * element button Reset
  *
  */

class FormGroup
{
		/** form title */

		var $formTitle = "Untitled";

        /** action page */

        var $action;

        /** enctype wheter use file upload or not */

        var $enctype;

        /** target window */

        var $target;

        /** elements group in one row */

        var $rowElement = array();

        /** temporary element */

        var $tempElement = array();

        /** error message system */

        var $errMsg = array();

        /** hidden fields*/

        var $hiddenfields = array();

        /** rules */

        var $rules = array();

        /** object used by class to validate element */

        var $objValidator;

        /** error validaton */

        var $err = array();

        /**
          * constructor
          * @param string $action adalah url target
          * @param string $method method
          * @param string $enctype enctype
          * @param string $target target window (_blank,_self,_parent)
          *
          * @return void
          */

        public function __construct($action,$method="post",$enctype="",$target="")
        {
                $this->action = $action;
                $this->method = $method;
                $this->enctype = $enctype;
                $this->target = $target;
                $this->objValidator = new Validate;
        }

        function setTitle($title)
        {
        		$this->formTitle = $title;
        }

        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */
        function addText($name,$value,$attrib='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputText($name,$value,$attrib);
                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }



        /**
          * element password
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */
        function addPassword($name,$value,$attrib='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputPassword($name,$value,$attrib);
                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        /**
          * element file upload
          * @param string name nama element
          * @param string value default value
          *
          * return void
          */

        function addFile($name,$value,$attrib='',$size='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputFile($name,$value,$attrib);

                        if(!empty($size)){
                                $obj->setSize($size);
                        }

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addCheckbox($name,$value,$matchvalue,$attrib='',$label='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputCheck($name,$value,$matchvalue,$attrib,$label);
                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addRadio($name,$value,$matchvalue,$attrib = '')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputRadio($name,$value,$matchvalue,$attrib);
                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addSelect($name,$options,$value='',$attrib='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new Selectbox($name,$options,$value,$attrib);

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addSelectOrder($name,$options,$value='',$attrib='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new SelectOrder($name,$options,$value,$attrib);

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }



        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addTextarea($name,$value='',$attrib='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new Textarea($name,$value,$attrib);

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addHidden($name,$value)
        {
                $this->hiddenfields[$name] = $value;
        }


        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addSubmit($name,$value='submit',$attrib='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputSubmit($name,$value,$attrib);

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        /**
          * element textbox
          * @param string name nama element
          * @param string value default value
          * @param string attrib attribut tambahan
          *
          * return void
          */

        function addReset($name,$value='reset',$attrib='')
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputReset($name,$value,$attrib);

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        function addDate($name,$value)
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputDate($name,$value);

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        function addEditor($name,$value="",$height="600",$path="FCKeditor/",$style="")
        {
                if(!array_key_exists($name,$this->tempElement)){
                        $obj  = new InputEditor($name,$value,$width,$height,$path,$style);

                        $this->tempElement[$name] = $obj;
                }else{
                        $this->errMsg[] = "element with name $name  exist";
                }
        }

        function addString($label,$string)
        {
                 $this->rowElement[] = array("label"=>$label,"string"=>$string);
        }

        /**
          * registrasi rule
          * @param string name nama element
          * @param string $rule adalah jenis rule
          * @param string $arg adalah array yang berisi parameter tambahan
          *
          * return void
          */

        function addRule($name,$rule,$arg=null)
        {
        		$item = array('rule'=>$rule,'arg'=>$arg);
                $this->rules[$name][] = $item;

        }

        /**
          * set element menjadi satu row / baris
          * @param int $row menyatakan baris
          * @param string $label adalah label
          * @param string $separator adalah pemisah antar element eg : &nbsp;
          *
          * return void
          */

        function groupAsRow($label='',$separator='&nbsp;',$type='element')
        {
                $this->rowElement[] = array(
                                            'type'=>$type,
                                            'element'=>$this->tempElement,
                                            'label'=>$label,
                                            'separator'=>$separator);
                $this->tempElement = array();

        }

        function submitted()
        {
        	return $_POST['submitted'];
        }

        /**
          * validasi element
          * @param void
          *
          * return bool apakah form valid ato tidak
          */

        function validateElement()
        {

                /** jika terdapat element maka lakukan validasi */
                if(count($this->rowElement)){

                        /** iterasi tiap baris / row element */
                        foreach($this->rowElement as $row => $element){

                                if(is_array($element['element']) && count($element['element'])){

                                /** iterasi element yang ada tiap barisnya */
                                foreach($element['element'] as $name => $item){

                                        /** cek apakah element tersebut membutuhkan validasi ato tidak */
                                        if(array_key_exists($name,$this->rules)){


												$itemrules = $this->rules[$name];
												$err = array();
	                                            foreach($itemrules as $rul){

	                                            	/** jika argumen tambahan ada, maka merge dengan value dari elemen */


		                                            if(is_array($rul['arg']) && count($rul['arg'])){

		                                                $param = $rul['arg'];
		                                                array_unshift($param,$item->getValue());

		                                            /** jika argumen tambahan tidak ada, maka argumen adalah nilai elemen */
		                                            }else{
		                                                $param = array($item->getValue());
	                                                }
	                                                $string = call_user_method_array($rul['rule'],$this->objValidator,$param);
	                                          		if($string == 1)
	                                          			continue;
	                                                array_unshift($err,$string);

	                                            }

	                                            if(count($err) == 0)
		                                           	$errResult = 1;
	    										else
	                                            	$errResult = implode(" , ",$err);

                                                /** jika terjadi error maka masukan ke member array err*/
                                                if($errResult != 1){
                                                        $this->err[$name] = $errResult;
                                                }
                                        }
                                }
                                }
                        }
                }

                /** cek apakah member array berisi item error ato tidak, jika ya indikasikan form tidak valid */
                if(count($this->err))
                        return false;
                else
                        return true;

        }



        /**
          * menampilkan form dalam bentuk html form
          * return void
          */

        function toString()
        {
                /** cek apakah ada error sistem */
                foreach($this->errMsg as $err)
                        $retVal .=  "<li>$err</li>";

                /** mulai membentuk tabel luar */
                $retVal .=  '<table border="0" cellpadding="7" cellspacing="0" width=100%>'."\n";
                $retVal .=  '<tr><th class=formHead colspan=2>'.$this->formTitle.'</th></tr>';
                $retVal .=  '<form action="'.$this->action.'" method="'.$this->method.'" enctype="MULTIPART/FORM-DATA">'."\n";
                $retVal .=  '<input type=hidden name=submitted value=true>';

                /** hidden fields */
                if(count($this->hiddenfields)){
                	foreach($this->hiddenfields as $key => $value)
                		$retval .= "<input type=hidden name=\"$key\" value=\"$value\">\n";
           		}

                $counter = 1;

                /** iterasi per baris */
                foreach($this->rowElement as $item){

                        /** string*/
                        if(in_array("string",array_keys($item))){
                               if(empty($item['label']))
                                        $retVal .= "<tr><td class=formString colspan=2>".$item['string']."</td></tr>";
                               else
                                        $retVal .= "<tr><td class=formStringLeft>".$item['label']."</td><td class=formStringRight>".$item['string']."</td></tr>";

                               continue;
                        }

                        /** label*/
                        if($item['label'] == "")
                                $retVal .=  '<tr><td class="formRight" colspan="2">';
                        else
                                $retVal .=  '<tr><td class="formLeft" width=150px>'.$item['label'].'</td><td class="formRight">';



                        if(is_array($item['element']) && count($item['element'])){

                                /** iterasi per element */
                                foreach($item['element'] as $name => $elemt){

                                        /** jika ada error element */
                                        if(count($this->err)){
                                                /** jika cur element error maka tampilkan error */
                                                if(array_key_exists($name,$this->err)){
                                                        $retVal .=  "<span class=formError>".$this->err[$name]."</span><br>";
                                                }

                                                /** set value untuk ditampilkan kembali */
                                                $elemt->setValue($elemt->getValue());
                                        }

                                        /** tampilkan element */
                                        $retVal .=  $elemt->toString();

                                        /** tampilkan separator antar element */
                                        $retVal .=  $this->separator;

                                        /** tampilkan separator*/
                                        $retVal .=  $item['separator'];
                                }
                        }
                        $retVal .=  '</td></tr>'."\n";


                        /** increment counter */

                        $counter++;
                }
                $retVal .=  '</form>'."\n";
                $retVal .=  '</table>'."\n";
                /** end render */

                return $retVal;
        }

        function display()
        {
                echo $this->toString();
        }


}

?>
