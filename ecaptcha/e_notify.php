<?php

//------------------------------------------------------------------------------------------------------------+

  if (!defined("e107_INIT"))
  {
    exit;
  }

//------------------------------------------------------------------------------------------------------------+

  if (defined("ADMIN_PAGE") && ADMIN_PAGE === TRUE)
  {
    @include_once e_PLUGIN."ecaptcha/languages/".e_LANGUAGE.".php";
    @include_once e_PLUGIN."ecaptcha/languages/English.php";

	  $config_category = LAN_ECAP_NOTIFY_ADMIN_TITLE;
	  $config_events   = array("ecaptcha_moderate" => LAN_ECAP_NOTIFY_ADMIN_INFO);
  }

//------------------------------------------------------------------------------------------------------------+

  if (!function_exists("notify_ecaptcha_moderate"))
  {
    function notify_ecaptcha_moderate($null)
    {
      @include_once e_PLUGIN."ecaptcha/languages/".e_LANGUAGE.".php";
      @include_once e_PLUGIN."ecaptcha/languages/English.php";

      global $nt;

      $message = SITEURLBASE.e_PLUGIN_ABS."ecaptcha/ecaptcha_moderate.php";

      $nt->send("ecaptcha_moderate", LAN_ECAP_NOTIFY_MAIL_TITLE, $message);
    }
  }

//------------------------------------------------------------------------------------------------------------+

?>