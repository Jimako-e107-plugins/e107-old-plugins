<?php
/**
 * $Id: rank_class.php,v 1.11 2010/01/30 00:13:54 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.11 $
 * Last Modified: $Date: 2010/01/30 00:13:54 $
 *
 * Change Log:
 * $Log: rank_class.php,v $
 * Revision 1.11  2010/01/30 00:13:54  michiel
 * Default "Send PM" trigger set to 'never' (to avoid mass PM's upon new installation)
 *
 * Revision 1.10  2010/01/29 23:41:32  michiel
 * Disabled forgotten SQL Debug notifications
 *
 * Revision 1.9  2009/11/01 16:41:31  michiel
 * BugFix: Typo in Insert query
 *
 * Revision 1.8  2009/10/23 17:16:02  michiel
 * Workaround e107 bug: always allow HTML in rank system PMs
 *
 * Revision 1.7  2009/10/23 16:01:30  michiel
 * BugFix: remove deleted users
 *
 * Revision 1.6  2009/10/23 15:49:03  michiel
 * Configure Site Penalty settings
 *
 * Revision 1.5  2009/10/22 15:03:38  michiel
 * Implemented customizable conditions
 *
 * Revision 1.4  2009/07/14 19:29:12  michiel
 * CVS Merge
 *
 * Revision 1.3.2.4  2009/07/13 19:08:02  michiel
 * minor BugFix on image path (using absolute path now)
 *
 * Revision 1.3.2.3  2009/07/13 18:53:14  michiel
 * - Added Sending PM
 * - Moved save funtion into rank_class
 *
 * Revision 1.3.2.2  2009/07/12 12:39:40  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.2  2009/07/12 11:48:32  michiel
 * Added comment
 *
 * Revision 1.3.4.1  2009/07/02 21:26:31  michiel
 * Verify that Gold System has been installed, before invoking it...
 *
 * Revision 1.3  2009/06/28 15:06:12  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.3  2009/06/28 13:16:00  michiel
 * Prefs upgrade from v1.2 to v1.3
 *
 * Revision 1.2.2.2  2009/06/28 13:00:42  michiel
 * BugFixes:
 * - only adding auto probation/prison comment when comment field is still empty
 * - only performing auto probation when not already in prison
 *
 * Revision 1.2.2.1  2009/06/28 02:34:22  michiel
 * - Position of rank image in forum is configurable
 * - Medal/Ribbon counts can be shown in forum
 *
 * Revision 1.2  2009/06/26 09:23:32  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.3  2009/06/24 19:20:29  michiel
 * Removed private function declarations to be compatible with php4
 *
 * Revision 1.1.2.2  2009/05/20 18:39:54  michiel
 * Updated Medals
 *
 * Revision 1.1.2.1  2009/04/01 19:26:42  michiel
 * Medal goal automated using e_rank.php
 *
 * Revision 1.1  2009/03/28 13:01:49  michiel
 * Initial CVS revision
 *
 *  
 */
class rank
{
	function rank() {
		global $RANK_PREF;
		// get the preferences
		$this->load_prefs();
	}

	/**
	 * Returns the active rank for the specified UserID
	 *
	 * @param $user_id The user ID
	 * @return the active rank of this user in an array, or (false in case of an error):
	 * ['uid']		= The User's ID
	 * ['id'] 		= The rank's ID
	 * ['name'] 	= The rank's name
	 * ['image'] 	= The rank's image
	 * ['category'] = The rank's Category name
	 * ['cat_id']	= The rank's Category id
	 * ['values']	= The user's condition values
	 * ['points']	= The user's rank points
	 * ['medpoints']= The user's medal points
	 * ['totpoints']= The user's total points
	 * ['probation']= On Probation 1 (true) or 0 (false)
	 * ['prison']	= In Prison 1 (true) or 0 (false)
	 * ['kicked']	= Is kicked 1 (true) or 0 (false)
	 */
	function getRank($user_id) {
		global $sql;
			
		if (!$user_id) {
			return 0;
		}
		
		/*
		 * Update rank stats by default..
		 * So it will be up to date when showed and be created
		 * in case it doesn't exists yet
		 */
		$this->updateRank($user_id, false, 'by_kick', true );

		$query = "select u.*, r.rank_name, r.rank_img, c.category_id, c.category_name from #rank_users u, #rank_ranks r, #rank_category c where u.user_userid = ".$user_id." and r.rank_id = u.user_rankid and c.category_id = r.rank_category";
		if ($sql->db_Select_gen($query,false)) {
			$row = $sql->db_Fetch();
			$rank['uid'] = $user_id;
			$rank['id'] = $row['user_rankid'];
			$rank['name'] = $row['rank_name'];
			$rank['category'] = $row['category_name'];
			$rank['cat_id'] = $row['category_id'];
			$rank['points'] = $row['rank_points'];
			$rank['medpoints'] = $row['rank_medal'];
			$rank['totpoints'] = $rank['points'] + $rank['medpoints'];
			$rank['values'] = unserialize($row['user_values']);
			$rank['probation'] = ($row['user_probation'] == "T" ? 1 : 0);
			$rank['prison'] = ($row['user_prison'] == "T" ? 1 : 0);
			$rank['kicked'] = ($row['user_kicked'] == "T" ? 1 : 0);
				
			if ($rank['kicked'] == 1) {
				$row['rank_img']='Kicked.png';
				$rank['name']=RANKS_11;
			} else if ($rank['prison'] == 1) {
				$row['rank_img']='Prison.png';
				$rank['name']=RANKS_09;
			} else if ($rank['probation'] == 1) {
				$row['rank_img']='Probation.png';
				$rank['name']=RANKS_10;
			}
			$rank['image'] = $this->convertImage($row['rank_img']);
		} else {
			$rank = false;
		}

		return $rank;
	}
	
	function convertImage($image) {
		if (!$image) {
			return "";
		}
			
		if (substr($image, 1, 4) == "http" || substr($image,1,1) == "." || substr($image,1,1) == "/") {
			return $image;
		}
			
		$convert = e_PLUGIN_ABS. "rank_system/images/ranks/" . $image;
		return $convert;
	}

	/**
	 * Calculates the requirements for the next rank
	 *
	 * In case the rank is frozen, "FIXED" will be returned.
	 * In case there is no next rank due to an age limitation, "AGE" will be returned.
	 * In case the user already has the highest (non reserved) rank, false will be returned.
	 * 
	 * Otherwise an array with these keys/values will be returned:
	 * ['rankid']	The ID of the next rank
	 * ['points']	The points required for the next rank
	 * ['diff']		The difference between the required and the current (total) points
	 * ['prog']		The progress (% of the next rank against the current (total) points)
	 *
	 * @param $user_id user id
	 */
	function nextRank($user_id) {
		if (!$user_id) {
			return 0;
		}
		
		global $sql;
		
		$sql->db_Select("rank_users", "user_rankid, rank_points, rank_medal, freeze_rank, user_prison, user_probation, user_kicked", "user_userid = $user_id");
		$usr = $sql->db_Fetch();
		
		if ($usr['freeze_rank'] == "T") {
			return "FIXED";
		}
		if ($usr['user_probation'] == "T" || $usr['user_prison'] == "T" || $usr['user_kicked'] == "T") {
			return false;
		}
		
		$curr_id = $usr['user_rankid'];
		$curr_points = ($usr['rank_points'] + $usr['rank_medal']);
		
		$sql->db_Select("rank_ranks", "rank_order, rank_points", "rank_id = $curr_id");
		$curr = $sql->db_Fetch();
		
		if ($sql->db_Select("user_extended", "user_birthday", "user_extended_id=$user_id")) {
			$row = $sql->db_Fetch();
			extract($row);
				
			$sql->db_Select("rank_users", "exclude_agelimit", "user_userid=$user_id");
			$row = $sql->db_Fetch();
			if ($row['exclude_agelimit'] == "T") {
				$agecheck = '';
			} else {
				$age = $this->getAge($user_birthday);
				$agecheck = 'and c.category_age <= '.$age;
			}
		} else {
			$agecheck = 'and c.category_age <= 0';
		}
		
		$query = "
			SELECT 
				r.rank_id, 
				r.rank_points 
			FROM 
				#rank_ranks r, 
				#rank_category c
			WHERE 
				rank_order < ". $curr['rank_order'] ." 
				AND rank_reserved = 'F'
				AND c.category_id = r.rank_category
				$agecheck
			ORDER BY
				rank_order desc
    	"; 

		if ($sql->db_Select_gen($query, false)) {
			$next = $sql->db_Fetch();
		} else {
			/*
			 * No next rank.
			 * Is this an age limitation, or just already the highest (non reserved) rank?
			 */
			$query = "
				SELECT 
					r.rank_id, 
					r.rank_points 
				FROM 
					#rank_ranks r 
				WHERE 
					rank_order < ". $curr['rank_order'] ." 
					AND rank_reserved = 'F'
				ORDER BY
					rank_order desc
	    	"; 
			if ($sql->db_Select_gen($query, false)) {
				/*
				 * without agecheck, we did find a rank..
				 * So the limitation is based on age
				 */
				return "AGE";
			}  else {
				/*
				 * without agecheck, we didn't find any either..
				 * So it's already the heighest rank
				 */
				return false;
			}
		}
		
		$nextrank['rankid'] = $next['rank_id'];
		$nextrank['points'] = $next['rank_points'];
		$nextrank['diff'] = ($next['rank_points'] - $curr_points);
		$top = ($next['rank_points'] - $curr['rank_points']);
		$now = ($curr_points - $curr['rank_points']);
		$nextrank['prog'] = round(100/$top * $now, 1)."%";
		
		return $nextrank;
	}
	
	function fetchRank($level, $user_id) {
		if (!$user_id) {
			return 0;
		}

		$fetchSql = new db;

		if ($fetchSql->db_Select("user_extended", "user_birthday", "user_extended_id=$user_id")) {
			$row = $fetchSql->db_Fetch();
			extract($row);
				
			$fetchSql->db_Select("rank_users", "exclude_agelimit", "user_userid=$user_id");
			$row = $fetchSql->db_Fetch();
			if ($row['exclude_agelimit'] == "T") {
				$agecheck = '';
			} else {
				$age = $this->getAge($user_birthday);
				$agecheck = 'and c.category_age <= '.$age;
			}
		} else {
			$agecheck = 'and c.category_age <= 0';
		}
				
		$query = "
		select r.rank_id from #rank_ranks r, #rank_category c
		where rank_points <= $level and rank_reserved = 'F'
		and c.category_id = r.rank_category $agecheck
		order by rank_order
    	"; 

		$fetchSql->db_Select_gen($query, false);
		$row = $fetchSql->db_Fetch();
		return $row['rank_id'];
	}
	

	function getAge($user_birthday) {
		if ($user_birthday == "0000-00-00" || $user_birthday == "0" || $user_birthday == "") {
			return 0;
		}
			
		$age = date("Y-m-d", time()) - $user_birthday;

		$currMD = date("m-d", time());
		$usrMD = substr($user_birthday, 5, 6);
		if ($currMD < $usrMD) {
			$age--;
		}
			
		if ($age < 0 || $age > 100) {
			$age = 0;
		}

		return $age;
	}
	
	/**
	 * Calculates the factored condition value
	 * @param $curval	The original value
	 * @param $modif	The factor
	 * @param $round	Should the outcome be rounded?
	 * @return int		The value to use
	 */
	function calcFactor($curval, $modif, $round = true) {
		$sign = substr($modif, 0, 1);
		if ($sign == '+' || $sign == '*' || $sign == '-' || $sign == '/' || $sign == '%') {
			$modif = intval(substr($modif, 1));
		} else {
			$sign = '';
		}
		
		if ($sign == '+') {
			$newval = $curval + $modif;
		} else if ($sign == '-') {
			$newval = $curval - $modif;
		} else if ($sign == '-') {
			$newval = $curval - $modif;
		} else if ($sign == '*') {
			$newval = $curval * $modif;
		} else if ($sign == '/') {
			$newval = $curval / $modif;
		} else if ($sign == '%') {
			$newval = ($curval / 100) * $modif;
		} else {
			$newval = $modif;
		}
		
		if ($round) $newval = round($newval);
		return $newval;
	}
	
	function getTrigger($trigger) {
		global $e_rank;
		foreach($e_rank as $plugin) {
			foreach($plugin as $key) {
				if (is_array($key) && $key['trigger'] == $trigger) {
					return $key;
				}
			}
		}
	}
	
	function prepareTriggerQuery($query, $user_id) {
		$query = str_replace("{USER_ID}", $user_id, $query);
		
		return $query;
	}
	
	function getTriggerValue($user_id, $trigger_name) {
		global $sql, $e_rank;
		
		$trigger = $this->getTrigger($trigger_name);
		if (isset($trigger)) {
			//Get current value
			if ($trigger['query'] != "") {
				$query = $this->prepareTriggerQuery($trigger['query'], $user_id);				
				if ($sql->db_Select_gen($query)) {
					$row = $sql->db_Fetch();
					$value = $row['count'];
				}
			} else {
				if ($sql->db_Select($trigger['table'], $trigger['field'], $trigger['usr_field']." = $user_id")) {
					$row = $sql->db_Fetch();
					$value = $row[$trigger['field']];
				}
			}
		} else {
			$value = 0;
		}
		
		return $value;
	}
	
	function updateConditions($user_id, $login = false) {
		global $sql, $e_rank, $RANK_PREF;
		if (!is_object($e_rank)) $this->loadPlugins();
		
		if (!$user_id) {
			return false;
		}
		
		if (!$sql->db_Select("rank_users", "user_values, freeze_penalty, user_lastcheck", "user_userid = $user_id")) {
			//user doesn't exist
			return false;
		}
		extract($sql->db_Fetch());
		$user_values = unserialize($user_values);
		
		$sql->db_Select("user", "*", "user_id = $user_id");
		$userrec = $sql->db_Fetch();
		$userrec['user_lastcheck'] = $user_lastcheck;
		
		unset($new_values);
		$rank_points = 0;
		
		$sql->db_Select("rank_condition", "*");
		$condList = $sql->db_getList();
		foreach ($condList as $cond) {
			extract($cond);
			
			if ($condit_trigger == "trigger_manual") {
				$new_values[$condit_id.'_value'] = intval($user_values[$condit_id.'_value']);
			} else if ($condit_trigger == "trigger_siteinv") {
				$new_values[$condit_id.'_value'] = $this->siteScore($userrec, $condit_maxval);
			} else if ($condit_trigger == "trigger_sitepen") {
				if ($freeze_penalty == "T") {
					$new_values[$condit_id.'_value'] = intval($user_values[$condit_id.'_value']);
				} else {
					$penalty = intval($user_values[$condit_id.'_value']);
					if ($login) {
						$penalty -= $RANK_PREF['sitpen_recovery'];
						if ($penalty < 0) $penalty = 0;
					} else {
						$penalty = $this->sitePenalty($userrec, $penalty, $condit_maxval);
					}
					$new_values[$condit_id.'_value'] = $penalty;
				}
			} else {
				$new_values[$condit_id.'_value'] = $this->getTriggerValue($user_id, $condit_trigger);
			}

			if ($condit_trigger != "trigger_manual" && $condit_factor != "") {
				$new_values[$condit_id.'_value'] = $this->calcFactor($new_values[$condit_id.'_value'], $condit_factor);
			}
			
			if ($condit_hastext == "T") {
				$new_values[$condit_id.'_text'] = $user_values[$condit_id.'_text'];
			}
			
			//verify range
			if ($new_values[$condit_id.'_value'] < 0) $new_values[$condit_id.'_value'] = 0;
			else if ($new_values[$condit_id.'_value'] > $condit_maxval) $new_values[$condit_id.'_value'] = $condit_maxval;
			
			if ($condit_enabled == "T") {
				if ($condit_negative == "T") $rank_points -= $new_values[$condit_id.'_value'];
				else $rank_points += $new_values[$condit_id.'_value'];
			}
		}
		
		$new_values = serialize($new_values);
		$sql->db_Update("rank_users", "user_values = '$new_values', rank_points = $rank_points where user_userid = $user_id");
	}

	/**
	 * Calculates and updates the rank for the specified UserID
	 * Including site scores
	 *
	 * @param int $user_id 	The user ID
	 * @param boolean $login	In case true, the penalty value will be decreased (when not 0)
	 * @param String $bancheck	In case
	 * 						'ignore'	don't change anything
	 * 						'by_ban'	kick/unkick this user, depending on the user_ban state
	 * 						'by_kick'	ban/unban this user, depending on the user_kicked state
	 *
	 * @param $skip_log		In case true, no log entry will be sent to admin log (for internal changes)
	 */
	function updateRank($user_id, $login = false, $bancheck = 'by_kick', $skip_log = false) {
		global $sql, $RANK_PREF, $admin_log, $gold_obj, $pref,$e107cache;
		/*
		 * BugFix @v1.3.1
		 * Check if Gold System is installed, before invoking the gold class
		 */
		$gold_installed = array_key_exists("gold_system", $pref['plug_installed']);
		
		if (!$user_id) {
			return 0;
		}

		$this->updateConditions($user_id, $login);
		
		if ($sql->db_Select("rank_users", "*", "user_userid = ".$user_id)) {
			$row = $sql->db_Fetch();
			extract($row);
			$old_rank = $user_rankid;
			
			$query = "
				SELECT rank_category
				FROM
					#rank_ranks,
					#rank_users
				WHERE
					rank_id = user_rankid
					and user_userid = $user_id
			";
			$sql->db_Select_gen($query);
			$row = $sql->db_Fetch();
			$old_cat = intval($row['rank_category']);
				
			if ($sql->db_Select("user", "*", "user_id = ".$user_id)) {
				$user = $sql->db_Fetch();
			} else {
				return 0;
			}

			$needCalc = true;
				
			if ($RANK_PREF['rank_integrateKick'] == "T") {
				switch ($bancheck) {
					case 'by_kick':
						if ($user_kicked == "T") {
							$sql->db_Update("user", "user_ban=1 where user_id=".$user_id);
							$needCalc = false;
						} else {
							//do not update when not banned.. (could be 'not verified')
							if ($user['user_ban'] == 1) {
								$sql->db_Update("user", "user_ban=0 where user_id=".$user_id);
							}
						}
						break;
					case 'by_ban':
						if ($user['user_ban'] == 1) {
							$user_kicked = "T";
							$needCalc = false;
						} else {
							$user_kicked = "F";
						}
						break;
				}
			}
				
			if ($needCalc == true && $freeze_rank == "F") {
				$level = 0+$rank_points+$rank_medal;
				if ($level <= 0) {
					$level = 0;
				}

				$user_rankid = $this->fetchRank($level, $user_id);

				//Auto probation/prison
				/*
				 * Can't be used anymore, since there's no fixed 'behaviour' field anymore.
				 */
//				if ($RANK_PREF['rank_autoprison'] > 0 && $rank_behave >= $RANK_PREF['rank_autoprison']) {
//					$user_prison = "T";
//					if ($prison_comment == "") $prison_comment = ADLAN_RS_C14;
//				} else if ($RANK_PREF['rank_autoprobation'] > 0 && $rank_behave >= $RANK_PREF['rank_autoprobation'] && $user_prison == "F") {
//					$user_probation = "T";
//					if ($probation_comment == "") $probation_comment = ADLAN_RS_C15;
//				}
			}
			
			if ($gold_installed) {	
				/*
				 * Check if user needs to get paid again
				 */
				if (
					$user_prison == 'F' 
					&& $user_kicked == 'F' 
					&& $user_probation == 'F'
					&& (time() - $wage_last >= (604800)) //7 days
				) {
					if (!isset($gold_obj)) {
						$gold_obj = new gold();
					}
					
					if (isset($gold_obj) && $gold_obj->gold_plugins['rank_system']) {
						$this->payWage($user_id, $user_rankid);
						$wage_last = time();
					}
				}
			}

			$query = "update #rank_users SET user_rankid=".$user_rankid.
				", user_lastcheck=".time().", user_kicked='".$user_kicked.
				"', wage_last=".$wage_last." where user_userid=".$user_id;
			$sql->db_Select_gen($query, false);
				
			$this->updateClasses($user_id, 0, $old_cat);
			
			if (!$login && !$skip_log && $RANK_PREF['rank_adminlog'] == "T") {
				$msg = RANKS_LOG_01.' <a href=/user.php?id.'.$user_id.'>'.$user['user_name'].'</a>';
				$admin_log->log_event('Rank System',$msg,E_LOG_PLUGIN);
			}
			
			if (($RANK_PREF['rank_sendpm'] == 2 || $RANK_PREF['rank_sendpm'] == 3) && $user_rankid != $old_rank) {
				//collect data
				$sql->db_Select("user", "user_name", "user_id = $user_id");
				$row = $sql->db_Fetch();
				$vars['user_name'] = $row['user_name'];
				$sql->db_Select("rank_ranks", "rank_name, rank_order, rank_img", "rank_id = $user_rankid");
				$row = $sql->db_Fetch();
				$vars['rank_name'] = $row['rank_name'];
				$vars['rank_image'] = "<img src='".$this->convertImage($row['rank_img'])."' alt='".$row['rank_name']."' title='".$row['rank_name']."'>";
				$new_order = $row['rank_order'];
				$sql->db_Select("rank_ranks", "rank_order", "rank_id = $old_rank");
				$row = $sql->db_Fetch();
				$old_order = $row['rank_order'];
				
				$message = ($old_order > $new_order) ? RANKS_PM_09 : RANKS_PM_10;
				$message = $this->parsePM($message, $vars);
				$this->sendPM($user_id, ($old_order > $new_order ? RANKS_PM_07 : RANKS_PM_08), $message);
			}

			$e107cache->clear("rank_up_$user_id");
			
			return $user_rankid;
		} else {
			//New user!
			if ($sql->db_Select("user", "*", "user_id = ".$user_id)) {
				$user = $sql->db_Fetch();
			} else {
				return 0;
			}

			$prison = ($RANK_PREF['rank_newpris'] == 'T' ? "'T', '".RANKS_19."'" : "'F', ''");
			$probation = ($RANK_PREF['rank_newprob'] == 'T' ? "'T', '".RANKS_19."'" : "'F', ''");
			
			$sql->db_Insert("rank_users", 
				$user_id			//UserID
				.", 0"				//RankID
				.", ''"				//Condition values
				.", 0"				//Rank points
				.", 0"				//Medal bonus
				.", 'F'"			//Freeze penalty
				.", 'F'"			//Freeze rank
				.", ".time()		//User_lastcheck
				.", $prison"		//Prison state and comment
				.", $probation"		//Probation state and comment
				.", 'F'"			//Kicked state
				.", ''"				//Kicked comment
				.", 'F'"			//Exclude agelimit
				.", ".time()		//last Wage 
			, false);

			$this->updateConditions($user_id, $login);
			$sql->db_Select("rank_users", "rank_points, rank_medal", "user_userid = $user_id");
			extract($sql->db_Fetch());
			$level = 0+$rank_points+$rank_medal;
			if ($level <= 0) {
				$level = 0;
			}

			$user_rankid = $this->fetchRank($level, $user_id);
			$sql->db_Update("rank_users", "user_rankid = $user_rankid where user_userid = $user_id");
			
			$this->updateClasses($user_id);
			
			$e107cache->clear("rank_up_$user_id");
			return $user_rankid;
		}
	}
	
	function parsePM($text, $vars) {
		$text = str_replace("{USER_NAME}", $vars['user_name'], $text);
		$text = str_replace("{MEDAL_NAME}", $vars['medal_name'], $text);
		$text = str_replace("{DESCRIPTION}", $vars['description'], $text);
		$text = str_replace("{MEDAL_REWARD}", $vars['medal_reward'], $text);
		$text = str_replace("{GOLD_CURRENCY}", $vars['gold_currency'], $text);
		$text = str_replace("{RANK_NAME}", $vars['rank_name'], $text);
		$text = str_replace("{RANK_IMAGE}", $vars['rank_image'], $text);
		$text = str_replace("{MEDAL_IMAGE}", $vars['medal_image'], $text);
		
		return $text;
	}
	
	
	function payWage($uid, $rankid) {
		global $gold_obj, $sql, $pref;
		$gold_installed = array_key_exists("gold_system", $pref['plug_installed']);
		
		if (!$gold_installed) {
			return;
		}
		
		if (intval($uid) == 0 || intval($rankid) == 0) {
			return;
		}
		
		/*
		 * No wage for people with a site penalty
		 * (in other words, people that don't visit frequently)
		 */
		if ($sql->db_Select("rank_users", "rank_penalty", "user_userid = $uid")) {
			$row = $sql->db_Fetch();
			if (intval($row['rank_penalty']) > 0) {
				return;
			}
		} else {
			return;
		}
		
		if ($sql->db_Select("rank_ranks", "rank_name, rank_wage", "rank_id = $rankid")) {
			$row = $sql->db_Fetch();
			extract($row);
			
			$gold_param['gold_user_id'] = $uid;
		    $gold_param['gold_who_id'] = 0;
		    $gold_param['gold_amount'] = $rank_wage;
		    $gold_param['gold_type'] = RANKS_01;
		    $gold_param['gold_action'] = 'credit';
		    $gold_param['gold_plugin'] = 'rank_system';
		    $gold_param['gold_log'] = RANKS_GS_01.$rank_name.RANKS_GS_02;
		    $gold_param['gold_forum'] = 0;
		    $gold_obj->gold_modify($gold_param, false);
		}
	}

	function updateClasses($uid, $catid = 0, $oldcat = 0) {
		global $sql, $RANK_PREF;

		$query = "
			SELECT 
				user_prison
				,user_probation
				,user_kicked
			FROM
				#rank_users
			WHERE
				user_userid = $uid
		";
		$sql->db_Select_gen($query);
		$row = $sql->db_Fetch();
		$isKicked = ($row['user_kicked'] == "T" ? true : false);
		$onProbation = ($row['user_probation'] == "T" ? true : false);
		$inPrison = ($row['user_prison'] == "T" ? true : false);

		if ($catid == 0) {
			$query = "
				SELECT 
					rank_category
					,user_rankid
				FROM
					#rank_ranks,
					#rank_users
				WHERE
					rank_id = user_rankid
					and user_userid = $uid
			";
			if ($sql->db_Select_gen($query)) {
				$row = $sql->db_Fetch();
				$catid = intval($row['rank_category']);
			} else {
				$catid = 0;
			}
			
		}

		/*
		 if ($catid == $oldcat && !$isKicked && !$inPrison && !$onProbation) {
			return;
			}
			*/

		$sql->db_Select("rank_category", "category_class", "category_id=$catid");
		$row = $sql->db_Fetch();
		$newClass = explode(",", $row['category_class']);

		if ($oldcat > 0) {
			$sql->db_Select("rank_category", "category_class", "category_id=$oldcat");
			$row = $sql->db_Fetch();
			$oldClass = explode(",", $row['category_class']);
		}

		$sql->db_Select("user", "user_class", "user_id=$uid");
		$row = $sql->db_Fetch();
		$usrClass = explode(",", $row['user_class']);

		// Remove old classes
		if ($oldcat > 0) {
			$usrClass = $this->removeClasses($usrClass, $oldClass);
		}

		if (!$inPrison) {
			$usrClass = $this->removeClasses($usrClass, explode(",", $RANK_PREF['rank_prisusrcls']));
		}
		if (!$onProbation) {
			$usrClass = $this->removeClasses($usrClass, explode(",", $RANK_PREF['rank_probusrcls']));
		}

		//Add New classes
		if ($catid > 0 && !$isKicked && !$inPrison && !$onProbation) {
			$usrClass = $this->addClasses($usrClass, $newClass);
		} else {
			$usrClass = $this->removeClasses($usrClass, $newClass);
		}

		if ($inPrison) {
			$usrClass = $this->addClasses($usrClass, explode(",", $RANK_PREF['rank_prisusrcls']));
		}
		if ($onProbation) {
			$usrClass = $this->addClasses($usrClass, explode(",", $RANK_PREF['rank_probusrcls']));
		}

		//Update user's classes
		$newUsr = implode(",", $usrClass);
		if (substr($newUsr, 0, 1) == ",") {
			$newUsr = substr($newUsr, 1);
		}

		$sql->db_Update("user", "user_class = '$newUsr' where user_id = $uid");
	}

	/*
	 * Removed private declaration to be compatible with php4
	 */
	function removeClasses($usrClass, $toRemove) {
		while (list($key, $class_id) = each($toRemove)) {
			$key = array_search($class_id, $usrClass);
			if (!($key === FALSE)) {
				unset($usrClass[$key]);
			}
		}

		// make a new array
		$usrClass = array_values($usrClass);
		// sort it
		sort($usrClass);
		return $usrClass;
	}

	/*
	 * Removed private declaration to be compatible with php4
	 */
	function addClasses($usrClass, $toAdd) {
		while (list($key, $class_id) = each($toAdd)) {
			$key = array_search($class_id, $usrClass);
			if ($key === FALSE) {
				$usrClass[count($usrClass)] = $class_id;
			}
		}

		// make a new array
		$usrClass = array_values($usrClass);
		// sort it
		sort($usrClass);
		return $usrClass;
	}

	function siteScore($user, $max) {
		if (!$user) {
			return 0;
		}
		extract($user);
			
		$level = round( ((($user_forums ) + ($user_comments ) + ($user_chats ) + $user_visits *2)/4) /10 );
		if ($level > $max) {
			$level = $max;
		}
		return $level;
	}

	function sitePenalty($user, $current, $max) {
		global $RANK_PREF;
		
		if (!$user) {
			return 0;
		}
		extract($user);
		
		if ($current > 0 && (time() - $user_lastcheck) < 86400 ) {
			/*
			 * avoid checking a single user more than once a day, since it may
			 * increase it's penalty each check
			 */
			return $current;
		}
		
		/*
		 * Construction:
		 * 
		 * User doesn't visit for S days.
		 * After that, he will get a penalty of P points per D days.
		 * Once he visits again, he will get a recovery of R points each visit
		 * 		(visits as when e107 upgrades the visits value, which is once after 
		 * 		 10 hours of not visiting)
		 *  
		 * Assume these values for example:
		 * S(tart) = 7 days, P(enalty) = 5 per D(ay) = 1.
		 * R(evovery) = 5 per visit.
		 * 
		 * L(ast visit) = 10 days ago.
		 * A user that hasn't visited for 10 days, will have a penalty of 15:
		 * 3 days after start value, of 5 points each day = 15 points.
		 * 
		 * user isn't visiting the next day either and will fall into this method.
		 * $current will be 15. calculation will result into 20 points.
		 * therefor the NEW value will be set to 20
		 * -> calc value >= current  --> set current to calc value
		 * 
		 * Now the user visits again (yeay!).
		 * He will get a recovery of 5 points and remain with a penalty of 15.
		 * 
		 * The next 6 days, the user won't visit anymore again. Each time he falls through
		 * this method, he's till in the grace period (S = 7 days) and will remain at his 
		 * 15 penalty.
		 * 
		 * The next day, still no visit.
		 * Penalty calculation will result into 5 points.
		 * $current was 15 (the points he already had of the previous period).
		 * therefor the NEW value will be set to 20
		 * -> calc value < current  --> add calc value to current
		 *  
		 */
		
		//last visit was x days ago
		$last_visit = round((time() - $user_currentvisit) / 86400);
		
		//still in the grace period?
		if ($last_visit < $RANK_PREF['sitpen_start']) {
			return $current;
		}
		
		//deduct grace period. Left over is actual days eligible for penalty 
		$last_visit -= $RANK_PREF['sitpen_start'];
		
		//penalty will be P points for each D days
		$penalty = floor( $last_visit / $RANK_PREF['sitpen_penday'] ) * $RANK_PREF['sitpen_penalty'];
		
		//As described above, determine whether to SET the calc, or ADD the calc
		$new_penalty = ( $penalty < $current ? ($current + $penalty) : $penalty );
		
		//Check boundary
		if ($new_penalty < 0) {
			$new_penalty = 0;
		} else if ($new_penalty > $max) {
			$new_penalty = $max;
		}
		
		return $new_penalty;
	}

	function validateAll() {
		$validb = new db;
		
		//First, remove deleted users
		$query = "
			DELETE FROM 
				#rank_users
			WHERE 
				user_userid not in (
					SELECT
						user_id
					FROM
						#user
				)
		";
		$validb->db_Select_gen($query, false);
		
		$validb->db_Select("user", "*", "1=1 order by user_id");
		while ($row = $validb->db_Fetch()) {
			$this->updateRank($row['user_id'], false, 'by_ban', true);
		}
	}

	function getdefaultprefs() {
		global $RANK_PREF;
		$RANK_PREF = array('rank_viewclass' => e_UC_MEMBER,
			'rank_plugclass' => e_UC_MAINADMIN,
			'rank_modifyclass' => e_UC_ADMIN,
            'rank_reservedclass' => e_UC_MAINADMIN,
            'rank_freezerankcls' => e_UC_MAINADMIN,
			'rank_freezesitecls' => e_UC_ADMIN,
			'rank_modown' => 'F',
			'rank_lastverify' => 0,
			'rank_barheight' =>10,
			'rank_inprisoncls' => e_UC_ADMIN,
			'rank_outprisoncls' => e_UC_MAINADMIN,
			'rank_inprobationcls' => e_UC_ADMIN,
			'rank_outprobationcls' => e_UC_MAINADMIN,
			'rank_kickcls' => e_UC_ADMIN,
			'rank_skipagecls' => e_UC_MAINADMIN,
//			'rank_autoprobation' =>25,
//			'rank_autoprison' =>50,
			'rank_integrateKick' => 'T',
			'rank_adminlog' => 'T',
			'rank_forumimg' => '{AVATAR}',
			'rank_forumstat' => '{LEVEL=special}',
			'rank_forumbreak' => '2',
			'rank_forumwidth' => 0,
			'rank_forumheight' =>0,
			'medal_modifyclass' => e_UC_ADMIN,
			'medal_modreservedclass' => e_UC_MAINADMIN,
			'rank_recomclass' => e_UC_MEMBER,
			'rank_recviewclass' => e_UC_ADMIN,
			'rank_newprob' => 'F',
			'rank_newpris' => 'F',
			'rank_frmimgoffset' => '+',
			'rank_frmstatoffset' => '+',
			'rank_sendpm' => 0,
			'rank_pmsender' => 1,
			'rank_lvlstyle' => 0,
			'rank_lvlupwidth' => 80,
			'rank_lvlovwidth' => 400,
			'sitpen_start' => 7,
			'sitpen_penalty' => 5,
			'sitpen_penday' => 1,
			'sitpen_recovery' => 5
		
		);
	}

	function save_prefs() {
		global $sql, $eArrayStorage, $RANK_PREF;
		// save preferences to database
		if (!is_object($sql)) {
			$sql = new db;
		}
		$tmp = $eArrayStorage->WriteArray($RANK_PREF);
		$sql->db_Update('core', "e107_value='$tmp' where e107_name='ranks'", false);
		return ;
	}

	function load_prefs() {
		global $sql, $eArrayStorage, $RANK_PREF;

		// get preferences from database
		if (!is_object($sql)) {
			$sql = new db;
		}
		$num_rows = $sql->db_Select('core', '*', "e107_name='ranks' ");
		$row = $sql->db_Fetch();

		if (empty($row['e107_value'])) {
			// insert default preferences if none exist
			$this->getDefaultPrefs();
			$tmp = $eArrayStorage->WriteArray($RANK_PREF);
			$sql->db_Insert('core', "'ranks', '$tmp' ");
			$sql->db_Select('core', '*', "e107_name='ranks' ");
		} else {
			$RANK_PREF = $eArrayStorage->ReadArray($row['e107_value']);
		}
		
		/*
		 * Conversion for v1.2- to v1.3
		 */
		if ($RANK_PREF['rank_forumimg'] == "T") $RANK_PREF['rank_forumimg'] = "{AVATAR}"; 
		else if ($RANK_PREF['rank_forumimg'] == "F") $RANK_PREF['rank_forumimg'] = "-";
		if (!isset($RANK_PREF['rank_forumstat'])) { 
			$RANK_PREF['rank_forumstat'] = '{LEVEL=special}';
			$RANK_PREF['rank_forumbreak'] = '2';
			$RANK_PREF['rank_frmimgoffset'] = '+';
			$RANK_PREF['rank_frmstatoffset'] = '+';
		}
		/*
		 * Conversion for v1.3- to v1.4
		 */
		if ($RANK_PREF['rank_pmsender'] == 0) {
			$RANK_PREF['rank_sendpm'] = 1;
			$RANK_PREF['rank_pmsender'] = 1;
		}
		/*
		 * Conversion for v1.4- to v1.5
		 */
		if ($RANK_PREF['rank_lvlupwidth'] == 0) {
			$RANK_PREF['rank_lvlstyle'] = 0;
			$RANK_PREF['rank_lvlupwidth'] = 80;
			$RANK_PREF['rank_lvlovwidth'] = 400;
			$RANK_PREF['sitpen_start'] = 7;
			$RANK_PREF['sitpen_penalty'] = 5;
			$RANK_PREF['sitpen_penday'] = 1;
			$RANK_PREF['sitpen_recovery'] = 5;
		}
		
		
		return;
	}

	function needUserCheck($user_id) {
		global $sql;

		if ($sql->db_Select("rank_users", "user_lastcheck", "user_userid=$user_id")) {
			$row = $sql->db_Fetch();
			//Verify after each hour (to save some performance but also get new posts etc.)
			if (time() - $row['user_lastcheck'] > 3600) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	function needVerifyAll() {
		global $RANK_PREF;
		return (time() - $RANK_PREF['rank_lastverify'] > 86400);
	}
	
	function loadPlugins() {
		global $pref, $e_rank;
		
		//Define required system triggers
		$e_rank[] = array(
		    'plug_name' => 'RS Internal',
		    'plug_folder' => 'rank_system',
			'trigger_manual' => array (
				'trigger' => 'trigger_manual',
				'name' => RANKS_CT_01
			),
			'trigger_siteinv' => array (
				'trigger' => 'trigger_siteinv',
				'name' => RANKS_CT_02
			),
			'trigger_sitepen' => array (
				'trigger' => 'trigger_sitepen',
				'name' => RANKS_CT_03
			),
			'medals' => false,
			'ranks' => true
		);
		
	    $rank_pluglist = $pref['plug_installed'];
	    ksort($rank_pluglist);
	    foreach($rank_pluglist as $rank_plugin => $rank_version) {
	        if (file_exists(e_PLUGIN . $rank_plugin . '/e_rank.php') && is_readable(e_PLUGIN . $rank_plugin . '/e_rank.php')) {
	            require_once(e_PLUGIN . $rank_plugin . '/e_rank.php');
	        } 
	    }
	}
	
	function sendPM($receiver, $subject, $message) {
		global $RANK_PREF, $sql, $pref;
		
		if ($receiver == 0 || $message == "") {
			return false;
		}
		
        require_once(e_PLUGIN . "pm/pm_class.php");
        require_once(e_PLUGIN . "pm/pm_func.php");
        $pmfrom = ($RANK_PREF['rank_pmsender'] > 0 ? $RANK_PREF['rank_pmsender'] : 1);
        $pm = new private_message();
        
        $sql->db_Select("user", "*", "user_id=$receiver");
        $row = $sql->db_Fetch();
        extract($row);
        if ($user_id > 0) {
            $pm_vars['pm_subject'] = $subject;
            $pm_vars['pm_message'] = $message;
            $pm_vars['to_info']['user_id'] = $user_id;
            $pm_vars['from_id'] = $pmfrom;
            $pm_vars['to_info']['user_email'] = $user_email;
            $pm_vars['to_info']['user_name'] = $user_name;
            $pm_vars['to_info']['user_class'] = $user_class;
            
            //temporary allow all to send HTML (otherwise the PM will be messed up)
            $orig_val = $pref['post_html'];
            $pref['post_html'] = e_UC_PUBLIC;
            $res = $pm->add($pm_vars);
            $pref['post_html'] = $orig_val;
        }
        return $res;
	}
	
	function save_POST($rank_uid, $POST) {
		global $sql, $RANK_PREF, $tp;
		
		$POST['reset_penalty'] = ($POST['reset_penalty'] == "") ? "F" : "T";
		$POST['freeze_penalty'] = ($POST['freeze_penalty'] == "") ? "F" : "T";
		$POST['freeze_rank'] = ($POST['freeze_rank'] == "") ? "F" : "T";
		$POST['user_prison'] = ($POST['user_prison'] == "") ? "F" : "T";
		$POST['user_probation'] = ($POST['user_probation'] == "") ? "F" : "T";
		$POST['user_kicked'] = ($POST['user_kicked'] == "") ? "F" : "T";
		$POST['exclude_agelimit'] = ($POST['exclude_agelimit'] == "") ? "F" : "T";
		
		if ($POST['reset_penalty'] == "T") {
			$resetp = ", rank_penalty=0 ";
		} else {
			$resetp = "";
		}
		
		$query = "
		SELECT rank_category
		FROM
			#rank_ranks,
			#rank_users
		WHERE
			rank_id = user_rankid
			and user_userid = $rank_uid
		";
		$sql->db_Select_gen($query);
		$row = $sql->db_Fetch();
		$old_cat = intval($row['rank_category']);
		if ($sql->db_Select("rank_users", "user_rankid, user_values", "user_userid = $rank_uid")) {
			$row = $sql->db_Fetch();
			$old_rank = intval($row['user_rankid']);
		} else {
			$old_rank = 0;
		}
		
		$user_values = unserialize($row['user_values']);
		$sql->db_Select("rank_condition", "*", "condit_enabled = 'T'");
		$condList = $sql->db_getList();
		foreach ($condList as $cond) {
			extract($cond);
			
			if ($condit_trigger == "trigger_manual") {
				$user_values[$condit_id.'_value'] = intval($POST[$condit_id.'_value']);
			} else if ($condit_trigger == "trigger_sitepen" && $POST['reset_penalty'] == "T") {
				$user_values[$condit_id.'_value'] = 0;
			}
			if ($condit_hastext == "T") {
				$user_values[$condit_id.'_text'] = $tp->toDB($POST[$condit_id.'_text']);
			}
		}
		$user_values = serialize($user_values);
		
		$query = "update #rank_users SET user_rankid=".$POST['user_rankid'].
				", user_values='".$user_values."', user_lastcheck=".time(). 
				", freeze_rank='".$POST['freeze_rank']."', freeze_penalty='".$POST['freeze_penalty'].
				"', user_prison='".$POST['user_prison']."', prison_comment='".$POST['prison_comment'].
				"', user_probation='".$POST['user_probation']."', probation_comment='".$POST['probation_comment'].
				"', user_kicked='".$POST['user_kicked']."', kicked_comment='".$POST['kicked_comment'].
				"', exclude_agelimit='".$POST['exclude_agelimit'].
				"' ".
				" where user_userid=".$rank_uid;
		$sql->db_Select_gen($query, false);
		
		$this->updateClasses($rank_uid, 0, $old_cat);
		
		$this->updateRank($rank_uid);
		
		if ($old_rank != $POST['user_rankid'] && $POST['freeze_rank'] == "T" && ($RANK_PREF['rank_sendpm'] == 2 || $RANK_PREF['rank_sendpm'] == 3)) {
			$user_rankid = $POST['user_rankid'];
			//collect data
			$sql->db_Select("user", "user_name", "user_id = $rank_uid");
			$row = $sql->db_Fetch();
			$vars['user_name'] = $row['user_name'];
			$sql->db_Select("rank_ranks", "rank_name, rank_order, rank_img", "rank_id = $user_rankid");
			$row = $sql->db_Fetch();
			$vars['rank_name'] = $row['rank_name'];
			$vars['rank_image'] = "<img src='".$this->convertImage($row['rank_img'])."' alt='".$row['rank_name']."' title='".$row['rank_name']."'>";
			$new_order = $row['rank_order'];
			$sql->db_Select("rank_ranks", "rank_order", "rank_id = $old_rank");
			$row = $sql->db_Fetch();
			$old_order = $row['rank_order'];
			
			$message = ($old_order > $new_order) ? RANKS_PM_09 : RANKS_PM_10;
			$message = $this->parsePM($message, $vars);
			$this->sendPM($rank_uid, ($old_order > $new_order ? RANKS_PM_07 : RANKS_PM_08), $message);
		}
	}

}

?>