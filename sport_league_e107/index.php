<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2007
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/last_next_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/last_next_menu_lan.php");
require_once(e_PLUGIN."sport_league_e107/functionen.php");

require_once("header.php");
echo "
<tr>
			<td style='background:#b80000 url(images/navbar_bg.png) repeat-x;width:100%;height:100px;color:#ffffff;font-weight:bold;'>
				Neusserev-1b
			</td>
		</tr>
		<tr>
			<td style='background:#101010 url(images/body_bg.png) repeat-x;width:100%;height:750px;text-align:center;vertical-align:top;color:#ffffff;font-weight:bold;padding:20px;'>
<table cellspacing='0' cellpadding='0' width='100%'border='0' style='font-size:100%;'>	
					<tr>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/lastgame.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/lastgame2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/lastgame.png)';this.style.color='#fff';\" >
									<br/><br/><br/>Last Game
								</div>
							</a>
						</td>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='news_mobile.php' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/news.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/news2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/news.png)';this.style.color='#fff';\" >
									<br/><br/><br/>News
								</div>
							</a>
						</td>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='last_and_next-game.php' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/nextgame.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/nextgame2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/nextgame.png)';this.style.color='#fff';\" >
								<br/><br/><br/>Next Game
								</div>
							</a>
						</td>
					</tr>
					<tr>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='liga_table.php' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/table.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/table2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/table.png)';this.style.color='#fff';\" >
								<br/><br/><br/>Tabelle
								</div>
							</a>
						</td>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='liga_calendar.php' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
							<div style='background:url(images/calendar.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/calendar2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/calendar.png)';this.style.color='#fff';\" >
								<br/><br/><br/>Kalender
							</div>
							</a>
						</td>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/tabelle.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/tabelle2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/tabelle.png)';this.style.color='#fff';\" >
								<br/><br/><br/>Termine
								</div>
								</a>
						</td>
					</tr>
					<tr>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/kader.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/kader2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/kader.png)';this.style.color='#fff';\" >
								<br/><br/><br/>Kader
								</div>
							</a>
						</td>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/Scorer.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/Scorer2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/Scorer.png)';this.style.color='#fff';\" >
								<br/><br/><br/>Scorer
								</div>
							</a>
						</td>
						<td style='width:33%;height:170px;text-align:center;vertical-align:bottom;'>
							<a href='' style='color:#ffffff;' onMouseOver=\"this.style.color='#444';\" onMouseOut=\";this.style.color='#fff';\" >
								<div style='background:url(images/versus.png) no-repeat;background-position:50% 50%;width:80%;height:150px;color:#ffffff;font-weight:bold;text-align:center;vertical-align:bottom;' onMouseOver=\"this.style.backgroundImage='url(images/versus2.png)';this.style.color='#444';\" onMouseOut=\"this.style.backgroundImage='url(images/versus.png)';this.style.color='#fff';\" >
								<br/><br/><br/>Strafen
								</div>
								</a>
						</td>
					</tr>
				</table>
";
require_once("footer.php");

?>