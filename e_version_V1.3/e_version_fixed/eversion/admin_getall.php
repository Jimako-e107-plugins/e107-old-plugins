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
// Scan all installed plugin folders to see if there is an e_update file
$evrsn_list_files = array();
$evrsn_pluglist = array();
$evrsn_data = array();
$evrsn_installed = array();
$evrsn_datalist = array();
$evrsn_icons = array("<img src='./images/noprob.png' alt='Blank' title='' />",
    ADMIN_FALSE_ICON,
    ADMIN_UP_ICON,
    ADMIN_TRUE_ICON,
    ADMIN_INFO_ICON,
		ADMIN_WARNING_ICON);

$sql->db_Select("plugin", "*", "where plugin_installflag > 0", "nowhere", false);
while ($evrsn_row = $sql->db_Fetch())
{
    extract($evrsn_row);
      
    $evrsn_filename = e_PLUGIN_ABS.$plugin_path."/e_update.php";
 
		if (file_exists(e_PLUGIN_ABS. $plugin_path."/plugin.xml")) { 
	    $data = e107::getXml()->loadXMLfile(e_PLUGIN_ABS. $plugin_path."/plugin.xml", true);
	    $eplug_name		   = $plugin_path;
	    $plugin_name     = $plugin_path;
	    $eplug_version   = $data['@attributes']['version'];
      $eplug_description = $data['summary']['@attributes']['lan'];
      $eplug_description = constant($eplug_description);
	    $evrsn_plugvsn = explode(".", $eplug_version);
	  }
    elseif (file_exists(e_PLUGIN_ABS.$plugin_path."plugin.php")) {
		 include(e_PLUGIN_ABS . $plugin_path . "/plugin.php");
    }
 
    // Array with plugin version as given by plugin manager - plugin version given in plugin.php
    $evrsn_installed[$plugin_name] = array($plugin_version, $eplug_version);
    
    if (file_exists($evrsn_filename))
    {   
        unset($evrsn_url);
        $evrsn_pluglist[] = trim($plugin_name);
 
        include($evrsn_filename);   
        if (!in_array($evrsn_url, $evrsn_list_files))
        {
            $evrsn_list_files[] = $evrsn_url;

            $evrsn_file = file_get_contents($evrsn_url);
            if ($evrsn_file)
            {
                if (!empty($evrsn_file))
                {
                    $evrsn_data[] = evrsn_xml_parse($evrsn_file);
                }
            }
            else
            {
                // print $plugin_name;
                $evrsn_data[] = array(array("plugin" => trim($plugin_name), "version" => EVERSION_A71, "date" => "", "author" => "", "title" => "", "url" => "", "dlpath" => ""));
            }
            
        }
    }      
} // while
// Strip down to just those plugins which are installed
foreach($evrsn_data as $evrsn_row)
{
    foreach($evrsn_row as $fred)
    {
        if (in_array(trim($fred['plugin']), $evrsn_pluglist))
        {
            // print $fred['plugin'];
            $evrsn_datalist[trim($fred['plugin'])] = $fred;
        }
    }
}
 
sort($evrsn_datalist);
$evrsn_text = "<table class='fborder table adminlist table-striped' style='width:99%'>
<tr><td class='fcaption' colspan=10'>".EVERSION_A74."</td></tr>
		<tr>
			<td style='width:15%' class='forumheader2'>".EVERSION_5." / ".EVERSION_11."</td><td class='forumheader2'></td>
			<td class='forumheader2'>".EVERSION_A72."</td>
			<td class='forumheader2'>".EVERSION_A73."</td>
			<td class='forumheader2'>PM</td>
			<td class='forumheader2'>Get</td><td class='forumheader2'></td>
		</tr>";

foreach($evrsn_datalist as $row)
{
    $now = $evrsn_installed[trim($row['plugin'])][0];
    $pm = $evrsn_installed[trim($row['plugin'])][1];
    $available = $row['version'];
    $result = evrsn_status($available, $now, $pm);
    $evrsn_text .= "
		<tr>
			<td class='forumheader3' style='vertical-align:top;'>" . $row['plugin'] . "<br /><span class='smalltext'>" . $row['title'] . "</span><br />" . $row['author'] . "</td>
			<td class='forumheader3' style='vertical-align:top;'>" ;
    $evrsn_text .= $row['version'] ;

    if ($result&16)
    {
        $evrsn_text .= " (Beta)";
    }
    $evrsn_text .= "</td>
			<td class='forumheader3' style='vertical-align:top;'>" ;
    $fred = false;
    if ($result&64)
    {
        $evrsn_text .= $evrsn_icons[0] . " ";
        $fred = true;
    }
    if ($result&32)
    {
        $evrsn_text .= $evrsn_icons[5] . " ";
        $fred = true;
    }
    if ($result&1 && !$fred)
    {
        $evrsn_text .= $evrsn_icons[2] . " ";
        $fred = true;
    }
    if ($result&2 && !$fred)
    {
        $evrsn_text .= $evrsn_icons[4] . " ";
        $fred = true;
    }

    if (!$fred)
    {
        $evrsn_text .= $evrsn_icons[3] . " ";
    }

    $evrsn_text .= $now ;
    if ($result&8)
    {
        $evrsn_text .= " (Beta)";
    }
    $evrsn_text .= "</td>
			<td class='forumheader3' style='vertical-align:top;'>";
    if ($result&4)
    {
        $evrsn_text .= $evrsn_icons[1] . " ";
    }
    else
    {
        $evrsn_text .= $evrsn_icons[3] . " ";
    }
    $evrsn_text .= $pm . "</td>
<td class='forumheader3' style='vertical-align:top;'>" . (!empty($row['dlpath'])?"<a href='" . $row['dlpath'] . "' target='_blank' >".ADMIN_DOWN_ICON:"&nbsp;") . "</td>
		</tr>";
}
$evrsn_text .= "
		<tr>
			<!--<td colspan='2'class='forumheader3' style='vertical-align:top;'>&nbsp;</td>-->
			
			<td style='width:15%'>" . $evrsn_icons[3] . " ".EVERSION_A75."</td><td style='width:15%'>" . $evrsn_icons[2] . " ".EVERSION_A76."</td><td style='width:25%'>" . $evrsn_icons[4] . " ".EVERSION_A76." (beta)</td>
			<td style='width:10%'>" . $evrsn_icons[3] . " Plugin OK</td><td style='width:20%'>" . $evrsn_icons[1] . " ".EVERSION_A77."</td><td style='width:20%'>" . $evrsn_icons[5] . " ".EVERSION_A78."</td>
			<td class='forumheader3'></td></tr>";
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
        $evrsn_list[$evrsn_counter][$key] = $data;
    }
    if ($key == "dlpath")
    {
        $evrsn_counter++;
    }
}
function evrsn_status($evrsn_onsite, $evrsn_myversion, $evrsn_plugman)
{
    // return
    // bitwise
    // 0 - All OK
    // 1 - Update Available
    // 2 - Update Available but a beta version
    // 4 - Installed version is different to the plugin manager version
    // 8 - Installed version is a beta
    // 16 - Server version is a beta
    // 32 - Installed version is later than available version
    // 64 - Unreachable
    $evrsn_tmpupdate = explode(".", $evrsn_onsite);
    $evrsn_update = ($evrsn_tmpupdate[0] * 1000) + ($evrsn_tmpupdate[1] * 100) + ($evrsn_tmpupdate[2] * 1);
    $evrsn_supdate = ($evrsn_tmpupdate[0] * 1000) + ($evrsn_tmpupdate[1] * 100) ;

    $evrsn_tmpcurrent = explode(".", $evrsn_myversion);
    $evrsn_current = ($evrsn_tmpcurrent[0] * 1000) + ($evrsn_tmpcurrent[1] * 100) + ($evrsn_tmpcurrent[2] * 1);
    $evrsn_scurrent = ($evrsn_tmpcurrent[0] * 1000) + ($evrsn_tmpcurrent[1] * 100);
    $evrsn_nowbeta = false;
    $evrsn_serverbeta = false;
    $evrsn_retval = 0;

    if (intval($evrsn_onsite) == 0)
    {
        $evrsn_retval = $evrsn_retval | 64;
    }
    if ($evrsn_myversion != $evrsn_plugman)
    {
        $evrsn_retval = $evrsn_retval | 4;
    }
    if ($evrsn_tmpcurrent[2] > 0)
    {
        // check if installed version is a beta version
        $evrsn_retval = $evrsn_retval | 8;
        $evrsn_nowbeta = true;
    }
    // Check if beta on server
    if ($evrsn_tmpupdate[2] > 0)
    {
        $evrsn_retval = $evrsn_retval | 16;
        $evrsn_serverbeta = true;
    }

    if (($evrsn_update > $evrsn_current) && !$evrsn_serverbeta && !$evrsn_nowbeta)
    {
        // If server later than  current and neither is a beta
        $evrsn_retval = $evrsn_retval | 1;
    }
    if (($evrsn_update > $evrsn_current) && $evrsn_serverbeta && $evrsn_nowbeta)
    {
        // If server same as  current and both are a beta
        $evrsn_retval = $evrsn_retval | 1;
    }
    if (($evrsn_update > $evrsn_current) && $evrsn_serverbeta && !$evrsn_nowbeta)
    {
        // Update available but a beta version
        $evrsn_retval = $evrsn_retval | 2;
    }
    if (($evrsn_supdate == $evrsn_scurrent) && !$evrsn_serverbeta && $evrsn_nowbeta)
    {
        // Update available not a beta version but installed is
        $evrsn_retval = $evrsn_retval | 1;
    }
    if (($evrsn_update < $evrsn_current))
    {
        // Update available not a beta version but installed is
        $evrsn_retval = $evrsn_retval | 33;
    }
    return $evrsn_retval;
}

?>