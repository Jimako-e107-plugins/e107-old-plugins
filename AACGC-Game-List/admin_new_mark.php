<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

require_once("../../class2.php");

if(!getperms("P")) {
echo "";
exit;
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_mark'] == '1') {
$newmarkname = $_POST['mark_name'];
$newmarkimg = $_POST['mark_img'];

$reason = "";
$newok = "";

if (($newmarkname == "")){
	$newok = "0";
	$reason = "No Name";
} else {
	$newok = "1";
}

If ($newok == "0"){
 	$newtext = "
 	<center>
	<b><br><br> ".$reason."
	</center>
 	</b>
	";
	$ns->tablerender("", $newtext);}

If ($newok == "1"){
$sql->db_Insert("aacgc_gamelist_marks", "NULL, '".$newmarkname."','".$newmarkimg."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Mark Created</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_mark.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:20%; text-align:right' class='forumheader3'>Mark Name:</td>
        <td style='width:80%' class='forumheader3'>
        <input class='tbox' type='text' name='mark_name' size='100'>
        </td>
        </tr>";


        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."aacgc_gamelist/marks";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Mark Image:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("mark_img", 50, $row['mark_img'], 100)."
        ".$rs -> form_button("button", '', "Show Icons", "onclick=\"expandit('plcico')\"")." 
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
            $text .= "<a href=\"javascript:insertext('".$icon['fname']."','mark_img','plcico')\"><img src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }


$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_mark' value='1'>
		<input class='button' type='submit' value='Create Mark'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";












        $text .= $rs->form_open("post", e_SELF, "myform_".$row['mark_id']."", "", "");
        $text .= "<br><br><br>
        <div style='text-align:center'>
        <table style='width:75%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>ID</td>
        <td style='width:50%' class='forumheader3'>Mark Name</td>
        <td style='width:50%' class='forumheader3'>Mark Image</td>
       </tr>";
        $sql->db_Select("aacgc_gamelist_marks", "*", "ORDER BY mark_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['mark_id']."</td>
        <td style='width:' class='forumheader3'>".$row['mark_name']."</td>
        <td style='width:' class='forumheader3'><img src='".e_PLUGIN."aacgc_gamelist/marks/".$row['mark_img']."'></img></td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();








	      $ns -> tablerender("AACGC Game List (Create Mark)", $text);
	      require_once(e_ADMIN."footer.php");
?>


