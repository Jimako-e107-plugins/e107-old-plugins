<?php

if (!defined('e107_INIT')) { exit; }

//Bullet
if(defined("BULLET"))
{
	$bullet = "<img src='".THEME_ABS."images/".BULLET."' alt='' class='icon' />";
	$bullet_src = THEME_ABS."images/".BULLET;
}
elseif(file_exists(THEME."images/bullet2.gif"))
{
	$bullet = "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' class='icon' />";
	$bullet_src = THEME_ABS."images/bullet2.gif";
}
else
{
	$bullet = "";
	$bullet_src = "";
}

// ##### CHAT TABLE -----------------------------------------------------------------------------
if(!$CHAT_TABLE_START){
		$CHAT_TABLE_START = "
		<br /><table style='width:100%'><tr><td>";
}
if(!$CHAT_TABLE){
		$CHAT_TABLE = "\n
		<div class='spacer'>
			<div class='{CHAT_TABLE_FLAG}'>
				".$bullet."\n<b>{CHAT_TABLE_NICK}</b> ".CB2_L22." {CHAT_TABLE_DATESTAMP}<br />
				<div class='defaulttext'><i>{CHAT_TABLE_MESSAGE}</i></div>\n
			</div>
		</div>\n";

}
if(!$CHAT_TABLE_END){
		$CHAT_TABLE_END = "
		</td></tr></table>";
}
// ##### ------------------------------------------------------------------------------------------
 
       //{GOLDBREAK} and br removed
if(!$CHATPAGESTYLE){
	// default chatpage style
	$CHATPAGESTYLE = "
		<table style='width:97%;border:solid;border-width:0px'>
			<tr>
				<td style='width:25%;border:solid;border-width:1px;padding:1px;vertical-align:top;text-indent:1px;'>
						{BULLET} <b>{USERNAME}</b>
						
						{CPCONTROL}
	";
	if($pref['cp2_show_date'] == 1){
		$CHATPAGESTYLE .= "
					 
						<span class='smallblacktext'>
						{TIMEDATE}
						</span>
		";
	}
	$CHATPAGESTYLE .= "
				</td>
				<td style='width:75%;border:solid;border-width:1px;padding:1px;vertical-align:top;text-indent:1px;'>
					{MESSAGE}
				</td>
			</tr>
		</table>
		";
}


// OLD STYLE
//				// ###########################
//				// CHATPAGE FORMATTING
//				// ###########################
//				global $CHATPAGESTYLE;
//				if(!$CHATPAGESTYLE){
//					// default chatpage style
//					$CHATPAGESTYLE = "
//						<div class='spacer'>
//						{BULLET} <b>{USERNAME}</b>
//						{GOLDBREAK}
//						{CPCONTROL}
//					";
//					if($pref['cp2_show_date'] == 1){
//						$CHATPAGESTYLE .= "
//						<br />
//						<span class='smallblacktext'>
//						{TIMEDATE}
//						</span>
//						";
//					}
//					$CHATPAGESTYLE .= "
//						<br />
//						<span class='smalltext'>
//						{MESSAGE}
//						</span>
//						</div>
//						<hr>
//					";
//				}

?>