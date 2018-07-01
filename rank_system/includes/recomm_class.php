<?php
/**
 * $Id: recomm_class.php,v 1.3 2009/10/22 17:28:28 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.3 $
 * Last Modified: $Date: 2009/10/22 17:28:28 $
 *
 * Change Log:
 * $Log: recomm_class.php,v $
 * Revision 1.3  2009/10/22 17:28:28  michiel
 * - Implemented conditions
 * - Processing action upong changing the recommendation state
 * - Members can view the recommendations they've submitted themselves
 *
 * Revision 1.2  2009/07/14 19:29:12  michiel
 * CVS Merge
 *
 * Revision 1.1.8.1  2009/07/12 12:39:40  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.1.10.1  2009/07/12 11:56:19  michiel
 * BugFix: Made some changes for PHP4
 *
 * Revision 1.1  2009/03/28 13:01:49  michiel
 * Initial CVS revision
 *
 *  
 */
class recommend
{
	function recommend() {
	}

	function getTypeBox($curval = 1) {
		$box = "\t<select name='recomm_type' class='tbox'>\n";
	
		$box .= "<option value='1' ".($curval == 1 ? "selected='selected'" : "").">".RANKS_RM_03."</option>";
		$box .= "<option value='2' ".($curval == 2 ? "selected='selected'" : "").">".RANKS_RM_04."</option>";
		$box .= "<option value='3' ".($curval == 3 ? "selected='selected'" : "").">".RANKS_RM_05."</option>";
		
		$box .= "</select>";
		
		return $box;
	}
	
	function getTypeName($type) {
		switch ($type) {
			case 1: return RANKS_RM_03;
			case 2: return RANKS_RM_04;
			case 3: return RANKS_RM_05;
			default: return "--";
		}
	}
	
	function getLevelBox($curval = 1) {
		global $sql;
		
		$sql->db_Select("rank_condition", "condit_id, condit_name", "condit_enabled = 'T' and condit_trigger = 'trigger_manual'");
		$condList = $sql->db_getList();
		
		$box = "\t<select name='recomm_for' class='tbox'>\n";
		
		foreach ($condList as $cond) {
			extract($cond);
			$box .= "<option value='$condit_id' ".($curval == $condit_id ? "selected='selected'" : "").">".$condit_name."</option>";
		} 
	
		$box .= "</select>";
		
		return $box;
	}

	function getLevelName($level) {
		global $sql, $tp;
		
		if ($sql->db_Select("rank_condition", "condit_name", "condit_id = $level")) {
			$row = $sql->db_Fetch();
			return $tp->toHTML($row['condit_name']);
		} else {
			return "---";
		}
		
	}
	
	function getMedalBox($curval = 0) {
		global $sql;
		
		$box = "\t<select name='recomm_for' class='tbox'>\n";
		
		if ($sql->db_Select("rank_medals", "medal_id, medal_name", "medal_type=1 order by medal_order")) {
			while ($row = $sql->db_Fetch()) {
				$sel = ($curval == $row['medal_id'] ? "selected='selected'" : "");
				$box .= "<option value='".$row['medal_id']."' $sel>".$row['medal_name']."</option>";
			}
		}
		
		$box .= "</select>";
		
		return $box;
	}
	
	function getMedalName($medal) {
		global $sql;
		
		if ($sql->db_Select("rank_medals", "medal_name", "medal_id=$medal")) {
			$row = $sql->db_Fetch();
			return $row['medal_name'];
		} else {
			return "--";
		}
	}

	function getMemberBox($curval = 0, $showOwn = false) {
		global $sql;
		
		$box = "\t<select name='recomm_target' class='tbox'>\n";
		
		$own = ($showOwn ? "" : "and user_id <> ".USERID);
		
		if ($sql->db_Select("user", "user_id, user_name", "user_ban=0 $own order by user_name")) {
			while ($row = $sql->db_Fetch()) {
				$sel = ($curval == $row['user_id'] ? "selected='selected'" : "");
				$box .= "<option value='".$row['user_id']."' $sel>".$row['user_name']."</option>";
			}
		}
		
		$box .= "</select>";
		
		return $box;
	}
	
	function getMemberName($user, $showrank = false) {
		global $sql;
		
		if ($sql->db_Select("user", "user_name", "user_id=$user")) {
			$row = $sql->db_Fetch();
			$name = $row['user_name'];
			
			$query = "
				SELECT
					rank_name
				FROM
					#rank_ranks,
					#rank_users
				WHERE
					user_userid = $user
					AND rank_id = user_rankid
			";
			if ($showrank && $sql->db_Select_gen($query)) {
				$row = $sql->db_Fetch();
				$name = $row['rank_name'] ." ".$name;
			}
		} else {
			$name = "--";
		}
		
		return $name;
	}
	
	function getForName($type, $for) {
		switch ($type) {
			case 1:
				$fortext = $this->getLevelName($for);
				break;
			case 3:
				$fortext = $this->getMedalName($for);
				break;
			default:
				$fortext = "";
		}
		
		return $fortext;
	}
	
	function getRecommendLine($type, $for) {
		$text = $this->getTypeName($type);
		$fortext = $this->getForName($type, $for);
		$text .= ' <strong>'.$fortext.'</strong>';
		
		return $text;
	}
	
	function submitRecomm($target, $type, $for, $remarks) {
		global $sql, $tp, $e_event;
		
		$source = USERID;
		
		if ($sql->db_Insert("rank_recommend", "0, $source, $target, $type, $for, ".time().", '$remarks',0")) {
			$edata_sn = array(
				"source" => $this->getMemberName($source, true)
				,"target" => $this->getMemberName($target, true)
				,"recomm" => $this->getRecommendLine($type, $for)
				,"motiv" => $tp->toHTML($remarks)
			);
			$e_event->trigger("recommpost", $edata_sn);
			return true;
		} else {
			return false;
		}
	}
	
	function getStateName($state) {
		switch ($state) {
			case 0: return ADLAN_RS_RM10;
			case 1: return ADLAN_RS_RM11;
			case 2: return ADLAN_RS_RM12;
			case 3: return ADLAN_RS_RM11 . ": " . ADLAN_RS_RM19;
			case 4: return ADLAN_RS_RM11 . ": +1";
			case 5: return ADLAN_RS_RM11 . ": +5";
			case 6: return ADLAN_RS_RM11 . ": +10";
			case 7: return ADLAN_RS_RM11 . ": +15";
			case 8: return ADLAN_RS_RM11 . ": +20";
			case 9: return ADLAN_RS_RM11 . ": +25";
			default: return "--";
		}
	}
	
	function getStateBox($curval = 0, $id = 0, $type = 0) {
		if ($curval > 0) {
//			$box = "
//				<input type='hidden' name='recomm_state". ($id > 0 ? "[$id]" : "" ) ."  value='$curval' />
//			";
			$box .= $this->getStateName($curval);
		} else {
			
			$box = "\t<select name='recomm_state". ($id > 0 ? "[$id]": "") ."' class='tbox'>\n";
		
			$box .= "<option value='0' ".($curval == 0 ? "selected='selected'" : "").">".ADLAN_RS_RM10."</option>";
			$box .= "<option value='2' ".($curval == 2 ? "selected='selected'" : "").">".ADLAN_RS_RM17."</option>";
			
			switch ($type) {
				case 1:
					$box .= "<option value='3' ".($curval == 3 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": ".ADLAN_RS_RM19."</option>";
					$box .= "<option value='4' ".($curval == 4 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": +1</option>";
					$box .= "<option value='5' ".($curval == 5 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": +5</option>";
					$box .= "<option value='6' ".($curval == 6 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": +10</option>";
					$box .= "<option value='7' ".($curval == 7 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": +15</option>";
					$box .= "<option value='8' ".($curval == 8 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": +20</option>";
					$box .= "<option value='9' ".($curval == 9 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": +25</option>";
					break;
				case 2:
					$box .= "<option value='3' ".($curval == 3 ? "selected='selected'" : "").">".ADLAN_RS_RM18. ": ".ADLAN_RS_RM19."</option>";
					break;
				case 3:
					$box .= "<option value='1' ".($curval == 1 ? "selected='selected'" : "").">".ADLAN_RS_RM18."</option>";
					break;
			}
			
			
			$box .= "</select>";
		}
		
		return $box;
	}
	
	function processState($id, $state) {
		global $sql, $rank_obj;
		
		if ($state == 0) return;
		
		if ($state == 2 || $state == 3) {
			//declined or custom
			$sql->db_update("rank_recommend", "recomm_state == $state where recomm_id = $id");
			return;
		}
		
		if ($sql->db_Select("rank_recommend", "*", "recomm_id = $id")) {
			extract($sql->db_Fetch());
			
			if ($recomm_type == 1) {
				//Rank Condition
				if ($sql->db_Select("rank_condition", "*", "condit_id = $recomm_for")) {
					$cond = $sql->db_Fetch();
					$sql->db_Select("rank_users", "user_values", "user_userid = $recomm_target");
					$values = $sql->db_Fetch();
					$values = unserialize($values['user_values']);
					$values[$recomm_for.'_value'] += $this->getStateIncrease($state);
					if ($values[$recomm_for.'_value'] > $cond['condit_maxval']) {
						$values[$recomm_for.'_value'] = $cond['condit_maxval'];
					}
					
					$values = serialize($values);
					$sql->db_Update("rank_users", "user_values = '$values' where user_userid = $recomm_target");
					$rank_obj->updateRank($recomm_target);
				}
				$sql->db_Update("rank_recommend", "recomm_state = $state where recomm_id = $recomm_id");
			} else if ($recomm_type == 2) {
				/*
				 * Behaviour
				 * do nothing.. has to be either custom or declined, 
				 * so is already taken care of
				 */
			} else if ($recomm_type == 3) {
				//Medal (has to be just 'granted')
				require_once(e_PLUGIN . 'rank_system/includes/medal_class.php');
				$med_obj = new medal();
				$med_obj->grantMedal($recomm_for, $recomm_target, $recomm_remarks);
				$sql->db_Update("rank_recommend", "recomm_state = $state where recomm_id = $id");
			}
		}
	}
	
	function getStateIncrease($recomm_state) {
		switch ($recomm_state) {
			case 4: return 1;
			case 5: return 5;
			case 6: return 10;
			case 7: return 15;
			case 8: return 20;
			case 9: return 25;
			default: return 0;
		}
	}
	
	
}

?>