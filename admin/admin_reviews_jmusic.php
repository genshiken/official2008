<?php

use App\FormGroup;
use App\Globals;
use App\GridAdodb;
use App\Util;

$allowedExtension = array('gif','GIF','jpg','JPG','png','PNG');
$destDir6 = "image_album";
function TambahJMusicReviews()
{
	include "conf.php";
	global $adoObj,$destDir6, $allowedExtension;

	$form = new FormGroup("adminutama.php?m=TambahJ_MusicReviews","post");
	$form->setTitle("<div class='title'>Form Editorial J-Music Reviews</div>");

	$form->addText("judul_jmusicreviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Song Title</div>");

	$form->addText("artist_jmusicreviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Artist</div>");

	$form->addText("album_jmusicreviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Album</div>");

	$form->addText("ost_jmusicreviews","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>OST of</div>");

	$form->addEditor("isi_jmusicreviews");
    $form->groupAsRow("<div class='leftbox'>Lyrics</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_jmusicreviews","required");
	$form->addRule("artist_jmusicreviews","required");
	$form->addRule("isi_jmusicreviews","required");

	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('reviews_jmusic','id_jmusicreviews') + 1;

      	$adoObj->StartTrans();

	  	//$title = Globals::getVar("judul_jmusicreviews");
		$title = $_POST['judul_jmusicreviews'];
		$artist = $_POST['artist_jmusicreviews'];
		$album = $_POST['album_jmusicreviews'];
		$ost = $_POST['ost_jmusicreviews'];
     	//$description = Globals::getVar("isi_jmusicreviews");
		$description = $_POST['isi_jmusicreviews'];

     	$sql = "INSERT INTO reviews_jmusic (id_jmusicreviews,waktu_upload_jmusicreviews,judul_jmusicreviews,artist_jmusicreviews,album_jmusicreviews,ost_jmusicreviews,isi_jmusicreviews) values ($no,now(),'$title','$artist','$album','$ost','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?&m=TampilJ_MusicReviews');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?&m=TampilJ_MusicReviews');
     		}
   		}
	else
		$form->display();
}

function TampilJMusicReviews()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?php
		global $adoObj;
    	include "conf.php";
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_jmusicreviews"=>0));
    	$grid->setQuery("select id_jmusicreviews,artist_jmusicreviews,album_jmusicreviews,judul_jmusicreviews from reviews_jmusic");

		$grid->setColName(array("Artist"=>"","Album"=>"","Song Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"reviews_jmusic","m"=>"BrowseJ_MusicReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"reviews_jmusic","m"=>"EditJ_MusicReviews"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"reviews_jmusic","m"=>"DeleteJ_MusicReviews"));

    	$grid->display();
	?>
	</div>
	<?php
}

function BrowseJMusicReviews()
{
	include "conf.php";
    $no = Globals::getVar("id_jmusicreviews");
    $sql = "select * from reviews_jmusic where id_jmusicreviews='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<div class="info_left1"><?php echo "&raquo; Song Title "; ?></div>
					<div class="info_right1"><?php echo ": ". $recordSet->fields['judul_jmusicreviews']; ?></div>
					<div class="info_left1"><?php echo "&raquo; Artist "; ?></div>
					<div class="info_right1"><?php echo ": ". $recordSet->fields['artist_jmusicreviews']; ?></div>
					<div class="info_left1"><?php echo "&raquo; Album "; ?></div>
					<div class="info_right1"><?php echo ": ". $recordSet->fields['album_jmusicreviews']; ?></div>
					<div class="info_left1"><?php echo "&raquo; OST of "; ?></div>
					<div class="info_right1"><?php echo ": ". $recordSet->fields['ost_jmusicreviews']; ?></div>
					<div class="fake"></div>
				</div>
				<div class="newsdesc">
					<?php
					echo"". $recordSet->fields['isi_jmusicreviews'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_jmusicreviews'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditJ_MusicReviews&id_jmusicreviews=$no> Edit</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=DeleteJ_MusicReviews&id_jmusicreviews=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}


function DeleteJMusicReviews()
{
	global $adoObj, $no;

	$no = Globals::getVar('id_jmusicreviews');
	$sql = "select image_jmusicreviews from reviews_jmusic where id_jmusicreviews='$no'";
	$row = $adoObj->GetRow($sql);
	$photo = $row[image_jmusicreviews];
	if (strlen($photo) > 0)
		{
		$pics = "image_album/".$photo;
		unlink($pics);
		}
    $sql  = "delete from  reviews_jmusic where id_jmusicreviews='$no'";

    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?&m=TampilJ_MusicReviews');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?&m=TampilJ_MusicReviews');
     	}
}


function EditJMusicReviews()
{
	include "conf.php";
		global $adoObj,$destDir6, $allowedExtension, $no;


	$no = Globals::getVar('id_jmusicreviews');

	$sql = "select * from reviews_jmusic where id_jmusicreviews='$no'";
	$row = $adoObj->GetRow($sql);

	$form = new FormGroup("adminutama.php?m=EditJ_MusicReviews&id_jmusicreviews=$no","post");

	$form->setTitle("<div class='title'>Form Edit J-Music Reviews</div>");

	$form->addHidden("id_jmusicreviews",$no);
	$form->addText("judul_jmusicreviews", $row['judul_jmusicreviews'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Song Title</div>");

	$form->addHidden("id_jmusicreviews",$no);
	$form->addText("artist_jmusicreviews",$row['artist_jmusicreviews'],array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Artist</div>");

	$form->addHidden("id_jmusicreviews",$no);
	$form->addText("album_jmusicreviews",$row['album_jmusicreviews'],array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Album</div>");

	$form->addHidden("id_jmusicreviews",$no);
	$form->addText("ost_jmusicreviews",$row['ost_jmusicreviews'],array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>OST of</div>");

  	$form->addEditor("isi_jmusicreviews",$row['isi_jmusicreviews']);
    $form->groupAsRow("<div class='leftbox'>J-Music Lyrics</div>");

	$form->addSubmit("submit","submit");
	$form->groupAsRow();

	$form->addRule("judul_jmusicreviews","required");
	$form->addRule("artist_jmusicreviews","required");
	$form->addRule("isi_jmusicreviews","required");

	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_jmusicreviews");

      	$adoObj->StartTrans();

		//$title = Globals::getVar("judul_jmusicreviews");
		$title = $_POST['judul_jmusicreviews'];
		$artist = $_POST['artist_jmusicreviews'];
		$album = $_POST['album_jmusicreviews'];
		$ost = $_POST['ost_jmusicreviews'];
     	//$description = Globals::getVar("isi_jmusicreviews");
		$description = $_POST['isi_jmusicreviews'];

    	$sql = "UPDATE reviews_jmusic SET judul_jmusicreviews='$title',artist_jmusicreviews='$artist',album_jmusicreviews='$album',ost_jmusicreviews='$ost',isi_jmusicreviews='$description' where id_jmusicreviews='$no'";

      	$res = $adoObj->Execute($sql);

      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?&m=TampilJ_MusicReviews');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?&m=TampilJ_MusicReviews');
     		}
   		}
	else
		$form->display();
}

?>
