<?php

$hd1t = disk_total_space('/home/ftp/hd1');
$hd1f = disk_free_space('/home/ftp/hd1');
$hd3t = disk_total_space('/home/ftp/hd3');
$hd3f = disk_free_space('/home/ftp/hd3');
$hd4t = disk_total_space('/home/ftp/hd4');
$hd4f = disk_free_space('/home/ftp/hd4');
$hd5t = disk_total_space('/home/ftp/hd5');
$hd5f = disk_free_space('/home/ftp/hd5');
$hd6t = disk_total_space('/home/ftp/hd6');
$hd6f = disk_free_space('/home/ftp/hd6');
$hdmt = disk_total_space('/home');
$hdmf = disk_free_space('/home');

$hd1t/=1073741824;
$hd1f/=1073741824;
$hd3t/=1073741824;
$hd3f/=1073741824;
$hd4t/=1073741824;
$hd4f/=1073741824;
$hd5t/=1073741824;
$hd5f/=1073741824;
$hd6t/=1073741824;
$hd6f/=1073741824;
$hdmt/=1073741824;
$hdmf/=1073741824;

$hd1t=floor($hd1t);
$hd1f=floor($hd1f);
$hd3t=floor($hd3t);
$hd3f=floor($hd3f);
$hd4t=floor($hd4t);
$hd4f=floor($hd4f);
$hd5t=floor($hd5t);
$hd5f=floor($hd5f);
$hd6t=floor($hd6t);
$hd6f=floor($hd6f);
$hdmt=floor($hdmt);
$hdmf=floor($hdmf);


echo "<br />hd1 = $hd1t GB total, $hd1f GB free";
echo "<br />hd3 = $hd3t GB total, $hd3f GB free";
echo "<br />hd4 = $hd4t GB total, $hd4f GB free";
echo "<br />hd5 = $hd5t GB total, $hd5f GB free";
echo "<br />hd6 = $hd6t GB total, $hd6f GB free";
echo "<br />hd-music = $hdmt GB total, $hdmf GB free";

?>
