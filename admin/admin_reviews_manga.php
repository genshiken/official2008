<? 

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir2 = "image";
function TambahMangaReviews()
{		
	include "conf.php";
	global $adoObj,$destDir2, $allowedExtension;
	
	$form = new FormGroup("adminutama.php?m=TambahM_angaReviews","post");
	$form->setTitle("<div class='title'>Form Editorial Manga Reviews</div>");
	
	$form->addText("judul_mangareviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Manga Title</div>");
	
	$form->addFile("image_mangareviews","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Manga Picture</div>");
	
	$form->addEditor("isi_mangareviews");
    $form->groupAsRow("<div class='leftbox'>Manga Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");
	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("judul_mangareviews","required");
	$form->addRule("isi_mangareviews","required");
		
	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('reviews_manga','id_mangareviews') + 1;
      	$upl = new UploadFile('image_mangareviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_mangareviews']['type'];
          	$ukuran = $_FILES['image_mangareviews']['size'];
          	$nama_file = $_FILES['image_mangareviews']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();
      
	  	//$title = Globals::getVar("judul_mangareviews");
		$title = $_POST['judul_mangareviews'];
     	//$description = Globals::getVar("isi_mangareviews");
		$description = $_POST['isi_mangareviews'];     	
  
     	$sql = "INSERT INTO reviews_manga (id_mangareviews,waktu_upload_mangareviews,judul_mangareviews,image_mangareviews,isi_mangareviews) values ($no,now(),'$title','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?m=TampilM_angaReviews');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?m=TampilM_angaReviews');
     		}
   		}				
	else
		$form->display();		
}

function TampilMangaReviews()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?
		global $adoObj;
    	include "conf.php"; 
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_mangareviews"=>0));
    	$grid->setQuery("select id_mangareviews,waktu_upload_mangareviews,judul_mangareviews from reviews_manga");
    	
		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"reviews_manga","m"=>"BrowseM_angaReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"reviews_manga","m"=>"EditM_angaReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"reviews_manga","m"=>"DeleteM_angaReviews"));
    
    	$grid->display();
	?>
	</div>
	<?
}

function BrowseMangaReviews()
{
	include "conf.php";
    $no = Globals::getVar("id_mangareviews");
    $sql = "select * from reviews_manga where id_mangareviews='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?
					echo "&raquo; ". $recordSet->fields['judul_mangareviews'];
					?>
				</div>
				<div class="newsimage">
					<?
					$image_mangareviews = $recordSet->fields['image_mangareviews'];
					
					if(strlen($image_mangareviews) < 1)
						{
						}
					else{						
						$image_path			= $image_upload_dir.$image_mangareviews;
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
					echo"". $recordSet->fields['isi_mangareviews'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?
					echo"Posted : ". $recordSet->fields['waktu_upload_mangareviews'];
					echo"<br />";
					?>
				</div>
			</div>
			<?
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=EditM_angaReviews&id_mangareviews=$no> Edit</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=DeleteM_angaReviews&id_mangareviews=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();				
			}
		}
}


function DeleteMangaReviews()
{
	global $adoObj, $no;
	
	$no = Globals::getVar('id_mangareviews');
	$sql = "select image_mangareviews from reviews_manga where id_mangareviews='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_mangareviews];
	if (strlen($photo) > 0)
		{
		$pics = "image/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  reviews_manga where id_mangareviews='$no'";
        
    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=TampilMangaReviews');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=TampilMangaReviews');
     	}
}


function EditMangaReviews()
{
	include "conf.php";
		global $adoObj,$destDir2, $allowedExtension, $no;
	
	
	$no = Globals::getVar('id_mangareviews');
	
	$sql = "select * from reviews_manga where id_mangareviews='$no'";
	$row = $adoObj->GetRow($sql);
		
	$form = new FormGroup("adminutama.php?m=EditM_angaReviews&id_mangareviews=$no","post");
	
	$form->setTitle("<div class='title'>Form Edit Manga Reviews</div>");
	
	$form->addHidden("id_mangareviews",$no);
	$form->addText("judul_mangareviews", $row['judul_mangareviews'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Manga</div>");
	
  	$form->addHidden("id_mangareviews",$no);
  	$loc =  "image";
  	$info .= "<a href=".$loc."/".$row['image_mangareviews'].">";
  	$info .= $row['image_mangareviews'];
 	$info .= "</a>&nbsp;";
	$file_path = "image/".$row['image_mangareviews'];
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
	$info .= "</div>";
	$form->addString("<div class='leftbox'>Uploaded Manga Picture</div>","<div class='leftbox'>".$info."</div>");
	$form->addFile("image_mangareviews",$row['image_mangareviews'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Manga Picture</div>");
	
	$form->addEditor("isi_mangareviews",$row['isi_mangareviews']);
    $form->groupAsRow("<div class='leftbox'>Manga Description</div>");
    	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("judul_mangareviews","required");
	$form->addRule("isi_mangareviews","required");
		
	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_mangareviews");
		$sql = "select image_mangareviews from reviews_manga where id_mangareviews='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_mangareviews'];
		
    	$upl = new UploadFile('image_mangareviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_mangareviews']['type'];
          	$ukuran = $_FILES['image_mangareviews']['size'];
          	$nama_file = $_FILES['image_mangareviews']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();
            
      	//$title = Globals::getVar("judul_mangareviews");
		$title = $_POST['judul_mangareviews'];
     	//$description = Globals::getVar("isi_mangareviews");
		$description = $_POST['isi_mangareviews'];  
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE reviews_manga SET judul_mangareviews='$title',isi_mangareviews='$description' where id_mangareviews='$no'";
      		}
      	else
      		{
			$pics = "image/".$photo;
			unlink($pics);
      		$sql = "UPDATE reviews_manga SET judul_mangareviews='$title',image_mangareviews='$nama_file',isi_mangareviews='$description' where id_mangareviews='$no'";
      		}
      
      	$res = $adoObj->Execute($sql);
        
      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=TampilMangaReviews');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=TampilMangaReviews');
     		}
   		}		
	else
		$form->display();
}

?>