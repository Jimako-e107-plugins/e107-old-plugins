<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Event Listing             #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/


require_once("../../class2.php");
require_once(HEADERF);

include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if (USER){
	
	
if ($_POST['join_meeting'] == '1') {

$newuser = $tp->toDB($_POST['user_id']);
$newmeet = $tp->toDB($_POST['user_meet']);
$newchoice = $tp->toDB($_POST['user_choice']);
$newdet = $tp->toDB($_POST['user_det']);
$sql->db_Insert("aacgc_mp_members", "NULL, '".$newuser."', '".$newmeet."', '".$newchoice."', '".$newdet."'") or die(mysql_error());

$ns->tablerender("", "<a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$newmeet."'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' align='left' /></a><center>".MP_22."</center>");

require_once(FOOTERF);}	


	if (isset($_POST['update_user'])) {
        $message = ($sql->db_Update("aacgc_mp_members", "user_id='".$_POST['user_id']."',user_meet='".$_POST['user_meet']."',user_choice='".$_POST['user_choice']."',user_det='".$_POST['user_det']."' WHERE id='".$_POST['id']."' ")) ? "".AMP_24."" : "".AMP_25."";
}


if (isset($message)) {
        $ns->tablerender("", "<a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$_POST['user_meet']."'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' align='left' /></a><br><br><div style='text-align:center'><b>".$message."</b></div>");
		require_once(FOOTERF);		
}
	
if ($action == "det"){
//-------------------------------------------------------------------------

$sql->db_Select("aacgc_mp_meetings", "*", "meet_id = '".intval($sub_action)."'");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_mp_members", "*", "user_meet='".intval($row['meet_id'])."' and user_id='".USERID."'");
$row2 = $sql2->db_Fetch();

$mid = $row['meet_id'];
$mtitle = $row['meet_title']; 
$msubj = $row['meet_subj'];
$mdet = $row['meet_det']; 
$mstat = $row['meet_status'];
$mrep = $row['meet_repeat'];
$mclass = $row['meet_class'];
$mcat = $row['meet_cat'];
$dformat = $pref['aacgcmp_dformat'];
$msdate = date($dformat, $row['meet_sdate']);
$medate = date($dformat, $row['meet_edate']);
$userid = $row2['user_id'];
$onlineuserid = "".USERID."";

//-------------------------------------------------------------------------

if ($mstat == "0")
{$ns -> tablerender("".MP_30." ".$row['meet_title']."", "<a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$mid."'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' align='left' /></a>".MP_20."");
require_once(FOOTERF);}


if ($userid == "{$onlineuserid}")
{$ns -> tablerender("".MP_30." ".$row['meet_title']."", "<a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$mid."'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' align='left' /></a><br><br> ".MP_21."");
require_once(FOOTERF);}


//--------------------------------------------------------------------------



//---------------------------------------------------------------------------

if ( check_class($mclass) OR ($mclass == "members")){

$text .= "
<form method='POST' action='Join.php'>
<table style='width:100%' class='indent'>
<tr>
<td class='indent' colspan='2'>".$mtitle."</td>
</tr>
<tr>
<td class='forumheader3'>".MP_05."</td>
<td class='indent'>".$msubj."</td>
</tr>
<tr>
<td class='forumheader3'>".MP_07."</td>
<td class='indent'>".$msdate."</td>
</tr>
<tr>
<td class='forumheader3'>".MP_08."</td>
<td class='indent'>".$medate."</td>
</tr>
<td colspan=2>
<input type='hidden' name='user_id' value='".USERID."'>
</td>
</tr>
<tr>
<td colspan=2>
<input type='hidden' name='user_meet' value='".$row['meet_id']."'>
</td>
</tr>";

$text .= "
</td>
</tr>
<tr>
<td class='indent'>".MP_23.":</td>
<td class='indent'>
<select name='user_choice' size='1' class='tbox' style='width:50%'>
<option name='user_choice' value='1'>".MP_24."</option>
<option name='user_choice' value='2'>".MP_25."</option>
<option name='user_choice' value='3'>".MP_26."</option>
</td>
</tr>
<tr>
<td class='indent'>".MP_27.":</td>
<td class='indent'>
<textarea class='tbox' rows='3' cols='75' name='user_det'></textarea>
</td>
</tr></table>
<br><center>
<input type='hidden' name='join_meeting' value='1'>
<input class='button' type='submit' value='".MP_31."'>
</center>
</form>
";}

else

//---------------------------------------------------------------------------

{$text .= "<a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$mid."'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' align='left' /></a><center><br><br>".MP_28."<br><br></center>";}

//---------------------------------------------------------------------------

}

//--------------------# edit choice #-------------------------------------------------------

if ($action == "edit"){

require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

        $sql->db_Select("aacgc_mp_members", "*", "id='".intval($sub_action)."'");
        $row = $sql->db_Fetch();

        $sql2 = new db;
        $sql2->db_Select("user", "*", "user_id='".$row['user_id']."'");
        $row2 = $sql2->db_Fetch();

        $sql3 = new db;
        $sql3->db_Select("aacgc_mp_meetings", "*", "meet_id='".$row['user_meet']."'");
        $row3 = $sql3->db_Fetch();

	if ($row['user_choice'] == "1"){$choice = "".MP_24."";}
	if ($row['user_choice'] == "2"){$choice = "".MP_25."";}
	if ($row['user_choice'] == "3"){$choice = "".MP_26."";}


        $width = "width:100%";
        $text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMP_80.":</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs->form_hidden("user_id", "".$row2['user_id']."")." ".$row2['user_name']."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_81.":</td>
        <td style='width:' class='forumheader3' colspan=2>
		".$rs->form_hidden("user_meet", "".$row['user_meet']."")." ".$row3['meet_title']."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_82.":</td>
        <td style='width:' class='forumheader3' colspan=2>
		<select name='user_choice' size='1' class='tbox' style='width:60%'>
                <option name='user_choice' value='".$row['user_choice']."'>".$choice."</option>
                <option name='user_choice' value='1'>".MP_24."</option>
                <option name='user_choice' value='2'>".MP_25."</option>
                <option name='user_choice' value='3'>".MP_26."</option>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMP_83.":</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' rows='3' cols='75' name='user_det'>".$row['user_det']."</textarea>
        </td>
        </tr>
";



        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['id']."")."
        ".$rs -> form_button("submit", "update_user", "".AMP_85."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
}}

else

{$text .= "<a href='".e_PLUGIN."aacgc_mp/Planner.php'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' align='left' /></a><center><br><br>".MP_29."<br><br></center>";}

//---------------------------------------------------------------------------

$ns -> tablerender("".MP_30." ".$row['meet_title']."", $text);

require_once(FOOTERF);

?>