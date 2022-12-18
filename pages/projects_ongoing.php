<?php
#=====================================================#
#												  	  #
# Fungsi Menampilkan 5 buah Finished Projects Terbaru #
#												      #
#=====================================================#

function projects()
{
  include "conf.php";

  /*
  Table Properties :
  id_ongoing_projects				bigint(20)		auto_increment	primary key
  waktu_upload_ongoing_projects		datetime
  judul_ongoing_projects			tinytext
  image_ongoing_projects			text
  isi_ongoing_projects				longtext
  */

  $table1 = "CREATE TABLE IF NOT EXISTS projects_ongoing
  (
    id_ongoing_projects	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_ongoing_projects	DATETIME	NOT NULL,
	judul_ongoing_projects	TINYTEXT	NOT NULL,
	image_ongoing_projects	TEXT	NOT NULL,
	isi_ongoing_projects	LONGTEXT	NOT NULL
  )";
  $buat_table2 = $adoObj->execute($table1);

  $sql = "select count(*) as total from projects_ongoing";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 5;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM projects_ongoing ORDER BY id_ongoing_projects DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);

  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<div class="newstitle">
				<?php
					echo "&raquo; ". $recordSet->fields['judul_ongoing_projects'];
					echo"<br />";
				?>
			</div>
			<br />
			<div class="newsimage">
				<?php
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
			<?php
				echo"". $recordSet->fields['isi_ongoing_projects'];
				echo"<br />";
				echo"<br />";
			?>
			</div>
			<div class="newsdate">
				<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_ongoing_projects'];
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
		$page = new Paging1($total,$limit);
		$page->display();
		echo "<p>&nbsp;<br /></p>";
  }
	?>
  	</div>
  	<?php
}

?>
