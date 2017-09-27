<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");
require_once(e_HANDLER . 'userclass_class.php');
class onthisday
{
    var $otd_admin = false; // admin?
    var $otd_read = false; // read?
    var $otd_submit = false; // submit?
    function onthisday()
    {
        global $OTD_PREF;
        $this->load_prefs();
        $this->otd_admin = check_class($OTD_PREF['otd_adminclass']);
        $this->otd_submit = $this->otd_admin || check_class($OTD_PREF['otd_submitclass']);
        $this->otd_read = $this->otd_submit || check_class($OTD_PREF['otd_readclass']);
    }
    function getdefaultprefs()
    {
        global $OTD_PREF;
        $OTD_PREF = array("otd_showempty" => 1,
            "otd_maxlength" => 30,
            "otd_readclass" => 0,
            "otd_dateformat" => "dmy",
            "otd_submitclass" => 254,
            "otd_adminclass" => 254
            );
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $OTD_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($OTD_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='onthisday'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $OTD_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='onthisday' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($OTD_PREF);
            $sql->db_Insert("core", "'onthisday', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='onthisday' ");
        }
        else
        {
            $OTD_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function otd_calendar($month=1, $day=1)
    {
        global $sql;
    $otd_onthisday = (int)date("d");
    $otd_onthismonth = (int)date("m");
        $selmonth = (int)$month ;
        if ($this->otd_admin)
        {
            // admin so get all
            $otd_where = "where otd_month='{$month}'";
        }
        else
        {
            // not admin so just get mine
            $otd_where = "where otd_month='{$month}' and otd_poster='" . USERID . "'";
        }
        $sql->db_Select("onthisday", "otd_day", "$otd_where", "nowhere", false);
        $otd_activedays = array();
        while ($otd_row = $sql->db_Fetch())
        {
            $otd_activedays[] = $otd_row['otd_day'];
        } // while
        $otd_prev = $month-1;
        $otd_next = $month + 1;
        $otd_months = explode(",", OTD_MONTHS);
        $otd_days = array(0,31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $text .= "
<table style='width:100%;text-align:center;margin-left:auto;margin-right:auto;border-width:1px;border-style:solid;'>";
        if ($month > 1)
        {
            $text .= "
	<tr>
		<td class='forumheader2'><a href='" . e_SELF . "?show.0." . $otd_prev . ".$day'>&lt;</a></td>";
        }
        else
        {
            $text .= "
	<tr>
		<td class='forumheader2'>&nbsp;</td>";
        }
        $text .= "
		<td class='forumheader2' style='text-align:center;' colspan='5'>&nbsp;&nbsp;" . $otd_months[$month] . "&nbsp;&nbsp;</td>";
        if ($month < 12)
        {
            $text .= "
		<td class='forumheader2'><a href='" . e_SELF . "?show.0." . $otd_next . ".$day'>&gt;</a></td>";
        }
        else
        {
            $text .= "
		<td class='forumheader2'>&nbsp;</td>";
        }
        $column = 0;
        $text .= "
	</tr>
	<tr>
		<td class='forumheader2' colspan='7' style='text-align:center;'>";
        for($i = 1;$i < 13;$i++)
        {
            if ($i == $month)
            {
                $otd_m = '<b>' . substr($otd_months[$i], 0, 3) . '</b>';
            }
            else
            {
                $otd_m = substr($otd_months[$i], 0, 3);
            }
            $text .= "&nbsp;<a href='" . e_SELF . "?show.0.$i.$day'>" . $otd_m . "</a>&nbsp;";
        }
        $text .= "
		</td>
	</tr>
	<tr>";

        for ($i = 1;$i <= $otd_days[$month]; $i++)
        {
            if ($column > 6)
            {
                $text .= "
	</tr>
	<tr>";
                $column = 0;
            }
            if ($i == $day)
            {
                $highlight = "background-color:#CC9999; ";
            }
            else
            {
                $highlight = "";
            }
            if($otd_onthisday==$i && $otd_onthismonth==$month)
            {

				$today_highlight='border: double #0000FF;';
            }
            else
            {
				$today_highlight='';
            }

            if (in_array($i, $otd_activedays))
            {
                $otd_active = "*&nbsp;";
            }
            else
            {
                $otd_active = "&nbsp;&nbsp;";
            }
            if ($column == 0 || $column == 6)
            {
                $text .= "
			<td class='forumheader3' style='text-align:right;{$highlight}{$today_highlight}'>$otd_active<a href='" . e_SELF . "?show.0.$month.$i'>" . $i . "</a></td>";
            }
            else
            {
                $text .= "
			<td class='forumheader3' style='text-align:right;{$highlight}{$today_highlight}'>$otd_active<a href='" . e_SELF . "?show.0.$month.$i'>" . $i . "</a></td>";
            }
            $column++;
        }
        if ($column < 7)
        {
            for ($i = $column; $i <= 6; $i++)
            {
                if ($column == 0 || $column == 6)
                {
                    $text .= "
			<td class='forumheader3'>&nbsp;</td>";
                }
                else
                {
                    $text .= "
			<td class='forumheader3'>&nbsp;</td>";
                }
                $column++;
            }
        }
        $text .= "
	</tr>
</table>";
        return $text;
    }
}
