<?php
/** Modul for Search */
/** date : 11/04/2006 8:27PM *
/** author: Andhy Sukma Perdana *
/** web : http://riset.sytes.net *
/** email : andhy@radar.ee.itb.ac.id */

function Search()
{
	global $adoObj;
	include "conf.php";

    /** form search*/
    $form = new FormGroup("index1.php?m=Result");
    $form->setTitle("&nbsp;");
    $form->addText("q",$word,array("size"=>20));
    $form->addSubmit("submit","search");
    $form->groupAsRow();

    /** form validator*/
    $form->addRule("q","minlength",array(3));
    /** checking */
    if(Globals::getVar('submit') == "search")
	{
     	if($form->validateElement())
		{
           	$form->display();
            echo "<br/>";
            //searchBerita();
        }
		else
		{
            $form->display();
        }
    }
	else
	{
    	$form->display();
    }
}

function Result()
{
  	global $config;
	?>
	<div class="newsbox">
		<div class="newstitle">
			Search Result :<br />
		</div>
		<div class="newslist">
		<?php
        	global $adoObj;
        	include "conf.php";
         	/** param global*/
        	$word = Globals::getVar('q');
        	if(($word =="Search Anime Reviews") or (strlen($word) < 1))
			{
	 			echo "<b>Search</b>";
	 		}
			else if((strlen($word) > 0) and (strlen($word) < 3))
			{
	 			echo"<b>Must Be At Least 3 Characters</b>";
			}
			else
			{
				$found=0;
				//$sql = "select * from reviews_anime where judul_animereviews like '%$word%' or isi_animereviews like '%$word%' order by judul_animereviews asc";

				$sql = "select * from reviews_anime where judul_animereviews like '%$word%' order by judul_animereviews asc";
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
							$page_id 	= $recordSet->fields['id_animereviews'];
							echo "<a href='index1.php?m=ResultDetail&id_animereviews=".$page_id."'>&raquo;&nbsp;".$recordSet->fields['judul_animereviews'] . "</a>";
							echo"<br />";
							?>
						</div>
						<?php
						$recordSet->MoveNext();
					}
				}
				if(empty($found))
	            {
					echo "No strings <b>$word</b> found...<br/>";
				}
			}
		?>
		</div>
	</div>
	<?php
}

function ResultDetailed()
{
  	include "conf.php";
  	$no = Globals::getVar("id_animereviews");
  	$sql = "SELECT * FROM reviews_anime WHERE id_animereviews='$no'";
  	$recordSet = $adoObj->Execute($sql);

  	?>
	<div class="newsbox">
		<div class="newstitle">
			<?php
				echo "&raquo; ". $recordSet->fields['judul_animereviews'];
				echo"<br />";
			?>
		</div>
		<br />
		<div class="newsimage">
			<?php
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
							echo "<img width='$image_width' src='$image_path'>";
						}
						else
						{
							echo "<img src='$image_path'>";
						}
					}
					elseif($screen_res == 1152)
					{
						$screen_margin		= 135;
						$screen_resefective = (0.8 * $screen_res) - $screen_margin;
						if($image_width >= $screen_resefective)
						{
							$image_width = floor($screen_resefective);
							echo "<img width='$image_width' src='$image_path'>";
						}
						else
						{
							echo "<img src='$image_path'>";
						}
					}
					elseif($screen_res == 1024)
					{
						$screen_margin		= 125;
						$screen_resefective = (0.8 * $screen_res) - $screen_margin;
						if($image_width >= $screen_resefective)
						{
							$image_width = floor($screen_resefective);
							echo "<img width='$image_width' src='$image_path'>";
						}
						else
						{
							echo "<img src='$image_path'>";
						}
					}
					else
					{
						$screen_margin		= (0.123 * $screen_res);
						$screen_resefective = (0.8 * $screen_res) - $screen_margin;
						if($image_width >= $screen_resefective)
						{
							$image_width = floor($screen_resefective);
							echo "<img width='$image_width' src='$image_path'>";
						}
						else
						{
							echo "<img src='$image_path'>";
						}
					}
				};
			?>
		</div>
		<div class="newsdesc">
			<?php
				echo"". $recordSet->fields['isi_animereviews'];
				echo"<br />";
				echo"<br />";
			?>
		</div>
		<div class="fake"><br /></div>
		<div class="newsdate">
			<?php
				echo"Posted : ". $recordSet->fields['waktu_upload_animereviews'];
				echo"<br />";
			?>
		</div>
	</div>
	<br />
  	<?php
	echo "<a href='javascript:history.go(-1)'>Back</a><br /><br />";
}
?>