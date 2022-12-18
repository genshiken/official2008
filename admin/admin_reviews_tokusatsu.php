<?php

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir2 = "image";
function TambahTokusatsuReviews()
{
	include "conf.php";
	global $adoObj,$destDir2, $allowedExtension;

	$form = new FormGroup("adminutama.php?m=TambahT_okusatsuReviews","post");
	$form->setTitle("<div class='title'>Form Editorial Tokusatsu Reviews</div>");

	$form->addText("judul_tokusatsureviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Tokusatsu Title</div>");

	$form->addFile("image_tokusatsureviews","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Tokusatsu Picture</div>");

	$form->addEditor("isi_tokusatsureviews");
    $form->groupAsRow("<div class='leftbox'>Tokusatsu Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_tokusatsureviews","required");
	$form->addRule("isi_tokusatsureviews","required");

	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('reviews_tokusatsu','id_tokusatsureviews') + 1;
      	$upl = new UploadFile('image_tokusatsureviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_tokusatsureviews']['type'];
          	$ukuran = $_FILES['image_tokusatsureviews']['size'];
          	$nama_file = $_FILES['image_tokusatsureviews']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

	  	//$title = Globals::getVar("judul_tokusatsureviews");
		$title = $_POST['judul_tokusatsureviews'];
     	//$description = Globals::getVar("isi_tokusatsureviews");
		$description = $_POST['isi_tokusatsureviews'];

     	$sql = "INSERT INTO reviews_tokusatsu (id_tokusatsureviews,waktu_upload_tokusatsureviews,judul_tokusatsureviews,image_tokusatsureviews,isi_tokusatsureviews) values ($no,now(),'$title','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?m=TampilT_okusatsuReviews');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?m=TampilT_okusatsuReviews');
     		}
   		}
	else
		$form->display();
}

function TampilTokusatsuReviews()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?php
		global $adoObj;
    	include "conf.php";
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_tokusatsureviews"=>0));
    	$grid->setQuery("select id_tokusatsureviews,waktu_upload_tokusatsureviews,judul_tokusatsureviews from reviews_tokusatsu");

		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"reviews_tokusatsu","m"=>"BrowseT_okusatsuReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"reviews_tokusatsu","m"=>"EditT_okusatsuReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"reviews_tokusatsu","m"=>"DeleteT_okusatsuReviews"));

    	$grid->display();
	?>
	</div>
	<?php
}

function BrowseTokusatsuReviews()
{
	include "conf.php";
    $no = Globals::getVar("id_tokusatsureviews");
    $sql = "select * from reviews_tokusatsu where id_tokusatsureviews='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?php
					echo "&raquo; ". $recordSet->fields['judul_tokusatsureviews'];
					?>
				</div>
				<div class="newsimage">
					<?php
					$image_tokusatsureviews = $recordSet->fields['image_tokusatsureviews'];

					if(strlen($image_tokusatsureviews) < 1)
						{
						}
					else{
						$image_path			= $image_upload_dir.$image_tokusatsureviews;
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
					echo"". $recordSet->fields['isi_tokusatsureviews'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_tokusatsureviews'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditT_okusatsuReviews&id_tokusatsureviews=$no> Edit</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=DeleteT_okusatsuReviews&id_tokusatsureviews=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}


function DeleteTokusatsuReviews()
{
	global $adoObj, $no;

	$no = Globals::getVar('id_tokusatsureviews');
	$sql = "select image_tokusatsureviews from reviews_tokusatsu where id_tokusatsureviews='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_tokusatsureviews];
	if (strlen($photo) > 0)
		{
		$pics = "image/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  reviews_tokusatsu where id_tokusatsureviews='$no'";

    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=TampilTokusatsuReviews');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=TampilTokusatsuReviews');
     	}
}


function EditTokusatsuReviews()
{
	include "conf.php";
		global $adoObj,$destDir2, $allowedExtension, $no;


	$no = Globals::getVar('id_tokusatsureviews');

	$sql = "select * from reviews_tokusatsu where id_tokusatsureviews='$no'";
	$row = $adoObj->GetRow($sql);

	$form = new FormGroup("adminutama.php?m=EditT_okusatsuReviews&id_tokusatsureviews=$no","post");

	$form->setTitle("<div class='title'>Form Edit Tokusatsu Reviews</div>");

	$form->addHidden("id_tokusatsureviews",$no);
	$form->addText("judul_tokusatsureviews", $row['judul_tokusatsureviews'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Tokusatsu</div>");

  	$form->addHidden("id_tokusatsureviews",$no);
  	$loc =  "image";
  	$info .= "<a href=".$loc."/".$row['image_tokusatsureviews'].">";
  	$info .= $row['image_tokusatsureviews'];
 	$info .= "</a>&nbsp;";
	$file_path = "image/".$row['image_tokusatsureviews'];
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
	$form->addString("<div class='leftbox'>Uploaded Tokusatsu Picture</div>","<div class='leftbox'>".$info."</div>");
	$form->addFile("image_tokusatsureviews",$row['image_tokusatsureviews'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Tokusatsu Picture</div>");

	$form->addEditor("isi_tokusatsureviews",$row['isi_tokusatsureviews']);
    $form->groupAsRow("<div class='leftbox'>Tokusatsu Description</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_tokusatsureviews","required");
	$form->addRule("isi_tokusatsureviews","required");

	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_tokusatsureviews");
		$sql = "select image_tokusatsureviews from reviews_tokusatsu where id_tokusatsureviews='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_tokusatsureviews'];

    	$upl = new UploadFile('image_tokusatsureviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_tokusatsureviews']['type'];
          	$ukuran = $_FILES['image_tokusatsureviews']['size'];
          	$nama_file = $_FILES['image_tokusatsureviews']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

      	//$title = Globals::getVar("judul_tokusatsureviews");
		$title = $_POST['judul_tokusatsureviews'];
     	//$description = Globals::getVar("isi_tokusatsureviews");
		$description = $_POST['isi_tokusatsureviews'];
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE reviews_tokusatsu SET judul_tokusatsureviews='$title',isi_tokusatsureviews='$description' where id_tokusatsureviews='$no'";
      		}
      	else
      		{
			$pics = "image/".$photo;
			unlink($pics);
      		$sql = "UPDATE reviews_tokusatsu SET judul_tokusatsureviews='$title',image_tokusatsureviews='$nama_file',isi_tokusatsureviews='$description' where id_tokusatsureviews='$no'";
      		}

      	$res = $adoObj->Execute($sql);

      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=TampilTokusatsuReviews');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=TampilTokusatsuReviews');
     		}
   		}
	else
		$form->display();
}

?>