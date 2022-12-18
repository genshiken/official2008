<?
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
header("location: ../index.php");
}

function truncate($text,$limit){
	$text = explode(" ",$text);
	if(count($text) < $limit)
		$limit = count($text);
	$return = "";
	$count  = 0;
	foreach($text as $word){
	   $return  .= $word." ";
	   
	   if($count == $limit - 1)
	     break;
	   $count++;
  }
	return $return;
}

include "conf.php";

$sql = "select no,waktu,nama,browser,shout,avatar from guestbook ORDER BY no DESC";
$record = $adoObj->GetRow($sql);
echo "<p>". avatar($record['avatar']) . "&nbsp;";
echo " <b>". $record['nama'] . "</b><br>";
echo "&nbsp;<span class=post-tgl> ". $record['waktu'] . "<br> &nbsp;Using ".$record['browser']."</span>";
echo "<p class=cmnt>" . truncate($record['shout'],5) . "<br></p>";
echo "<a href='index.php?m=lihatGuestbook'>Read More...</a>";
?>