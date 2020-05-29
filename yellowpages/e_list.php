<?php
	if (!$links_install = $sql->db_Select("plugin", "*", "plugin_path = 'links_page' AND plugin_installflag = '1' ")) {
	   // Plugin not installed
		return;
	}

	$LIST_CAPTION        = $arr[0];
	$LIST_DISPLAYSTYLE   = ($arr[2] ? "" : "none");

	if ($mode == "new_page" || $mode == "new_menu" ) {
		$lvisit = $this->getlvisit();
		$qry = " link_datestamp>".$lvisit." AND ";
	} else {
		$qry = "";
	}

	$bullet = $this->getBullet($arr[6], $mode);

   $qry = "select * from ".MPREFIX."eplayer as e
            left join ".MPREFIX."eplayer_category as c on e.category = c.cat_id
	         order by e.id desc limit 0,".$arr[7]."
	";

	if (!$sql->db_Select_gen($qry)) {
		$LIST_DATA = "no links yet";
	} else {
		while ($row = $sql->db_Fetch()) {
			$rowheading	= $this->parse_heading($row['title'], $mode);
			$ICON		   = $bullet;
			$HEADING	   = "<a href='".e_PLUGIN."eplayer/eplayer?view.".$row['id']."' title='".$row['title']."'>".$rowheading."</a>";
			$AUTHOR		= $row['author'];
			$CATEGORY	= "<a href='".e_PLUGIN."eplayer/eplayer?cat.".$row['cat_id'].".0.".$GLOBALS['pref']['eplayer_clips_per_page']."' title='".$row['title']."'>".$row['cat_name']."</a>";;
			$DATE		   = ($arr[5] ? ($row['link_datestamp'] > 0 ? $this->getListDate($row['link_datestamp'], $mode) : "") : "");
			$INFO		   = ""; //$row['description'];
			$LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);

		}
	}
?>