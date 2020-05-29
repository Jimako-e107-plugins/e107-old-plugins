<?php
	if (!$sql->db_Select("plugin", "*", "plugin_path='userjournals_menu' AND plugin_installflag='1'")) {
	   // Plugin not installed
		return;
	}

   global $pref;

	$LIST_CAPTION        = $arr[0];
	$LIST_DISPLAYSTYLE   = ($arr[2] ? "" : "none");

	$bullet = $this->getBullet($arr[6], $mode);

	if ($mode == "new_page" || $mode == "new_menu" ) {
	   $qry = "and userjournals_timestamp > ".$this->getlvisit();
	} else {
      $qry = "";
   }

   $qry = "select * from ".MPREFIX."userjournals
           where userjournals_is_blog_desc=0
             and userjournals_is_published=0
             $qry
	        order by userjournals_timestamp desc limit 0,".$arr[7]."
   ";

   if (file_exists(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php")){
      include_once(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php");
   } else {
      include_once(e_PLUGIN."userjournals_menu/languages/English.php");
   }

	if (!$sql->db_Select_gen($qry)) {
		$LIST_DATA = UJ44;
	} else {
		while ($row = $sql->db_Fetch()) {
			$rowheading	         = $this->parse_heading($row['userjournals_subject'], $mode);
			$ICON		            = $bullet;
			$HEADING	            = "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blog.".$row['userjournals_id']."' title='".$row['userjournals_subject']."'>".$rowheading."</a>";
			$user                = get_user_data($row['userjournals_userid']);
			$AUTHOR	            = "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blogger.".$row['userjournals_userid'].".".$row["userjournals_username"]."' title='".$row['userjournals_username']."'>".$user["user_name"]."</a>";
			$CATEGORY	         = "";
			$DATE		            = ($arr[5] ? ($row['userjournals_timestamp'] > 0 ? $this->getListDate($row['userjournals_timestamp'], $mode) : "") : "");
			$INFO		            = ""; //$row['description'];
			$LIST_DATA[$mode][]  = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
		}
	}
?>