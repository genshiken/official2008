<?php

// +----------------------------------------------------------------------+
// | program library filesystem handling            			  |
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


class File
{
	/** filename */
	var $fileName;

	/** dirname */
	var $dirName;

	/** ukuran file */
	var $fileSize;

	/** tipe file */
	var $fileType;

	/** file owner */
	var $fileOwner;

	/** file group */
	var $fileGroup;

	/** file permission dalam angka */
	var $filePerm;

	/** array file */
	var $arrayFile = array();

	/** array dir */
	var $arrayDir = array();

	/** list error */
	var $error = array();


	/**
	 * File Constructor
	 * @param string $filename string nama file
	 * @return NULL
	 */
	public function __construct($filename="")
	{
		if(!empty($filename)){

			$this->fileName = $filename;

			$this->dirName = dirname($filename);

			if($this->isFile($this->filename)){

				$this->fileSize = $this->getSize();
				$this->fileOwner = $this->getOwner();
				$this->fileType = $this->getType();
				$this->fileGroup  = $this->getGroup();
				$this->filePerm = $this->getPerm();

			}
		}
	}

	/**
	 * function isFile chek apakah file ato tidak
	 *
	 * @param string $what adalah string file yang akan dicek
	 * @return bool
	 */
	function isFile($what="")
	{
		if(!empty($what)){
		        $what = $this->fileName;
                }
                $ret = false;
                if(file_exists($filename)){
                        if($fp = fopen($filename,"rb")){
                                fclose($fp);
                                return true;
                        }
                }
	}

	/**
	 * function isDir chek apakah direktori ato tidak
	 *
	 * @param string $what adalah string direktori yang akan dicek
	 * @return bool
	 */
	function isDir($what="")
	{
		if(empty($what))
			$what = $this->dirName;

		$retVal = false;

		if(@is_dir($what)){

			if($fdir = @opendir($what)){

				$retVal = true;
				@closedir($fdir);

			}

		}

		return $retVal;

	}

	/**
	 * function read membaca isi file
	 *
	 * @param string $dir adalah nama direktori
	 * @param string $mode adalah chmod /permission direktori
	 * @return bool
	 */
	function makedir($dir, $mode=0755)
	{
		return @(bool)mkdir($dir,$mode);
	}

	/**
	 * function read membaca isi file
	 *
	 * @param string $filename adalah nama file yang akan dibaca
	 * @return bool
	 */
	function read($filename="")
	{
		if(!empty($filename))

			$filename = $this->fileName;

		if($this->isFile($filename)){

			if($fp = @fopen($filename, "r")){

				$retVal = @fread($filename, $this->getSize($filename));

				@fclose($fp);

			}

			return $retVal;

		}

	}

	/**
	 * function write menulis ke file
	 *
	 * @param string $contents adalah string yang akan dimasukan ke file
	 * @param string $filename adalah nama file yang akan ditulis
	 * @param char $mode mode tulis file bisa 'w' ato 'a'
	 * @return NULL
	 */
	function write($contents,$filename="",$mode="w")
	{
		if(empty($filename)){
			$filename = $this->fileName;
		}

		if(!empty($filename)){

			if($fp = @fopen($filename, $mode)){

				@fputs($fp,$contents);

				@fclose($fp);

			}
		}

	}

	/**
	 * function copy untuk mengcopy file ke direktori
	 *
	 * @param string $file adalah file yang akan dicopy
	 * @param string $dest adalah direktori tujuan
	 * @return bool
	 */
	function copy($file, $dest)
	{
		if(empty($file) or empty($dest) or !$this->isFile($file) or !$this->isDir($dest)){

			return false;

		}else{

			return @copy($file, $dest."/".$file);
		}
	}

	/**
	 * function copyRec untuk mencopy folder beserta isinya
	 *
	 * @param string $from_path adalah path yang akan dicopy
	 * @param string $to_path adalah path tujuan
	 * @return bool
	 */
	function copyRec($from_path, $to_path)
	{

		if(substr($from_path,-1) != "/")

			$from_path .= "/";

		if(substr($to_path,-1) != "/")

			$to_path .= "/";

		mkdir($to_path, 0777);

		$this_path = getcwd();

		if (is_dir($from_path)) {

			chdir($from_path);

			$handle=opendir('.');

			while (($file = readdir($handle))!==false) {

				if (($file != ".") && ($file != "..")) {

					if (is_dir($file)) {

						$this->copyRec($from_path.$file."/", $to_path.$file."/");
						chdir($from_path);
					}

					if (is_file($file)){

						copy($from_path.$file, $to_path.$file);

					}

				}

			}


		}

		closedir($handle);

	}


	/**
	 * function delete untuk mendelete file bisa recursive ato flat
	 *
	 * @param string $path adalah nama file / dir yang akan dihapus
	 * @param string $rec adalah mode delete recursive ato tidak
	 * @return bool
	 */
	function delete($path,$rec = true)
	{

		if($this->isFile($path)){

			 @unlink($path);

		}else{
			$fdir = @opendir($path);

			if($fdir){

				while($file = @readdir($fdir)){

					if($file == "." || $file == "..")
						continue;

					$this->delete($path."/".$file);

				}

			}

			@closedir($fdir);


		}
		@rmdir($path);

	}

	/**
	 * function deleteArray menghapus file yang terdapat di array
	 *
	 * @param string $dirname adalah direktori letak file
	 * @param array $arrayFile adalah array file yang akan dihapus
	 * @return bool
	 */
	function deleteArray($dirname,$arrayFile)
	{
		if(!is_array($arrayFile))
			return FALSE;

		foreach($arrayFile as $fileItem)

			$this->delete($dir."/".$fileItem);
	}

	/**
	 * function download untuk memforce download
	 *
	 * @param NULL
	 * @return bool
	 */
	function download()
	{
		if(!empty($this->fileName) and $this->isFile($this->filename)){

			if(!headers_sent()){

				header( "Content-type: ".$this->fileType );

				header( "Content-Length: ".$this->fileSize );

				header( "Content-Disposition: filename=".$this->fileName );

				header( "Content-Description: Download Data" );

				$retVal = $this->read($this->fileName);

				echo $retVal;

			}
		}
	}



	/**
	 * function getType untuk mendapatkan tipe file
	 *
	 * @param mixed $filename adalah nama file yang akan dicari tipenya
	 * @return bool
	 */
	function getType($filename = "")
	{
		$mimetypes = array(
		         ".ez" => "application/andrew-inset",
		         ".hqx" => "application/mac-binhex40",
		         ".cpt" => "application/mac-compactpro",
		         ".doc" => "application/msword",
		         ".bin" => "application/octet-stream",
		         ".dms" => "application/octet-stream",
		         ".lha" => "application/octet-stream",
		         ".lzh" => "application/octet-stream",
		         ".exe" => "application/octet-stream",
		         ".class" => "application/octet-stream",
		         ".so" => "application/octet-stream",
		         ".dll" => "application/octet-stream",
		         ".oda" => "application/oda",
		         ".pdf" => "application/pdf",
		         ".ai" => "application/postscript",
		         ".eps" => "application/postscript",
		         ".ps" => "application/postscript",
		         ".smi" => "application/smil",
		         ".smil" => "application/smil",
		         ".wbxml" => "application/vnd.wap.wbxml",
		         ".wmlc" => "application/vnd.wap.wmlc",
		         ".wmlsc" => "application/vnd.wap.wmlscriptc",
		         ".bcpio" => "application/x-bcpio",
		         ".vcd" => "application/x-cdlink",
		         ".pgn" => "application/x-chess-pgn",
		         ".cpio" => "application/x-cpio",
		         ".csh" => "application/x-csh",
		         ".dcr" => "application/x-director",
		         ".dir" => "application/x-director",
		         ".dxr" => "application/x-director",
		         ".dvi" => "application/x-dvi",
		         ".spl" => "application/x-futuresplash",
		         ".gtar" => "application/x-gtar",
		         ".hdf" => "application/x-hdf",
		         ".js" => "application/x-javascript",
		         ".skp" => "application/x-koan",
		         ".skd" => "application/x-koan",
		         ".skt" => "application/x-koan",
		         ".skm" => "application/x-koan",
		         ".latex" => "application/x-latex",
		         ".nc" => "application/x-netcdf",
		         ".cdf" => "application/x-netcdf",
		         ".sh" => "application/x-sh",
		         ".shar" => "application/x-shar",
		         ".swf" => "application/x-shockwave-flash",
		         ".sit" => "application/x-stuffit",
		         ".sv4cpio" => "application/x-sv4cpio",
		         ".sv4crc" => "application/x-sv4crc",
		         ".tar" => "application/x-tar",
		         ".tcl" => "application/x-tcl",
		         ".tex" => "application/x-tex",
		         ".texinfo" => "application/x-texinfo",
		         ".texi" => "application/x-texinfo",
		         ".t" => "application/x-troff",
		         ".tr" => "application/x-troff",
		         ".roff" => "application/x-troff",
		         ".man" => "application/x-troff-man",
		         ".me" => "application/x-troff-me",
		         ".ms" => "application/x-troff-ms",
		         ".ustar" => "application/x-ustar",
		         ".src" => "application/x-wais-source",
		         ".xhtml" => "application/xhtml+xml",
		         ".xht" => "application/xhtml+xml",
		         ".zip" => "application/zip",
		         ".au" => "audio/basic",
		         ".snd" => "audio/basic",
		         ".mid" => "audio/midi",
		         ".midi" => "audio/midi",
		         ".kar" => "audio/midi",
		         ".mpga" => "audio/mpeg",
		         ".mp2" => "audio/mpeg",
		         ".mp3" => "audio/mpeg",
		         ".aif" => "audio/x-aiff",
		         ".aiff" => "audio/x-aiff",
		         ".aifc" => "audio/x-aiff",
		         ".m3u" => "audio/x-mpegurl",
		         ".ram" => "audio/x-pn-realaudio",
		         ".rm" => "audio/x-pn-realaudio",
		         ".rpm" => "audio/x-pn-realaudio-plugin",
		         ".ra" => "audio/x-realaudio",
		         ".wav" => "audio/x-wav",
		         ".pdb" => "chemical/x-pdb",
		         ".xyz" => "chemical/x-xyz",
		         ".bmp" => "image/bmp",
		         ".gif" => "image/gif",
		         ".ief" => "image/ief",
		         ".jpeg" => "image/jpeg",
		         ".jpg" => "image/jpeg",
		         ".jpe" => "image/jpeg",
		         ".png" => "image/png",
		         ".tiff" => "image/tiff",
		         ".tif" => "image/tif",
		         ".djvu" => "image/vnd.djvu",
		         ".djv" => "image/vnd.djvu",
		         ".wbmp" => "image/vnd.wap.wbmp",
		         ".ras" => "image/x-cmu-raster",
		         ".pnm" => "image/x-portable-anymap",
		         ".pbm" => "image/x-portable-bitmap",
		         ".pgm" => "image/x-portable-graymap",
		         ".ppm" => "image/x-portable-pixmap",
		         ".rgb" => "image/x-rgb",
		         ".xbm" => "image/x-xbitmap",
		         ".xpm" => "image/x-xpixmap",
		         ".xwd" => "image/x-windowdump",
		         ".igs" => "model/iges",
		         ".iges" => "model/iges",
		         ".msh" => "model/mesh",
		         ".mesh" => "model/mesh",
		         ".silo" => "model/mesh",
		         ".wrl" => "model/vrml",
		         ".vrml" => "model/vrml",
		         ".css" => "text/css",
		         ".html" => "text/html",
		         ".htm" => "text/html",
		         ".asc" => "text/plain",
		         ".txt" => "text/plain",
		         ".rtx" => "text/richtext",
		         ".rtf" => "text/rtf",
		         ".sgml" => "text/sgml",
		         ".sgm" => "text/sgml",
		         ".tsv" => "text/tab-seperated-values",
		         ".wml" => "text/vnd.wap.wml",
		         ".wmls" => "text/vnd.wap.wmlscript",
		         ".etx" => "text/x-setext",
		         ".xml" => "text/xml",
		         ".xsl" => "text/xml",
		         ".mpeg" => "video/mpeg",
		         ".mpg" => "video/mpeg",
		         ".mpe" => "video/mpeg",
		         ".qt" => "video/quicktime",
		         ".mov" => "video/quicktime",
		         ".mxu" => "video/vnd.mpegurl",
		         ".avi" => "video/x-msvideo",
		         ".movie" => "video/x-sgi-movie",
		         ".ice" => "x-conference-xcooltalk");

		   if(empty($filename)){

		   	$filename = $this->fileName;

		   	$ext = ".".strtolower($this->getExtension($filename));

		   	if(array_key_exists($ext,$mimetypes)){

		   		return $mimetypes[$ext];

		   	}
		   }

	}

	/**
	 * function getExtension mencari ekstensi file
	 *
	 * @param mixed $filename yang akan diproses
	 * @return string ekstensi file
	 */
	function getExtension($filename="")
	{
		if(empty($filename)){

			$filename = $this->fileName;
		}
		$fp = explode(".",$filename);

			return $fp[count($fp) - 1];
	}

	/**
	 * function getOwner
	 *
	 * @param mixed $filename adalah nama file
	 * @return string
	 */
	function getOwner($filename = "")
	{
		if(empty($filename)){

			$filename = $this->fileName;
		}

		return fileowner($filename);
	}

	/**
	 * function getGroup
	 *
	 * @param mixed $filename adalah nama file
	 * @return string
	 */
	function getGroup($filename = "")
	{
		if(empty($filename)){

			$filename = $this->fileName;
		}
		return filegroup($filename);
	}


	/**
	 * function getSize
	 *
	 * @param mixed $filename adalah nama file
	 * @return string
	 */
	function getSize($filename = "")
	{
		if(empty($filename)){

			$filename = $this->fileName;
		}
		return filesize($filename);
	}

	/**
	 * function listFile
	 *
	 * @param mixed $filename adalah nama file
	 * @return string
	 */
	function listFile($dir = "",$mode = 1)
	{

		if($this->isDir($dir)){

			$collection = array();

			$ldir = opendir($dir);

			if($ldir){

				while($item = readdir($ldir)){

					if($item == "." || $item == "..")

						continue;

					switch($mode){

						case 1:
							if(!$this->isDir($dir."/".$item)){
							    $collection[] = $item;
                                                        }
							break;

						case 2:

							if($this->isDir($dir."/".$item)){
							    $collection[] = $item;
                                                        }
							break;

						case 3:
							$collection[] = $item;
							break;
					}

				}

				closedir($ldir);

				return $collection;
			}

		}

	}
}



?>