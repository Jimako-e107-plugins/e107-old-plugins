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
		
  /* ----------------------------------------------------------------------- */
  /* Konstruktor */
	/* ----------------------------------------------------------------------- */
		
		if(isset($_POST['edit'])) {
			$this -> editSme();
		}
		else if(!$_POST['edit']) {
			$this -> showList();
		}
	}

/* --------------------------------------------------------------------------*/
/* Szalagfeliratok kilistázása */
/* --------------------------------------------------------------------------*/

function showList() {
	global $sql,$ns,$tp,$pref;
	$gen = new convert;
	
// lapozás ------------------------------------------------------------------------------
    $from = ($_GET['frm']) ? $_GET['frm'] : 0;
    $total_items = $sql -> db_Select("rendeles", "*", "rendeles_id"); 	
// lapozás ------------------------------------------------------------------------------

      if (isset($_GET['togglecomp'])){
	    $sql->db_Update('rendeles', "rendeles_bannerscompleted='".($_GET['togglecomp'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      $sql->db_query("select * from ".MPREFIX."rendeles ");     
    
	$count = $sql -> db_Select_gen("
	SELECT *
  FROM #rendeles r

  inner join #rendeles_customer c
  on r.rendeles_customerid = c.rendeles_customer_id

  inner join #rendeles_banner b
  on r.rendeles_bannerid = b.rendeles_banner_id

  ORDER BY rendeles_id ASC
  LIMIT $from,".$pref['rendeles_perpage']."
  ", false);
  
	$text = "<div style='text-align:center'>";
	/* Ha üres, nincs még szalagfelirat */
	if (!$count) {
		$text .= "".RENDELES_ADLAN_13."";
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_3."</div>", $text);
		exit;
	}
	/* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Szalagfelirat */
	else {
		$text .= "
      <form action='".e_SELF."' id='display' method='post'>	
        <div style='text-align: center;'>
          <center>		
            <table style='".USER_WIDTH."' class='fborder'>				
              <tr>									
                <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_28."</td>					
                <td style='width:40%; text-align: center;' class='fcaption'>".RENDELES_34."</td>
                <td style='width:25%; text-align: center;' class='fcaption'>".RENDELES_15."</td>
                <td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_31."</td>
              </tr>			
    ";
		/* Szalagfeliratok kilistázása, ID szerint növekvő sorrendben */
		while($row2 = $sql-> db_Fetch()){
			$text .= "
              <tr>										
                <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_bannerscompleted].png) repeat-x top left;'><a href='".$eplug_folder."fullrendeles.php?cid=$row2[rendeles_customer_id]&amp;id=$row2[rendeles_id]'>".$tp->toHTML($row2['rendeles_customer_name'],"","defs")."</a></td>					
                <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_bannerscompleted].png) repeat-x top left; text-transform: uppercase;'>".$tp->toHTML($row2['rendeles_banner_banners'],"","defs")."</td>			
                <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_bannerscompleted].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_comment'],"","defs")."</td>
                <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_bannerscompleted].png) repeat-x top left;'>
	                <a href='".e_SELF."?togglecomp=$row2[rendeles_bannerscompleted]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_bannerscompleted'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	                  <img src='".$eplug_folder."images/$row2[rendeles_bannerscompleted].gif' />
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
      
	$ns -> tablerender("<div style='text-align:center'>".RENDELES_21."</div>", $text);

}}

?>