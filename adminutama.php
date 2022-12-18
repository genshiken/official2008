<?
include 'authme.php';
?>

<html>
	<head>
		<title>Genshiken &#29694;&#35222;&#30740; ITB Authority Page</title>
		<link rel="stylesheet" href="css/admin1.css" type="text/css" />
		<meta name="Author" content="Amateurasu, Benny Elian" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<SCRIPT language="javascript" src="javacripts/blockerror.js"></SCRIPT>-->
		<script type="text/javascript" src="javacripts/daycount1.js"></script>
	</head>
	
	<body onload="goforit();blockError();">
   		<? include "modules/ScreenResolution.php"; ?>
		<!-- Start of Header -->
		<?PHP include_once "admin/header.php"; ?>	
  		<!-- End of header -->
		
		<!-- Start of Content -->
		<div class="context">
			<div class="iframe">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:20%;border-left:1px solid indigo; border-right:1px solid indigo; padding-right:3px" valign="top">
							<div class="sidebar_left">
								<?PHP include_once "admin/sidebar_left.php"; ?>
							</div>					
						</td>
						<td style="width:80%;border-right:1px solid indigo;padding-right:3px" valign="top">
							<div class="display">
								<?PHP include_once "admin/admin_display.php"; ?>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>	
		<!-- End of Content -->
		
		<!-- Start of Header -->
		<?PHP include_once "admin/footer.php"; ?>	
  		<!-- End of header -->

	</body>
</html>


