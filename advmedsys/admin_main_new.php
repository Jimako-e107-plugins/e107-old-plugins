<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3 by garyt  #
#######################################
*/

require_once("../../class2.php");

if(!getperms("P")) {
echo AMS_ADMIN_S1;
exit;
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");
require_once(e_PLUGIN."advmedsys/advmedsys_ver.php");

	$pageid = "admin_menu_03";

$rs = new form;
$fl = new e_file;

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_medal'] == '1') {
$newmedname = $_POST['medname'];
$newmedpic = $_POST['medal_pic'];
$newmedtxt = $_POST['medal_txt'];
$reason = "";
$newok = "";
if (($newmedname == "") OR ($newmedtxt == "")){
	$newok = "0";
	$reason = AMS_ADMIN_S29;
} else {
	$newok = "1";
}
if (($newmedpic == "") OR ($newok == "0")){
		If ($newmedpic == "") {
		$reason .= "<br>".AMS_ADMIN_S30;	
		}
	$newok = "0";
} else {
	$newok = "1";
}
If ($newok == "0"){
 	$newtext = "
 	<center>
	<b>".AMS_ADMIN_S28."<br><br> ".$reason."
	</center>
 	</b>
	";
	$ns->tablerender(AMS_ADMIN_S31, $newtext);
}
If ($newok == "1"){
$sql->db_Insert("advmedsys_medals", "NULL, '".$newmedname."', '".$newmedpic."', '".$newmedtxt."'") or die(mysql_error());
$ns->tablerender("", "<center><b>".AMS_ADMIN_S27."</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_main_new.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";
$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>".AMS_ADMIN_S6.":</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='medname' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>".AMS_ADMIN_S7.":</td>
        <td style='width:60%' class='forumheader3'>
	        <textarea class='tbox' rows='3' cols='50' name='medal_txt'></textarea>
        </td>
        </tr>";
        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."advmedsys/medalimg/";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>".AMS_ADMIN_S5.":</td>
        <td style='width:60%' class='forumheader3'>
        ".$rs -> form_text("medal_pic", 50, $row['medal_pic'], 100)."
        ".$rs -> form_button("button", '', AMS_ADMIN_S3, "onclick=\"expandit('plcico')\"")."
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
            $text .= "<a href=\"javascript:insertext('".$icon['fname']."','medal_pic','plcico')\"><img src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }
        $text .= "</div>
        </td>
		</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_medal' value='1'>
		<input class='button' type='submit' value='".AMS_ADMIN_S14."'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIM_S5, $text);
	      require_once(e_ADMIN."footer.php");
?>
