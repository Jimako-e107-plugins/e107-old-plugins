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


?>