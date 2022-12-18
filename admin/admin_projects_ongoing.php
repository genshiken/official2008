<? 

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir5 = "image_trailer";
function TambahOngoingProjects()
{		
	include "conf.php";
	global $adoObj,$destDir5, $allowedExtension;
	
	$form = new FormGroup("adminutama.php?m=TambahOngoingProjects","post");
	$form->setTitle("<div class='title'>Form Editorial Ongoing Project</div>");
	
	$form->addText("judul_ongoing_projects","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Project Title</div>");
	
	$form->addFile("image_ongoing_projects","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Project Picture</div>");
	
	$form->addEditor("isi_ongoing_projects");
    $form->groupAsRow("<div class='leftbox'>Project Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");
	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("judul_ongoing_projects","required");
	$form->addRule("isi_ongoing_projects","required");
		
	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('projects_ongoing','id_ongoing_projects') + 1;
      	$upl = new UploadFile('image_ongoing_projects');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir5);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_ongoing_projects']['type'];
          	$ukuran = $_FILES['image_ongoing_projects']['size'];
          	$nama_file = $_FILES['image_ongoing_projects']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();
      
	  	//$title = Globals::getVar("judul_ongoing_projects");
		$title = $_POST['judul_ongoing_projects'];
     	//$description = Globals::getVar("isi_ongoing_projects");
		$description = $_POST['isi_ongoing_projects'];     	
  
     	$sql = "INSERT INTO projects_ongoing (id_ongoing_projects,waktu_upload_ongoing_projects,judul_ongoing_projects,image_ongoing_projects,isi_ongoing_projects) values ($no,now(),'$title','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?&m=TampilOngoingProjects');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?&m=TampilOngoingProjects');
     		}
   		}				
	else
		$form->display();		
}

function TampilOngoingProjects()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?
		global $adoObj;
    	include "conf.php"; 
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_ongoing_projects"=>0));
    	$grid->setQuery("select id_ongoing_projects,waktu_upload_ongoing_projects,judul_ongoing_projects from projects_ongoing");
    	
		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"projects_ongoing","m"=>"BrowseOngoingProjects"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"projects_ongoing","m"=>"EditOngoingProjects"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"projects_ongoing","m"=>"DeleteOngoingProjects"));
    
    	$grid->display();
	?>
	</div>
	<?
}

function BrowseOngoingProjects()
{
	include "conf.php";
    $no = Globals::getVar("id_ongoing_projects");
    $sql = "select * from projects_ongoing where id_ongoing_projects='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?
					echo "&raquo; ". $recordSet->fields['judul_ongoing_projects'];
					?>
				</div>
				<div class="newsimage">
					<?
					$image_ongoing_projects = $recordSet->fields['image_ongoing_projects'];
					
					if(strlen($image_ongoing_projects) < 1)
						{
						}
					else{						
						$image_path			= $image_projects_dir.$image_ongoing_projects;
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
					echo"". $recordSet->fields['isi_ongoing_projects'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?
					echo"Posted : ". $recordSet->fields['waktu_upload_ongoing_projects'];
					echo"<br />";
					?>
				</div>
			</div>
			<?
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=EditOngoingProjects&id_ongoing_projects=$no> Edit</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=DeleteOngoingProjects&id_ongoing_projects=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();				
			}
		}
}


function DeleteOngoingProjects()
{
	global $adoObj, $no;
	
	$no = Globals::getVar('id_ongoing_projects');
	$sql = "select image_ongoing_projects from projects_ongoing where id_ongoing_projects='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_ongoing_projects];
	if (strlen($photo) > 0)
		{
		$pics = "image_trailer/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  projects_ongoing where id_ongoing_projects='$no'";
        
    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=TampilOngoingProjects');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=TampilOngoingProjects');
     	}
}


function EditOngoingProjects()
{
	include "conf.php";
		global $adoObj,$destDir5, $allowedExtension, $no;
	
	
	$no = Globals::getVar('id_ongoing_projects');
	
	$sql = "select * from projects_ongoing where id_ongoing_projects='$no'";
	$row = $adoObj->GetRow($sql);
		
	$form = new FormGroup("adminutama.php?m=EditOngoingProjects&id_ongoing_projects=$no","post");
	
	$form->setTitle("<div class='title'>Form Edit Ongoing Project</div>");
	
	$form->addHidden("id_ongoing_projects",$no);
	$form->addText("judul_ongoing_projects", $row['judul_ongoing_projects'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Project</div>");
	
  	$form->addHidden("id_ongoing_projects",$no);
  	$loc =  "image";
  	$info .= "<a href=".$loc."/".$row['image_ongoing_projects'].">";
  	$info .= $row['image_ongoing_projects'];
 	$info .= "</a>&nbsp;";
	$file_path = "image_trailer/".$row['image_ongoing_projects'];
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
	$form->addString("<div class='leftbox'>Uploaded Project Picture</div>","<div class='leftbox'>".$info."</div>");
	$form->addFile("image_ongoing_projects",$row['image_ongoing_projects'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Project Picture</div>");
	
	$form->addEditor("isi_ongoing_projects",$row['isi_ongoing_projects']);
    $form->groupAsRow("<div class='leftbox'>Project Description</div>");
    	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("judul_ongoing_projects","required");
	$form->addRule("isi_ongoing_projects","required");
		
	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_ongoing_projects");
		$sql = "select image_ongoing_projects from projects_ongoing where id_ongoing_projects='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_ongoing_projects'];
		
    	$upl = new UploadFile('image_ongoing_projects');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir5);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_ongoing_projects']['type'];
          	$ukuran = $_FILES['image_ongoing_projects']['size'];
          	$nama_file = $_FILES['image_ongoing_projects']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();
            
      	//$title = Globals::getVar("judul_ongoing_projects");
		$title = $_POST['judul_ongoing_projects'];
     	//$description = Globals::getVar("isi_ongoing_projects");
		$description = $_POST['isi_ongoing_projects'];  
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE projects_ongoing SET judul_ongoing_projects='$title',isi_ongoing_projects='$description' where id_ongoing_projects='$no'";
      		}
      	else
      		{
			$pics = "image_trailer/".$photo;
			unlink($pics);
      		$sql = "UPDATE projects_ongoing SET judul_ongoing_projects='$title',image_ongoing_projects='$nama_file',isi_ongoing_projects='$description' where id_ongoing_projects='$no'";
      		}
      
      	$res = $adoObj->Execute($sql);
        
      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=TampilOngoingProjects');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=TampilOngoingProjects');
     		}
   		}		
	else
		$form->display();
}

?>