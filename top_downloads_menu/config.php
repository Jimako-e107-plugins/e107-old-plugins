<?php

$eplug_admin = true;
require_once '../../class2.php';

if (!getperms('1'))	{ header('Location:'.e_BASE.'index.php'); exit; }

require_once e_ADMIN.'auth.php';
require_once e_HANDLER.'form_handler.php';

include_lan(e_PLUGIN.'top_downloads_menu/languages/'.e_LANGUAGE.'.php');

global $menu_pref;

$sql	= new db();
$form	= new form();

if (isset($_POST['top_downloads_update_menu']))
{
	unset($_POST['top_downloads_update_menu']);
	
	if (!isset($_POST['top_downloads_count']) || ('' || 0) == $_POST['top_downloads_count'])	$_POST['top_downloads_count'] = 5;
	
	foreach($_POST as $key=>$value)
	{
		if ('top_downloads_' == substr($key, 0, 14)) $menu_pref[$key] = $value;
	}
	
	if ($menu_pref)
	{
		$tmp = addslashes(serialize($menu_pref));
		$msg = false === $sql->db_Update('core', "e107_value='$tmp' WHERE e107_name='menu_pref' ") ? LAN_TOPDOWNLOADS_NOT_UPDATED : LAN_TOPDOWNLOADS_UPDATED;
	}
}

if ($sql->db_Select('download_category', '*'))
{
	$cats = '
						<option value="0"'.(0 == varsettrue($_POST['top_downloads_menu_cat'], varsettrue($menu_pref['top_downloads_menu_cat'])) ? 'selected="selected"' : '').'>'.LAN_TOPDOWNLOADS_ALL.'</option>';
	
	while ($cat = $sql->db_Fetch(MYSQL_ASSOC))
	{
		$select = $cat['download_category_id'] == varsettrue($_POST['top_downloads_menu_cat'], varsettrue($menu_pref['top_downloads_menu_cat'])) ? ' selected="selected"' : '';
		$cats.= '
						<option value="'.$cat['download_category_id'].'"'.$selected.'>'.$cat['download_category_name'].'</option>';
	}
}
else
{
	$cats = '
						<option value="--none--" selected="selected">'.LAN_TOPDOWNLOADS_NO_CATS_YET.'</option>';
}

$html = '
<div id="menu-config-wrapper" style="padding-top: 20px;">
	<form method="post" action="'.e_SELF.(e_query ? '?'.e_QUERY : '').'">
		<table class="fborder" style="width: 85%;">
			<colgroup>
				<col width="250px;" align="left" />
				<col width="auto" align="left" />
			</colgroup>
			<tr>
				<th class="forumheader3" colspan="2" style="height: 30px; background: #CCCCCC; text-align: center">'.varsettrue($msg, LAN_TOPDOWNLOADS_SETTINGS).'</th>
			</tr>
			<tr>
				<td class="forumheader3" colspan="2" style="height: 10px;"><!-- --></td>
			</tr>
			<tr>
				<td class="forumheader3">'.LAN_TOPDOWNLOADS_CATEGORY.'</td>
				<td class="forumheader3">
					<select id="top_downloads_cat" name="top_downloads_cat" class="tbox" style="width: 200px;">'.
						$cats.'
					</select>
				</td>
			</tr>
			<tr>
				<td class="forumheader3">'.LAN_TOPDOWNLOADS_PERIOD.'</td>
				<td class="forumheader3">
					<!-- <input class="tbox" type="text" name="top_downloads_period" value="'.(varsettrue($_POST['top_downloads_period'], varsettrue($menu_pref['top_downloads_period'], 7))).'" size="5" maxlength="2" /> -->
					<select id="top_downloads_period" name="top_downloads_period" class="tbox" style="width: 200px;">
						<option value="7" '.(7 == $_POST['top_downloads_period'] ? 'selected="selected"' : '').'>'.LAN_TOPDOWNLOADS_WEEK.'</option>
						<option value="30" '.(30 == $_POST['top_downloads_period'] ? 'selected="selected"' : '').'>'.LAN_TOPDOWNLOADS_MONTH.'</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="forumheader3">'.LAN_TOPDOWNLOADS_COUNT.'</td>
				<td class="forumheader3">
					<input class="tbox" type="text" name="top_downloads_count" value="'.(varsettrue($_POST['top_downloads_count'], varsettrue($menu_pref['top_downloads_count'], 5))).'" size="5" maxlength="3" /> '.LAN_TOPDOWNLOADS_DOWNLOADS.'
				</td>
			</tr>
			<tr>
				<td class="forumheader3" colspan="2" style="height: 25px;">
					<div style="left: 250px; width: 200px; position: relative;">
						<input type="submit" class="button" name="top_downloads_update_menu" value="'.LAN_UPDATE.'" />
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>';

$ns->tablerender(LAN_TOPDOWNLOADS_SETTINGS, $html);

require_once e_ADMIN.'footer.php';