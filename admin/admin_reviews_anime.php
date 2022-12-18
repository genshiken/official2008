<?php

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir2 = "image";
function TambahAnimeReviews()
{
	include "conf.php";
	global $adoObj,$destDir2, $allowedExtension;

	$form = new FormGroup("adminutama.php?m=TambahA_nimeReviews","post");
	$form->setTitle("<div class='title'>Form Editorial Anime Reviews</div>");

	$form->addText("judul_animereviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Anime Title</div>");

	$form->addFile("image_animereviews","",array("size"=>68));
	$form->groupAsRow("<div class='leftbox'>Anime Picture</div>");

	$form->addEditor("isi_animereviews");
    $form->groupAsRow("<div class='leftbox'>Anime Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_animereviews","required");
	$form->addRule("isi_animereviews","required");

	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('reviews_anime','id_animereviews') + 1;
      	$upl = new UploadFile('image_animereviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_animereviews']['type'];
          	$ukuran = $_FILES['image_animereviews']['size'];
          	$nama_file = $_FILES['image_animereviews']['name'];
      		}
		else
			{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

	  	//$title = Globals::getVar("judul_animereviews");
		$title = $_POST['judul_animereviews'];
     	//$description = Globals::getVar("isi_animereviews");
		$description = $_POST['isi_animereviews'];

     	$sql = "INSERT INTO reviews_anime (id_animereviews,waktu_upload_animereviews,judul_animereviews,image_animereviews,isi_animereviews) values ($no,now(),'$title','$nama_file','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?&m=TampilA_nimeReviews');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?&m=TampilA_nimeReviews');
     		}
   		}
	else
		$form->display();
}

function TampilAnimeReviews()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?php
		global $adoObj;
    	include "conf.php";
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_animereviews"=>0));
    	$grid->setQuery("select id_animereviews,waktu_upload_animereviews,judul_animereviews from reviews_anime");

		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"reviews_anime","m"=>"BrowseA_nimeReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"reviews_anime","m"=>"EditA_nimeReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"reviews_anime","m"=>"DeleteA_nimeReviews"));

    	$grid->display();
	?>
	</div>
	<?php
}

function BrowseAnimeReviews()
{
	include "conf.php";
    $no = Globals::getVar("id_animereviews");
    $sql = "select * from reviews_anime where id_animereviews='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?php
					echo "&raquo; ". $recordSet->fields['judul_animereviews'];
					?>
				</div>
				<div class="newsimage">
					<?php
					$image_animereviews = $recordSet->fields['image_animereviews'];

					if(strlen($image_animereviews) < 1)
						{
						}
					else{
						$image_path			= $image_upload_dir.$image_animereviews;
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
					echo"". $recordSet->fields['isi_animereviews'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_animereviews'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditA_nimeReviews&id_animereviews=$no> Edit</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=DeleteA_nimeReviews&id_animereviews=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}


function DeleteAnimeReviews()
{
	global $adoObj, $no;

	$no = Globals::getVar('id_animereviews');
	$sql = "select image_animereviews from reviews_anime where id_animereviews='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_animereviews];
	if (strlen($photo) > 0)
		{
		$pics = "image/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  reviews_anime where id_animereviews='$no'";

    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=TampilA_nimeReviews');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=TampilA_nimeReviews');
     	}
}


function EditAnimeReviews()
{
	include "conf.php";
		global $adoObj,$destDir2, $allowedExtension, $no;


	$no = Globals::getVar('id_animereviews');

	$sql = "select * from reviews_anime where id_animereviews='$no'";
	$row = $adoObj->GetRow($sql);

	$form = new FormGroup("adminutama.php?m=EditA_nimeReviews&id_animereviews=$no","post");

	$form->setTitle("<div class='title'>Form Edit Anime Reviews</div>");

	$form->addHidden("id_animereviews",$no);
	$form->addText("judul_animereviews", $row['judul_animereviews'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Anime</div>");

  	$form->addHidden("id_animereviews",$no);
  	$loc =  "image";
  	$info .= "<a href=".$loc."/".$row['image_animereviews'].">";
  	$info .= $row['image_animereviews'];
 	$info .= "</a>&nbsp;";
	$file_path = "image/".$row['image_animereviews'];
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
	$form->addString("<div class='leftbox'>Uploaded Anime Picture</div>","<div class='leftbox'>".$info."</div>");
	$form->addFile("image_animereviews",$row['image_animereviews'],array("size"=>68),'');
	$form->groupAsRow("<div class='leftbox'>New Anime Picture</div>");

	$form->addEditor("isi_animereviews",$row['isi_animereviews']);
    $form->groupAsRow("<div class='leftbox'>Anime Description</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_animereviews","required");
	$form->addRule("isi_animereviews","required");

	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_animereviews");
		$sql = "select image_animereviews from reviews_anime where id_animereviews='$no'";
		$row = $adoObj->GetRow($sql);
		$photo = $row['image_animereviews'];

    	$upl = new UploadFile('image_animereviews');
      	$upl->setMaxSize(100000000000);
      	$upl->setDestinationDir($destDir2);
      	$upl->setAllowedExtension($allowedExtension);
      	if($upl->processAll())
			{
          	$tipe = $_FILES['image_animereviews']['type'];
          	$ukuran = $_FILES['image_animereviews']['size'];
          	$nama_file = $_FILES['image_animereviews']['name'];
      		}
		else{
      		echo $upl->getError();
      		}
      	$adoObj->StartTrans();

      	//$title = Globals::getVar("judul_animereviews");
		$title = $_POST['judul_animereviews'];
     	//$description = Globals::getVar("isi_animereviews");
		$description = $_POST['isi_animereviews'];
     	if(strlen($nama_file) < 1)
			{
	    	$sql = "UPDATE reviews_anime SET judul_animereviews='$title',isi_animereviews='$description' where id_animereviews='$no'";
      		}
      	else
      		{
			$pics = "image/".$photo;
			unlink($pics);
      		$sql = "UPDATE reviews_anime SET judul_animereviews='$title',image_animereviews='$nama_file',isi_animereviews='$description' where id_animereviews='$no'";
      		}

      	$res = $adoObj->Execute($sql);

      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=TampilA_nimeReviews');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=TampilA_nimeReviews');
     		}
   		}
	else
		$form->display();
}

?>