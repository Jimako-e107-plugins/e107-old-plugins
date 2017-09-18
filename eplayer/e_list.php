<?php
	if (!$sql->db_Select("plugin", "*", "plugin_path = 'links_page' AND plugin_installflag = '1' ")) {
	   // Plugin not installed
		return;
	}

   require_once(e_PLUGIN."eplayer/eplayer_variables.php");
   global $pref;

	$LIST_CAPTION        = $arr[0];
	$LIST_DISPLAYSTYLE   = ($arr[2] ? "" : "none");

	if ($mode == "new_page" || $mode == "new_menu" ) {
		$qry = "and e.datestamp>".$this->getlvisit();
	} else {
		$qry = "";
	}

	$bullet = $this->getBullet($arr[6], $mode);

   $qry = "select * from ".MPREFIX."eplayer as e
           left join ".MPREFIX."eplayer_category as c on e.category = c.cat_id
           where e.approved = 0
             $qry
	        order by e.id desc limit 0,".$arr[7]."
   ";

	if (!$sql->db_Select_gen($qry)) {
		$LIST_DATA = "no items";
	} else {
	   global $e107Helper;
		while ($row = $sql->db_Fetch()) {
			$rowheading	         = $this->parse_heading($row['title'], $mode);
			$ICON		            = $bullet;
			$HEADING	            = "<a href='".e_PLUGIN."eplayer/eplayer.php?view.".$row['id']."' title='".$e107Helper->tp_toHTML($row['description'])."'>".htmlentities ($rowheading)."</a>";
			$AUTHOR		         = $row['author'];
			$CATEGORY	         = "<a href='".e_PLUGIN."eplayer/eplayer.php?cat.".$row['cat_id'].".0.".$GLOBALS['pref']['eplayer_clips_per_page']."' title='".$e107Helper->tp_toHTML($row['cat_description'])."'>".htmlentities ($row['cat_name'])."</a>";;
			$DATE		            = ($arr[5] ? ($row['datestamp'] > 0 ? $this->getListDate($row['datestamp'], $mode) : "") : "");
			$INFO		            = ""; //$row['description'];
			$LIST_DATA[$mode][]  = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);

		}
	}
?>