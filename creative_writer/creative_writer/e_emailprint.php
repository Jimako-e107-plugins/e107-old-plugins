<?php
if (!defined('e107_INIT'))
{
    exit;
}
// function print_item($id)
// {
// if (!is_object($eclassf_tp)) $eclassf_tp = new e_parse;

// global $pref, $sql, $tp;
// if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php"))
// {
// include_once(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
// }
// else
// {
// include_once(e_PLUGIN . "e_classifieds/languages/English.php");
// }
// $eclassf_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
// $eclassf_arg = $eclassf_arg = "select * from " . MPREFIX . "eclassf_ads as r
// left join #eclassf_subcats as t on r.eclassf_ccat=eclassf_subid
// left join #eclassf_cats on eclassf_ccatid=eclassf_catid
// where r.eclassf_cid=$id and find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') and eclassf_capproved > 0 and (eclassf_cpdate = 0 or eclassf_cpdate='' or eclassf_cpdate is null or eclassf_cpdate>$eclassf_today) ";;
// $sql->db_Select_gen($eclassf_arg);
// $eclassf_row = $sql->db_Fetch();
// extract($eclassf_row);
// $eclassf_cname = $eclassf_tp->toHTML($eclassf_cname);
// $eclassf_cdesc = $eclassf_tp->toHTML($eclassf_cdesc);
// $eclassf_cdetails = $eclassf_tp->toHTML($eclassf_cdetails);
// $eclassf_subname = $eclassf_tp->toHTML($eclassf_subname);
// $eclassf_catname = $eclassf_tp->toHTML($eclassf_catname);

// $eclassf_cph = $eclassf_tp->toHTML($eclassf_cph);
// $eclassf_cemail = $eclassf_tp->toHTML($eclassf_cemail);
// $eclassf_catname = $eclassf_tp->toHTML($eclassf_catname);
// $eclassf_price = $eclassf_tp->toHTML($eclassf_price);
// $tmp = explode(".", $eclassf_cuser);
// $a_name = $eclassf_tp->toHTML($tmp[1]);
// // $eclassf_cpdate = $con->convert_date($eclassf_cpdate, "long");
// $eclassf_text = "<span style=\"font-size: 16px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
// <b>" . $eclassf_cname . "</b></span>";
// if ($pref['eclassf_pictype'] == 1)
// {
// if (!empty($eclassf_cpic) && file_exists(e_PLUGIN . "e_classifieds/images/classifieds/$eclassf_cpic"))
// {
// $eclassf_text .= "<br /><br /><img src='" . e_PLUGIN . "e_classifieds/images/classifieds/$eclassf_cpic' style='border:0;' alt='$eclassf_cname'/><br />";
// }
// }
// else
// {
// if (!empty($eclassf_cpic))
// {
// $eclassf_text .= "<br /><br /><img src='" . $eclassf_cpic . "' style='border:0;' alt='$eclassf_cname'/><br />";
// }
// }
// $eclassf_text .= "<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\"><br /><br />";
// $eclassf_text .= "
// <b>" . ECLASSF_24 . "</b>
// <br />$eclassf_catname 	<br /><br />";
// $eclassf_text .= "
// <b>" . ECLASSF_73 . "</b>
// <br />$eclassf_subname 	<br /><br />";

// $eclassf_text .= "
// <b>" . ECLASSF_26 . "</b>
// <br />$eclassf_cname 	<br /><br />";
// $eclassf_text .= "
// <b>" . ECLASSF_8 . "</b>
// <br />$eclassf_cdesc  <br /><br />";
// $eclassf_text .= "
// <b>" . ECLASSF_28 . "</b>
// <br />$eclassf_cdetails  <br /><br />";
// if ($eclassf_price > 0)
// {
// $eclassf_text .= "
// <b>" . ECLASSF_60 . "</b>
// <br />$eclassf_price  <br /><br />";
// }
// $eclassf_text .= "
// <b>" . ECLASSF_12 . "</b>
// <br />$eclassf_cph  <br /><br />";
// $eclassf_addr = explode("@", $eclassf_cemail);
// $eclassf_text .= "
// <b>" . ECLASSF_13 . "</b>
// <br />" . $eclassf_addr[0] . " at " . $eclassf_addr[1] . "  <br /><br />";

// require_once(e_HANDLER . 'date_handler.php');
// $rd = new convert;
// $eclassf_date = $rd->convert_date($eclassf_cpdate);
// $eclassf_text .= "
// <br /></span>
// <span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
// <em><b>" . ECLASSF_79 . "</b><br />" . ECLASSF_11 . " " . $a_name ;
// if ($eclassf_row['eclassf_cpdate'] > 0)
// {
// $eclassf_text .= " - " . ECLASSF_72 . " " . $eclassf_date . "</em>";
// }
// $eclassf_text .= "<br /><br /><hr />" .  SITENAME . "
// <br />
// ( http://" . $_SERVER[HTTP_HOST] . e_HTTP . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $eclassf_cid . ".$eclassf_category.$eclassf_cid )
// </span>";
// return $eclassf_text;
// }
function email_item($id)
{
    global $pref, $sql, $tp;
    include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
    $eclassf_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
    $eclassf_arg = "select * from #eclassf_ads as r
left join #eclassf_subcats as t on r.eclassf_ccat=eclassf_subid
left join #eclassf_cats on eclassf_ccatid=eclassf_catid
where r.eclassf_cid=$id and find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') and eclassf_capproved > 0 and (eclassf_cpdate = 0 or eclassf_cpdate='' or eclassf_cpdate is null or eclassf_cpdate>$eclassf_today) ";;
    $sql->db_Select_gen($eclassf_arg);
    $eclassf_row = $sql->db_Fetch();

    $message .= ECLASSF_80 . " <a href='" . SITEURL . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $id . "." . $eclassf_row['eclassf_category'] . "." . $id . "'>Click</a><br /><br />";
    $message .= ECLASSF_26 . " - " . $tp->toHTML($eclassf_row['eclassf_cname']) . "\n\n";
    $message .= ECLASSF_3 . " - " . $tp->toHTML($eclassf_row['eclassf_cdesc']) . "\n\n";

    $message .= ECLASSF_2 . "\n" . $tp->toHTML($eclassf_row['eclassf_catname']) . " - " . $tp->toHTML($eclassf_row['eclassf_subname']) . "\n\n";
    $eclassf_author = explode(".", $eclassf_row['eclassf_cuser']);
    require_once(e_HANDLER . 'date_handler.php');
    $rd = new convert;
    $eclassf_date = $rd->convert_date($eclassf_row['eclassf_cpdate']);
    $message .= ECLASSF_11 . " " . $eclassf_author[1] . ". ";
    if ($eclassf_row['eclassf_cpdate'] > 0)
    {
        $message .= " - " . ECLASSF_72 . " " . $eclassf_date . "\n";
    }
    else
    {
        $message .= "\n";
    }
    return $message;
}

?>