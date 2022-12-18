<br />
<h1><img align="absmiddle" src="pics/tooltip.png">&nbsp;User's Statistics&nbsp;<img align="absmiddle" src="pics/tooltip.png"></h1><br />
<div class="stats">
	
	<? //Untuk IP Address ?>
	&raquo; IP Address :<br />
	<?PHP
	echo "&nbsp;&nbsp;"
	?>
	<img src="pics/ip_address.png" align="absmiddle">
	<?
	if ($_SERVER["HTTP_CLIENT_IP"]) 
		$ip = $_SERVER["HTTP_CLIENT_IP"];
    else if($_SERVER["REMOTE_ADDR"]) 
       	$ip = $_SERVER["REMOTE_ADDR"];
    else if($_SERVER["HTTP_X_FORWARDED_FOR"]) 
       	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    else
        $ip = 'Unknown';
		
	/*if (getenv("HTTP_CLIENT_IP")) 
		$ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("REMOTE_ADDR")) 
       	$ip = getenv("REMOTE_ADDR");
    else if(getenv("HTTP_X_FORWARDED_FOR")) 
       	$ip = getenv("HTTP_X_FORWARDED_FOR");
    else
        $ip = 'Unknown';*/
		
	echo "$ip";
	?><br /><br />
	<!--
	<? //Untuk Proxy ?>
	&raquo; Proxy :<br />
	<?PHP
	echo "&nbsp;&nbsp;";
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		?>
		<img src="pics/proxy.png" align="absmiddle">
		<?
		echo $_SERVER['HTTP_X_FORWARDED_FOR'];} 
	else {
		?>
		<img src='pics/unknown.png' align='absmiddle'>
		<?
		echo "Unknown / LAN";}
	//if (isset($_ENV['HTTP_X_FORWARDED_FOR'])) {echo $_ENV['HTTP_X_FORWARDED_FOR'];} else {echo "Unknown";}
	?><br /><br />
	
	<? //Untuk Host Address ?>
	&raquo; Host Address :<br />
   	<?PHP 
	echo "&nbsp;&nbsp;";
	if (isset($_SERVER['REMOTE_HOST'])) {
		?>
		<img src='pics/host.png' align='absmiddle'>
		<?
		echo $_SERVER['REMOTE_HOST'];} 
	else {
		?>
		<img src='pics/unknown.png' align='absmiddle'>
		<?
		echo "Unknown / LAN";}
	//if (isset($_ENV['REMOTE_HOST'])) {echo $_ENV['REMOTE_HOST'];} else {echo "Unknown";}
	?><br /><br />
	-->
	<? //Untuk Browser ?>
	&raquo; Browser :<br />
	<? 
	echo "&nbsp;";
	
	$HUA = $_SERVER['HTTP_USER_AGENT'];
	//$HUA = getenv("HTTP_USER_AGENT");
	
	if(
	  (strstr($HUA, "Nav")) || 
	  (strstr($HUA, "Gold")) || 
	  (strstr($HUA, "X11")) || 
	  (strstr($HUA, "Mozilla")) AND 
	  (!strstr($HUA, "MSIE"))
	  ) 
	    {
		?>
		<img src="pics/browser/firefox.gif" align="absmiddle">
		<?
		}				
	elseif(strstr($HUA, "MSIE")) {
		?>
		<img src="pics/browser/msie.gif" align="absmiddle">
		<?
		}
	elseif(strstr($HUA, "Opera")) {
		?>
		<img src="pics/browser/opera.gif" align="absmiddle">
		<?
		}
	elseif(strstr($HUA, "safari")) {
		?>
		<img src="pics/browser/unknown.png">
		<?
		}
	elseif(strstr($HUA, "Safari")) {
		?>
		<img src="pics/browser/unknown.png">
		<?
		}
	elseif(strstr($HUA, "Lynx")) {
		?>
		<img src="pics/browser/lynx.gif">
		<?
		}
	elseif(strstr($HUA, "WebTV")) {
		?>
		<img src="pics/browser/webtv.gif">
		<?
		}
	elseif(strstr($HUA, "Konqueror")) {
		?>
		<img src="pics/browser/konqueror.gif">
		<?
		}
	elseif(strstr($HUA, "Netscape")) {
		?>
		<img src="pics/browser/netscape.gif">
		<?
		}
	elseif(
		  (stristr($HUA, "bot")) || 
		  (strstr($HUA, "Google")) || 
		  (strstr($HUA, "Slurp")) || 
		  (strstr($HUA, "Scooter")) || 
		  (stristr($HUA, "Spider")) || 
		  (stristr($HUA, "Infoseek"))
		  ) 
		{
		?>
		<img src="pics/browser/unknown.png">
		<?
		}
	else {
		?>
		<img src="pics/browser/unknown.png">
		<?
		}
	
	if(
	  (strstr($HUA, "Nav")) || 
	  (strstr($HUA, "Gold")) || 
	  (strstr($HUA, "X11")) || 
	  (strstr($HUA, "Mozilla")) || 
	  (strstr($HUA, "Netscape")) AND 
	  (!strstr($HUA, "MSIE"))
	  ) 
	  $browser = "Mozilla FireFox";
				
	elseif(strstr($HUA, "MSIE")) $browser = "Internet Explorer";
	elseif(strstr($HUA, "Opera")) $browser = "Opera";
	elseif(strstr($HUA, "safari")) $browser = "Safari";
	elseif(strstr($HUA, "Safari")) $browser = "Safari";
	elseif(strstr($HUA, "Lynx")) $browser = "Lynx";
	elseif(strstr($HUA, "WebTV")) $browser = "WebTV";
	elseif(strstr($HUA, "Konqueror")) $browser = "Konqueror";
	elseif((stristr($HUA, "bot")) || (strstr($HUA, "Google")) || (strstr($HUA, "Slurp")) || (strstr($HUA, "Scooter")) || (stristr($HUA, "Spider")) || (stristr($HUA, "Infoseek"))) $browser = "Bot";
	else $browser = "Unknown";

	echo "$browser";
	//if (isset($_ENV['HTTP_USER_AGENT'])) {echo $_ENV['HTTP_USER_AGENT'];} else {echo "Unknown";}
	?><br /><br />
	
	<? //Untuk Operating System ?>
	&raquo; Operating System :<br />
   		<?PHP 
			echo "&nbsp;";

			$HUA = $_SERVER['HTTP_USER_AGENT'];
			//$HUA = getenv("HTTP_USER_AGENT");
	
			if(
	  		  (strstr($HUA, "Windows NT 5.2")) ||
			  (strstr($HUA, "Windows NT 5.1")) ||
			  (strstr($HUA, "Windows NT 5.0")) ||
			  (strstr($HUA, "windows NT")) || 
			  (strstr($HUA, "windows 98")) ||
	  		  (strstr($HUA, "windows 95"))
	 		  )
	    	  {
		?>
		<img src="pics/os/win.gif">
		<?
			  }
			elseif(strstr($HUA, "Windows NT 6.0"))
			  {
		?>
		<img src="pics/os/vista.png">
		<?
			  }
			elseif(
		  		  (strstr($HUA, "Mac")) || 
		  		  (strstr($HUA, "PPC"))
		  		  )
		  	  {
		?>
		<img src="pics/os/mac.gif">
		<?
			  }
			elseif(strstr($HUA, "Mac_PowerPC")) 
			  {
		?>
		<img src="pics/os/mac.gif">
		<?
			  }
			elseif(strstr($HUA, "Mac_PPC")) 
			  {
		?>
		<img src="pics/os/mac.gif">
		<?
			  }
			elseif(strstr($HUA, "Macintosh")) 
			  {
		?>
		<img src="pics/os/mac.gif">
		<?
			  }					
			
			elseif(strstr($HUA, "Linux")) 
			  {
		?>
		<img src="pics/os/tux.gif">
		<?
		  	  }
	elseif(strstr($HUA, "Debian")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "Fedora")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "Slackware")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "Redhat")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "Ubuntu")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "Suse")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }

					
	elseif(strstr($HUA, "X11")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "BSD")) 
		  {
		  ?>
		  <img src="pics/os/bsd.gif">
		  <?
		  }
	elseif(strstr($HUA, "SunOS")) 
		  {
		  ?>
		  <img src="pics/os/sun.gif">
		  <?
		  }
	elseif(strstr($HUA, "FreeBSD")) 
		  {
		  ?>
		  <img src="pics/os/bsd.gif">
		  <?
		  }
	elseif(strstr($HUA, "IRIX")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "NetBSD")) 
		  {
		  ?>
		  <img src="pics/os/bsd.gif">
		  <?
		  }
	elseif(strstr($HUA, "HP-UX")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "AIX")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "QNX")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
    					
    					
    elseif(strstr($HUA, "BeOS")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
	elseif(strstr($HUA, "OS/2")) 
		  {
		  ?>
		  <img src="pics/os/os2.gif">
		  <?
		  }
	elseif(strstr($HUA, "AmigaOS")) 
			  {
		?>
		<img src="pics/os/unknown.png">
		<?
		  	  }
				
	else {
			  {
			  ?>
			  <img src="pics/os/unknown.png">
			  <?
		  	  }
	}
					
	if(strstr($HUA, "Windows NT 6.0")) $os = "Windows Vista";
	elseif(strstr($HUA, "Windows NT 5.2")) $os = "Windows 2003";
	elseif(strstr($HUA, "Windows NT 5.1")) $os = "Windows XP";
	elseif(strstr($HUA, "Windows NT 5.0")) $os = "Windows 2000";
	elseif(strstr($HUA, "windows NT")) $os = "Windows NT";
	elseif(strstr($HUA, "windows 98")) $os = "Windows 98";
	elseif(strstr($HUA, "windows 95")) $os = "Windows 95";
					
		
	elseif((strstr($HUA, "Mac")) || (strstr($HUA, "PPC"))) $os = "Mac OS";
	elseif(strstr($HUA, "Mac_PowerPC")) $os = "Mac OS";
	elseif(strstr($HUA, "Mac_PPC")) $os = "Mac OS";
	elseif(strstr($HUA, "Macintosh")) $os = "Mac OS";
					
					
	elseif(strstr($HUA, "Linux")) $os = "Linux";
	elseif(strstr($HUA, "Debian")) $os = "Debian";
	elseif(strstr($HUA, "Fedora")) $os = "Fedora";
	elseif(strstr($HUA, "Slackware")) $os = "Slackware";
	elseif(strstr($HUA, "Redhat")) $os = "Redhat";
	elseif(strstr($HUA, "Ubuntu")) $os = "Ubuntu";
	elseif(strstr($HUA, "Suse")) $os = "Suse";

					
	elseif(strstr($HUA, "X11")) $os = "Unix";
	elseif(strstr($HUA, "BSD")) $os = "BSD";
	elseif(strstr($HUA, "SunOS")) $os = "SunOS";
	elseif(strstr($HUA, "FreeBSD")) $os = "FreeBSD";
	elseif(strstr($HUA, "IRIX")) $os = "IRIX";
	elseif(strstr($HUA, "NetBSD")) $os = "NetBSD";
	elseif(strstr($HUA, "HP-UX")) $os = "HP-UX";
	elseif(strstr($HUA, "AIX")) $os = "AIX";
	elseif(strstr($HUA, "QNX")) $os = "QNX";
    					
    					
    elseif(strstr($HUA, "BeOS")) $os = "BeOS";
	elseif(strstr($HUA, "OS/2")) $os = "OS/2";
	elseif(strstr($HUA, "AmigaOS")) $os = "AmigaOS";
				
	else {
		$os = "Other";
	}
	
	echo "$os";
	
	?><br /><br />
	
	<? //Untuk Processing Time ?>
	&raquo; Processing Time :<br />
	<?	
	echo "&nbsp;&nbsp;";
	?>
	<img src="pics/processing_time.png" align="absmiddle">
	<?
	function getmicrotime() {
		// split output from microtime() on a space
		list($usec, $sec) = explode(" ",microtime());
		     
		// append in correct order
		return ((float)$usec + (float)$sec); 
		} 
			
		$start = getmicrotime();
			    
		for ($i=0; $i < 10000; $i++){
		    //loop 10000 times
		}
			
		$finish = getmicrotime();
			
		printf("%.3f seconds", $finish - $start);
	?>
</div>