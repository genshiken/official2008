<?php

class UploadFile extends File
{
        /** nama variabel upload */
        var $varname = array();

        /** panjang max file yang dapat di upload */
        var $maxlength = 5242880; // 5 MB

        /** regex yang digunakan untuk memfilter filename */
        var $regex;

        /** ekstensi yang diperbolehkan */
        var $allowedExtension = array();

        /** tempat direktori */
        var $destinationDir;

        /** nametype type 0 -> sesuai asli 1 ->random 2-> tanggal*/
        var $nametype = 1;

        /** error */
        var $error = array();

        /** hapus jika ada */
        var $delIfExists = true;

        /**
         * constructor
         */
        function UploadFile($varname="")
        {
                $this->varname[] = $varname;
        }

        /**
         * function addVarname -> menambahkan variabel POST untuk di proses
         *
         * @param string $varname nama variabel
         * @return
         */
        function addVarname($varname)
        {
                $this->varname[] = $varname;
        }

        /**
         * function setDestinationDir mengeset direktori tujuan, bila dir kosong akan dibuat
         *
         * @param mixed $dirname adalah nama direktori
         * @return bool
         */
        function setDestinationDir($dirname)
        {
                $this->destinationDir = $dirname;

        }
        /**
         * function setMaxLength mengeset ukuran max file upload
         *
         * @param int $max
         * @return void
         */
        function setMaxSize($max)
        {
                if(is_int($max)){
                        $this->maxlength = $max;
                }
        }

        /**
         * function setAllowedExtension mengeset ekstensi apa aja yang diperbolehkan
         *
         * @param mixed $what
         * @return bool
         */
        function setAllowedExtension($what)
        {
                if(is_array($what))
                        $this->allowedExtension = $what;
        }

        /**
         * function processUpload memproses dan error check file yang akan diupload
         *
         * @param string $tmpname adalah nama temporary file
         * @param string $filename adalah nama file original
         * @return
         */
        function processUpload($tmpname,$filename)
        {

                /** penamaan file */
                switch($nametype){
                        case 0:
                                $file = $filename;
                                break;
                        case 1:
                                $file = $this->generateRandName($filename);
                                break;
                        case 2:
                                $file = date("dmYHis").".".$this->getExtension($filename);
                                break;
                }

                /** jika dir belum ada maka bikin dulu */

                if(!$this->isDir($this->destinationDir)){

                        if(!$this->makedir($this->destinationDir,0777)){
                                echo "unable to create ".$this->destinationDir;
                                $this->error[] = "Unable to create directory '$dirname'";
                        }
                }

                /** check extension */
                $status = true;
                if(is_array($this->allowedExtension) && count($this->allowedExtension)){
                        if(!in_array($this->getExtension($filename),$this->allowedExtension)){
                                $this->error[] = "Extension $filename not allowed";
                                $status = false;
                        }

                }

                /** jika file sudah ada */
                if($this->isFile($this->destinationDir."/".$file)){
                        if($this->delIfExists){
                                $this->delete($this->destinationDir."/".$file);
                        }else{
                                $this->error[] = "filename $file exists";
                                $status = false;
                        }
                }

                /** check ukuran */
                if($this->getSize($tmpname) > $this->maxlength){
                        $this->error[] = "filesize $filename : ".$this->getSize($tmpname)." exceed max size ( ".$this->maxlength." )";
                        $status = false;
                }

                if($status == false){
                        return;
                }

                if(@move_uploaded_file($tmpname,$this->destinationDir."/".$file))
                        return true;
                else
                        $this->error[] = "error on uploading file from $tmpname to '".$this->destinationDir."/".$file."'";


        }

        /**
         * function processVarname untuk memproses uploadfile per variabel
         *
         * @param mixed $varname nama variabel
         * @return
         */

        function processVarname($varname)
        {
                if(!is_array($_FILES[$varname])  or !count($_FILES[$varname]))
                        return;

                $jumlahFile = count($_FILES[$varname]['name']);

                if(is_array($_FILES[$varname]['name']) && count($_FILES[$varname]['name'])){
                        for($i = 0; $i < $jumlahFile; $i++){

                                if(empty($_FILES[$varname]['name'][$i]))
                                        continue;
                                $this->processUpload($_FILES[$varname]['tmp_name'][$i],$_FILES[$varname]['name'][$i]);

                          }
                  }else{
                          if(!empty($_FILES[$varname]['name']))
                                  $this->processUpload($_FILES[$varname]['tmp_name'],$_FILES[$varname]['name']);
                }
        }

        /**
         * function processAll untuk memproses secara keseluruhan, method dipanggil
         *
         * @param Null
         * @return
         */
        function processAll()
        {
                $this->error = array();
                if(count($this->varname)){
                        foreach($this->varname as $listname)
                                $this->processVarname($listname);

                }

                if(count($this->error))
                        return false;
                else
                        return true;

        }

        /**
         * function getError menampilkan list error
         *
         * @param int $show
         * @return string
         */
        function getError($show=false)
        {

                if(count($this->error)){
                        $strErr = "error ditemukan :";
                        foreach($this->error as $list)
                                $strErr .=  "<li>$list</li>";
                }
                if($show)
                        echo $strErr;
                else
                        return $strErr;

        }
//end class
}

?>
