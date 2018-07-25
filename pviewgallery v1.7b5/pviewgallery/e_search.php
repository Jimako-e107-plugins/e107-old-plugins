<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/
// Include pview.class for permission request
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;
	
$search_info[] = array(
   'sfile'     => e_PLUGIN.'pviewgallery/pview_search.php',
   'qtype'     => $PView -> getPView_config("pview_name"),
   'refpage'   => 'pviewgallery.php',
   'id'        => 'pviewgallery'
);
?>