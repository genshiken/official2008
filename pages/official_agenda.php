<? 

function OfficialAgenda()
{
  include "conf.php"; 
  
  $table1 = "CREATE TABLE IF NOT EXISTS official_agenda
  (
    id_official_agenda	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_official_agenda	DATETIME	NOT NULL,
	judul_official_agenda	TINYTEXT	NOT NULL,
	isi_official_agenda	LONGTEXT	NOT NULL
  )";
  $buat_table2 = mysql_db_query($dbname,$table1);
  
  $sql = "select count(*) as total from official_agenda";
  $total = $adoObj->GetOne($sql);

  $page = (int)Globals::getVar('page') == 0 ? 1 : (int)Globals::getVar('page');
  $limit = 3;
  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM official_agenda ORDER BY id_official_agenda DESC LIMIT $offset,$limit";
  $recordSet = $adoObj->Execute($sql);
  
  if($recordSet !=null){

	while(!$recordSet->EOF){
		?>
		<div class="newsbox">
			<div class="newstitle">
				<?
				echo "&raquo; ". $recordSet->fields['judul_official_agenda'];
				?>
			</div>
			<div class="newsdesc">
				<?				
				echo"". $recordSet->fields['isi_official_agenda'];
				echo"<br />";
				?>
			</div>
			<div class="newsdate">
				<?
				echo"Last Update : ". $recordSet->fields['waktu_upload_official_agenda'];
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

?>
