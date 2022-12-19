<?php

use App\Globals;
use App\Paging;

#===========================================#
#											#
# Fungsi Menampilkan Kepengurusan Terbaru	#
#											#
#===========================================#

function officials()
{
  include "conf.php";
  $screen_res = $_COOKIE[$screen_res];
  $screen_res = floor($screen_res);

  /*
  Table Properties :
  id_officials				bigint(20)		primary key
  waktu_upload_officials		datetime	NOT NULL
  generasi_officials			BIGINT(20)	NOT NULL
  tahun_kepengurusan_officials	TINYTEXT	NOT NULL,
  image_officials			text	NOT NULL
  isi_officials				longtext	NOT NULL
  */

  $table1 = "CREATE TABLE IF NOT EXISTS officials
  (
    id_officials	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_officials	DATETIME	NOT NULL,
	generasi_officials	BIGINT	NOT NULL,
	tahun_kepengurusan_officials	TINYTEXT	NOT NULL,
	image_officials	TEXT	NOT NULL,
	isi_officials	LONGTEXT	NOT NULL
  )";
  $buat_table2 = $adoObj->execute($table1);

  $sql = "select count(*) as total from officials";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 1;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM officials ORDER BY id_officials DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);

  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<div class="newstitle">
				<div style="float:left; width:200px;">
					<?php
					echo "&raquo; Generasi Kepengurusan";
					?>
				</div>
				<div>
					<?php
					echo ": " . $recordSet->fields['generasi_officials'];
					echo"<br />";
					?>
				</div>
				<div style="float:left; width:200px;">
					<?php
					echo "&raquo; Tahun Kepengurusan";
					?>
				</div>
				<div>
					<?php
					echo ": " . $recordSet->fields['tahun_kepengurusan_officials'];
					echo"<br />";
					?>
				</div>
			</div>
			<br />
			<div class="newsimage">
				<?php
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
			<?php
				echo"". $recordSet->fields['isi_officials'];
				echo"<br />";
				echo"<br />";
			?>
			</div>
			<div class="fake"></div>
			<div class="newsdate">
				<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_officials'];
					echo"<br />";
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

?>
