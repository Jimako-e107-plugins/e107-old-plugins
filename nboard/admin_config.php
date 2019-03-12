<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
require_once("../../class2.php");
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."file_class.php");
if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
    }
include_lan(e_PLUGIN."nboard/languages/".e_LANGUAGE.".php");
if (e_QUERY)
{
  $qs = explode(".", e_QUERY);
}
$vis = 'none';
$unvis = 'yes';
// =================================================================================================
//				               CAT OPTIONS MENU
// =================================================================================================
if((isset($qs[0]) && $qs[0] == "cat")){
	$cat_id = $_POST['cat_id'];
	$cat_sub_id = 0;
	$cat_name = $_POST['cat_name'];
	$cat_desc = $_POST['cat_desc'];
	$cat_icon = $_POST['cat_icon'];
//======Edit_notes======//
if (IsSet($_POST['submit_edit'])){
	if ($cat_id == ''){ $message = "<font color=red>".NB_MES_01."</font>";
	$ns -> tablerender(NB_MES_00, $message);
	}
	else{
	$sql -> db_Select("nb_cat", "*", "cat_id ='$cat_id'");
		while($row = $sql -> db_Fetch()){
			$cat_name = $row['cat_name'];
			$cat_desc = $row['cat_desc'];
			$cat_icon = $row['cat_icon'];
		}
	$vis = 'yes';
	$unvis = 'none';
	}
}
//======Delete_notes======//
if (IsSet($_POST['submit_delete'])){
	$sql -> db_Delete("nb_cat", "cat_id='$cat_id'");
}
//======Insert_notes======//
if (IsSet($_POST['submit_insert'])){
	if ($cat_name == ""){ 
		$message = "<font color=red>".NB_MES_04."</font>";
	}
	else {
		$sql = new db;
		$sql -> db_Insert("nb_cat", "0, '$cat_sub_id', '$cat_name', '$cat_desc', '$cat_icon'");
	$message = "<font color=red>".NB_MES_05."</font>";
	$cat_id=$cat_name=$cat_desc=$cat_icon='';
	header ("Location: ".e_PLUGIN."nboard/admin_config.php?cat");
	exit;
	}
$ns -> tablerender(NB_MES_00, $message);
}
//======Update_notes======//	
	if (IsSet($_POST['submit_update'])){
	$sql -> db_Update("nb_cat", "cat_sub_id='$cat_sub_id', cat_name='$cat_name', cat_desc='$cat_desc', cat_icon='$cat_icon' WHERE cat_id='$cat_id'");
		$message = "<font color=red>".NB_MES_06."</font>";
		$ns -> tablerender(NB_MES_00, $message);
	$cat_id=$cat_name=$cat_desc=$cat_icon='';
	$vis = 'none';
	$unvis = 'yes';
	}
//======Reset_notes======//
	if (IsSet($_POST['submit_reset'])){
	$cat_id = $cat_name = $cat_desc = $cat_icon = '';
	$vis = 'none';
	$unvis = 'yes';
	}
//========================================form select============================
	$text ="<form name='form_select_cat' method='post' action=''><table class='fborder' width='100%'>";
        $text .= "<tr><td class='forumheader3' width='30%'>".NB_CAT_02."</td><td class='forumheader3' width='70%'><select class='tbox' name='cat_id'><option value=''>".NB_CAT_05."";
		$sql -> db_Select("nb_cat", "*", "cat_sub_id='0'");
                while($row = $sql -> db_Fetch()){
			$catId= $row['cat_id'];
			$catName = $row['cat_name'];
			$text .="<option value='$catId'>$catName";
		}
	$text .="</select></td></tr>";
	$text .="<tr><td class='forumheader' style='text-align:center' colspan='2'>
	<input type='submit' class='button' style='cursor:pointer;' value=".NB_BUT_EDIT." name='submit_edit'>
	<input type='submit' class='button' style='cursor:pointer;' value=".NB_BUT_DEL." name='submit_delete' onclick='return confirmDeleteCat();'></td></tr>";
	$text .="</table></form>";
$caption = NB_CAT_00;
$ns -> tablerender($caption, $text);
//=============================form new category=================================
	$text ="<form name='insert_cat' enctype='multipart/form-data' method='post' action=''><table class='fborder' style='width:100%'>";
	$text .= "<tr><td class='forumheader3' width='30%'>".NB_CAT_03."</td>
		<td class='forumheader3' width='70%'><input  class='tbox' type='text' name='cat_name' value='$cat_name' size='60'><input type='text' name='cat_id' value='$cat_id' style='display:none;'></td></tr>";
	$text .= "<tr><td class='forumheader3' width='30%'>".NB_CAT_04."</td><td class='forumheader3' width='70%'><input class='tbox' type='text' name='cat_desc' value='$cat_desc' size='60'></td></tr>";
//===============================select cat_icon=================================
        $fl = new e_file;
if($iconlist = $fl->get_files(e_PLUGIN."nboard/theme/icons_cat/", ".jpg|.gif|.png|.JPG|.GIF|.PNG")){
        sort($iconlist);
}
	$text .= "<tr>
		<td style='width:30%' class='forumheader3'>".NB_IMG_02." </td>
		<td style='width:70%' class='forumheader3'><input class='tbox' type='text' id='cat_icon' name='cat_icon' value='$cat_icon' size='40' maxlength='100' />
		<input type ='button' class='button' style='cursor:pointer' size='30' value='".NB_IMG_03."' onclick='expandit(this)' />
		<div id='linkicn' style='display:none;{head}'>";
		foreach($iconlist as $icon){
			$list_icon = str_replace(e_PLUGIN."nboard/theme/icons_cat/","",$icon['path'].$icon['fname']);
			$text .= "<a href=\"javascript:insertext('".$list_icon."','cat_icon','linkicn')\"><img src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
		}
	$text .= "</div></td></tr>";
	$text .= "<tr><td class='forumheader'></td><td class='forumheader'>
		<input type='submit' class='button' style='cursor:pointer;display:$unvis' value=".NB_BUT_AGR." name='submit_insert'>
		<input type='submit' class='button' style='cursor:pointer;display:$vis' value=".NB_BUT_UPD." name='submit_update'>
		<input type='submit' class='button' style='cursor:pointer;display:$vis' value=".NB_BUT_CANS." name='submit_reset'>
		</td></tr></table></form>";
$caption = NB_CAT_00;
$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
exit;
}
// =================================================================================================
//				           SUBCAT OPTIONS MENU
// =================================================================================================
if((isset($qs[0]) && $qs[0] == 'subcat')){
	$cat_id = $_POST['cat_id'];
	$catId = $_POST['catId'];
	$cat_sub_id = $_POST['cat_sub_id'];
	$cat_name = $_POST['cat_name'];
	$cat_desc = $_POST['cat_desc'];
	$cat_icon = $_POST['cat_icon'];
//======Edit_notes======//		
if (IsSet($_POST['submit_edit'])){
	$sql -> db_Select("nb_cat", "*", "cat_id ='$cat_id'");
	if ($cat_id == ''){ $message = "<font color=red>".NB_MES_01."</font>";
	$ns -> tablerender(NB_MES_00, $message);
	}
	else{
		while($row = $sql -> db_Fetch()){
			$cat_sub_id = $row['cat_sub_id'];
			$cat_name = $row['cat_name'];
			$cat_desc = $row['cat_desc'];
			$cat_icon = $row['cat_icon'];
		}
	$sql -> db_Select("nb_cat", "*", "cat_id='$cat_sub_id'");
                while($row = $sql -> db_Fetch()){
			$catName1 = $row['cat_name'];
			$catSub = $row['cat_id'];
		}
	$vis = 'yes';
	$unvis = 'none';
	}
}
//======Delete_notes======//
if (IsSet($_POST['submit_delete'])){
	$sql -> db_Delete("nb_cat", "cat_id='$cat_id'");
}
//======Insert_notes======//
if (IsSet($_POST['submit_insert'])){
	if ($cat_name == ""){ 
	$message = "<font color=red>".NB_MES_11."</font>";
	}
	else {
		$sql = new db;
		$sql -> db_Insert("nb_cat", "0, '$catId', '$cat_name', '$cat_desc', '$cat_icon'");
		$message = "<font color=red>".NB_MES_12."</font>";
		$cat_id=$cat_sub_id=$cat_name=$cat_desc=$cat_icon='';
		header ("Location: ".e_PLUGIN."nboard/admin_config.php?subcat");
		exit;
		}
	$ns -> tablerender(NB_MES_00, $message);		
}
//======Update_notes======//	
if (IsSet($_POST['submit_update'])){
	$catIdedit = $_POST['catIdedit'];
	$sql -> db_Update("nb_cat", "cat_sub_id='$catIdedit', cat_name='$cat_name', cat_icon='$cat_icon' WHERE cat_id='$cat_id'");
	$message = "<font color=red>".NB_MES_13."</font>";	
	$cat_id=$cat_sub_id=$cat_name=$cat_desc=$cat_icon='';
	$vis = 'none';
	$unvis = 'yes';
	$ns -> tablerender(NB_MES_00, $message);
}
//======Reset_notes======//
if (IsSet($_POST['submit_reset'])){
	$cat_id = $cat_name = $cat_desc = $cat_icon = '';
	$vis = 'none';
	$unvis = 'yes';
}
//========================================form select============================
	$text ="<form name='form_select_subcat' method='post' action='' enctype='multipart/form-data'><table class='fborder' style='width:100%'>";
	$text .="<tr><td class='forumheader3'>" .NB_CAT_02." </td><td class='forumheader3'>
	<select class='tbox' name='' id='cat' onChange='process()'>
	<option value=''>" .NB_SCAT_07."";
		$sql -> db_Select("nb_cat", "*", "cat_sub_id='0'");
                while($row = $sql -> db_Fetch()){
			$catId = $row['cat_id'];
			$catName = $row['cat_name'];
			$text .="<option value='$catId'>$catName";
			}
	$text .="</option></select></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_SCAT_01."</td><td class='forumheader3' width='70%'>
		<select class='tbox' name='cat_id' id='sub' onblur='checkcat()' value='$cat_sub_id'><option value=''>".NB_SCAT_05."";
	$text .="</select></td></tr>";	
	$text .="<tr><td class='forumheader' style='text-align:center' colspan='2'>
	<input type='submit' class='button' style='cursor:pointer;' value=".NB_BUT_EDIT." name='submit_edit'>
	<input type='submit' class='button' style='cursor:pointer;' value=".NB_BUT_DEL." name='submit_delete' onclick='return confirmDeleteSubcat();'>
	</td></tr></table></form>";
$caption = NB_SCAT_00;
$ns -> tablerender($caption, $text);
//=============================form new subcategory==============================
	$text ="<form enctype='multipart/form-data' name='new_note' method='post' action=''><table class='fborder' style='width:100%'>";
        $text .= "<tr><td class='forumheader3'>".NB_CAT_02."</td><td class='forumheader3' width='80%'>
		<font color=red style='cursor:pointer;display:$vis'>".NB_SCAT_06."</font>";
	$text .= "<select class='tbox' name='catIdedit' style='display:$vis'><option value='$catSub'>$catName1";
		$sql -> db_Select("nb_cat", "*", "cat_sub_id='0'");
                while($row = $sql -> db_Fetch()){
			$catId = $row['cat_id'];
			$catName1 = $row['cat_name'];
			$text .="<option value='$catId'>$catName1";
		}
	$text .="</select>";
	$text .= "<select class='tbox' name='catId' style='display:$unvis'><option value=''>".NB_SCAT_07."";
		$sql -> db_Select("nb_cat", "*", "cat_sub_id='0'");
                while($row = $sql -> db_Fetch()){
			$catId = $row['cat_id'];
			$catName = $row['cat_name'];
			$text .="<option value='$catId'>$catName";
		}
	$text .="</select></td></tr>";
	$cat_sub_id = $catId;
	$text .= "<tr><td class='forumheader3'>".NB_SCAT_03." </td><td class='forumheader3' width='80%'>
			<input type='text' name='cat_name' size='36' class='tbox' value='$cat_name'>
			<input type='hidden' name='cat_sub_id' value='$cat_sub_id'>
			<input type='hidden' name='cat_id' value='$cat_id'></td></tr>";
//===============================select cat_icon=================================
        $fl = new e_file;
        if($iconlist = $fl->get_files(e_PLUGIN."nboard/theme/icons_subcat/", ".jpg|.gif|.png|.JPG|.GIF|.PNG")){
        	sort($iconlist);
        }
	$text .= "<tr>
		<td style='width:30%' class='forumheader3'>".NB_IMG_02." </td>
		<td style='width:70%' class='forumheader3'><input class='tbox' type='text' id='cat_icon' name='cat_icon'  value='$cat_icon' size='36' maxlength='100' />
		<input class='button' type ='button' style='cursor:pointer' size='30' value='".NB_IMG_03."' onclick='expandit(this)' />
		<div id='linkicn' style='display:none;{head}'>";
		foreach($iconlist as $icon){
			$list_icon = str_replace(e_PLUGIN."nboard/theme/icons_subcat/","",$icon['path'].$icon['fname']);
			$text .= "<a href=\"javascript:insertext('".$list_icon."','cat_icon','linkicn')\"><img src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
		}
	$text .= "<tr><td class='forumheader'>&nbsp;</td><td class='forumheader'>
		<input type='submit' class='button' style='cursor:pointer;display:$unvis' value=".NB_BUT_AGR." name='submit_insert'>
		<input type='submit' class='button' style='cursor:pointer;display:$vis' value=".NB_BUT_UPD." name='submit_update'>
		<input type='submit' class='button' style='cursor:pointer;display:$vis' value=".NB_BUT_CANS." name='submit_reset'>
			</td></tr></table></form>";
$caption = NB_SCAT_00;
$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
exit;
}
// =================================================================================================
//				           MANAGER NOTICE MENU
// =================================================================================================
if((isset($qs[0]) && $qs[0] == "notice")){
	$gnl_id = $_POST['gnl_id'];
	$gnl_scatid = $_POST['cat_name'];
	$gnl_name = $_POST['gnl_name'];
	$gnl_city = $_POST['gnl_city'];
	$gnl_detail = $_POST['gnl_detail'];
	$gnl_price = $_POST['gnl_price'];
	$gnl_user=$_POST['gnl_user'];	
	$gnl_email=$_POST['gnl_email'];
	$gnl_phone = $_POST['gnl_phone'];
	$days = $_POST['days'];	
	$gnl_date_start = date("d-m-Y");
	$gnl_date_end =date("d-m-Y" , strtotime("+ $days day"));
if (isset($_POST['submit_delete'])){
	$sql -> db_Select("nb_gnl", "*", "gnl_id='$gnl_id'");
 		while($row = $sql -> db_Fetch()){
			$gnl_pic1 = $row['gnl_pic1'];
		}
	if (!$gnl_pic1 == ''){
		unlink("".e_PLUGIN."nboard/nb_pictures/small_$gnl_pic1");
		unlink("".e_PLUGIN."nboard/nb_pictures/$gnl_pic1");
	}
	$sql -> db_Delete("nb_gnl", "gnl_id=$gnl_id");
	
}	
if(IsSet($_POST['submit_edit'])){
	$sql -> db_Select("nb_gnl", "*", "gnl_id='$selected'");
		while($row = $sql -> db_Fetch()){
			$gnl_name=$row['gnl_name'];
			$gnl_scatid=$row['gnl_scatid'];
			$gnl_city=$row['gnl_city'];
			$gnl_detail=$row['gnl_detail'];
			$gnl_picbig=$row['gnl_picbig'];
			$gnl_picsmall=$row['gnl_picsmall'];
			$gnl_price=$row['gnl_price'];
			$gnl_user=$row['gnl_user'];
			$gnl_phone=$row['gnl_phone'];
			$gnl_email=$row['gnl_email'];
			$gnl_date_start=$row['gnl_date_start'];
			$gnl_date_end=$row['gnl_date_end'];
		}
	}
if (isset($_POST['submit_update'])){
		$sql -> db_Update("nb_gnl", "gnl_id='$sele', gnl_name='$gnl_name', gnl_city='$gnl_city',  gnl_detail='$gnl_detail', gnl_price = '$gnl_price', gnl_user='$gnl_user', gnl_phone='$gnl_phone', gnl_email='$gnl_email', gnl_date_start='$gnl_date_start', gnl_date_end='$gnl_date_end' WHERE gnl_id=$sele");
}
//-------------------form_selected----------------------
$text="<form  method='post' enctype='multipart/form-data' name='form_not_select' action=''>
	<table class='border' style='width:100%' align='center'>";
$text.="<tr><td class='forumheader2'>".NB_NOT_01."</td><td class='forumheader2' width='70%'>
	<select class='tbox' name='gnl_id'><option value=''>".NB_NOT_02."</option>";
$sql -> db_Select("nb_gnl");
	while($row = $sql -> db_Fetch()){
		$gnlId = $row['gnl_id'];
		$gnlName=$row['gnl_name'];
		$text .="<option value='$gnlId'>$gnlName</option>";
	}
$text.="</select></td></tr><tr><td class='forumheader2' style='text-align:center' colspan='2'>
	<input class='button' style='cursor:pointer' type='Submit' name='submit_delete' value='".NB_BUT_DEL."' onclick='return confirmDeleteNotice();'>
	<input class='button' style='cursor:pointer' type='submit' name='submit_edit' value='".NB_BUT_EDIT."'>
	</td></tr></table></form>";
$caption = NB_NOT_00;
$ns -> tablerender($caption, $text);
//-------------------form_edit----------------------
$text="<form  method='post' enctype='multipart/form-data' name='form_not_edit' action=''>
	<table class='border' style='width:100%' align='center'>";
$text.="<tr><td class='forumheader2'>".NB_NOT_03." *</td><td class='forumheader2'>
	<input type='text' class='tbox' name='gnl_name' value='$gnl_name'></td></tr>";
$text.="<tr><td class='forumheader2'>".NB_NOT_04." *</td><td class='forumheader2'>
	<input type='text' class='tbox' name='gnl_name' value='$gnl_scatid'></td></tr>";
$text.="<tr><td class='forumheader2'>".NB_NOT_05." *</td><td class='forumheader2'>
	<input type='text' class='tbox' name='gnl_name' value='$gnl_cat'></td></tr>";
$text.="<tr><td class='forumheader2'>".NB_IMG_04."</td><td class='forumheader2' width='70%'>
	</td></tr>";
$text.="<tr><td class='forumheader2'>".NB_NOT_06." *</td><td class='forumheader2'>
	<textarea class='tbox' name='gnl_detail' cols=35 rows=10>$gnl_detail</textarea></td>";
$text.="<tr><td class='forumheader2'>".NB_NOT_07." *</td><td class='forumheader2'>
	<input class='tbox' type='text' name='gnl_price' value='$gnl_price'></td>";
$text.="<tr><td class='forumheader2' width='30%'>".NB_NOT_08." *</td><td class='forumheader2' width='70%'>
	<input type='text' class='tbox' name='gnl_user' value='$gnl_user'></td>";
$text.="<tr><td class='forumheader2'>".NB_NOT_09." *</td><td class='forumheader2'>
	<input type='text' class='tbox' name='gnl_city' value='$gnl_city'></td>";
$text.="<tr><td class='forumheader2'>".NB_NOT_10." *</td><td class='forumheader2'>
	<input class='tbox' type='text' name='gnl_phone' value='$gnl_phone'></td>";
$text.="<tr><td class='forumheader2'>".NB_NOT_11."</td><td class='forumheader2' width='70%'>
	<input class='tbox' type='text' name='gnl_email' value='$gnl_email'></td>";
$text.="<tr><td class='forumheader2'>".NB_NOT_12."*</td> <td class='forumheader2'><select class='tbox' name='days'>";
	$text.= "<option value=''></option>";
	$text.= "<option value='15'>".NB_COL_02."</option>";
	$text.= "<option  value='30'>".NB_COL_03."</option>";
	$text.= "</select>";
$text.="<input type='hidden' name='gnl_date_start' class='tbox' style='width:150px' value='$gnl_date_start'>
	<input type='hidden' name='gnl_date_end' class='tbox' style='width:150px' value='$gnl_date_end'></td></tr>";
$text.="<tr><td class='forumheader2'></td><td class='forumheader2'>
	<input class='button' style='cursor:pointer' type='submit' name='submit_update' value='".NB_BUT_UPD."'>
	<input class='button' style='cursor:pointer' type='submit' name='submit_reset' id='otmena' value=".NB_BUT_RES." onClick='otmena()'>
	</td></tr></table></form>";
$caption = NB_NOT_00;
$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
exit;
}
// =================================================================================================
//				           BANNERS OPTIONS MENU
// =================================================================================================
if((isset($qs[0]) && $qs[0] == 'banners')){
	$ban_id=$_POST['ban_id'];
	$ban_catid =$_POST['ban_catid'];
	$now_date = date('d-m-Y');
	$ban_action = $_POST['ban_action'];
	$ban_org = $_POST['ban_org'];
	$ban_url = $_POST['ban_url'];
	$ban_datebegin = $_POST['ban_datebegin'];
	$ban_dateend = $_POST['ban_dateend'];
	$ban_images = $_POST['ban_images'];
	$cat_name = $_POST['cat_name'];
//======Insert_notes======//
if(IsSet($_POST['submit_insert'])){
	if ($ban_action == ""){
		$sql = new db;
		$sql -> db_Insert("nb_ban", "0, '$ban_catid', '$ban_org', '$ban_url', '$ban_datebegin', '$ban_dateend', '$ban_images'");
	header ("Location: ".e_PLUGIN."nboard/admin_config.php?baners");
	exit;
	}
}
//======Edit_notes======//
if (isset($_POST['submit_edit'])){
	$vis = 'yes';
	$unvis = 'none';
	$sql -> db_Select("nb_ban", "*", "ban_id=$ban_id");
	while($row = $sql -> db_Fetch()){
		$ban_id = $row['ban_id'];
		$ban_catid = $row['ban_catid'];
		$ban_org = $row['ban_org'];
		$ban_url = $row['ban_url'];
		$ban_datebegin = $row['ban_datebegin'];
		$ban_dateend = $row['ban_dateend'];
		$ban_images = $row['ban_images'];
	}
}
//======Update_notes======//
if (isset($_POST['submit_update'])){
	$sql -> db_Update("nb_ban", "ban_catid='$ban_catid', ban_org='$ban_org', ban_url='$ban_url', ban_datebegin='$ban_datebegin', ban_dateend='$ban_dateend', ban_images='$ban_images' WHERE ban_id='$ban_id'");
	$message = NB_MES_23;
	$ns -> tablerender($caption, $message);
	$ban_id =$ban_cati =$ban_org=$ban_url=$ban_datebegin=$ban_dateend=$ban_images='';
	$vis = 'none';
	$unvis = 'yes';
}
//======Delete_notes======//
if(IsSet($_POST['submit_delete'])){
	$sql -> db_Delete("nb_ban", "ban_id='$ban_id'");
}
//======Reset_notes======//
	if (IsSet($_POST['submit_reset'])){
	$ban_org=$ban_url=$ban_datebegin=$ban_dateend=$ban_id='';
	$vis = 'none';
	$unvis = 'yes';
	}
//======Form Banners=========//
$text ="<form name='banner_add' method='post' action='' enctype='multipart/form-data'><table class='fborder' style='width:100%'>";
	$text .= "<tr><td class='forumheader3'>".NB_BAN_01."</td><td class='forumheader3' width='70%'>
		<input type=hidden name='ban_id' value='$ban_id'>
		<select class='tbox' name='ban_catid' id='cat'>";
	
	$text .="<option value=''>".NB_BAN_02."";
	$text .="<option value='0'>".NB_BAN_10."";
	$text .="<option value='all_pages'>".NB_BAN_11."";
		$sql -> db_Select("nb_cat", "*", "cat_sub_id='0'");
                while($row = $sql -> db_Fetch()){
			$catId = $row['cat_id'];
			$catName = $row['cat_name'];
			$text .="<option value='$catId'>$catName";
		}
	$text .="</select></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_BAN_03."</td><td class='forumheader3' width='80%'><input size='36' type='text' name='ban_org' class='tbox' value='$ban_org'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_BAN_04."</td><td class='forumheader3' width='80%'><input size='36' type='text' name='ban_url' class='tbox' value='$ban_url'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_BAN_05."</td><td class='forumheader3' width='80%'><input size='16' type='text' name='ban_datebegin' class='tbox' value='$ban_datebegin' onclick='event.cancelBubble=true;this.select();lcs(this)' <script src='".e_PLUGIN."nboard/js/calendar_ru.js'></script><style>
	input {border:1px solid #ABABAB}
	</style> / <input size='16' type='text' name='ban_dateend' class='tbox' value='$ban_dateend' onfocus='this.select();lcs(this)' onclick='event.cancelBubble=true;this.select();lcs(this)' <script src='".e_PLUGIN."nboard/js/calendar_ru.js'></script></td></tr>";
	$fl = new e_file;
        if($iconlist = $fl->get_files(e_PLUGIN."nboard/banners/", ".jpg|.gif|.png|.JPG|.GIF|.PNG")){
        	sort($iconlist);
        }
	$text .= "<tr>
		<td style='width:30%' class='forumheader3'>".NB_BAN_07." </td>
		<td style='width:70%' class='forumheader3'><input class='tbox' type='text' id='ban_images' name='ban_images' value='$ban_images' size='36' maxlength='100' />
		<input class='button' type ='button' style='cursor:pointer' size='30' value='".NB_BAN_08."' onclick='expandit(this)' />
		<div id='linkicn' style='display:none;{head}'>";
		foreach($iconlist as $icon){
			$list_icon = str_replace(e_PLUGIN."nboard/banners/","",$icon['path'].$icon['fname']);
			$text .= "<a href=\"javascript:insertext('".$list_icon."','ban_images','linkicn')\"><img src='".$icon['path'].$icon['fname']."' width='200px' style='border:0' alt='' /></a> ";
		}
	$text .="<tr><td class='forumheader' style='text-align:center' colspan='2'>
			<input class='button' style='cursor:pointer;display:$unvis' type='submit' value=".NB_BUT_AGR." name='submit_insert'>
			<input class='button' style='cursor:pointer;display:$unvis' type='submit' value=".NB_BUT_RES." name='submit_reset'>
			<input class='button' style='cursor:pointer;display:$vis' type='submit' value=".NB_BUT_UPD." name='submit_update'>
			<input class='button' style='cursor:pointer;display:$vis' type='submit' value=".NB_BUT_CANS." name='submit_reset'>
			</td></tr></table></form>";
$caption = NB_BAN_00;
$ns -> tablerender($caption, $text);
//=============================form edit and delete ========================
$text ="<form name='form_banner_edit' method='post' action='$ban_action' enctype='multipart/form-data'><table class='fborder' style='width:100%'>";
	$text .= "<tr><td class='forumheader3'>".NB_BAN_03."</td><td class='forumheader3' width='70%'><input type=hidden name='cat_name' value=''><select class='tbox' name='ban_id' id='cat'>";
	$sql -> db_Select("nb_ban", "*", "");
	while($row = $sql -> db_Fetch()){
		$banId = $row["ban_id"];
		$banOrg = $row["ban_org"];
	$text .="<option value='$banId'>$banOrg";
	}
	$text .="</select>";
	$text .=" <input class='button' style='cursor:pointer;' type='submit' name='submit_edit' value=".NB_BUT_EDIT."> <input class='button' style='cursor:pointer;' type='submit' name='submit_delete' value=".NB_BUT_DEL." onclick='return confirmDeleteBan();'>";
$text .="</td></tr>";
$text .="</table></form>";
$caption = NB_BAN_00;
$ns -> tablerender($caption, $text);
//=============================form all banner==============================
$text ="<form enctype='multipart/form-data' name='form_banner_man' method='post' action=''><table style='width:100%' border=1><tr>";
	$text .="<td>".NB_BAN_06."</td>";
	$text .="<td class='notice_caption'>".NB_BAN_03."</td>";
	$text .="<td class='notice_caption'>".NB_BAN_05."</td>";
	$text .="<td class='notice_caption'>".NB_BAN_01."</td>";
//	$text .="<td class='notice_caption'>".NB_BAN_09."</td></tr>";
	$sql -> db_Select("nb_ban", "*", "");
	while($row = $sql -> db_Fetch()){
		$ban_id = $row['ban_id'];
		$ban_catid = $row['ban_catid'];
		$ban_org = $row['ban_org'];
//		$ban_url = $row["ban_url"];
		$ban_datebegin = $row['ban_datebegin'];
		$ban_dateend = $row['ban_dateend'];
		$ban_images = $row['ban_images'];
	$sql2 -> db_Select("nb_cat", "*", "cat_id='$ban_catid'");
	while($row = $sql2 -> db_Fetch()){
		$catId = $row["cat_id"];
		$catName = $row["cat_name"];
	}
	if ($ban_catId == '0'){
		$catName=NB_BAN_10;
	}
	$text .="<tr><td class='notice_4'><img src='".e_PLUGIN."nboard/banners/$ban_images' width=200></td>";
	$text .="<td class='notice_4'>$ban_org</td>";
	$text .="<td class='notice_4'>$ban_datebegin / $ban_dateend</td>";
	$text .="<td class='notice_4'>$catName</td>";
//	$text .="<td><input type='text' name='ban_id' value='$ban_id'><input class='radio' style='cursor:pointer;' type='radio' id='ban_id' name='ban_id' value=''>";
//	$text .="<td><input type='text' name='ban_id' value='$ban_id'><input class='button' style='cursor:pointer;' type='submit' name='submit_delete' value=".NB_BUT_DEL." >";
}
	$text .="</table></form>";
$caption = NB_BAN_00;
$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
exit;
}
// =================================================================================================
//				           ADMIN_CONFIG OPTIONS MENU
// =================================================================================================
if(!isset($qs[0]) || (isset($qs[0]) && $qs[0] == "config")){
//======UPDATE========//
if(IsSet($_POST['savesettings'])){
	$pref['nb_admail'] = $_POST['nb_admail'];
	$pref['nb_days'] = $_POST['nb_days'];
	$pref['nb_prolong'] = $_POST['nb_prolong'];
	$pref['nb_dateformat'] = $_POST['nb_dateformat'];
	$pref['nb_sizepicbig'] = $_POST['nb_sizepicbig'];
	$pref['nb_sizepicsmall'] = $_POST['nb_sizepicsmall'];
	$pref['nb_showcols'] = $_POST['nb_showcols'];
	$pref['nb_showrows'] = $_POST['nb_showrows'];
	$pref['nb_check_que'] = $_POST['nb_check_que'];
	$pref['nb_check_ans'] = $_POST['nb_check_ans'];
	$pref['nb_comments'] = $_POST['nb_comments'];
	save_prefs();
	$message = NB_MES_14;
	$ns -> tablerender(NB_MES_00, $message);
}
	$text .="<form enctype='multipart/form-data' name='form_config' method='post' action=''><table class='fborder' style='width:100%' align='center'>";
        $text .= "<tr><td class='forumheader3' width='60%'>".NB_CONF_01."</td><td class='forumheader3'><input class='tbox' size='40' type='text' name='nb_admail' value='".$pref['nb_admail']."'></input></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_02."</td><td class='forumheader3'><input type='text' name='nb_days' class='tbox' value='".$pref['nb_days']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_10."</td><td class='forumheader3'><input type='text' name='nb_prolong' class='tbox' value='".$pref['nb_prolong']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_03."</td>
	<td class='forumheader3'><select class='tbox' type='text' name='nb_dateformat'>
		<option value='".$pref['nb_dateformat']."'>".$pref['nb_dateformat']."
		<option value=".NB_FDATE_01.">".NB_RDATE_01."
		<option value=".NB_FDATE_01.">".NB_RDATE_02."
	</select></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_04."</td><td class='forumheader3'><input type='text' name='nb_sizepicbig' class='tbox' value='".$pref['nb_sizepicbig']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_05."</td><td class='forumheader3'><input type='text' name='nb_sizepicsmall' class='tbox' value='".$pref['nb_sizepicsmall']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_06."</td><td class='forumheader3'><input type='text' name='nb_showcols' class='tbox' value='".$pref['nb_showcols']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_07."</td><td class='forumheader3'><input type='text' name='nb_showrows' class='tbox' value='".$pref['nb_showrows']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_08."</td><td class='forumheader3'><input type='text' name='nb_check_que' class='tbox' value='".$pref['nb_check_que']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_09."</td><td class='forumheader3'><input type='text' name='nb_check_ans' class='tbox' value='".$pref['nb_check_ans']."' size='40'></td></tr>";
	$text .= "<tr><td class='forumheader3'>".NB_CONF_11."</td>
	<td class='forumheader3'><select class='tbox' type='text' name='nb_comments'>
		<option value='".$pref['nb_comments']."'>".$pref['nb_comments']."
		<option value=".NB_SEL_YES.">".NB_SEL_YES."
		<option value=".NB_SEL_NO.">".NB_SEL_NO."
	</select></td></tr>";
	$text .= "<tr><td class='forumheader' colspan='2' style='text-align:center'><input class='button' name='savesettings' type='submit' value= ".NB_BUT_AGR."></td></tr></table></form>";
$caption = NB_CONF_00;
$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
exit;
}
//==================================================================================================
//				           ABOUT PLUGIN
// =================================================================================================
if(!isset($qs[0]) || (isset($qs[0]) && $qs[0] == "about")){
$text="<table><tr>";
$text.="<td><a href='http://e107.compolys.ru'><img src='".e_PLUGIN."nboard/theme/logo_compolys.png' alt='".NB_INFO."'></a>";
$text.= "<td align='center'>".NB_INFO." v4.0,
<br>".NB_AUTHOR_NAME.", ".NB_AUTHOR_SITE.", ".NB_AUTHOR_MAIL.",
<br>".NB_CODERS.": ".NB_CODERS_NAME.",
<br>".NB_TRANSLATOR.": ".NB_TRANSLATOR_NAME."
<br>license GNU GPL
<br>===============================================================";
$text.="</tr></table>";
$text.=NB_ABO_NOW;
$text.="<br><font color=blue>".NB_ABO_INFO."</font><br>";
$text.=NB_ABO_FUTURE;
$caption = NB_ABO_CAP;
$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
exit;
}
require_once(e_ADMIN."footer.php");
function admin_config_adminmenu()
{
		if (e_QUERY) {
			$tmp = explode(".", e_QUERY);
			$cat_action = $tmp[0];
		}
		if (!isset($cat_action) || ($cat_action == ""))
		{
		  $cat_action = "config";
		}
		$var['config']['text'] = NB_CON_MENU;
		$var['config']['link'] = "admin_config.php";
		$var['cat']['text'] = NB_CAT_MENU;
		$var['cat']['link'] ="admin_config.php?cat";
		$var['subcat']['text'] = NB_SCAT_MENU;
		$var['subcat']['link'] ="admin_config.php?subcat";
		$var['notice']['text'] = NB_NOT_MENU;
		$var['notice']['link'] ="admin_config.php?notice";
		$var['baners']['text'] = NB_BAN_MENU;
		$var['baners']['link'] ="admin_config.php?banners";
		$var['about']['text'] = NB_ABO_MENU;
		$var['about']['link'] ="admin_config.php?about";
		show_admin_menu(NB_ADMIN_MENU, $cat_action, $var);
}
function theme_head() {
	return "<script type='text/javascript' src='".e_PLUGIN."nboard/js/add.js'></script>
	<script type='text/javascript' src='".e_PLUGIN."nboard/js/admin_config.js'></script>\n";
}
?>