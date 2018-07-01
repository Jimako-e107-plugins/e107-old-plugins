<?php
/**
 * $Id: meddef_class.php,v 1.6 2009/10/22 21:29:48 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.6 $
 * Last Modified: $Date: 2009/10/22 21:29:48 $
 *
 * Change Log:
 * $Log: meddef_class.php,v $
 * Revision 1.6  2009/10/22 21:29:48  michiel
 * Implemeted Time-based goals
 *
 * Revision 1.5  2009/10/22 15:03:38  michiel
 * Implemented customizable conditions
 *
 * Revision 1.4  2009/07/14 19:29:13  michiel
 * CVS Merge
 *
 * Revision 1.3.2.2  2009/07/13 18:52:28  michiel
 * added medal reward
 *
 * Revision 1.3.2.1  2009/07/12 12:39:37  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.2  2009/07/12 11:56:19  michiel
 * BugFix: Made some changes for PHP4
 *
 * Revision 1.3.4.1  2009/07/12 11:47:50  michiel
 * jumping to medal after editing it
 *
 * Revision 1.3  2009/06/28 15:06:13  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.3  2009/06/28 12:56:42  michiel
 * quickfix: typo
 *
 * Revision 1.2.2.2  2009/06/27 16:58:32  michiel
 * Added image selector
 *
 * Revision 1.2.2.1  2009/06/27 15:52:50  michiel
 * - BugFix: fixed a misplaced quote in the order selection box
 * - Added 2nd image for medals and ribbons
 *
 * Revision 1.2  2009/06/26 09:23:33  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.3  2009/06/19 13:47:21  michiel
 * Made XHTML compliant
 *
 * Revision 1.1.2.2  2009/05/20 18:39:54  michiel
 * Updated Medals
 *
 * Revision 1.1.2.1  2009/04/01 19:26:43  michiel
 * Medal goal automated using e_rank.php
 *
 * Revision 1.1  2009/03/28 13:01:48  michiel
 * Initial CVS revision
 *
 *  
 */
class meddef {

	function show_message($message) {
		global $ns;
		$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
	} 

	function show_categories($sub_action, $id) {
		global $sql, $ns, $tp;

		if ($sub_action == "edit") {
			if ($sql->db_Select("rank_medal_category", "*", "med_cat_id='$id' ")) {
				$row = $sql->db_Fetch();
				extract($row);
			}
		}

		$text = "<div style='text-align:center'>
		<form action='".e_SELF."?cat' id='dataform' method='post'>
		<table class='fborder' style='".ADMIN_WIDTH."'>
		
		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF2."</span></td>
		<td class='forumheader3' style='width:70%'><input class='tbox' type='text' name='med_cat_name' size='55' value='$med_cat_name' maxlength='50'/></td>
		</tr>

		<tr><td colspan='2' style='text-align:center' class='forumheader'>";
		if ($id) {
			$text .= "<input class='button' type='submit' name='update_category' value='".ADLAN_RS_MDF6."' />
			<input class='button' type='submit' name='category_clear' value='".ADLAN_RS_MDF8."' />
			<input type='hidden' name='med_cat_id' value=".$id." />
			</td></tr>";
			} else {
			$text .= "<input class='button' type='submit' name='create_category' value='".ADLAN_RS_MDF7."' /></td></tr>";
		}
		$text .= "</table>
		</form>
		</div>";

		$ns->tablerender(ADLAN_RS_MDF7, $text);

		unset($med_cat_name, $med_cat_type);

		$text = "<div style='text-align: center'>";
		if ($category_total = $sql->db_Select("rank_medal_category", "*", "1=1 order by med_cat_name")) {
			$text .= "
			<form action='".e_SELF."?cat' id='dataform' method='post'>
			<table class='fborder' style='".ADMIN_WIDTH."'>
			<tr>
			<td style='width:5%;text-align:center' class='fcaption'>".ADLAN_RS_MDF9."</td>
			<td style='width:60%;text-align:center' class='fcaption'>".ADLAN_RS_MDF11."</td>
			<td style='width:15%; text-align:center' class='fcaption'>&nbsp;</td>
			</tr>";
			while ($row = $sql->db_Fetch()) {
				extract($row);
				
				$text .= "<tr>
				<td style='text-align:center' class='forumheader3'>$med_cat_id</td>
				<td style='text-align:center' class='forumheader3'>$med_cat_name</td>
				<td style='text-align:center' class='forumheader3'>
				<a href='".e_SELF."?cat.edit.$med_cat_id'>".ADMIN_EDIT_ICON."</a>
				<input type='image' title='".LAN_DELETE."' name='delete[category_$med_cat_id]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(ADLAN_RS_MDF12." [$med_cat_name]")."') \"/>
				</td>
				</tr>\n";
			}
			$text .= "</table></form>";
			} else {
			$text .= "<div style='text-align:center'><div style='vertical-align:middle'>".ADLAN_RS_MDF13."</div>";
		}
		$text .= "</div>";
		$ns->tablerender(ADLAN_RS_MDF14, $text);
	}
	
	function active_medals() {
		global $sql;
		$sql->db_Select("rank_medals", "count(*) count");
		$counter = $sql->db_Fetch();
		return 0+$counter['count'];
	}
	
	function insert_medal($order) {
		global $sql;
		$query = "update #rank_medals set medal_order=medal_order+1 where medal_order >= ".$order." order by medal_order desc";
		$sql->db_Select_gen($query,false);
	}
	
	function remove_medal($order) {
		global $sql;
		$query = "update #rank_medals set medal_order=medal_order-1 where medal_order > ".$order." order by medal_order";
		$sql->db_Select_gen($query,false);
	}
	
	function getGoalName($goalid) {
		
		if ($goalid == 0) {
			return ADLAN_RS_MDF23;
		}
		
		$goalSql = new db;
		$goalSql->db_Select("rank_medal_goal", "med_goal_name", "med_goal_id=".$goalid);
		$goalRow = $goalSql->db_Fetch();
		return $goalRow['med_goal_name'];
	}

	function show_medals($sub_action, $id) {
		global $sql, $ns, $tp;

		if ($sub_action == "edit") {
			if ($sql->db_Select("rank_medals", "*", "medal_id='$id' ")) {
				$row = $sql->db_Fetch();
				extract($row);
			}
			$jump = $id;
		} else {
			if ($sql->db_Select("rank_medals", "medal_id", "1=1 order by medal_id desc limit 0,1")) {
				$row = $sql->db_Fetch();
				$jump = ($row['medal_id']+1);
			} else {
				$jump = 0;
			}
		}

		$text = "<div style='text-align:center'>
		<form method='post' action='".e_SELF."?rank#mi$jump' id='dataform'>
		<table style='".ADMIN_WIDTH."' class='fborder'>

		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF19."</span></td>
		<td class='forumheader3' colspan='2' style='width:70%'>";
		
		$count = $this->active_medals();
		if (!$id) {
			$count++;
			$medal_order = $count;
		}

		$text .= "\t<select name='medal_order' class='tbox'>\n";
		for ($lus = 1; $lus <= $count; $lus++) {
			$sel = ($lus == $medal_order ? "selected='selected'" : "");
			/*
			 * BugFix @v1.3
			 * misplaced the single quote
			 */
			$text .= "<option value='$lus' $sel>$lus</option>\n";
		}
		$text .= "</select>
		<input type='hidden' name='old_order' value='$medal_order'>
		</td></tr>
		
		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF26."</span></td>
		<td class='forumheader3' colspan='2' style='width:70%'>
			<input type='radio'" . ($medal_type == 0 ?'checked="checked"':'') . " name='medal_type' class='tbox' value='0' /> " . ADLAN_RS_MDF5 . "<br />
			<input type='radio'" . ($medal_type == 1 ?'checked="checked"':'') . " name='medal_type' value='1' /> " . ADLAN_RS_MDF4 . "
		</td>
		</tr>
		
		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF11."</span></td>
		<td class='forumheader3' colspan='2' style='width:70%'>
		<input class='tbox' type='text' name='medal_name' size='55' value='$medal_name' maxlength='50'/>
		</td></tr>
		
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_MDF1.": </td>
		<td style='width:80%' colspan='2' class='forumheader3'>";

		if (!$sql->db_Select("rank_medal_category", "*", "1=1 order by med_cat_name"))
		{
			$text .= ADLAN_RS_MDF13;
		}
		else
		{
			$text .= "\t<select name='medal_category' class='tbox'>\n";

			while (list($med_cat_id, $med_cat_name) = $sql->db_Fetch())
			{
				$sel = ($medal_category == $med_cat_id) ? "selected='selected'" : "";
				$text .= "<option value='$med_cat_id' $sel>".$tp->toHTML($med_cat_name,FALSE,"defs")."</option>\n";
			}
			$text .= "</select>";
		}
		$text .= "</td>
		</tr>";
		
		$text .= $this->imageSelectRow(ADLAN_RS_MDF20, 'medal_img', $medal_img);
		$text .= $this->imageSelectRow(ADLAN_RS_MDF48, 'medal_img2', $medal_img2);
		
		$text .= "
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_MDF21.":</td>
		<td style='width:80%' colspan='2' class='forumheader3'>
		<textarea class='tbox' rows='4' cols='60' style='width:80%' name='medal_description' >" . $medal_description . "</textarea>
		</td>
		</tr> 
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_MDF22.":</td>
		<td style='width:80%' colspan='2' class='forumheader3'><select name='medal_goal' class='tbox'>
		<option value='0' ". ($medal_goal == 0 ? "selected='selected'" : "") .">".ADLAN_RS_MDF23."</option>";
		
		if ($sql->db_Select("rank_medal_goal"))
		{
			while (list($med_goal_id, $med_goal_name) = $sql->db_Fetch())
			{
				$sel = ($medal_goal == $med_goal_id) ? "selected='selected'" : "";
				$text .= "<option value='$med_goal_id' $sel>".$tp->toHTML($med_goal_name,FALSE,"defs")."</option>\n";
			}
		}
				
		$text .= "</select>
		</td>
		</tr> 
		
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_MDF44.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input type='checkbox' name='medal_reserved' ".($medal_reserved == 'T' ? " checked='checked'" : "")." />
			</td>
		</tr>

		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_MDF47.ADLAN_RS_MDF50.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input class='tbox' type='text' name='medal_bonus' size='4' value='$medal_bonus' maxlength='3'/>
			</td>
		</tr>
		<tr>
			<td style='width:20%' class='forumheader3'>".ADLAN_RS_MDF51.ADLAN_RS_MDF52.":</td>
			<td style='width:80%' colspan='2' class='forumheader3'>
				<input class='tbox' type='text' name='medal_reward' size='12' value='$medal_reward' maxlength='10'/>
			</td>
		</tr>
		
		
		<tr><td colspan='3' style='text-align:center' class='forumheader'>";
		if ($id) {
			$text .= "<input class='button' type='submit' name='update_medal' value='".ADLAN_RS_MDF24."' />
			<input class='button' type='submit' name='medal_clear' value='".ADLAN_RS_MDF8."' />
			<input type='hidden' name='medal_id' value='". $id. "' />
			</td></tr>";
			} else {
			$text .= "<input class='button' type='submit' name='create_medal' value='".ADLAN_RS_MDF25."' /></td></tr>";
		}
		$text .= "</table></form></div>";

		$ns->tablerender(ADLAN_RS_MDF25, $text);

		unset($medal_id, $medal_type, $medal_category, $medal_name, $medal_img, $medal_description, $medal_goal, $medal_reserved, $medal_bonus);

		$text = "<div style='text-align: center'>";
		
		$query = "select m.*, c.med_cat_name from #rank_medals m, #rank_medal_category c where c.med_cat_id = m.medal_category order by medal_type, medal_order";
        if ($sql->db_Select_gen($query, false)) {
			$text .= "
			<form action='".e_SELF."?medal' id='dataform' method='post'>
			<table class='fborder' style='".ADMIN_WIDTH."'>
			<tr>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_MDF19."</td>
			<td style='width:10%' class='fcaption'>".ADLAN_RS_MDF27."</td>
			<td style='width:7%' class='fcaption'>".ADLAN_RS_MDF26."</td>
			<td style='width:15%' class='fcaption'>".ADLAN_RS_MDF11."</td>
			<td style='width:18%' class='fcaption'>".ADLAN_RS_MDF20."</td>
			<td style='width:15%' class='fcaption'>".ADLAN_RS_MDF21."</td>
			<td style='width:10%' class='fcaption'>".ADLAN_RS_MDF22."</td>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_MDF46."</td>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_MDF47."</td>
			<td style='width:10%; text-align:center' class='fcaption'>&nbsp;</td>
			</tr>";
			while ($row = $sql->db_Fetch()) {
				extract($row);
				
				if ($medal_reserved == 'T') {
					$medal_reserved = ADLAN_RS_DEF26;
				} else {
					$medal_reserved = ADLAN_RS_DEF27;
				}

				$text .= "<tr>
				<td id='mi$medal_id' style='text-align:center' class='forumheader3'>$medal_order</td>
				<td style='text-align:center' class='forumheader3'>$med_cat_name</td>
				<td style='text-align:center' class='forumheader3'>".($medal_type == 0 ? ADLAN_RS_MDF31 : ADLAN_RS_MDF15)."</td>
				<td class='forumheader3'>$medal_name</td>
				<td style='text-align:center' class='forumheader3'><img src='" .e_PLUGIN. "rank_system/images/medals/" . $medal_img . "' border='0' alt='' /></td>
				<td class='forumheader3'>$medal_description</td>
				<td style='text-align:center' class='forumheader3'>".$this->getGoalName($medal_goal)."</td>
				<td style='text-align:center' class='forumheader3'>".$medal_reserved."</td>
				<td style='text-align:center' class='forumheader3'>".$medal_bonus."</td>
				<td style='text-align:center' class='forumheader3'>
				<a href='".e_SELF."?medal.edit.$medal_id'>".ADMIN_EDIT_ICON."</a>
				<input type='image' title='".LAN_DELETE."' name='delete[medal_$medal_id]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(ADLAN_RS_MDF28." [$medal_name]")."') \"/>
				</td>
				</tr>\n";
			}
			$text .= "</table></form>";
			} else {
			$text .= "<div style='text-align:center'><div style='vertical-align:middle'>".ADLAN_RS_MDF29."</div>";
		}
		$text .= "</div>";
		$ns->tablerender(ADLAN_RS_MDF30, $text);
	}
	
	function show_goals($sub_action, $id) {
		global $sql, $ns, $tp;

		if ($sub_action == "edit") {
			if ($sql->db_Select("rank_medal_goal", "*", "med_goal_id='$id' ")) {
				$row = $sql->db_Fetch();
				extract($row);
				if ($med_goal_type == "time") {
					$tmesplit = $this->split_qtyval($med_goal_value);
					$med_goal_value = $tmesplit['qty'];
				}
			}
		} else {
			$med_goal_type = "int";
		}

		$text = "<div style='text-align:center'>
		<form action='".e_SELF."?goal' id='dataform' method='post'>
		<table class='fborder' style='".ADMIN_WIDTH."'>
		
		<tr>
			<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF33."</span></td>
			<td class='forumheader3' colspan='2' style='width:70%'><input class='tbox' type='text' name='med_goal_name' size='55' value='$med_goal_name' maxlength='50'/></td>
		</tr>
		
		<tr>
			<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF34."</span></td>
			<td class='forumheader3' colspan='2' style='width:70%'>".$this->goal_getTargetBox($med_goal_target)."</td>
		</tr>
		
		<tr>
			<td class='forumheader3' rowspan='2' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF35."</span></td>
			<td class='forumheader3' rowspan='2' style='width:20%'><input class='tbox' type='text' name='med_goal_value' size='15' value='$med_goal_value' maxlength='10'/></td>
			<td class='forumheader3' style='width:50%'>
				<input type='radio'" . ($med_goal_type == "int" ? "checked='checked'":"") . " name='med_goal_type' class='tbox' value='int' /> " . ADLAN_RS_MDF53 . "
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%'>
				<input type='radio'" . ($med_goal_type == "time" ? "checked='checked'":"") . " name='med_goal_type' class='tbox' value='time' /> " . ADLAN_RS_MDF54 . "
				". $this->timeSelectBox("tg_value", $tmesplit['val']) . "
			</td>
		</tr>

		<tr>
			<td class='forumheader3' colspan='3'>&nbsp;</td>
		</tr>
		
		<tr>
			<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_MDF43."</span></td>
			<td class='forumheader3' colspan='2' style='width:70%'>
			<input type='checkbox' name='revalidate' value='T' />
			</td>
		</tr>
		

		<tr><td colspan='3' style='text-align:center' class='forumheader'>";
		if ($id) {
			$text .= "<input class='button' type='submit' name='update_goal' value='".ADLAN_RS_MDF36."' />
			<input class='button' type='submit' name='goal_clear' value='".ADLAN_RS_MDF8."' />
			<input type='hidden' name='med_goal_id' value='".$id."' />
			</td></tr>";
			} else {
			$text .= "<input class='button' type='submit' name='create_goal' value='".ADLAN_RS_MDF37."' /></td></tr>";
		}
		$text .= "</table>
		</form>
		</div>";

		$ns->tablerender(ADLAN_RS_MDF37, $text);

		unset($med_goal_name, $med_goal_target, $med_goal_type, $med_goal_value);

		$text = "<div style='text-align: center'>";
		if ($goal_total = $sql->db_Select("rank_medal_goal")) {
			$text .= "
			<form action='".e_SELF."?goal' id='dataform' method='post'>
			<table class='fborder' style='".ADMIN_WIDTH."'>
			<tr>
			<td style='width:5%;text-align:center' class='fcaption'>".ADLAN_RS_MDF9."</td>
			<td style='width:40%;text-align:center' class='fcaption'>".ADLAN_RS_MDF11."</td>
			<td style='width:25%;text-align:center' class='fcaption'>".ADLAN_RS_MDF34."</td>
			<td style='width:20%;text-align:center' class='fcaption'>".ADLAN_RS_MDF35."</td>
			<td style='width:10%;text-align:center' class='fcaption'>&nbsp;</td>
			</tr>";
			while ($row = $sql->db_Fetch()) {
				extract($row);
				if ($med_goal_type == "time") {
					$med_goal_value = $this->getTimeString($med_goal_value);
				}
				
				$text .= "<tr>
				<td style='text-align:center' class='forumheader3'>$med_goal_id</td>
				<td style='text-align:left' class='forumheader3'>$med_goal_name</td>
				<td style='text-align:center' class='forumheader3'>".$this->goal_targetToString($med_goal_target)."</td>
				<td style='text-align:right' class='forumheader3'>$med_goal_value</td>
				<td style='text-align:center' class='forumheader3'>
				<a href='".e_SELF."?goal.edit.$med_goal_id'>".ADMIN_EDIT_ICON."</a>
				<input type='image' title='".LAN_DELETE."' name='delete[goal_$med_goal_id]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(ADLAN_RS_MDF38." [$med_goal_name]")."') \"/>
				</td>
				</tr>\n";
			}
			$text .= "</table></form>";
			} else {
			$text .= "<div style='text-align:center'><div style='vertical-align:middle'>".ADLAN_RS_MDF39."</div>";
		}
		$text .= "</div>";
		$ns->tablerender(ADLAN_RS_MDF32, $text);
	}
	
	function split_qtyval($total) {
		if ($total >= 31536000 && $total % 31536000 == 0) {
			$split['qty'] = $total / 31536000;
			$split['val'] = 31536000;
		} else if ($total >= 2628288 && $total % 2628288 == 0) {
			$split['qty'] = $total / 2628288;
			$split['val'] = 2628288;
		} else if ($total >= 604800 && $total % 604800 == 0) {
			$split['qty'] = $total / 604800;
			$split['val'] = 604800;
		} else if ($total >= 86400 && $total % 86400 == 0) {
			$split['qty'] = $total / 86400;
			$split['val'] = 86400;
		} else if ($total >= 3600 && $total % 3600 == 0) {
			$split['qty'] = $total / 3600;
			$split['val'] = 3600;
		} else if ($total >= 60 && $total % 60 == 0) {
			$split['qty'] = $total / 60;
			$split['val'] = 60;
		} else {
			$split['qty'] = $total;
			$split['val'] = 1;
		}
		
		return $split;
	}
	
	function getTimeString($total) {
		if ($total >= 31536000 && $total % 31536000 == 0) {
			return ($total / 31536000) . " " . ADLAN_RS_MDF61;
		} else if ($total >= 2628288 && $total % 2628288 == 0) {
			return ($total / 2628288) . " " . ADLAN_RS_MDF60;
		} else if ($total >= 604800 && $total % 604800 == 0) {
			return ($total / 604800) . " " . ADLAN_RS_MDF59;
		} else if ($total >= 86400 && $total % 86400 == 0) {
			return ($total / 86400) . " " . ADLAN_RS_MDF58;
		} else if ($total >= 3600 && $total % 3600 == 0) {
			return ($total / 3600) . " " . ADLAN_RS_MDF57;
		} else if ($total >= 60 && $total % 60 == 0) {
			return ($total / 60) . " " . ADLAN_RS_MDF56;
		} else {
			return $total  . " " . ADLAN_RS_MDF55;
		}
	}
	
	function timeSelectbox($name, $curval = 0) {
		$box = "\t<select name='$name' class='tbox'>\n";
		
		$box .= "<option value='1' " . ($curval == 1 ? "selected='selected'" : "") . ">" . ADLAN_RS_MDF55 . "</option>";
		$box .= "<option value='60' " . ($curval == 60 ? "selected='selected'" : "") . ">" . ADLAN_RS_MDF56 . "</option>";
		$box .= "<option value='3600' " . ($curval == 3600 ? "selected='selected'" : "") . ">" . ADLAN_RS_MDF57 . "</option>";
		$box .= "<option value='86400' " . ($curval == 86400 ? "selected='selected'" : "") . ">" . ADLAN_RS_MDF58 . "</option>";
		$box .= "<option value='604800' " . ($curval == 604800 ? "selected='selected'" : "") . ">" . ADLAN_RS_MDF59 . "</option>";
		$box .= "<option value='2628288' " . ($curval == 2628288 ? "selected='selected'" : "") . ">" . ADLAN_RS_MDF60 . "</option>";
		$box .= "<option value='31536000' " . ($curval == 31536000 ? "selected='selected'" : "") . ">" . ADLAN_RS_MDF61 . "</option>";
		
		$box .= "</select>";
		
		return $box;
	}
	
	
	function goal_targetToString($target) {
		global $e_rank;
		foreach($e_rank as $plugin) {
			foreach($plugin as $key) {
				if (is_array($key) && $key['goal'] == $target) {
					return $key['name'];
				}
			}
		}
	}
	
	function goal_getTargetBox($currValue = "") {
		global $e_rank;
		$box = "<select name='med_goal_target' class='tbox'>";

		foreach($e_rank as $plugin) {
			foreach($plugin as $key) {
				if (is_array($key) && $key['goal'] != "") {
					$box .= "<option value='".$key['goal']."' ". ($currValue == $key['goal'] ? "selected = 'selected'" : "") . ">".$key['name']."</option>";
				}
			}
		}

		$box .= "</select>";
		
		return $box;
	}
	
	function isImage($name) {
		if (strlen($name) < 5) return false;
		
		$ext = substr(strtoupper($name), strlen($name)-3);
		return ($ext == 'JPG' || $ext == 'GIF' || $ext == 'PNG');
	}
	
	function imageSelectRow($label, $form_name, $form_value) {
		
		$handle = opendir(e_PLUGIN."rank_system/images/medals");
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
			$itext .= "<img src='" .e_PLUGIN. "rank_system/images/medals/" . $form_value . "' border='0' alt='$form_value' title='$form_value' />";
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
				<img src='".e_PLUGIN."rank_system/images/medals/$image' style='border:0;width:10%' alt='$image' title='$image' 
					onclick=\"document.getElementById('$form_name.curr').innerHTML='<img src=\'" .e_PLUGIN. "rank_system/images/medals/$image\' border=\'0\' alt=\'$image\' title=\'$image\' />'\" />
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
	
}


?>