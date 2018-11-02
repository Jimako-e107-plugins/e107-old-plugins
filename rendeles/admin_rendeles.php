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
    $total_items = $sql -> db_Select("rendeles", "*", "rendeles_id"); 	
// lapozás ------------------------------------------------------------------------------

			if (isset($_GET['togglecomp_1'])){
	    $sql->db_Update('rendeles', "rendeles_paid='".($_GET['togglecomp_1'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      if (isset($_GET['togglecomp_2'])){
	    $sql->db_Update('rendeles', "rendeles_completed='".($_GET['togglecomp_2'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      if (isset($_GET['togglecomp_3'])){
	    $sql->db_Update('rendeles', "rendeles_bannerscompleted='".($_GET['togglecomp_3'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      
    $sql->db_query("select * from ".MPREFIX."rendeles ");
		$count = $sql -> db_Select_gen("SELECT * 
    FROM #rendeles r 
    
    inner join #rendeles_customer c 
    on r.rendeles_customerid = c.rendeles_customer_id 
    
    inner join #rendeles_banner b 
    on r.rendeles_bannerid = b.rendeles_banner_id 
    
    inner join #rendeles_type t 
    on r.rendeles_typeid = t.rendeles_type_id 
    
    ORDER BY rendeles_id ASC
    LIMIT $from,".$pref['rendeles_perpage']."
    ", false);     
    
    $text = "<div style='text-align:center'>";
		/* Ha üres, nincs még Rendelés */
		if (!$count) {
			$text .= "".RENDELES_ADLAN_13."";
			$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_34."</div>", $text);
			require_once(e_ADMIN."footer.php");
			exit;
		}
		/* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Rendelés */
		else {
			$text .= "<form action='".e_SELF."' id='display' method='post'>
			<table style='".ADMIN_WIDTH."' class='fborder'>
				<tr>
					<td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_10."</td>
					<td style='width:8%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_35."</td>
					<td style='width:8%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_36."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_38."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_39."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_40."</td>
					<td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_44."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_49."</td>
          <td style='width:4%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_53."</td>
					<td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_41."</td>
					<td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_42."</td>
					<td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_ADLAN_43."</td>
					<td style='width:5%;  text-align: center;' class='fcaption'>".LAN_OPTIONS."</td>
				</tr>
			";
			/* Rendelések kilistázása, ID szerint növekvő sorrendben */
      while($row2 = $sql-> db_Fetch()){
	      $eredmeny = calcPrice($row2['rendeles_id']);
				$text .= "<tr>
					<td class='forumheader3' style='text-align: center;'>".$row2['rendeles_id'] ."</td>
					<td class='forumheader3' style='text-align: center;'>".$rendeles_date_a = $gen -> convert_date($row2['rendeles_date_a'], short)."</td>
					<td class='forumheader3' style='text-align: center;'>".$rendeles_date_b = $gen -> convert_date($row2['rendeles_date_b'], short)."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_customer_name'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_type_name'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_banner_banners'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_comment'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_location'],"","defs")."</td>
          <td class='forumheader3' style='text-align: center;'>".$eredmeny."".$pref['rendeles_currency']."</td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_paid].png) repeat-x top left;'>
	          <a href='".e_SELF."?togglecomp_1=$row2[rendeles_paid]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_paid'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	            <img src='".$eplug_folder."images/$row2[rendeles_paid].gif' />
	          </a>
          </td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>
	          <a href='".e_SELF."?togglecomp_2=$row2[rendeles_completed]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_completed'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	            <img src='".$eplug_folder."images/$row2[rendeles_completed].gif' />
	          </a>
          </td>
					<td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_bannerscompleted].png) repeat-x top left;'>
	          <a href='".e_SELF."?togglecomp_3=$row2[rendeles_bannerscompleted]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_bannerscompleted'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	            <img src='".$eplug_folder."images/$row2[rendeles_bannerscompleted].gif' />
	          </a>
          </td>
          <td style='width:50px;white-space:nowrap;text-align: center;' class='forumheader3'>
						<div>
							<input type='image' name='edit[{$row2['rendeles_id']}]' value='edit' src='".e_IMAGE."admin_images/edit_16.png' alt='".LAN_EDIT."' title='".LAN_EDIT."' style='border:0px' />
							<input type='image' name='delete[{$row2['rendeles_id']}]' value='del' onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL." [".$row2['rendeles_id']."]")."') \" src='".e_IMAGE."admin_images/delete_16.png' alt='".LAN_DELETE."' title='".LAN_DELETE."' style='border:0px' />
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
		
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_34."</div>", $text);
	
	}

	/* --------------------------------------------------------------------------*/
	/* Rendelés lekérése módosításhoz, átadás a doForm-nak */
	/* --------------------------------------------------------------------------*/
  
  function editSme() {
		global $sql, $tp;
		$e_idt = array_keys($_POST['edit']);
		if($sql -> db_Select("rendeles", "*", "rendeles_id='".$e_idt[0]."' ")) {
			$foo = $sql -> db_Fetch();
			$foo['rendeles_comment'] = $tp -> toFORM($foo['rendeles_comment']);
			$foo['rendeles_location'] = $tp -> toFORM($foo['rendeles_location']);
			$this -> doForm($foo);
		}
	}
	
	/* --------------------------------------------------------------------------*/
	/* Admin űrlap a Rendelés módosításához */
	/* --------------------------------------------------------------------------*/
  
  function doForm($editArray=FALSE) {
		global $sql,$ns;
		$cal = new DHTML_Calendar(true);
		$count = $sql -> db_Select("rendeles", "*", "rendeles_id !=0 ORDER BY rendeles_customer_id ASC");	
    $text = "<form action='".e_SELF."' id='form' method='post'>
		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td style='width:25%' class='forumheader3'>".RENDELES_ADLAN_35."<span class='smalltext'>&nbsp;</span></td>       
        <td class='forumheader3'>";
        
    $_rendeles_date_a = $editArray['rendeles_date_a'] ? strftime("%Y/%m/%d %H:%M", $editArray['rendeles_date_a']) : "";
    $cal_options['firstDay'] = 1;
    $cal_options['showsTime'] = true;
    $cal_options['showOthers'] = true;
    $cal_options['weekNumbers'] = false;
    $cal_options['ifFormat'] = "%Y/%m/%d %H:%M";
    $cal_options['timeFormat'] = "24";
    $cal_attrib['class'] = "tbox";
    $cal_attrib['size'] = "19";
    $cal_attrib['name'] = "rendeles_date_a";
    $cal_attrib['value'] = $_rendeles_date_a;
    
    $text .= $cal->make_input_field($cal_options, $cal_attrib)."
        </td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>".RENDELES_ADLAN_36."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>";			
				
    $_rendeles_date_b = $editArray['rendeles_date_b'] ? strftime("%Y/%m/%d %H:%M", $editArray['rendeles_date_b']) : "";
    $cal_options['firstDay'] = 1;
    $cal_options['showsTime'] = true;
    $cal_options['showOthers'] = true;
    $cal_options['weekNumbers'] = false;
    $cal_options['ifFormat'] = "%Y/%m/%d %H:%M";
    $cal_options['timeFormat'] = "24";
    $cal_attrib['class'] = "tbox";
    $cal_attrib['size'] = "19";
    $cal_attrib['name'] = "rendeles_date_b";
    $cal_attrib['value'] = $_rendeles_date_b;
    
    $text .= $cal->make_input_field($cal_options, $cal_attrib)."
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>".RENDELES_ADLAN_44."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_comment' class='tbox' style='width:300px' value='".$editArray['rendeles_comment']."' />
				</td>
			</tr>
			<tr>
			<td style='width:25%' class='forumheader3'>".RENDELES_ADLAN_49."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_location' class='tbox' style='width:300px' value='".$editArray['rendeles_location']."' />
				</td>
			</tr>
			<tr style='vertical-align:top'>
				<td colspan='2' style='text-align:center' class='forumheader'>
					<input class='button' type='submit' name='add_com' value='".LAN_UPDATE."' />
					<input type='hidden' name='rendeles_id' value='".$editArray['rendeles_id']."' />
				</td>
			</tr>
		</table>
		</form>
		";
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_45."</div>", $text);
	}
	
	/* --------------------------------------------------------------------------*/
	/* Rendelés módosításának a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
function addCom() {
	global $sql, $tp;
	$rendeles_date_a = strtotime($_POST['rendeles_date_a']);
	$rendeles_date_b = strtotime($_POST['rendeles_date_b']);
	$rendeles_comment = $tp -> toDB($_POST['rendeles_comment']);
	$rendeles_location = $tp -> toDB($_POST['rendeles_location']);
	if(isset($_POST['rendeles_id'])) {
		$this -> message = $sql -> db_Update("rendeles", 
			"rendeles_date_a='$rendeles_date_a', 
			rendeles_date_b='$rendeles_date_b', 
			rendeles_comment='$rendeles_comment', 
			rendeles_location='$rendeles_location' 
			WHERE rendeles_id='".intval($_POST['rendeles_id'])."' ") ? LAN_UPDATED : LAN_UPDATED_FAILED;
	}
}

	/* --------------------------------------------------------------------------*/
	/* Rendelés törlésének a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
function deleteSme() {
	global $sql;
	$d_idt = array_keys($_POST['delete']);
	$this -> message = ($sql -> db_Delete("rendeles_rendflowers", "rendeles_rendflowers_rendelesid='".$d_idt[0]."'")) ? LAN_DELETED : LAN_DELETED_FAILED;
	$this -> message = ($sql -> db_Delete("rendeles", "rendeles_id='".$d_idt[0]."'")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
	
}

require_once(e_ADMIN."footer.php");

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