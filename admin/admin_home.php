<?
function CheckTables()
{
	?>
	<div class="DiskFreeSpaceBox">
		<?
		include "conf.php";
		global $adoObj;
		
		$sql = "CHECK TABLE `officials`";
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "CHECK TABLE `official_gallery`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "CHECK TABLE `official_history`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "CHECK TABLE `official_news`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "CHECK TABLE `official_profile`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "CHECK TABLE `projects_finished`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "CHECK TABLE `projects_ongoing`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "CHECK TABLE `reviews_anime`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		?>
	</div>
	<?
}

function OptimizeTables()
{
	?>
	<div class="DiskFreeSpaceBox">
		<?
		include "conf.php";
		global $adoObj;
		
		$sql = "OPTIMIZE TABLE `officials`";
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "OPTIMIZE TABLE `official_gallery`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "OPTIMIZE TABLE `official_history`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "OPTIMIZE TABLE `official_news`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "OPTIMIZE TABLE `official_profile`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "OPTIMIZE TABLE `projects_finished`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "OPTIMIZE TABLE `projects_ongoing`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "OPTIMIZE TABLE `reviews_anime`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		?>
	</div>
	<?
}

function RepairTables()
{
	?>
	<div class="DiskFreeSpaceBox">
		<?
		include "conf.php";
		global $adoObj;
		
		$sql = "REPAIR TABLE `officials`";
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "REPAIR TABLE `official_gallery`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "REPAIR TABLE `official_history`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "REPAIR TABLE `official_news`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "REPAIR TABLE `official_profile`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "REPAIR TABLE `projects_finished`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "REPAIR TABLE `projects_ongoing`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		
		$sql = "REPAIR TABLE `reviews_anime`";
		$res = $adoObj->Execute($sql);
		echo $sql."...";
		$res = $adoObj->Execute($sql);
		if($res == false){echo "Failed!<br />";}else{echo "Done!<br />";}
		?>
	</div>
	<?
}

function home()
{
	?>	
	<div class="DiskFreeSpaceBox">		
		# Biggest's Disk Storage Information # (Based On 1024's Calculation)<hr /><? include "modules/diskinformation.php"; ?>
	</div>
	<br />
	<div class="DiskFreeSpaceBox">		
		# Visitors' Browser Statistics #<hr />
		<?

		include "conf.php";
		$count_sql = "select count(*) as total from stats_browser";
 		$total_sql = $adoObj->GetOne($count_sql);
		
		$counter = 0;
		$sql1	= "select * from stats_browser";
		$sql2	= $adoObj->Execute($sql1);
		if($sql2 !=null)
		{
			while(!$sql2->EOF)
			{
				$sql3	= $sql2->fields['browser_count'];
				$counting = $sql3;
				$counter = $counter + $counting;
				$sql2->MoveNext();
			}
		}		
		
		$count_all = $counter;		
		
		$sql = "SELECT * FROM stats_browser ORDER BY browser_type";
  		$recordSet = $adoObj->Execute($sql);
  
  		if($recordSet !=null)
		{
			while(!$recordSet->EOF)
			{
				?>
					<table cellpadding="0px" cellspacing="2px">
						<tr>
							<td>
								<div style="width:150px; height:9px; font-family:verdana; font-size:9pt;">
								<?
									echo "&raquo; ". $recordSet->fields['browser_type'];
								?>
								</div>
							</td>
							<td>
								<div style="width:300px; height:12px; border-left:1px solid gray;">
								<?
									$count = $recordSet->fields['browser_count'];
									$length = ($count / $count_all) * 300;
									echo "<img src='pics/bar_block1.gif' alt='' height='12px' width='$length' />";
								?>
								</div>
							</td>
							<td>
								<div style="height:9px; font-family:verdana; font-size:9pt;"> 
								<?
									$count = $recordSet->fields['browser_count'];	
									echo "&nbsp;".$count;
								?>
								</div>
							</td>
						</tr>
					</table>
  				<?
				$recordSet->MoveNext();
			}
		}
		?>
	</div>
	<br />
	<div class="DiskFreeSpaceBox">		
		# Visitors' Operating System Statistics #<hr />
		<?

		include "conf.php";
		$count_sql = "select count(*) as total from stats_os";
 		$total_sql = $adoObj->GetOne($count_sql);
		
		$counter = 0;
		$sql1	= "select * from stats_os";
		$sql2	= $adoObj->Execute($sql1);
		if($sql2 !=null)
		{
			while(!$sql2->EOF)
			{
				$sql3	= $sql2->fields['os_count'];
				$counting = $sql3;
				$counter = $counter + $counting;
				$sql2->MoveNext();
			}
		}		
		
		$count_all = $counter;		
		
		$sql = "SELECT * FROM stats_os ORDER BY os_type";
  		$recordSet = $adoObj->Execute($sql);
  
  		if($recordSet !=null)
		{
			while(!$recordSet->EOF)
			{
				?>
					<table cellpadding="0px" cellspacing="2px">
						<tr>
							<td>
								<div style="width:150px; font-family:verdana; font-size:9pt;">
								<?
									echo "&raquo; ". $recordSet->fields['os_type'];
								?>
								</div>
							</td>
							<td>
								<div style="width:300px; border-left:1px solid gray;">
								<?
									$count = $recordSet->fields['os_count'];
									$length = ($count / $count_all) * 300;
									echo "<img src='pics/bar_block1.gif' alt='' height='10px' width='$length' />";
								?>
								</div>
							</td>
							<td>
								<div style="font-family:verdana; font-size:9pt;"> 
								<?
									$count = $recordSet->fields['os_count'];	
									echo "&nbsp;".$count;
								?>
								</div>
							</td>
						</tr>
					</table>
  				<?
				$recordSet->MoveNext();
			}
		}
		?>
	</div>
	<?
}

function to_readble_size($size)
{
	switch (true)
    {
            // Use 1024 calculation
			case ($size > 1099511627776): // 1099511627776 = 1024 x 1024 x 1024 x 1024
                $size /= 1099511627776;
                break;
            case ($size > 1073741824): //1073741824 = 1024 x 1024 x 1024
                $size /= 1073741824;
                break;
            case ($size > 1048576):	// 1048576 = 1024 x 1024
                $size /= 1048576;
                break;
            case ($size > 1024):
                $size /= 1024;
                break;
            default:
                ;
    }
    return round($size, 2);
}

?>