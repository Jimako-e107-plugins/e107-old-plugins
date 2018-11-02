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
  /* Színek kilistázása */
  /* --------------------------------------------------------------------------*/

  function showList() {
	  global $sql,$ns,$tp,$pref;
	  $gen = new convert;
	
// lapozás ------------------------------------------------------------------------------
    $from = ($_GET['frm']) ? $_GET['frm'] : 0;
    $total_items = $sql -> db_Select("rendeles_color", "*", "rendeles_color_id"); 	
// lapozás ------------------------------------------------------------------------------
	
     /* Új Szín küldése */		
     if (isset($_POST['kuldes'])) {

      $sql -> db_Insert("rendeles_color", "'".$_POST['rendeles_color_id']."', '".$_POST['rendeles_color_name']."'");
    
      $text = "<span class='smalltext'>".RENDELES_ADLAN_18."</span><br /><br />";
  }
	
	  $count = $sql -> db_Select_gen("SELECT * FROM #rendeles_color  
    WHERE rendeles_color_id !=0 ORDER BY rendeles_color_id ASC
    LIMIT $from,".$pref['rendeles_perpage']."
    ", false);

	  $text .= "<div style='text-align:center'>";
	  /* Ha üres, nincs még színek */
	  if (!$count) {
		  $text .= "".RENDELES_ADLAN_13."";
		  $ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_55."</div>", $text);
		  
      $text = "<form action='".e_SELF."' method='post'>";
      $text .="
	      <table class='fborder' style='width:100%'>
		      <tr>
			      <td style='width:25%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_21."</span></td>
			      <td class='forumheader3'>
				      <input type='text' name='rendeles_color_name' class='tbox' style='width:700px' value='' />
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

     $ns -> tablerender("".RENDELES_ADLAN_56."", $text);
		  
		  require_once(e_ADMIN."footer.php");
		  exit;
	  }
	  /* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Színek */
	  else {
		  $text .= "<form action='".e_SELF."' id='display' method='post'>
		  <table style='".ADMIN_WIDTH."' class='fborder'>
			  <tr>
				  <td style='width:5%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_10."</td>
				  <td style='width:90%; text-align: center;' class='fcaption'>".RENDELES_ADLAN_55."</td>
				  <td style='width:5%; text-align: center;' class='fcaption'>".LAN_OPTIONS."</td>
			  </tr>
		  ";
		  /* Színek kilistázása, ID szerint növekvő sorrendben */
		  while($row2 = $sql-> db_Fetch()){
			  $text .= "<tr>
				  <td class='forumheader3' style='text-align: center; background: url(" . $eplug_folder . "images/$row2[rendeles_color_name].png) repeat-x top left;'>".$row2['rendeles_color_id'] ."</td>
				  <td class='forumheader3' style='background: url(" . $eplug_folder . "images/$row2[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row2['rendeles_color_name'],"","defs")."</td>
				  <td style='width:50px;white-space:nowrap;text-align: center; background: url(" . $eplug_folder . "images/$row2[rendeles_color_name].png) repeat-x top left;' class='forumheader3'>
					  <div>
						  <input type='image' name='edit[{$row2['rendeles_color_id']}]' value='edit' src='".e_IMAGE."admin_images/edit_16.png' alt='".LAN_EDIT."' title='".LAN_EDIT."' style='border:0px' />
						  <input type='image' name='delete[{$row2['rendeles_color_id']}]' value='del' onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL." [".$row2['rendeles_color_id']."]")."') \" src='".e_IMAGE."admin_images/delete_16.png' alt='".LAN_DELETE."' title='".LAN_DELETE."' style='border:0px' />
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
	  
	  $ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_55."</div>", $text);

      $text = "<form action='".e_SELF."' method='post'>";
      $text .="
	      <table class='fborder' style='width:100%'>
		      <tr>
			      <td style='width:50%; vertical-align:top;' class='forumheader3'><span class='smalltext'>".RENDELES_ADLAN_21."</span></td>
			      <td class='forumheader3'>
				      <input type='text' name='rendeles_color_name' class='tbox' style='width:700px' value='' />
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

     $ns -> tablerender("".RENDELES_ADLAN_4."", $text);
     /* Új Szín küldése VÉGE*/		
	
  }

	/* --------------------------------------------------------------------------*/
	/* Színek lekérése módosításhoz, átadás a doForm-nak */
	/* --------------------------------------------------------------------------*/
  
  function editSme() {
		global $sql, $tp;
		$e_idt = array_keys($_POST['edit']);
		if($sql -> db_Select("rendeles_color", "*", "rendeles_color_id='".$e_idt[0]."' ")) {
			$foo = $sql -> db_Fetch();
			$foo['rendeles_color_name'] = $tp -> toFORM($foo['rendeles_color_name']);
			$this -> doForm($foo);
		}
	}
	
	/* --------------------------------------------------------------------------*/
	/* Admin űrlap a Színek módosításához */
	/* --------------------------------------------------------------------------*/
  
  function doForm($editArray=FALSE) {
		global $sql,$ns,$pref;
		$count = $sql -> db_Select("rendeles_color", "*", "rendeles_color_id !=0 ORDER BY rendeles_color_id ASC");
		$text = "<form action='".e_SELF."' id='form' method='post'>
		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td style='width:50%' class='forumheader3'>".RENDELES_ADLAN_21."<span class='smalltext'>&nbsp;</span></td>
				<td class='forumheader3'>
					<input type='text' name='rendeles_color_name' class='tbox' style='width:700px' value='".$editArray['rendeles_color_name']."' />
				</td>
			</tr>
			<tr style='vertical-align:top'>
				<td colspan='2' style='text-align:center' class='forumheader'>
					<input class='button' type='submit' name='add_com' value='".LAN_UPDATE."' />
					<input type='hidden' name='rendeles_color_id' value='".$editArray['rendeles_color_id']."' />
				</td>
			</tr>
		</table>
		</form>
		";
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_57."</div>", $text);
	}
	
	/* --------------------------------------------------------------------------*/
	/* Színek módosításának a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
	function addCom() {
		global $sql, $tp;
		$rendeles_color = $tp -> toDB($_POST['rendeles_color']);
		$rendeles_color_name = $tp -> toDB($_POST['rendeles_color_name']);
		if(isset($_POST['rendeles_color_id'])) {
			$this -> message = $sql -> db_Update("rendeles_color", "rendeles_color_name='".$rendeles_color_name."' WHERE rendeles_color_id='".$_POST['rendeles_color_id']."' ") ? LAN_UPDATED : LAN_UPDATED_FAILED;
		}
	}

	/* --------------------------------------------------------------------------*/
	/* Színek törlésének a lekérdezése */
	/* --------------------------------------------------------------------------*/
	
	function deleteSme() {
		global $sql;
		$d_idt = array_keys($_POST['delete']);
		$this -> message = ($sql -> db_Delete("rendeles_color", "rendeles_color_id='".$d_idt[0]."'")) ? LAN_DELETED : LAN_DELETED_FAILED;
	}
}

require_once(e_ADMIN."footer.php");

?>