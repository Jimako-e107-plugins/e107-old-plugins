<?php
// **************************************************************************
// *  e_Classifieds Menu
// *
// **************************************************************************
if (!defined('e107_INIT'))
{
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/English.php");
}
if (!is_object($tp)) $tp = new e_parse;
$eclassf_uc = USERCLASS_LIST;
// print $eclassf_uc;
$arg = "select a.eclassf_cid,a.eclassf_cname,c.eclassf_catname,a.eclassf_cpic,a.eclassf_price,s.eclassf_subname,s.eclassf_ccatid,s.eclassf_subid from #eclassf_ads as a
		left join #eclassf_subcats as s
		on s.eclassf_subid = a.eclassf_ccat
		left join #eclassf_cats as c
		on s.eclassf_ccatid = c.eclassf_catid
		where find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "')
		and eclassf_capproved > 0
		and (eclassf_cpdate>'" . time() . "' or eclassf_cpdate =0) order by rand() limit 1";
if ($dsel = $sql->db_Select_gen($arg))
{
    $eclassf_item = $sql->db_Fetch();
    $eclassf_text = "<div style='text-align:center;'>"; ;
    $eclassf_text .= $tp->toHTML(ECLASSF_MENU_3, false, "no_make_clickable emotes_off") . " &gt; " . $tp->html_truncate($tp->toHTML($eclassf_item['eclassf_catname'], false, "no_make_clickable emotes_off"), 30) . "<br />";
    $eclassf_text .= $tp->toHTML(ECLASSF_MENU_5, false, "no_make_clickable emotes_off") . " &gt; " . $tp->html_truncate($tp->toHTML($eclassf_item['eclassf_subname'], false, "no_make_clickable emotes_off"), 30) . "<br />";

    if (!empty($eclassf_item['eclassf_cpic']) && file_exists(e_PLUGIN . "e_classifieds/images/classifieds/" . $eclassf_item['eclassf_cpic']))
    {
        $eclassf_text .= "<img src='" . e_PLUGIN . "e_classifieds/images/classifieds/" . $eclassf_item['eclassf_cpic'] . "' alt='" . $eclassf_item['eclassf_cname'] . "' title='" . $eclassf_item['eclassf_cname'] . "' style='height:50px;width:50px;border:0;'/><br />";
    }
    else
    {
        $eclassf_text .= "<img src='" . e_PLUGIN . "e_classifieds/images/icons/nothumb.png' alt='" . ECLASSF_MENU_6 . "' title='" . ECLASSF_MENU_6 . "' style='height:50px;width:50px;bordder:0;'/><br />";
    }
    $eclassf_text .= "<strong><a href='" . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $eclassf_item['eclassf_ccatid'] . "." . $eclassf_item['eclassf_subid'] . "." . $eclassf_item['eclassf_cid'] . "' >" . $tp->html_truncate($eclassf_item['eclassf_cname'], 30, ECLASSF_MENU_4) . "</a></strong><br />";

    $eclassf_text .= $tp->html_truncate($tp->toHTML($eclassf_item['eclassf_price'], false, "no_make_clickable emotes_off"), 30) . "&nbsp;<br />";
}
$eclassf_text .= "</div>";
$ns->tablerender(ECLASSF_MENU_1, $eclassf_text);

?>