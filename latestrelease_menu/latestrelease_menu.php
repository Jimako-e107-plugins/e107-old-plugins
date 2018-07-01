<?php
/*
+---------------------------------------------------------------+
|        Latest Release Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
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
global $tp, $pref,$LATESTRELEASE_PREF, $sql, $e107cache;
if (!is_object($sql))
{
    $sql = new DB;
}
$latedl = $e107cache->retrieve("nq_latestrel", 10);

if ($latedl)
{
    echo $latedl;
}
else
{
    global $tp, $row, $LATESTRELEASE_PREF, $latedl_obj;
    if (!is_object($latedl_obj))
    {
        require_once(e_PLUGIN . 'latestrelease_menu/includes/latest_release_class.php');
        $latedl_obj = new latestrelease;
    }
    include_lan(e_PLUGIN . "latestrelease_menu/languages/" . e_LANGUAGE . ".php");
    // require_once(e_FILE . "shortcode/batch/download_shortcodes.php");
    $latedl_arg = "
	select download_name, download_category, download_id, download_description, download_author, download_filesize, download_requested,download_datestamp,download_class,download_mirror_type,download_category_name from #download
	left join #download_category on download_category=download_category_id
	where find_in_set(download_category_class,'" . USERCLASS_LIST . "') and find_in_set(download_visible,'" . USERCLASS_LIST . "')
	and download_active > 0
	order by  download_datestamp DESC LIMIT 0," . $LATESTRELEASE_PREF['latedl_limitdown'] . "";

    $latedl = '
<script type="text/javascript">
<!--
function latedl_ec(divid) {

	if (document.getElementById(\'latest\'+divid).style.display == \'\')
	{
		document.getElementById(\'latest\'+divid).style.display = \'none\';
	}
	else
	{
		document.getElementById(\'latest\'+divid).style.display = \'\';
	}
}
function latedl_td(divid) {

	if (document.getElementById(\'latesttop\'+divid).style.display == \'\')
	{
		document.getElementById(\'latesttop\'+divid).style.display = \'none\';
	}
	else
	{
		document.getElementById(\'latesttop\'+divid).style.display = \'\';
	}
}
-->
</script>
<table style="width:100%;">
	<tr>
		<td style="width:100%">' . LATESTRELEASE_MENU_LAN_3 . '
			<div id="latedl0" class="fborder">';

    if (!$sql->db_Select_gen($latedl_arg))
    {
        $latedl = '<div id="latedown1" class="fborder">' . LATESTRELEASE_MENU_LAN_1 . '<br />';
        $latedl .= '</div>';
    }
    else
    {
        $latedl_gen = new convert;
        $latedl_imode = (IMODE == "lite"?"lite/":"dark/");
        // make sure there are some defaults
        $LATESTRELEASE_PREF['latedl_thou'] = (empty($LATESTRELEASE_PREF['latedl_thou'])?",":$LATESTRELEASE_PREF['latedl_thou']);
        $LATESTRELEASE_PREF['latedl_dp'] = (empty($LATESTRELEASE_PREF['latedl_dp'])?".":$LATESTRELEASE_PREF['latedl_dp']);
        $LATESTRELEASE_PREF['latedl_class'] = (empty($LATESTRELEASE_PREF['latedl_class'])?"forumheader3":$LATESTRELEASE_PREF['latedl_class']);

        while ($latedl_row = $sql->db_Fetch())
        {
            extract($latedl_row);

            $latedl_dlurl = e_BASE;
            $latedl .= '
		<div  class="forumheader3" >';
            if ($LATESTRELEASE_PREF['latedl_expand'] > 0)
            {
                $latedl .= "
			<div style='width:100%'>
				<div onclick=\"latedl_ec(" . $download_id . ");\" style='cursor:pointer;float:left;width:80%; '>

						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . $tp->toFORM($download_name) . "</span>&nbsp;&nbsp;

				</div>
				<div onclick=\"latedl_ec(" . $download_id . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;' >

						<img id='ldl" . $download_id . "' src='" . e_PLUGIN . "latestrelease_menu/images/expand.png' title='" . LATESTRELEASE_MENU_LAN_9 . "' alt='" . LATESTRELEASE_MENU_LAN_9 . "' style='border:0px;'/>

				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='latest" . $download_id . "' style='display:none' >";
            }

            $latedl_description = $tp->toFORM($tp->html_truncate($download_description, $LATESTRELEASE_PREF['latedl_maxchars'], "<br /><a href='download.php?view." . $download_id . "'><strong>" . LATESTRELEASE_MENU_LAN_42 . "</strong></a>"));
            // =============preference=========================
            $latedl .= "
				<div style='padding:10px' class='" . $LATESTRELEASE_PREF['latedl_class'] . "'>";
            $latedl .= "<img src='" . THEME . "images/bullet2.gif' alt='bullet' /> <a href='" . $latedl_dlurl . "download.php?view." . $download_id . "' title='" . LATESTRELEASE_MENU_LAN_30 . "'><strong>" . $tp->toFORM($download_name) . "</strong></a><br />" .
            ($LATESTRELEASE_PREF['latedl_down_allow_description'] > 0?"<strong>" . LATESTRELEASE_MENU_LAN_29 . ": </strong>" . $latedl_description . "<br />" :"") .
            ($LATESTRELEASE_PREF['latedl_dlcat'] > 0?"<strong>" . LATESTRELEASE_MENU_LAN_48 . ": </strong>" . $tp->toHTML($download_category_name) . "<br />" :"") .
            ($LATESTRELEASE_PREF['latedl_dlauth'] > 0?"<strong>" . LATESTRELEASE_MENU_LAN_5 . "</strong>" . $download_author . " <br />":"") . $latedl_desc ;
            if ($LATESTRELEASE_PREF['latedl_dlbutton'] > 0 && check_class($download_class))
            {
                $latedl .= "<strong>" . LATESTRELEASE_MENU_LAN_4 . "</strong>";
                $agreetext = $tp->toJS($tp->toHTML($pref['agree_text'], false, "parse_sc, defs"));
                if ($download_mirror_type)
                {
                    $latedl .= ($pref['agree_flag'] ? "<a href='" . e_BASE . "download.php?mirror." . $download_id . "' onclick= \"return confirm('{$agreetext}');\">" : "<a href='" . e_BASE . "download.php?mirror." . $download_id . "' >");
                }
                else
                {
                    $latedl .= ($pref['agree_flag'] ? "<a href='" . e_BASE . "request.php?" . $download_id . "' onclick= \"return confirm('{$agreetext}');\">" : "<a href='" . e_BASE . "request.php?" . $download_id . "' >");
                }

                $latedl .= "<img src='" . e_IMAGE . "generic/" . $latedl_imode . "download.png' alt='" . LATESTRELEASE_MENU_LAN_43 . "' title='" . LATESTRELEASE_MENU_LAN_43 . "' style='border:0;width:12px;height:12px;' /></a><br />" ;
            }
            if ($download_filesize >= 1 && $download_filesize < 1000)
            {
                // less than 1k
                $latedl_fsize = number_format($download_filesize , 2, $LATESTRELEASE_PREF['latedl_dp'], $LATESTRELEASE_PREF['latedl_thou']) . ' B';
            } elseif ($download_filesize >= 1000 && $download_filesize < 1000000)
            {
                // between 1k and 1m
                $latedl_fsize = number_format($download_filesize / 1000, 2, $LATESTRELEASE_PREF['latedl_dp'], $LATESTRELEASE_PREF['latedl_thou']) . ' KB';
            } elseif ($download_filesize >= 1000000)
            {
                // over 1mb
                $latedl_fsize = number_format($download_filesize / 1000000, 2, $LATESTRELEASE_PREF['latedl_dp'], $LATESTRELEASE_PREF['latedl_thou']) . ' MB';
            }
            else
            {
                // must be zero then
                $latedl_fsize = '0 B';
            }

            $latedl .=
            ($LATESTRELEASE_PREF['latedl_dlsize'] > 0?'<strong>' . LATESTRELEASE_MENU_LAN_6 . '</strong>' . $latedl_fsize . '<br />' :'') .
            ($LATESTRELEASE_PREF['latedl_dlcount'] > 0?'<strong>' . LATESTRELEASE_MENU_LAN_7 . '</strong>' . $download_requested . '<br />':'') .
            ($LATESTRELEASE_PREF['latedl_dlstamp'] > 0?'<strong>' . LATESTRELEASE_MENU_LAN_8 . '</strong>' . $latedl_gen->convert_date($download_datestamp, 'short') . '<br />':'');
            $latedl .= "
				</div>";
            if ($LATESTRELEASE_PREF['latedl_expand'] > 0)
            {
                $latedl .= '</div>
			';
            }

            $latedl .= '
		</div>';
        }
    }
    $latedl .= '
			</div>
		</td>
	</tr>';
    if ($LATESTRELEASE_PREF['latedl_top'] > 0)
    {
        $latedl .= '
    	<tr>
		<td style="width:100%">' . LATESTRELEASE_MENU_LAN_46 . '
			<div id="latedl0t" class="fborder">';
        $latedl_arg = "
	select download_name, download_category, download_id, download_description, download_author, download_filesize, download_requested,download_datestamp,download_class,download_mirror_type,download_category_name from #download
	left join #download_category on download_category=download_category_id
	where find_in_set(download_category_class,'" . USERCLASS_LIST . "') and find_in_set(download_visible,'" . USERCLASS_LIST . "')
	and download_active > 0
	order by  download_requested DESC LIMIT 0," . $LATESTRELEASE_PREF['latedl_top'] ;
        if (!$sql->db_Select_gen($latedl_arg))
        {
            $latedl = '<div id="latedown1" class="fborder">' . LATESTRELEASE_MENU_LAN_1 . '<br />';
            $latedl .= '</div>';
        }
        else
        {
            $LATESTRELEASE_PREF['latedl_thou'] = (empty($LATESTRELEASE_PREF['latedl_thou'])?",":$LATESTRELEASE_PREF['latedl_thou']);
            $LATESTRELEASE_PREF['latedl_dp'] = (empty($LATESTRELEASE_PREF['latedl_dp'])?".":$LATESTRELEASE_PREF['latedl_dp']);
            $LATESTRELEASE_PREF['latedl_class'] = (empty($LATESTRELEASE_PREF['latedl_class'])?"forumheader3":$LATESTRELEASE_PREF['latedl_class']);

            while ($latedl_row = $sql->db_Fetch())
            {
                extract($latedl_row);

                $latedl_dlurl = e_BASE;
                $latedl .= '
		<div  class="forumheader3" >';
                if ($LATESTRELEASE_PREF['latedl_expand'] > 0)
                {
                    $latedl .= "
			<div style='width:100%'>
				<div onclick=\"latedl_td(" . $download_id . ");\" style='cursor:pointer;float:left;width:80%; '>

						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . $tp->toFORM($download_name) . "</span>&nbsp;&nbsp;

				</div>
				<div onclick=\"latedl_td(" . $download_id . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;' >

						<img id='ldlt" . $download_id . "' src='" . e_PLUGIN . "latestrelease_menu/images/expand.png' title='" . LATESTRELEASE_MENU_LAN_9 . "' alt='" . LATESTRELEASE_MENU_LAN_9 . "' style='border:0px;'/>

				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='latesttop" . $download_id . "' style='display:none' >";
                }

                $latedl_description = $tp->toFORM($tp->html_truncate($download_description, $LATESTRELEASE_PREF['latedl_maxchars'], "<br /><a href='download.php?view." . $download_id . "'><strong>" . LATESTRELEASE_MENU_LAN_42 . "</strong></a>"));
                // =============preference=========================
                $latedl .= "
				<div style='padding:10px' class='" . $LATESTRELEASE_PREF['latedl_class'] . "'>";
                $latedl .= "<img src='" . THEME . "images/bullet2.gif' alt='bullet' /> <a href='" . $latedl_dlurl . "download.php?view." . $download_id . "' title='" . LATESTRELEASE_MENU_LAN_30 . "'><strong>" . $tp->toFORM($download_name) . "</strong></a><br />" .
                ($LATESTRELEASE_PREF['latedl_down_allow_description'] > 0?"<strong>" . LATESTRELEASE_MENU_LAN_29 . ": </strong>" . $latedl_description . "<br />" :"") .
                ($LATESTRELEASE_PREF['latedl_dlcat'] > 0?"<strong>" . LATESTRELEASE_MENU_LAN_48 . ": </strong>" . $tp->toHTML($download_category_name) . "<br />" :"") .
                ($LATESTRELEASE_PREF['latedl_dlauth'] > 0?"<strong>" . LATESTRELEASE_MENU_LAN_5 . "</strong>" . $download_author . " <br />":"") . $latedl_desc ;
                if ($LATESTRELEASE_PREF['latedl_dlbutton'] > 0 && check_class($download_class))
                {
                    $latedl .= "<strong>" . LATESTRELEASE_MENU_LAN_4 . "</strong>";
                    $agreetext = $tp->toJS($tp->toHTML($pref['agree_text'], false, "parse_sc, defs"));
                    if ($download_mirror_type)
                    {
                        $latedl .= ($pref['agree_flag'] ? "<a href='" . e_BASE . "download.php?mirror." . $download_id . "' onclick= \"return confirm('{$agreetext}');\">" : "<a href='" . e_BASE . "download.php?mirror." . $download_id . "' >");
                    }
                    else
                    {
                        $latedl .= ($pref['agree_flag'] ? "<a href='" . e_BASE . "request.php?" . $download_id . "' onclick= \"return confirm('{$agreetext}');\">" : "<a href='" . e_BASE . "request.php?" . $download_id . "' >");
                    }

                    $latedl .= "<img src='" . e_IMAGE . "generic/" . $latedl_imode . "download.png' alt='" . LATESTRELEASE_MENU_LAN_43 . "' title='" . LATESTRELEASE_MENU_LAN_43 . "' style='border:0;width:12px;height:12px;' /></a><br />" ;
                }
                if ($download_filesize >= 1 && $download_filesize < 1000)
                {
                    // less than 1k
                    $latedl_fsize = number_format($download_filesize , 2, $LATESTRELEASE_PREF['latedl_dp'], $LATESTRELEASE_PREF['latedl_thou']) . ' B';
                } elseif ($download_filesize >= 1000 && $download_filesize < 1000000)
                {
                    // between 1k and 1m
                    $latedl_fsize = number_format($download_filesize / 1000, 2, $LATESTRELEASE_PREF['latedl_dp'], $LATESTRELEASE_PREF['latedl_thou']) . ' KB';
                } elseif ($download_filesize >= 1000000)
                {
                    // over 1mb
                    $latedl_fsize = number_format($download_filesize / 1000000, 2, $LATESTRELEASE_PREF['latedl_dp'], $LATESTRELEASE_PREF['latedl_thou']) . ' MB';
                }
                else
                {
                    // must be zero then
                    $latedl_fsize = '0 B';
                }

                $latedl .=
                ($LATESTRELEASE_PREF['latedl_dlsize'] > 0?'<strong>' . LATESTRELEASE_MENU_LAN_6 . '</strong>' . $latedl_fsize . '<br />' :'') .
                ($LATESTRELEASE_PREF['latedl_dlcount'] > 0?'<strong>' . LATESTRELEASE_MENU_LAN_7 . '</strong>' . $download_requested . '<br />':'') .
                ($LATESTRELEASE_PREF['latedl_dlstamp'] > 0?'<strong>' . LATESTRELEASE_MENU_LAN_8 . '</strong>' . $latedl_gen->convert_date($download_datestamp, 'short') . '<br />':'');
                $latedl .= "
				</div>";
                if ($LATESTRELEASE_PREF['latedl_expand'] > 0)
                {
                    $latedl .= '</div>
			';
                }

                $latedl .= '
		</div>';
            }
            $latedl .= '
			</div>
		</td>
	</tr>';
        }
    }
    $latedl .= '
</table>';
    ob_start();
    $ns->tablerender(LATESTRELEASE_MENU_LAN_45, $latedl);
    $latedl_cache = ob_get_flush();
    $e107cache->set('nq_latestrel', $latedl_cache);
}
