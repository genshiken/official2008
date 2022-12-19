<?php

use App\FormGroup;
use App\Globals;
use App\GridAdodb;
use App\UploadFile;
use App\Util;

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir2 = "image";
function AddOfficialNews()
{
	include "conf.php";
	global $adoObj,$destDir2, $allowedExtension;

	$form = new FormGroup("adminutama.php?m=AddOfficialNews","post");
	$form->setTitle("<div class='title'>Form Editorial Official News</div>");

	$form->addText("judul_official_news","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Official News Title</div>");

	$form->addFile("image_official_news","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Picture</div>");

	$form->addEditor("isi_official_news");
    $form->groupAsRow("<div class='leftbox'>Official News Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_official_news","required");
	$form->addRule("isi_official_news","required");

	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('official_news','id_official_news') + 1;
      	$upl = new UploadFile('image_official_news');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_official_news']['type'];
          	$ukuran = $_FILES['image_official_news']['size'];
          	$nama_file = $_FILES['image_official_news']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

     	//$title = Globals::getVar("judul_official_news");
		$title = $_POST['judul_official_news'];
		//$description = Globals::getVar("isi_official_news");
     	$description = $_POST['isi_official_news'];

     	$sql = "INSERT INTO official_news (id_official_news,waktu_upload_official_news,judul_official_news,image_official_news,isi_official_news) values ('$no',now(),'$title','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?m=ListOfficialNews');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?m=ListOfficialNews');
     		}
   		}
	else
		$form->display();
}

function ListOfficialNews()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?php
		global $adoObj;
    	include "conf.php";
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_official_news"=>0));
    	$grid->setQuery("select id_official_news,waktu_upload_official_news,judul_official_news from official_news");

		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"official_news","m"=>"BrowseOfficialNews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"official_news","m"=>"EditOfficialNews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"official_news","m"=>"DeleteOfficialNews"));

    	$grid->display();
	?>
	</div>
	<?php
}

function BrowseOfficialNews()
{
	include "conf.php";
    $no = Globals::getVar("id_official_news");
    $sql = "select * from official_news where id_official_news='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?php
					echo "&raquo; ". $recordSet->fields['judul_official_news'];
					?>
				</div>
				<div class="newsimage">
					<?php
					$image_official_news = $recordSet->fields['image_official_news'];

					if(strlen($image_official_news) < 1)
						{
						}
					else{
						$image_path			= $image_upload_dir.$image_official_news;
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
					echo"". $recordSet->fields['isi_official_news'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_official_news'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditOfficialNews&id_official_news=$no> Edit</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=DeleteOfficialNews&id_official_news=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}


function DeleteOfficialNews()
{
	global $adoObj, $no;

	$no = Globals::getVar('id_official_news');
	$sql = "select image_official_news from official_news where id_official_news='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_official_news];
	if (strlen($photo) > 0)
		{
		$pics = "image/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  official_news where id_official_news='$no'";

    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?m=ListOfficialNews');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?m=ListOfficialNews');
     	}
}


function EditOfficialNews()
{
	include "conf.php";
		global $adoObj,$destDir2, $allowedExtension, $no;


	$id = $_REQUEST['id_official_news'] ?? '0';

	$sql = "select * from official_news where id_official_news=?";
	$row = $adoObj->GetRow($sql, [$id]);

	$form = new FormGroup('adminutama.php?m=EditOfficialNews&id_official_news='.e($id),"post");

	$form->setTitle("<div class='title'>Form Edit Official News</div>");

	$form->addHidden("id_official_news",e($id));
	$form->addText("judul_official_news", $row['judul_official_news'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Official News</div>");

  	$form->addHidden("id_official_news",e($id));
  	$loc =  "image";
  	$info .= "<a href=".$loc."/".$row['image_official_news'].">";
  	$info .= $row['image_official_news'];
 	$info .= "</a>&nbsp;";
	$file_path = "image/".$row['image_official_news'];
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
	$form->addString("<div class='leftbox'>Uploaded Picture</div>","<div class='leftbox'>".$info."</div>");
	$form->addFile("image_official_news",$row['image_official_news'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Picture</div>");

	$form->addEditor("isi_official_news",$row['isi_official_news']);
    $form->groupAsRow("<div class='leftbox'>Official News Description</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_official_news","required");
	$form->addRule("isi_official_news","required");

	if($form->submitted() && $form->validateElement())
		{
		$sql = "select image_official_news from official_news where id_official_news=?";
		$row = $adoObj->GetRow($sql, [$id]);
		$photo = $row['image_official_news'];

    	$upl = new UploadFile('image_official_news');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_official_news']['type'];
          	$ukuran = $_FILES['image_official_news']['size'];
          	$nama_file = $_FILES['image_official_news']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

		//$title = Globals::getVar("judul_official_news");
      	$title = $_POST['judul_official_news'];
		//$description = Globals::getVar("isi_official_news");
     	$description = $_POST['isi_official_news'];
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE official_news SET judul_official_news=?,isi_official_news=? where id_official_news=?";
	    	$bindValues = [$title, $description, $id];
      		}
      	else
      		{
			$pics = "image/".$photo;
			unlink($pics);
      		$sql = "UPDATE official_news SET judul_official_news=?,image_official_news=?,isi_official_news=? where id_official_news=?";
	    	$bindValues = [$title, $nama_file, $description, $id];
      		}

      	$res = $adoObj->Execute($sql, $bindValues);

      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?m=ListOfficialNews');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?m=ListOfficialNews');
     		}
   		}
	else
		$form->display();
}

?>
