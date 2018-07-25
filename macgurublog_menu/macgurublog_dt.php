<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/



class macgurublog_class {
	var $conv;
	var $weekdayn = array(MACGURUBLOG_MENU_34, MACGURUBLOG_MENU_35, MACGURUBLOG_MENU_36, MACGURUBLOG_MENU_37, MACGURUBLOG_MENU_38, MACGURUBLOG_MENU_39, MACGURUBLOG_MENU_40);
	var $monthn = array('',MACGURUBLOG_MENU_41, MACGURUBLOG_MENU_42, MACGURUBLOG_MENU_43, MACGURUBLOG_MENU_44, MACGURUBLOG_MENU_45, MACGURUBLOG_MENU_46, MACGURUBLOG_MENU_47, MACGURUBLOG_MENU_48, MACGURUBLOG_MENU_49, MACGURUBLOG_MENU_50, MACGURUBLOG_MENU_51, MACGURUBLOG_MENU_52);
	
	function macgurublog_class() {
		require_once(e_HANDLER."date_handler.php");
		$this->conv = new convert();
	}

	function dt($mode, $sendtime) {
		return $this->conv->convert_date($sendtime, ($mode = 1 ? 'long' : 'short'));
	}
	
	
	function own($id , $type=false) {
		//$type		true if comment
		//$id		id in the table
		global $sql;
		if ($type == true) {
			$sql -> db_Select("macgurublog_com", "blogcom_rid", "blogcom_id=".$id);
			$row = $sql -> db_Fetch();
			$id = $row['blogcom_rid'];
		}
		$sql -> db_Select("macgurublog_rec", "blogrec_uid", "blogrec_id=".$id);
		$row = $sql -> db_Fetch();
		$id = $row['blogrec_uid'];
		return(USERID == $id);
	}
	
	function gety($ts) {
		//in ts
		//out string
		$t = getdate($ts);
		return sprintf('%04d', $t['year']);
	}
	function getm($ts, $isstr=false) {
		//in ts, boolean
		//out string
		$t = getdate($ts);
		if (!$isstr) {
			return sprintf('%02d', $t['mon']);
		} else {
			return $this -> monthn[$t['mon']];
		}
	}
	function toym($ts) {
		//in ts
		//out ym
	 	$t = getdate($ts);
		return sprintf('%04d', $t['year']).sprintf('%02d', $t['mon']);
	}
	function tots($ym) {
		//in ym
		//out ts
		return strtotime(substr($ym, 0, 4).'-'.substr($ym, 4, 2).'-01');
	}
	function isdif($a, $b) {
		//in ts, ts
		//out boolean
		$a = getdate($a);
		$b = getdate($b);
		$ret = false;
		if ($a['mon'] != $b['mon'] || $a['year'] != $b['year']) {
			$ret = true;
		}
		return $ret;
	}
	function nextm($ym) {
		//in ym
		//out ts
		if (substr($ym, 4, 2) == '12') {
			$tb = strtotime((substr($ym, 0, 4)+1).'-01-01');
		} else {
			$tb = strtotime(substr($ym, 0, 4).'-'.(substr($ym, 4, 2)+1).'-01');
		}
		return $tb;
	}
	function istham($ym, $sqlcat="") {
		//in ym
		//out boolean
		global $sql;
		$ta = $this -> tots($ym);
		$tb = $this -> nextm($ym);
		$c = $sql -> db_Count('macgurublog_rec', '(*)', "where blogrec_date>=${ta} and blogrec_date<${tb}".$sqlcat);
		return ($c > 0);
	}
}


$mgb = new macgurublog_class();
?>