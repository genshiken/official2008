<?
/*
	By	: Benny Elian
	=> Detect System Type
	=> Determine The Suitable Algorithm
	=> Perform Matched Server Storage Information
	*/
	
	// Detect System Type
	$HUA = $_SERVER['HTTP_USER_AGENT'];
	
	// Determine The Suitable Algorithm
	if(
		(strstr($HUA, "Windows NT 6.0")) || 
		(strstr($HUA, "Windows NT 5.2")) ||
		(strstr($HUA, "Windows NT 5.1")) ||
		(strstr($HUA, "Windows NT 5.0")) ||
		(strstr($HUA, "windows NT")) || 
		(strstr($HUA, "windows 98")) ||
		(strstr($HUA, "windows 95"))
	   )
	{
		for ($i = 66; $i <= 87; $i++)
		{
			$drive = chr($i);
			if (is_dir($drive.':'))
   			{
        		$freespace			= disk_free_space($drive.':');
        		$total_space        = disk_total_space($drive.':');
				$used_space			= $total_space - $freespace;
        		$percentage_free    = $freespace ? round($freespace / $total_space, 4) * 100 : 0;				
				$percentage_used	= $used_space ? round($used_space / $total_space, 4) * 100 : 0;
				// Perform Matched Server Storage Information
				include "DiskInformationDOS-HTML.php";
       		}
		}					
	}
	/*
	elseif(
			(strstr($HUA, "Linux")) || 
			(strstr($HUA, "Debian")) || 
			(strstr($HUA, "Fedora")) || 
			(strstr($HUA, "Slackware")) || 
			(strstr($HUA, "Redhat")) || 
			(strstr($HUA, "Ubuntu")) || 
			(strstr($HUA, "Suse")) || 
			(strstr($HUA, "X11")) || 
			(strstr($HUA, "BSD")) || 
			(strstr($HUA, "FreeBSD")) || 
			(strstr($HUA, "NetBSD"))
		   )
	*/
	else 
	{
		for ($i=1; $i<=7; $i++)
		{
    		if ($i != 2) 
			{
        		if ($i ==7) 
				{
					$hdt[$i]=disk_total_space('/home');
					$hdt[$i]=hit($hdt[$i],$i,0);			
					$hdf[$i]=disk_free_space('/home');
					$hdf[$i]=hit($hdf[$i],$i,1);
					?> hd-music = <?=$hdt[$i] . ' ' . $size[$i][0] ?> total, <?=$hdf[$i] . ' ' . $size[$i][1] ?> free <br /><?
				} 
				else 
				{
					$hdt[$i]=disk_total_space('/home/ftp/hd'.$i);
					$hdt[$i]=hit($hdt[$i],$i,0);
					$hdf[$i]=disk_free_space('/home/ftp/hd'.$i);
					$hdf[$i]=hit($hdf[$i],$i,1);
					?> hd<?=$i?> = <?=$hdt[$i] . ' ' . $size[$i][0] ?> total, <?=$hdf[$i] . ' ' . $size[$i][1] ?> free <br /><?
				}
			}
		}
	}
	/*
	else
	{
		// When It Can't Determine The Suitable Algorithm...Just Say, "I Don't Know...Damn!"
		echo "Server's Disk Storage Information Is Not Available";
	};
	*/
	?>
	<hr>
	<table style="font-family:verdana; font-size:10pt;">
		<tr>
			<td width="50px">Index :</td>
			<td width="50px">TB</td>
			<td>= Tera Bytes</td>
		</tr>
		<tr>
			<td width="50px"></td>
			<td width="50px">GB</td>
			<td>= Giga Bytes</td>
		</tr>
		<tr>
			<td width="50px"></td>
			<td width="50px">MB</td>
			<td>= Mega Bytes</td>
		</tr>
		<tr>
			<td width="50px"></td>
			<td width="50px">KB</td>
			<td>= Kilo Bytes</td>
		</tr>
		<tr>
			<td width="50px"></td>
			<td width="50px">B</td>
			<td>= Bytes</td>
		</tr>
	</table>
	<?

function hit($cek,$i,$a)
{
	global $size;
	if (floor($cek/1073741824) < 2 )
	{
		$cek/=1048576;
		$size[$i][$a]='MB';
	} else
	{
		$cek/=1073741824;
		$size[$i][$a]='GB';
	}
	$comma=explode('.',$cek);
	$comma[1]=substr($comma[1],0,2);
	return $comma[0].'.'.$comma[1];
}
?>