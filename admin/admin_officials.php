<? 

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir3 = "photo_officials";
function AddOfficials()
{		
	include "conf.php";
	global $adoObj,$destDir3, $allowedExtension;
	
	$form = new FormGroup("adminutama.php?m=AddOfficials","post");
	$form->setTitle("<div class='title'>Form Editorial Kepengurusan</div>");
	
	$form->addText("generasi_officials","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Generasi Kepengurusan</div>");
	
	$form->addText("tahun_kepengurusan_officials","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Tahun Kepengurusan</div>");
	
	$form->addFile("image_officials","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Foto Pengurus</div>");
	
	$form->addEditor("isi_officials");
    $form->groupAsRow("<div class='leftbox'>Struktur Pengurus</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");
	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("generasi_officials","required");
	$form->addRule("tahun_kepengurusan_officials","required");
	$form->addRule("isi_officials","required");
		
	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('officials','id_officials') + 1;
      	$upl = new UploadFile('image_officials');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir3);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_officials']['type'];
          	$ukuran = $_FILES['image_officials']['size'];
          	$nama_file = $_FILES['image_officials']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();
      
     	//$title = Globals::getVar("generasi_officials");
		$title = $_POST['generasi_officials'];
		//$year_of_duty = Globals::getVar("tahun_kepengurusan_officials");
		$year_of_duty = $_POST['tahun_kepengurusan_officials'];
		//$description = Globals::getVar("isi_officials");
     	$description = $_POST['isi_officials'];
  
     	$sql = "INSERT INTO officials (id_officials,waktu_upload_officials,generasi_officials,tahun_kepengurusan_officials,image_officials,isi_officials) values ($no,now(),'$title','$year_of_duty','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?&m=ListOfficials');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?&m=ListOfficials');
     		}
   		}				
	else
		$form->display();		
}

function ListOfficials()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?
		global $adoObj;
    	include "conf.php"; 
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_officials"=>0));
    	$grid->setQuery("select id_officials,waktu_upload_officials,generasi_officials,tahun_kepengurusan_officials from officials");
    	
		$grid->setColName(array("Posted"=>"","Generasi"=>"","Tahun"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"officials","m"=>"BrowseOfficials"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"officials","m"=>"EditOfficials"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"officials","m"=>"DeleteOfficials"));
    
    	$grid->display();
	?>
	</div>
	<?
}

function BrowseOfficials()
{
	include "conf.php";
    $no = Globals::getVar("id_officials");
    $sql = "select * from officials where id_officials='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<div style="float:left; width:200px;">
						<?
						echo "&raquo; Generasi Kepengurusan";
						?>
					</div>
					<div>
						<?
						echo ": " . $recordSet->fields['generasi_officials'];
						echo"<br />";
						?>
					</div>
					<div style="float:left; width:200px;">
						<?
						echo "&raquo; Tahun Kepengurusan";
						?>
					</div>
					<div>
						<?
						echo ": " . $recordSet->fields['tahun_kepengurusan_officials'];
						echo"<br />";
						?>
					</div>
				</div>
				<div style="clear:both"></div>
				<div class="newsimage">
				<?	
					$image_officials = $recordSet->fields['image_officials'];
					
					if(strlen($image_officials) < 1)
						{
						}
					else{						
						$image_path			= $photo_officials.$image_officials;
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
					echo"". $recordSet->fields['isi_officials'];
					echo"<br />";
				?>
				</div>
				<div style="clear:both"></div>
				<div class="newsdate">
				<?
					echo"Posted : ". $recordSet->fields['waktu_upload_officials'];
					echo"<br />";
				?>
				</div>
			</div>
			<?
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=EditOfficials&id_officials=$no> Edit</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=DeleteOfficials&id_officials=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();				
			}
		}
}


function DeleteOfficials()
{
	global $adoObj, $no;
	
	$no = Globals::getVar('id_officials');
	$sql = "select image_officials from officials where id_officials='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_officials];
	if (strlen($photo) > 0)
		{
		$pics = "photo_officials/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  officials where id_officials='$no'";
        
    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=ListOfficials');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=ListOfficials');
     	}
}


function EditOfficials()
{
	include "conf.php";
		global $adoObj,$destDir3, $allowedExtension, $no;
	
	
	$no = Globals::getVar('id_officials');
	
	$sql = "select * from officials where id_officials='$no'";
	$row = $adoObj->GetRow($sql);
		
	$form = new FormGroup("adminutama.php?m=EditOfficials&id_officials=$no","post");
	
	$form->setTitle("<div class='title'>Form Edit Kepengurusan</div>");
	
	$form->addHidden("id_officials",$no);
	$form->addText("generasi_officials", $row['generasi_officials'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Generasi Kepengurusan</div>");
	
	$form->addHidden("id_officials",$no);
	$form->addText("tahun_kepengurusan_officials", $row['tahun_kepengurusan_officials'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Tahun Kepengurusan</div>");
	
  	$form->addHidden("id_officials",$no);
  	$loc =  "photo_officials";
  	$info .= "<a href=".$loc."/".$row['image_officials'].">";
  	$info .= $row['image_officials'];
 	$info .= "</a>&nbsp;";
	$file_path = "photo_officials/".$row['image_officials'];
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
	$form->addString("<div class='leftbox'>Foto Pengurus</div>","<div class='leftbox'>".$info."</div>");
	$form->addFile("image_officials","",array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>Foto Pengurus<br />(Jika ingin diubah)</div>");
	
	$form->addEditor("isi_officials",$row['isi_officials']);
    $form->groupAsRow("<div class='leftbox'>Struktur Pengurus</div>");
    	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("generasi_officials","required");
	$form->addRule("tahun_kepengurusan_officials","required");
	$form->addRule("isi_officials","required");
		
	if($form->submitted() && $form->validateElement())
		{   
		$no = Globals::getVar("id_officials");
		$sql = "select image_officials from officials where id_officials='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_officials'];
		
    	$upl = new UploadFile('image_officials');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir3);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_officials']['type'];
          	$ukuran = $_FILES['image_officials']['size'];
          	$nama_file = $_FILES['image_officials']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();
            
      	//$title = Globals::getVar("generasi_officials");
		$title = $_POST['generasi_officials'];
		//$year_of_duty = Globals::getVar("tahun_kepengurusan_officials");
		$year_of_duty = $_POST['tahun_kepengurusan_officials'];
		//$description = Globals::getVar("isi_officials");
     	$description = $_POST['isi_officials'];
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE officials SET generasi_officials='$title',tahun_kepengurusan_officials='$year_of_duty',isi_officials='$description' where id_officials='$no'";
      		}
      	else
      		{
			$pics = "photo_officials/".$photo;
			unlink($pics);
      		$sql = "UPDATE officials SET generasi_officials='$title',tahun_kepengurusan_officials='$year_of_duty',image_officials='$nama_file',isi_officials='$description' where id_officials='$no'";
      		}
      
      	$res = $adoObj->Execute($sql);
        
      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=ListOfficials');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=ListOfficials');
     		}
   		}		
	else
		$form->display();
}

?>