<?php
/* ------------------------------- //

- What: Data Logging for Twobyfour!
-- NOTICE: this file may be rewritten multiple times to help with performance issues (if they happen)!

// ------------------------------- */

// first, if the visitor is a user and isn't "viewing" index.php, we start the logging process
if(USER && substr(strrchr($_SERVER['PHP_SELF'], "/"), 1) != "index.php"){

	// next, we delete all the entries that are greater than 24 hours old
	// this helps keep the database table from growing extremely large with unused entries
	$sincewhen = (time() - 86400);

	if($sql->db_Count("what_twobyfour", "(*)", "WHERE `visit_time` < ".$sincewhen) > 0){
		$sql->db_Select("what_twobyfour", "*") or die(mysql_error());
		while($row = $sql->db_Fetch()){
			if($row['visit_time'] < $sincewhen){
				$sql->db_Delete("what_twobyfour", "id='".intval($row['id'])."'");
			}
		}
	}

	// before we begin, let's clean up the page output name
	// we want to remove the beginning slash (/) as well as convert all forum pages to forum.php
	$page_name = str_replace(SITEURLBASE.e_HTTP, "", e_SELF);
	$page_name = str_replace(array("_viewforum", "_viewtopic"), array("", ""), $page_name);

	// gather the amount of times the user has visited this page
	if($sql->db_Count("what_twobyfour", "(*)") > 0){
		$sql->db_Select("what_twobyfour", "*", "page_name='".$tp->toDB($page_name)."' AND user_id='".intval(USERID)."'");
		while($row2 = $sql->db_Fetch()){
			$count = $row2['count'];
		}
	}else{
		$count = 0;
	}

	// now, let's determine if the user is viewing the page for the first time or not
	if($count > 0){
		// if they have we need to update the information count and visit_time
		$sql->db_Update("what_twobyfour", "visit_time='".time()."', count='".intval(($count+1))."' WHERE page_name='".$tp->toDB($page_name)."' AND user_id='".intval(USERID)."'");
	}else{
		// otherwise, we need to make a new entry
		$sql->db_Insert("what_twobyfour", "NULL, '".intval(USERID)."', '".$tp->toDB(USERNAME)."', '".$tp->toDB($page_name)."', '".time()."', '1'") or die(mysql_error());
	}
}

?>