<?php

use App\FormGroup;
use App\Globals;
use App\GridAdodb;
use App\UploadFile;
use App\Util;

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir2 = "image";
function TambahDoramaReviews()
{
	include "conf.php";
	global $adoObj,$destDir2, $allowedExtension;

	$form = new FormGroup("adminutama.php?m=TambahD_oramaReviews","post");
	$form->setTitle("<div class='title'>Form Editorial Dorama Reviews</div>");

	$form->addText("judul_doramareviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Dorama Title</div>");

	$form->addFile("image_doramareviews","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Dorama Picture</div>");

	$form->addEditor("isi_doramareviews");
    $form->groupAsRow("<div class='leftbox'>Dorama Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_doramareviews","required");
	$form->addRule("isi_doramareviews","required");

	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('reviews_dorama','id_doramareviews') + 1;
      	$upl = new UploadFile('image_doramareviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_doramareviews']['type'];
          	$ukuran = $_FILES['image_doramareviews']['size'];
          	$nama_file = $_FILES['image_doramareviews']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

	  	//$title = Globals::getVar("judul_doramareviews");
		$title = $_POST['judul_doramareviews'];
     	//$description = Globals::getVar("isi_doramareviews");
		$description = $_POST['isi_doramareviews'];

     	$sql = "INSERT INTO reviews_dorama (id_doramareviews,waktu_upload_doramareviews,judul_doramareviews,image_doramareviews,isi_doramareviews) values ($no,now(),'$title','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?m=TampilDoramaReviews');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?m=TampilDoramaReviews');
     		}
   		}
	else
		$form->display();
}

function TampilDoramaReviews()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?php
		global $adoObj;
    	include "conf.php";
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_doramareviews"=>0));
    	$grid->setQuery("select id_doramareviews,waktu_upload_doramareviews,judul_doramareviews from reviews_dorama");

		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"reviews_dorama","m"=>"BrowseD_oramaReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"reviews_dorama","m"=>"EditD_oramaReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"reviews_dorama","m"=>"DeleteD_oramaReviews"));

    	$grid->display();
	?>
	</div>
	<?php
}

function BrowseDoramaReviews()
{
	include "conf.php";
    $no = Globals::getVar("id_doramareviews");
    $sql = "select * from reviews_dorama where id_doramareviews='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?php
					echo "&raquo; ". $recordSet->fields['judul_doramareviews'];
					?>
				</div>
				<div class="newsimage">
					<?php
					$image_doramareviews = $recordSet->fields['image_doramareviews'];

					if(strlen($image_doramareviews) < 1)
						{
						}
					else{
						$image_path			= $image_upload_dir.$image_doramareviews;
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
					echo"". $recordSet->fields['isi_doramareviews'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_doramareviews'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditD_oramaReviews&id_doramareviews=$no> Edit</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=DeleteD_oramaReviews&id_doramareviews=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}


function DeleteDoramaReviews()
{
	global $adoObj, $no;

	$no = Globals::getVar('id_doramareviews');
	$sql = "select image_doramareviews from reviews_dorama where id_doramareviews='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_doramareviews];
	if (strlen($photo) > 0)
		{
		$pics = "image/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  reviews_dorama where id_doramareviews='$no'";

    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=TampilD_oramaReviews');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=TampilD_oramaReviews');
     	}
}


function EditDoramaReviews()
{
	include "conf.php";
		global $adoObj,$destDir2, $allowedExtension, $no;


	$no = Globals::getVar('id_doramareviews');

	$sql = "select * from reviews_dorama where id_doramareviews='$no'";
	$row = $adoObj->GetRow($sql);

	$form = new FormGroup("adminutama.php?m=EditD_oramaReviews&id_doramareviews=$no","post");

	$form->setTitle("<div class='title'>Form Edit Dorama Reviews</div>");

	$form->addHidden("id_doramareviews",$no);
	$form->addText("judul_doramareviews", $row['judul_doramareviews'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Dorama</div>");

  	$form->addHidden("id_doramareviews",$no);
  	$loc =  "image";
  	$info .= "<a href=".$loc."/".$row['image_doramareviews'].">";
  	$info .= $row['image_doramareviews'];
 	$info .= "</a>&nbsp;";
	$file_path = "image/".$row['image_doramareviews'];
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
	$form->addString("<div class='leftbox'>Uploaded Dorama Picture</div>","<div class='leftbox'>".$info."</div>");
	$form->addFile("image_doramareviews",$row['image_doramareviews'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Dorama Picture</div>");

	$form->addEditor("isi_doramareviews",$row['isi_doramareviews']);
    $form->groupAsRow("<div class='leftbox'>Dorama Description</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_doramareviews","required");
	$form->addRule("isi_doramareviews","required");

	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_doramareviews");
		$sql = "select image_doramareviews from reviews_dorama where id_doramareviews='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_doramareviews'];

    	$upl = new UploadFile('image_doramareviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_doramareviews']['type'];
          	$ukuran = $_FILES['image_doramareviews']['size'];
          	$nama_file = $_FILES['image_doramareviews']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

      	//$title = Globals::getVar("judul_doramareviews");
		$title = $_POST['judul_doramareviews'];
     	//$description = Globals::getVar("isi_doramareviews");
		$description = $_POST['isi_doramareviews'];
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE reviews_dorama SET judul_doramareviews='$title',isi_doramareviews='$description' where id_doramareviews='$no'";
      		}
      	else
      		{
			$pics = "image/".$photo;
			unlink($pics);
      		$sql = "UPDATE reviews_dorama SET judul_doramareviews='$title',image_doramareviews='$nama_file',isi_doramareviews='$description' where id_doramareviews='$no'";
      		}

      	$res = $adoObj->Execute($sql);

      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=TampilD_oramaReviews');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=TampilD_oramaReviews');
     		}
   		}
	else
		$form->display();
}

?>
