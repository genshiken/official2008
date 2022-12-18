<? 

function OfficialProfile()
{
  include "conf.php"; 
  
  /*
  Table Properties :
  id_official_profile				bigint(20)		primary key
  waktu_upload_official_profile		datetime				 	 	 	 	 	 	 
  isi_official_profile				longtext				
  */
  
  $table1 = "CREATE TABLE IF NOT EXISTS official_profile
  (
    id_official_profile	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_official_profile	DATETIME	NOT NULL,
	isi_official_profile	LONGTEXT	NOT NULL
  )";
  $buat_table2 = mysql_db_query($dbname,$table1);
  
  $sql = "SELECT * FROM official_profile";
  $recordSet = $adoObj->Execute($sql);
  
  if($recordSet !=null)
  	{
	while(!$recordSet->EOF)
		{
		?>
		<div class="newsbox">
			<div class="newsdesc">
			<?				
				echo"". $recordSet->fields['isi_official_profile'];
				echo"<br />";
			?>
			</div>
			<br />
			<div class="newsdate">
				<?
					echo"Last Updated : ". $recordSet->fields['waktu_upload_official_profile'];
					echo"<br />";
				?>
			</div>
		</div>
  		<br />	 	
  		<?
		$recordSet->MoveNext();
		}
	}
}

?>
