<? 
#==================================================#
#												   #
# Fungsi Menampilkan 5 buah Dorama Reviews Terbaru #
#												   #
#================================================= #

function DoramaReviews()
{
  include "conf.php";
  
  /*
  Table Properties :
  id_doramareviews				bigint(20)		primary key
  waktu_upload_doramareviews		datetime				 	 	 	 	 	 	 
  judul_doramareviews			tinytext
  image_doramareviews			text				 	 	 	 	 	 	 
  isi_doramareviews				longtext				
  */
  
  $table1 = "CREATE TABLE IF NOT EXISTS reviews_dorama
  (
    id_doramareviews	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_doramareviews	DATETIME	NOT NULL,
	judul_doramareviews	TINYTEXT	NOT NULL,
	image_doramareviews	TEXT	NOT NULL,
	isi_doramareviews	LONGTEXT	NOT NULL
  )";
  $buat_table2 = mysql_db_query($dbname,$table1);
  
  ?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_d_orama&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=z">Z</a>
	</div>
	<br />
  <?
  
  $sql = "select count(*) as total from reviews_dorama";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 5;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM reviews_dorama ORDER BY id_doramareviews DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);
  
  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<div class="newstitle">
				<?
					echo "&raquo; ". $recordSet->fields['judul_doramareviews'];
				?>
			</div>
			<div class="newsimage">
				<?	
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
			<?				
				echo"". $recordSet->fields['isi_doramareviews'];
				echo"<br />";
				echo"<br />";
			?>
			</div>
			<div class="newsdate">
				<?
					echo"Posted : ". $recordSet->fields['waktu_upload_doramareviews'];
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

function SearchDoramaReviews()
{
	include "conf.php";
	?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_d_orama&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_d_orama&amp;char=z">Z</a>
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
				$sql = "select * from reviews_dorama WHERE judul_doramareviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci ORDER BY judul_doramareviews";
			}
			else
			{
				$sql = "select * from reviews_dorama WHERE judul_doramareviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci ORDER BY judul_doramareviews";
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
						$page_id 	= $recordSet->fields['id_doramareviews'];								
						echo "&raquo;&nbsp;<a href='index.php?m=result_detailed_reviews_d_orama&id_doramareviews=".$page_id."'>".$recordSet->fields['judul_doramareviews'] . "</a>";
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

function ResultDetailedDoramaReviews()
{
  	include "conf.php";
  	$no = Globals::getVar("id_doramareviews");
  	$sql = "SELECT * FROM reviews_dorama WHERE id_doramareviews='$no'";
  	$recordSet = $adoObj->Execute($sql);
  
  	?>
	<div class="newsbox">
		<div class="newstitle">
			<?
				echo "&raquo; ". $recordSet->fields['judul_doramareviews'];
			?>
		</div>
		<div class="newsimage">
			<?	
				$image_doramareviews = $recordSet->fields['image_doramareviews'];
					
				if(strlen($image_doramareviews) < 1)
				{
				}
				else
				{						
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
			<?				
				echo"". $recordSet->fields['isi_doramareviews'];
				echo"<br />";
			?>
		</div>
		<div class="fake"><br /></div>
		<div class="newsdate">
			<?
				echo"Posted : ". $recordSet->fields['waktu_upload_doramareviews'];
				echo"<br />";
			?>
		</div>
	</div>
	<br />	 	
  	<?	
	echo "<a href='javascript:history.go(-1)'>Back</a><br /><br />";
}

?>