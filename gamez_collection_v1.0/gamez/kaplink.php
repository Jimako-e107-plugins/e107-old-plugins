<?php

require_once("../../class2.php");
require_once(HEADERF);
$text .='<center>
			<object classid="clsid:166B1BCA-3F9C-11CF-8075-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=7,0,2,0" width="550" height="413">
			<param name="src" value="http://downloads2.kewlbox.com/games_online/kaplink.dcr">
			<embed src="http://downloads2.kewlbox.com/games_online/kaplink.dcr" pluginspage="http://www.macromedia.com/shockwave/download/" width="550" height="413"></embed></object>
			<br>
			Add this game to your website, <a href="http://www.kewlbox.com/games/code.cfm">click here.</a><br>
			If nothing appears please install the player.<br>
			This game requires the Macromedia Shockwave Player.<br>
<a href="http://sdc.shockwave.com/shockwave/download/download.cgi?" target="_blank"><img src="http://www.macromedia.com/images/shared/download_buttons/get_shock_player.gif" width="88" height="31" alt="Shockwave" border="0"></a>
<br><br>
<br>Like this game? Download the full version.<br>
<a href="http://downloads2.kewlbox.com/games_pc/kaplink.exe">PC Version</a> | <a href="http://downloads2.kewlbox.com/games_mac/kaplink.dmg">Mac Version</a><br>
</center>';
$ns -> tablerender("Kaplink", $text);
require_once(FOOTERF);
?>