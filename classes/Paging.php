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
//include "QueryString.php";

/**
  * class Paging
  * used for split page
  */

class Paging1
{
	/** @private string $curpage
	  * halaman sekarang
	  */

	var $curPage;

	/** @private string $startPage
	  * start link halaman yang akan ditampilkan
	  */

	var $startPage;

	/** @private string $endPage
	  * end link halaman yang akan ditampilkan
	  */

	var $endPage;

	/** @private int $totalRec
	  * total record
	  */

	var $totalRec;

	/** @private int $recPerPage
	  * jumlah rec yang akan ditampilkan per halaman
	  */

	var $recPerPage;

	/** @private int $numBeforeAfter
	  * jumlah link yang akan ditampilkan sebelum curpage dan sesudah curpage
	  */

	var $numBeforeAfter = 3;

	/** @private string $selfUrl
	  * url target link
	  */

	var $selfUrl;

	/** @private bool $isPrevNext
	  * apakah link prev dan next akan ditampilkan
	  */

	var $isPrevNext = true;

	/** @private bool $isFirstLast
	  * apakah link first dan last akan ditampilkan
	  */

	var $isFirstLast = true;

	/** @private string $prevSymbol
	  * simbol untuk link prev
	  */

	var $prevSymbol = "[prev]";

	/** @private string $nextSymbol
	  * simbol untuk link next
	  */

	var $nextSymbol = "[next]";

	/** @private string $firstSymbol
	  * simbol untuk link first
	  */

	var $firstSymbol = "[first]";

	/** @private string $lastSymbol
	  * simbol untuk link last
	  */

	var $lastSymbol = "[last]";

	/** @private obj
	  * QS obj untuk manipulasi qs
	  */

	var $QueryStringObj;



	var $errMsg = array();


	/** constructor
	  * @param int $totalRec adalah total record
	  * @param int $recPerPage adalaha jumlah record yang akan ditampilkan per halaman
	  * @param string $selfUrl adalah url target
	  *
	  * @return void
	  */

	function Paging1($totalRec,$recPerPage)
	{
		if(empty($totalRec))
			$this->errMsg[] = "Total record cannot be null";
		else
			$this->totalRec = $totalRec;
		if(empty($recPerPage))
			$this->errMsg[] = "record perpage cannot be null";
		else
			$this->recPerPage = $recPerPage;

		$this->selfUrl = $_SERVER['PHP_SELF'];


		$this->QueryStringObj = new QueryString;

		$page = $this->QueryStringObj->getValue('page');

		if(empty($page))
			$this->curPage = 1;
		else
			$this->curPage = (int)$this->QueryStringObj->getValue('page');

	}

	/** untuk mengambil jumlah halaman
	  * @param void
	  *
	  * @return int jumlah halaman
	  */

	function setLinkBeforeAfterCur($link)
	{
		$this->numBeforeAfter = $link;
	}

	/** untuk mengambil jumlah halaman
	  * @param void
	  *
	  * @return int jumlah halaman
	  */

	function getNumPage()
	{
		return ceil($this->totalRec / $this->recPerPage);
	}

	/** mengecek status apakah cur page berada di awal ato tidak
	  * @param int $pos adalah posisi yang akan dicek
	  *
	  * @return bool apakah bof ato tidak
	  */

	function isBOF($pos=null)
	{
		if($pos == null)
			return ($this->curPage <= 1 ? true : false);
		else
			return ($pos <= 1 ? true : false);
	}

	/** mengecek status apakah cur page berada di akhir
	  * @param int $pos adalah posisi yang akan dicek
	  *
	  * @return bool apakah EOF
	  */

	function isEOF($pos=null)
	{
		if($pos == null)
			return ($this->curPage >= ($this->totalRec / $this->recPerPage) ? true : false );
		else
			return ($pos >= ($this->totalRec / $this->recPerPage) ? true : false);
	}

	function setPageInUrl($page)
	{
		if($this->QueryStringObj->exist('page'))
			$this->QueryStringObj->update('page',$page);
		else
			$this->QueryStringObj->add('page',$page);
	}

	/** proses penentuan start, end page dan prepare $selfUrl yang akan digunakan
	  * @param void
	  *
	  * @return void
	  */

	function prepare()
	{
		$pageNumber = $this->getNumPage();

		if($this->isBOF($this->curPage - $this->numBeforeAfter + 1) or ($this->curPage - $this->numBeforeAfter <= 0)	)
			$this->startPage = 1;
		else
			$this->startPage = $this->curPage - $this->numBeforeAfter + 1;

		if($this->isEOF($this->curPage + $this->numBeforeAfter - 1))
			$this->endPage = $pageNumber;
		else
			$this->endPage = $this->curPage + $this->numBeforeAfter - 1;
		if(!preg_match("/\?/",$this->selfUrl))
			$this->selfUrl .= "?";
		else
			$this->selfUrl .= "&";

	}

	/** menampilkan paging
	  * @param void
	  *
	  * @return string
	  */

	function toString()
	{

                if($this->totalRec < $this->recPerPage){
                        return;
                }

		$this->prepare();
		if(!count($this->errMsg)){

			$str = "";
			if($this->isFirstLast){
				if(!$this->isBOF()){
					$this->setPageInUrl(1);
					$str .= "<a href='".$this->selfUrl.$this->QueryStringObj->toString()."'>".$this->firstSymbol."</a>&nbsp;";
				}else{
					$str .= $this->firstSymbol."&nbsp;";
				}
			}
			if($this->isPrevNext){
				if(!$this->isBOF()){
					$this->setPageInUrl(($this->curPage - 1));
					$str .= "<a href='".$this->selfUrl.$this->QueryStringObj->toString()."'>".$this->prevSymbol."</a>&nbsp;";
				}else{
					$str .= $this->prevSymbol."&nbsp;";
				}
			}
			$str.= "&nbsp;&nbsp;&nbsp;";
			for($i = $this->startPage; $i <= $this->endPage; $i++){
				if($i == $this->curPage){
					$str .= "<b>$i</b>&nbsp;";
				}else{
					$this->setPageInUrl($i);
					$str .= "<a href='".$this->selfUrl.$this->QueryStringObj->toString()."'>".$i."</a>&nbsp;";
				}
			}

			$str.= "&nbsp;&nbsp;&nbsp;";
			if($this->isPrevNext){
				if(!$this->isEOF()){
					$this->setPageInUrl(($this->curPage + 1));
					$str .= "<a href='".$this->selfUrl.$this->QueryStringObj->toString()."'>".$this->nextSymbol."</a>&nbsp;";
				}else{
					$str .= $this->nextSymbol."&nbsp;";
				}
			}
			if($this->isFirstLast){
				if(!$this->isEOF()){
					$this->setPageInUrl($this->getNumPage());
					$str .= "<a href='".$this->selfUrl.$this->QueryStringObj->toString()."'>".$this->lastSymbol."</a>&nbsp;";
				}else{
					$str .= $this->lastSymbol."&nbsp;";
				}
			}
		}else{
			$str = "Error : ";
			foreach($this->errMsg as $list){
				$str .= "<li>$list</li>\n";
			}
		}
		return $str;


	}

	/** menampilkan paging
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