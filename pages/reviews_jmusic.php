<?php

use App\Globals;
use App\Paging1;

function JMusicReviews()
{
  include "conf.php";

  $table1 = "CREATE TABLE IF NOT EXISTS reviews_jmusic
  (
    id_jmusicreviews	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_jmusicreviews	DATETIME	NOT NULL,
	judul_jmusicreviews	TINYTEXT	NOT NULL,
	artist_jmusicreviews	TINYTEXT	NOT NULL,
	album_jmusicreviews	TINYTEXT	NOT NULL,
	ost_jmusicreviews	TINYTEXT	NOT NULL,
	isi_jmusicreviews	LONGTEXT	NOT NULL
  )";
  $buat_table2 = $adoObj->execute($table1);

  ?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_j_music&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=z">Z</a>
	</div>
	<br />
  <?php

  $sql = "select count(*) as total from reviews_jmusic";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 3;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM reviews_jmusic ORDER BY id_jmusicreviews DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);

  if($recordSet !=null){

	while(!$recordSet->EOF){
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

function SearchJMusicReviews()
{
	include "conf.php";
	?>
	<div class="listsort">
		<a href="index.php?m=search_reviews_j_music&amp;char=else">#</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=a">A</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=b">B</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=c">C</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=d">D</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=e">E</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=f">F</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=g">G</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=h">H</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=i">I</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=j">J</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=k">K</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=l">L</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=m">M</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=n">N</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=o">O</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=p">P</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=q">Q</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=r">R</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=s">S</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=t">T</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=u">U</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=v">V</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=w">W</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=x">X</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=y">Y</a> |
		<a href="index.php?m=search_reviews_j_music&amp;char=z">Z</a>
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
				$sql = "select * from reviews_jmusic WHERE artist_jmusicreviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci ORDER BY artist_jmusicreviews,album_jmusicreviews,judul_jmusicreviews";
			}
			else
			{
				$sql = "select * from reviews_jmusic WHERE artist_jmusicreviews REGEXP CONVERT( _utf8 '^$key' USING latin1 ) COLLATE latin1_general_ci ORDER BY artist_jmusicreviews,album_jmusicreviews,judul_jmusicreviews";
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
						$page_id 	= $recordSet->fields['id_jmusicreviews'];
						echo "&raquo;&nbsp;<a href='index.php?m=result_detailed_reviews_j_music&id_jmusicreviews=".$page_id."'>".$recordSet->fields['artist_jmusicreviews'] . " | <font color='blue'>in &quot;".$recordSet->fields['album_jmusicreviews'] ."&quot; Album</font> : <font color='green'>".$recordSet->fields['judul_jmusicreviews']."</font></a>";
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

function ResultDetailedJMusicReviews()
{
  	include "conf.php";
  	$no = Globals::getVar("id_jmusicreviews");
  	$sql = "SELECT * FROM reviews_jmusic WHERE id_jmusicreviews='$no'";
  	$recordSet = $adoObj->Execute($sql);

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
  	<br />
  	<?php
	echo "<a href='javascript:history.go(-1)'>Back</a><br /><br />";
}

?>
