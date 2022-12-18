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
		//exec("df -k | grep -v procfs | grep -v Filesystem | grep -v \"devfs\" | awk '{print $1\",\"$2\",\"$3\",\"$4\",\"$5\",\"$6}' > dump/disk.tmp");
		shell_exec("df -k | grep -v procfs | grep -v Filesystem | grep -v \"devfs\" | awk '{print $1,$2,$3,$4,$5,$6}' > dump/disk.tmp");
		$datos = file("dump/disk");
		//unlink("dump/disk"); 
		for ($x=0;$x<count($datos);$x++) 
		{ 
     		//spliting the info previusly saved with "," separatoy 
     		list($device,$total,$used,$remain,$porcentaje,$mountpoint) = split(",",$datos[$x]); 
        	//Calculating the multiplier digit for the bar graph
			$drive				= $device;
			$total_space		= $total;
			$used_space			= $used;
			$freespace			= $remain;			
     		$ajuste				= ($remain/$total);
			$percentage_free    = $freespace ? round($ajuste, 4) * 100 : 0;
			$percentage_used	= $used_space ? round($used_space / $total_space, 4) * 100 : 0;
			
			// Perform Matched Server Storage Information
			include "DiskInformationUNIX-HTML.php";
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
?>