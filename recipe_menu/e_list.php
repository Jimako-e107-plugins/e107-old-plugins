<?php
/*
+---------------------------------------------------------------+
|        Recipe Menu v2.00 - by Barry (recipe @ keal.me.uk)
|
|        v2.00 modifications foodisfunagain.com allergy support
|
|        This module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if (!$recipe_install = $sql->db_Select("plugin", "*", "plugin_path = 'recipe_menu' AND plugin_installflag = '1' "))
{
    return;
} 
global $pref;
if (!check_class($pref['recipe_menu_readclass'])) {
    return;
}
$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

$todayarray = getdate();
$current_day = $todayarray['mday'];
$current_month = $todayarray['mon'];
$current_year = $todayarray['year'];
$current = mktime(0, 0, 0, $current_month, $current_day, $current_year);

if ($mode == "new_page" || $mode == "new_menu")
{
    $lvisit = $this->getlvisit();
    $qry = " recipe_posted>" . $lvisit ;
} 
else
{
    $qry = "recipe_id>0";
} 

$bullet = $this->getBullet($arr[6], $mode);

$qry = "
	SELECT r.*, c.recipe_category_name
	FROM #recipemenu_recipes AS r 
	LEFT JOIN #recipemenu_category AS c ON r.recipe_category = c.recipe_category_id  
	WHERE " . $qry . "
	ORDER BY r.recipe_posted ASC LIMIT 0," . $arr[7];

if (!$recipe_items = $sql->db_Select_gen($qry))
{
    $LIST_DATA = LIST_CALENDAR_2;
} 
else
{
    while ($row = $sql->db_Fetch())
    {
        $tmp = explode(".", $row['recipe_author']);
        if ($tmp[0] == "0")
        {
            $AUTHOR = $tmp[1];
        } elseif (is_numeric($tmp[0]) && $tmp[0] != "0")
        {
            $AUTHOR = (USER ? "<a href='" . e_BASE . "user.php?id." . $tmp[0] . "'>" . $tmp[1] . "</a>" : $tmp[1]);
        } 
        else
        {
            $AUTHOR = "";
        } 

        $rowheading = $this->parse_heading($row['recipe_name'], $mode);
        $ICON = $bullet;
        $HEADING = "<a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $row['recipe_id'] . "' title='" . $row['recipe_name'] . "'>" . $rowheading . "</a>";
        $CATEGORY = $row['recipe_category_name'];
#        $DATE = ($arr[5] ? ($row['event_start'] ? $this->getListDate($row['event_start'], $mode) : "") : "");
$DATE="";
        $INFO = "";
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    } 
} 
?>