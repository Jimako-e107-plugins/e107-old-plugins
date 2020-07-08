<?php

//------------------------------------------------------------------------------------------------------------+

  $eplug_admin = TRUE;

  require_once "../../class2.php";

  if (!getperms("P")) { echo "YOU DO NOT HAVE PERMISSION TO CONFIGURE LGSL"; exit; }

  require_once e_ADMIN."auth.php";

//------------------------------------------------------------------------------------------------------------+

  define("LGSL_ADMIN", "1");

  $output = "";

  require "lgsl_files/lgsl_admin.php";

  $ns -> tablerender("Live Game Server List", $output);

  $output = "";

//------------------------------------------------------------------------------------------------------------+

  require_once e_ADMIN."footer.php";

//------------------------------------------------------------------------------------------------------------+

?>