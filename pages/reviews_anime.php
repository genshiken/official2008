<? 
#=================================================#
#												  #
# Fungsi Menampilkan 5 buah Anime Reviews Terbaru #
#												  #
#=================================================#

function AnimeReviews()
{
  include "conf.php";
  
  /*
  Table Properties :
  id_animereviews				bigint(20)		primary key
  waktu_upload_animereviews		datetime				 	 	 	 	 	 	 
  judul_animereviews			tinytext
  image_animereviews			text				 	 	 	 	 	 	 
  isi_animereviews				longtext				
  */
  
  $table1 = "CREATE TABLE IF NOT EXISTS reviews_anime
  (
    id_animereviews	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_animereviews	DATETIME	NOT NULL,
	judul_animereviews	TINYTEXT	NOT NULL,
	image_animereviews	TEXT	NOT NULL,
	isi_animereviews	LONGTEXT	NOT NULL
  )";
  $buat_table2 = mysql_db_query($dbname,$table1);
  
  ?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_a_nime&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=z">Z</a>
	</div>
	<br />
  <?
  
  $sql = "select count(*) as total from reviews_anime";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 5;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM reviews_anime ORDER BY id_animereviews DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);
  
  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<div class="newstitle">
				<?
				echo "&raquo; ". $recordSet->fields['judul_animereviews'];
				?>
			</div>
			<div class="newsimage">
				<?
				$image_animereviews = $recordSet->fields['image_animereviews'];
				
				if(strlen($image_animereviews) < 1)
				{
				}
				else
				{						
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
				<?				
				echo"". $recordSet->fields['isi_animereviews'];
				echo"<br />";
				?>
			</div>
			<div class="newsdate">
				<?
				echo"Posted : ". $recordSet->fields['waktu_upload_animereviews'];
				echo"<br />";
				?>
			</div>
		</div>
  		<br />	 	
  		<?
		$recordSet->MoveNext();
	}
	?>
	<div class="pageswitch">
	<?
		$page = new Paging1($total,$limit);
		$page->display();
		echo "<p>&nbsp;<br /></p>";
  }		
	?>
  	</div>
  	<?
}

function SearchAnimeReviews()
{
	include "conf.php";
	?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_a_nime&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_a_nime&amp;char=z">Z</a>
	</div>
	<div class="newstitle">
		Search Result :<br />
	</div>
	<div class="newslist">
		<?
			$key = Globals::getVar('char');
			$found=0;
			if($key == "else")
			{
				$key = "[^abcdefghijklmnopqrstuvwxyz]";
				$sql = "select * from reviews_anime WHERE judul_animereviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci ORDER BY judul_animereviews";
			}
			else
			{
				$sql = "select * from reviews_anime WHERE judul_animereviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci ORDER BY judul_animereviews";
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
						<?
						$page_id 	= $recordSet->fields['id_animereviews'];								
						echo "&raquo;&nbsp;<a href='index.php?m=result_detailed_reviews_a_nime&id_animereviews=".$page_id."'>".$recordSet->fields['judul_animereviews'] . "</a>";
						//echo"<br />";
						?>
					</div>							
					<?						
					$recordSet->MoveNext();
				}					
			}
			if(empty($found))
	        {
			}
		?>
	</div>
	<?
}

function ResultDetailedAnimeReviews()
{
  	include "conf.php";
  	$no = Globals::getVar("id_animereviews");
  	$sql = "SELECT * FROM reviews_anime WHERE id_animereviews='$no'";
  	$recordSet = $adoObj->Execute($sql);
  
  	?>
	<div class="newsbox">
		<div class="newstitle">
			<?
				echo "&raquo; ". $recordSet->fields['judul_animereviews'];
			?>
		</div>
		<div class="newsimage">
			<?	
				$image_animereviews = $recordSet->fields['image_animereviews'];
					
				if(strlen($image_animereviews) < 1)
				{
				}
				else
				{						
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
			<?				
				echo"". $recordSet->fields['isi_animereviews'];
				echo"<br />";
			?>
		</div>
		<div class="fake"><br /></div>
		<div class="newsdate">
			<?
				echo"Posted : ". $recordSet->fields['waktu_upload_animereviews'];
				echo"<br />";
			?>
		</div>
	</div>
	<br />	 	
  	<?	
	echo "<a href='javascript:history.go(-1)'>Back</a><br /><br />";
}

?>