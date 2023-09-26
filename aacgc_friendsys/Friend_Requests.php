<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Friend System             #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/
require_once("../../class2.php");
require_once(HEADERF);
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}

include_lan(e_PLUGIN."aacgc_friendsys/languages/".e_LANGUAGE.".php");

if ($pref['fl_enable_gold'] == "1")
{$gold_obj = new gold();}

//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['accept_user'])){

$newuser = $_POST['user_id'];
$newfriend = $_POST['user_friends'];

$newusera = $_POST['user_id'];
$newfrienda = $_POST['user_friends'];

$newpmfrom = $_POST['pm_from'];
$newpmto = $_POST['pm_to'];
$newpmsent = $_POST['pm_sent'];
$newpmread = $_POST['pm_read'];
$newpmsubject = $_POST['pm_subject'];
$newpmtext = $_POST['pm_text'];
$newpmsenddel = $_POST['pm_send_del'];
$newpmreaddel = $_POST['pm_read_del'];
$newpmatt = $_POST['pm_attachments'];
$newpmoption = $_POST['pm_option'];
$newpmsize = $_POST['pm_size'];

$sql->db_Insert("aacgc_friend_sys", "NULL, '".$newuser."', '".$newfriend."'") or die(mysql_error());
$sql2 = new db;
$sql2->db_Insert("aacgc_friend_sys", "NULL, '".$newfrienda."', '".$newusera."'") or die(mysql_error());
$sql3 = new db;
$sql3->db_Insert("private_msg", "NULL, '".$newpmfrom."', '".$newpmto."', '".$newpmsent."', '".$newpmread."', '".$newpmsubject."', '".$newpmtext."', '".$newpmsenddel."', '".$newpmreaddel."', '".$newpmatt."', '".$newpmoption."', '".$newpmsize."'") or die(mysql_error());

$text .= "<center>".FSYS_17."</center><br>";

}



if (isset($_POST['main_delete'])) {
    $delete_id = array_keys($_POST['main_delete']);
    $sql2 = new db;
    $sql2->db_Delete("aacgc_friend_sys_request", "req_id='".$delete_id[0]."'");

$text .= "<center>".FSYS_18."</center><br><br>";

}

//---------------------------------# Recieved #-------------------------------------------------------------------+
if ($action == ""){
if (USER){


        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
        <td style='width:100%' class='forumheader3' colspan='2'><center>".FSYS_19."</center></td>
        </tr><tr>
        <td style='width:100%' class='forumheader3'>".FSYS_20."</td>
        <td style='width:0%' class='forumheader3'>".FSYS_21."</td>
        </tr>";

$sql2->db_Select("aacgc_friend_sys_request", "*", "user_id='".USERID."'");
while($row2 = $sql2->db_Fetch()){
$sql3 = new db;
$sql3 ->db_Select("user", "*", "user_id='".intval($row2['user_friends_request'])."'");
$row3 = $sql3->db_Fetch();

if ($pref['fl_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$gold_obj->show_orb($row3['user_id'])."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$row3['user_name']."</a>";}


        $text .= "
        <tr>
        <td style='width:100%' class='forumheader3'>".$userorb."</td>
        <td style='width:0%' class='forumheader3'>
	<form method='POST' action='Friend_Requests.php'>
	<input type='hidden' name='user_friends' value='".$row3['user_id']."'>
	<input type='hidden' name='user_id' value='".USERID."'>";

//-----------------------# Auto PM Section #------------------------+

$subject = "".FSYS_22."";
$message = "<b>".USERNAME."</b> ".FSYS_23.".";
$to = "".$row3['user_id']."";
$from = "".USERID."";
$offset = +0;
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text .= "
        <input type='hidden' name='pm_from' value='".$from."'>
        <input type='hidden' name='pm_to' value='".$to."'>
        <input type='hidden' name='pm_sent' value='".$sent."'>
        <input type='hidden' name='pm_read' value='0'>
        <input type='hidden' name='pm_subject' value='".$subject."'>
        <input type='hidden' name='pm_text' value='".$message."'>
        <input type='hidden' name='pm_send_del' value='0'>
        <input type='hidden' name='pm_read_del' value='0'>
        <input type='hidden' name='pm_attachments' value=''>
        <input type='hidden' name='pm_option' value=''>
        <input type='hidden' name='pm_size' value='0'>
";

//------------------------------------------------------------------+


$text .= "<input type='hidden' name='accept_user' value='1'>
	<input type='hidden' name='main_delete[".$row2['req_id']."]'>
	<input type='image' type='submit' src='".e_PLUGIN."aacgc_friendsys/images/addme.png' onclick=\"return jsconfirm('".FSYS_24." {$row3['user_name']} ".FSYS_25."')\"/>
	</form>
	<form method='POST' action='Friend_Requests.php'>
	<input type='image' title='Deny Friend' name='main_delete[".$row2['req_id']."]' src='".e_PLUGIN."aacgc_friendsys/images/removeme.png' onclick=\"return jsconfirm('".FSYS_26." [{$row3['user_name']}]')\"/>
        </form>
	</td>
        </tr>";

}
		
        $text .= "</table></div><br><br>";



//----------------------------# Sent #-------------------------------------------------------------------------+


        $text .= "<br><br>
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
        <td style='width:100%' class='forumheader3' colspan='2'><center>".FSYS_27."</center></td>
        </tr><tr>
        <td style='width:100%' class='forumheader3'>".FSYS_28."</td>
        <td style='width:0%' class='forumheader3'>".FSYS_29."</td>
        </tr>";


$sql4 = new db;
$sql4->db_Select("aacgc_friend_sys_request", "*", "user_friends_request='".USERID."'");
while($row4 = $sql4->db_Fetch()){
$sql5 = new db;
$sql5 ->db_Select("user", "*", "user_id='".intval($row4['user_id'])."'");
$row5 = $sql5->db_Fetch();

if ($pref['fl_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$row5['user_id']."'>".$gold_obj->show_orb($row5['user_id'])."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$row5['user_id']."'>".$row5['user_name']."</a>";}


        $text .= "
        <tr>
        <td style='width:100%' class='forumheader3'>".$userorb."</td>
        <td style='width:0%' class='forumheader3'>
	<form method='POST' action='Friend_Requests.php'>
	<input type='image' title='Delete Request' name='main_delete[".$row4['req_id']."]' src='".e_PLUGIN."aacgc_friendsys/images/removeme.png' onclick=\"return jsconfirm('".FSYS_30." [{$row5['user_name']}]')\"/>
        </form>
	</td>
        </tr>";

}
		
        $text .= "</table></div><br><br>";


//---------------------------------------------------------------------------------+
}

else

{$text .= "".FSYS_31."";}


//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_friendsys/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


  $ns -> tablerender("".FSYS_32."", $text);

  require_once(FOOTERF);


}

?>



