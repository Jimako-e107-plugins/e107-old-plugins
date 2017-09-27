<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$e_wysiwyg = "otd_full";
if ($pref['wysiwyg'])
{
    $WYSIWYG = true;
}
if (isset($_POST['exportit']))
{
    if (!empty($_POST['otdfname']))
    {
        $otd_filename = "./csv/" . $_POST['otdfname'];
        $otd_fh = @fopen($otd_filename, "wt");
        if ($otd_fh)
        {
            $sql->db_Select("onthisday", "*");
            while ($otd_row = $sql->db_Fetch())
            {
                extract($otd_row);
                $otd_date = $otd_year . "-" . $otd_month . "-" . $otd_day;
                $otd_output = "\"" . $tp->toHTML($otd_brief) . "\",\"" . $otd_date . "\",\"" . $tp->toHTML($otd_full) . "\"\n";
                // print $otd_output;
                fwrite($otd_fh, $otd_output);
            } // while
            fclose($otd_fh);
        }
        else
        {
            $otd_msg = OTD_A53;
        }
    }
    else
    {
        $otd_msg = OTD_A52;
    }
}
if (isset($_POST['importit']))
{
    // Import the csv in to the database
    // n
    if (!empty($_POST['otdcsv']))
    {
        if (strpos(strtolower($_POST['otdcsv']), ".ics") > 0)
        {
            $otd_filename = "./csv/" . $_POST['otdcsv'];

            $otd_fh = fopen($otd_filename, "rbt");
            while (!feof($otd_fh))
            {
                $otd_row = fgets($otd_fh, 5000);
                // print $otd_row . "<br />";
                if (strpos($otd_row, "BEGIN:VEVENT") === 0)
                {
                    // print "here";
                    // start parsing an entry
                    $otd_ended = false;
                    while (!$otd_ended && !feof($otd_fh))
                    {
                        // print "there<br>";
                        $otd_event = fgets($otd_fh, 5000);
                        if (strpos($otd_event, "END:VEVENT") === 0)
                        {
                            $otd_ended = true;
                        }
                        // print $otd_event . "<br>";
                        if (substr($otd_event, 0, 8) == "SUMMARY:")
                        {
                            $otd_brief = substr($otd_event, 8);
                        }
                        if (substr($otd_event, 0, 12) == "DESCRIPTION:")
                        {
                            $otd_tmp = substr($otd_event, 12);
                            $otd_full = str_replace("\\n", "<br />" , $otd_tmp);
                            // $otd_full = "W".nl2br($otd_tmp);
                        }
                        if (substr($otd_event, 0, 19) == "DTSTART;VALUE=DATE:")
                        {
                            $otd_date = substr($otd_event, 19);
                            $otd_year = substr($otd_date, 0, 4);
                            $otd_month = substr($otd_date, 4, 2);
                            $otd_day = substr($otd_date, 6, 2);
                        }
                        // DTSTART;VALUE=DATE:20061101
                    } // while
                    $otd_arg = "0,
				'" . $tp->toDB($otd_brief) . "',
				'" . $tp->toDB($otd_day) . "',
				'" . $tp->toDB($otd_month) . "',
				'" . $tp->toDB($otd_year) . "',
				'" . $tp->toDB($otd_full) . "',".USERID;
                    $sql->db_Insert("onthisday", $otd_arg);
                    // print $otd_brief . "<br>" . $otd_full . "<br>" . $otd_year."<br>".$otd_month."<br>".$otd_day."<br>" . "<br><hr>";
                }
            } // while
            fclose($otd_fh);
        }
        else
        {
            $otd_filename = "./csv/" . $_POST['otdcsv'];
            $otd_fh = @fopen($otd_filename, "rbt");

            if ($otd_fh)
            {
                while (!feof($otd_fh))
                {
                    $otd_inarray = fgetcsv($otd_fh, 5000, ",", "\"");
                    $otd_brief = $tp->html_truncate(trim($otd_inarray[0]), 200);
                    if (!empty($otd_brief))
                    {
                        $otd_fulldate = trim($otd_inarray[1]);
                        $otd_full = trim($otd_inarray[2]);
                        $otd_temp = explode("-", $otd_fulldate);
                        $otd_year = $otd_temp[0];
                        // print $otd_row[0]." ".$otd_brief."  ".$otd_year."<br />";
                        $otd_arg = "0,
	'" . $tp->toDB($otd_brief) . "',
	'" . $tp->toDB($otd_temp[2]) . "',
	'" . $tp->toDB($otd_temp[1]) . "',
		'" . $tp->toDB($otd_temp[0]) . "',
		'" . $tp->toDB($otd_full) . "',".USERID;
                        $sql->db_Insert("onthisday", $otd_arg);
                    }
                } // while
                $otd_msg = OTD_A49;
            }
            else
            {
                $otd_msg = OTD_A51;
            }
        }
    }
    else
    {
        $otd_msg = OTD_A50;
    }
        $e107cache->clear("nq_otdmenu");
    $e107cache->clear("otd_display");
}
// First get list of files
$otd_text .= "<form method='post' action='" . e_SELF . "' id='otdform'>
<table class='fborder' style='".ADMIN_WIDTH."'>
<tr><td class='fcaption' colspan='2' >" . OTD_A40 . "</td></tr>";
if (!empty($otd_msg))
{
    $otd_text .= "<tr><td class='forumheader3' colspan='2' ><strong>" . $otd_msg . "</strong></td></tr>";
}

$otd_text .= "<tr><td class='forumheader3' colspan='2' >" . OTD_A44 . "</td></tr>
<tr><td class='fcaption' colspan='2' >" . OTD_A45 . "</td></tr>
<tr><td class='forumheader3' style='width:30%'>" . OTD_A41 . "</td>
<td class='fcaption' style='width:70%'>
<select name='otdcsv' class='tbox'>
<option value=''>" . OTD_A48 . "</option>";
$dir = "./csv";
if ($otd_dirh = opendir($dir))
{
    while (($file = readdir($otd_dirh)) !== false)
    {
        if ($file <> "." && $file <> ".." && $file <> "index.htm")
        {
            $otd_text .= "<option value='" . $file . "'>" . $file . "</option>";
        }
    }
    closedir($otd_dirh);
}

$otd_text .= "</select></td></tr>
<tr><td class='fcaption' colspan='2' ><input type='submit' name='importit' class='tbox' value='" . OTD_A42 . "' /></td></tr>
<tr><td class='fcaption' colspan='2' >" . OTD_A46 . "</td></tr>
<tr><td class='forumheader3'>" . OTD_A47 . "</td>
<td class='forumheader3'><input class='tbox' name='otdfname' style='width:40%;' type='text' /></td></tr>
<tr><td class='fcaption' colspan='2' ><input type='submit' name='exportit' class='tbox' value='" . OTD_A43 . "' /></td></tr>
</table></form>";
$ns->tablerender(OTD_A01, $otd_text);
require_once(e_ADMIN . "footer.php");

?>