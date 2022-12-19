<?php

use App\FormGroup;
use App\Globals;
use App\Util;

function EditOfficialHistory()
{

	include "conf.php";
	global $adoObj;

	$sql = "select count(*) as total from official_history";
  	$total = $adoObj->GetOne($sql);
	if($total < 1)
		{
		$form = new FormGroup("adminutama.php?m=EditOfficialHistory","post");
		$form->setTitle("<div class='title'>Form Editorial Official History</div>");

		$form->addEditor("isi_official_history");
   		$form->groupAsRow("<div class='leftbox'>Official History Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");

		$form->addSubmit("submit","submit");
		$form->groupAsRow();

		$form->addRule("isi_official_history","required");

		if($form->submitted() && $form->validateElement())
			{
      		$adoObj->StartTrans();

     		$description = $_POST['isi_official_history'];

     		$sql = "INSERT INTO official_history (id_official_history,waktu_upload_official_history,isi_official_history) values (1,now(),'$description')";
      		$res = $adoObj->Execute($sql);
      		$adoObj->CompleteTrans();
       		if($res == false)
				{
          	  	Util::alertRedirect('Entry Failed!','adminutama.php?&m=BrowseOfficialHistory');
		   		}
			else
				{
            	Util::alertRedirect('Entry Done!','adminutama.php?&m=BrowseOfficialHistory');
     			}
   			}
		else
			$form->display();
		}
	else
		{
		$sql = "select * from official_history";
		$row = $adoObj->GetRow($sql);

		$form = new FormGroup("adminutama.php?m=EditOfficialHistory&id_official_history=1","post");

		$form->setTitle("<div class='title'>Form Edit Official History</div>");

		$form->addEditor("isi_official_history",$row['isi_official_history']);
    	$form->groupAsRow("<div class='leftbox'>Official History Description</div>");

		$form->addSubmit("submit","submit");
		$form->groupAsRow();

		$form->addRule("isi_official_history","required");

		if($form->submitted() && $form->validateElement())
			{
	   		$no = Globals::getVar("id_official_history");

      		$adoObj->StartTrans();

     		//$description = Globals::getVar("isi_official_history");
			$description = $_POST['isi_official_history'];
     		$sql = "UPDATE official_history SET waktu_upload_official_history=now(),isi_official_history='$description'";

      		$res = $adoObj->Execute($sql);

      		if($res == false)
	  			{
        		Util::alertRedirect('Edit Failed!','adminutama.php?&m=BrowseOfficialHistory');
     			}
			else
				{
           	 	Util::alertRedirect('Edited!','adminutama.php?&m=BrowseOfficialHistory');
     			}
   			}
		else
			$form->display();
		}

}

function BrowseOfficialHistory()
{
	include "conf.php";
    $no = Globals::getVar("id_official_history");
    $sql = "select * from official_history";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newsdesc">
					<?php
					echo "". $recordSet->fields['isi_official_history'];
					?>
				</div>
				<br />
				<div class="newsdate">
					<?php
					echo"Posted : ". $recordSet->fields['waktu_upload_official_history'];
					echo"<br />";
					?>
				</div>
			</div>
			<?php
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp;
					<a href=adminutama.php?m=EditOfficialHistory&id_official_history=1> Edit</a> &nbsp;&nbsp;
					<p>&nbsp;</p>";
			$recordSet->MoveNext();
			}
		}
}

?>
