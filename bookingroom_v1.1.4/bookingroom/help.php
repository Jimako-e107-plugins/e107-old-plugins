<?php

require_once("../../class2.php"); 
# $Id: help.php,v 1.12 2003/11/21 15:27:13 thierry_bo Exp $

require_once "grab_globals.inc.php";
include "config.inc.php";
include "$dbsys.inc";
include "functions.inc";

#If we dont know the right date then make it up
if(!isset($day) or !isset($month) or !isset($year))
{
	$day   = date("d");
	$month = date("m");
	$year  = date("Y");
}
if(empty($area))
	$area = get_default_area();

print_header($day, $month, $year, $area);




echo "<H3>" . get_vocab("help") . "</H3>\n";


include "site_faq" . $faqfilelang . ".html";

include "trailer.inc";
?>