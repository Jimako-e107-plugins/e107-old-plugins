<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                        [ ECAPTCHA PLUGIN ] [ © RICHARD PERRY FROM GREYCUBE.COM ]                           |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 |-------------------------------------------------------------------------------------------------------------
 |        [ EDITOR STYLE SETTINGS: LUCIDA CONSOLE, SIZE 10, TAB = 2 SPACES, BOLD GLOBALLY TURNED OFF ]        |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

  require_once "../../class2.php";
  require_once HEADERF;

  $text = "
  <div style='text-align:center'>
    <br />
    <a href='http://www.greycube.com' style='text-decoration:none'>eCaptcha By Richard Perry</a>
    <br />
    <br />
  </div>";

  $ns->tablerender("", $text);

  require_once FOOTERF;

//------------------------------------------------------------------------------------------------------------+

?>