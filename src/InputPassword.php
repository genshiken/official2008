<?php

namespace App;

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
        public function __construct($name,$value,$attrib='')
        {
                $this->setType('text');

                parent::__construct();
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
