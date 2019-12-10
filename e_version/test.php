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
require_once(e_ADMIN . "auth.php");
if (e_LANGUAGE != "English" && file_exists("./languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once("./languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once("./languages/admin/English.php");
} 
$evrsn_xml_file = "http://pssintranet/cgi-bin/e1077/e107_plugins/e_version/xml/eversion.xml";
$asd = evrsn_xml_parse($evrsn_xml_file);
for($x = 0;$x < count($asd);$x++)
{
    echo "\t<h2>" . $asd[$x]->plugin . "</h2>\n";
    echo "\t\t\n";
    echo "\t<i>" . $asd[$x]->version . "</i>\n";
    echo "\t\t\n";
    echo "\t<i>" . $asd[$x]->url . "</i>\n";
    echo "\t\t\n";
    echo "\t<i>" . $asd[$x]->date . "</i>\n";
} 
function evrsn_xml_parse($evrsn_xml_file)
{
    global $current_tag, $evrsn_xml_data, $evrsn_counter, $evrsn_list;
    $evrsn_xml_data = array("plugin" => "*PLUGINS*PLUGIN",
        "version" => "*PLUGINS*VERSION",
        "url" => "*PLUGINS*URL",
        "date" => "*PLUGINS*DATE"); 
    // $story_array = array();
    $evrsn_list = array();
    $evrsn_counter = 0;
    $evrsn_xml_parser = xml_parser_create();

    xml_set_element_handler($evrsn_xml_parser, "evrsn_startTag", "evrsn_endTag");

    xml_set_character_data_handler($evrsn_xml_parser, "evrsn_contents");

    $data = file_get_contents($evrsn_xml_file);
    if (!(xml_parse($evrsn_xml_parser, $data)))
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
    print $current_tag . "<br>";
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
    $evrsn_counter++;
} 

?> 