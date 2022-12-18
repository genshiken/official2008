<?php
include "conf.php";

$stats_browser = "CREATE TABLE IF NOT EXISTS stats_browser
	(
	no				INT		NOT NULL	primary key,
	browser_type	TINYTEXT	NOT NULL,
    browser_count	BIGINT	NOT NULL
  	)";
$buat_stats_browser = $adoObj->execute($stats_browser);

$HUA = $_SERVER['HTTP_USER_AGENT'];

if((strstr($HUA, "Nav")) || (strstr($HUA, "Gold")) || (strstr($HUA, "X11")) || (strstr($HUA, "Mozilla")) || (strstr($HUA, "Netscape")) AND (!strstr($HUA, "MSIE"))) $browser = "Mozilla FireFox";
elseif(strstr($HUA, "MSIE")) $browser = "Internet Explorer";
elseif(strstr($HUA, "Opera")) $browser = "Opera";
elseif(strstr($HUA, "safari")) $browser = "Safari";
elseif(strstr($HUA, "Safari")) $browser = "Safari";
elseif(strstr($HUA, "Lynx")) $browser = "Lynx";
elseif(strstr($HUA, "WebTV")) $browser = "WebTV";
elseif(strstr($HUA, "Konqueror")) $browser = "Konqueror";
elseif((stristr($HUA, "bot")) || (strstr($HUA, "Google")) || (strstr($HUA, "Slurp")) || (strstr($HUA, "Scooter")) || (stristr($HUA, "Spider")) || (stristr($HUA, "Infoseek"))) $browser = "Bot";
else $browser = "Unknown";

$sql_br = "select * from stats_browser WHERE browser_type = ?";
$recordSet = $adoObj->Execute($sql_br, [$browser]);
$recordSet = $recordSet->fields['browser_count'];
if($recordSet == null)
{
	$no = 0;
	$no = $adoObj->PO_Insert_ID('stats_browser','no') + 1;
	$sql_1 = "INSERT INTO stats_browser (no,browser_type,browser_count) values (?,?,'1')";
	$recordSet_1 = $adoObj->Execute($sql_1, [$no, $browser]);
}
else
{
	$count = $recordSet;
	$count = $count + 1;

	$sql_1 = "UPDATE stats_browser SET browser_count = ? where browser_type=?";
	$recordSet_1 = $adoObj->Execute($sql_1, [$count, $browser]);
}

?>
