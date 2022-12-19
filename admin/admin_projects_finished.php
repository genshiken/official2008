<?php

use App\FormGroup;
use App\Globals;
use App\GridAdodb;
use App\UploadFile;
use App\Util;

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir5 = "image_trailer";
function TambahFinishedProjects()
{
	include "conf.php";
	global $adoObj,$destDir5, $allowedExtension;

	$form = new FormGroup("adminutama.php?m=TambahFinishedProjects","post");
	$form->setTitle("<div class='title'>Form Editorial Finished Project</div>");

	$form->addText("judul_finished_projects","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Project Title</div>");

	$form->addFile("image_finished_projects","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Project Picture</div>");

	$form->addEditor("isi_finished_projects");
    $form->groupAsRow("<div class='leftbox'>Project Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_finished_projects","required");
	$form->addRule("isi_finished_projects","required");

	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('projects_finished','id_finished_projects') + 1;
      	$upl = new UploadFile('image_finished_projects');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir5);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_finished_projects']['type'];
          	$ukuran = $_FILES['image_finished_projects']['size'];
          	$nama_file = $_FILES['image_finished_projects']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

	  	//$title = Globals::getVar("judul_finished_projects");
		$title = $_POST['judul_finished_projects'];
     	//$description = Globals::getVar("isi_finished_projects");
		$description = $_POST['isi_finished_projects'];

     	$sql = "INSERT INTO projects_finished (id_finished_projects,waktu_upload_finished_projects,judul_finished_projects,image_finished_projects,isi_finished_projects) values ($no,now(),'$title','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?&m=TampilFinishedProjects');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?&m=TampilFinishedProjects');
     		}
   		}
	else
		$form->display();
}

function TampilFinishedProjects()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?php
		global $adoObj;
    	include "conf.php";
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_finished_projects"=>0));
    	$grid->setQuery("select id_finished_projects,waktu_upload_finished_projects,judul_finished_projects from projects_finished");

		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"projects_finished","m"=>"BrowseFinishedProjects"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"projects_finished","m"=>"EditFinishedProjects"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"projects_finished","m"=>"DeleteFinishedProjects"));

    	$grid->display();
	?>
	</div>
	<?php
}

function BrowseFinishedProjects()
{
	include "conf.php";
    $no = Globals::getVar("id_finished_projects");
    $sql = "select * from projects_finished where id_finished_projects='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?php
					echo "&raquo; ". $recordSet->fields['judul_finished_projects'];
					?>
				</div>
				<div class="newsimage">
					<?php
					$image_finished_projects = $recordSet->fields['image_finished_projects'];

					if(strlen($image_finished_projects) < 1)
						{
						}
					else{
						$image_path			= $image_projects_dir.$image_finished_projects;
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
					<?php
					echo"". $recordSet->fields['isi_finished_projects'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_finished_projects'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditFinishedProjects&id_finished_projects=$no> Edit</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=DeleteFinishedProjects&id_finished_projects=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}


function DeleteFinishedProjects()
{
	global $adoObj, $no;

	$no = Globals::getVar('id_finished_projects');
	$sql = "select image_finished_projects from projects_finished where id_finished_projects='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_finished_projects];
	if (strlen($photo) > 0)
		{
		$pics = "image_trailer/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  projects_finished where id_finished_projects='$no'";

    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=TampilFinishedProjects');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=TampilFinishedProjects');
     	}
}


function EditFinishedProjects()
{
	include "conf.php";
		global $adoObj,$destDir5, $allowedExtension, $no;


	$no = Globals::getVar('id_finished_projects');

	$sql = "select * from projects_finished where id_finished_projects='$no'";
	$row = $adoObj->GetRow($sql);

	$form = new FormGroup("adminutama.php?m=EditFinishedProjects&id_finished_projects=$no","post");

	$form->setTitle("<div class='title'>Form Edit Finished Project</div>");

	$form->addHidden("id_finished_projects",$no);
	$form->addText("judul_finished_projects", $row['judul_finished_projects'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Project</div>");

  	$form->addHidden("id_finished_projects",$no);
  	$loc =  "image";
  	$info .= "<a href=".$loc."/".$row['image_finished_projects'].">";
  	$info .= $row['image_finished_projects'];
 	$info .= "</a>&nbsp;";
	$file_path = "image_trailer/".$row['image_finished_projects'];
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
	$form->addFile("image_finished_projects",$row['image_finished_projects'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Project Picture</div>");

	$form->addEditor("isi_finished_projects",$row['isi_finished_projects']);
    $form->groupAsRow("<div class='leftbox'>Project Description</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_finished_projects","required");
	$form->addRule("isi_finished_projects","required");

	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_finished_projects");
		$sql = "select image_finished_projects from projects_finished where id_finished_projects='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_finished_projects'];

    	$upl = new UploadFile('image_finished_projects');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir5);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_finished_projects']['type'];
          	$ukuran = $_FILES['image_finished_projects']['size'];
          	$nama_file = $_FILES['image_finished_projects']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

      	//$title = Globals::getVar("judul_finished_projects");
		$title = $_POST['judul_finished_projects'];
     	//$description = Globals::getVar("isi_finished_projects");
		$description = $_POST['isi_finished_projects'];
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE projects_finished SET judul_finished_projects='$title',isi_finished_projects='$description' where id_finished_projects='$no'";
      		}
      	else
      		{
			$pics = "image_trailer/".$photo;
			unlink($pics);
      		$sql = "UPDATE projects_finished SET judul_finished_projects='$title',image_finished_projects='$nama_file',isi_finished_projects='$description' where id_finished_projects='$no'";
      		}

      	$res = $adoObj->Execute($sql);

      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=TampilFinishedProjects');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=TampilFinishedProjects');
     		}
   		}
	else
		$form->display();
}

?>
