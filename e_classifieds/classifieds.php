<?php
require_once("../../class2.php");
// If not a valid call to the script then leave it
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "np_class.php");
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/English.php");
}
// define the over ride meta tags
// define("PAGE_NAME", ECLASSF_1);
define("e_PAGETITLE", ECLASSF_1);
if (!empty($pref['eclassf_metad']))
{
    define("META_DESCRIPTION", $pref['eclassf_metad']);
}
if (!empty($pref['eclassf_metak']))
{
    define("META_KEYWORDS", $pref['eclassf_metak']);
}
// check if we use the wysiwyg for text areas
$e_wysiwyg = "eclassf_cdetails";
if ($pref['wysiwyg'])
{
    $WYSIWYG = true;
}
require_once(e_HANDLER . "rate_class.php");
$rater = new rater;
require_once(HEADERF);
// Check that access is permitted to this plugin
$eclassf_access = check_class($pref['eclassf_read']) || check_class($pref['eclassf_admin']) || check_class($pref['eclassf_create']);
if (!$eclassf_access)
{
    $eclassf_text = $tp->toHTML(ECLASSF_40);
    $ns->tablerender(ECLASSF_1, $eclassf_text);
    require_once(FOOTERF);
    exit;
}

$eclassf_gen = new convert;

$eclassf_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
// get the parameters passed into the script
if (e_QUERY)
{
    $eclassf_tmp = explode(".", e_QUERY);
    $eclassf_from = intval($eclassf_tmp[0]);
    $eclassf_action = $eclassf_tmp[1];
    $eclassf_catid = intval($eclassf_tmp[2]);
    $eclassf_subid = intval($eclassf_tmp[3]);
    $eclassf_itemid = intval($eclassf_tmp[4]);
    $eclassf_tmp = intval($eclassf_tmp[5]);
}
else
{
    $eclassf_from = intval($_REQUEST['eclassf_from']);
    $eclassf_action = $_REQUEST['eclassf_action'];
    $eclassf_catid = intval($_REQUEST['eclassf_catid']);
    $eclassf_subid = intval($_REQUEST['eclassf_subid']);
    $eclassf_itemid = intval($_REQUEST['eclassf_itemid']);
    $eclassf_tmp = intval($_REQUEST['eclassf_tmp']);
}
// this is used if drop downs are used for sub categories to get the one that was selected
if (is_array($eclassf_subid))
{
    foreach($eclassf_subid as $row)
    {
        if ($row > 0)
        {
            $eclassf_subid = $row;
        }
    }
}
$eclassf_subid = intval($eclassf_subid);
// If from not defined then make it zero
$eclassf_from = ($eclassf_from > 0?$eclassf_from: 0);
// If no per page pref set then default to 10 per page
$pref['eclassf_perpage'] = ($pref['eclassf_perpage'] > 0?$pref['eclassf_perpage']:10);
// Do the action
switch ($eclassf_action)
{
    case "mge":
    case "new";
        require_once("add.php");
        exit;
        break;
    case "tnc":
        $eclassf_text = "
		<table class=\"fborder\" style='width:97%'>
			<tr>
				<td class='fcaption'>" . $tp->toHTML(ECLASSF_41) . "</td>
			</tr>
			<tr>
				<td class='forumheader2' style='width:30%;text-align:left;' ><a href='" . e_SELF . "?$eclassf_from.$eclassf_tmp.$eclassf_catid.$eclassf_subid.$eclassf_itemid'><img src='./images/updir.png' alt='Go Up' style='border:0;'/></a></td>
			</tr>";
        if (file_exists("./images/logo.png"))
        {
            $eclassf_text .= "
			<tr>
				<td class='forumheader2' style='width:30%;text-align:center;' ><img src='./images/logo.png' alt='logo' style='border:0;'/></td>
			</tr>";
        }

        $eclassf_text .= "
			<tr>
				<td class='forumheader2' style='width:70%;'><strong>" . $tp->toHTML(ECLASSF_41) . "</strong></td>
			</tr>
			<tr>
				<td class='forumheader3'>" . $tp->toHTML($pref['eclassf_terms'], true) . "</td>
			</tr>
		</table>";
        $eclassf_text .= eclassf_footer();

        break;
    case "list":
        {
            if ($pref['eclassf_thumbs'] > 0)
            {
                $eclassf_colspan = 5;
            }
            else
            {
                $eclassf_colspan = 4;
            }
            $eclassf_arg = "
			select eclassf_catid,eclassf_catname,eclassf_subname from #eclassf_cats
			left join #eclassf_subcats on eclassf_catid=eclassf_ccatid
			where eclassf_subid=$eclassf_subid";
            $sql->db_Select_gen($eclassf_arg, false);
            $eclassf_row = $sql->db_Fetch();
            extract($eclassf_row);
            $eclassf_text = "
		<table class=\"fborder\" style='width:97%'>
			<tr>
				<td class='fcaption' colspan='$eclassf_colspan'>" . $tp->toHTML(ECLASSF_46) . " - <strong>" . $tp->toHTML($eclassf_catname) . "</strong>: " . $tp->toHTML(ECLASSF_91) . " - <strong>" . $tp->toHTML($eclassf_subname) . "</strong></td>
			</tr>
			<tr>
				<td class='forumheader2' style='text-align:left;' colspan='$eclassf_colspan'><a href='" . e_SELF . "?$eclassf_from.sub.$eclassf_catid.$eclassf_subid.0'><img src='./images/updir.png' alt='Go up' style='border:0;'/></a></td>
			</tr>";
            if (file_exists("./images/logo.png"))
            {
                $eclassf_text .= "
			<tr>
				<td class='forumheader2' style='text-align:center;' colspan='$eclassf_colspan'><img src='./images/logo.png' alt='logo' style='border:0;'/></td>
			</tr>";
            }

            $eclassf_text .= "
			<tr>";
            if ($pref['eclassf_thumbs'] > 0)
            {
                $eclassf_text .= "
				<td class='forumheader2' style='width:10%;'>&nbsp;</td>";
            }
            $eclassf_text .= "
				<td class='forumheader2' style='width:40%;'><strong>" . $tp->toHTML(ECLASSF_15) . "</strong></td>
				<td class='forumheader2' style='width:15%;text-align:right;'><strong>" . $tp->toHTML(ECLASSF_60) . " " . $pref['eclassf_currency'] . "</strong></td>
				<td class='forumheader2' style='width:20%;text-align:left;'><strong>" . $tp->toHTML(ECLASSF_11) . "</strong></td>
				<td class='forumheader2' style='width:15%;'><strong>" . ECLASSF_16 . "</strong></td>
			</tr>";
            // needs to be this complex for security reasons!
            $eclassf_arg = "
				select * from #eclassf_ads as r
				left join #eclassf_subcats as t on r.eclassf_ccat=eclassf_subid
				left join #eclassf_cats on eclassf_ccatid=eclassf_catid
				where r.eclassf_ccat=$eclassf_subid
				and find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "')" .
            ($pref['eclassf_approval'] == 1?" and eclassf_capproved > 0":"") . "  and (eclassf_cpdate = 0 or eclassf_cpdate='' or eclassf_cpdate is null or eclassf_cpdate>$eclassf_today)
				order by eclassf_subname
				limit $eclassf_from," . $pref['eclassf_perpage'];
            $eclassf_count = $sql->db_Count("eclassf_ads", "(*)", "where eclassf_ccat=$eclassf_subid and eclassf_capproved > 0 and (eclassf_cpdate = 0 or eclassf_cpdate='' or eclassf_cpdate is null or eclassf_cpdate>$eclassf_today)");
            if ($sql->db_Select_gen($eclassf_arg, false))
            {
                while ($eclassf_row = $sql->db_Fetch())
                {
                    extract($eclassf_row);

                    $eclassf_poster = substr($eclassf_cuser, strpos($eclassf_cuser, ".")+1);
                    $eclassf_text .= "
			<tr>";
                    if ($pref['eclassf_thumbs'] > 0)
                    {
                        if (!empty($eclassf_cpic) && file_exists(e_PLUGIN . "e_classifieds/images/classifieds/thumb_" . $eclassf_cpic))
                        {
                            $eclassf_text .= "
				<td class='forumheader3' style='width:10%;text-align:center;'><img src='" . e_PLUGIN . "e_classifieds/images/classifieds/thumb_" . $eclassf_cpic . "' style='border:0;' alt='thumbnail' /></td>";
                        }
                        else
                        {
                            $eclassf_text .= "
				<td class='forumheader3' style='width:10%;text-align:center;'><img src='" . e_PLUGIN . "e_classifieds/images/icons/nothumb.png' style='border:0;' alt='no thumbnail'/></td>";
                        }
                    }
                    $eclassf_text .= "
				<td class='forumheader3' style='width:40%;'><a href='" . e_SELF . "?$eclassf_from.item.$eclassf_catid.$eclassf_subid.$eclassf_cid'>" . $tp->toHTML($eclassf_cname) . "</a></td>
				<td class='forumheader3' style='width:15%;text-align:right;'>" . $tp->toHTML($eclassf_price) . "</td>
				<td class='forumheader3' style='width:20%;text-align:left;'>" . $tp->toHTML($eclassf_poster) . "</td>
				<td class='forumheader3' style='width:15%;'>";
                    if ($eclassf_cpdate > 0)
                    {
                        $eclassf_text .= $eclassf_gen->convert_date($eclassf_cpdate, "short");
                    }
                    else
                    {
                        $eclassf_text .= $tp->toHTML(ECLASSF_43);
                    }
                    $eclassf_text .= "
				</td>
			</tr>";
                } // while
            }
            else
            {
                $eclassf_text .= "
			<tr>
				<td class='forumheader3' colspan='$eclassf_colspan'>" . ECLASSF_52 . "</td>
			</tr>";
            }

            $eclassf_text .= "
		</table>";
            $eclassf_npaction = "list.$eclassf_catid.$eclassf_subid.$mycId";
            $eclassf_npparms = $eclassf_count . "," . $pref['eclassf_perpage'] . "," . $eclassf_from . "," . e_SELF . '?' . "[FROM]." . $eclassf_npaction;
            $eclassf_nextprev = $tp->parseTemplate("{NEXTPREV={$eclassf_npparms}}") . "";
            $eclassf_text .= eclassf_footer($eclassf_nextprev);
            break;
        }
    case "item":
        {
            $eclassf_arg = "select eclassf_catname,eclassf_subname from #eclassf_cats left join #eclassf_subcats on eclassf_catid=eclassf_ccatid where eclassf_subid=$eclassf_subid";
            $sql->db_Select_gen($eclassf_arg);
            $eclassf_row = $sql->db_Fetch();
            extract($eclassf_row);
            $eclassf_text = "
		<table class=\"fborder\" style='width:97%'>
			<tr>
				<td class='fcaption' colspan='2'>" . $tp->toHTML(ECLASSF_45) . " - <strong>" . $tp->toHTML($eclassf_catname) . "</strong>: " . $tp->toHTML(ECLASSF_91) . " - <strong>" . $tp->toHTML($eclassf_subname) . "</strong></td>
			</tr>";
            $eclassf_text .= "
			<tr>
				<td class='forumheader2' style='text-align:left;' colspan='2'><a href='" . e_SELF . "?$eclassf_from.list.$eclassf_catid.$eclassf_subid.0'><img src='./images/updir.png' alt='Go Up' style='border:0;'/></a>
					&nbsp;&nbsp;<a href='../../print.php?plugin:e_classifieds.$eclassf_itemid' ><img src='" . e_IMAGE . "generic/" . IMODE . "/printer.png' style='border:0;' title='" . ECLASSF_77 . "' alt='" . ECLASSF_77 . "' /></a>
					&nbsp;&nbsp;<a href='../../email.php?plugin:e_classifieds." . $eclassf_itemid . "'><img src='" . e_IMAGE . "generic/" . IMODE . "/email.png' style='border:0' alt='" . ECLASSF_78 . "' title='" . ECLASSF_78 . "' /></a>
				</td>
			</tr>";
            if (file_exists("./images/logo.png"))
            {
                $eclassf_text .= "
			<tr>
				<td class='forumheader2' style='text-align:center;' colspan='2'><img src='./images/logo.png' alt='logo' style='border:0;'/></td>
			</tr>";
            }
            $sql->db_Update("eclassf_ads", "eclassf_views=eclassf_views+1 where eclassf_cid=$eclassf_itemid");
            // needs to be this complex for security reasons!
            $eclassf_arg = "
				select *,u.user_id,u.user_name from " . MPREFIX . "eclassf_ads as r
				left join #eclassf_subcats as t on r.eclassf_ccat=eclassf_subid
				left join #eclassf_cats on eclassf_ccatid=eclassf_catid
				left join #user as u on SUBSTRING_INDEX(r.eclassf_cuser,'.',1) = u.user_id
				where r.eclassf_cid=$eclassf_itemid
				and find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') " .
            ($pref['eclassf_approval'] == 1?" and eclassf_capproved > 0":"") . " and (eclassf_cpdate = 0 or eclassf_cpdate='' or eclassf_cpdate is null or eclassf_cpdate>$eclassf_today) ";
            if ($sql->db_Select_gen($eclassf_arg))
            {
                $eclassf_row = $sql->db_Fetch();
                extract($eclassf_row);

                $eclassf_tmp = explode(".", $eclassf_cuser);
                $eclassf_name = substr($eclassf_cuser, strpos($eclassf_cuser, ".")+1);
                $eclassf_id = $eclassf_tmp[0];
               # if ($eclassf_name != $user_name && !empty($user_name))
               # {
                    // If the user name in the ad is not the same as e107 then update it
                    // if not in user database then mark them as left
                   # $eclassf_newname = $eclassf_id . "." . $user_name;
                    #$eclassf_name = $user_name;
                    #$sql->db_Update("eclassf_ads", "eclassf_cuser='" . $eclassf_newname . "' where eclassf_cid=$eclassf_itemid", false);
              #  }
                $eclassf_left = false;
                if (empty($user_name))
                {
                    $eclassf_left = true;
                }
                $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . $tp->toHTML(ECLASSF_7) . "</td><td class='forumheader3'>" . $tp->toHTML($eclassf_cname) . "&nbsp;</td>
			</tr>
			<tr>
				<td class='forumheader3' style='width:20%;'>" . $tp->toHTML(ECLASSF_8) . "</td><td class='forumheader3'>" . $tp->toHTML($eclassf_cdesc) . "&nbsp;</td>
			</tr>";
                switch ($pref['eclassf_pictype'])
                {
                    case 1:

                        if (!empty($eclassf_cpic) && file_exists("./images/classifieds/$eclassf_cpic"))
                        {
                            // <img src='./images/classifieds/$eclassf_cpic' style='border:0;height:" . $pref['eclassf_pich'] . "px;width:" . $pref['eclassf_picw'] . "px;' alt='$eclassf_cname'/>
                            $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . $tp->toHTML(ECLASSF_9) . "</td>
				<td class='forumheader3'>
					<a href='./images/classifieds/$eclassf_cpic' rel='external' >" . eclassf_sizeimg('./images/classifieds/' . $eclassf_cpic) . "</a>
					<br />" . ECLASSF_82 . "
				</td>
			</tr>";
                        }

                        break;
                    case 2:
                        if (!empty($eclassf_cpic))
                        {
                            $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . $tp->toHTML(ECLASSF_9) . "</td>
				<td class='forumheader3'>
					<a href='$eclassf_cpic' rel='external' >" . eclassf_sizeimg($eclassf_cpic) . "</a>
					<br />" . ECLASSF_82 . "
				</td>
			</tr>";
                        }
                        break;
                    case 0:
                    default:
                } // switch
                $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . ECLASSF_10 . "</td>
				<td class='forumheader3'>" . $tp->toHTML($eclassf_cdetails, true) . "&nbsp;</td>
			</tr>";
                if ($eclassf_left)
                {
                    $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . ECLASSF_11 . "</td>
				<td class='forumheader3'>" . $tp->toHTML($eclassf_name) . "&nbsp;" . ECLASSF_100 . "</td>
			</tr>";
                }
                else
                {
                    if ($pref['eclassf_userating'])
                    {
                        if ($ratearray = $rater->getrating("classifieds", $eclassf_id))
                        {
                            $eclassf_view_rating .= "<img src='./images/rate" . $ratearray[1] . ".png' alt='' />";

                            if ($ratearray[2] == "")
                            {
                                $ratearray[2] = 0;
                            }
                            $eclassf_view_rating .= "&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
                            $eclassf_view_rating .= ($ratearray[0] == 1 ? ECLASSF_102 : ECLASSF_103);
                        }
                        // if (strtolower($parm) == "none")
                        else
                        {
                            $eclassf_view_rating .= " " . ECLASSF_105;
                        }

                        if (!$rater->checkrated("classifieds", $eclassf_id) && USER)
                        {
                            $eclassf_view_rating .= $rater->rateselect("<br /><b>" . ECLASSF_107, "classifieds", $eclassf_id) . "</b>";
                        }
                        else if (!USER)
                        {
                            $eclassf_view_rating .= "&nbsp;";
                        }
                        else
                        {
                            $eclassf_view_rating .= "&nbsp;" . ECLASSF_101;
                        }
                    }
                }
                $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . ECLASSF_11 . "</td>
				<td class='forumheader3'><a href='../../user.php?id.$eclassf_id' >" . $tp->toHTML($eclassf_name) . "</a>&nbsp;$eclassf_view_rating</td>
			</tr>";
                // If ratings on for seller
                if (!empty($eclassf_cph))
                {
                    $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:30%;'>" . ECLASSF_12 . "</td><td class='forumheader3'>" . $tp->toHTML($eclassf_cph) . "&nbsp;</td>
			</tr>";
                }
                // Break up the email address so it isn't seen by spam bot
                $eclassf_addr = explode("@", $eclassf_cemail);
                $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . ECLASSF_13 . "</td><td class='forumheader3'>
				<script type='text/javascript'>
		<!--
		var eclassf_contact='" . $eclassf_addr[0] . " at " . $eclassf_addr[1] . "'
		var eclassf_email='" . $eclassf_addr[0] . "'
		var eclassf_emailHost='" . $eclassf_addr[1] . $subject . "'
		document.write(\"<a href=\" + \"mail\" + \"to:\" + eclassf_email + \"@\" + eclassf_emailHost+ \">\" + eclassf_contact + \"</a>\" + \"\")
		//-->
		</script>
		&nbsp;
				</td>
			</tr>";
                if ($eclassf_price > 0)
                {
                    $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . ECLASSF_60 . "</td>
				<td class='forumheader3'>" . $pref['eclassf_currency'] . $tp->toHTML($eclassf_price) . "&nbsp;</td>
			</tr>";
                }
            }
            else
            {
                $eclassf_text .= "
			<tr>
				<td class='forumheader3' colspan='2''>" . ECLASSF_44 . "</td>
			</tr>";
            }

            if ($pref['eclassf_counter'] != "NONE")
            {
                // counter is available for all ads
                if ($pref['eclassf_counter'] == "ALL" && !empty($eclassf_counter))
                {
                    // user defined counter and one is set
                    $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . ECLASSF_86 . "</td>
				<td class='forumheader3'>" . eclassf_makeimg($eclassf_views, $eclassf_counter) . "&nbsp;</td>
			</tr>";
                }
                if ($pref['eclassf_counter'] != "ALL" && !empty($eclassf_counter))
                {
                    // admin defined setting for counter and ignore the set chosen by the user
                    $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . $tp->toHTML(ECLASSF_86) . "</td>
				<td class='forumheader3'>" . eclassf_makeimg($eclassf_views, $pref['eclassf_counter']) . "&nbsp;</td>
			</tr>";
                }
            }

            $eclassf_text .= "</table>";
            $eclassf_text .= eclassf_footer();
            break;
        }
    case "sub":
        {
            if ($pref['eclassf_subdrop'] == 1)
            {
                $sql->db_Select("eclassf_cats", "eclassf_catname", "eclassf_catid=$eclassf_catid");
                $eclassf_row = $sql->db_Fetch();
                extract($eclassf_row);
                $eclassf_selector = "<select class='tbox' name='eclassf_subid' onchange='this.form.submit()' >";
                if (!$eclassf_subid > 0)
                {
                    $eclassf_selector .= "<option value='0'>" . $tp->toHTML(ECLASSF_98) . "</option>";
                }

                $sql->db_Select("eclassf_subcats", "eclassf_subid,eclassf_subname", "eclassf_ccatid=$eclassf_catid");
                while ($eclassf_row = $sql->db_Fetch())
                {
                    // extract($eclassf_row);
                    $eclassf_selector .= "<option value='" . $eclassf_row['eclassf_subid'] . "' " . ($eclassf_row['eclassf_subid'] == $eclassf_subid?"selected='selected'":"") . ">" . $eclassf_row['eclassf_subname'] . "</option>";
                }
                $eclassf_selector .= "</select>";
                $eclassf_text = "
				<form method='post' action='" . e_SELF . "' id='subform'>
                	<div>
                		<input type='hidden' name='eclassf_from' value='" . $eclassf_from . "' />
                		<input type='hidden' name='eclassf_action' value='list' />
                		<input type='hidden' name='eclassf_catid' value='" . $eclassf_catid . "' />
                		<input type='hidden' name='eclassf_itemid' value='" . $eclassf_itemid . "' />
                		<input type='hidden' name='eclassf_tmp' value='" . $eclassf_tmp . "' />
                	</div>
				<table class=\"fborder\" style='width:97%'>
					<tr>
						<td class='fcaption' colspan='2'>" . $tp->toHTML(ECLASSF_47) . " - <strong>" . $tp->toHTML($eclassf_catname) . "</strong></td>
					</tr>
					<tr>
						<td class='forumheader2' style='width:30%;text-align:left;' colspan='2'><a href='" . e_SELF . "?$eclassf_from.cat.$eclassf_catid.$eclassf_subid.0'><img src='./images/updir.png' alt='' style='border:0;'/></a></td>
					</tr>";
                if (file_exists("./images/logo.png"))
                {
                    $eclassf_text .= "<tr><td class='forumheader2' style='width:30%;text-align:center;' colspan='2'><img src='./images/logo.png' alt='logo' style='border:0;'/></td></tr>";
                }

                $eclassf_text .= "
					<tr>
						<td class='forumheader2' style='width:20%;text-align:left;' >" . $tp->toHTML(ECLASSF_96) . "</td><td class='forumheader2' style='width:80%;text-align:left;' >" . $eclassf_selector . "&nbsp;&nbsp;<input type='submit' class='tbox' name='submitit' value='" . $tp->toHTML(ECLASSF_97) . "' /></td>
					</tr>
				</table>
			</form>";
            }
            else
            {
                if ($pref['eclassf_icons'] > 0)
                {
                    $eclassf_colspan = 3;
                }
                else
                {
                    $eclassf_colspan = 2;
                }
                $eclassf_from = 0;
                $sql->db_Select("eclassf_cats", "eclassf_catname", "eclassf_catid=$eclassf_catid");
                $eclassf_row = $sql->db_Fetch();
                extract($eclassf_row);
                $eclassf_text = "
			<table class=\"fborder\" style='width:97%'>
				<tr>
					<td class='fcaption' colspan='$eclassf_colspan'>" . $tp->toHTML(ECLASSF_47) . " - <strong>" . $tp->toHTML($eclassf_catname) . "</strong></td>
				</tr>
				<tr>
					<td class='forumheader2' style='width:30%;text-align:left;' colspan='$eclassf_colspan'><a href='" . e_SELF . "?$eclassf_from.cat.$eclassf_catid.$eclassf_subid.0'><img src='./images/updir.png' alt='logo' style='border:0;'/></a></td>
				</tr>";
                if (file_exists("./images/logo.png"))
                {
                    $eclassf_text .= "
				<tr>
					<td class='forumheader2' style='width:30%;text-align:center;' colspan='$eclassf_colspan'><img src='./images/logo.png' alt='logo' style='border:0;'/></td>
				</tr>";
                }

                $eclassf_text .= "
				<tr>" . ($pref['eclassf_icons'] > 0?"<td class='forumheader2' >&nbsp;</td>":"") . "
					<td class='forumheader2' style='width:60%;'><strong>" . $tp->toHTML(ECLASSF_5) . "</strong></td><td class='forumheader2'><strong>" . $tp->toHTML(ECLASSF_6) . "</strong></td>
				</tr>";
                $eclassf_arg = "
				select * from #eclassf_subcats
				left join #eclassf_cats on eclassf_ccatid=eclassf_catid
				where eclassf_ccatid=$eclassf_catid
				and find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "')
				order by eclassf_subname";
                if ($sql->db_Select_gen($eclassf_arg))
                {
                    $sql3 = new DB;
                    while ($eclassf_row = $sql->db_Fetch())
                    {
                        extract($eclassf_row);
                        $eclassf_count = $sql3->db_Count("eclassf_ads", "(*)", "where eclassf_ccat=$eclassf_subid " .
                            ($pref['eclassf_approval'] == 1?" and eclassf_capproved > 0":"") . " and (eclassf_cpdate = 0 or eclassf_cpdate='' or eclassf_cpdate is null or eclassf_cpdate>$eclassf_today) ");
                        $eclassf_text .= "<tr>";
                        if ($pref['eclassf_icons'] > 0)
                        {
                            if (!empty($eclassf_subicon) && file_exists("./images/icons/" . $eclassf_subicon))
                            {
                                $eclassf_text .= "<td class='forumheader3' style='width:10%;text-align:center;'><img src='./images/icons/" . $eclassf_subicon . "'  alt='" . $tp->toHTML($eclassf_subname) . " icon' title='" . $tp->toHTML($eclassf_subname) . "'style='border:0;' /></td>";
                            }
                            else
                            {
                                $eclassf_text .= "<td class='forumheader3' style='width:10%;text-align:center;'><img src='./images/icons/blank.png'  alt='' title='' style='border:0;' /></td>";
                            }
                        }
                        $eclassf_text .= "<td class='forumheader3' style='width:30%;'><a href='" . e_SELF . "?$eclassf_from.list.$eclassf_ccatid.$eclassf_subid.0'>" . $tp->toHTML($eclassf_subname) . "</a></td>
					<td class='forumheader3'>$eclassf_count</td>
					</tr>";
                    } // while
                }
                else
                {
                    $eclassf_text .= "<tr><td class='forumheader3' colspan='$eclassf_colspan'>" . ECLASSF_51 . "</td></tr>";
                }
                $eclassf_text .= "</table>";
            }
            $eclassf_text .= eclassf_footer();
            break;
        }

    case "cat":
    default:
        {
            $sql3 = new DB;
            if ($pref['eclassf_icons'] > 0)
            {
                $eclassf_colspan = 4;
            }
            else
            {
                $eclassf_colspan = 3;
            }
            $eclassf_from = 0;
            if ($pref['eclassf_subdrop'] == 1)
            {
                $eclassf_text .= "
				<form id='subform' method='post' action='" . e_SELF . "' >";
                if ($pref['eclassf_subdrop'] == 1)
                {
                    $eclassf_text .= "
					<div>
						<input type='hidden' name='eclassf_from' value='" . $eclassf_from . "' />
                		<input type='hidden' name='eclassf_action' value='list' />
                		<input type='hidden' name='eclassf_catid' value='" . $eclassf_catid . "' />
                		<input type='hidden' name='eclassf_itemid' value='" . $eclassf_itemid . "' />
                		<input type='hidden' name='eclassf_tmp' value='" . $eclassf_tmp . "' />
					</div>";
                }
            }
            $eclassf_text .= "
			<table class=\"fborder\" style='width:97%'>
				<tr>
					<td class='fcaption' colspan='$eclassf_colspan'>" . $tp->toHTML(ECLASSF_4) . "</td>
				</tr>
				<tr>
					<td class='forumheader2' style='text-align:left;' colspan='$eclassf_colspan'><img src='./images/blank.png' alt='' style='border:0;'/></td>
				</tr>";
            if (file_exists("./images/logo.png"))
            {
                $eclassf_text .= "
				<tr>
					<td class='forumheader2' style='text-align:center;' colspan='$eclassf_colspan'><img src='./images/logo.png' alt='logo' style='border:0;'/></td>
				</tr>";
            }
            $eclassf_text .= "
				<tr>" . ($pref['eclassf_icons'] > 0?"<td class='forumheader2' style='width:10%;'>&nbsp;</td>":"") . "
					<td class='forumheader2' style='width:25%;'><strong>" . $tp->toHTML(ECLASSF_2) . "</strong></td>
					<td class='forumheader2' style='width:40%;'><strong>" . $tp->toHTML(ECLASSF_3) . "</strong></td>
					<td class='forumheader2' style='width:25%;'><strong>" . $tp->toHTML(ECLASSF_5) . "</strong></td>
				</tr>";
            if ($sql->db_Select("eclassf_cats", "*", "where find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') order by eclassf_catname", "nowhere", false))
            {
                // $eclassf_selector = "<select class='tbox' name='eclassf_subid[]' onchange='this.form.submit()' >";
                while ($eclassf_row = $sql->db_Fetch())
                {
                    extract($eclassf_row);
                    $eclassf_text .= "<tr>";
                    if ($pref['eclassf_icons'] > 0)
                    {
                        if (!empty($eclassf_caticon) && file_exists("./images/icons/" . $eclassf_caticon))
                        {
                            $eclassf_text .= "
					<td class='forumheader3' style='width:10%;text-align:center;'><img src='./images/icons/" . $eclassf_caticon . "' alt='" . $tp->toHTML($eclassf_catname) . " icon' title='" . $tp->toHTML($eclassf_catname) . "' style='border:0;'/></td>";
                        }
                        else
                        {
                            $eclassf_text .= "
					<td class='forumheader3' style='width:10%;text-align:center;'><img src='./images/icons/blank.png' alt='category icon' title='' style='border:0;'/></td>";
                        }
                    }
                    $catsubs = "";
                    $eclassf_text .= "
					<td class='forumheader3' style='vertical-align:top;'><a href='" . e_SELF . "?$eclassf_from.sub.$eclassf_catid.0.0'>" . $tp->toHTML($eclassf_catname) . "</a></td>
					<td class='forumheader3' style='vertical-align:top;'>" . $tp->toHTML($eclassf_catdesc) . "</td>";

                    if ($sql2->db_Select("eclassf_subcats", "*", "where eclassf_ccatid=$eclassf_catid order by eclassf_subname", "nowhere", false))
                    {
                        $eclassf_selector = "<select class='tbox' name='eclassf_subid[]' onchange='this.form.submit()' >";
                        $eclassf_selector .= "<option value='0' selected='selected'>" . ECLASSF_98 . "</option>";
                        while ($eclassf_subs = $sql2->db_Fetch())
                        {
                            extract($eclassf_subs);
                            $eclassf_count = $sql3->db_Select("eclassf_ads", "eclassf_cid", "where eclassf_ccat=$eclassf_subid " .
                                ($pref['eclassf_approval'] == 1?" and eclassf_capproved > 0":"") . " and (eclassf_cpdate = 0 or eclassf_cpdate='' or eclassf_cpdate is null or eclassf_cpdate>$eclassf_today)", "nowhere");
                            if ($pref['eclassf_subdrop'] == 1)
                            {
                                $eclassf_selector .= "<option value='{$eclassf_subid}'>" . $eclassf_subname . " ($eclassf_count)</option>";
                            }
                            else
                            {
                                $catsubs .= "<a href='" . e_SELF . "?$eclassf_from.list.$eclassf_catid.$eclassf_subid.$eclassf_itemid.$eclassf_tmp' >" . $tp->toHTML($eclassf_subname, false) . " ($eclassf_count)</a><br />";
                            }
                        }
                        $eclassf_selector .= "</select>&nbsp;&nbsp;<input type='button' class='tbox' onclick='this.form.submit()' name='submitit[]' value='" . ECLASSF_97 . "' />";
                    }
                    else
                    {
                        $catsubs = ECLASSF_81;
                    }
                    $eclassf_text .= "
					<td class='forumheader3' style='vertical-align:top;'>" . ($pref['eclassf_subdrop'] == 1?$eclassf_selector: $catsubs) . " </td>
				</tr>";
                } // while
            }
            if ($eclassf_ccat > 0)
            {
                $eclassf_rsscat = "." . $eclassf_ccat;
                $retval = JOKEMENU_113 . "&nbsp;";
            }
            $eclassf_text .= "
			<tr>
				<td class='forumheader3' style='text-align:center;' colspan='$eclassf_colspan'>
					<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?classifieds.1{$eclassf_rsscat}'><img src='images/rss1.png' alt='RSS 1' title='RSS 1' style='border:0;' /></a>&nbsp;&nbsp;
					<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?classifieds.2{$eclassf_rsscat}'><img src='images/rss1.png' alt='RSS 1' title='RSS 1' style='border:0;' /></a>&nbsp;&nbsp;
					<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?classifieds.3{$eclassf_rsscat}'><img src='images/rss1.png' alt='RSS 1' title='RSS 1' style='border:0;' /></a>&nbsp;&nbsp;
					<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?classifieds.4{$eclassf_rsscat}'><img src='images/rss1.png' alt='RSS 1' title='RSS 1' style='border:0;' /></a>&nbsp;&nbsp;
				</td>
			</tr>
			</table>";
            if ($pref['eclassf_subdrop'] == 1)
            {
                $eclassf_text .= "</form>";
            }
        }
        $eclassf_text .= eclassf_footer();
        break;
}

$ns->tablerender(ECLASSF_1, $eclassf_text);
require_once(FOOTERF);
// .
// functions
// .
function eclassf_footer($eclassf_nextprev)
{
    global $pref, $eclassf_from, $eclassf_action, $eclassf_catid, $eclassf_subid, $eclassf_itemid;
    $eclassf_retval = "
	<table class='fborder' width='97%'>
		<tr>
			<td class='fcaption' style='width:50%;'>";
    if (check_class($pref['eclassf_create']))
    {
        $eclassf_retval .= "<a href='" . e_SELF . "?$eclassf_from.mge.$eclassf_catid.$eclassf_subid.$eclassf_itemid'>" . ECLASSF_17 . "</a>&nbsp;&nbsp;";
    }

    $eclassf_retval .= "<a href='" . e_SELF . "?$eclassf_from.tnc.$eclassf_catid.$eclassf_subid.$eclassf_itemid.$eclassf_action'>" . ECLASSF_41 . "</a>&nbsp;&nbsp;";

    $eclassf_retval .= "
			</td>
			<td class='fcaption' style='width:50%;text-align:right;'>";
    if (!empty($eclassf_nextprev))
    {
        $eclassf_retval .= ECLASSF_42;
    }

    $eclassf_retval .= "&nbsp;$eclassf_nextprev
			</td>
		</tr>
	</table>";
    return $eclassf_retval;
}

function eclassf_makeimg($number, $set)
{
    global $pref;
    $number = str_pad($number, ($pref['eclassf_leadz'] > 0?$pref['eclassf_leadz']:0), "0", STR_PAD_LEFT);
    $retval = "";
    $len = strlen($number);
    $url = "./images/counter/";
    for($pos = 0;$pos < $len;$pos++)
    {
        $retval .= "<img src='" . $url . substr($number, $pos, 1) . "$set.gif' style='border:0;' alt='" . substr($number, $pos, 1) . "' />";
    }
    return $retval;
}
function eclassf_sizeimg($image)
{
    global $pref;
    $size = getimagesize($image);
    $height = $size[1];
    $width = $size[0];
    $maxheight = $pref['eclassf_pich'];
    $maxwidth = $pref['eclassf_picw'];
    if ($height > $maxheight)
    {
        $height = $maxheight;
        $percent = ($size[1] / $height);
        $width = ($size[0] / $percent);
    }
    else if ($width > $maxwidth)
    {
        $width = $maxwidth;
        $percent = ($size[0] / $width);
        $height = ($size[1] / $percent);
    }
    return "<img src=\"$image\" alt='picture of item' style=\"border:0;height:{$height}px;width:{$width}px;\"/>";
}

?>