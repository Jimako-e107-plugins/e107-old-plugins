<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
e107_require_once(e_PLUGIN . 'e_classifieds/includes/eclassifieds_class.php');
global $tp, $eclassf_obj;
if (!is_object($eclassf_obj))
{
    $eclassf_obj = new classifieds;
}

require_once(e_HANDLER . 'userclass_class.php');
require_once(e_HANDLER . 'cache_handler.php');
require_once(e_HANDLER . 'date_handler.php');
$eclassf_uc = USERCLASS_LIST;
$arg = 'select a.eclassf_id,a.eclassf_name,a.eclassf_id,c.eclassf_catname,a.eclassf_thumbnail,a.eclassf_price,s.eclassf_subname,s.eclassf_categoryid,s.eclassf_subid from #eclassf_ads as a
		left join #eclassf_subcats as s
		on s.eclassf_subid = a.eclassf_category
		left join #eclassf_cats as c
		on s.eclassf_categoryid = c.eclassf_catid
		where ';

if ($ECLASSF_PREF['eclassf_force_main_cat'])
{
    $arg .= ' c.eclassf_catid="' . $ECLASSF_PREF['eclassf_force_main_cat'] . '" AND ';
    if ($ECLASSF_PREF['eclassf_force_sub_cat'])
    {
        $arg .= 's.eclassf_subid="' . $ECLASSF_PREF['eclassf_force_sub_cat'] . '" AND ';
    }
}

$arg .= ' find_in_set(eclassf_catclass,"' . USERCLASS_LIST . '")';
if ($ECLASSF_PREF['eclassf_approval'] == 1)
{
    $arg .= 'and eclassf_approved > 0';
}
if ($ECLASSF_PREF['eclassf_valid'] > 0)
{
    $arg .= 'and (elcassf_expires>"' . time() . '" or elcassf_expires =0) ';
}
$arg .= 'order by rand() limit 1';
if ($dsel = $sql->db_Select_gen($arg, false))
{
    $eclassf_item = $sql->db_Fetch();
    $eclassf_text = '<div style="text-align:center;">';
    if (!$ECLASSF_PREF['eclassf_force_sub_cat'])
    {
        $eclassf_text .= $tp->toHTML(ECLASSF_MENU_3, false, 'no_make_clickable emotes_off') . ' &gt; '; // Show 'category'
        if (!$ECLASSF_PREF['eclassf_force_main_cat']) // Show 'real' main category, and text for sub-category
            {
                $eclassf_text .= $tp->html_truncate($tp->toHTML($eclassf_item['eclassf_catname'], false, 'no_make_clickable emotes_off'), 30) . '<br />';
            $eclassf_text .= $tp->toHTML(ECLASSF_MENU_5, false, 'no_make_clickable emotes_off') . ' &gt; ';
        }
        $eclassf_text .= $tp->html_truncate($tp->toHTML($eclassf_item['eclassf_subname'], false, 'no_make_clickable emotes_off'), 30) . '<br />'; // Show sub-cate
    }

    if (!empty($eclassf_item['eclassf_thumbnail']) && file_exists(e_PLUGIN . 'e_classifieds/images/classifieds/' . $eclassf_item['eclassf_thumbnail']))
    {
        $img_name = e_PLUGIN . 'e_classifieds/images/classifieds/' . $eclassf_item['eclassf_thumbnail'];
    }
    else
    {
        $img_name = e_PLUGIN . 'e_classifieds/images/icons/nothumb.png';
    }

    $eclassf_text .= "<a href='" . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $eclassf_item['eclassf_categoryid'] . "." . $eclassf_item['eclassf_subid'] . "." . $eclassf_item['eclassf_id'] . "'>
					<img src='{$img_name}' alt='" . $eclassf_item['eclassf_id'] . "' title='" . $eclassf_item['eclassf_id'] . "' style='height:50px;width:50px;border:0;'/></a>";

    $eclassf_text .= "<br /><strong><a href='" . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $eclassf_item['eclassf_categoryid'] . "." . $eclassf_item['eclassf_subid'] . "." . $eclassf_item['eclassf_id'] . "' >" . $tp->html_truncate($eclassf_item['eclassf_name'], 30, ECLASSF_MENU_4) . "</a></strong><br />";

    $eclassf_text .= $ECLASSF_PREF['eclassf_currency'] . $tp->toHTML($eclassf_item['eclassf_price'], false, 'no_make_clickable emotes_off') . '&nbsp;<br />';
}
$eclassf_text .= '</div>';
$ns->tablerender(ECLASSF_MENU_1, $eclassf_text);

?>