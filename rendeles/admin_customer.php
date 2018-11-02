<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
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
	/* Megrendelők kilistázása */
	/* --------------------------------------------------------------------------*/
	
	function showList() {
		global $sql,$ns,$tp,$pref;
		$gen = new convert;
		
// lapozás ------------------------------------------------------------------------------
    $from = ($_GET['frm']) ? $_GET['frm'] : 0;
    $total_items = $sql -> db_Select("rendeles_customer", "*", "rendeles_customer_id"); 	
// lapozás ------------------------------------------------------------------------------
		
		$count = $sql -> db_Select_gen("SELECT * FROM #rendeles_customer  
	  WHERE rendeles_customer_id !=0 ORDER BY rendeles_customer_id ASC
    LIMIT $from,".$pref['rendeles_perpage']."
    ", false);
	
		$text = "<div style='text-align:center'>";
		/* Ha üres, nincs még virág */
		if (!$count) {
			$text .= "".RENDELES_ADLAN_13."";
			$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_9."</div>", $text);
			require_once(e_ADMIN."footer.php");
			exit;
		}
		/* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Megrendelő */
		else {
			$text .= "<form action='".e_SELF."' id='display' method='post'>
			<table style='".ADMIN_WIDTH."' class='fborder'>
				<tr>
					<td style='width:5%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_10."</td>
					<td style='width:30%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_27."</td>
					<td style='width:30%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_28."</td>
					<td style='width:30%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_29."</td>
					<td style='width:5%; text-align: center;' class='fcaption'>".LAN_OPTIONS."</td>
				</tr>
			";
			/* Megrendelők kilistázása, ID szerint növekvő sorrendben */
			while($row2 = $sql-> db_Fetch()){
				$text .= "<tr>
					<td class='forumheader3' style='text-align: center;'>".$row2['rendeles_customer_id'] ."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_customer_name'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_customer_address'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_customer_email'],"","defs")."</td>
					<td style='width:50px;white-space:nowrap;text-align: center;' class='forumheader3'>
						<div>
							<input type='image' name='edit[{$row2['rendeles_customer_id']}]' value='edit' src='".e_IMAGE."admin_images/edit_16.png' alt='".LAN_EDIT."' title='".LAN_EDIT."' style='border:0px' />
							<input type='image' name='delete[{$row2['rendeles_customer_id']}]' value='del' onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL." [".$row2['rendeles_customer_id']."]")."') \" src='".e_IMAGE."admin_images/delete_16.png' alt='".LAN_DELETE."' title='".LAN_DELETE."' style='border:0px' />
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
		
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_9."</div>", $text);
		
	}

	/* --------------------------------------------------------------------------*/
	/* Megrendelő lekérése módosításhoz, átadás a doForm-nak */
	/* --------------------------------------------------------------------------*/
  
  function editSme() {
		global $sql, $tp;
		$e_idt = array_keys($_POST['edit']);
		if($sql -> db_Select("rendeles_customer", "*", "rendeles_customer_id='".$e_idt[0]."' ")) {
			$foo = $sql -> db_Fetch();
			$foo['rendeles_customer_name'] = $tp -> toFORM($foo['rendeles_customer_name']);
			$foo['rendeles_customer_address'] = $tp -> toFORM($foo['rendeles_customer_address']);
			$foo['rendeles_customer_email'] = $tp -> toFORM($foo['rendeles_customer_email']);
			$this -> doForm($foo);
		}
	}
	
	/* --------------------------------------------------------------------------*/
	/* Admin űrlap a Megrendelő módosításához */
	/* --------------------------------------------------------------------------*/
  
  function doForm($editArray=FALSE) {
		global $sql,$ns;
		$count = $sql -> db_Select("rendeles_customer", "*", "rendeles_customer_id !=0 ORDER BY rendeles_customer_id ASC");
		$text = "<form action='".e_SELF."' id='form' method='post'>
		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td style='width:25%' class='forumheader3'>".RENDELES_ADLAN_27."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_customer_name' class='tbox' style='width:300px' value='".$editArray['rendeles_customer_name']."' />
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>".RENDELES_ADLAN_28."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_customer_address' class='tbox' style='width:700px' value='".$editArray['rendeles_customer_address']."' />
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>".RENDELES_ADLAN_29."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_customer_email' class='tbox' style='width:300px' value='".$editArray['rendeles_customer_email']."' />
				</td>
			</tr>
			<tr style='vertical-align:top'>
				<td colspan='2' style='text-align:center' class='forumheader'>
					<input class='button' type='submit' name='add_com' value='".LAN_UPDATE."' />
					<input type='hidden' name='rendeles_customer_id' value='".$editArray['rendeles_customer_id']."' />
				</td>
			</tr>
		</table>
		</form>
		";
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_30."</div>", $text);
	}
	
	/* --------------------------------------------------------------------------*/
	/* Megrendelő módosításának a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
	function addCom() {
		global $sql, $tp;
		$rendeles_customer = $tp -> toDB($_POST['rendeles_customer']);
		$rendeles_customer_name = $tp -> toDB($_POST['rendeles_customer_name']);
		$rendeles_customer_address = $tp -> toDB($_POST['rendeles_customer_address']);
		$rendeles_customer_email = $tp -> toDB($_POST['rendeles_customer_email']);
		if(isset($_POST['rendeles_customer_id'])) {
			$this -> message = $sql -> db_Update("rendeles_customer", "rendeles_customer_name='".$rendeles_customer_name."', rendeles_customer_address='".$rendeles_customer_address."', rendeles_customer_email='".$rendeles_customer_email."' WHERE rendeles_customer_id='".$_POST['rendeles_customer_id']."' ") ? LAN_UPDATED : LAN_UPDATED_FAILED;
    }
	}

	/* --------------------------------------------------------------------------*/
	/* Megrendelő törlésének a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
	function deleteSme() {
		global $sql;
		$d_idt = array_keys($_POST['delete']);
		$this -> message = ($sql -> db_Delete("rendeles_customer", "rendeles_customer_id='".$d_idt[0]."'")) ? LAN_DELETED : LAN_DELETED_FAILED;
	}
}

require_once(e_ADMIN."footer.php");

?>