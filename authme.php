<?
session_start();
	if ($_SESSION['logged']!=1){
		$redirect=$_SERVER['PHP_SELF'];
		header("Refresh: 0; URL=admin.php?redirect=$redirect");
		?>
		<table width="100%" height="100%">
			<tr>
				<center>
					<td align="center" width="100%">
						<img src="pics/admin/loading.gif" alt="" />
						<?
						echo"You are being redirected to the login page! ";		
						echo "(If your browser doesn't support this, <a href=\"admin.php?redirect=$redirect\">click here</a>)";
						?>							
						<img src="pics/admin/loading.gif" alt="" />
					</td>
				</center>	
			</tr>
		</table>	
		<?
		die();
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
}
?>