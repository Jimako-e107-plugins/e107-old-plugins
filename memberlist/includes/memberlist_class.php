<?php
/**
 * $Id: memberlist_class.php 62 2010-11-07 12:41:59Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 4 sep. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/includes/memberlist_class.php $
 * 
 * Revision: $LastChangedRevision: 62 $
 * Last Modified: $LastChangedDate: 2010-11-07 13:41:59 +0100 (zo, 07 nov 2010) $
 *
 */
class memberlist {
	function memberlist() {
		global $MBL_PREF;
		
		// get the preferences
		$this->load_prefs();
		
	}
	
	function getdefaultprefs() {
		global $MBL_PREF;
		$MBL_PREF = array(
			'list_pagesize' => 20
			,'editclass' => e_UC_ADMIN
			,'adminlog' => 1
			,'usrprofpos' => 'post'
			,'usrprofile' => 'USER_SIGNATURE'
		);
	}

	function save_prefs() {
		global $sql, $eArrayStorage, $MBL_PREF;
		// save preferences to database
		if (!is_object($sql)) {
			$sql = new db;
		}
		$tmp = $eArrayStorage->WriteArray($MBL_PREF);
		$sql->db_Update('core', "e107_value='$tmp' where e107_name='memberlist'", false);
		return ;
	}

	function load_prefs() {
		global $sql, $eArrayStorage, $MBL_PREF;

		// get preferences from database
		if (!is_object($sql)) {
			$sql = new db;
		}
		$num_rows = $sql->db_Select('core', '*', "e107_name='memberlist' ");
		$row = $sql->db_Fetch();

		if (empty($row['e107_value'])) {
			// insert default preferences if none exist
			$this->getDefaultPrefs();
			$tmp = $eArrayStorage->WriteArray($MBL_PREF);
			$sql->db_Insert('core', "'memberlist', '$tmp' ");
			$sql->db_Select('core', '*', "e107_name='memberlist' ");
		} else {
			$MBL_PREF = $eArrayStorage->ReadArray($row['e107_value']);
		}
		
		return;
	}
	
	function isAllowed($classID) {
		global $MBL_PREF;
		
		$tmp = explode(",", $MBL_PREF['groups']);
		return in_array($classID, $tmp);
	}
	
	function getGroupLink($classID) {
		global $MBL_PREF;
		
		if ($this->isAllowed($classID)) {
			return e_PLUGIN."memberlist/memberlist.php?show.0.0.0.0.$classID.$classID";
		} 
		
		return false;
	}
	
	function getGroupStyle($classID) {
		global $MBL_PREF, $sql, $gstyle_obj, $pref;
		
		//find link with groupstyle plugin
		if ($pref['plug_installed']['groupstyle']) {
			if (!is_object($gstyle_obj)) {
				require_once(e_PLUGIN . 'groupstyle/includes/groupstyle_class.php');
				$gstyle_obj = new groupstyle();
			}
			
			return $gstyle_obj->getGroupStyle($classID);
		}
		 
		return false;
	}
	
	function getPrimaryClass($user_id = USERID) {
		global $MBL_PREF, $sql, $gstyle_obj, $pref;
		
		//find link with groupstyle plugin
		if ($pref['plug_installed']['groupstyle']) {
			if (!is_object($gstyle_obj)) {
				require_once(e_PLUGIN . 'groupstyle/includes/groupstyle_class.php');
				$gstyle_obj = new groupstyle();
			}
			
			return $gstyle_obj->getPrimary($user_id);
		}
		 
		return false;
	}
	
	function getGroupList($userid = USERID) {
		global $sql;
		
		if (!$userid || $userid == 0) return false;
		
		if (!$sql->db_Select("user", "user_class", "user_id = $userid")) {
			return false;
		}
		$row = $sql->db_Fetch();
		if (!$row['user_class']) {
			return false;
		}
				
		$uList = explode(",", $row['user_class']);
		$list = array();
		
		while (list($key, $cls)=each($uList)) {
			if ($this->isAllowed($cls)) {
				if ($cls == e_UC_ADMIN) {
					$list[e_UC_ADMIN] = LAN_MBL_OV10;
				} else if ($sql->db_Select("userclass_classes", "userclass_name", "userclass_id = $cls")) {
					$row = $sql->db_Fetch();
					$list[$cls] = $row['userclass_name'];
				}
			}
		}
		
		asort($list);
		
		return $list;
	}
	
	function getUserStat($userid = USERID) {
		global $MBL_PREF, $sql, $gstyle_obj, $pref;

		if (!$userid || $userid == 0) return false;

		if (!$sql->db_Select("user", "user_admin, user_class", "user_id = $userid")) {
			return false;
		}
		$row = $sql->db_Fetch();
		$uList = explode(",", $row['user_class']);
		$isAdmin = ($row['user_admin'] ? true : false);
		
		//find link with groupstyle plugin
		if ($pref['plug_installed']['groupstyle']) {
			if (!is_object($gstyle_obj)) {
				require_once(e_PLUGIN . 'groupstyle/includes/groupstyle_class.php');
				$gstyle_obj = new groupstyle();
			}
			
			$user_primary = $gstyle_obj->getPrimary($userid);
		} else {
			$user_primary = false;
		}
		
		if ($isAdmin) {
			$cList[e_UC_ADMIN] = LAN_MBL_OV10;
		}
		$tmp = explode(",", $MBL_PREF['groups']);
		while (list($key, $cls)=each($tmp)) {
			if ($cls != e_UC_ADMIN && $sql->db_Select("userclass_classes", "userclass_name, userclass_editclass", "userclass_id = $cls")) {
				$row = $sql->db_Fetch();
				$cList[$cls] = $row['userclass_name'];
				$modList[$cls] = $row['userclass_editclass'];
			}
		}
		asort($cList);
		
		while (list($cls, $name)=each($cList)) {
			$stat[$cls]['name'] = $name;
			if ($cls == e_UC_ADMIN) {
				$stat[$cls]['active'] = $isAdmin;
				$stat[$cls]['disabled'] = true;
			} else {
				$stat[$cls]['active'] = (in_array($cls,$uList) ? true : false);
				$stat[$cls]['disabled'] = (check_class($modList[$cls]) ? false : true);
			}
			
			if ($user_primary !== false && $user_primary == $cls) {
				$stat[$cls]['primary'] = true;
			} else {
				$stat[$cls]['primary'] = false;
			}
		}
		
		return $stat;
	}
	
	function updateUser($classList, $primary = false, $user_id = USERID) {
		global $sql, $MBL_PREF, $gstyle_obj, $pref;
		
		if (isset($classList) && !is_array($classList)) return LAN_MBL_EU08;
		
		if (!$sql->db_Select("user", "user_name, user_class", "user_id = $user_id")) return LAN_MBL_EU08;
		$user = $sql->db_Fetch();
		
		/*
		 * Update classlist
		 */
		$checkList = explode(",", $MBL_PREF['groups']);
		$usrClass = explode(",", $user['user_class']);
		
		//Remove all classes handled by memberlist
		while (list($key, $class_id) = each($checkList)) {
			$key = array_search($class_id, $usrClass);
			if ($key !== FALSE) {
				unset($usrClass[$key]);
			}
		}
		//Add checked classes
		while (list($key, $class_id) = each($classList)) {
			$key = array_search($class_id, $usrClass);
			if ($key === FALSE && in_array($class_id, $checkList)) {
				$usrClass[] = $class_id;
			}
		}
		// make a new array
		$usrClass = array_values($usrClass);
		// sort it
		sort($usrClass);
		
		//Update user's classes
		$newCls = implode(",", $usrClass);
		if (substr($newCls, 0, 1) == ",") {
			$newCls = substr($newCls, 1);
		}
		if ($sql->db_Update("user", "user_class = '$newCls' WHERE user_id = $user_id") === false) {
			return LAN_MBL_EU08;
		}
		
		$result = true;
		
		/*
		 * Check Primary class
		 */
		//find link with groupstyle plugin
		if ($pref['plug_installed']['groupstyle'] && $primary !== false) {
			if (!$classList) $primary = false;
			if ($primary !== false && $primary != e_UC_ADMIN && !in_array($primary, $usrClass)) {
				return LAN_MBL_EU07;
			}
			
			if (!is_object($gstyle_obj)) {
				require_once(e_PLUGIN . 'groupstyle/includes/groupstyle_class.php');
				$gstyle_obj = new groupstyle();
			}
			if (!$gstyle_obj->setPrimary($primary, $user_id)) $result = LAN_MBL_EU08;
		}
		return $result;
	}
	
}
?>