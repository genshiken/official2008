<?php

use App\FormGroup;
use App\Globals;
use App\Util;

function EditOfficialProfile()
{

	include "conf.php";
	global $adoObj;

	$sql = "select count(*) as total from official_profile";
  	$total = $adoObj->GetOne($sql);
	if($total < 1)
		{
		$form = new FormGroup("adminutama.php?m=EditOfficialProfile","post");
		$form->setTitle("<div class='title'>Form Editorial Official Profile</div>");

		$form->addEditor("isi_official_profile",$row['isi_official_profile']);
   		$form->groupAsRow("<div class='leftbox'>Official Profile Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

		$form->addSubmit("submit","submit");
		$form->groupAsRow();

		$form->addRule("isi_official_profile","required");

		if($form->submitted() && $form->validateElement())
			{
      		$adoObj->StartTrans();

     		//$description = Globals::getVar("isi_official_profile");
 			$description = $_POST['isi_official_profile'];

     		$sql = "INSERT INTO official_profile (id_official_profile,waktu_upload_official_profile,isi_official_profile) values (1,now(),'$description')";
      		$res = $adoObj->Execute($sql);
      		$adoObj->CompleteTrans();
       		if($res == false)
				{
          	  	Util::alertRedirect('Entry Failed!','adminutama.php?m=BrowseOfficialProfile');
		   		}
			else
				{
            	Util::alertRedirect('Entry Done!','adminutama.php?m=BrowseOfficialProfile');
     			}
   			}
		else
			$form->display();
		}
	else
		{
		$sql = "select * from official_profile";
		$row = $adoObj->GetRow($sql);

		$form = new FormGroup("adminutama.php?m=EditOfficialProfile&id_official_profile=1","post");

		$form->setTitle("<div class='title'>Form Edit Official Profile</div>");

		$form->addEditor("isi_official_profile",$row['isi_official_profile']);
    	$form->groupAsRow("<div class='leftbox'>Official Profile Description</div>");

		$form->addSubmit("submit","submit");
		$form->groupAsRow();

		$form->addRule("isi_official_profile","required");

		if($form->submitted() && $form->validateElement())
			{
	   		$no = Globals::getVar("id_official_profile");

      		$adoObj->StartTrans();

     		$description = $_POST['isi_official_profile'];
     		$sql = "UPDATE official_profile SET waktu_upload_official_profile=now(),isi_official_profile='$description'";

      		$res = $adoObj->Execute($sql);

      		if($res == false)
	  			{
        		Util::alertRedirect('Edit Failed!','adminutama.php?&m=BrowseOfficialProfile');
     			}
			else
				{
           	 	Util::alertRedirect('Edited!','adminutama.php?&m=BrowseOfficialProfile');
     			}
   			}
		else
			$form->display();
		}

}

function BrowseOfficialProfile()
{
	include "conf.php";
    $no = Globals::getVar("id_official_profile");
    $sql = "select * from official_profile";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newsdesc">
					<?php
					echo"". $recordSet->fields['isi_official_profile'];
					?>
				</div>
				<br />
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_official_profile'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditOfficialProfile&id_official_profile=1> Edit</a> &nbsp;&nbsp;
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}

?>
