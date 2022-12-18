<?php
#=================================================#
#												  #
# Fungsi Menampilkan 5 buah Manga Reviews Terbaru #
#												  #
#=================================================#

function MangaReviews()
{
  include "conf.php";

  /*
  Table Properties :
  id_mangareviews				bigint(20)		primary key
  waktu_upload_mangareviews		datetime
  judul_mangareviews			tinytext
  image_mangareviews			text
  isi_mangareviews				longtext
  */

  $table1 = "CREATE TABLE IF NOT EXISTS reviews_manga
  (
    id_mangareviews	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_mangareviews	DATETIME	NOT NULL,
	judul_mangareviews	TINYTEXT	NOT NULL,
	image_mangareviews	TEXT	NOT NULL,
	isi_mangareviews	LONGTEXT	NOT NULL
  )";
  $buat_table2 = $adoObj->execute($table1);

  ?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_m_anga&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=z">Z</a>
	</div>
	<br />
  <?php

  $sql = "select count(*) as total from reviews_manga";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 5;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM reviews_manga ORDER BY id_mangareviews DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);

  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<div class="newstitle">
				<?php
					echo "&raquo; ". $recordSet->fields['judul_mangareviews'];
				?>
			</div>
			<div class="newsimage">
				<?php
					$image_mangareviews = $recordSet->fields['image_mangareviews'];

					if(strlen($image_mangareviews) < 1)
						{
						}
					else{
						$image_path			= $image_upload_dir.$image_mangareviews;
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
				echo"". $recordSet->fields['isi_mangareviews'];
				echo"<br />";
				echo"<br />";
			?>
			</div>
			<div class="newsdate">
				<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_mangareviews'];
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

function SearchMangaReviews()
{
	include "conf.php";
	?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_m_anga&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_m_anga&amp;char=z">Z</a>
	</div>
	<div class="newstitle">
		Search Result :<br />
	</div>
	<div class="newslist">
		<?php
			$key = Globals::getVar('char');
			$found=0;
			if($key == "else")
			{
				$key = "[^abcdefghijklmnopqrstuvwxyz]";
				$sql = "select * from reviews_manga WHERE judul_mangareviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci";
			}
			else
			{
				$sql = "select * from reviews_manga WHERE judul_mangareviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci";
	        }
			$recordSet = $adoObj->Execute($sql);

			/** iterasi*/
	        if($recordSet !=null)
			{
				while(!$recordSet->EOF)
				{
					$found++;
					?>
					<div class="newslist">
						<?php
						$page_id 	= $recordSet->fields['id_mangareviews'];
						echo "&raquo;&nbsp;<a href='index.php?m=result_detailed_reviews_m_anga&id_mangareviews=".$page_id."'>".$recordSet->fields['judul_mangareviews'] . "</a>";
						//echo"<br />";
						?>
					</div>
					<?php
					$recordSet->MoveNext();
				}
			}
			if(empty($found))
	        {
			}
		?>
	</div>
	<?php
}

function ResultDetailedMangaReviews()
{
  	include "conf.php";
  	$no = Globals::getVar("id_mangareviews");
  	$sql = "SELECT * FROM reviews_manga WHERE id_mangareviews='$no'";
  	$recordSet = $adoObj->Execute($sql);

  	?>
	<div class="newsbox">
		<div class="newstitle">
			<?php
				echo "&raquo; ". $recordSet->fields['judul_mangareviews'];
			?>
		</div>
		<div class="newsimage">
			<?php
				$image_mangareviews = $recordSet->fields['image_mangareviews'];

				if(strlen($image_mangareviews) < 1)
				{
				}
				else
				{
					$image_path			= $image_upload_dir.$image_mangareviews;
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
				echo"". $recordSet->fields['isi_mangareviews'];
				echo"<br />";
			?>
		</div>
		<div class="fake"><br /></div>
		<div class="newsdate">
			<?php
				echo"Posted : ". $recordSet->fields['waktu_upload_mangareviews'];
				echo"<br />";
			?>
		</div>
	</div>
	<br />
  	<?php
	echo "<a href='javascript:history.go(-1)'>Back</a><br /><br />";
}

?>
