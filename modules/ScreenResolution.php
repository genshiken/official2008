<?php
/*
(c) http://www.phpbuddy.com (Feel free to use this script but keep this message intact)
Author: Ranjit Kumar (Cheif Editor phpbuddy.com)
*/
if(isset($HTTP_COOKIE_VARS["users_resolution"]))
	{
	$screen_res = $HTTP_COOKIE_VARS["users_resolution"];
	}
else
	{
	//means cookie is not found set it using Javascript
	?>
	<script type="text/javascript" >

		writeCookie();
		/*
		<!--
		Original Script
		function writeCookie()
			{
			var today = new Date();
			var the_date = new Date("December 31, 2023");
			var the_cookie_date = the_date.toGMTString();
			var the_cookie = "users_resolution="+ screen.width +"x"+ screen.height;
			var the_cookie = the_cookie + ";expires=" + the_cookie_date;
			document.cookie=the_cookie
			}
		-->
		*/
		function writeCookie()
			{
			var the_cookie = "users_resolution="+ screen.width;
			document.cookie=the_cookie
			}
	</script>
	<?php
	}
	$screen_file = fopen("dump/screen.txt","w+");
	$screen_write= fputs($screen_file,$screen_res ?? '0');
	$screen_close= fclose($screen_file);
?>
