<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" dir="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Biggest's Free Space</title>
</head>

<body>
<code>
<?php

for ($i=1; $i<=7; $i++)
{
    if ($i != 2) {
        if ($i ==7) {
			$hdt[$i]=disk_total_space('/home');
			$hdt[$i]=hit($hdt[$i],$i,0);
			$hdf[$i]=disk_free_space('/home');
			$hdf[$i]=hit($hdf[$i],$i,1);
			?> hd-music = <?=$hdt[$i] . ' ' . $size[$i][0] ?> total, <?=$hdf[$i] . ' ' . $size[$i][1] ?> free <br />
<?php
			} else {
			$hdt[$i]=disk_total_space('/home/ftp/hd'.$i);
			$hdt[$i]=hit($hdt[$i],$i,0);
			$hdf[$i]=disk_free_space('/home/ftp/hd'.$i);
			$hdf[$i]=hit($hdf[$i],$i,1);
			?> hd<?=$i?> = <?=$hdt[$i] . ' ' . $size[$i][0] ?> total, <?=$hdf[$i] . ' ' . $size[$i][1] ?> free <br />
<?php
			}
	}
}

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
</code>
</body>
</html>
