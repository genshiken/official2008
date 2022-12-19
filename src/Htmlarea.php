<?php
/**
 * htmlarea.php - untuk meload htmlarea editor wysiwyg
 * author : Erick Lazuardi
 * Date : 6/17/2005 8:13PM
 * nb : untuk menggunakan class ini harus ada folder htmlarea beserta isinya yang tersebut di editor url
 */

namespace App;

class HtmlArea{

	/** editor url */
	var $editorUrl;
	/** editor lang */
	var $editorLang;
	/** nama plugins htmlarea */
	var $plugins = array();
	/** id dari textarea yang akan di ganti menjadi htmlarea */
	var $id = array();


	/**
	 * fungsi HtmlArea - constructor
	 * @param string $edUrl, editor url
	 * @param string $edLang, editor language
	 */
	public function __construct($edUrl="htmlarea/",$edLang="en")
	{
		$this->editorUrl = $edUrl;
		$this->editorLang = $edLang;

		$this->plugins = array();

	}

	/**
	 * fungsi setUrl - mengeset url editor
	 * @param string $url alamat absolute / rel editor dari script pemanggil class
	 */

	function setUrl($url)
	{
		$this->editorUrl = $url;
	}

	/**
	 * fungsi registerId - mendaftarkan id textarea yang akan diganti
	 * @param string $id nama id dari textarea
	 */

	function registerId($id = "htmlarea")
	{
		if(!is_array($id)){
			$this->id[$id] = $id;
		}else{
			foreach($id as $value){
				$this->registerId($value);
			}
		}
	}

	/**
	 * fungsi setLanguage - mengeset lang editor
	 * @param string $lang nama bahasa editor, default = en
	 */

	function setLanguage($lang)
	{
		$this->editorLang = $lang;
	}

	/**
	 * fungsi loadPlugins - meload plugins htmlarea
	 * @param mixed $plugins adalah string / array plugins
	 */

	function loadPlugins($plugins)
	{
		if(!is_array($plugins)){
			$this->plugins[$plugins] = $plugins;
		}else{
			foreach($plugins as $key => $value){
				$this->plugins($value);
			}
		}
	}

	/**
	 * fungsi initJavascript - menuliskan js code
	 * @param NULL
	 */

	function start()
	{
		$t = '     ';
		$jsOpen  = '<script type="text/javascript">'."\n";
        	$jsClose = '</script>'."\n";

		//load conf js
		$js .= $jsOpen;
        	$js .= $t.'_editor_url = "'.$this->editorUrl.'";'."\n";
        	$js .= $t.'_editor_lang = "'.$this->editorLang.'";'."\n";
        	$js .= $jsClose;

        	//include file js
        	$js .= '<script type="text/javascript" src="'.$this->editorUrl.'htmlarea.js"></script>';
        	$js .= '<script type="text/javascript" src="'.$this->editorUrl.'config.js"></script>';

        	foreach($this->id as $value){
        		$js .= '<script type="text/javascript" defer="1">'."\n\t".
    		       	       '	 HTMLArea.replace("'.$value.'",config);'."\n".
		       	       '</script>'."\n";
		}

		echo $js;
	}
}
//end class
?>
