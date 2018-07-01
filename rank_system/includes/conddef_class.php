<?php
/**
 * $Id: conddef_class.php,v 1.2 2009/10/23 15:49:02 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 17 okt 2009 - 18:39:22
 * 
 * Revision: $Revision: 1.2 $
 * Last Modified: $Date: 2009/10/23 15:49:02 $
 *
 * Change Log:
 * $Log: conddef_class.php,v $
 * Revision 1.2  2009/10/23 15:49:02  michiel
 * Configure Site Penalty settings
 *
 * Revision 1.1  2009/10/22 15:03:38  michiel
 * Implemented customizable conditions
 *
 *  
 */
class conddef {

	function show_message($message) {
		global $ns;
		$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
	}

	function active_conditions() {
		global $sql;
		$sql->db_Select("rank_condition", "count(*) count");
		$counter = $sql->db_Fetch();
		return 0+$counter['count'];
	}
	
	function insert_condition($order) {
		global $sql;
		$query = "update #rank_condition set condit_order=condit_order+1 where condit_order >= ".$order." order by condit_order desc";
		$sql->db_Select_gen($query,false);
	}
	
	function remove_condition($order) {
		global $sql;
		$query = "update #rank_condition set condit_order=condit_order-1 where condit_order > ".$order." order by condit_order";
		$sql->db_Select_gen($query,false);
	}

	function show_conditions($sub_action, $id) {
		global $sql, $rs, $ns, $tp;

		if ($sub_action == "edit") {
			if ($sql->db_Select("rank_condition", "*", "condit_id='$id' ")) {
				$row = $sql->db_Fetch();
				extract($row);
			}
		} else {
			$condit_enabled = 'T';
		}

		$text = "<div style='text-align:center'>
		<form method='post' action='".e_SELF."' id='dataform'>
		<table style='".ADMIN_WIDTH."' class='fborder'>

		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_CDF2."</span></td>
		<td class='forumheader3' colspan='2' style='width:70%'>";
		
		$count = $this->active_conditions();
		if (!$id) {
			$count++;
			$condit_order = $count;
		}

		$text .= "\t<select name='condit_order' class='tbox'>\n";
		for ($lus = 1; $lus <= $count; $lus++) {
			$sel = ($lus == $condit_order ? "selected='selected'" : "");
			$text .= "<option value='$lus' $sel>$lus</option>\n";
		}
		$text .= "</select>
		<input type='hidden' name='old_order' value='$condit_order' />
		</td></tr>
		
		<tr>
			<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_CDF3."</span></td>
			<td class='forumheader3' colspan='2' style='width:70%'>
				<input class='tbox' type='text' name='condit_name' size='55' value='$condit_name' maxlength='50'/>
			</td>
		</tr>

		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF5.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input type='checkbox' name='condit_hastext' ".($condit_hastext == 'T' ? " checked='checked'" : "")." />
			</td>
		</tr> 
		
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF4.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input type='checkbox' name='condit_negative' ".($condit_negative == 'T' ? " checked='checked'" : "")." />
			</td>
		</tr> 

		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF6.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input class='tbox' type='text' name='condit_maxval' size='6' value='$condit_maxval' maxlength='5' />
			</td>
		</tr>
		
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF7.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input class='tbox' type='text' name='condit_factor' size='10' value='$condit_factor' maxlength='50' />
			</td>
		</tr> ";
		
		
		$text .= $this->imageSelectRow(ADLAN_RS_CDF8, "condit_onbar", $condit_onbar);
		$text .= $this->imageSelectRow(ADLAN_RS_CDF9, "condit_offbar", $condit_offbar);
		
		$text .= "
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF10.": </td>
		<td style='width:80%' colspan='2' class='forumheader3'>";

		$text .= $this->getTriggerBox($condit_trigger);
		
		$text .= "
			</td>
		</tr>

		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF22.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				".$this->wysiwygEditor("condit_descript", $condit_descript)."
			</td>
		</tr> 
		
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF21.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input type='checkbox' name='condit_enabled' ".($condit_enabled == 'T' ? " checked='checked'" : "")." />
			</td>
		</tr> 

		<tr><td colspan='2' style='text-align:left' class='forumheader'>";
		if ($id) {
			$text .= "<input class='button' type='submit' name='update_condit' value='".ADLAN_RS_CDF11."' />
			<input class='button' type='submit' name='condit_clear' value='".ADLAN_RS_DEF9."' />
			<input type='hidden' name='condit_id' value='". $id. "' />
			</td>";
			
			$tabtit = ADLAN_RS_CDF13 . " [" . $tp->toHTML($condit_name) . "]";
		} else {
			$text .= "<input class='button' type='submit' name='create_condit' value='".ADLAN_RS_CDF12."' /></td>";
			$tabtit = ADLAN_RS_CDF12;
		}

		$text .= "
				<td style='text-align:right' class='forumheader'>
					<input class='button' type='submit' name='edit_predefs' value='".ADLAN_RS_CDF23."' />
				</td>
				</tr>
			</table>
			</form>
		</div>";

		$ns->tablerender($tabtit, $text);

		$text = "<div style='text-align: center'>";
		
		$query = "select c.* from #rank_condition c order by condit_order";
        if ($sql->db_Select_gen($query, false)) {
			$text .= "
			<form action='".e_SELF."' id='dataform' method='post'>
			<table class='fborder' style='".ADMIN_WIDTH."'>
			<tr>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_CDF2."</td>
			<td style='width:19%' class='fcaption'>".ADLAN_RS_CDF3."</td>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_CDF5."</td>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_CDF4."</td>
			<td style='width:7%' class='fcaption'>".ADLAN_RS_CDF6."</td>
			<td style='width:7%' class='fcaption'>".ADLAN_RS_CDF7."</td>
			<td style='width:7%' class='fcaption'>".ADLAN_RS_CDF8."</td>
			<td style='width:7%' class='fcaption'>".ADLAN_RS_CDF9."</td>
			<td style='width:18%' class='fcaption'>".ADLAN_RS_CDF10."</td>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_CDF21."</td>
			<td style='width:5%; text-align:center' class='fcaption'>&nbsp;</td>
			</tr>";
			while ($row = $sql->db_Fetch()) {
				extract($row);
				
				if ($condit_negative == 'T') {
					$condit_negative = ADLAN_RS_DEF26;
				} else {
					$condit_negative = ADLAN_RS_DEF27;
				}
				if ($condit_hastext == 'T') {
					$condit_hastext = ADLAN_RS_DEF26;
				} else {
					$condit_hastext = ADLAN_RS_DEF27;
				}
				if ($condit_enabled == 'T') {
					$condit_enabled = ADLAN_RS_DEF26;
				} else {
					$condit_enabled = ADLAN_RS_DEF27;
				}
				
				$condit_trigger = $tp->toHTML($this->triggerToString($condit_trigger));
				
				$condit_onbar = "<img src='".e_PLUGIN."rank_system/images/$condit_onbar' border='0' width='40' height='10' alt='$condit_onbar' />";
				$condit_offbar = "<img src='".e_PLUGIN."rank_system/images/$condit_offbar' border='0' width='40' height='10' alt='$condit_offbar' />";
				
				$text .= "<tr>
				<td style='text-align:center' class='forumheader3'>$condit_order</td>
				<td style='text-align:left' class='forumheader3'>$condit_name</td>
				<td style='text-align:center' class='forumheader3'>$condit_hastext</td>
				<td style='text-align:center' class='forumheader3'>$condit_negative</td>
				<td style='text-align:right' class='forumheader3'>$condit_maxval</td>
				<td style='text-align:left' class='forumheader3'>$condit_factor</td>
				<td style='text-align:center' class='forumheader3'>$condit_onbar</td>
				<td style='text-align:center' class='forumheader3'>$condit_offbar</td>
				<td style='text-align:center' class='forumheader3'>$condit_trigger</td>
				<td style='text-align:center' class='forumheader3'>$condit_enabled</td>
				<td style='text-align:center' class='forumheader3'>
				<a href='".e_SELF."?condition.edit.$condit_id'>".ADMIN_EDIT_ICON."</a>
				<input type='image' title='".LAN_DELETE."' name='delete[condition_$condit_id]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(ADLAN_RS_CDF14." [$condit_name]")."') \"/>
				</td>
				</tr>\n";
			}
			$text .= "</table></form>";
			} else {
			$text .= "<div style='text-align:center'><div style='vertical-align:middle'>".ADLAN_RS_CDF15."</div>";
		}
		$text .= "</div>";
		$ns->tablerender(ADLAN_RS_CDF16, $text);
	}
	
	function isImage($name) {
		if (strlen($name) < 5) return false;
		
		$ext = substr(strtoupper($name), strlen($name)-3);
		return ($ext == 'JPG' || $ext == 'GIF' || $ext == 'PNG');
	}
	
	function imageSelectRow($label, $form_name, $form_value) {
		
		$handle = opendir(e_PLUGIN."rank_system/images");
		while ($file = readdir($handle)) {
			if ($this->isImage($file)) {
				$imagelist[] = $file;
			}
		}
		closedir($handle);
		sort($imagelist);
		
		$itext = "
			<tr>
				<td style='width:20%' rowspan='2' class='forumheader3'>$label:</td>
				<td style='width:30%' class='forumheader3'>
					<input class='tbox' type='text' name='$form_name' id='$form_name.ID' size='40' value='$form_value' maxlength='50' />
				</td>
				<td style='width:50%; text-align:center' class='forumheader3' id='$form_name.curr'>
		";
				
		if ($form_value != "") {
			$itext .= "<img src='" .e_PLUGIN. "rank_system/images/" . $form_value . "' border='0' width='50' height='10' alt='$form_value' title='$form_value' />";
		} else {
			$itext .= "&nbsp;";
		}
		
		$itext .= "
			</td></tr>
			<tr><td style='width:80%' colspan='2' class='forumheader3'>
		";
				
		$itext .= "
			<input class='button' type ='button' style='cursor:pointer' size='30' value='".ADLAN_RS_MDF49."' onclick='expandit(this)' />
			<div id='$form_name.lst' style='display:none;' >";
				
		while (list($key, $image) = each($imagelist)) {
			$itext .= " 
				<a href=\"javascript:insertext('$image','$form_name.ID','$form_name.lst')\">
				<img src='".e_PLUGIN."rank_system/images/$image' style='border:0;' width='20' height='20' alt='$image' title='$image' 
					onclick=\"document.getElementById('$form_name.curr').innerHTML='<img src=\'" .e_PLUGIN. "rank_system/images/$image\' border=\'0\' width=\'50\' height=\'10\' alt=\'$image\' title=\'$image\' />'\" />
				</a>
			";
		}

		reset($imagelist);

		$itext .= "
			</div></td>
			</tr>
		";
		
		return $itext;
	}
	
	function getTriggerBox($currValue = "") {
		global $e_rank;
		$box = "<select name='condit_trigger' class='tbox'>";
		$box .= "<option value='trigger_manual' ". ($currValue == 'trigger_manual' ? "selected = 'selected'" : "") . ">".RANKS_CT_01."</option>";

		foreach($e_rank as $plugin) {
			foreach($plugin as $key) {
				if (is_array($key) && $key['trigger'] != "" && $key['trigger'] != "trigger_manual") {
					$box .= "<option value='".$key['trigger']."' ". ($currValue == $key['trigger'] ? "selected = 'selected'" : "") . ">".$key['name']."</option>";
				}
			}
		}

		$box .= "</select>";
		
		return $box;
	}
	
	function triggerToString($target) {
		global $e_rank;
		foreach($e_rank as $plugin) {
			foreach($plugin as $key) {
				if (is_array($key) && $key['trigger'] == $target) {
					return $key['name'];
				}
			}
		}
	}
	
	function wysiwygEditor($form_name, $form_value) {
		global $pref, $e_wysiwyg, $tp;
		require_once(e_HANDLER . "ren_help.php");
		$editor = "";
		
		$insertjs = (!$pref['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
	          "rows='20' style='width:100%' ";
        $form_value = $tp->toForm($form_value);
        $editor .= "<textarea class='tbox' id='wysiwyg' name='$form_name' cols='80'  style='width:95%' $insertjs>" . (strstr($form_value, "[img]http") ? $form_value : str_replace("[img]../", "[img]", $form_value)) . "</textarea>";
        if (!e_WYSIWYG) {
        	$editor .= "<div style='text-align:left'>" . display_help("helpb","comment"). "</div>";
        }
        
        return $editor;
	}
	
	function edit_predefined() {
		global $sql, $rs, $ns, $tp, $RANK_PREF;

		$text = "<div style='text-align:center'>
		<form method='post' action='".e_SELF."?condition' id='dataform'>
		<table style='".ADMIN_WIDTH."' class='fborder'>

		<tr>
			<td class='fcaption' colspan='3' style='text-align:center'>" . ADLAN_RS_CDF23 . "</td>
		</tr>
		
		<tr>
			<td class='forumheader2' colspan='3' style='text-align:center'><strong>".RANKS_CT_03."</strong></td>
		</tr>
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF24.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input class='tbox' type='text' name='sitpen_start' size='3' value='".$RANK_PREF['sitpen_start']."' maxlength='3' /> ".ADLAN_RS_CDF25."
			</td>
		</tr>
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF26.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input class='tbox' type='text' name='sitpen_penalty' size='3' value='".$RANK_PREF['sitpen_penalty']."' maxlength='3' /> ".ADLAN_RS_CDF27."
				<input class='tbox' type='text' name='sitpen_penday' size='2' value='".$RANK_PREF['sitpen_penday']."' maxlength='2' /> ".ADLAN_RS_CDF25."
			</td>
		</tr>
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF28.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input class='tbox' type='text' name='sitpen_recovery' size='3' value='".$RANK_PREF['sitpen_recovery']."' maxlength='3' /> ".ADLAN_RS_CDF27." " . ADLAN_RS_CDF29."
			</td>
		</tr>
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_CDF30.":</td>
			<td style='width:40%' class='forumheader3'>
				<input type='radio' checked='checked' name='reset_freeze' class='tbox' value='ignore' /> " . ADLAN_RS_CDF31 . "<br/>
				<input type='radio' name='reset_freeze' class='tbox' value='set' /> " . ADLAN_RS_CDF32 . "<br/>
				<input type='radio' name='reset_freeze' class='tbox' value='unset' /> " . ADLAN_RS_CDF33 . "
			</td>
			<td class='forumheader3' style='width:40%;text-align:center'>
				<input class='button' type='submit' name='reset_penalties' value='".ADLAN_RS_CDF34."' />
			</td>
		</tr>
		
		
		<tr>
			<td colspan='3' class='forumheader2'>&nbsp;</td>
		</tr>
		<tr>
				<td colspan='3' style='text-align:center' class='forumheader'>
					<input class='button' type='submit' name='update_predefs' value='".ADLAN_RS_UPD."' />
				</td>
		</tr>
		";
				
		$text .= "
				</table>
			</form>
		</div>
		";
		$ns->tablerender(ADLAN_RS_CDF23, $text);
	}
	
	
	
}


?>