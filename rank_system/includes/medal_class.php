<?php
/**
 * $Id: medal_class.php,v 1.6 2009/12/25 15:47:02 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.6 $
 * Last Modified: $Date: 2009/12/25 15:47:02 $
 *
 * Change Log:
 * $Log: medal_class.php,v $
 * Revision 1.6  2009/12/25 15:47:02  michiel
 * BugFix: rank_class wasn't loaded yet in some cases
 *
 * Revision 1.5  2009/10/22 21:29:49  michiel
 * Implemeted Time-based goals
 *
 * Revision 1.4  2009/10/22 15:02:02  michiel
 * Using cache
 *
 * Revision 1.3  2009/07/14 19:29:14  michiel
 * CVS Merge
 *
 * Revision 1.2.6.4  2009/07/13 21:53:21  michiel
 * able to show medals/ribbons on category
 *
 * Revision 1.2.6.3  2009/07/13 19:08:03  michiel
 * minor BugFix on image path (using absolute path now)
 *
 * Revision 1.2.6.2  2009/07/13 18:52:11  michiel
 * - Added Sending PM
 * - Added result overview of validateall
 *
 * Revision 1.2.6.1  2009/07/12 12:39:38  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.2.8.1  2009/07/12 11:47:03  michiel
 * Show list of changes after revalidate all
 *
 * Revision 1.2  2009/06/26 09:23:40  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.4  2009/06/24 19:20:31  michiel
 * Removed private function declarations to be compatible with php4
 *
 * Revision 1.1.2.3  2009/06/19 13:47:21  michiel
 * Made XHTML compliant
 *
 * Revision 1.1.2.2  2009/05/20 18:39:55  michiel
 * Updated Medals
 *
 * Revision 1.1.2.1  2009/04/01 19:26:42  michiel
 * Medal goal automated using e_rank.php
 *
 * Revision 1.1  2009/03/28 13:01:47  michiel
 * Initial CVS revision
 *
 *  
 */
class medal {
	
	function medal() {
	}

	function getMedals($user_id) {
		global $tp;
		require_once(e_HANDLER."date_handler.php");
		
		if (!$user_id) {
			return 0;
		}
		
		$msql = new db;
		$dt = new convert();
		
		$medals['count'] = $this->userMedalCount($user_id);
		
		if ($medals['count'] == 0) {
			return $medals;
		}

		$counter = 1;
		
		$query="
			SELECT
				m.medal_id, 
				m.medal_name, 
				m.medal_type, 
				m.medal_img, 
				u.med_user_date,
				c.med_cat_id,
				c.med_cat_name
			FROM
				#rank_medals m, 
				#rank_medal_users u,
				#rank_medal_category c
			WHERE
				med_user_id = $user_id 
				AND medal_id = med_user_medal
				AND med_cat_id = medal_category 
			ORDER BY
				medal_type,
				medal_order
		";
			
		$msql->db_Select_Gen($query, false);
		
		while ($row = $msql->db_Fetch()) {
			extract($row);
			$medals[$counter]['id'] = $medal_id;
			$medals[$counter]['name'] = $tp->toHTML($medal_name);
			$medals[$counter]['image'] = $this->convertImage($medal_img);
			$medals[$counter]['type'] = $medal_type;
			$medals[$counter]['date'] = $dt->convert_date($med_user_date);
			$medals[$counter]['cat_id'] = $med_cat_id;
			$medals[$counter]['cat_name'] = $tp->toHTML($med_cat_name);
			$counter++;
		}
		
		return $medals;
	}
	
	function userMedalCount($user_id) {
		$countsql = new db;
		
		if ($countsql->db_Select("rank_medal_users", "count(med_user_index) count", "med_user_id=$user_id")) {
			$row = $countsql->db_Fetch();
			return $row['count'];
		} else {
			return 0;
		}
	}
	
	function convertImage($image) {
		if (!$image) {
			return "";
		}
		 
		if (substr($image, 1, 4) == "http" || substr($image,1,1) == "." || substr($image,1,1) == "/") {
			return $image;
		}
		 
		$convert = e_PLUGIN_ABS. "rank_system/images/medals/" . $image;
		return $convert;
	}
	
	function createImage($image, $name, $date, $width = 0, $height = 0) {
		//$image = $this->convertImage($image);
		
		$alt = $name;
		if ($date) {
			$alt .= " (".$date.")";
		}
		$size = "";
		if ($width > 0) {
			$size .= " width='".$width."'";
		}
		if ($height > 0) {
			$size .= " height='".$height."'";
		}
		
		return "<img src='$image' border='0' alt='$alt' title='$alt' $size />";
	}
	
	function getGoal($goal_target, $goal_value) {
		global $sql;
		
		if ($sql->db_Select("rank_medal_goal", "med_goal_id", "med_goal_target='$goal_target' and med_goal_value=$goal_value")) {
			$row = $sql->db_Fetch();
			return $row['med_goal_id']; 
		} else{
			return 0;
		}
	}
	
	function getMedalForGoal($goal_id) {
		global $sql;
		
		if ($sql->db_Select("rank_medals", "medal_id", "medal_goal=$goal_id")) {
			$row = $sql->db_Fetch();
			return $row['medal_id']; 
		} else{
			return 0;
		}
	}
	
	function userHasMedal($medal_id, $user_id) {
		global $sql;
		
		if ($sql->db_Select("rank_medal_users", "med_user_index", "med_user_id=$user_id and med_user_medal=$medal_id")) {
			$row = $sql->db_Fetch();
			return $row['med_user_index']; 
		} else{
			return 0;
		}
	}
	
	function grantMedal($medal_id, $user_id, $remarks = "") {
		global $sql, $rank_obj, $pref, $gold_obj, $tp, $RANK_PREF, $e107cache;
		$gold_installed = array_key_exists("gold_system", $pref['plug_installed']);
		require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
		if (!$rank_obj) {
			$rank_obj = new rank();
		}
		
		//Already has the medal? -> abort
		if ($sql->db_Count("rank_medal_users", "(*)", "where med_user_id = $user_id and med_user_medal = $medal_id") > 0) {
			return false;
		}
		
		$sql->db_Insert("rank_medal_users", "0, $user_id, $medal_id, ".time().", '".$remarks."'");
		
		$sql->db_Select("rank_medals", "medal_bonus, medal_name, medal_type, medal_reward, medal_img2", "medal_id=$medal_id");
		$row = $sql->db_Fetch();
		$bonus = intval($row['medal_bonus']);
		$reward = intval($row['medal_reward']);
		$name = $tp->toHTML($row['medal_name']);
		$type = intval($row['medal_type']);
		$image = $row['medal_img2'];
		
		if ($bonus > 0) {
			$sql->db_Update("rank_users", "rank_medal=rank_medal+$bonus where user_userid=$user_id");
			$rank_obj->updateRank($user_id);
		}
		
		if ($reward > 0 && $gold_installed) {
			if (!isset($gold_obj)) {
				$gold_obj = new gold();
			}
			
			$gold_param['gold_user_id'] = $user_id;
		    $gold_param['gold_who_id'] = 0;
		    $gold_param['gold_amount'] = $reward;
		    $gold_param['gold_type'] = RANKS_01;
		    $gold_param['gold_action'] = 'credit';
		    $gold_param['gold_plugin'] = 'rank_system';
		    $gold_param['gold_log'] = RANKS_GS_03.$name.($type == 0 ? RANKS_GS_04 : RANKS_GS_05);
		    $gold_param['gold_forum'] = 0;
		    $gold_obj->gold_modify($gold_param, false);
		}
		
		if ($RANK_PREF['rank_sendpm'] == 1 || $RANK_PREF['rank_sendpm'] == 3) {
			//collect data
			$vars['medal_name'] = $name;
			$vars['medal_reward'] = $reward;
			$vars['description'] = $remarks;
			$vars['medal_image'] = "<img src='".$this->convertImage($image)."' alt='$name' title='$name'>";
			$sql->db_Select("user", "user_name", "user_id = $user_id");
			$row = $sql->db_Fetch();
			$vars['user_name'] = $row['user_name'];
			if ($gold_installed) {
				if (!isset($gold_obj)) {
					$gold_obj = new gold();
				}
				global $GOLD_PREF;
				$vars['gold_currency'] = $GOLD_PREF['gold_currency_name'];
			}
			
			$message = ($type == 0) ? RANKS_PM_04 : RANKS_PM_03;
			if ($remarks != "") $message .= "<br/><br/>".RANKS_PM_05;
			if ($reward > 0) $message .= "<br/><br/>".RANKS_PM_06;
			$message = $rank_obj->parsePM($message, $vars);
			$rank_obj->sendPM($user_id, ($type == 0 ? RANKS_PM_02 : RANKS_PM_01), $message);
		} 
		
		$e107cache->clear("rank_up_$user_id");
		return true;
	}
	
	function revokeMedal($medal_id, $user_id) {
		global $sql, $rank_obj, $e107cache;
		
		if (!$sql->db_Delete("rank_medal_users", "med_user_id=$user_id and med_user_medal=$medal_id")) {
			return false;
		}

		$sql->db_Select("rank_medals", "medal_bonus", "medal_id=$medal_id");
		$row = $sql->db_Fetch();
		$bonus = intval($row['medal_bonus']);
		
		if ($bonus > 0) {
			$sql->db_Update("rank_users", "rank_medal=rank_medal-$bonus where user_userid=$user_id");
			require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
			if (!$rank_obj) {
				$rank_obj = new rank();
			}
			$rank_obj->updateRank($user_id);
		}
		
		$e107cache->clear("rank_up_$user_id");
		return true;
	}

	function revokeMedalIndex($index) {
		global $sql, $rank_obj, $e107cache;
		
		$query = "
			SELECT
				med_user_id,
				medal_bonus
			FROM
				#rank_medal_users,
				#rank_medals
			WHERE
				medal_id = med_user_medal
				AND med_user_index = $index
		"; 
		$sql->db_Select_gen($query);
		extract($sql->db_Fetch());
		
		if (!$sql->db_Delete("rank_medal_users", "med_user_index=$index")) {
			return false;
		}
		
		if ($medal_bonus > 0) {
			$sql->db_Update("rank_users", "rank_medal=rank_medal-$medal_bonus where user_userid=$med_user_id");
			require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
			if (!$rank_obj) {
				$rank_obj = new rank();
			}
			$rank_obj->updateRank($med_user_id);
		}
		
		$e107cache->clear("rank_up_$user_id");
		return true;
	}
	
	function validateAll() {
		global $sql;
		
		/*
		$query = "select g.*, m.medal_id from #rank_medal_goal g, #rank_medals m where m.medal_goal = g.med_goal_id";
	    $sql->db_Select_gen($query, false);
		*/
		$sql->db_Select("rank_medal_goal", "distinct med_goal_target");
	    $goalList = $sql->db_getList();
		foreach($goalList as $goal) {
			extract($goal);
			$sql->db_Select("user", "user_id");
			$userList = $sql->db_getList();
			foreach($userList as $user) {
				extract($user);
				if ($usergranted = $this->validateTarget($user_id, $med_goal_target)) {
					$grants[$user_id] = $usergranted;
				}
			}
		}
		
		$this->validateBonus();
		
		return $grants;
	}
	
	function validateBonus() {
		global $sql;
		
		$sql->db_Select("rank_users", "user_userid");
		$userList = $sql->db_getList();
		foreach($userList as $user) {
			extract($user);
			//Recalculate Medal Bonus
			$query = "
				UPDATE #rank_users 
				SET rank_medal = (
					SELECT 
						sum(medal_bonus) 
					FROM 
						#rank_medal_users, 
						#rank_medals 
					WHERE 
						med_user_medal = medal_id 
						AND med_user_id = $user_userid
				)
				WHERE
					user_userid = $user_userid
			";
			$sql->db_Select_gen($query, false);
		}
	}
	
	function validateTarget($user_id, $target, $isPosting = false) {
		global $sql;

		if (!$user_id || $user_id == 0 || !$target) {
			return false;
		}
		
		$goalrec = $this->getGoalPlug($target);
		if (isset($goalrec)) {
			//Get current value
			if ($goalrec['query'] != "") {
				$query = $this->prepareGoalQuery($goalrec['query'], $user_id);
				if ($sql->db_Select_gen($query)) {
					$row = $sql->db_Fetch();
					$count = $row['count'];
				}
			} else {
				if ($sql->db_Select($goalrec['table'], $goalrec['field'], $goalrec['usr_field']." = $user_id")) {
					$row = $sql->db_Fetch();
					$count = $row[$goalrec['field']];
				}
			}
		}
		
		if ($isPosting) {
			$count++;
		}
		
		unset($granted);
		
		$query = "
			select m.medal_id
			from #rank_medal_goal g, #rank_medals m 
			where 
				m.medal_goal = g.med_goal_id
				and g.med_goal_target = '$target'
				and (
					(g.med_goal_type = 'int' and g.med_goal_value <= $count)
					or (g.med_goal_type = 'time' and g.med_goal_value <= ". (time() - $count) . ")
				)
		";
	    $sql->db_Select_gen($query, false);
	    $goalList = $sql->db_getList();
	    $count = 0;
		foreach($goalList as $goal) {
			extract($goal);
			if ($this->grantMedal($medal_id, $user_id)) {
				$granted[++$count] = $medal_id;
			}
		}
		
		return $granted;
	}
	
	/*
	 * Removed private declaration to be compatible with php4
	 */
	function prepareGoalQuery($query, $user_id) {
		$query = str_replace("{USER_ID}", $user_id, $query);
		
		return $query;
	}
	
	/*
	 * Removed private declaration to be compatible with php4
	 */
	function getGoalPlug($target) {
		global $e_rank, $rank_obj;
		require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
		if (!$rank_obj) {
			$rank_obj = new rank();
		}
		
		if (!isset($rank_obj)) {
			$rank_obj = new rank();
		}
		$rank_obj->loadPlugins();
		
		foreach($e_rank as $plugin) {
			foreach($plugin as $key) {
				if (is_array($key) && $key['goal'] == $target) {
					return $key;
				}
			}
		}
	}
}

?>