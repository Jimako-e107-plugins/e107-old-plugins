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
e107_require_once(e_PLUGIN . "e_classifieds/includes/eclassifieds_class.php");
if (!is_object($eclassf_obj))
{
    $eclassf_obj = new classifieds;
}
require_once(e_HANDLER . "userclass_class.php");

require_once(e_HANDLER . "date_handler.php");

require_once(e_HANDLER . "emailprint_class.php");

function print_item($id)
{
    global $eclassf_obj, $ECLASSF_PREF, $sql, $tp,$PLUGINS_DIRECTORY;
	require_once(e_HANDLER . 'file_class.php');
	$eclassf_file = new e_file;
    $eclassf_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
    $eclassf_arg = $eclassf_arg = "select * from #eclassf_ads as r
left join #eclassf_subcats as t on r.eclassf_category=eclassf_subid
left join #eclassf_cats on eclassf_categoryid=eclassf_catid
where r.eclassf_id=$id and find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') and eclassf_approved > 0 and (eclassf_expires = 0 or eclassf_expires='' or eclassf_expires is null or eclassf_expires>$eclassf_today) ";
    $sql->db_Select_gen($eclassf_arg, false);
    $eclassf_row = $sql->db_Fetch();
    extract($eclassf_row);
    $eclassf_id = $tp->toHTML($eclassf_id);
    $eclassf_desc = $tp->toHTML($eclassf_desc);
    $eclassf_details = $tp->toHTML($eclassf_details);
    $eclassf_subname = $tp->toHTML($eclassf_subname);
    $eclassf_catname = $tp->toHTML($eclassf_catname);

    $eclassf_phone = $tp->toHTML($eclassf_phone);
    $eclassf_email = $tp->toHTML($eclassf_email);
    $eclassf_catname = $tp->toHTML($eclassf_catname);
    $eclassf_price = $tp->toHTML($eclassf_price);
    $a_name = substr($eclassf_user, strpos($eclassf_user, ".") + 1);
    // $elcassf_posted = $con->convert_date($elcassf_posted, "long");
   #$eclassf_text = "<span style=\"font-size: 16px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
#	<b>" . $eclassf_id . "</b></span>";
	$eclassf_prefix = "^thumb_" . $eclassf_id . "_" ;
	$eclassf_list = $eclassf_file->get_files(e_PLUGIN . 'e_classifieds/images/classifieds/' , $eclassf_prefix, 'standard', 0, 0);
	$eclassf_count = 0;
	$eclassf_numrecs = count($eclassf_list);


		foreach($eclassf_list as $eclassf_piclist) {

			$eclassf_bigpic =$eclassf_piclist['fname'];


			if (!empty($eclassf_bigpic) && file_exists(e_PLUGIN.'e_classifieds/images/classifieds/' . $eclassf_bigpic)) {
				// if a picture exists then display it otherwise omit the licture line altogether

				$eclassf_text .= "
					<img src='" . SITEURL . $PLUGINS_DIRECTORY . "e_classifieds/images/classifieds/" . $eclassf_bigpic . "' title='' style='border:0px' alt=''/>";
			}
		}

#        if (!empty($eclassf_thumbnail) && file_exists(e_PLUGIN . "e_classifieds/images/classifieds/$eclassf_thumbnail"))
#        {
#            $eclassf_text .= "<br /><br /><img src='" . e_PLUGIN . "e_classifieds/images/classifieds/$eclassf_thumbnail' style='border:0;' alt='$eclassf_id'/><br />";
#        }
    $eclassf_text .= "<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\"><br /><br />";
    $eclassf_text .= "
	<b>" . ECLASSF_24 . "</b>
	<br />$eclassf_catname 	<br /><br />";
    $eclassf_text .= "
	<b>" . ECLASSF_73 . "</b>
	<br />$eclassf_subname 	<br /><br />";

    $eclassf_text .= "
	<b>" . ECLASSF_26 . "</b>
	<br />$eclassf_id 	<br /><br />";
    $eclassf_text .= "
    <b>" . ECLASSF_8 . "</b>
	<br />$eclassf_desc  <br /><br />";
    $eclassf_text .= "
    <b>" . ECLASSF_28 . "</b>
	<br />$eclassf_details  <br /><br />";
    if ($eclassf_price > 0)
    {
        $eclassf_text .= "
    <b>" . ECLASSF_60 . "</b>
	<br />$eclassf_price  <br /><br />";
    }
    $eclassf_text .= "
    <b>" . ECLASSF_12 . "</b>
	<br />$eclassf_phone  <br /><br />";
    $eclassf_addr = explode("@", $eclassf_email);
    $eclassf_text .= "
    <b>" . ECLASSF_13 . "</b>
	<br />" . $eclassf_addr[0] . " at " . $eclassf_addr[1] . "  <br /><br />";

    $eclassf_rd = new convert;
    $eclassf_date = $eclassf_rd->convert_date($elcassf_posted);
    $eclassf_text .= "
<br /></span>
<span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<em><b>" . ECLASSF_79 . "</b><br />" . ECLASSF_11 . " " . $a_name ;
    if ($eclassf_row['elcassf_posted'] > 0)
    {
        $eclassf_text .= " - " . ECLASSF_72 . " " . $eclassf_date . "</em>";
    }
    $eclassf_text .= "<br /><br /><hr />" . SITENAME . "
	<br />
	( http://" . $_SERVER[HTTP_HOST] . e_HTTP . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $eclassf_id . ".$eclassf_category.$eclassf_id )
	</span>";
    return $eclassf_text;
}

function email_item($id)
{
    global $eclassf_obj, $ECLASSF_PREF, $sql, $tp;
    $eclassf_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
    $eclassf_arg = "select * from #eclassf_ads as r
left join #eclassf_subcats as t on r.eclassf_category=eclassf_subid
left join #eclassf_cats on eclassf_categoryid=eclassf_catid
where r.eclassf_id=$id and find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') and eclassf_approved > 0 and (eclassf_expires = 0 or eclassf_expires='' or eclassf_expires is null or eclassf_expires>$eclassf_today) ";;
    $sql->db_Select_gen($eclassf_arg);
    $eclassf_row = $sql->db_Fetch();

    $message .= ECLASSF_80 . " <a href='" . SITEURL . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $id . "." . $eclassf_row['eclassf_category'] . "." . $id . "'>Click</a><br /><br />";
    $message .= ECLASSF_26 . " - " . $tp->toHTML($eclassf_row['eclassf_id']) . "\n\n";
    $message .= ECLASSF_3 . " - " . $tp->toHTML($eclassf_row['eclassf_desc']) . "\n\n";

    $message .= ECLASSF_2 . "\n" . $tp->toHTML($eclassf_row['eclassf_catname']) . " - " . $tp->toHTML($eclassf_row['eclassf_subname']) . "\n\n";
    $eclassf_author = substr($eclassf_row['eclassf_user'], strpos($eclassf_row['eclassf_user'], ".") + 1);
    $eclassf_rd = new convert;
    $eclassf_date = $eclassf_rd->convert_date($eclassf_row['elcassf_posted']);
    $message .= ECLASSF_11 . " " . $eclassf_author[1] . ". ";
    if ($eclassf_row['elcassf_posted'] > 0)
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