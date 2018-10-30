<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Search module: e107_plugins/sgallery/e_search.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_search.php');
$search_info[] = array('sfile' => e_PLUGIN.'sgallery/search/search_parser.php', 'qtype' => SGAL_LANSRCH_1, 'refpage' => e_PLUGIN.'sgallery/gallery.php', 'advanced' => e_PLUGIN.'sgallery/search/search_advanced.php');

?>