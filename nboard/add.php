<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
	$catlink =" - <a href='".e_PLUGIN."nboard/nboard.php?add'> ".NB_ADD_CAP."</a>";
	$gnl_email=USEREMAIL;	
	$gnl_id = $_POST['gnl_id'];
	$gnl_scatid = $_POST['gnl_scatid'];
	$gnl_name = $_POST['gnl_name'];
	$gnl_user = $_POST['gnl_user'];
	$gnl_city = $_POST['gnl_city'];
	$gnl_phone = $_POST['gnl_phone'];
	$gnl_picbig = $_POST['gnl_picbig'];
	$gnl_pic1 = $_POST['gnl_pic1'];
	$gnl_detail = $_POST['gnl_detail'];
	$gnl_price = $_POST['gnl_price'];
	$gnl_date_start = $_POST['gnl_date_start'];
	$gnl_date_end = $_POST['gnl_date_end'];
	$cat_id = $_POST['cat_id'];
	$cat_name = $_POST['cat_name'];
	$cat_sub_id = $_POST['cat_sub_id'];
	$gnl_check = $_POST['gnl_check'];
	$conf_check_que = $_POST['conf_check_que'];
	$conf_check_ans = $_POST['conf_check_ans'];
	$vis = 'none';
	$unvis = 'yes';
//======Configuration====//
	$conf_days = $pref['nb_days'];
	$conf_prolong = $pref['nb_prolong'];
	$conf_check_que = $pref['nb_check_que'];
	$conf_check_ans = $pref['nb_check_ans'];
//======Date=============//
	$month = date("m");
	$day = date("d");
	$year = date("y");
	$gnl_date_start = mktime(0,0,0,$month,$day,$year);
	$conf_days = $conf_days * 86400;
	$gnl_date_end = $gnl_date_start + $conf_days;
//======Prolong_notes======//
if(IsSet($_POST['submit_prolong'])){
	$sql -> db_Select("nb_gnl", "*", "gnl_id='$gnl_id'");
	while($row = $sql -> db_Fetch()){
		$gnl_date_start=$row['gnl_date_start'];
		$gnl_date_end=$row['gnl_date_end'];
	}
	$gnl_date_start_new = mktime(0,0,0,$month,$day,$year);
	$gnl_date_end_new = $gnl_date_end + $conf_prolong * 86400;
	
	$sql -> db_Update("nb_gnl", "gnl_date_start='$gnl_date_start_new', gnl_date_end='$gnl_date_end_new' WHERE gnl_id='$gnl_id'");
	$message = "<font color=red>".NB_MES_30." $conf_prolong ".NB_MES_31."</font> ";
	$ns -> tablerender($caption, $message);
}
//======Edit_notes======//
if(IsSet($_POST['submit_edit'])){
	$sql -> db_Select("nb_gnl", "*", "gnl_id='$gnl_id'");
	while($row = $sql -> db_Fetch()){
		$gnl_scatid=$row['gnl_scatid'];
		$gnl_name=$row['gnl_name'];
		$gnl_city=$row['gnl_city'];
		$gnl_picbig=$row['gnl_picbig'];
		$gnl_pic1=$row['gnl_pic1'];
		$gnl_detail=$row['gnl_detail'];
		$gnl_price=$row['gnl_price'];
		$gnl_user=$row['gnl_user'];
		$gnl_phone=$row['gnl_phone'];
		$gnl_email=$row['gnl_email'];
		$gnl_date_start=$row['gnl_date_start'];
		$gnl_date_end=$row['gnl_date_end'];
	}
	$vis = 'yes';
	$unvis = 'none';
}
//======Delete_notes======//	
if (isset($_POST['submit_delete'])){
	$sql -> db_Select("nb_gnl", "*", "gnl_id='$gnl_id'");
 		while($row = $sql -> db_Fetch()){
			$gnl_pic1 = $row['gnl_pic1'];
		}
	if (!$gnl_pic1 == ''){
		unlink("".e_PLUGIN."nboard/nb_pictures/small_$gnl_pic1");
		unlink("".e_PLUGIN."nboard/nb_pictures/$gnl_pic1");
	}
	$sql -> db_Delete("nb_gnl", "gnl_id='$gnl_id'");
	$message = "<font color=red>".NB_MES_24."</font>";
	$ns -> tablerender(NB_MES_00, $message);
}
//======Update_notes======//
if (isset($_POST['submit_update'])){
	if ($cat_sub_id=='' || $gnl_name=='' || $gnl_phone=='' || $gnl_city=='' || $gnl_detail=='' || $gnl_price=='' || $gnl_check <> $conf_check_ans){
	$message = "<font color=red>".NB_MES_21."</font>";
	}
	else {
	$sql -> db_Update("nb_gnl", "gnl_scatid='$cat_sub_id', gnl_name='$gnl_name', gnl_city='$gnl_city', gnl_picbig='$gnl_picbig', gnl_pic1='$gnl_pic1', gnl_detail='$gnl_detail', gnl_price='$gnl_price', gnl_user='$gnl_user', gnl_phone='$gnl_phone', gnl_email='$gnl_email', gnl_date_start='$gnl_date_start', gnl_date_end='$gnl_date_end' WHERE gnl_id='$gnl_id'");
		$message = "<font color=red>".NB_MES_22."</font>";
	}
	$ns -> tablerender(NB_MES_00, $message);
	$cat_id=$cat_name=$cat_desc=$cat_icon='';
	$vis = 'none';
	$unvis = 'yes';
}
//======Insert_notes======//
if (IsSet($_POST['submit_add'])){
//======check empty============//

	if ($cat_sub_id=='' || $gnl_name=='' || $gnl_phone=='' || $gnl_city=='' || $gnl_detail=='' || $gnl_price=='' || $gnl_check <> $conf_check_ans){
	$message = "<font color=red>".NB_MES_21."</font>";
	}
	else {
	if (isset($_FILES['file_userfile']['error'])){
		require_once(e_HANDLER."upload_handler.php");
		if ($uploaded = file_upload('/'.e_PLUGIN."nboard/nb_pictures/", "attachment")){
			foreach($uploaded as $upload){
			  if ($upload['error'] == 0) {
				$nb_patch = e_PLUGIN.'nboard/nb_pictures/';
				if(strstr($upload['type'], "image")){
					require_once(e_HANDLER."resize_handler.php");
					$orig_file = $upload['name'];
					$gnl_pic1 = $orig_file;
					$small_img = "small_$orig_file";
					if(resize_image(e_PLUGIN.'nboard/nb_pictures/'.$orig_file, e_PLUGIN.'nboard/nb_pictures/'.$small_img, $pref['nb_sizepicsmall'])){
//					$parms_small = image_getsize(e_PLUGIN.'nboard/nb_pictures/'.$small_img);
//					$parms_big = image_getsize(e_PLUGIN.'nboard/nb_pictures/'.$big_img);
					}
					if(resize_image(e_PLUGIN.'nboard/nb_pictures/'.$orig_file, e_PLUGIN.'nboard/nb_pictures/'.$orig_file, $pref['nb_sizepicbig'])){
//					$parms = image_getsize(e_PLUGIN.'nboard/nb_pictures/'.$big_img);
//					$gnl_pic1 = $orig_file;
					}
				}
				else{	//upload was not an image, link to file
					$_POST['post'] .= "[br][file=".$nb_patch.$upload['name']."]".(isset($upload['rawname']) ? $upload['rawname'] : $upload['name'])."[/file]";
				}
			  }
			  else{  // Error in uploaded file
			    echo "Error in uploaded file: ".(isset($upload['rawname']) ? $upload['rawname'] : $upload['name'])."<br />";
			  }
			}
		}
	}
	$sql = new db;
	$sql -> db_Insert("nb_gnl", "0, '$cat_sub_id','$gnl_name','$gnl_city','$gnl_pic1','0','0','0','$gnl_detail','$gnl_price','$gnl_user', '$gnl_phone','$gnl_email','$gnl_date_start','$gnl_date_end', '0'");
	$gnl_scatid=$gnl_name=$gnl_city=$gnl_picbig=$gnl_pic1=$gnl_detail=$gnl_price=$gnl_user=$gnl_phone=$gnl_email=$gnl_date_start=$gnl_date_end=$conf_check_ans='';
	header ("Location: ".e_PLUGIN."nboard/nboard.php?add");
	exit;
	$message = "<font color=red>".NB_MES_20." ".strftime('%d %b %Y',$gnl_date_end)."</font>";
	}
	$ns -> tablerender(NB_MES_00, $message);
}
if (IsSet($_POST['submit_reset'])){
$gnl_scatid=$gnl_name=$gnl_city=$pic=$gnl_small=$gnl_detail=$gnl_price=$gnl_user=$gnl_phone=$gnl_email=$gnl_date_start=$gnl_date_end=$gnl_check='';
}
//========================================form edit and delete====================
if (USER==TRUE){
	$gnl_user=USERNAME;
		$text .="<form  method='post' enctype='multipart/form-data' name='form_select' id='form_select' action=''>
			<table class='border' style='width:100%' align='center'>
			<td class='fcaption'>".NB_ADD_17." <select class='tbox' name='gnl_id'>";
			$sql -> db_Select("nb_gnl", "*", "gnl_user='$gnl_user'");
				while($row = $sql -> db_Fetch()){
					$gnlId = $row['gnl_id'];
					$gnlName=$row['gnl_name'];
				$text .="<option value='$gnlId'>$gnlName</option>";
				}
	$text .="</select> 
	<input class='button' type='submit' style='cursor:pointer;' name='submit_prolong' value='".NB_BUT_PROLONG."'>
	<input class='button' type='submit' style='cursor:pointer;' name='submit_edit' value='".NB_BUT_EDIT."'>
	<input class='button' type='submit' style='cursor:pointer;' name='submit_delete' value='".NB_BUT_DEL."' onclick='return confirmDeleteNotice();'>
	</td></table></form>";
}
//========================================form add and edit=======================
$text .="<form  method='post' enctype='multipart/form-data' name='form_add' id='form_add' style='border:0;float:top;' action=''>
	<table class='border' style='width:100%' align='center'>";
$text .= "<tr><td class='forumheader3'>".NB_ADD_01." *</td>
	<td class='forumheader3'><input class='tbox' type='text' name='gnl_name' value='$gnl_name' size='40' onblur='checkname()'> <span id='check_name'></span></td></tr>";
$text .="<tr><td class='forumheader3'>" .NB_ADD_02." *</td><td class='forumheader3'>
	<select class='tbox' name='cat_id' id='cat' onChange='process()'>
	<option value=''>" .NB_ADD_03."";
		$sql -> db_Select("nb_cat", "*", "cat_sub_id='0'");
                while($row = $sql -> db_Fetch()){
			$catId = $row['cat_id'];
			$catName = $row['cat_name'];
			$text .="<option value='$catId'>$catName";
			}
	$text .="</option></select></td></tr>";
	$text .="<tr><td class='forumheader3'>".NB_ADD_04." *</td><td class='forumheader3'>
	<select class='tbox' name='cat_sub_id' id='sub' onblur='checkcat()' value='$cat_sub_id'><option value=''>".NB_ADD_05." </option></select><span id='check_subcat'></span></td></tr>";
	if (!FILE_UPLOADS){
		$text .= "<b>".LAN_UPLOAD_SERVEROFF."</b>";
	}else{	
		if (!is_writable(e_PLUGIN."nboard/nb_pictures/")){
			$text .= LAN_UPLOAD_777."<b>".str_replace("../","",e_PLUGIN."nboard/nb_pictures/")."</b><br /><br />";
		}
	$text .= "<tr><td class='forumheader3'>".NB_ADD_06."</td>
	<td class='forumheader3'><input class='tbox' name='file_userfile[]' type='file' size='41'></td></tr>";
	}
$text .="<tr><td class='forumheader3'>".NB_ADD_07." *</td>
	<td class='forumheader3'><textarea class='tbox' name='gnl_detail' cols=38 rows=10 onblur='checkdetail()' maxlength=1000>$gnl_detail</textarea> <span id='check_detail'></span></td>";
$text .="<tr><td class='forumheader3'>".NB_ADD_08." *</td>
	<td class='forumheader3'><input class='tbox' type='text' name='gnl_price' value='$gnl_price' size='40' maxlength=20 onblur='checkprice()'> <span id='check_price'></span></td>";
if (USER==FALSE){	
$text .="<tr><td class='forumheader3' width='30%'>".NB_ADD_09." *</td>
	<td class='forumheader3' width='70%'><input class='tbox' type='text' name='gnl_user' value='$gnl_user' size='40' onblur='checkuser()'> <span id='check_user'></span></td>";
}
if (USER==TRUE){
	$gnl_user=USERNAME;
$text .="<input class='tbox' type='hidden' name='gnl_user' value='$gnl_user' size='40'>";
}

$text .= "<tr><td class='forumheader3'>".NB_ADD_10." *</td>
	<td class='forumheader3'><input class='tbox' type='text' name='gnl_city' value='$gnl_city' maxlength=100 size='40' onblur='checkcity()'> <span id='check_city'></span></td>";
$text .= "<tr><td class='forumheader3'>".NB_ADD_11." *</td>
	<td class='forumheader3'><input class='tbox' type='text' name='gnl_phone' value='$gnl_phone' size='40' onblur='checkphone()'> <span id='check_phone'></span></td>";
if (USER==FALSE){
$text .= "<tr><td class='forumheader3'>".NB_ADD_12."</td>
	<td class='forumheader3'><input class='tbox' type='text' name='gnl_email' value='$gnl_email' size='40'></td>";
}
if (USER==TRUE){
$text .= "<tr><td class='forumheader3'></td>
	<td class='forumheader3'><input type='hidden' name='gnl_email' value='".USEREMAIL."' size='40'></td>";
}
if (USER==FALSE){
	$text .="<tr><td class='forumheader3'>".NB_ADD_13." *</td>
	<td class='forumheader3'><b>$conf_check_que</b> <input class='tbox' type='text' name='gnl_check' value='$gnl_check' maxlength=100 size='10' onblur='checkans()'><span id='check_ans'></span></td>";
} 
if (USER==TRUE){
	$gnl_check = $conf_check_ans;
	$text .="<input type='hidden' name='gnl_check' value='$gnl_check'>";
}
// $text .= "<tr><td class='forumheader3'>".NB_COL."*</td> <td class='forumheader3'><select class='tbox' name='days'>";
// $text .= "<option selected value='7'>".NB_COL1."</option>";
// $text .= "<option value='14'>".NB_COL2."</option>";
// $text .= "<option  value='30'>".NB_COL3."</option>";
// $text .= "</select>";
$text .="<input type='hidden' name='gnl_id' value='$gnl_id'><input type='hidden' name='conf_check_ans' value='$conf_check_ans'>
	<input type='hidden' name='gnl_date_start' value='$gnl_date_start'>
	<input type='hidden' name='gnl_date_end' value='$gnl_date_end'>";
$text .="<tr><td class='forumheader3'></td><td class='forumheader3'>
	<input type='submit' class='button' style='cursor:pointer;display:$unvis;' name='submit_add' value='".NB_BUT_ADD."'  onClick='f_submit_add()'>
	<input type='submit' class='button' style='cursor:pointer;display:$unvis;' name='submit_reset' value='".NB_BUT_RES."'>
	<input type='submit' class='button' style='cursor:pointer;display:$vis;' name='submit_update' value='".NB_BUT_UPD."' onClick='f_submit_add()'>
	<input type='submit' class='button' style='cursor:pointer;display:$vis;' name='submit_reset' value='".NB_BUT_CANS."'>
	</td></tr></table></span></form>";
?>