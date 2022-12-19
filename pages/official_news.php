<?php

use App\Globals;
use App\Paging;

function OfficialNews()
{
  include "conf.php";

  /*
  Table Properties :
  id_official_news				bigint(20)		primary key
  waktu_upload_official_news		datetime
  image_official_news	TEXT	NOT NULL
  judul_official_news			tinytext
  isi_official_news				longtext
  */

  $table1 = "CREATE TABLE IF NOT EXISTS official_news
  (
    id_official_news	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_official_news	DATETIME	NOT NULL,
	image_official_news	TEXT	CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	judul_official_news	TINYTEXT	CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	isi_official_news	LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci	NOT NULL
  )";
  $buat_table2 = $adoObj->execute($table1);

  $sql = "select count(*) as total from official_news";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 3;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM official_news ORDER BY id_official_news DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);

  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<br />
			<div style="float:left; padding-right:10px;">
				<?php
					$image_official_news = $recordSet->fields['image_official_news'];
					$image_id				= $recordSet->fields['id_official_news'];
					$extension= strtolower( substr( strrchr($image_official_news, ".") ,1) );
					if(strlen($image_official_news) < 1)
						{
						}
					else{
						/*$image_path			= $image_upload_dir."small/thumb_".$image_official_news.".".$extension;*/
						$image_path_real	= $image_upload_dir.$image_official_news;
						echo "<a href='index.php?m=detailed_news&id_official_news=".$image_id."' style='text-decoration:none;'>";
						echo "<img width='360' src='$image_path_real' alt='' />";
						echo "</a>";
						};
				?>
			</div>
			<div style="font-weight:bold; font-family:Verdana; font-size:11pt; padding-bottom:10px;">
				<?php
					echo "&raquo; ". $recordSet->fields['judul_official_news'];
				?>
			</div>
			<div style="text-align:justify; line-height:150%;">
			<?php
				echo"". $recordSet->fields['isi_official_news'];
			?>
			</div>
			<div class="fake"><br /></div>
			<div class="newsdate">
				<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_official_news'];
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
		$page = new Paging($total,$limit);
		$page->display();
		echo "<p>&nbsp;<br /></p>";
  }
	?>
  	</div>
  	<?php
}

function DetailedNews()
{
	include "conf.php";
 	$no = Globals::getVar("id_official_news");
 	$sql = "SELECT * FROM official_news WHERE id_official_news='$no'";
  	$recordSet = $adoObj->Execute($sql);

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
				else
				{
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
  	<br />
  	<?php
	echo "<a href='javascript:history.go(-1)'>Back</a><br /><br />";
}

?>
