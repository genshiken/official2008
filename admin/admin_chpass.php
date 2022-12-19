<?php

use App\FormGroup;
use App\Util;

function ChangePassword()
{
  include "conf.php";
  global $adoObj;

  /*
  Table Properties :
  id_chpass			bigint(20)		primary key,
  explain_chpass	LONGTEXT	NOT NULL,
  waktu_chpass		datetime,
  isi_chpass		longtext
  */

  $CreateChPass = "CREATE TABLE IF NOT EXISTS chpass
  (
    id_chpass		INT	NOT NULL	PRIMARY KEY,
	explain_chpass	LONGTEXT	NOT NULL,
    waktu_chpass	DATETIME	NOT NULL,
	isi_chpass		LONGTEXT	NOT NULL
  )";
  $ExecuteCreateChPass = $adoObj->execute($CreateChPass);

  $sql = "select count(*) as total from chpass";
  	$total = $adoObj->GetOne($sql);
	if($total < 1)
		{
		$form = new FormGroup("adminutama.php?m=ChangePassword","post");
		$form->setTitle("<div class='title'>Change Password</div>");

		//$form->addString("<div class='leftbox'>Current Account Name</div>","<div class='leftbox'>".$username."</div>");
		//$form->addString("<div class='leftbox'>Current Password</div>","<div class='leftbox'>".$password."</div>");

		$form->addText("isi_chpass1","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>Current Account Name</div>");

		$form->addText("isi_chpass2","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>Current Password</div>");

		$form->addText("isi_chpass3","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>New Account Name</div>");
		$form->addString("<div style='font-size:8pt;'>(leave blank won't change account name)</div>","<div></div>");

		$form->addText("isi_chpass4","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>New Password</div>");
		$form->addString("<div style='font-size:8pt;'>(leave blank won't change password)</div>","<div></div>");

		$form->addSubmit("submit","submit");
		$form->groupAsRow();

		$form->addRule("isi_chpass1","required");
		$form->addRule("isi_chpass2","required");

		if($form->submitted() && $form->validateElement())
			{
      		$adoObj->StartTrans();

			$description1 = $_POST['isi_chpass1'];
			$description2 = $_POST['isi_chpass2'];
     		$description3 = $_POST['isi_chpass3'];
			$description4 = $_POST['isi_chpass4'];

  			if(($description1 == $username) && ($description2 == $password))
				{
				if((strlen($description3) && strlen($description4)) != 0)
					{
     				$sql1 = "INSERT INTO chpass (id_chpass,explain_chpass,waktu_chpass,isi_chpass) values (1,'Account Name',now(),'$description3')";
					$sql2 = "INSERT INTO chpass (id_chpass,explain_chpass,waktu_chpass,isi_chpass) values (2,'Password',now(),'$description4')";
	      			$res1 = $adoObj->Execute($sql1);
					$res2 = $adoObj->Execute($sql2);
					$adoObj->CompleteTrans();
					if((($res1 && $res2) || ($res1 || $res2)) == false)
						{
          	  			Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
		   				}
					else
						{
            			Util::alertRedirect('Entry Done!','adminutama.php?m=ConfirmPassword');
     					}
					}
				elseif((strlen($description3) == 0) && (strlen($description4) !=0))
					{
     				$sql1 = "INSERT INTO chpass (id_chpass,explain_chpass,waktu_chpass,isi_chpass) values (1,'Account Name',now(),'$username')";
					$sql2 = "INSERT INTO chpass (id_chpass,explain_chpass,waktu_chpass,isi_chpass) values (2,'Password',now(),'$description4')";
      				$res1 = $adoObj->Execute($sql1);
					$res2 = $adoObj->Execute($sql2);
					$adoObj->CompleteTrans();
					if((($res1 && $res2) || ($res1 || $res2)) == false)
						{
          	  			Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
		   				}
					else
						{
            			Util::alertRedirect('Entry Done!','adminutama.php?m=ConfirmPassword');
     					}
					}
				elseif((strlen($description3) != 0) && (strlen($description4) ==0))
					{
    	 			$sql1 = "INSERT INTO chpass (id_chpass,explain_chpass,waktu_chpass,isi_chpass) values (1,'Account Name',now(),'$description3')";
					$sql2 = "INSERT INTO chpass (id_chpass,explain_chpass,waktu_chpass,isi_chpass) values (2,'Password',now(),'$password')";
      				$res1 = $adoObj->Execute($sql1);
					$res2 = $adoObj->Execute($sql2);
					$adoObj->CompleteTrans();
					if((($res1 && $res2) || ($res1 || $res2)) == false)
						{
          	  			Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
		   				}
					else
						{
            			Util::alertRedirect('Entry Done!','adminutama.php?m=ConfirmPassword');
     					}
					}
				else
					{
					Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
					}
				}
			else
				{
				Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
				}

   			}
		else
			$form->display();
		}
	else
		{
		$sql1 = "select * from chpass where id_chpass=1";
		$sql2 = "select * from chpass where id_chpass=2";
		$recordSet1 = $adoObj->Execute($sql1);
		$recordSet2 = $adoObj->Execute($sql2);

		$old_username = $recordSet1->fields['isi_chpass'];
		$old_password = $recordSet2->fields['isi_chpass'];

		$form = new FormGroup("adminutama.php?m=ChangePassword","post");
		$form->setTitle("<div class='title'>Change Password</div>");

		//$form->addString("<div class='leftbox'>Current Account Name</div>","<div class='leftbox'>".$old_username."</div>");
		//$form->addString("<div class='leftbox'>Current Password</div>","<div class='leftbox'>".$old_password."</div>");

		$form->addText("isi_chpass1","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>Current Account Name</div>");

		$form->addText("isi_chpass2","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>Current Password</div>");

		$form->addText("isi_chpass3","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>New Account Name</div>");
		$form->addString("<div style='font-size:8pt;'>(leave blank won't change account name)</div>","<div></div>");

		$form->addText("isi_chpass4","",array("size"=>80));
   		$form->groupAsRow("<div class='leftbox'>New Password</div>");
		$form->addString("<div style='font-size:8pt;'>(leave blank won't change password)</div>","<div></div>");

		$form->addSubmit("submit","submit");
		$form->groupAsRow();

		$form->addRule("isi_chpass1","required");
		$form->addRule("isi_chpass2","required");

		if($form->submitted() && $form->validateElement())
			{
      		$adoObj->StartTrans();

			$description1 = $_POST['isi_chpass1'];
			$description2 = $_POST['isi_chpass2'];
     		$description3 = $_POST['isi_chpass3'];
			$description4 = $_POST['isi_chpass4'];

  			if(($description1 == $old_username) && ($description2 == $old_password))
				{
     			if((strlen($description3) && strlen($description4)) != 0)
					{
     				$sql1 = "UPDATE chpass SET isi_chpass='$description3' WHERE id_chpass='1'";
					$sql2 = "UPDATE chpass SET isi_chpass='$description4' WHERE id_chpass='2'";
    	  			$res1 = $adoObj->Execute($sql1);
					$res2 = $adoObj->Execute($sql2);
					$adoObj->CompleteTrans();
					if((($res1 && $res2) || ($res1 || $res2)) == false)
						{
          	  			Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
		   				}
					else
						{
            			Util::alertRedirect('Entry Done!','adminutama.php?m=ConfirmPassword');
     					}
					}
				elseif((strlen($description3) == 0) && (strlen($description4) !=0))
					{
    	 			$sql1 = "UPDATE chpass SET isi_chpass='$old_username' WHERE id_chpass='1'";
					$sql2 = "UPDATE chpass SET isi_chpass='$description4' WHERE id_chpass='2'";
      				$res1 = $adoObj->Execute($sql1);
					$res2 = $adoObj->Execute($sql2);
					$adoObj->CompleteTrans();
					if((($res1 && $res2) || ($res1 || $res2)) == false)
						{
          	  			Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
		   				}
					else
						{
            			Util::alertRedirect('Entry Done!','adminutama.php?m=ConfirmPassword');
     					}
					}
				elseif((strlen($description3) != 0) && (strlen($description4) ==0))
					{
     				$sql1 = "UPDATE chpass SET isi_chpass='$description3' WHERE id_chpass='1'";
					$sql2 = "UPDATE chpass SET isi_chpass='$old_password' WHERE id_chpass='2'";
    	  			$res1 = $adoObj->Execute($sql1);
					$res2 = $adoObj->Execute($sql2);
					$adoObj->CompleteTrans();
					if((($res1 && $res2) || ($res1 || $res2)) == false)
						{
          	  			Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
		   				}
					else
						{
            			Util::alertRedirect('Entry Done!','adminutama.php?m=ConfirmPassword');
     					}
					}
				else
					{
					}
				}
			else
       			{
				Util::alertRedirect('Entry Failed! Nothing Changed!','adminutama.php');
				}
   			}
		else
			$form->display();
		}
}

function ConfirmPassword()
{
	include "conf.php";
	$sql = "select * from chpass where id_chpass=1";
	$recordSet = $adoObj->Execute($sql);
	?>
	<div class="newsbox">
		<div class="newstitle">
			<?php
			echo "Notification...";
			?>
		</div>
		<div class="newsdesc">
			<?php
			echo "Username & Password Changed!";
			echo"<br />";
			?>
		</div>
		<div class="newsdate">
			<?php
			echo"Last Updated : ". $recordSet->fields['waktu_chpass'];
			echo"<br />";
			?>
		</div>
	</div>
	<?php
}
?>
