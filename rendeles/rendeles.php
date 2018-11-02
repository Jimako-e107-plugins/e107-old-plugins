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
		if(e_QUERY == "show") {
			$this -> showList();
		}
		else if(!$_POST['edit']) {
			$this -> showList();
		}
	}	

	/* --------------------------------------------------------------------------*/
	/* Rendelések kilistázása */
	/* --------------------------------------------------------------------------*/
			
	function showList() { 	
	
		global $sql,$ns,$tp,$pref;
		$gen = new convert;
 
// lapozás ------------------------------------------------------------------------------
    $from = ($_GET['frm']) ? $_GET['frm'] : 0;
    $total_items = $sql -> db_Select("rendeles", "*", "rendeles_id"); 	
// lapozás ------------------------------------------------------------------------------
  
  if (isset($_GET['did'])){
	  $did = "where r.rendeles_date_b = '".intval($_GET['did'])."' ";} 
  else $did = "";	
  
  if (isset($_GET['tid'])){
	  $tid = "where r.rendeles_typeid = '".intval($_GET['tid'])."' ";} 
  else $tid = "";	
  
  if (isset($_GET['bid'])){
	  $bid = "where r.rendeles_bannerid = '".intval($_GET['bid'])."' ";} 
  else $bid = "";	
  
			if (isset($_GET['togglecomp_1'])){
	    $sql->db_Update('rendeles', "rendeles_paid='".($_GET['togglecomp_1'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      if (isset($_GET['togglecomp_2'])){
	    $sql->db_Update('rendeles', "rendeles_completed='".($_GET['togglecomp_2'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      if (isset($_GET['togglecomp_3'])){
	    $sql->db_Update('rendeles', "rendeles_bannerscompleted='".($_GET['togglecomp_3'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      
      $sql->db_query("select * from ".MPREFIX."rendeles ");
      
		$count = $sql -> db_Select_gen("
    SELECT * FROM 
    #rendeles r 
    
    inner join #rendeles_customer c 
    on r.rendeles_customerid = c.rendeles_customer_id 
    
    inner join #rendeles_banner b 
    on r.rendeles_bannerid = b.rendeles_banner_id 
    
    inner join #rendeles_type t 
    on r.rendeles_typeid = t.rendeles_type_id 
    
    $did
    $tid
    $bid
    ORDER BY r.rendeles_id ASC
    LIMIT $from,".$pref['rendeles_perpage']."
    ", false);     

    $text = "<div style='text-align:center'>";
		/* Ha üres, nincs még Rendelés */
		if (!$count) {
			$text .= "".RENDELES_ADLAN_13."";
			$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_34."</div>", $text);
			exit;
		}
		/* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Rendelés */
		else {
			$text .= "
      <form action='".e_SELF."' id='display' method='post'>
			  <center>
			  <table class='fborder'>
				  <tr>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_28."</td>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_32."</td>
					  <td style='width:10%; text-align: center;' class='fcaption'><a href='".$eplug_folder."type.php' title='".RENDELES_22."'>".RENDELES_33."</a></td>
					  <td style='width:15%; text-align: center;' class='fcaption'><a href='".$eplug_folder."banners.php' title='".RENDELES_21."'>".RENDELES_34."</a></td>
					  <td style='width:15%; text-align: center;' class='fcaption'><a href='".$eplug_folder."location.php' title='".RENDELES_37."'>".RENDELES_35."</a></td>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_36."</td>
					  <td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_54."</td>
					  <td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_31."</td>
					  <td style='width:5%;  text-align: center;' class='fcaption'><a href='".$eplug_folder."completed.php' title='".RENDELES_24."'>".RENDELES_30."</a></td>
					  <td style='width:5%;  text-align: center;' class='fcaption'><a href='".$eplug_folder."paid.php' title='".RENDELES_23."'>".RENDELES_29."</a></td>
				  </tr>
			";			
			/* Rendelések kilistázása, ID szerint növekvő sorrendben */
      while($row2 = $sql-> db_Fetch()){

	      $eredmeny = calcPrice($row2['rendeles_id']);

				$text .= "
          <tr>
					  <td class='forumheader3' style='text-align: center;'><a href='".$eplug_folder."fullrendeles.php?cid=$row2[rendeles_customer_id]&amp;id=$row2[rendeles_id]'>".$tp->toHTML($row2['rendeles_customer_name'],"","defs")."</a></td>
					  <td class='forumheader3' style='text-align: center;'><a href='?did=$row2[rendeles_date_b]&amp;id=$row2[rendeles_id]'>".$rendeles_date_b = $gen -> convert_date($row2['rendeles_date_b'], short)."</a></td>					  
            <td class='forumheader3' style='text-align: center;'><a href='?tid=$row2[rendeles_type_id]&amp;id=$row2[rendeles_id]'>".$tp->toHTML($row2['rendeles_type_name'],"","defs")."</a></td>
					  <td class='forumheader3' style='text-align: center;'><a href='?bid=$row2[rendeles_banner_id]&amp;id=$row2[rendeles_id]'>".$tp->toHTML($row2['rendeles_banner_banners'],"","defs")."</a></td>
					  <td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_location'],"","defs")."</td>
					  <td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_comment'],"","defs")."</td>
					  <td class='forumheader3' style='text-align: center;'>".$eredmeny."".$pref['rendeles_currency']."</td>
					  <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_bannerscompleted].png) repeat-x top left;'>
	            <a href='".e_SELF."?togglecomp_3=$row2[rendeles_bannerscompleted]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_bannerscompleted'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	              <img src='".$eplug_folder."images/$row2[rendeles_bannerscompleted].gif' />
	            </a>
            </td>            
					  <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>
	            <a href='".e_SELF."?togglecomp_2=$row2[rendeles_completed]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_completed'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	              <img src='".$eplug_folder."images/$row2[rendeles_completed].gif' />
	            </a>
            </td>
            <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_paid].png) repeat-x top left;'>
	            <a href='".e_SELF."?togglecomp_1=$row2[rendeles_paid]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_paid'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	              <img src='".$eplug_folder."images/$row2[rendeles_paid].gif' />
	            </a>
            </td>            
				  </tr>
				";
			}
		}
		$text .= "
        </table>
      <center>
    </form><br />
    ";

// lapozás ------------------------------------------------------------------------------     
  $parms = $total_items.",".$pref['rendeles_perpage'].",".$from.",".e_SELF.'?frm=[FROM]';
  $text .= $tp->parseTemplate("{NEXTPREV={$parms}}");
// lapozás ------------------------------------------------------------------------------

		$ns -> tablerender("<div style='text-align:center'>".RENDELES_27."</div>", $text);
	
	}}

function calcPrice($rendelesid)
{
	$sql = new db();
	$qry = "
		select
		(sum(flower_sum.fprice) + other_sum.tp + other_sum.bp) as price
		from
			(select
			r.rendeles_id as rid,
			rf.rendeles_rendflowers_darab as fdb,
			rendeles_flower_price as fe,
			rf.rendeles_rendflowers_darab * f.rendeles_flower_price as fprice
			from
				".MPREFIX."rendeles r
				inner join ".MPREFIX."rendeles_rendflowers rf
					on r.rendeles_id = rf.rendeles_rendflowers_rendelesid
				inner join ".MPREFIX."rendeles_flower f
					on rf.rendeles_rendflowers_flowerid = f.rendeles_flower_id
				where rendeles_id = $rendelesid) as flower_sum,
			(select
			t.rendeles_type_price as tp,
			b.rendeles_banner_price as bp
			from
				".MPREFIX."rendeles r
				inner join ".MPREFIX."rendeles_type t
					on r.rendeles_typeid = t.rendeles_type_id
				inner join ".MPREFIX."rendeles_banner b
					on r.rendeles_bannerid = b.rendeles_banner_id
				where rendeles_id = $rendelesid) as other_sum
		";
	$sql->db_query($qry);
	$row = $sql->db_fetch();
	return $row ? $row['price'] : 0;
}	
	
?>