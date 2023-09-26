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

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------
if ($_POST['add_game'] == '1') {
$newgamename = $tp->toDB($_POST['game_name']);
$newgamepic = $_POST['game_pic'];
$newgamecat = $tp->toDB($_POST['game_cat']);
$newgametxt = $tp->toDB($_POST['game_text']);
$newlinka = $tp->toDB($_POST['linka']);
$newlinkaname = $tp->toDB($_POST['linkaname']);
$newlinkb = $tp->toDB($_POST['linkb']);
$newlinkbname = $tp->toDB($_POST['linkbname']);
$newlinkc = $tp->toDB($_POST['linkc']);
$newlinkcname = $tp->toDB($_POST['linkcname']);
$newvideo = $tp->toDB($_POST['video']);

$reason = "";
$newok = "";
if (($newgamename == "")){
	$newok = "0";
	$reason = "No name";
} else {
	$newok = "1";
}
if (($newgamepic == "") OR ($newok == "0")){
		If ($newgamepic == "") {
		$reason .= "No Image Selected";	
		}
	$newok = "0";
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
	$ns->tablerender("", $newtext);
}
If ($newok == "1"){
$sql->db_Insert("aacgc_gamelist", "NULL, '".$newgamename."', '".$newgamepic."', '".$newgamecat."', '".$newgametxt."', '".$newlinka."', '".$newlinkaname."', '".$newlinkb."', '".$newlinkbname."', '".$newlinkc."', '".$newlinkcname."', '".$newvideo."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Game Added</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+

//-----------# Icon Path #---------------+
if($pref['gamelist_adminiconpath'] == "")
{$adminiconpath = "icons";}
else
{$adminiconpath = "".$pref['gamelist_adminiconpath']."";}
//---------------------------------------+

$text = "
<form method='POST' action='admin_new.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";


$sql2->db_Select("aacgc_gamelist_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='game_cat' value='".$option['cat_id']."'>".$option['cat_name']."</option>";}


$text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Game Name:</td>
        <td style='width:' class='forumheader3' colspan=2>
        <input class='tbox' type='text' name='game_name' size='100'>
        </td>
        </tr>
";

        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."aacgc_gamelist/".$adminiconpath."";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Game Icon:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("game_pic", 50, $row['game_pic'], 100)."
        ".$rs -> form_button("button", '', "Show Icons", "onclick=\"expandit('plcico')\"")." [<a href='http://www.aacgc.com/SSGC/download.php?view.330' target='_blank'> Download Icon Pack </a>] (400+ Icons)
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
            $text .= "<a href=\"javascript:insertext('".$icon['fname']."','game_pic','plcico')\"><img width='100px' src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }



        $text .= "</div>
        </td>
	</tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Game Category:</td>
        <td style='width:' class='forumheader3' colspan=2>
		<select name='game_cat' size='1' class='tbox' style='width:50%'>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Game Detail:</td>
        <td style='width:' class='forumheader3' colspan=2>
		<textarea class='tbox' rows='25' cols='100' name='game_text' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

        $text .= display_help('helpb', 'forum');

        $text .= "</td>
        </tr>




        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Link 1:</td>
        <td style='width:' class='forumheader3'>
        Name: <input class='tbox' type='text' name='linkaname' size='25'>
        </td>
        <td style='width:' class='forumheader3'>
        Link: <input class='tbox' type='text' name='linka' size='75'>
        </td>
        </tr>



        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Link 2:</td>
        <td style='width:' class='forumheader3'>
        Name: <input class='tbox' type='text' name='linkbname' size='25'>
        </td>
        <td style='width:' class='forumheader3'>
        Link: <input class='tbox' type='text' name='linkb' size='75'>
        </td>
        </tr>





        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Link 3:</td>
        <td style='width:' class='forumheader3'>
        Name: <input class='tbox' type='text' name='linkcname' size='25'>
        </td>
        <td style='width:' class='forumheader3'>
        Link: <input class='tbox' type='text' name='linkc' size='75'>
        </td>
        </tr>





        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Video (YouTube or other embed code):</td>
        <td style='width:75%' class='forumheader3' colspan=2>
	        <textarea class='tbox' rows='10' cols='100' name='video'></textarea>
        </td>
        </tr>		
        <tr style='vertical-align:top'>
        <td colspan='3' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_game' value='1'>
		<input class='button' type='submit' value='Add Game'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Game List", $text);
	      require_once(e_ADMIN."footer.php");
?>

