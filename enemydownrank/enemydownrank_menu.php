<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                          [ ENEMY DOWN RANK ] [ © RICHARD PERRY FROM GREYCUBE.COM ]                         |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 |-------------------------------------------------------------------------------------------------------------
 |        [ EDITOR STYLE SETTINGS: LUCIDA CONSOLE, SIZE 10, TAB = 2 SPACES, BOLD GLOBALLY TURNED OFF ]        |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

  require_once e_PLUGIN."enemydownrank/enemydownrank_parser.php";

  enemydownrank_update();
  
  $output = "<br />";

//------------------------------------------------------------------------------------------------------------+

  $mysql_query       = "SELECT * FROM ".MPREFIX."enemydownrank ORDER BY id ASC";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_result_size = mysql_num_rows($mysql_result);
  
  while($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
  {

//--------------- STYLE CUSTOMISED HERE -------------------+

    $output .= "
    
		<div style='text-align:center'>
		<a rel='external' href='http://www.enemydown.co.uk/clan.php?id={$mysql_row['clan_id']}'>{$mysql_row['clan_name']}</a><br />
		<span style='font-size:20px'>{$mysql_row['ladder_rank']}</span><br />
		<a rel='external' href='http://www.enemydown.co.uk/ladder.php?ladder={$mysql_row['ladder_id']}'>{$mysql_row['ladder_name']}</a><br />
		<br />
		</div>
    
    ";

//---------------------------------------------------------+

  }

  $ns -> tablerender("Enemy Down Rank", $output);

//------------------------------------------------------------------------------------------------------------+

?>