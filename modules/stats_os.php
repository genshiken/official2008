<?
include "conf.php"; 
  
$stats_os = "CREATE TABLE IF NOT EXISTS stats_os
	(
	no				INT		NOT NULL	primary key,
	os_type	TINYTEXT	NOT NULL, 
    os_count	BIGINT	NOT NULL
  	)";
$buat_stats_os = mysql_db_query($dbname,$stats_os);

$HUA = $_SERVER['HTTP_USER_AGENT'];

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
			
else {$os = "Other";}

$sql_os = "select * from stats_os WHERE os_type='$os'";
$recordSet1 = $adoObj->Execute($sql_os);
$recordSet1 = $recordSet1->fields['os_count'];
if($recordSet1 == null)
{
	$no = 0;
	$no = $adoObj->PO_Insert_ID('stats_os','no') + 1;
	$sql_2 = "INSERT INTO stats_os (no,os_type,os_count) values ('$no','$os','1')";
	$recordSet_2 = $adoObj->Execute($sql_2);
}
else
{
	$count = $recordSet1;
	$count = $count + 1;

	$sql_2 = "UPDATE stats_os SET os_count = '$count' where os_type='$os'";
	$recordSet_2 = $adoObj->Execute($sql_2);
}

?>