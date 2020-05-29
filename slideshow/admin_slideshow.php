<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	Slideshow plugin
|	© nlstart
+---------------------------------------------------------------+
*/
$eplug_admin = true; // Loosely based on admin/download.php
require_once('../../class2.php');
if (!isset($pref['plug_installed']['slideshow']) || !getperms("P")) 
{
	header('location:'.e_BASE.'index.php');
	exit;
}

require_once(e_HANDLER.'calendar/calendar_class.php');
$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	return $cal->load_files();
}

$e_sub_cat = 'slideshow';

require_once(e_HANDLER.'form_handler.php');
require_once(e_HANDLER.'userclass_class.php');
require_once(e_HANDLER.'file_class.php');
include_lan(e_PLUGIN.'slideshow/languages/'.e_LANGUAGE.'.php');

$fl = new e_file;

// -------- Presets. ------------
require_once(e_HANDLER.'preset_class.php');
$pst = new e_preset;
$pst->form = array('myform','dlform'); // form id of the form that will have it"s values saved.
$pst->page = array('download.php?create','download.php?cat'); // display preset options on which page(s).
$pst->id = array('admin_slideshow','admin_config');
// -------------------------------

$slideshow = new slideshow;
require_once(e_ADMIN.'auth.php');

$rs = new form;
$action = '';
$sub_action = '';
$id = 0;
$delete = '';
if (e_QUERY)
{
	$tmp = explode('.', e_QUERY);
	$action = $tmp[0];
	$sub_action = varset($tmp[1],'');
	$id = intval(varset($tmp[2],''));
	$from = varset($tmp[3], 0);
	unset($tmp);
}

if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	unset($_POST['searchquery']);
}

$from = intval(varset($from, 0));
$amount = 50;


if($file_array = $fl->get_files(e_DOWNLOAD, "","standard",5))
{
		sort($file_array);
}

if($public_array = $fl->get_files(e_FILE."public/"))
{
	foreach($public_array as $key=>$val)
	{
    	$file_array[] = str_replace(e_FILE."public/","",$val);
	}
}

if ($sql->db_Select("rbinary"))
{
	while ($row = $sql->db_Fetch())
	{
		extract($row);
		$file_array[] = "Binary ".$binary_id."/".$binary_name;
	}
}

if($image_array = $fl->get_files(e_IMAGE."slideshowimages/", ".gif|.jpg|.png|.GIF|.JPG|.PNG","standard",2))
{
	sort($image_array);
}
if($thumb_array = $fl->get_files(e_IMAGE."slideshowthumbs/", ".gif|.jpg|.png|.GIF|.JPG|.PNG","standard",2))
{
	sort($thumb_array);
}

if(isset($_POST))
{
	$e107cache->clear("download_cat");
}

if (isset($_POST['add_category']))
{
	$slideshow->create_category($sub_action, $id);
}

if (isset($_POST['submit_slideshow']))
{
	$slideshow->submit_slideshow($sub_action, $id);
	$action = "main";
	unset($sub_action, $id);
}

if ($action == "create")
{
	$slideshow->create_slideshow($sub_action, $id);
}

if ($delete == 'main')
{
	$result = admin_update($sql->db_Delete("slideshow", "slideshow_id='$del_id' "), 'delete', SLIDESHOW_27." #".$del_id." ".SLIDESHOW_36);
	if($result)
	{
		admin_purge_related("download", $del_id);
		$e_event->trigger("dldelete", $del_id);
	}
	unset($sub_action, $id);
}

if (isset($message))
{
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

if (!e_QUERY || $action == "main")
{
	$slideshow->show_existing_items($action, $sub_action, $id, $from, $amount);
}

require_once(e_ADMIN.'footer.php');
exit;

class slideshow
{
	function show_existing_items($action, $sub_action, $id, $from, $amount)
	{
		global $sql, $rs, $ns, $tp, $mySQLdefaultdb, $pref;
		$text = "<div style='text-align:center'><div style='padding : 1px; ".ADMIN_WIDTH."; margin-left: auto; margin-right: auto;'>";
        $sortorder = ($pref['slideshow_order']) ? $pref['slideshow_order'] : "slideshow_datestamp";
		$sortdirection = ($pref['slideshow_sort']) ? strtolower($pref['slideshow_sort']) : "desc";
		if ($sortdirection != 'desc') $sortdirection = 'asc';
		if(isset($_POST['searchdisp']))
		{
			$pref['admin_slideshow_disp'] = implode("|",$_POST['searchdisp']);
			save_prefs();
		}

		if(!$pref['admin_slideshow_disp'])
		{
			$search_display = array("slideshow_name","slideshow_visible");
		}
		else
		{
            $search_display = explode("|",$pref['admin_slideshow_disp']);
		}

        $query = "SELECT d.* FROM `#slideshow` AS d";
		if (isset($_POST['searchquery']) && $_POST['searchquery'] != "")
		{
			$query .= " WHERE  slideshow_url REGEXP('".$_POST['searchquery']."') OR slideshow_author REGEXP('".$_POST['searchquery']."') OR slideshow_description  REGEXP('".$_POST['searchquery']."') ";
			foreach($search_display as $disp)
			{
		  		$query .= " OR $disp REGEXP('".$_POST['searchquery']."') ";
			}
			$query .= " ORDER BY {$sortorder} {$sortdirection}";
		}
		else
		{
		  $query .= " ORDER BY ".($sub_action ? $sub_action : $sortorder)." ".($id ? $id : $sortdirection)."  LIMIT $from, $amount";
		}

      	if ($dl_count = $sql->db_Select_gen($query))
		{		
		  $text .= $rs->form_open("post", e_SELF."?".e_QUERY, "myform")."
				<table class='fborder' style='width:99%'>
				<tr>
				<td style='width:5%' class='fcaption'>ID</td>
				";

			// Search Display Column header.----------
			foreach($search_display as $disp)
			{
				if($disp == "slideshow_name")
				{  // Toggle direction
					$text .= "<td class='fcaption'><a href='".e_SELF."?main.slideshow_name.".($id == "desc" ? "asc" : "desc").".$from'>".SLIDESHOW_27."</a></td>";
				}
				else
				{
					$repl = array("slideshow_","_");
					$text .= "<td class='fcaption'><a href='".e_SELF."?main.{$disp}.".($id == "desc" ? "asc" : "desc").".$from'>".ucwords(str_replace($repl," ",$disp))."</a></td>";
				}
			}

		  $text .="<td style='width:10%' class='fcaption'>".LAN_OPTIONS."</td></tr>";

		  while ($row = $sql->db_Fetch())
		  {
				$text .= "<tr><td style='width:5%;vertical-align:top' class='forumheader3'>".$row['slideshow_id']."</td>";

				// Display Chosen options
				foreach($search_display as $disp)
				{
					$text .= "<td class='forumheader3' style='vertical-align:top'>";
			  switch ($disp)
			  {
			    case "slideshow_name" :
        		  $text .= $row['slideshow_name'];
				  break;
				case "slideshow_datestamp" :
				  $text .= ($row[$disp]) ? strftime($pref['shortdate'],$row[$disp])."&nbsp;" : "&nbsp";
				  break;
				case "slideshow_class" :
				case "slideshow_visible" :
				  $text .= r_userclass_name($row[$disp])."&nbsp;";
				  break;
				case "slideshow_thumb" :
				  $text .= ($row[$disp]) ? "<img src='".e_FILE."downloadthumbs/".$row[$disp]."' alt='' />" : "";
				  break;
				case "slideshow_image" :
				  $text .= "<a rel='external' href='".e_FILE."downloadimages/".$row[$disp]."' >".$row[$disp]."</a>&nbsp;";
				  break;
				case "slideshow_description" :
				  $text .= $tp->toHTML($row[$disp],TRUE)."&nbsp;";
				  break;
				case "slideshow_active" :
				  if($row[$disp]== 1)
				  {
				    $text .= "<img src='".ADMIN_TRUE_ICON_PATH."' title='".SLIDESHOW_123."' alt='' style='cursor:help' />\n";
				  }
				  else
				  {
				    $text .= "<img src='".ADMIN_FALSE_ICON_PATH."' title='".SLIDESHOW_122."' alt='' style='cursor:help' />\n";
				  }
				  break;
				default :
				  $text .= $row[$disp]."&nbsp;";
			  }
			  $text .= "</td>";
			}

			$text .= "
					<td style='width:20%;vertical-align:top; text-align:center' class='forumheader3'>
					<a href='".e_SELF."?create.edit.".$row['slideshow_id']."'>".ADMIN_EDIT_ICON."</a>
					<input type='image' title='".LAN_DELETE."' name='delete[main_".$row['slideshow_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(SLIDESHOW_33." [ID: ".$row['slideshow_id']." ]")."') \" />
					</td>
					</tr>";
		  }
		  $text .= "</table></form>";
		}
		else
		{	// 'No slideshows yet'
		  $text .= "<div style='text-align:center'>".SLIDESHOW_6."</div>";
		}
		$text .= "</div>";

		// Next-Previous
		$downloads = $sql->db_Count("slideshow");
		if ($downloads > $amount && !$_POST['searchquery'])
		{
		  $parms = "{$downloads},{$amount},{$from},".e_SELF."?".(e_QUERY ? "$action.$sub_action.$id." : "main.{$sortorder}.{$sortdirection}.")."[FROM]";
			$text .= "<br />".$tp->parseTemplate("{NEXTPREV={$parms}}");
		}

		// Search  & display options etc.
		$text .= "<br /><form method='post' action='".e_SELF."'>\n<p>\n<input class='tbox' type='text' name='searchquery' size='20' value='' maxlength='50' />\n<input class='button' type='submit' name='searchsubmit' value='".SLIDESHOW_51."' />\n</p>";

		$text .= "<div style='cursor:pointer' onclick=\"expandit('sdisp')\">".LAN_DISPLAYOPT."</div>";
		$text .= "<div id='sdisp' style='padding-top:4px;display:none;text-align:center;margin-left:auto;margin-right:auto'>
		<table class='forumheader3' style='width:95%'>";

		$fields = mysql_list_fields($mySQLdefaultdb, MPREFIX."slideshow");
		$columns = mysql_num_fields($fields);			// Bug in PHP5.3 using mysql_num_fields() with mysql_list_fields()
		for ($i = 0; $i < $columns; $i++) {
			$fname[] = mysql_field_name($fields, $i);
		}

		$fname = $sql->db_FieldList('slideshow', '', FALSE);

        $m = 0;
		$replacechar = array("download_","_");
		
		foreach($fname as $fcol)
		{
			if($m == 0)
			{
				$text .= "<tr>\n";	
			}
	        $checked = (in_array($fcol,$search_display)) ? "checked='checked'" : "";
			
			$text .= "<td style='text-align:left; padding:0px'>";
			$text .= "<input type='checkbox' name='searchdisp[]' value='".$fcol."' $checked />".str_replace($replacechar," ",$fcol) . "</td>\n";
			$m++;
				
		  	if($m == 5)
		  	{
				$text .= "</tr>";
				$m = 0;
			}
		}
		
		if($m != 0)
		{
			$text .= "</tr>";
		}

		$text .= "</table></div>
		</form>\n
		</div>";
		$ns->tablerender(SLIDESHOW_7, $text);
	}

	function create_slideshow($sub_action, $id)
	{
		global $cal,$tp, $sql, $fl, $rs, $ns, $file_array, $image_array, $thumb_array,$pst;
		require_once(e_FILE."shortcode/batch/download_shortcodes.php");

		$mirrorArray = array();

		$slideshow_status[0] = SLIDESHOW_122;
		$slideshow_status[1] = SLIDESHOW_123;
		$preset = $pst->read_preset("admin_slideshow");  // read preset values into array
		extract($preset);
		$slideshow_datestamp = time();					// This isn't preset

		$slideshow_active = 1;
		if ($sub_action == "edit" && !$_POST['submit'])
		{
			if ($sql->db_Select("slideshow", "*", "slideshow_id=".$id))
			{
				$row = $sql->db_Fetch();
				extract($row);
			}
		}
		$text = "
<div style='text-align:center'>
	<form method='post' action='".e_SELF."?".e_QUERY."' id='myform'>
		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td style='width:20%; vertical-align:top' class='forumheader3'><span style='text-decoration:underline'>".SLIDESHOW_12."</span>:</td>
				<td style='width:80%' class='forumheader3'>
					<input class='tbox' type='text' name='slideshow_name' size='60' value=\"".$tp->toForm($slideshow_name)."\" maxlength='200' />
				</td>
			</tr>

			<tr>
				<td style='width:20%; vertical-align:top' class='forumheader3'><span style='text-decoration:underline;cursor:help' title='".SLIDESHOW_127."' >".SLIDESHOW_13."</span>:</td>
				<td style='width:80%' class='forumheader3'>
					<input class='tbox' type='text' name='slideshow_url' size='70' value='{$slideshow_url}' maxlength='150' />
				</td>
			</tr>

			<tr>
				<td style='width:20%' class='forumheader3'><span style='text-decoration:underline'>".SLIDESHOW_18."</span>: </td>
				<td style='width:80%' class='forumheader3'>
					<textarea class='tbox' name='slideshow_description' cols='50' rows='5' style='width:90%'>$slideshow_description</textarea>
				</td>
			</tr>

			<tr>
				<td style='width:20%' class='forumheader3'>".SLIDESHOW_19.":</td>
				<td style='width:80%' class='forumheader3'>
					<select name='slideshow_image' class='tbox'>
						<option value=''>&nbsp;</option>";

			foreach($image_array as $img)
			{
				$fpath = str_replace(e_FILE."downloadimages/","",$img['path'].$img['fname']);
            	$sel = ($slideshow_image == $fpath) ? " selected='selected'" : "";
            	$text .= "<option value='".$fpath."' $sel>".$fpath."</option>\n";
			}

		$text .= "	</select>
				</td>
			</tr>

			<tr>
				<td style='width:20%' class='forumheader3'>".SLIDESHOW_20.":</td>
				<td style='width:80%' class='forumheader3'>
					<select name='slideshow_thumb' class='tbox'>
						<option value=''>&nbsp;</option>";

			foreach($thumb_array as $thm){
				$tpath = str_replace(e_FILE."downloadthumbs/","",$thm['path'].$thm['fname']);
            	$sel = ($slideshow_thumb == $tpath) ? " selected='selected'" : "";
            	$text .= "<option value='".$tpath."' $sel>".$tpath."</option>\n";
			}

		$text .= "	</select>
				</td>
			</tr>

			<tr>
				<td style='width:20%' class='forumheader3'>".LAN_DATESTAMP.":</td>
				<td style='width:80%' class='forumheader3'>";
        if(!$slideshow_datestamp)
		{
        	$slideshow_datestamp = time();
	   	}
		$cal_options['showsTime'] = false;
		$cal_options['showOthers'] = false;
		$cal_options['weekNumbers'] = false;
		$cal_options['ifFormat'] = "%d/%m/%Y %H:%M:%S";
		$cal_options['timeFormat'] = "24";
		$cal_attrib['class'] = "tbox";
		$cal_attrib['size'] = "12";
		$cal_attrib['name'] = "slideshow_datestamp";
		$cal_attrib['value'] = date("d/m/Y H:i:s", $slideshow_datestamp);
		$text .= $cal->make_input_field($cal_options, $cal_attrib);

		$update_checked = ($_POST['update_datestamp']) ? "checked='checked'" : "";
		$text .= "&nbsp;&nbsp;<span><input type='checkbox' value='1' name='update_datestamp' $update_checked />".SLIDESHOW_148."</span>
				</td>
			</tr>

			<tr>
				<td style='width:20%' class='forumheader3'>".SLIDESHOW_21.":</td>
				<td style='width:80%' class='forumheader3'>
					<select name='slideshow_active' class='tbox'>";

			foreach($slideshow_status as $key => $val){
				$sel = ($slideshow_active == $key) ? " selected = 'selected' " : "";
            	$text .= "<option value='{$key}' {$sel}>{$val}</option>\n";
			}
			$text .= "</select>";

		$text .= "
				</td>
			</tr>

			<tr>
				<td style='width:20%' class='forumheader3'>".SLIDESHOW_145.":</td>
				<td style='width:80%' class='forumheader3'>".r_userclass('slideshow_visible', $slideshow_visible, 'off', 'public, nobody, member, admin, main, classes, language')."</td>
			</tr>

			<tr style='vertical-align:top'>
				<td colspan='2' style='text-align:center' class='forumheader'>";

		if ($id && $sub_action == "edit") 
		{
			$text .= "<input class='button' type='submit' name='submit_slideshow' value='".SLIDESHOW_24."' /> ";
		} 
		else 
		{
			$text .= "<input class='button' type='submit' name='submit_slideshow' value='".SLIDESHOW_25."' />";
		}

		$text .= "<input type='hidden' name='e-token' value='".e_TOKEN."' />";
		$text .= "</td>
			</tr>
		</table>
	</form>
</div>";
		$ns->tablerender(SLIDESHOW_29, $text);
	}
// -----------------------------------------------------------------------------

	function show_message($message) 
	{
		global $ns;
		$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
	}

// -----------------------------------------------------------------------------

	function calc_filesize($size, $unit)
	{
		switch($unit)
		{
			case 'B' :
				return $size;
				break;
			case 'KB' :
				return $size * 1024;
				break;
			case 'MB' :
				return $size * 1024 * 1024;
				break;
			case 'GB' :
				return $size * 1024 * 1024 * 1024;
				break;
			case 'TB' :
				return $size * 1024 * 1024 * 1024 * 1024;
				break;
		}
	}

	function submit_slideshow($sub_action, $id)
	{
		global $tp, $sql, $DOWNLOADS_DIRECTORY, $e_event;
		if($sub_action == 'edit')
		{
			if($_POST['slideshow_url_external'] == '')
			{
				$_POST['slideshow_filesize_external'] = FALSE;
			}
		}
		if ($_POST['slideshow_url_external'] && $_POST['slideshow_url'] == '')
		{
			$durl = $_POST['slideshow_url_external'];
			$filesize = $this->calc_filesize($_POST['slideshow_filesize_external'], $_POST['slideshow_filesize_unit']);
		}
		else
		{
			$durl = $_POST['slideshow_url'];
			if($_POST['slideshow_filesize_external'])
			{
				$filesize = $this->calc_filesize($_POST['slideshow_filesize_external'], $_POST['slideshow_filesize_unit']);
			}
			else
			{
				if (strpos($DOWNLOADS_DIRECTORY, "/") === 0 || strpos($DOWNLOADS_DIRECTORY, ":") >= 1)
				{
					$filesize = filesize($DOWNLOADS_DIRECTORY.$durl);
				}
				else
				{
					$filesize = filesize(e_BASE.$DOWNLOADS_DIRECTORY.$durl);
				}
			}
		}
		if (!$filesize)
		{
			if($sql->db_Select("upload", "upload_filesize", "upload_file='$durl'"))
			{
				$row = $sql->db_Fetch();
				$filesize = $row['upload_filesize'];
			}
		}

		//  ----   Move Images and Files ------------
		if($_POST['move_image'])
		{
			if($_POST['slideshow_thumb'])
			{
				$oldname = e_FILE."public/".$_POST['slideshow_thumb'];
				$newname = e_FILE."downloadthumbs/".$_POST['slideshow_thumb'];
				if(!$this -> move_file($oldname,$newname))
				{
            		return;
				}
			}
			if($_POST['slideshow_image'])
			{
				$oldname = e_FILE."public/".$_POST['slideshow_image'];
				$newname = e_FILE."downloadimages/".$_POST['slideshow_image'];
				if(!$this -> move_file($oldname,$newname))
				{
            		return;
				}
			}
		}

        if($_POST['move_file'] && $_POST['slideshow_url'])
		{
        	$oldname = e_FILE."public/".$_POST['slideshow_url'];
			$newname = $_POST['move_file'].$_POST['slideshow_url'];
			if(!$this -> move_file($oldname,$newname))
			{
            	return;
			}
            $durl = str_replace(e_DOWNLOAD,"",$newname);
		}
        // ------------------------------------------

		$_POST['slideshow_description'] = $tp->toDB($_POST['slideshow_description']);
		$_POST['slideshow_name'] = $tp->toDB($_POST['slideshow_name']);
		$_POST['slideshow_author'] = $tp->toDB($_POST['slideshow_author']);

		if (preg_match("#(.*?)/(.*?)/(.*?) (.*?):(.*?):(.*?)$#", $_POST['slideshow_datestamp'], $matches))
		{
			$_POST['slideshow_datestamp'] = mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[1], $matches[3]);
		}
		else
		{
           $_POST['slideshow_datestamp'] = time();
		}

		if($_POST['update_datestamp'])
		{
			$_POST['slideshow_datestamp'] = time();
		}

		$mirrorStr = "";
		$mirrorFlag = FALSE;

		// See if any mirrors defined
		// Need to check all the possible mirror names - might have deleted the first one if we're in edit mode
		foreach ($_POST['slideshow_mirror_name'] as $mn)
		{
			if ($mn)
			{
				$mirrorFlag = TRUE;
				break;
			}
		}
		if($mirrorFlag)
		{
			$mirrors = count($_POST['slideshow_mirror_name']);
			$mirrorArray = array();
			$newMirrorArray = array();
			if ($id && $sql->db_Select('slideshow','slideshow_mirror', 'slideshow_id = '.$id))		// Get existing download stats
			{
				if ($row = $sql->db_Fetch())
				{
					$mirrorArray = $this->makeMirrorArray($row['slideshow_mirror'], TRUE);
				}
			}
			for($a=0; $a<$mirrors; $a++)
			{
				$mid = trim($_POST['slideshow_mirror_name'][$a]);
				$murl = trim($_POST['slideshow_mirror'][$a]);
				if ($mid && $murl)
				{
					$newMirrorArray[$mid] = array('id' => $mid, 'url' => $murl, 'requests' => 0);
					if (DOWNLOAD_DEBUG && !$id)
					{
						$newMirrorArray[$mid]['requests'] = intval($_POST['slideshow_mirror_requests'][$a]);
					}
				}
			}
			// Now copy across any existing usage figures
			foreach ($newMirrorArray as $k => $m)
			{
				if (isset($mirrorArray[$k]))
				{
					$newMirrorArray[$k]['requests'] = $mirrorArray[$k]['requests'];
				}
			}
			$mirrorStr = $this->compressMirrorArray($newMirrorArray);
		}

		if ($id)
		{	// Its an edit
			//admin_update($sql->db_Update("slideshow", "slideshow_name='".$_POST['slideshow_name']."', slideshow_url='".$durl."', slideshow_author='".$_POST['slideshow_author']."', slideshow_author_email='".$_POST['slideshow_author_email']."', slideshow_author_website='".$_POST['slideshow_author_website']."', slideshow_description='".$_POST['slideshow_description']."', slideshow_filesize='".$filesize."', slideshow_category='".intval($_POST['slideshow_category'])."', slideshow_active='".intval($_POST['slideshow_active'])."', slideshow_datestamp='".intval($_POST['slideshow_datestamp'])."', slideshow_thumb='".$_POST['slideshow_thumb']."', slideshow_image='".$_POST['slideshow_image']."', slideshow_comment='".intval($_POST['slideshow_comment'])."', slideshow_class = '{$_POST['slideshow_class']}', slideshow_mirror='$mirrorStr', slideshow_mirror_type='".intval($_POST['slideshow_mirror_type'])."' , slideshow_visible='".$_POST['slideshow_visible']."' WHERE slideshow_id=".intval($id)), 'update', SLIDESHOW_2." (<a href='".e_BASE."download.php?view.".$id."'>".$_POST['slideshow_name']."</a>)");
			admin_update($sql->db_Update("slideshow", "slideshow_name='".$_POST['slideshow_name']."', slideshow_url='".$durl."', slideshow_description='".$_POST['slideshow_description']."', slideshow_active='".intval($_POST['slideshow_active'])."', slideshow_datestamp='".intval($_POST['slideshow_datestamp'])."', slideshow_thumb='".$_POST['slideshow_thumb']."', slideshow_image='".$_POST['slideshow_image']."', slideshow_visible='".intval($_POST['slideshow_visible'])."' WHERE slideshow_id=".intval($id)), 'update', SLIDESHOW_2." (#".$id." ".$_POST['slideshow_name'].")");
            $dlinfo = array("slideshow_id" => $slideshow_id, "slideshow_name" => $_POST['slideshow_name'], "slideshow_url" => $durl, "slideshow_author" => $_POST['slideshow_author'], "slideshow_author_email" => $_POST['slideshow_author_email'], "slideshow_author_website" => $_POST['slideshow_author_website'], "slideshow_description" => $_POST['slideshow_description'], "slideshow_filesize" => $filesize, "slideshow_category" => $_POST['slideshow_category'], "slideshow_active" => $_POST['slideshow_active'], "slideshow_datestamp" => $time, "slideshow_thumb" => $_POST['slideshow_thumb'], "slideshow_image" => $_POST['slideshow_image'], "slideshow_comment" => $_POST['slideshow_comment'] );
			$e_event->trigger("dlupdate", $dlinfo);
		}
		else
		{
			//if (admin_update($slideshow_id = $sql->db_Insert("slideshow", "0, '".$_POST['slideshow_name']."', '".$durl."', '".$_POST['slideshow_author']."', '".$_POST['slideshow_author_email']."', '".$_POST['slideshow_author_website']."', '".$_POST['slideshow_description']."', '".$filesize."', '0', '".intval($_POST['slideshow_category'])."', '".intval($_POST['slideshow_active'])."', '".intval($_POST['slideshow_datestamp'])."', '".$_POST['slideshow_thumb']."', '".$_POST['slideshow_image']."', '".intval($_POST['slideshow_comment'])."', '{$_POST['slideshow_class']}', '$mirrorStr', '".intval($_POST['slideshow_mirror_type'])."', '".$_POST['slideshow_visible']."' "), 'insert', SLIDESHOW_1." (<a href='".e_BASE."download.php?view.".$slideshow_id."'>".$_POST['slideshow_name']."</a>)"))
			if (admin_update($slideshow_id = $sql->db_Insert("slideshow", "0, '".$_POST['slideshow_name']."', '".$durl."', '".$_POST['slideshow_description']."', '".intval($_POST['slideshow_active'])."', '".intval($_POST['slideshow_datestamp'])."', '".$_POST['slideshow_thumb']."', '".$_POST['slideshow_image']."', '".intval($_POST['slideshow_visible'])."' "), 'insert', SLIDESHOW_1." (#".$slideshow_id." ".$_POST['slideshow_name'].")"))
			{
				$dlinfo = array("slideshow_id" => $slideshow_id, "slideshow_name" => $_POST['slideshow_name'], "slideshow_url" => $durl, "slideshow_author" => $_POST['slideshow_author'], "slideshow_author_email" => $_POST['slideshow_author_email'], "slideshow_author_website" => $_POST['slideshow_author_website'], "slideshow_description" => $_POST['slideshow_description'], "slideshow_filesize" => $filesize, "slideshow_category" => $_POST['slideshow_category'], "slideshow_active" => $_POST['slideshow_active'], "slideshow_datestamp" => $time, "slideshow_thumb" => $_POST['slideshow_thumb'], "slideshow_image" => $_POST['slideshow_image'], "slideshow_comment" => $_POST['slideshow_comment'] );
				$e_event->trigger("dlpost", $dlinfo);

				if ($_POST['remove_upload'])
				{
					$sql->db_Update("upload", "upload_active='1' WHERE upload_id='".$_POST['remove_id']."'");
					$mes = "<br />".$_POST['slideshow_name']." ".SLIDESHOW_104;
					$mes .= "<br /><br /><a href='".e_ADMIN."upload.php'>".SLIDESHOW_105."</a>";
					$this->show_message($mes);
				}
			}
		}
	}
} // end class
?>