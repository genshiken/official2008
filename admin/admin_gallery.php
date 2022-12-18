<?

/** Modul Admin For Galeria */
/** date : 03/12/2006 8:27PM *
/** author: Andhy Sukma Perdana *
/** web : http://riset.sytes.net *
/** email : andhy@radar.ee.itb.ac.id */

$allowedExtension3 = array('gif','GIF','jpg','JPG','png','PNG');
$destDir4 = "gallery";

function AddGallery(){
	include "conf.php";
	global $adoObj,$destDir4, $allowedExtension3;
	
	$form = new FormGroup("adminutama.php?m=AddGallery","post");
	$form->setTitle("<div class='title'>Form Editorial Gallery</div>");
	
	$form->addText("judul_official_gallery","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Title</div>");
	
	$form->addFile("image_official_gallery","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Picture</div>");
	
	$form->addEditor("isi_official_gallery");
    $form->groupAsRow("<div class='leftbox'>Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");
	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("judul_official_gallery","required");
	
	if($form->submitted() && $form->validateElement())
	{
		$no = $adoObj->PO_Insert_ID('official_gallery','id_official_gallery') + 1;
      	$upl = new UploadFile('image_official_gallery');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir4);
      	$upl->setAllowedExtension($allowedExtension3);
      	if($upl->processAll())
		{
        	$tipe = $_FILES['image_official_gallery']['type'];
          	$ukuran = $_FILES['image_official_gallery']['size'];
          	$nama = $_FILES['image_official_gallery']['name'];
      	}
		else
		{
      		echo $upl->getError();
      	}
      	$adoObj->StartTrans();
      	include "classes/Thumbnail.class.php";
     	$fot = "gallery/".$nama;
     	$thumb=new Thumbnail($fot);	
     	$thumb->size_width(360);
     	$thumb->quality=100; 		                // [OPTIONAL] set the biggest width and height for thumbnail
		$thumb->process();
							
		$thumb->txt_watermark_Hmargin=5;           // [OPTIONAL] set watermark text horizonatal margin in pixels
		$thumb->txt_watermark_Vmargin=5; 
		$thumb->txt_watermark='Document of Genshiken ITB';	    // [OPTIONAL] set watermark text [RECOMENDED ONLY WITH GD 2 ]
		$thumb->txt_watermark_color='cccccc';	    // [OPTIONAL] set watermark text color , RGB Hexadecimal[RECOMENDED ONLY WITH GD 2 ]
		$thumb->txt_watermark_font=2;	            // [OPTIONAL] set watermark text font: 1,2,3,4,5
		$thumb->txt_watermark_Valing='BOTTOM';   	// [OPTIONAL] set watermark text vertical position, TOP | CENTER | BOTTOM
		$thumb->txt_watermark_Haling='CENTER';       // [OPTIONAL] set watermark text horizonatal position, LEFT | CENTER | RIGHT
		$thumb->process();

		//$thumb=new Thumbnail($fot);	        // Contructor and set source image file
		//$thumb->img_watermark='watermark.png';	    // [OPTIONAL] set watermark source file, only PNG format [RECOMENDED ONLY WITH GD 2 ]
   		// generate image
		$filename=$thumb->unique_filename ( '.' , $nama , 'thumb');  // generate unique filename
		$status=$thumb->save("gallery/small/".$filename);            // save your thumbnail to file
							
     	//$judul = Globals::getVar("judul_official_gallery");
		$judul = $_POST['judul_official_gallery'];
     	//$deskripsi = Globals::getVar("isi_official_gallery");
		$deskripsi = $_POST['isi_official_gallery'];
     	$time=date("d/m/y");

  
     	$sql = "INSERT INTO official_gallery (id_official_gallery,waktu_upload_official_gallery,judul_official_gallery,image_official_gallery,isi_official_gallery) values ('$no',now(),'$judul','$nama','$deskripsi')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
      
		if($res == false)
		{
        	Util::alertRedirect('Entry Failed!','adminutama.php?&m=ListGallery');
     	}
		else
		{
        	Util::alertRedirect('Done!','adminutama.php?&m=ListGallery');
     	}
	}				
	else
	$form->display();
}

function ListGallery()
{
    global $adoObj;
    include "conf.php";
    $grid = new GridAdodb($adoObj);
    $grid->setParamID(array("id_official_gallery"=>0));
    $grid->setQuery("select id_official_gallery,waktu_upload_official_gallery,judul_official_gallery,image_official_gallery from official_gallery");
    $grid->setColName(array("Posted"=>"","Title"=>"","Image File"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    $grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"official_gallery","m"=>"BrowseGallery"));
    $grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"official_gallery","m"=>"EditGallery"));
    $grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"official_gallery","m"=>"DeleteGallery"));
    
    $grid->display();
}

function BrowseGallery()
{
	include "conf.php";
    $no = Globals::getVar("id_official_gallery");
    $sql = "select * from official_gallery where id_official_gallery='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
	{
		while(!$recordSet->EOF)
		{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?
					echo "&raquo; ". $recordSet->fields['judul_official_gallery'];
					echo"<br />";
					?>
				</div>
				<br />
				<div class="newsimage">
					<?
					$image_official_gallery = $recordSet->fields['image_official_gallery'];
					
					if(strlen($image_official_gallery) < 1)
						{
						}
					else{						
						$image_path			= $image_gallery.$image_official_gallery;
						$image_size			= GetImageSize($image_path);
						$image_width		= $image_size[0];
						
						$screen_res_load 	= fopen("dump/screen.txt","r");
						$screen_res 		= fread($screen_res_load,4);
						
						if($screen_res == 1280)
							{
							$screen_margin		= 145;
							$screen_resefective = (0.8 * $screen_res) - $screen_margin;
							if($image_width >= $screen_resefective)
								{							
								$image_width = floor($screen_resefective);
								echo "<img width='$image_width' src='$image_path' alt='' />";
								}
							else
								{
								echo "<img src='$image_path' alt='' />";
								}
							}
						elseif($screen_res == 1152)
							{
							$screen_margin		= 135;
							$screen_resefective = (0.8 * $screen_res) - $screen_margin;
							if($image_width >= $screen_resefective)
								{							
								$image_width = floor($screen_resefective);
								echo "<img width='$image_width' src='$image_path' alt='' />";
								}
							else
								{
								echo "<img src='$image_path' alt='' />";
								}
							}
						elseif($screen_res == 1024)
							{
							$screen_margin		= 125;
							$screen_resefective = (0.8 * $screen_res) - $screen_margin;
							if($image_width >= $screen_resefective)
								{							
								$image_width = floor($screen_resefective);
								echo "<img width='$image_width' src='$image_path' alt='' />";
								}
							else
								{
								echo "<img src='$image_path' alt='' />";
								}
							}
						else
							{
							$screen_margin		= (0.123 * $screen_res);
							$screen_resefective = (0.8 * $screen_res) - $screen_margin;
							if($image_width >= $screen_resefective)
								{							
								$image_width = floor($screen_resefective);
								echo "<img width='$image_width' src='$image_path' alt='' />";
								}
							else
								{
								echo "<img src='$image_path' alt='' />";
								}
							}						
						};
					?>
				</div>
				<div class="newsdesc">
					<?				
					echo"". $recordSet->fields['isi_official_gallery'];
					echo"<br />";
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?
					echo"Posted : ". $recordSet->fields['waktu_upload_official_gallery'];
					echo"<br />";
					?>
				</div>
			</div>
			<?
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=EditGallery&id_official_gallery=$no> Edit</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=DeleteGallery&id_official_gallery=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();				
			}
		}
}


function DeleteGallery()
{
	global $adoObj, $no;
	
	$no = Globals::getVar('id_official_gallery');
	$sql = "select image_official_gallery from official_gallery where id_official_gallery='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row['image_official_gallery'];
	$extension= strtolower( substr( strrchr($photo, ".") ,1) );
	if (strlen($photo) > 0)
	{
		$foto = "gallery/".$photo;
		$foto2 = "gallery/small/thumb_".$photo.".".$extension;
		unlink($foto);
		unlink($foto2);
	}
				
    $sql  = "delete from official_gallery where id_official_gallery='$no'";
    $ret = $adoObj->Execute($sql);

	if($ret == false)
	{
    	Util::alertRedirect('Delete Gagal','adminutama.php?&m=ListGallery');
    }
	else
	{
    	Util::alertRedirect('Delete sukses','adminutama.php?&m=ListGallery');
    }
}


function EditGallery()
{
	
	include "conf.php";
	global $adoObj,$destDir4, $allowedExtension3, $no;
	
	
	$no = Globals::getVar('id_official_gallery');
	
	$sql = "select * from official_gallery where id_official_gallery='$no'";
	$row = $adoObj->GetRow($sql);
		
	$form = new FormGroup("adminutama.php?m=EditGallery&id_official_gallery=$no","post");
	
	$form->setTitle("<div class='title'>Form Editorial Gallery</div>");
	
	$form->addHidden("id_official_gallery",$no);
	$form->addText("judul_official_gallery", $row['judul_official_gallery'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Title</div>");
	
  	$form->addHidden("id_official_gallery",$no);
  	$loc =  "gallery";
  	$info .= "<a href=".$loc."/".$row['image_official_gallery'].">";
  	$info .= $row['image_official_gallery'];
  	$info .= "</a>&nbsp;";
	$file_path = "gallery/".$row['image_official_gallery'];
	$file_size1 = filesize($file_path);
	$file_size = to_readble_size($file_size1);
	$info .= "(&nbsp;".$file_size."&nbsp;";
		if($file_size1 > 1099511627776)
			{
			$suffix = 'TB';
			}
		elseif($file_size1 > 1073741824)
			{
			$suffix = 'GB';
			}
		elseif($file_size1 > 1048576)
			{
			$suffix = 'MB';
			}
		elseif($file_size1 > 1024)
			{
			$suffix = 'KB';
			}
		else
			{
			$suffix = 'B';
		};
	$info .= $suffix; 
	$info .= "&nbsp;)";
	$form->addString("<div class='leftbox'>Uploaded Picture</div>","<div class='leftbox'>".$info."</div>");
	
	$form->addFile("image_official_gallery",$row['image_official_gallery'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Picture</div>");
	
	$form->addEditor("isi_official_gallery",$row['isi_official_gallery']);
    $form->groupAsRow("<div class='leftbox'>Description</div>");
    	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_official_gallery","required");
		
	if($form->submitted() && $form->validateElement())
	{
		$no = Globals::getVar("id_official_gallery");
		$sql = "select image_official_gallery from official_gallery where id_official_gallery='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_official_gallery'];
		$extension= strtolower( substr( strrchr($photo, ".") ,1) );
		
      	$upl = new UploadFile('image_official_gallery');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir4);
     	$upl->setAllowedExtension($allowedExtension3);
      	if($upl->processAll())
		{
        	$tipe = $_FILES['image_official_gallery']['type'];
          	$ukuran = $_FILES['image_official_gallery']['size'];
          	$nama = $_FILES['image_official_gallery']['name'];
      	}
		else
		{
      		echo $upl->getError();
      	}
      	$adoObj->StartTrans();

      	//$judul = Globals::getVar("judul_official_gallery");
		$judul = $_POST['judul_official_gallery'];
     	//$deskripsi = Globals::getVar("isi_official_gallery");
		$deskripsi = $_POST['isi_official_gallery'];
     	if(strlen($nama) < 1)
		{
	    	$sql = "UPDATE official_gallery SET judul_official_gallery='$judul',isi_official_gallery='$deskripsi' where id_official_gallery='$no'";
		}
      	else
      	{
			include "classes/Thumbnail.class.php";
     		$fot = "gallery/".$nama;
     		$thumb=new Thumbnail($fot);	
     		$thumb->size_width(360);
     		$thumb->quality=100; 		                // [OPTIONAL] set the biggest width and height for thumbnail
			$thumb->process();
							
			$thumb->txt_watermark_Hmargin=5;           // [OPTIONAL] set watermark text horizonatal margin in pixels
			$thumb->txt_watermark_Vmargin=5; 
			$thumb->txt_watermark='Documentary of Genshiken ITB';	    // [OPTIONAL] set watermark text [RECOMENDED ONLY WITH GD 2 ]
			$thumb->txt_watermark_color='cccccc';	    // [OPTIONAL] set watermark text color , RGB Hexadecimal[RECOMENDED ONLY WITH GD 2 ]
			$thumb->txt_watermark_font=2;	            // [OPTIONAL] set watermark text font: 1,2,3,4,5
			$thumb->txt_watermark_Valing='BOTTOM';   	// [OPTIONAL] set watermark text vertical position, TOP | CENTER | BOTTOM
			$thumb->txt_watermark_Haling='CENTER';       // [OPTIONAL] set watermark text horizonatal position, LEFT | CENTER | RIGHT
			$thumb->process();

			//$thumb=new Thumbnail($fot);	        // Contructor and set source image file
			//$thumb->img_watermark='watermark.png';	    // [OPTIONAL] set watermark source file, only PNG format [RECOMENDED ONLY WITH GD 2 ]
   			// generate image
			$filename=$thumb->unique_filename ( '.' , $nama , 'thumb');  // generate unique filename
			$status=$thumb->save("gallery/small/".$filename);            // save your thumbnail to file
			$foto = "gallery/".$photo;
			$foto2 = "gallery/small/thumb_".$photo.".".$extension;
			unlink($foto);
			unlink($foto2);
	      	$sql = "UPDATE official_gallery SET judul_official_gallery='$judul',isi_official_gallery='$deskripsi',image_official_gallery='$nama' where id_official_gallery='$no'";
      	}
      
      	$res = $adoObj->Execute($sql);
        
        if($res == false)
		{
        	Util::alertRedirect('Failed!','adminutama.php?&m=ListGallery');
     	}
		else
		{
        	Util::alertRedirect('Done!','adminutama.php?&m=ListGallery');
     	}
   	}			
	else
	$form->display();
}


?>