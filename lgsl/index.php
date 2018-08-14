<?php

//------------------------------------------------------------------------------------------------------------+

  require_once "../../class2.php";

  require_once HEADERF;

//------------------------------------------------------------------------------------------------------------+

  $output = "";

  if (isset($_GET['s']) && is_numeric($_GET['s']))
  {
    require "lgsl_files/lgsl_details.php";
  }
  elseif (isset($_GET['s']) && $_GET['s'] == "add")
  {
    require "lgsl_files/lgsl_add.php";
  }
  else
  {
    require "lgsl_files/lgsl_list.php";
  }

  $ns -> tablerender($lgsl_config['title'][0], $output);

  unset($output);

//------------------------------------------------------------------------------------------------------------+

  require_once FOOTERF;

//------------------------------------------------------------------------------------------------------------+

?>
