<?php

  /*---------------------------------------------+
  
  http://docs.php.net/en/security.magicquotes.html
  
  IF GPC THEN REMOVE THE MAGIC QUOTES
  
  IF RUNTIME THEN ISSUE A WARNING

  +---------------------------------------------*/

  if (get_magic_quotes_gpc())
  {
    function cups_stripslashes_deep($value)
    {
      $value = is_array($value) ? array_map('cups_stripslashes_deep', $value) : stripslashes($value);
      return $value;
    }

    $_GET = array_map('cups_stripslashes_deep', $_GET);
    $_POST = array_map('cups_stripslashes_deep', $_POST);
    $_COOKIE = array_map('cups_stripslashes_deep', $_COOKIE);
  }

  if (get_magic_quotes_runtime())
  {
    $text .= "<div style='text-align:center'>
              <br /><b>Warning: PHP Magic Quotes RUNTIME is ON and may cause problems.</b><br />
              </div>";
  }


  /*---------------------------------------------+
  CUPS 0.7 CVS BUG WORKAROUND UNTIL ITS FIXED
  http://e107.org/e107_plugins/bugtrack/bugtrack.php?1375.show
  +---------------------------------------------*/
  $pref[cups_squads] = html_entity_decode($pref[cups_squads], ENT_QUOTES);
  $pref[cups_sides]  = html_entity_decode($pref[cups_sides], ENT_QUOTES);
  
?>