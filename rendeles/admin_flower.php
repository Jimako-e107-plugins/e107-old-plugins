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
  /* Virágok kilistázása */
  /* --------------------------------------------------------------------------*/

  function showList() {
	  global $sql,$ns,$tp,$pref;
	  $gen = new convert;
	
// lapozás ------------------------------------------------------------------------------
    $from = ($_GET['frm']) ? $_GET['frm'] : 0;
    $total_items = $sql -> db_Select("rendeles_flower", "*", "rendeles_flower_id"); 	
// lapozás ------------------------------------------------------------------------------
	
     /* Új Virág küldése */		
     if (isset($_POST['kuldes'])) {

	    $sql -> db_Insert("rendeles_flower", "'".$_POST['rendeles_flower_id']."', '".$_POST['rendeles_flower_name']."', '".$_POST['rendeles_flower_size']."', '".$_POST['rendeles_flower_price']."'");
    
      $text = "<span class='smalltext'>".RENDELES_ADLAN_18."</span><br /><br />";
  }
	
	  $count = $sql -> db_Select_gen("SELECT * FROM #rendeles_flower  
    WHERE rendeles_flower_id !=0 ORDER BY rendeles_flower_id ASC
    LIMIT $from,".$pref['rendeles_perpage']."
    ", false);

	  $text .= "<div style='text-align:center'>";
	  /* Ha üres, nincs még Virág */
	  if (!$count) {
		  $text .= "".RENDELES_ADLAN_13."";
		  $ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_5."</div>", $text);
		  
      $text = "<form action='".e_SELF."' method='post'>";
      $text .="
		    <table class='fborder' style='width:100%'>
			    <tr>
				    <td style='width:33%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_20."</span></td>
				    <td class='forumheader3'>
					    <input type='text' name='rendeles_flower_name' class='tbox' style='width:700px' value='' />
				    </td>
			    </tr>
          <tr>
				    <td style='width:33%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_22."</span></td>
				    <td class='forumheader3'>
					    <input type='text' name='rendeles_flower_size' class='tbox' style='width:200px' value='' />
				    </td>
			    </tr>	
			    <tr>
				    <td style='width:33%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_11."</span></td>
				    <td class='forumheader3'>
              <input type='text' name='rendeles_flower_price' class='tbox' style='width:200px' value='' />".$pref['rendeles_currency']."
            </td>
			    </tr>
			    <tr style='vertical-align:top'>
				    <td colspan='2' style='text-align:center' class='forumheader'>
					    <input class='button' type='submit' name='post' value='".RENDELES_ADLAN_23."' />
					    <input type='hidden' name='kuldes' value='kuldes' />
				    </td>
			    </tr>
		    </table>
      ";
      $text .= "</form>";

     $ns -> tablerender("".RENDELES_ADLAN_6."", $text);
		  
		  require_once(e_ADMIN."footer.php");
		  exit;
	  }
	  /* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Virág */
	  else {
		  $text .= "<form action='".e_SELF."' id='display' method='post'>
		  <table style='".ADMIN_WIDTH."' class='fborder'>
				<tr>
					<td style='width:5%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_10."</td>
					<td style='width:70%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_5."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_22."</td>
					<td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_11."</td>
					<td style='width:5%; text-align: center;' class='fcaption'>".LAN_OPTIONS."</td>
				</tr>
		  ";
		  /* Virágok kilistázása, ID szerint növekvő sorrendben */
		  while($row2 = $sql-> db_Fetch()){
			  $text .= "
        <tr>
					<td class='forumheader3' style='text-align: center;'>".$row2['rendeles_flower_id'] ."</td>
					<td class='forumheader3'>".$tp->toHTML($row2['rendeles_flower_name'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_flower_size'],"","defs")."</td>
					<td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_flower_price'],"","defs")."".$pref['rendeles_currency']."</td>
					<td style='width:50px;white-space:nowrap;text-align: center;' class='forumheader3'>
						<div>
							<input type='image' name='edit[{$row2['rendeles_flower_id']}]' value='edit' src='".e_IMAGE."admin_images/edit_16.png' alt='".LAN_EDIT."' title='".LAN_EDIT."' style='border:0px' />
							<input type='image' name='delete[{$row2['rendeles_flower_id']}]' value='del' onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL." [".$row2['rendeles_flower_id']."]")."') \" src='".e_IMAGE."admin_images/delete_16.png' alt='".LAN_DELETE."' title='".LAN_DELETE."' style='border:0px' />
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
	  
	  $ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_5."</div>", $text);

      $text = "<form action='".e_SELF."' method='post'>";
      $text .="
		    <table class='fborder' style='width:100%'>
			    <tr>
				    <td style='width:25%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_20."</span></td>
				    <td class='forumheader3'>
					    <input type='text' name='rendeles_flower_name' class='tbox' style='width:700px' value='' />
				    </td>
			    </tr>		
			    <tr>
				    <td style='width:25%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_22."</span></td>
				    <td class='forumheader3'>
					    <input type='text' name='rendeles_flower_size' class='tbox' style='width:200px' value='' />
				    </td>
			    </tr>	
			    <tr>
				    <td style='width:25%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_11."</span></td>
				    <td class='forumheader3'>
              <input type='text' name='rendeles_flower_price' class='tbox' style='width:200px' value='' />".$pref['rendeles_currency']."
            </td>
			    </tr>
			    <tr style='vertical-align:top'>
				    <td colspan='2' style='text-align:center' class='forumheader'>
					    <input class='button' type='submit' name='post' value='".RENDELES_ADLAN_23."' />
					    <input type='hidden' name='kuldes' value='kuldes' />
				    </td>
			    </tr>
		    </table>
      ";
      $text .= "</form>";

     $ns -> tablerender("".RENDELES_ADLAN_6."", $text);
     /* Új Virág küldése VÉGE*/		
	
  }

	/* --------------------------------------------------------------------------*/
	/* Virágok lekérése módosításhoz, átadás a doForm-nak */
	/* --------------------------------------------------------------------------*/
  
  function editSme() {
		global $sql, $tp;
		$e_idt = array_keys($_POST['edit']);
		if($sql -> db_Select("rendeles_flower", "*", "rendeles_flower_id='".$e_idt[0]."' ")) {
			$foo = $sql -> db_Fetch();
			$foo['rendeles_flower_name'] = $tp -> toFORM($foo['rendeles_flower_name']);
			$foo['rendeles_flower_size'] = $tp -> toFORM($foo['rendeles_flower_size']);
			$foo['rendeles_flower_price'] = $tp -> toFORM($foo['rendeles_flower_price']);
			$this -> doForm($foo);
		}
	}
	
	/* --------------------------------------------------------------------------*/
	/* Admin űrlap a Virág módosításához */
	/* --------------------------------------------------------------------------*/
  
  function doForm($editArray=FALSE) {
		global $sql,$ns,$pref;
		$count = $sql -> db_Select("rendeles_flower", "*", "rendeles_flower_id !=0 ORDER BY rendeles_flower_id ASC");
		$text = "<form action='".e_SELF."' id='form' method='post'>
		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td style='width:33%' class='forumheader3'>".RENDELES_ADLAN_20."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_flower_name' class='tbox' style='width:700px' value='".$editArray['rendeles_flower_name']."' />
				</td>
			</tr>
			<tr>
				<td style='width:33%' class='forumheader3'>".RENDELES_ADLAN_22."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_flower_size' class='tbox' style='width:200px' value='".$editArray['rendeles_flower_size']."' />
				</td>
			</tr>
			<tr>
				<td style='width:34%' class='forumheader3'>".RENDELES_ADLAN_11."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_flower_price' class='tbox' style='width:200px' value='".$editArray['rendeles_flower_price']."' />".$pref['rendeles_currency']."
				</td>
			</tr>
			<tr style='vertical-align:top'>
				<td colspan='2' style='text-align:center' class='forumheader'>
					<input class='button' type='submit' name='add_com' value='".LAN_UPDATE."' />
					<input type='hidden' name='rendeles_flower_id' value='".$editArray['rendeles_flower_id']."' />
				</td>
			</tr>
		</table>
		</form>
		";
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_24."</div>", $text);
	}
	
	/* --------------------------------------------------------------------------*/
	/* Virág módosításának a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
	function addCom() {
		global $sql, $tp;
		$rendeles_flower = $tp -> toDB($_POST['rendeles_flower']);
		$rendeles_flower_name = $tp -> toDB($_POST['rendeles_flower_name']);
		$rendeles_flower_size = $tp -> toDB($_POST['rendeles_flower_size']);
		$rendeles_flower_price = $tp -> toDB($_POST['rendeles_flower_price']);
		if(isset($_POST['rendeles_flower_id'])) {
			$this -> message = $sql -> db_Update("rendeles_flower", "rendeles_flower_name='".$rendeles_flower_name."', rendeles_flower_size='".$rendeles_flower_size."', rendeles_flower_price='".$rendeles_flower_price."' WHERE rendeles_flower_id='".$_POST['rendeles_flower_id']."' ") ? LAN_UPDATED : LAN_UPDATED_FAILED;
		}
	}

	/* --------------------------------------------------------------------------*/
	/* Virág törlésének a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
	function deleteSme() {
		global $sql;
		$d_idt = array_keys($_POST['delete']);
		$this -> message = ($sql -> db_Delete("rendeles_flower", "rendeles_flower_id='".$d_idt[0]."'")) ? LAN_DELETED : LAN_DELETED_FAILED;
	}
}

require_once(e_ADMIN."footer.php");

?>