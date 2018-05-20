<?php
/**
* clans.php
*
*/

require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/clan.php");

require_once(e_PLUGIN."ebattles/include/paginator.class.php");
/*******************************************************************
********************************************************************/
require_once(HEADERF);
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

/**
* Display Clans Table
*/
$text .= '<div id="tabs">';
$text .= '<ul>';
$text .= '<li><a href="#tabs-1">'.EB_CLANS_L2.'</a></li>';
$text .= '</ul>';
$text .= '<div id="tabs-1">';
displayClans();
$text .= '
</div>
';

$text .= '
</div>
';

$ns->tablerender(EB_CLANS_L1, $text);
require_once(FOOTERF);
exit;


/***************************************************************************************
Functions
***************************************************************************************/
/**
* displayClans - Displays the Clans database table in
* a nicely formatted html table.
*/
function displayClans(){
	global $pref;
	global $sql;
	global $text;

	$pages = new Paginator;

	if(check_class($pref['eb_teams_create_class']))
	{
		$text .= '<form action="'.e_PLUGIN.'ebattles/clancreate.php" method="post">';
		$text .= '<div>';
		$text .= '<input type="hidden" name="userid" value="'.USERID.'"/>';
		$text .= '<input type="hidden" name="username" value="'.USERNAME.'"/>';
		$text .= '</div>';
		$text .= ebImageTextButton('createteam', 'add.png', EB_CLANS_L7);
		$text .= '</form><br />';
	}
	else
	{
		//$text .= '<div>'..'</div>';
	}

	/* set pagination variables */
	$q = "SELECT count(*) "
	." FROM ".TBL_CLANS;
	$result = $sql->db_Query($q);
	$totalItems = mysql_result($result, 0);
	$pages->items_total = $totalItems;
	$pages->mid_range = eb_PAGINATION_MIDRANGE;
	$pages->paginate();

	$q = "SELECT ".TBL_CLANS.".*"
	." FROM ".TBL_CLANS
	." ORDER BY Name"
	." $pages->limit";

	$result = $sql->db_Query($q);
	/* Error occurred, return given name by default */
	$num_rows = mysql_numrows($result);
	if(!$result || ($num_rows < 0)){
		$text .= EB_CLANS_L3;
		return;
	}
	if($num_rows == 0){
		$text .= '<div>'.EB_CLANS_L4.'</div>';
	}
	else
	{
		// Paginate
		$text .= '<span class="paginate" style="float:left;">'.$pages->display_pages().'</span>';
		$text .= '<span style="float:right">';
		// Go To Page
		$text .= $pages->display_jump_menu();
		$text .= '&nbsp;&nbsp;&nbsp;';
		// Items per page
		$text .= $pages->display_items_per_page();
		$text .= '</span><br /><br />';

		/* Display table contents */
		$text .= '<table class="eb_table" style="width:95%"><tbody>';
		$text .= '<tr>
		<th class="eb_th2">'.EB_CLANS_L5.'</th>
		<th class="eb_th2">'.EB_CLANS_L6.'</th>
		</tr>';
		for($i=0; $i<$num_rows; $i++){
			$clan_id  = mysql_result($result,$i, TBL_CLANS.".ClanID");
			$clan = new Clan($clan_id);

			$image = "";
			if ($pref['eb_avatar_enable_teamslist'] == 1)
			{
				if($clan->getField('Image'))
				{
					$image = '<img '.getAvatarResize(getImagePath($clan->getField('Image'), 'team_avatars')).'/>';
				} else if ($pref['eb_avatar_default_team_image'] != ''){
					$image = '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_team_image'], 'team_avatars')).'/>';
				}
			}

			$text .= '<tr>
			<td class="eb_td">'.$image.'&nbsp;<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'">'.$clan->getField('Name').'</a></td>
			<td class="eb_td">'.$clan->getField('Tag').'</td></tr>';
		}
		$text .= '</tbody></table><br />';
	}
}
?>

