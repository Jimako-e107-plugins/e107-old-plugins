<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: http://www.dtilmeld.com $
|     
|     All Support entries should be asked directly to DTilmeld.com at our website: https://www.dtilmeld.com
|     All support questions will be answered within 24 hours.
|     
|     $Author: DTilmeld $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	 exit;
}
  $sql->db_Insert("dte_events", "'', '".$_POST['DTEventID']."', '".$_POST['API']."', '".md5($_POST['DTEventID'].$_POST['API'])."', '1'");
echo 1;
?>