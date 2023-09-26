<?php



/*

#######################################

#     e107 website system plguin      #

#     AACGC Meeting Planner           #

#     by M@CH!N3                      #

#     http://www.aacgc.com            #

#######################################

*/



global $tp, $e_event;



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



require_once(e_HANDLER."calendar/calendar_class.php");

$cal = new DHTML_Calendar(true);

function headerjs()

{

	global $cal;

	require_once(e_HANDLER."calendar/calendar_class.php");

	$cal = new DHTML_Calendar(true);

	return $cal->load_files();

}



include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");



if ( check_class($pref['aacgcmp_addclass']) OR (ADMIN) ){



//-------------------------# BB Code Support #----------------------------------------------



include(e_HANDLER."ren_help.php");



//------------------------------------------------------------------------------------------

/* removed following-

meet_sdate='".$tp->toDB($sdate)."', 

meet_edate='".$tp->toDB($edate)."', 

*/



if (isset($_POST['update_meeting'])) {



$sdate = $_POST['meet_sdate'] + ($pref['aacgcmp_toffset'] * 60 * 60);

$edate = $_POST['meet_edate'] + ($pref['aacgcmp_toffset'] * 60 * 60);



$message = ($sql->db_Update("aacgc_mp_meetings", "

meet_title='".$tp->toDB($_POST['meet_title'])."', 

meet_det='".$tp->toDB($_POST['meet_det'])."', 

meet_subj='".$tp->toDB($_POST['meet_subj'])."', 





meet_status='".$tp->toDB($_POST['meet_status'])."', 

meet_repeat='".$tp->toDB($_POST['meet_repeat'])."', 

meet_class='".$tp->toDB($_POST['meet_class'])."', 

meet_cat='".$tp->toDB($_POST['meet_cat'])."' 

WHERE meet_id='".$_POST['id']."' ")) ? "".AMP_24."" : "".AMP_25."";



//Added Update For Notify Trigger

$newmeetingsubj = $tp->toDB($_POST['meet_subj']);

$newmeetingdet = $tp->toDB($_POST['meet_det']);

$newmeetingtitle = $tp->toDB($_POST['meet_title']);



//Added Notify Trigger

$edata_ec = array("meet_det" => $newmeetingdet, "meet_subj" => $newmeetingsubj, "meet_title" => $newmeetingtitle);

$e_event -> trigger("ecaledit", $edata_ec);

}



if (isset($_POST['main_delete'])) {

        $delete_id = array_keys($_POST['main_delete']);

	$sql2 = new db;

    	$sql2->db_Delete("aacgc_mp_meetings", "meet_id='".$delete_id[0]."'");

	

}



if (isset($message)) {

        $ns->tablerender("", "<div style='text-align:center'><a href='".e_PLUGIN."aacgc_mp/Planner.php'><img src='".e_PLUGIN."aacgc_mp/images/back.png' align='left' alt='".AMP_65."' /></a><b>".$message."</b></div>");



require_once(FOOTERF);

}



//-----------------------------------------------------------------------------------------------------------+



$sql->db_Select("aacgc_mp_meetings", "*", "meet_id = '".intval($id)."'");

$row = $sql->db_Fetch();



$sql2 = new db;

$sql2->db_Select("aacgc_mp_cat", "*", "cat_id='".intval($row['meet_cat'])."'");

$row2 = $sql2->db_Fetch();



if ($row['meet_status'] == "1")

{$status = "".AMP_32."";}

if ($row['meet_status'] == "0")

{$status = "".AMP_33."";}



$dformat = $pref['aacgcmp_dformat'];



        $text = "

        <div style='text-align:center'>

        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."

        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>

        <tr>

        <td style='width:20%; text-align:right' class='forumheader3'>".AMP_02.":</td>

        <td style='width:80%' class='forumheader3' colspan=2>

            ".$rs -> form_text("meet_title", 94, $row['meet_title'], 500)."

        </td>

        </tr>

        <tr>

        <td style='width:; text-align:right' class='forumheader3'>".AMP_03.":</td>

        <td style='width:' class='forumheader3' colspan=2>

	    <textarea class='tbox' rows='25' cols='68' name='meet_det' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['meet_det']."</textarea><br>";



        $text .= display_help('helpb', 'forum');



        $text .= "

        </td>

        </tr>

        <tr>

        <td style='width:20%; text-align:right' class='forumheader3'>".AMP_04.":</td>

        <td style='width:80%' class='forumheader3' colspan=2>

            ".$rs -> form_text("meet_subj", 94, $row['meet_subj'], 500)."

        </td>

        </tr>



        <tr>

        <td style='width:30%; text-align:right' class='forumheader3'>".AMP_05.":</td>

        <td style='width:70%' class='forumheader3'>

	<input type='hidden' name='meet_sdate' value='".$row['meet_sdate']."'>";



//Removed Ability To Edit Date/Time	

/*

$text .= $cal->make_input_field(

           array('firstDay'       => 0, // show Monday first

                 'showsTime'      => true,

                 'showOthers'     => true,

				 'singleClick'    => false,

                 'ifFormat'       => '%s',

                 'weekNumbers'    => false,

                 'timeFormat'     => '12'),

           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',

                 'name'        => 'meet_sdate',

                 'value'       => $row['meet_sdate']));

*/

        $text .= "

        (".date($dformat, $row['meet_sdate']).")".MP_46."</td>

        </tr>

        <tr>

        <td style='width:30%; text-align:right' class='forumheader3'>".AMP_06.":</td>

        <td style='width:70%' class='forumheader3'>

	<input type='hidden' name='meet_edate' value='".$row['meet_edate']."'>";



//Removed Ability To Edit Date/Time

/*

$text .= $cal->make_input_field(

           array('firstDay'       => 0, // show Monday first

                 'showsTime'      => true,

                 'showOthers'     => true,

				 'singleClick'    => false,

                 'ifFormat'       => '%s',

                 'weekNumbers'    => false,

                 'timeFormat'     => '12'),

           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',

                 'name'        => 'meet_edate',

                 'value'       => $row['meet_edate']));

*/

        $text .= "

        (".date($dformat, $row['meet_edate']).")".MP_46."</td>

        </tr>

        <tr>

        <td style='width:; text-align:right' class='forumheader3'>".AMP_07.":</td>

        <td style='width:' class='forumheader3' colspan=2>

		<select name='meet_status' size='1' class='tbox' style='width:60%'>

                <option name='meet_status' value='".$row['meet_status']."'>".$status."</option>

                <option name='meet_status' value='1'>".AMP_32."</option>

                <option name='meet_status' value='0'>".AMP_33."</option>		

        </td>

        </tr>";



if($row['meet_repeat'] == "0"){$repeat = "".AMP_45."";}

else if($row['meet_repeat'] == "1"){$repeat = "".AMP_46."";}

else if($row['meet_repeat'] == "2"){$repeat = "".AMP_47."";}





$text .= "<tr>

	 <td style='width:; text-align:right' class='forumheader3'>".AMP_08.":</td>

         <td style='width:' class='forumheader3'>

                <select name='meet_repeat' size='1' class='tbox' style='width:50%'>

                <option name='meet_repeat' value='".$row['meet_repeat']."'>".$repeat."</option>

                <option name='meet_repeat' value='0'>".AMP_45."</option>

                <option name='meet_repeat' value='1'>".AMP_46." (".AMP_89.":".$pref['aacgcmp_hoursperweek'].")</option>

                <option name='meet_repeat' value='2'>".AMP_47." (".AMP_89.":".$pref['aacgcmp_hourspermonth'].")</option>

        </td>

	</tr>

	<tr>

        <td style='width:; text-align:right' class='forumheader3'>".AMP_09.":</td>

        <td style='width:70%' class='forumheader3'>";



	  $sql4 = new db;

	  $sql4->db_Select("userclass_classes", "*", "userclass_id='".$row['meet_class']."'");

          $row4 = $sql4->db_Fetch();



	if($row['meet_class'] == "none"){$classnow = "".AMP_11."";}

	else if($row['meet_class'] == "members"){$classnow = "".AMP_12."";}

	else {$classnow = $row4['userclass_name'];}



$text .= "<select name='meet_class' size='1' class='tbox' style='width:50%'>

	  <option name='meet_class' value='".$row['meet_class']."'>".$classnow."</option>

	  <option name='meet_class' value='none'>".AMP_11."</option>

	  <option name='meet_class' value='members'>".AMP_12."</option>

";

	  $sql5 = new db;

	  $sql5->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");

          while($row5 = $sql5->db_Fetch()){



$text .= "<option name='meet_class' value='".$row5['userclass_id']."'>".$row5['userclass_name']."</option>";}







$text .= "</td></tr>";





$text .= "<tr>

        <td style='width:; text-align:right' class='forumheader3'>".AMP_28.":</td>

        <td style='width:' class='forumheader3' colspan=2>

		<select name='meet_cat' size='1' class='tbox' style='width:60%'>

                <option name='meet_cat' value='".$row['meet_cat']."'>".$row2['cat_title']."</option>";



	$sql3 = new db;

	$sql3->db_Select("aacgc_mp_cat", "*");

	$rows = $sql3->db_Rows();

	for ($i=0; $i < $rows; $i++) {

	$option = $sql3->db_Fetch();

	

$text .= "<option name='meet_cat' value='".$option['cat_id']."'>".$option['cat_title']."</option>";}



$text .="</td>

        </tr>





        <tr style='vertical-align:top'>

        <td colspan='3' style='text-align:center' class='forumheader'>

        ".$rs->form_hidden("id", "".$row['meet_id']."")."

        ".$rs -> form_button("submit", "update_meeting", "".AMP_31."")."

        </td>

        </tr>





        </table>

        ".$rs -> form_close()."

        </div>";}



else



{$text .= "<i>".MP_19."!</i>";}



//-----------------------------------------------------------------------------------------------------------+



$ns -> tablerender("", $text);

require_once(FOOTERF);





?>



