<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
// Heavily modified version of filemanager.php

// Experimental e-token
if(!empty($_POST) && !isset($_POST['e-token']))
{
	// set e-token so it can be processed by class2
	$_POST['e-token'] = '';
}

// Ensure this program is loaded in admin theme before calling class2
$eplug_admin = true;

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once('../../class2.php');

// Check to see if the current user has admin permissions for this plugin
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

$e_sub_cat = 'filemanage';

// Include auth.php rather than header.php ensures an admin user is logged in
require_once(e_ADMIN.'auth.php');

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');
// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_02';

$pubfolder = (str_replace("../","",e_QUERY) == str_replace("../","",e_FILE."public/")) ? TRUE : FALSE;

$imagedir = e_IMAGE."filemanager/";
$message = '';

$dir_options[0] = EG_CORE_00;
$dir_options[1] = EG_UPLOAD_47;
$adchoice[0] 	= e_PLUGIN.'easygallery/'.$pref['easygallery_settings']['fulls'];
$adchoice[1] 	= e_PLUGIN.'easygallery/upload/';

$path = str_replace("../", "", e_QUERY);
if (!$path) {
	$path = str_replace("../", "", $adchoice[0]);
}

//$ok = (e_QUERY == '' || '../'.substr(e_QUERY, 0, strlen(e_FILE)-3) == e_FILE || '../'.substr(e_QUERY, 0, strlen(e_IMAGE)-3) == e_IMAGE);
$ok = (e_QUERY == '' || '../../'.substr(e_QUERY, 0, strlen($adchoice[0])-6) == $adchoice[0] || '../../'.e_QUERY == $adchoice[1]);

if($path == "/" || !$ok)
{
	$path = $adchoice[0];
	//echo "<b>Debug</b> ".$path." <br />";
	//echo "<b>Debug</b> ../../".e_QUERY." <br />";
	//echo "<b>Debug</b> ".strlen($adchoice[0])." <br />";
	//echo "<b>Debug</b> ../../".substr(e_QUERY, 0, strlen($adchoice[0])-6)." <br />";
	//echo "<b>Debug</b> ../../".substr(e_QUERY, 0, 28)." <br />";
	//echo "<b>Debug</b> ".$adchoice[0]." <br />";
}

if($_POST['add_dir'] && strlen($_POST['directory']) > 0)
{
	$org_path = $_POST['pathd'];
	$_POST['pathd'] = str_replace(str_replace("../", "", e_PLUGIN."easygallery/"), "", $_POST['pathd']);
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
	{	// Server is using Windows!
		if(mkdir($_POST['pathd'].$_POST['directory'])) // PHP on windows times out when mode ", 0755" is specified
		{
			$out_text = EG_UPLOAD_53.": ".SITEURL.$org_path.$_POST['directory'];
		}
		else
		{
			$out_text = EG_UPLOAD_54.": ".SITEURL.$org_path.$_POST['directory'];
		}
	}
	else 
	{	// Server not using Windows!
		if(mkdir($_POST['pathd'].$_POST['directory'], 0755))
		{
			$out_text = EG_UPLOAD_53.": ".SITEURL.$org_path.$_POST['directory'];
		}
		else
		{
			$out_text = EG_UPLOAD_54.": ".SITEURL.$org_path.$_POST['directory'];
		}
	}
	$ns -> tablerender("", "<div style=\"text-align:center;\"><b>".$out_text."</b></div>");
}

if (isset($_POST['deleteconfirm'])) 
{
  foreach($_POST['deleteconfirm'] as $key=>$delfile)
  {
	// check for delete.
	if (isset($_POST['selectedfile'][$key]) && isset($_POST['deletefiles'])) {
		if (!$_POST['ac'] == md5(ADMINPWCHANGE)) {
			exit;
		}
		$destination_file = e_BASE.$delfile;
		//if (@unlink($destination_file)) {
		if (recursiveDelete($destination_file)) {
			$message .= EG_UPLOAD_26." '".$destination_file."' ".EG_UPLOAD_27.".<br />";
		} else {
			$message .= EG_UPLOAD_28." '".$destination_file."'.<br />";
		}		
	}

	// check for move to downloads or downloadimages.
	if (isset($_POST['selectedfile'][$key]) && (isset($_POST['movetogallery'])) ){
	$newfile = str_replace($path,"",$delfile);

	// Move file to whatever folder.
		if (isset($_POST['movetogallery']))
		{
			$newpath = $_POST['movepath'];

			if (rename(e_BASE.$delfile,$newpath.$newfile))
			{
				$message .= EG_UPLOAD_38." ".$newpath.$newfile."<br />";
			} 
			else 
			{
				$message .= EG_UPLOAD_39." ".$newpath.$newfile."<br />";
				$message .= (!is_writable($newpath)) ? $newpath.LAN_NOTWRITABLE : "";
			}
		}
	}
  }
}

if (isset($_POST['upload'])) 
{
	if (!$_POST['ac'] == md5(ADMINPWCHANGE)) 
	{
		exit;
	}
	$pref['upload_storagetype'] = "1";
	require_once(e_HANDLER.'upload_handler.php');
	$files = $_FILES['file_userfile'];
	$spacer = '';
	foreach($files['name'] as $key => $name) 
	{
		if ($name)
		{
			if ($files['error'][$key])
			{
				$message .= $spacer.EG_UPLOAD_10.' '.$files['error'][$key].': '.$name;
			}
			elseif ($files['size'][$key]) 
			{
				$uploaded = file_upload(e_BASE.$_POST['upload_dir'][$key]);
				if (($uploaded === FALSE) || !is_array($uploaded))
				{
					$message .= $spacer.EG_UPLOAD_56.'&nbsp;'.$name;
					$spacer = '<br />';
				}
				else
				{
					foreach ($uploaded as $k => $inf)
					{
						if ($inf['error'] != 0)
						{	// Most likely errors trapped earlier.
							$message .= $spacer.EG_UPLOAD_10.'&nbsp;'.$inf['error'].' ('.$inf['message'].'): '.$inf['rawname'];
						}
						$spacer = '<br />';
					}
				}
			}
		}
	}
}


if ($message)
{
	$ns->tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}

if (strpos(e_QUERY, ".") && !is_dir(realpath(e_BASE.$path))){
	echo "<iframe style=\"width:100%\" src=\"".e_BASE.e_QUERY."\" height=\"300\" scrolling=\"yes\"></iframe><br /><br />";
	if (!strpos(e_QUERY, "/")) {
		$path = "";
	} else {
		$path = substr($path, 0, strrpos(substr($path, 0, -1), "/"))."/";
	}
}

$files = array();
$dirs = array();
$path = explode("?", $path);
$path = $path[0];
$path = explode(".. ", $path);
$path = $path[0];

if ($handle = opendir(e_BASE.$path)) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != "..") {

			if (getenv('windir') && is_file(e_BASE.$path."\\".$file)) {
				if (is_file(e_BASE.$path."\\".$file)) {
					$files[] = $file;
				} else {
					$dirs[] = $file;
				}
			} else {
				if (is_file(e_BASE.$path."/".$file)) {
					$files[] = $file;
				} else {
					$dirs[] = $file;
				}
			}
		}
	}
}
// EasyGallery modification; add an upload 'directory'; so we can upload from showing the list of files in the directory
$dirs[] = '..';
closedir($handle);

if (count($files) != 0) {
	sort($files);
}
if (count($dirs) != 0) {
	sort($dirs);
}

if (count($files) == 1) {
	$cstr = EG_UPLOAD_12;
} else {
	$cstr = EG_UPLOAD_13;
}

if (count($dirs) == 1) {
	$dstr = EG_UPLOAD_14;
} else {
	$dstr = EG_UPLOAD_15;
}

$pathd = $path;

$text = "<div style='text-align:center'>\n
	<form method='post' action='".e_SELF."?".e_QUERY."'>\n
	<table style='".ADMIN_WIDTH."' class='fborder'>\n
	<tr>\n\n

	<td style='width:70%' class='forumheader3'>\n
	".EG_UPLOAD_32."
	</td>\n
	<td class='forumheader3' style='text-align:center; width:30%'>\n
	<select name='admin_choice' class='tbox' onchange=\"location.href=this.options[selectedIndex].value\">\n";


	foreach($dir_options as $key=>$opt){
		$select = (str_replace("../","",$adchoice[$key]) == e_QUERY) ? "selected='selected'" : "";
		$text .= "<option value='".e_SELF."?".str_replace("../","",$adchoice[$key])."' $select>".$opt."</option>\n";
	}

$text .= "</select>\n
	</td>\n
	</tr>\n\n

	<tr style='vertical-align:top'>\n
	<td colspan='2'  style='text-align:center' class='forumheader'>\n
	<input class='button' type='submit' name='updateoptions' value='".EG_UPLOAD_33."' />
	<input type='hidden' name='e-token' value='".e_TOKEN."' />\n
	</td>\n
	</tr>\n\n

	</table>\n
	</form>\n
	</div>";
$ns->tablerender(EG_UPLOAD_34, $text);


$text = "<form enctype=\"multipart/form-data\" action=\"".e_SELF.(e_QUERY ? "?".e_QUERY : "")."\" method=\"post\">
	<div style=\"text-align:center\">
	<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\" />
	<input type='hidden' name='e-token' value='".e_TOKEN."' />\n
	<table class='fborder' style=\"".ADMIN_WIDTH."\">";

$text .= "<tr>
	<td style=\"width:5%\" class=\"fcaption\">&nbsp;</td>
	<td style=\"width:30%\" class=\"fcaption\"><b>".EG_UPLOAD_17."</b></td>
	<td class=\"fcaption\"><b>".EG_UPLOAD_18."</b></td>
	<td style=\"width:30%\" class=\"fcaption\"><b>".EG_UPLOAD_19."</b></td>
	<td class=\"fcaption\"><b>".LAN_OPTIONS."</b></td>
	</tr>";

if ($path != e_FILE) {
//if ('../../'.substr(e_QUERY, 0, strlen($adchoice[0])-6) !== $adchoice[0]) {
	if (substr_count($path, "/") == 1 || '../../'.$path == $adchoice[0]) 
	{	// EasyGallery modification to not have updir go above the gallery folder
		$pathup = e_SELF;
	} else {
		$pathup = e_SELF."?".substr($path, 0, strrpos(substr($path, 0, -1), "/"))."/";
	}
	$text .= "<tr><td colspan=\"5\" class=\"forumheader3\"><a href=\"".$pathup."\"><img src=\"".$imagedir."updir.png\" alt=\"".EG_UPLOAD_30."\" style=\"border:0\" /></a> 
		<a href=\"".e_SELF."\"><img src=\"".$imagedir."home.png\" alt=\"".EG_UPLOAD_16."\" style=\"border:0\" /></a>
		</td>
		</tr>";
}

$c = 0;
while ($dirs[$c]) {
	$dirsize = dirsize($path.$dirs[$c]);

	if($dirs[$c] == "..")
	{	// EasyGallery modification: suppress link on root '..'
		$dirs_text = $dirs[$c];
		$dirs_img  = "<img src=\"".$imagedir."folder.png\" alt=\"".$dirs[$c]." ".EG_UPLOAD_31."\" style=\"border:0\" />";
	}
	else
	{
		$dirs_text = "<a href=\"".e_SELF."?".$path.$dirs[$c]."/\">".$dirs[$c]."</a>";
		$dirs_img  = "<a href=\"".e_SELF."?".$path.$dirs[$c]."/\"><img src=\"".$imagedir."folder.png\" alt=\"".$dirs[$c]." ".EG_UPLOAD_31."\" style=\"border:0\" /></a>";
	}

	$text .= "<tr>
		<td class=\"forumheader3\" style=\"vertical-align:middle; text-align:center; width:5%\">
			".$dirs_img."
		</td>
		<td style=\"width:30%\" class=\"forumheader3\">
			".$dirs_text."
		</td>
		<td class=\"forumheader3\">".$dirsize."
		</td>
		<td class=\"forumheader3\">&nbsp;</td>
		<td class=\"forumheader3\">";
	if (FILE_UPLOADS && is_writable(e_BASE.$path.$dirs[$c])) {
		$text .= "<input class=\"button\" type=\"button\" name=\"erquest\" value=\"".EG_UPLOAD_21."\" onclick=\"expandit(this)\" />
			<div style=\"display:none;\">
			<input class=\"tbox\" type=\"file\" name=\"file_userfile[]\" size=\"50\" />
			<input class=\"button\" type=\"submit\" name=\"upload\" value=\"".EG_UPLOAD_22."\" />
			<input type=\"hidden\" name=\"upload_dir[]\" value=\"".str_replace("/..", "", $path.$dirs[$c])."\" />
			<input type='hidden' name='e-token' value='".e_TOKEN."' />
			</div>";
		if ($dirs[$c] != ".." && $dirs[$c]!="thumbs") {
			$text .= "<input  type=\"checkbox\" name=\"selectedfile[$c]\" value=\"1\" />";
			$text .= "<input type=\"hidden\" name=\"deleteconfirm[$c]\" value=\"".$path.$dirs[$c]."\" />";
		}		
	} else {
		$text .= "&nbsp;";
	}
	$text .= "</td>
		</tr>


		";
	$c++;
}
$dir_delete_max = $c;

$c = $e = 0;
while ($files[$c]) 
{
	$img = strtolower(substr(strrchr($files[$c], "."), 1, 3));
	if (!$img || !preg_match("/css|exe|gif|htm|jpg|js|php|png|txt|xml|zip/i", $img)) 
	{
		$img = "def";
	}
	$size = parsesize(filesize(e_BASE.$path."/".$files[$c]));
	$text .= "<tr>
		<td class=\"forumheader3\" style=\"vertical-align:middle; text-align:center; width:5%\">
		<img src=\"".$imagedir.$img.".png\" alt=\"".$files[$c]."\" style=\"border:0\" />
		</td>
		<td style=\"width:30%\" class=\"forumheader3\">
		<a href=\"".e_SELF."?".$path.$files[$c]."\">".$files[$c]."</a>
		</td>";
	$gen = new convert;
	$filedate = $gen -> convert_date(filemtime(e_BASE.$path."/".$files[$c]), "forum");
	$text .= "<td style=\"width:10%\" class=\"forumheader3\">".$size."</td>
		<td style=\"width:30%\" class=\"forumheader3\">".$filedate."</td>
		<td class=\"forumheader3\">";

	// EasyGallery modification: suppress the delete option for index.html and .htaccess and for files without extension
	$extension = strrpos($files[$c], '.') ? substr($files[$c], strrpos($files[$c], '.')) : '';
	if ($files[$c] != 'index.html' && $files[$c] != '.htaccess' && strlen($extension) != 0) {
		$d++;
		$e = $d + $dir_delete_max; // EasyGallery modification: keep count proper for directories and files in same root folder
		$text .= "<input  type=\"checkbox\" name=\"selectedfile[$e]\" value=\"1\" />";
		$text .="<input type=\"hidden\" name=\"deleteconfirm[$e]\" value=\"".$path.$files[$c]."\" />";
	}
	$text .="</td>
		</tr>";
	$c++;
}

	$text .= "<tr><td colspan='5' class='forumheader' style='text-align:right'>";

	//if ($pubfolder || e_QUERY == ""){
        require_once(e_HANDLER."file_class.php");
		$fl = new e_file;
		//$dl_dirlist = $fl->get_dirs(e_DOWNLOAD);
		$dl_dirlist = $fl->get_dirs(e_PLUGIN.'easygallery/'.$pref['easygallery_settings']['fulls']);
		$movechoice = array();
        //$movechoice[] = e_DOWNLOAD;
		$movechoice[] = e_PLUGIN.'easygallery/'.$pref['easygallery_settings']['fulls'];
		//foreach($dl_dirlist as $dirs){
        //	$movechoice[] = e_DOWNLOAD.$dirs."/";
		//}
		foreach($dl_dirlist as $dirs)
		{
			if ($dirs <> 'thumbs')
			{
				$movechoice[] = e_PLUGIN.'easygallery/'.$pref['easygallery_settings']['fulls'].$dirs.'/';
			}
		}
		sort($movechoice);
		
		/*
		$movechoice[] = e_FILE."downloadimages/";
		if(e_QUERY != str_replace("../","",e_FILE."public/")){
        	$movechoice[] = e_FILE."public/";
		}
		if(e_QUERY != str_replace("../","",e_FILE."downloadthumbs/")){
        	$movechoice[] = e_FILE."downloadthumbs/";
		}
		if(e_QUERY != str_replace("../","",e_FILE."misc/")){
        	$movechoice[] = e_FILE."misc/";
		}
		if(e_QUERY != str_replace("../","",e_IMAGE)){
        	$movechoice[] = e_IMAGE;
		}
		if(e_QUERY != str_replace("../","",e_IMAGE."newspost_images/")){
        	$movechoice[] = e_IMAGE."newspost_images/";
		}
		*/
		
        $text .= EG_UPLOAD_48."&nbsp;<select class='tbox' name='movepath'>\n";
        foreach($movechoice as $paths){
        	$text .= "<option value='$paths'>".str_replace("../","",$paths)."</option>\n";
		}
		$text .= "</select>&nbsp;";
		$text .="<input class=\"button\" type=\"submit\" name=\"movetogallery\" value=\"".EG_UPLOAD_50."\" onclick=\"return jsconfirm('".$tp->toJS(EG_UPLOAD_49)."') \" />
		<input type='hidden' name='e-token' value='".e_TOKEN."' />";
	//}

	$text .= "<input class=\"button\" type=\"submit\" name=\"deletefiles\" value=\"".EG_UPLOAD_43."\" onclick=\"return jsconfirm('".$tp->toJS(EG_UPLOAD_46)."') \" />
		</td></tr></table>
		<input type='hidden' name='ac' value='".md5(ADMINPWCHANGE)."' />
		</div>
		</form>";
	if('../../'.substr(e_QUERY, 0, strlen($adchoice[0])-6) == $adchoice[0] || e_QUERY == '')
	{ 	// Only show Add gallery directory button when showing Gallery (or subfolders of Gallery)
		$text .= add_dir();
	}
		
$ns->tablerender(EG_UPLOAD_29.": <b>root/".$pathd."</b>&nbsp;&nbsp;[ ".count($dirs)." ".$dstr.", ".count($files)." ".$cstr." ]", $text);
require_once(e_ADMIN.'footer.php');

function add_dir()
{
	global $pathd;
	$add_text = "
	<br />
	<div onclick=\"expandit('add_dir')\"><input class='button' type='submit' value='".EG_UPLOAD_51."' /></div>
	<div id='add_dir' style='padding-top:4px;display:none;text-align:center;margin-left:auto;margin-right:auto'>";
	$add_text .=  "
		<form id='add_dir' method='post' action='".e_SELF."' enctype='multipart/form-data'>
			<table border='0' width='90%' cellspacing='0' cellpadding='0' align='center'>
				<tr>
					<td>
						".EG_UPLOAD_52.": <input class='tbox' size='25' type='text' name='directory' value='' />
					</td>
				</tr>
				<tr>
					<td align='center'>
						<input type='hidden' name ='pathd' value='".$pathd."' />
						<input type='hidden' name='e-token' value='".e_TOKEN."' />
						<input class='button' type='submit' name='add_dir' value='".EG_UPLOAD_51."' />
					</td>
				</tr>
			</table>
		</form>
	</div>";
	return $add_text;
}

function dirsize($dir) {
	$_SERVER["DOCUMENT_ROOT"].e_HTTP.$dir;
	$dh = @opendir($_SERVER["DOCUMENT_ROOT"].e_HTTP.$dir);
	$size = 0;
	while ($file = @readdir($dh)) {
		if ($file != "." and $file != "..") {
			$path = $dir."/".$file;
			if (is_file($_SERVER["DOCUMENT_ROOT"].e_HTTP.$path)) {
				$size += filesize($_SERVER["DOCUMENT_ROOT"].e_HTTP.$path);
			} else {
				$size += dirsize($path."/");
			}
		}
	}
	@closedir($dh);
	return parsesize($size);
}

function parsesize($size) {
	$kb = 1024;
	$mb = 1024 * $kb;
	$gb = 1024 * $mb;
	$tb = 1024 * $gb;
	if ($size < $kb) {
		return $size." b";
	}
	else if($size < $mb) {
		return round($size/$kb, 2)." kb";
	}
	else if($size < $gb) {
		return round($size/$mb, 2)." mb";
	}
	else if($size < $tb) {
		return round($size/$gb, 2)." gb";
	} else {
		return round($size/$tb, 2)." tb";
	}
}

/**
 * Delete a file or recursively delete a directory
 * @param string $str Path to file or directory
 */
function recursiveDelete($str){
	if(is_file($str)){
		return @unlink($str);
	}
	elseif(is_dir($str)){
		$scan = glob(rtrim($str,'/').'/*');
		foreach($scan as $index=>$path){
			recursiveDelete($path);
		}
		return @rmdir($str);
	}
}
?>