<?php
if (strpos($_SERVER['PHP_SELF'], '/macgurublog_menu/blog_add.php') > 0 || strpos($_SERVER['PHP_SELF'], '/macgurublog_menu/edit.php') > 0) {
	//PreImage Selector for uploaded pictures
	$bb['name'] = 'mgb_preimg'; 
	$bb['onclick'] = 'expandit'; 
	$bb['onclick_var'] = "mgb_preimg"; 
	$bb['icon'] = e_IMAGE."generic/bbcode/preimage.png"; 
	$bb['helptext'] = MACGURUBLOG_MENU_129; 
	$bb['function'] = 'bb_blogimginit';
	
	if (!function_exists('bb_blogimginit')) {
		function bb_blogimginit() {
			global $fl, $tp;
			$formid = "mgb_preimg";
			$path = e_IMAGE."blog/".USERID."/";
			if(!is_object($fl)){
				require_once(e_HANDLER."file_class.php");
				$fl = new e_file;
			}
			$rejecthumb = array('$.','$..','/','CVS','thumbs.db','*._$', 'index', 'null*');
			$imagelist = $fl->get_files($path,"",$rejecthumb,2);
			sort($imagelist);
			$text ="<!-- Start of PreImage selector -->
			<div style='margin-left:0px;margin-right:0px; position:relative;z-index:1000;float:right;display:none' id='{$formid}'>";
			$text .="<div style='position:absolute; bottom:30px; right:100px'>";
			$text .= "<table class='fborder' style='background-color: #fff'>
			<tr><td class='forumheader3' style='white-space: nowrap'>";
			if(!count($imagelist)) {
				$text .= LANHELP_46."<b>".str_replace("../","",$path)."</b>";
			} else {
				$text .= "<select class='tbox' name='preimageselect' onchange=\"addtext(this.value); expandit('{$formid}')\">
				<option value=''>".LANHELP_42."</option>";
				foreach($imagelist as $image) {
					$e_path = $tp->createConstants($image['path'],1);
					$showpath = str_replace($path,"",$image['path']);
					if(strstr($image['fname'], "thumb")) {
						$fi = str_replace("thumb_", "", $image['fname']);
						if(file_exists($path.$fi)) {
							// thumb and main image found
							$text .= "<option value=\"[link=".$e_path.$fi."][img]".$e_path.$image['fname']."[/img][/link]\">".$showpath.$image['fname']." (".LANHELP_38.")</option>\n
							";
						} else {
							$text .= "<option value=\"[img]".$e_path.$image['fname']."[/img]\">".$showpath.$image['fname']."</option>\n
							";
						}
					} else {
						$text .= "<option value=\"[img]".$e_path.$image['fname']."[/img]\">".$showpath.$image['fname']."</option>\n";
					}
				}
				$text .="</select>";
			}
			$text .="</td></tr>	\n </table></div>
			</div>\n<!-- End of PreImage selector -->\n";
			return $text;
		}
	}
	
	$BBCODE_TEMPLATE .= "{BB=mgb_preimg}{BB=youtube}{BB=dailymotion}"; 
	$eplug_bb[] = $bb;
}

// Youtube by Lolo Irie
$bb['name'] = 'youtube'; 
$bb['onclick'] = ''; 
$bb['onclick_var'] = "[center][youtube]URL[/youtube][/center]"; 
$bb['icon'] = e_PLUGIN."macgurublog_menu/images/youtube.png"; 
$bb['helptext'] = "Add a YouTube video";
$eplug_bb[] = $bb;

//Dailimotion by Lolo Irie
$bb['name'] = 'dailymotion'; 
$bb['onclick'] = ''; 
$bb['onclick_var'] = "[center][dailymotion]URL[/dailymotion][/center]"; 
$bb['icon'] = e_PLUGIN."macgurublog_menu/images/dailymotion.png"; 
$bb['helptext'] = "Add a Dailymotion video";
$eplug_bb[] = $bb;
?>