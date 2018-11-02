<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
        global $cal;
        return $cal->load_files();
}

if (is_readable(THEME . "rendeles_template.php")){
    require_once(THEME . "rendeles_template.php");}
else{
    require_once(e_PLUGIN . "rendeles/rendeles_template.php");}

require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN."rendeles/languages/".e_LANGUAGE.".php");

   $text .= $tp->parseTemplate($RENDELES_HEADER, false);
   $ns -> tablerender("".RENDELES_18."", $text);	

$qp = new rendeles;

class rendeles {
	var $message;
	function rendeles() {
				
		if(isset($_POST['edit'])) {
			$this -> editSme();
		}
		else if(!$_POST['edit']) {
			$this -> showList();
		}
	}

function showList() {
	global $sql,$ns,$tp,$pref;
	$gen = new convert;

// lapozás ------------------------------------------------------------------------------
    $from = ($_GET['frm']) ? $_GET['frm'] : 0;
    $total_items = $sql -> db_Select("rendeles", "*", "rendeles_id"); 	
// lapozás ------------------------------------------------------------------------------

  if (isset($_GET['togglecomp'])){
	$sql->db_Update('rendeles', "rendeles_completed='".($_GET['togglecomp'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
	
	$count = $sql -> db_Select_gen("
  SELECT * 
  FROM #rendeles r 
  
  inner join #rendeles_customer c 
  on r.rendeles_customerid = c.rendeles_customer_id 
  
  inner join #rendeles_banner b 
  on r.rendeles_bannerid = b.rendeles_banner_id 
  
  inner join #rendeles_type t 
  on r.rendeles_typeid = t.rendeles_type_id 
  
  WHERE rendeles_completed='1' 
  LIMIT $from,".$pref['rendeles_perpage']."
  ");

	$text = "<div style='text-align:center'>";

	if (!$count) {
		$text .= "".RENDELES_ADLAN_13."";
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_24."</div>", $text);
		exit;
	}

	else {
		$text .= "
      <form action='".e_SELF."' id='display' method='post'>	
        <div style='text-align: center;'>
          <center>		
            <table style='".USER_WIDTH."' class='fborder'>				
              <tr>	
					      <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_28."</td>
					      <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_32."</td>
					      <td style='width:10%; text-align: center;' class='fcaption'><a href='".$eplug_folder."type.php' title='".RENDELES_22."'>".RENDELES_33."</a></td>
					      <td style='width:15%; text-align: center;' class='fcaption'><a href='".$eplug_folder."banners.php' title='".RENDELES_21."'>".RENDELES_34."</a></td>
					      <td style='width:15%; text-align: center;' class='fcaption'><a href='".$eplug_folder."location.php' title='".RENDELES_37."'>".RENDELES_35."</a></td>
					      <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_36."</td>
					      <td style='width:5%;  text-align: center;' class='fcaption'><a href='".$eplug_folder."completed.php' title='".RENDELES_24."'>".RENDELES_30."</a></td>
              </tr>			
    ";

		while($row2 = $sql-> db_Fetch()){
			$text .= "
              <tr>         
                <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'><a href='".$eplug_folder."fullrendeles.php?cid=$row2[rendeles_customer_id]&amp;id=$row2[rendeles_id]'>".$tp->toHTML($row2['rendeles_customer_name'],"","defs")."</a></td>					
                <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>".$rendeles_date_b = $gen -> convert_date($row2['rendeles_date_b'], short)."</td>			
					      <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_type_name'],"","defs")."</td>
					      <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_banner_banners'],"","defs")."</td>
					      <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_location'],"","defs")."</td>
					      <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_comment'],"","defs")."</td>
					      <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>
	                <a href='".e_SELF."?togglecomp=$row2[rendeles_completed]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_completed'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	                  <img src='".$eplug_folder."images/$row2[rendeles_completed].gif' />
	                </a>
                </td>
              </tr>				
      ";
		}}
	$text .= "
            </table>
          </center>
        </div>
      </form>";
	
// lapozás ------------------------------------------------------------------------------     
  $parms = $total_items.",".$pref['rendeles_perpage'].",".$from.",".e_SELF.'?frm=[FROM]';
  $text .= $tp->parseTemplate("{NEXTPREV={$parms}}");
// lapozás ------------------------------------------------------------------------------	
	
	$ns -> tablerender("<div style='text-align:center'>".RENDELES_24."</div>", $text);

}}

?>