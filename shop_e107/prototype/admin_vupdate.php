<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}

if (e_LANGUAGE != "English" && file_exists("./languages/eversion/" . e_LANGUAGE . ".php"))
{
    include_once("./languages/eversion/" . e_LANGUAGE . ".php");
}
else
{
    include_once("./languages/eversion/English.php");
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$evrsn_text = "<table class='fborder' style='".ADMIN_WIDTH."'>";
if (file_exists("plugin.php"))
{
    // if the plugin.php file exists
    if (file_exists("e_update.php"))
    {
        // if the e_update.php file exists
        include("plugin.php");
        include("e_update.php");
        $evrsn_plugvsn=explode(".",$eplug_version);
        $evrsn_text .= "<tr><td class='fcaption'>" . EVERSION_U11 . "</td></tr>
		<tr><td class='forumheader3'>" . EVERSION_U3 . " <strong>" . $eplug_name . "</strong><br />
		" . EVERSION_U4 . " <strong>" . $eplug_version . "</strong> ".($evrsn_plugvsn[2]>0?EVERSION_U8:"")." <br />
		" . EVERSION_U15 . "<strong> " . $eplug_description . "</strong><br />
		</td></tr>
		<tr><td class='fcaption'>" . EVERSION_U12 . "</td></tr>";
        // Get the current installed version from plugin table
        if ($sql->db_Select("plugin", "*", "where plugin_name='{$eplug_name}'", "nowhere", false))
        {
            $evrsn_prow = $sql->db_Fetch();
            $evrsn_pversion = $evrsn_prow['plugin_version'];

            $evrsn_tmp = explode(".", $evrsn_pversion);
            $evrsn_pcurrent = ($evrsn_tmp[0] * 1000) + ($evrsn_tmp[1] * 100) + ($evrsn_tmp[2] * 1);
        }
        // Get the file contents

        $evrsn_content = file_get_contents($evrsn_url);
        if (!empty($evrsn_content))
        {
            // we use the xml version
            $evrsn_data = evrsn_xml_parse($evrsn_content);
            $nplugins = count($evrsn_data);

            foreach ($evrsn_data as $row)
            {

                if (strtolower(trim($row->plugin)) == strtolower($eplug_name))
                {
                    $evrsn_serversion = $row->version;
                    $evrsn_author = $row->author;
                    $evrsn_date = $row->date;
                    $evrsn_url = $row->url;
                }
            } // end for
            if (!empty($evrsn_serversion))
            {
                // if not empty
                $evrsn_tmpupdate = explode(".", $evrsn_serversion);
                $evrsn_update = ($evrsn_tmpupdate[0] * 1000) + ($evrsn_tmpupdate[1] * 100) + ($evrsn_tmpupdate[2] * 1);

                $evrsn_tmpcurrent = explode(".", $eplug_version);
                $evrsn_current = ($evrsn_tmpcurrent[0] * 1000) + ($evrsn_tmpcurrent[1] * 100) + ($evrsn_tmpcurrent[2] * 1);

                if ($evrsn_pcurrent != $evrsn_current)
                {
                    $evrsn_text .= "<tr><td class='forumheader3'><img src='".e_IMAGE."admin_images/upgrade.png' alt='' title='' /> " . EVERSION_U19 . " <strong>" . $evrsn_pversion . "</strong> " . EVERSION_U20 . "</td></tr>";
                }
                $evrsn_nownotbeta = false;
                // Check if now not beta
                if ($evrsn_tmpupdate[2] == 0 && $evrsn_tmpcurrent[2] > 0)
                {
                    $evrsn_nownotbeta = true;
                }
                if ($evrsn_update > $evrsn_current || $evrsn_nownotbeta)
                {
                    // if server version greater than installed version
                    $evrsn_text .= "<tr><td class='forumheader3'><img src='".e_IMAGE."admin_images/uninstalled.png' alt='' title='' /> " . EVERSION_U7 . " - <strong>" . $evrsn_serversion . "</strong>";
                    if ($evrsn_tmpupdate[2] > 0)
                    {
                        // is it a beta version?
                        $evrsn_text .= "<br />" . EVERSION_U8;
                    }
                    else
                    {
                    $evrsn_text .= "<strong> ".EVERSION_U21."</strong>";
                    }
                    if ($evrsn_date > 0)
                    {
                        $evrsn_con = new convert;
                        $evrsn_text .= "<br />" . EVERSION_U17 . " : <strong>" . $evrsn_con->convert_date($evrsn_date, "long") . "</strong><br />";
                    }
                    if (!empty($evrsn_author))
                    {
                        $evrsn_text .= "<br />" . EVERSION_U18 . " : <strong>" . $evrsn_author . "</strong><br />";
                    }
                    if (!empty($evrsn_url))
                    {
                        $evrsn_text .= "<br /><br />" . EVERSION_U13 . " <a href='" . $evrsn_url . "'>" . EVERSION_U14 . "</a><br />&nbsp;";
                    }
                    $evrsn_text .= "</td></tr>";
                }
                else
                {
                    // It is the latest version
                    $evrsn_text .= "<tr><td class='forumheader3'><img src='".e_IMAGE."admin_images/installed.png' alt='' title='' /> " . EVERSION_U9;
                    $evrsn_text .= "<br /><br />" . EVERSION_U13 . " <a href='" . $evrsn_url . "'>" . EVERSION_U14 . "</a><br /></td></tr>";
                }
            }
            else
            {
                // unable to get details from update site
                $evrsn_text .= "<tr><td class='forumheader3'>" . EVERSION_U10 . "</td></tr>";
            }
        }
        else
        {
            // We can not read the file
            $evrsn_text .= "<tr><td class='forumheader3'>" . EVERSION_U6 . "</td></tr>";
        }
    }
    else
    {
        // the e_update.php does not exist
        $evrsn_text .= "<tr><td class='forumheader3'>" . EVERSION_U2 . "</td></tr>";
    }
}
else
{
    // plugin.php does not exist
    $evrsn_text .= "<tr><td class='forumheader3'>" . EVERSION_U1 . "</td></tr>";
}

$evrsn_text .= "</table>";
$ns->tablerender(EVERSION_U16, $evrsn_text);
require_once(e_ADMIN . "footer.php");
function evrsn_xml_parse($evrsn_xml_file)
{
    global $current_tag, $evrsn_xml_data, $evrsn_counter, $evrsn_list;
    $evrsn_xml_data = array("plugin" => "*PLUGINS*PLUGIN",
        "version" => "*PLUGINS*VERSION",
        "date" => "*PLUGINS*DATE",
        "author" => "*PLUGINS*AUTHOR",
        "title" => "*PLUGINS*TITLE",
        "url" => "*PLUGINS*URL",
        "dlpath" => "*PLUGINS*DLPATH"
        );

    $evrsn_list = array();
    $evrsn_counter = 0;
    $evrsn_xml_parser = xml_parser_create();
    xml_set_element_handler($evrsn_xml_parser, "evrsn_startTag", "evrsn_endTag");
    xml_set_character_data_handler($evrsn_xml_parser, "evrsn_contents");
    $data = $evrsn_xml_file;
    if (!(xml_parse($evrsn_xml_parser, $data, true)))
    {
        die("Error on line " . xml_get_current_line_number($evrsn_xml_parser));
    }

    xml_parser_free($evrsn_xml_parser);
    return $evrsn_list;
}

function evrsn_startTag($parser, $data)
{
    global $current_tag;
    $current_tag .= "*$data";
}

function evrsn_endTag($parser, $data)
{
    global $current_tag;
    $tag_key = strrpos($current_tag, '*');
    $current_tag = substr($current_tag, 0, $tag_key);
}

function evrsn_contents($parser, $data)
{
    global $current_tag, $evrsn_xml_data, $evrsn_counter, $evrsn_list;
    $key = array_search($current_tag, $evrsn_xml_data);
    if ($key)
    {
        $evrsn_list[$evrsn_counter]->$key = $data;
    }
    if ($key == "url")
    {
        $evrsn_counter++;
    }
}

?>