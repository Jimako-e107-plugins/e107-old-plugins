<?php

if (!defined('e107_INIT')) { exit; }

	if(!$chatbox2_install = $sql -> db_Select("plugin", "*", "plugin_path = 'chatbox2_menu' AND plugin_installflag = '1' ")){
		return;
	}

	$LIST_CAPTION = $arr[0];
	$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

	if($mode == "new_page" || $mode == "new_menu" ){
		$lvisit = $this -> getlvisit();
		$qry = "cb2_datestamp>".$lvisit;
	}else{
		$qry = "cb2_id != '0' ";
	}
	$qry .= " ORDER BY cb2_datestamp DESC LIMIT 0,".intval($arr[7]);

	$bullet = $this -> getBullet($arr[6], $mode);

	if(!$chatbox2_posts = $sql -> db_Select("chatbox2", "*", $qry)){
		$LIST_DATA = LIST_CHATBOX_2;
	}else{
		while($row = $sql -> db_Fetch()) {

			$cb2_id		= substr($row['cb2_nick'] , 0, strpos($row['cb2_nick'] , "."));
			$cb2_nick	= substr($row['cb2_nick'] , (strpos($row['cb2_nick'] , ".")+1));
			$cb2_message	= ($row['cb2_blocked'] ? CB2_L6 : str_replace("<br />", " ", $tp -> toHTML($row['cb2_message'])));

			$search[0] = "/\&lt;\s?font(.*?)&gt;/si";
			$replace[0] = "";
			$search[1] = "/\&lt;\/\s?font&gt;/si";
			$replace[1] = "";
			$cb2_message = preg_replace($search, $replace, $cb2_message);

			$rowheading	= $this -> parse_heading($cb2_message, $mode);
			$ICON		= $bullet;
			$HEADING	= $rowheading;
			$AUTHOR		= ($arr[3] ? ($cb2_id != 0 ? "<a href='".e_BASE."user.php?id.$cb2_id'>".$cb2_nick."</a>" : $cb2_nick) : "");
			$CATEGORY	= "";
			$DATE		= ($arr[5] ? ($row['cb2_datestamp'] ? $this -> getListDate($row['cb2_datestamp'], $mode) : "") : "");
			$INFO		= "";
			$LIST_DATA[$mode][] = array( $ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO );
		}
	}

?>