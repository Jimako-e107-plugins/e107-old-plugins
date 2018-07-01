<?php
/**
 * $Id: rankdef_class.php,v 1.4 2009/07/14 19:29:13 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.4 $
 * Last Modified: $Date: 2009/07/14 19:29:13 $
 *
 * Change Log:
 * $Log: rankdef_class.php,v $
 * Revision 1.4  2009/07/14 19:29:13  michiel
 * CVS Merge
 *
 * Revision 1.3.2.1  2009/07/12 12:39:39  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.1  2009/07/12 11:56:20  michiel
 * BugFix: Made some changes for PHP4
 *
 * Revision 1.3  2009/06/28 15:06:13  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/27 16:58:31  michiel
 * Added image selector
 *
 * Revision 1.2  2009/06/26 09:23:33  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/19 13:47:23  michiel
 * Made XHTML compliant
 *
 * Revision 1.1  2009/03/28 13:01:48  michiel
 * Initial CVS revision
 *
 *  
 */
class rankdef {

	function show_message($message) {
		global $ns;
		$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
	}

	function getClasses() {
		global $sql;
		$sql->db_Select("userclass_classes");
		$c = 0;
		while ($row = $sql->db_Fetch()) {
			if (getperms("0") || check_class($row['userclass_editclass'])) {
				$class[$c][0] = $row['userclass_id'];
				$class[$c][1] = $row['userclass_name'];
				$class[$c][2] = $row['userclass_description'];
				$c++;
			}
		}

		return $class;
	}

	function show_categories($sub_action, $id) {
		global $sql, $rs, $ns, $tp, $eArrayStorage;

		if ($sub_action == "edit") {
			if ($sql->db_Select("rank_category", "*", "category_id='$id' ")) {
				$row = $sql->db_Fetch();
				extract($row);
			}
		}

		$text = "<div style='text-align:center'>
		".$rs->form_open("post", e_SELF."?cat", "dataform")."
		<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_DEF5."</span></td>
		<td class='forumheader3' style='width:70%'>".$rs->form_text("category_name", 30, $category_name, 200)."</td>
		</tr>
		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_DEF6."</span></td>
		<td class='forumheader3' style='width:70%'>
		".$rs->form_text("category_age", 2, $category_age, 50)."</td>
		</tr>
		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_DEF30."</span></td>
		<td class='forumheader3' style='width:70%'>
		";
	
		$class = $this->getClasses();
		for($a = 0; $a <= (count($class)-1); $a++) {
		if (check_class($class[$a][0], $row['category_class'])) {
			$text .= "<input type='checkbox' name='category_class[]' value='".$class[$a][0]."' checked='checked' />".$class[$a][1]." ";
		} else {
			$text .= "<input type='checkbox' name='category_class[]' value='".$class[$a][0]."' />".$class[$a][1]." ";
		}
			$text .= " - ".$class[$a][2]."<br />";
		}
				
		$text .= "</td>
		</tr>

		<tr><td colspan='2' style='text-align:center' class='forumheader'>";
		if ($id) {
			$text .= "<input class='button' type='submit' name='update_category' value='".ADLAN_RS_DEF7."' />
			".$rs->form_button("submit", "category_clear", ADLAN_RS_DEF9). $rs->form_hidden("category_id", $id)."
			</td></tr>";
			} else {
			$text .= "<input class='button' type='submit' name='create_category' value='".ADLAN_RS_DEF8."' /></td></tr>";
		}
		$text .= "</table>
		".$rs->form_close()."
		</div>";

		$ns->tablerender(ADLAN_RS_DEF8, $text);

		unset($category_name, $category_age, $class);
		
		if ($sql->db_Select("userclass_classes")) {
			while ($row = $sql->db_Fetch())
			{
				$class[$row['userclass_id']] = $tp->toHTML($row['userclass_name'],"","defs,emotes_off, no_make_clickable");
			}
		}

		$sql->db_Select("rank_category", "count(*) count");
		$row = $sql->db_Fetch();
		$count = intval($row['count']);
		
		$text = "<div style='text-align: center'>";
		if ($category_total = $sql->db_Select("rank_category", "*", "1=1 order by category_id")) {
			$text .= "
			<form action='".e_SELF."?cat' id='dataform' method='post'>
			<table class='fborder' style='".ADMIN_WIDTH."'>
			<tr>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_DEF10."</td>
			<td style='width:45%' class='fcaption'>".ADLAN_RS_DEF11."</td>
			<td style='width:25%' class='fcaption'>".ADLAN_RS_DEF30."</td>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_DEF12."</td>
			<td style='width:20%; text-align:center' class='fcaption'>&nbsp;</td>
			</tr>";
			while ($row = $sql->db_Fetch()) {
				extract($row);

				$cclass = "";
				$tmp = explode(",", $category_class);
				while (list($key, $class_id) = each($tmp))
				{
					$cclass .= ($class[$class_id] ? $class[$class_id]."<br />\n" : "");
				}
				
				$text .= "<tr>
				<td style='width:5%; text-align:center' class='forumheader3'>$category_id</td>
				<td style='width:45%' class='forumheader3'>$category_name</td>
				<td style='width:25%' class='forumheader3'>$cclass</td>
				<td style='width:5%; text-align:center' class='forumheader3'>$category_age</td>
				<td style='width:20%; text-align:center' class='forumheader3'>
				<a href='".e_SELF."?cat.edit.$category_id'>".ADMIN_EDIT_ICON."</a>
				<input type='image' title='".LAN_DELETE."' name='delete[category_$category_id]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(ADLAN_RS_DEF13." [$category_name]")."') \"/>
				</td>
				</tr>\n";
			}
			$text .= "</table></form>";
			} else {
			$text .= "<div style='text-align:center'><div style='vertical-align:middle'>".ADLAN_RS_DEF14."</div>";
		}
		$text .= "</div>";
		$ns->tablerender(ADLAN_RS_DEF15, $text);
	}
	
	function active_ranks() {
		global $sql;
		$sql->db_Select("rank_ranks", "count(*) count");
		$counter = $sql->db_Fetch();
		return 0+$counter['count'];
	}
	
	function insert_rank($order) {
		global $sql;
		$query = "update #rank_ranks set rank_order=rank_order+1 where rank_order >= ".$order." order by rank_order desc";
		$sql->db_Select_gen($query,false);
	}
	
	function remove_rank($order) {
		global $sql;
		$query = "update #rank_ranks set rank_order=rank_order-1 where rank_order > ".$order." order by rank_order";
		$sql->db_Select_gen($query,false);
	}

	function show_ranks($sub_action, $id) {
		global $sql, $rs, $ns, $tp;

		if ($sub_action == "edit") {
			if ($sql->db_Select("rank_ranks", "*", "rank_id='$id' ")) {
				$row = $sql->db_Fetch();
				extract($row);
			}
		}

		$text = "<div style='text-align:center'>
		<form method='post' action='".e_SELF."?rank' id='dataform'>
		<table style='".ADMIN_WIDTH."' class='fborder'>

		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_DEF29."</span></td>
		<td class='forumheader3' colspan='2' style='width:70%'>";
		
		$count = $this->active_ranks();
		if (!$id) {
			$count++;
			$rank_order = $count;
		}

		$text .= "\t<select name='rank_order' class='tbox'>\n";
		for ($lus = 1; $lus <= $count; $lus++) {
			$sel = ($lus == $rank_order ? "selected='selected'" : "");
			$text .= "<option value='$lus' $sel>$lus</option>\n";
		}
		$text .= "</select>
		<input type='hidden' name='old_order' value='$rank_order' />
		</td></tr>
		
		<tr>
		<td class='forumheader3' style='width:30%'><span class='defaulttext'>".ADLAN_RS_DEF16."</span></td>
		<td class='forumheader3' colspan='2' style='width:70%'>
		<input class='tbox' type='text' name='rank_name' size='55' value='$rank_name' maxlength='50'/>
		</td></tr>
		
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_DEF17.": </td>
		<td style='width:80%' colspan='2' class='forumheader3'>";

		if (!$sql->db_Select("rank_category"))
		{
			$text .= ADLAN_RS_DEF14;
		}
		else
		{
			$text .= "\t<select name='rank_category' class='tbox'>\n";

			while (list($category_id, $category_name) = $sql->db_Fetch())
			{
				$sel = ($rank_category == $category_id) ? "selected='selected'" : "";
				$text .= "<option value='$category_id' $sel>".$tp->toHTML($category_name,FALSE,"defs")."</option>\n";
			}
			$text .= "</select>";
		}
		$text .= "</td>
		</tr>";
		
		$text .= $this->imageSelectRow(ADLAN_RS_DEF18, "rank_img", $rank_img);
		 
		/*
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_DEF18.":</td>
		<td style='width:80%' class='forumheader3'>
		<input class='tbox' type='text' name='rank_img' size='55' value='$rank_img' maxlength='50'/>";
		if ($rank_img != "") {
			$text .= "&nbsp;&nbsp;<img src='" .e_PLUGIN. "rank_system/images/ranks/" . $rank_img . "' border='0' alt='' height='50'/>";
		}
		
		
		$text .= "
		</td>
		</tr>
		*/

		$text .= "
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_DEF19.":</td>
		<td style='width:80%' colspan='2' class='forumheader3'>
		<input class='tbox' type='text' name='rank_points' size='5' value='$rank_points' maxlength='4' />
		</td>
		</tr> 

		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_DEF31.":</td>
		<td style='width:80%' colspan='2' class='forumheader3'>
		<input class='tbox' type='text' name='rank_wage' size='6' value='$rank_wage' maxlength='5' />
		</td>
		</tr> 
		
		<tr>
		<td style='width:20%' class='forumheader3'>".ADLAN_RS_DEF22.":</td>
		<td style='width:80%' colspan='2' class='forumheader3'>
		<input type='checkbox' name='rank_reserved' ".($rank_reserved == 'T' ? " checked='checked'" : "")." />
		</td>
		</tr> 
		
		<tr><td colspan='3' style='text-align:center' class='forumheader'>";
		if ($id) {
			$text .= "<input class='button' type='submit' name='update_rank' value='".ADLAN_RS_DEF20."' />
			<input class='button' type='submit' name='rank_clear' value='".ADLAN_RS_DEF9."' />
			<input type='hidden' name='rank_id' value=". $id. "/>
			</td></tr>";
			} else {
			$text .= "<input class='button' type='submit' name='create_rank' value='".ADLAN_RS_DEF21."' /></td></tr>";
		}
		$text .= "</table></form></div>";

		$ns->tablerender(ADLAN_RS_DEF21, $text);

		unset($rank_id, $rank_category, $rank_name, $rank_img, $rank_points, $rank_reserved);

		$text = "<div style='text-align: center'>";
		
		$query = "select r.*, c.category_name from #rank_ranks r, #rank_category c where c.category_id = r.rank_category order by rank_order";
        if ($sql->db_Select_gen($query, false)) {
			$text .= "
			<form action='".e_SELF."?rank' id='dataform' method='post'>
			<table class='fborder' style='".ADMIN_WIDTH."'>
			<tr>
			<td style='width:5%' class='fcaption'>".ADLAN_RS_DEF29."</td>
			<td style='width:15%' class='fcaption'>".ADLAN_RS_DEF11."</td>
			<td style='width:20%' class='fcaption'>".ADLAN_RS_DEF16."</td>
			<td style='width:20%' class='fcaption'>".ADLAN_RS_DEF18."</td>
			<td style='width:10%' class='fcaption'>".ADLAN_RS_DEF19."</td>
			<td style='width:10%' class='fcaption'>".ADLAN_RS_DEF31."</td>
			<td style='width:10%' class='fcaption'>".ADLAN_RS_DEF22."</td>
			<td style='width:10%; text-align:center' class='fcaption'>&nbsp;</td>
			</tr>";
			while ($row = $sql->db_Fetch()) {
				extract($row);
				
				if ($rank_reserved == 'T') {
					$rank_reserved = ADLAN_RS_DEF26;
				} else {
					$rank_reserved = ADLAN_RS_DEF27;
				}

				$text .= "<tr>
				<td style='width:5%; text-align:center' class='forumheader3'>$rank_order</td>
				<td style='width:15%' class='forumheader3'>$category_name</td>
				<td style='width:20%' class='forumheader3'>$rank_name</td>
				<td style='width:20%' class='forumheader3'>$rank_img</td>
				<td style='width:10%' class='forumheader3'>$rank_points</td>
				<td style='width:10%' class='forumheader3'>$rank_wage</td>
				<td style='width:10%; text-align:center' class='forumheader3'>$rank_reserved</td>
				<td style='width:10%; text-align:center' class='forumheader3'>
				<a href='".e_SELF."?rank.edit.$rank_id'>".ADMIN_EDIT_ICON."</a>
				<input type='image' title='".LAN_DELETE."' name='delete[rank_$rank_id]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(ADLAN_RS_DEF23." [$rank_name]")."') \"/>
				</td>
				</tr>\n";
			}
			$text .= "</table></form>";
			} else {
			$text .= "<div style='text-align:center'><div style='vertical-align:middle'>".ADLAN_RS_DEF24."</div>";
		}
		$text .= "</div>";
		$ns->tablerender(ADLAN_RS_DEF25, $text);
	}
	
	function isImage($name) {
		if (strlen($name) < 5) return false;
		
		$ext = substr(strtoupper($name), strlen($name)-3);
		return ($ext == 'JPG' || $ext == 'GIF' || $ext == 'PNG');
	}
	
	function imageSelectRow($label, $form_name, $form_value) {
		
		$handle = opendir(e_PLUGIN."rank_system/images/ranks");
		while ($file = readdir($handle)) {
			if ($this->isImage($file)) {
				$imagelist[] = $file;
			}
		}
		closedir($handle);
		sort($imagelist);
		
		$itext = "
			<tr>
				<td style='width:20%' rowspan='2' class='forumheader3'>$label:</td>
				<td style='width:30%' class='forumheader3'>
					<input class='tbox' type='text' name='$form_name' id='$form_name.ID' size='40' value='$form_value' maxlength='50' />
				</td>
				<td style='width:50%; text-align:center' class='forumheader3' id='$form_name.curr'>
		";
				
		if ($form_value != "") {
			$itext .= "<img src='" .e_PLUGIN. "rank_system/images/ranks/" . $form_value . "' border='0' alt='$form_value' title='$form_value' />";
		} else {
			$itext .= "&nbsp;";
		}
		
		$itext .= "
			</td></tr>
			<tr><td style='width:80%' colspan='2' class='forumheader3'>
		";
				
		$itext .= "
			<input class='button' type ='button' style='cursor:pointer' size='30' value='".ADLAN_RS_MDF49."' onclick='expandit(this)' />
			<div id='$form_name.lst' style='display:none;' >";
				
		while (list($key, $image) = each($imagelist)) {
			$itext .= " 
				<a href=\"javascript:insertext('$image','$form_name.ID','$form_name.lst')\">
				<img src='".e_PLUGIN."rank_system/images/ranks/$image' style='border:0;' alt='$image' title='$image' 
					onclick=\"document.getElementById('$form_name.curr').innerHTML='<img src=\'" .e_PLUGIN. "rank_system/images/ranks/$image\' border=\'0\' alt=\'$image\' title=\'$image\' />'\" />
				</a>
			";
		}

		reset($imagelist);

		$itext .= "
			</div></td>
			</tr>
		";
		
		return $itext;
		
	}
	
	
}


?>