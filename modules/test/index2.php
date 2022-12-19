<?php

$hd1 = shell_exec("df -h /home/ftp/hd1");
$hd3 = shell_exec("df -h /home/ftp/hd3");
$hd4 = shell_exec("df -h /home/ftp/hd4");
$hd5 = shell_exec("df -h /home/ftp/hd5");
$hd6 = shell_exec("df -h /home/ftp/hd6");
$music = shell_exec("df -h /home/ftp/music");

echo "<br />hd1 = $hd1";
echo "<br />hd3 = $hd3";
echo "<br />hd4 = $hd4";
echo "<br />hd5 = $hd5";
echo "<br />hd6 = $hd6";
echo "<br />music = $music";

?>
