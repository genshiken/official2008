<?php

function home(){

   	?>
	<div>
	<?php
		// Menampilkan News Terbaru
		include "conf.php";
  		$sql = "SELECT * FROM official_news ORDER BY id_official_news DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest News&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=official_news'>&raquo;&nbsp;".$recordSet->fields['judul_official_news']."</a>";
						?>
					</div>
					<div class="newsdesc">
						<?php
							echo "". $recordSet->fields['isi_official_news'];
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
				$recordSet->MoveNext();
			}
		}
	?>
	</div>
	<div>
	<?php
		// Menampilkan Agenda Terbaru
		include "conf.php";
  		$sql = "SELECT * FROM official_agenda ORDER BY id_official_agenda DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest Agenda&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=official_agenda'>&raquo;&nbsp;".$recordSet->fields['judul_official_agenda']."</a>";
						?>
					</div>
					<div class="newsdesc">
					<?php
						//Create a spoiler of Agenda with 800 characters
						$lihatfield = $recordSet->fields['isi_official_agenda'];
						$hitungchara = strlen($lihatfield);
						if ($hitungchara > 800) {
							$take800 = substr($lihatfield, 0, 800);
							echo"$take800...&nbsp;<a href='index.php?m=official_agenda'>see more &raquo;</a>";
						}
						else{
							echo"$lihatfield";
						}
					?>
					</div>
					<div class="newsdate">
						<?php
							echo"Posted : ". $recordSet->fields['waktu_upload_official_agenda'];
							echo"<br />";
						?>
					</div>
				</div>
  				<br />
  				<?php
				$recordSet->MoveNext();
			}
		}
	?>
	</div>
	<div>
	<?php
		// Menampilkan Ongoing Projects Terbaru
  		$sql = "SELECT * FROM projects_ongoing ORDER BY id_ongoing_projects DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest Ongoing Projects&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=projects'>&raquo; ". $recordSet->fields['judul_ongoing_projects'] . "</a>";
						?>
					</div>
					<div class="newsdesc">
					<?php
						//Create a spoiler of Ongoing Projects with 400 characters
						$lihatfield = $recordSet->fields['isi_ongoing_projects'];
						$hitungchara = strlen($lihatfield);
						if ($hitungchara > 400) {
							$take400 = substr($lihatfield, 0, 400);
							echo"$take400...&nbsp;<a href='index.php?m=projects'>see more &raquo;</a>";
						}
						else{
							echo"$lihatfield";
						}
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
  		}
	?>
	</div>
	<div>
	<?php
		// Menampilkan Finished Projects Terbaru
  		$sql = "SELECT * FROM projects_finished ORDER BY id_finished_projects DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest Finished Projects&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=f_projects'>&raquo; ". $recordSet->fields['judul_finished_projects'] . "</a>";
						?>
					</div>
					<div class="newsdesc">
					<?php
						//Create a spoiler of Finished Projects with 400 characters
						$lihatfield = $recordSet->fields['isi_finished_projects'];
						$hitungchara = strlen($lihatfield);
						if ($hitungchara > 400) {
							$take400 = substr($lihatfield, 0, 400);
							echo"$take400...&nbsp;<a href='index.php?m=f_projects'>see more &raquo;</a>";
						}
						else{
							echo"$lihatfield";
						}
					?>
					</div>
					<div class="newsdate">
						<?php
							echo"Posted : ". $recordSet->fields['waktu_upload_finished_projects'];
							echo"<br />";
						?>
					</div>
				</div>
  				<br />
  				<?php
				$recordSet->MoveNext();
			}
  		}
	?>
	</div>
	<div>
	<?php 		// Menampilkan Anime Reviews Terbaru
		include "conf.php";
  		$sql = "SELECT * FROM reviews_anime ORDER BY id_animereviews DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest Anime Reviews&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=reviews_a_nime'>&raquo;&nbsp;".$recordSet->fields['judul_animereviews']."</a>";
						?>
					</div>
					<div class="newsdesc">
					<?php
						//Create a spoiler of Anime Reviews with 400 characters
						$lihatfield = $recordSet->fields['isi_animereviews'];
						$hitungchara = strlen($lihatfield);
						if ($hitungchara > 400) {
							$take400 = substr($lihatfield, 0, 400);
							echo"$take400...&nbsp;<a href='index.php?m=reviews_a_nime'>see more &raquo;</a>";
						}
						else{
							echo"$lihatfield";
						}
					?>
					</div>
					<div class="newsdate">
						<?php
							echo"Posted : ". $recordSet->fields['waktu_upload_animereviews'];
							echo"<br />";
						?>
					</div>
				</div>
  				<br />
  				<?php
				$recordSet->MoveNext();
			}
  		}
	?>
	</div>
	<div>
	<?php // Menampilkan Manga Reviews Terbaru
		include "conf.php";
  		$sql = "SELECT * FROM reviews_manga ORDER BY id_mangareviews DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest Manga Reviews&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=reviews_m_anga'>&raquo;&nbsp;".$recordSet->fields['judul_mangareviews']."</a>";
						?>
					</div>
					<div class="newsdesc">
					<?php
						//Create a spoiler of Anime Reviews with 400 characters
						$lihatfield = $recordSet->fields['isi_mangareviews'];
						$hitungchara = strlen($lihatfield);
						if ($hitungchara > 400) {
							$take400 = substr($lihatfield, 0, 400);
							echo"$take400...&nbsp;<a href='index.php?m=reviews_m_anga'>see more &raquo;</a>";
						}
						else{
							echo"$lihatfield";
						}
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
  		}
	?>
	</div>
	<div>
	<?php // Menampilkan Tokusatsu Reviews Terbaru
		include "conf.php";
  		$sql = "SELECT * FROM reviews_tokusatsu ORDER BY id_tokusatsureviews DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest Tokusatsu Reviews&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=reviews_t_okusatsu'>&raquo;&nbsp;".$recordSet->fields['judul_tokusatsureviews']."</a>";
						?>
					</div>
					<div class="newsdesc">
					<?php
						//Create a spoiler of Anime Reviews with 400 characters
						$lihatfield = $recordSet->fields['isi_tokusatsureviews'];
						$hitungchara = strlen($lihatfield);
						if ($hitungchara > 400) {
							$take400 = substr($lihatfield, 0, 400);
							echo"$take400...&nbsp;<a href='index.php?m=reviews_t_okusatsu'>see more &raquo;</a>";
						}
						else{
							echo"$lihatfield";
						}
					?>
					</div>
					<div class="newsdate">
						<?php
							echo"Posted : ". $recordSet->fields['waktu_upload_tokusatsureviews'];
							echo"<br />";
						?>
					</div>
				</div>
  				<br />
  				<?php
				$recordSet->MoveNext();
			}
  		}
	?>
	</div>
	<div>
	<?php // Menampilkan Dorama Reviews Terbaru
		include "conf.php";
  		$sql = "SELECT * FROM reviews_dorama ORDER BY id_doramareviews DESC LIMIT 1";
  		$recordSet = $adoObj->Execute($sql);

  		if($recordSet !=null){

			while(!$recordSet->EOF){
				?>
				<div class="linebreak"></div>
				<div class="frontinfo">
					&raquo;&nbsp;Latest Dorama Reviews&nbsp;&laquo;
				</div>
				<div class="frontfake"></div>
				<div class="newsbox">
					<div class="newstitle">
						<?php
							echo "<a href='index.php?m=reviews_d_orama'>&raquo;&nbsp;".$recordSet->fields['judul_doramareviews']."</a>";
						?>
					</div>
					<div class="newsdesc">
					<?php
						//Create a spoiler of Anime Reviews with 400 characters
						$lihatfield = $recordSet->fields['isi_doramareviews'];
						$hitungchara = strlen($lihatfield);
						if ($hitungchara > 400) {
							$take400 = substr($lihatfield, 0, 400);
							echo"$take400...&nbsp;<a href='index.php?m=reviews_d_orama'>see more &raquo;</a>";
						}
						else{
							echo"$lihatfield";
						}
					?>
					</div>
					<div class="newsdate">
						<?php
							echo"Posted : ". $recordSet->fields['waktu_upload_doramareviews'];
							echo"<br />";
						?>
					</div>
				</div>
  				<br />
  				<?php
				$recordSet->MoveNext();
			}
  		}
	?>
	</div>
	<?php

}

?>