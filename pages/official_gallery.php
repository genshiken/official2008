<?php

use App\Globals;
use App\Paging1;

function OfficialGallery()
{
  include "conf.php";

  /*
  Table Properties :
  id_official_gallery				bigint(20)		primary key
  waktu_upload_official_gallery		datetime
  image_official_gallery			text
  judul_official_gallery			tinytext
  isi_official_gallery				longtext
  */

  $table1 = "CREATE TABLE IF NOT EXISTS official_gallery
  (
    id_official_gallery	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_official_gallery	DATETIME	NOT NULL,
	judul_official_gallery	TINYTEXT	NOT NULL,
	image_official_gallery	TEXT	NOT NULL,
	isi_official_gallery	LONGTEXT	NOT NULL
  )";
  $buat_table2 = $adoObj->execute($table1);

  $sql = "select count(*) as total from official_gallery";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 5;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM official_gallery ORDER BY id_official_gallery DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);

  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<br />
			<div style="float:left; padding-right:10px;">
				<?php
					$image_official_gallery = $recordSet->fields['image_official_gallery'];
					$image_id				= $recordSet->fields['id_official_gallery'];
					$extension= strtolower( substr( strrchr($image_official_gallery, ".") ,1) );
					if(strlen($image_official_gallery) < 1)
						{
						}
					else{
						$image_path			= $image_gallery."small/thumb_".$image_official_gallery.".".$extension;
						$image_path_real	= $image_gallery.$image_official_gallery;
						echo "<a href='index.php?m=detailed_gallery&id_official_gallery=".$image_id."' style='text-decoration:none;'>";
						echo "<img width='360' src='$image_path' alt='' />";
						echo "</a>";
						};
				?>
			</div>
			<div style="font-weight:bold; font-family:Verdana; font-size:11pt; padding-bottom:10px;">
				<?php
					echo "&raquo; ". $recordSet->fields['judul_official_gallery'];
				?>
			</div>
			<div style="text-align:justify; line-height:150%;">
			<?php
				echo"". $recordSet->fields['isi_official_gallery'];
			?>
			</div>
			<div class="fake"><br /></div>
			<div class="newsdate">
				<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_official_gallery'];
				?>
			</div>
		</div>
  		<br />
  		<?php
		$recordSet->MoveNext();
	}
	?>
	<div class="pageswitch">
	<?php
		$page = new Paging1($total,$limit);
		$page->display();
		echo "<p>&nbsp;<br /></p>";
  }
	?>
  	</div>
  	<?php
}

function DetailedGallery()
{
  	include "conf.php";
  	$no = Globals::getVar("id_official_gallery");
  	$sql = "SELECT * FROM official_gallery WHERE id_official_gallery='$no'";
  	$recordSet = $adoObj->Execute($sql);

  	?>
	<div class="newsbox">
		<div class="newstitle">
			<?php
				echo "&raquo; ". $recordSet->fields['judul_official_gallery'];
			?>
		</div>
		<div class="newsimage">
			<?php
				$image_official_gallery = $recordSet->fields['image_official_gallery'];

				if(strlen($image_official_gallery) < 1)
				{
				}
				else
				{
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
			<?php
				echo"". $recordSet->fields['isi_official_gallery'];
			?>
		</div>
		<div class="fake"><br /></div>
		<div class="newsdate">
			<?php
				echo"Posted : ". $recordSet->fields['waktu_upload_official_gallery'];
				echo"<br />";
			?>
		</div>
	</div>
	<br />
  	<?php
	echo "<a href='javascript:history.go(-1)'>Back</a><br /><br />";
}

?>
