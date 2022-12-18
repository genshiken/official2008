<? 

function AddOfficialAgenda()
{		
	include "conf.php";
	global $adoObj;
	
	$form = new FormGroup("adminutama.php?m=AddOfficialAgenda","post");
	$form->setTitle("<div class='title'>Form Editorial Official Agenda</div>");
	
	$form->addText("judul_official_agenda","",array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Official Agenda Title</div>");
	
	$form->addEditor("isi_official_agenda");
    $form->groupAsRow("<div class='leftbox'>Official Agenda Description</div><div style='font-size:8pt;'>(Default : Verdana, 9pt, Justify)</div>");
	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("judul_official_agenda","required");
	$form->addRule("isi_official_agenda","required");
		
	if($form->submitted() && $form->validateElement())
		{
		$no = $adoObj->PO_Insert_ID('official_agenda','id_official_agenda') + 1;
      	
      	$adoObj->StartTrans();
		
     	//$title = Globals::getVar("judul_official_agenda");
		$title = $_POST['judul_official_agenda'];
		//$description = Globals::getVar("isi_official_agenda");
     	$description = $_POST['isi_official_agenda'];
  
     	$sql = "INSERT INTO official_agenda (id_official_agenda,waktu_upload_official_agenda,judul_official_agenda,isi_official_agenda) values ('$no',now(),'$title','$description')";
      	$res = $adoObj->Execute($sql);
      	$adoObj->CompleteTrans();
        if($res == false)
			{
            Util::alertRedirect('Entry Failed!','adminutama.php?m=ListOfficialAgenda');
		    }
		else
			{
            Util::alertRedirect('Entry Done!','adminutama.php?m=ListOfficialAgenda');
     		}
   		}				
	else
		$form->display();		
}

function ListOfficialAgenda()
{
	?>
	<div class="DiskFreeSpaceBox">
	<?
		global $adoObj;
    	include "conf.php"; 
    	$grid = new GridAdodb($adoObj);
    	$grid->setParamID(array("id_official_agenda"=>0));
    	$grid->setQuery("select id_official_agenda,waktu_upload_official_agenda,judul_official_agenda from official_agenda");
    	
		$grid->setColName(array("Posted"=>"","Title"=>"","Browse"=>"","Edit"=>"","Delete"=>""));
    	$grid->addLinkColumn("adminutama.php","<img src='pics/admin/browse.png' border=no width='14px'>",array("menu"=>"official_agenda","m"=>"BrowseOfficialAgenda"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/edit.png' border=no width='20px'>",array("menu"=>"official_agenda","m"=>"EditOfficialAgenda"));
		$grid->addLinkColumn("adminutama.php","<img src='pics/admin/delete.png' border=no width='16px'>",array("menu"=>"official_agenda","m"=>"DeleteOfficialAgenda"));
    
    	$grid->display();
	?>
	</div>
	<?
}

function BrowseOfficialAgenda()
{
	include "conf.php";
    $no = Globals::getVar("id_official_agenda");
    $sql = "select * from official_agenda where id_official_agenda='$no'";
    $recordSet = $adoObj->Execute($sql);
    if($recordSet !=null)
		{
		while(!$recordSet->EOF)
			{
			?>
			<div class="newsbox">
				<div class="newstitle">
					<?
					echo "&raquo; ". $recordSet->fields['judul_official_agenda'];
					?>
				</div>
				<div class="newsdesc">
					<?				
					echo"". $recordSet->fields['isi_official_agenda'];
					echo"<br />";
					?>
				</div>
				<div class="newsdate">
					<?
					echo"Last Update : ". $recordSet->fields['waktu_upload_official_agenda'];
					echo"<br />";
					?>
				</div>
			</div>
			<?
			echo   "<br />
					<a href='javascript:history.go(-1)'>Back</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=EditOfficialAgenda&id_official_agenda=$no> Edit</a> &nbsp;&nbsp; 
					<a href=adminutama.php?m=DeleteOfficialAgenda&id_official_agenda=$no> Delete</a>
					<p>&nbsp;</p>";
			$recordSet->MoveNext();				
			}
		}
}


function DeleteOfficialAgenda()
{
	global $adoObj, $no;
	
	$no = Globals::getVar('id_official_agenda');
	
    $sql  = "delete from  official_agenda where id_official_agenda='$no'";
        
    $ret = $adoObj->Execute($sql);

	if($ret == false)
		{
        Util::alertRedirect('Delete Failed','adminutama.php?m=ListOfficialAgenda');
     	}
	else
		{
        Util::alertRedirect('Deleted!','adminutama.php?m=ListOfficialAgenda');
     	}
}


function EditOfficialAgenda()
{
	include "conf.php";
		global $adoObj,$no;
	
	
	$no = Globals::getVar('id_official_agenda');
	
	$sql = "select * from official_agenda where id_official_agenda='$no'";
	$row = $adoObj->GetRow($sql);
		
	$form = new FormGroup("adminutama.php?m=EditOfficialAgenda&id_official_agenda=$no","post");
	
	$form->setTitle("<div class='title'>Form Edit Official Agenda</div>");
	
	$form->addHidden("id_official_agenda",$no);
	$form->addText("judul_official_agenda", $row['judul_official_agenda'], array("size"=>80));
	$form->groupAsRow("<div class='leftbox'>Judul Official Agenda</div>");
	  	
	$form->addEditor("isi_official_agenda",$row['isi_official_agenda']);
    $form->groupAsRow("<div class='leftbox'>Official Agenda Description</div>");
    	
	$form->addSubmit("submit","submit");
	$form->groupAsRow();
	
	$form->addRule("judul_official_agenda","required");
	$form->addRule("isi_official_agenda","required");
		
	if($form->submitted() && $form->validateElement())
		{
	   	$no = Globals::getVar("id_official_agenda");
		
      	$adoObj->StartTrans();
        
		//$title = Globals::getVar("judul_official_agenda");  
      	$title = $_POST['judul_official_agenda'];
		//$description = Globals::getVar("isi_official_agenda");
     	$description = $_POST['isi_official_agenda'];
     	
	    $sql = "UPDATE official_agenda SET waktu_upload_official_agenda=now(),judul_official_agenda='$title',isi_official_agenda='$description' where id_official_agenda='$no'";
      	      
      	$res = $adoObj->Execute($sql);
        
      	if($res == false)
	  		{
        	Util::alertRedirect('Edit Failed!','adminutama.php?m=ListOfficialAgenda');
     		}
		else
			{
            Util::alertRedirect('Edited!','adminutama.php?m=ListOfficialAgenda');
     		}
   		}		
	else
		$form->display();
}

?>