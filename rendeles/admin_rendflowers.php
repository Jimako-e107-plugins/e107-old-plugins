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
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN."rendeles/languages/".e_LANGUAGE.".php");

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
		if(isset($_POST['delete'])) {
			$this -> deleteSme();
		}
		if(isset($_POST['add_com'])) {
			$this -> addCom();
		}
		if(isset($_POST['up_conf'])) {
			$this -> upConf();
		}
		if($this -> message) {
			echo "<br /><div style='text-align:center'><b>".$this -> message."</b></div><br />";
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
    $total_items = $sql -> db_Select("rendeles_rendflowers", "*", "rendeles_rendflowers_id"); 	
// lapozás ------------------------------------------------------------------------------
		
    $sql->db_query("select * from ".MPREFIX."rendeles ");
		$count = $sql -> db_Select_gen("SELECT * 
		
    FROM #rendeles_rendflowers g

    inner join #rendeles_flower b
    on g.rendeles_rendflowers_flowerid = b.rendeles_flower_id

    inner join #rendeles_color f
    on g.rendeles_rendflowers_colorid = f.rendeles_color_id

    inner join #rendeles c
    on g.rendeles_rendflowers_rendelesid = c.rendeles_id
    
    inner join #rendeles_customer d 
    on c.rendeles_customerid = d.rendeles_customer_id 
    
    inner join #rendeles_type t 
    on c.rendeles_typeid = t.rendeles_type_id 
    
    ORDER BY rendeles_id ASC
    LIMIT $from,".$pref['rendeles_perpage']."
    
    ", false);     
    
    $text = "<div style='text-align:center'>";
		/* Ha üres, nincs még Rendelés */
		if (!$count) {
			$text .= "".RENDELES_ADLAN_13."";
			$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_37."</div>", $text);
			require_once(e_ADMIN."footer.php");
			exit;
		}
		/* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Rendelés */
		else {
			$text .= "<form action='".e_SELF."' id='display' method='post'>
			<table style='".ADMIN_WIDTH."' class='fborder'>
				<tr>
					<td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_10."</td>
					<td style='width:5%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_50."</td>
					<td style='width:5%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_51."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_38."</td>
					<td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_25."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_20."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_21."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_22."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_52."</td>
					<td style='width:5%;  text-align: center;' class='fcaption'>".LAN_OPTIONS."</td>
				</tr>
			";
			/* Rendelések kilistázása, ID szerint növekvő sorrendben */
      while($row2 = $sql-> db_Fetch()){
				$text .= "<tr>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$row2['rendeles_rendflowers_id']."</td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$row2['rendeles_rendflowers_rendelesid']."</td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$row2['rendeles_rendflowers_flowerid']."</td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_customer_name'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_type_name'],"","defs")."</td>
          <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_flower_name'],"","defs")."</td>					
          <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_color_name'],"","defs")."</td>			
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_flower_size'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_rendflowers_darab'],"","defs")."</td>
					<td style='width: 50px; white-space: nowrap; text-align: center; background: url(".$eplug_folder."images/$row2[rendeles_color_name].png) repeat-x top left;' class='forumheader3'>
						<div>
							<input type='image' name='delete[{$row2['rendeles_rendflowers_id']}]' value='del' onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL." [".$row2['rendeles_rendflowers_id']."]")."') \" src='".e_IMAGE."admin_images/delete_16.png' alt='".LAN_DELETE."' title='".LAN_DELETE."' style='border:0px' />
						</div>
					</td>
				</tr>
				";
			}
		}
		$text .= "</table>\n</form><br /></div>";
		
// lapozás ------------------------------------------------------------------------------     
  $parms = $total_items.",".$pref['rendeles_perpage'].",".$from.",".e_SELF.'?frm=[FROM]';
  $text .= $tp->parseTemplate("{NEXTPREV={$parms}}");
// lapozás ------------------------------------------------------------------------------
		
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_37."</div>", $text);
	
	}
	

	/* --------------------------------------------------------------------------*/
	/* Rendelés törlésének a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
	function deleteSme() {
		global $sql;
		$d_idt = array_keys($_POST['delete']);
		$this -> message = ($sql -> db_Delete("rendeles_rendflowers", "rendeles_rendflowers_id='".$d_idt[0]."'")) ? LAN_DELETED : LAN_DELETED_FAILED;
	}
}

require_once(e_ADMIN."footer.php");

?>