<?php
include "conf.php";

$sql = "select count(*) as total from chpass";
$total = $adoObj->GetOne($sql);
if($total < 1)
	{
	$user = $user;
	$pass = $pass;
	}
else
	{
	$sql1 = "select * from chpass where id_chpass=1";
	$sql2 = "select * from chpass where id_chpass=2";
	$recordSet1 = $adoObj->Execute($sql1);
	$recordSet2 = $adoObj->Execute($sql2);

	$old_username = $recordSet1->fields['isi_chpass'];
	$old_password = $recordSet2->fields['isi_chpass'];

	$user = $old_username;
	$pass = $old_password;
	}

session_start();
	$_SESSION['logged']=0;

	if (isset($_POST['submit'])){
		$user1 = $_POST['useradmin'];
		$pass1 = $_POST['password'];
		$kode = $_POST['code'];

		$user2 = md5($user1);
		$pass2 = md5($pass1);
		$user3 = md5($user);
		$pass3 = md5($pass);
		$verifycode1 = md5($kode);
		$verifycode2 = $_SESSION['image__XvzF__value'];

		if (($user2== $user3) && ($pass2== $pass3) && ($verifycode1 == $verifycode2)){
			$_SESSION['logged']=1;
				$url="adminutama.php";
				header ("Refresh: 0;URL=" .$url . " ");
				?>
				<table width="100%" height="100%">
					<tr>
						<center>
							<td align="center" width="100%">
								<img src="pics/admin/loading.gif" alt="" />
								<?php
								echo"You are beeing redirected to your original page request! ";
								echo "(If your browser doesn't support this, <a href=adminutama.php>click here </a>)";
								?>
								<img src="pics/admin/loading.gif" alt="" />
							</td>
						</center>
					</tr>
				</table>
				<?php
			}
			else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

	<head>
		<title>Genshiken &#29694;&#35222;&#30740; ITB Authority Page</title>
		<link rel="stylesheet" href="css/admin.css" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Author" content="Amateurasu, Benny Elian" />
	</head>

	<body>
		<?php include "modules/ScreenResolution.php"; ?>
		<div class="main_box">
			<br />
			Please Login here!<br />
			I'm just a security officer, no cyber criminals, OK!<br />
			<hr />
			<form method="post" action="admin.php">
  				<div><input type="hidden" name="redirect" value="<?php echo $_POST['redirect']; ?>" /></div>
				<div class="box1">
					<div class="username">User ID</div>
					<div class="userform">: <input type="text" name="useradmin" size="31" maxlength="30" value="" /></div>
				</div>
				<div class="box2">
					<div class="passwd">Password</div>
					<div class="passwdform">: <input type="password" name="password" size="31" maxlength="30" /></div>
				</div>
				<div class="box3">
					<div class="imgsource"><img src="IMGcode.php" alt="" /></div>
					<div class="imgform">: <input name="code" type="text" id="txtNumber" value="" size="31" maxlength="5" /></div>
				</div>
				<div class="login"><input name="submit" value=" Login" type="submit" /></div>
			</form>
		</div>
	</body>
</html>
<?php
		}
	}

	else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

	<head>
		<title>Genshiken &#29694;&#35222;&#30740; ITB Authority Page</title>
		<link rel="stylesheet" href="css/admin.css" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Author" content="Amateurasu, Benny Elian" />
	</head>

	<body>
		<?php include "modules/ScreenResolution.php"; ?>
		<div class="main_box">
			<br />
			Please Login here!<br />
			I'm just a security officer, no cyber criminals, OK!<br />
			<hr />
			<form  method="post" action="admin.php">
  				<div><input type="hidden" name="redirect" value="<?php echo $_POST['redirect']; ?>" /></div>
				<div class="box1">
					<div class="username">User ID</div>
					<div class="userform">: <input type="text" name="useradmin" size="31" maxlength="30" value="" /></div>
				</div>
				<div class="box2">
					<div class="passwd">Password</div>
					<div class="passwdform">: <input type="password" name="password" size="31" maxlength="30" /></div>
				</div>
				<div class="box3">
					<div class="imgsource"><img src="IMGcode.php" alt="" /></div>
					<div class="imgform">: <input name="code" type="text" id="txtNumber" value="" size="31" maxlength="5" /></div>
				</div>
				<div class="login"><input name="submit" value=" Login" type="submit" /></div>
			</form>
		</div>
	</body>
</html>
<?php } ?>