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

  function enemydownrank_update()
  {
    $mysql_query       = "SELECT * FROM ".MPREFIX."enemydownrank WHERE `timestamp` < '".gmdate("U")."'";
    $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
    $mysql_result_size = mysql_num_rows($mysql_result);
  
    while($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
    {
      $enemydownrank_time = gmdate("U") + rand(600, 900);
      $enemydownrank_html = enemydownrank_html($mysql_row['clan_id'], $mysql_row['ladder_id']);
      $enemydownrank_html = strip_tags($enemydownrank_html);
    
      preg_match_all("/document.write\(\"(.+)\"\)/iU", $enemydownrank_html, $match);
      
      if (!$enemydownrank_html)
      {
        $mysql_row['ladder_rank'] = "OFFLINE";
      }
      elseif (!$match[1][0] || !$match[1][1] || !$match[1][2])
      {
        $mysql_row['ladder_rank'] = "UPDATE";
      }
      else
      {
        $mysql_row['ladder_name'] = mysql_real_escape_string(htmlentities($match[1][0], ENT_QUOTES));
        $mysql_row['ladder_rank'] = mysql_real_escape_string(htmlentities($match[1][1], ENT_QUOTES));
        $mysql_row['clan_name']   = mysql_real_escape_string(htmlentities($match[1][2], ENT_QUOTES));
      }
      
      if (!$mysql_row['clan_name'] || !$mysql_row['ladder_name'])
      {
        $mysql_row['clan_name']   = "CLAN";
        $mysql_row['ladder_name'] = "LADDER";
      }

      $mysql_query2  = "REPLACE INTO ".MPREFIX."enemydownrank (`id`,`timestamp`,`ladder_id`,`ladder_name`,`ladder_rank`,`clan_id`,`clan_name`) VALUES ('{$mysql_row['id']}','{$enemydownrank_time}','{$mysql_row['ladder_id']}','{$mysql_row['ladder_name']}','{$mysql_row['ladder_rank']}','{$mysql_row['clan_id']}','{$mysql_row['clan_name']}')";
      $mysql_result2 = mysql_query($mysql_query2) or die(mysql_error());
    }
  }

//------------------------------------------------------------------------------------------------------------+

  function enemydownrank_html($clan_id, $ladder_id)
  {
    $enemydownrank_host     = "www.enemydown.co.uk";
    $enemydownrank_path     = "ed_clanrank.php?ladder={$ladder_id}&clan={$clan_id}";
    $enemydownrank_referrer = $_SERVER['SERVER_NAME'];
 
    if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec'))
    {
      unset($enemydownrank_curl); $enemydownrank_curl = curl_init();

      curl_setopt($enemydownrank_curl, CURLOPT_HEADER, 0);
      curl_setopt($enemydownrank_curl, CURLOPT_HTTPGET, 1);
      curl_setopt($enemydownrank_curl, CURLOPT_TIMEOUT, 10);
      curl_setopt($enemydownrank_curl, CURLOPT_ENCODING, "");
      curl_setopt($enemydownrank_curl, CURLOPT_FRESH_CONNECT, 1);
      curl_setopt($enemydownrank_curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($enemydownrank_curl, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($enemydownrank_curl, CURLOPT_REFERER, $enemydownrank_referrer);
      curl_setopt($enemydownrank_curl, CURLOPT_URL, $enemydownrank_host."/".$enemydownrank_path); 

      $response = curl_exec($enemydownrank_curl);
      
      curl_close($enemydownrank_curl);
    }
    elseif (function_exists('fsockopen'))
    {
      $fp = @fsockopen($enemydownrank_host, "80", $errno, $errstr, 4);

      if ($fp)
      {
        stream_set_timeout($fp, 0);
        stream_set_blocking($fp, TRUE);

        $response = "";        
        $request  = "";
        $request .= "GET {$enemydownrank_path} HTTP/1.0\r\n";
        $request .= "Host: {$enemydownrank_host}\r\n";
        $request .= "User-Agent: Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.2.1) Gecko/20021204\r\n";
        $request .= "Accept: text/xml,application/xml,application/xhtml+xml,";
        $request .= "text/html;q=0.9,text/plain;q=0.8,video/x-mng,image/png,";
        $request .= "image/jpeg,image/gif;q=0.2,text/css,*/*;q=0.1\r\n";
        $request .= "Accept-Language: en-us, en;q=0.50\r\n";
        $request .= "Accept-Encoding: \r\n";
        $request .= "Accept-Charset: ISO-8859-1, utf-8;q=0.66, *;q=0.66\r\n";
        $request .= "Referer: {$enemydownrank_referrer}\r\n";
        $request .= "Cache-Control: max-age=0\r\n";
        $request .= "Connection: Close\r\n\r\n";

        fwrite($fp, $request);

        while (!feof($fp))
        {
          $response .= fread($fp, 4096);
        }

        fclose($fp);
      }
    }
    else
    {
      echo "ENEMY DOWN RANK PROBLEM: NO CURL OR FSOCKOPEN SUPPORT"; exit;
    }

    return $response;
  }

//------------------------------------------------------------------------------------------------------------+

?>
