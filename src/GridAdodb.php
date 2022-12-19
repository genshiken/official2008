<?php
// +----------------------------------------------------------------------+
// | class untuk tampilan Grid		            			  |
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

namespace App;

/** Class Grid
  * membuat tampilan Grid table dari query result Mysql
  */

class GridAdodb
{
	/** @private dbConn $adoObj
	  */

	var $adoObj;

	/** @private bool $hasPaging apakah paging akan ditampilkan ato tidak
	  */

	var $hasPaging = true;

	/** @private int $recordPerPage adalah jumlah record per halaman
	  */

	var $recordPerPage = 30;

	/** @private int $curPage adalah halaman sekarang
	  */

	var $curPage;

	/** @private bool string $sqlQuery adalah
	  */

	var $SQLQuery;

	/** @private array $column adalah list kolom
	  */

	var $column = array();

	/** @private array $listLinkColumn;
	  */

	var $listLinkColumn = array();

	/** @private array $listLinkField
	  */

	var $listLinkField = array();

	/** @private array $listCheckbox
	  */

	var $listFormElement = array();

	/** @private array $listFunction
	  */

	var $listFunction = array();

	/** @private bool apakah terurut ato tidak
	  */

	var $hasSort = true;

	/** @private array $listQueryString adalah pasangan key value param url
	  */

	var $QueryStringObj;

	/** @private int $hiddenField adalah field yang dihidden
	  */

	var $hiddenCol = array(0);

        /** @private array paramId digunakan sebagai var link
          */

        var $paramId = array();



	/**
	  * constructor
	  * @param ref adoConnection
	  *
	  * @return void
	  */

	public function __construct($adoObj)
	{

		$this->adoObj = $adoObj;

		/** untuk query string */

        $this->QueryStringObj = new QueryString;

		/** untuk curpage */

		$page = $this->QueryStringObj->getValue('page');

		if(empty($page))
			$this->curPage = 1;
		else
			$this->curPage = $this->QueryStringObj->getValue('page');

	}

	/**
	  * set sql query
	  * @param string $sql adalah sql query
	  *
	  * @return void
	  */

	function setQuery($sql)
	{
		$this->SQLQuery = $sql;
	}

	/**
	  * menambahkan kolom sebagai link
	  * @param string $url adalah url target
	  * @peram string $text adalah text yang akan ditampilkan
	  * @param string $target adalah target window
	  * @param bool $popup adalah apakah ditampilkan sebagai popup
	  *
	  * @return void
	  */

	function addLinkColumn($url,$text,$param=null,$target=null,$popup=null)
	{
		$this->listLinkColumn[] = array($url, $text, $target, $popup,$param);

	}

	/**
	  * mengeset kolom sebagai link
	  * @param int $no adalah no field
	  * @param string $url adalah url target
	  * @param string $target adalah target window
	  * @param bool $popup adalah apakah ditampilkan sebagai popup
	  *
	  * @return void
	  */

	function addLinkField($no,$url,$target,$popup)
	{
		$this->listLinkField[$no] = array($url,$target,$popup);
	}

	/**
	  * untuk menambahkan checkbox pada grid
	  * @param string $sql adalah sql query
	  *
	  * @return void
	  */

	function addFormElement($pos,$type,$name,$options=null,$out = true,$indexByCol = true)
	{
		$this->listFormElement[$name] = array('type'=>$type,'pos'=>$pos,'out'=>$out,'options'=>$options,'indexbycol'=>$indexByCol);
	}


        /**
	  * set list kolom yang akan ditampilkan
	  * @param string $sql adalah sql query
	  *
	  * @return void
	  */

	function setColName($col)
	{
		$this->column = $col;
	}

        /**
          * set list kolom yang akan ditampilkan
          * @param string $sql adalah sql query
          *
          * @return void
          */

        function setParamId($param)
        {
                $this->paramId = $param;
        }

	/**
	  * set kolom yang akan disort
	  * @param string $sql adalah sql query
	  *
	  * @return void
	  */

        function setHiddenCol($col) {
                $this->hiddenCol = $col;
        }

	function setOrder($bool)
	{
		$this->hasOrder = (bool)$bool;
	}

	/**
	  * ambil status pengurutan
	  * @param void
	  *
	  * @return string tipe pengurutan
	  */

	function getOrderState()
	{
		if($this->QueryStringObj->getValue("order") == "desc")
			return "asc";
		else
			return "desc";

	}

	/**
	  * set banyak record per halaman
	  * @param string $sql adalah sql query
	  *
	  * @return void
	  */

	function setRecordPerPage($rec)
	{
		$this->recordPerPage = $rec;
	}

	/**
	  * register fungsi untuk memfilter
	  * @param string $func adalah nama fungsi
	  *
	  * @return void
	  */

	function registerFunction($col,$func)
	{
		$this->listFunction[$col] = $func;
	}

	/**
	  * menampilkan paging
	  * @param void
	  *
	  * @return string
	  */

	function displayPaging()
	{
		$str = '';
		/** set query buat diambil total recordnya */

		$result = $this->adoObj->Execute($this->SQLQuery);

		/** ambil total record */

		$total = $result->RecordCount();

		/** object paging */

		$pagingObj = new Paging1($total,$this->recordPerPage);

		$pagingObj->setLinkBeforeAfterCur(5);

		/** gambar paging */

                $endnum = $pagingObj->curPage  * $this->recordPerPage;
                $startnum = $endnum - $this->recordPerPage + 1;
                if($endnum > $total)
                        $endnum = $total;

		$str .= "<table cellpadding=5 cellspacing=0 border=0 class=GridPaging>\r\n";
		$str .= "<tr><td><div style='font-family:verdana; font-size:9pt;'> record $startnum - $endnum of ".$total." record | ".$pagingObj->toString()."</div></td></tr>";
		$str .= "</table><br>";

		/** return value */

		return $str;
	}

	/**
	  * menampilkan grid
	  * @param void
	  *
	  * @return string
	  */

	function toString()
	{
		/** total result */

		$str = '';
		$rs = $this->adoObj->Execute($this->SQLQuery);
		$recordCount  = $rs->RecordCount();
		$fieldCount = $rs->FieldCount();

		/** jika ada paging tampilkan paging */

		if($this->hasPaging){

			/** tampilkan disini */

			$str .= $this->displayPaging();

			/** query grid diganti dengan query limit */

			$SQLQueryLimit = $this->SQLQuery;

			/** variabel sortby */

			$sortBy = $this->QueryStringObj->getValue('sortby');

			/** variabel order */

			$order = $this->QueryStringObj->getValue('order');

			if(($this->hasSort) && !empty($sortBy)){
				$SQLQueryLimit .= " order by $sortBy $order ";
			}


			$SQLQueryLimit .= " limit ".($this->curPage - 1) * $this->recordPerPage.",".$this->recordPerPage;

			$rs = $this->adoObj->Execute($SQLQueryLimit);
		}
		$str .= "<table width='100%' cellpadding=5 cellspacing=1 border=1 class=tabel>\r\n";


		/** untuk field / kolom */


		if(count($this->column)){

			$str .= "<tr>";
			$str .= "<td class=GridJudul valign='top'><div style='font-family:verdana; font-size:9pt;'>&nbsp;</div></td>";

			$i = 0;

			/** set order apakah asc ato desc */

			$this->QueryStringObj->update("order",$this->getOrderState());

			foreach($this->column as $name => $colspan){

				if(in_array($i,$this->hiddenCol))
					$i++;

				/** set sort by berdasar field name */

				if(($this->hasSort) && ($i < $fieldCount)){
					$fObj = $rs->FetchField($i);
                                        $this->QueryStringObj->update("sortby",$fObj->name);
					/** gambar field sebagai link */

					$str .= "<td valign='top' class=GridJudul colspan=".(!empty($colspan) ? $colspan : "")."><div style='font-family:verdana; font-size:9pt;width:150px;'><a href=".$_SERVER['PHP_SELF']."?".$this->QueryStringObj->toString()." class=gridHeadLink>".ucfirst($name)."</a></div></td>\n";

				}else{
                                        $str .= "<td valign='top' class=GridJudul colspan=".(!empty($colspan) ? $colspan : "")."><div style='font-family:verdana; font-size:9pt;'>".ucfirst($name)."</div></td>";
				}

                                /** kolom buat form element */
                                if(count($this->listFormElement)) {
                                        foreach($this->listFormElement as $item) {
                                                if($item['pos'] == $i)
                                                        $str .= "<td class=GridJudul><div style='font-family:verdana; font-size:9pt;'>".$item['caption']."</div></td>";
                                        }
                                }

                                $i++;
			}

			$str .= "</tr>";
		}

		/** tampilkan record */

		/** inisialisasi counter untuk id */
		$cntID = ($this->recordPerPage  * ($this->curPage - 1 )) + 1;

		//for($i=0; $i < $recordCount; $i++){
		while(!$rs->EOF) {

                        /** update param id*/
                       // $this->QueryStringObj->update($this->id,$this->getResult($i,0));

                        if(count($this->paramId)) {
                                $elemtValue = array();
                                foreach($this->paramId as  $name => $colNumber) {
                                        $elemtValue[] = $rs->fields[$colNumber];
                                        $this->QueryStringObj->update($name,$rs->fields[$colNumber]);
                                }
                                $elemtValue = implode("_",$elemtValue);
                        }


			$str .= "\t<tr>\r\n";

			if($i%2 == 0)
				$class="GridGenap";
			else
				$class="GridGanjil";

			/** tampilkan data record per kolom */

			$str .= "<td align=right class=$class><div style='font-family:verdana; font-size:9pt;'>$cntID</div></td>";
			$cntID++;


			for($j=0;$j< $fieldCount;$j++){

				/** jika kolom adalah hidden field maka continue */

				if(in_array($j,$this->hiddenCol))
					continue;

				/** check apakah ada filter yang telah diregister */

				if(count($this->listFunction)){

					/** cek apakah fungsi ada ato ngga */

					if(function_exists($this->listFunction[$j])){

						/** filter value */

						$toShow = $this->listFunction[$j]($rs->fields[$j]);

					}else{
						/** jika tidak difilter tampilkan langsung */

						$toShow = $rs->fields[$j];
					}
				}else{
					/** jika tidak difilter tampilkan langsung */

					$toShow = $rs->fields[$j];
				}

				/** cek apakah ada kolom akan diset sebagai link */

				if(isset($this->listLinkField[$j])){

					/** normalisasi url */

					if(!ereg("\?",$this->listLinkField[$j][0]))

						$nUrl = $this->listLinkField[$j][0]."?";
					else
						$nUrl = $this->listLinkField[$j][0];

					/** jika ada pop up tampilkan popup */

					if($this->listLinkField[$j][2] == true)
						$str .= "\t\t<td class=\"$class\" align=center><div style='font-family:verdana; font-size:9pt;'><a href=# onClick=".popup("$nUrl&no=".$rs->fields[0],600,700)." target=\"".$this->listLinkField[$j][1]."\">$toShow&nbsp;</a></div></td>\r\n";
					else
						$str .= "\t\t<td class=\"$class\" align=center><div style='font-family:verdana; font-size:9pt;'><a href=$nUrl&no=".$rs->fields[0]." target=\"".$this->listLinkField[$j][1]."\">$toShow&nbsp;</a></div></td>\r\n";
				}else{
					$str .= "\t\t<td class=\"$class\"><div style='font-family:verdana; font-size:9pt;'>$toShow&nbsp;</div></td>\r\n";
				}

                                /** tambahkan form element jika out = false */

                                if(count($this->listFormElement)) {
                                        reset($this->listFormElement);
                                        foreach($this->listFormElement as $name => $item) {

                                                /** tuliskan form disini */
                                                if(class_exists($item['type']) and $item['out'] == false and $item['pos'] == $j) {

                                                        if($item['indexbycol'] == true)
                                                                $elmtIndex = $elemtValue;
                                                        else
                                                                $elmtIndex = "";
                                                        switch($item['type']) {
                                                                case "InputText":
                                                                        $obj = new InputText($name."[".$elmtIndex."]","");
                                                                        break;
                                                                case "Selectbox":
                                                                        $obj = new Selectbox($name."[".$elmtIndex."]",$item['options']);
                                                                        break;
                                                                case "InputCheck":
                                                                        $obj = new InputCheck($name."[".$elmtIndex."]",$elemtValue,"");
                                                                        break;
                                                                case "InputRadio":
                                                                        $obj = new InputRadio($name."[".$elmtIndex."]",$elemtValue,"");
                                                                        break;
                                                                default:
                                                                        $obj = null;
                                                        }
                                                        if($obj != null) {
                                                                $str .= "<td class=$class align=center><div style='font-family:verdana; font-size:9pt;'>".$obj->toString()."</div></td>";
                                                        }

                                                }


                                        }

                                }
			}

			/** apakah ada kolom link  yang ditambahkan*/

			if(count($this->listLinkColumn)){

				reset($this->listLinkColumn);

				/** iterasi kolom link yang akan ditambahkan */

				foreach($this->listLinkColumn as $list){
					if(is_array($list[4]) and count($list[4])) {
						foreach($list[4] as $k => $v)
							$this->QueryStringObj->update($k, $v);

					}

      					$str .= "\t\t<td align=center class=\"$class\"><div style='font-family:verdana; font-size:9pt;'><a href=\"".$list[0]."?".$this->QueryStringObj->toString()."\" target=\"".$list[2]."\" ".$list[3]." class=gridLink>".$list[1]."</a></div></td>\r\n";
				}
			}
			$str .= "\t</tr>\r\n";
			$rs->MoveNext();
		}

		$str .= "</table><br>";


		/** jika ada paging tampilkan */

		if($this->hasPaging){
			$str .= $this->displayPaging();
		}

		/** return value */

		return $str;

	}

	/**
	  * menampilkan Grid
	  * @param void
	  *
	  * @return output
	  */

	function display()
	{
		echo $this->toString();
	}
}

?>
