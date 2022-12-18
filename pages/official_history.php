<?php

function OfficialHistory()
{
  include "conf.php";

  /*
  Table Properties :
  id_official_history				bigint(20)		primary key
  waktu_upload_official_history		datetime
  isi_official_history				longtext
  */

  $table1 = "CREATE TABLE IF NOT EXISTS official_history
  (
    id_official_history	BIGINT	NOT NULL	PRIMARY KEY,
    waktu_upload_official_history	DATETIME	NOT NULL,
	isi_official_history	LONGTEXT	NOT NULL
  )";
  $buat_table2 = $adoObj->execute($table1);

  $sql = "SELECT * FROM official_history";
  $recordSet = $adoObj->Execute($sql);

  if($recordSet !=null)
  	{
	while(!$recordSet->EOF)
		{
		?>
		<div class="newsbox">
			<div class="newsdesc">
				<?php
				echo "". $recordSet->fields['isi_official_history'];
				?>
			</div>
			<br />
			<div class="newsdate">
				<?php
				echo"Last Updated : ". $recordSet->fields['waktu_upload_official_history'];
				echo"<br />";
				?>
			</div>
		</div>
  		<br />
  		<?php
		$recordSet->MoveNext();
		}
	}
}

?>
