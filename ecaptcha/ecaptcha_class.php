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

  set_magic_quotes_runtime("0"); // TURN OFF MAGIC QUOTES RUNTIME

  @include_once e_PLUGIN."ecaptcha/languages/".e_LANGUAGE.".php";
  @include_once e_PLUGIN."ecaptcha/languages/English.php";

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_show($ecaptcha_key, $ecaptcha_code, $ecaptcha_display)
  {
    global $pref, $ecaptcha_type;

    if (!$ecaptcha_key)
    {
      $ecaptcha_type    = "";
      $ecaptcha_info    = "";
      $ecaptcha_object  = "<b>".LAN_ECAP_EXPIRED."</b>";
      $ecaptcha_input   = "";
      $ecaptcha_display = "";
    }

    if ($pref['ecaptcha_cookie'] && !$_COOKIE['e107_tdSetTime'])
    {
      $ecaptcha_type    = "";
      $ecaptcha_info    = "";
      $ecaptcha_object  = "<b>".LAN_ECAP_COOKIE."</b>";
      $ecaptcha_input   = "";
      $ecaptcha_display = "";
    }

//-----------------------------------------------------+

    if ($ecaptcha_type == "invisible")
    {
      $_POST['ecaptcha_key']  = $ecaptcha_key;
      $_POST['ecaptcha_code'] = $ecaptcha_code;
      ecaptcha_validate();
      return;
    }

    if ($ecaptcha_type == "image_audio" || $ecaptcha_type == "image")
    {
      $ecaptcha_input = "
      ".LAN_ECAP_INPUT_TYPE."
      <input class='tbox'   type='text'   name='ecaptcha_code'   value='' size='10' maxlength='10' />
      <input class='button' type='submit' name='ecaptcha_submit' value='".LAN_ECAP_INPUT_SUBMIT."' /> ";

      if ($ecaptcha_type == "image_audio" && $_POST['ecaptcha_audio'])
      {
        $ecaptcha_info   = LAN_ECAP_INFO_AUDIO." ".LAN_ECAP_INFO_CASE;
        $ecaptcha_image  = ecaptcha_image($ecaptcha_code, $ecaptcha_key);
        $ecaptcha_audio  = ecaptcha_audio($ecaptcha_code, $ecaptcha_key);
        $ecaptcha_object = "
        <object type='application/x-shockwave-flash' data='".e_PLUGIN."ecaptcha/ecaptcha_flash.swf' width='480px' height='100px'>
          <param name='menu'  value='false'>
          <param name='movie' value='".e_PLUGIN."ecaptcha/ecaptcha_flash.swf' />
          <param name='flashvars' value='key_path=".e_PLUGIN."ecaptcha/key_files/{$ecaptcha_key}' />
        </object>";
        $ecaptcha_input .= "
        <a href='".e_PLUGIN."ecaptcha/key_files/{$ecaptcha_key}.mp3'>".LAN_ECAP_AUDIO_DOWNLOAD."</a>
        <input type='hidden' name='ecaptcha_audio' value='1' />";
      }
      else
      {
        if ($ecaptcha_type == "image_audio")
        {
          $ecaptcha_input .= "
          <input class='button' type='submit' name='ecaptcha_audio_enable' value='".LAN_ECAP_AUDIO_HELP."' />
          <input type='hidden' name='ecaptcha_audio' value='0' />";
        }

        $ecaptcha_info   = LAN_ECAP_INFO_IMAGE." ".LAN_ECAP_INFO_CASE;
        $ecaptcha_image  = ecaptcha_image($ecaptcha_code, $ecaptcha_key);
        $ecaptcha_object = "<img src='{$ecaptcha_image}' alt='' />";
      }

      if ($_POST['ecaptcha_incorrect'] && !$_POST['ecaptcha_audio_enable'])
      {
        $ecaptcha_info = LAN_ECAP_TRYAGAIN." - ".LAN_ECAP_TYPED." ' ".ecaptcha_html($_POST['ecaptcha_incorrect'])." ' ".LAN_ECAP_NEEDED." ' ".ecaptcha_html($_POST['ecaptcha_correct'])." '";
      }
    }

//-----------------------------------------------------+

    elseif ($ecaptcha_type == "recaptcha")
    {
      global $pref; if (!$pref['ecaptcha_recaptcha_public']) { exit(LAN_ECAP_ERROR_PUBLIC_KEY); }

      $ecaptcha_info   = LAN_ECAP_INFO_RECAPTCHA;
      $ecaptcha_object = "
      <script type='text/javascript' src='http://api.recaptcha.net/challenge?k={$pref['ecaptcha_recaptcha_public']}&amp;error={$_POST['ecaptcha_incorrect']}'></script>
      <noscript>".LAN_ECAP_JAVASCRIPT."<br /></noscript>";
      $ecaptcha_input  = "
      <input class='button' type='submit' name='ecaptcha_submit' value='".LAN_ECAP_INPUT_SUBMIT."' /> ";
    }

//-----------------------------------------------------+

    elseif ($ecaptcha_type == "button")
    {
      $ecaptcha_info   = LAN_ECAP_INFO_BUTTON;
      $ecaptcha_object = "";
      $ecaptcha_input  = "
      <input class='button' type='submit' name='ecaptcha_submit' value='".LAN_ECAP_INPUT_SUBMIT."' />
      <input type='hidden' name='ecaptcha_code' value='{$ecaptcha_code}' />";
    }

//-----------------------------------------------------+

    require e_PLUGIN."ecaptcha/ecaptcha_template.php";

    $ecaptcha_display = preg_replace("/\[ecaptcha.*\]/iU",   "", $ecaptcha_display);
    $ecaptcha_display = preg_replace("/\[\/ecaptcha.*\]/iU", "", $ecaptcha_display);
    $ecaptcha_display = preg_replace("/\[ecaptcha=/iU",      "", $ecaptcha_display);

    $ecaptcha_template_form = str_replace(
    array("{TEMPLATE_KEY}", "{TEMPLATE_INFO}", "{TEMPLATE_OBJECT}", "{TEMPLATE_INPUT}", "{TEMPLATE_DISPLAY}"),
    array( $ecaptcha_key,    $ecaptcha_info,    $ecaptcha_object,    $ecaptcha_input,    $ecaptcha_display), $ecaptcha_template_form);

    if ($pref['ecaptcha_style'] == "2")
    {
      global $HEADER, $FOOTER, $sql, $tp, $ns, $register_sc;

      define(THEME, e_THEME.$pref['sitetheme']."/");
      define(THEME_ABS, e_THEME_ABS.$pref['sitetheme']."/");
      class e107table  {function tablerender($c,$t,$m="",$r="") {}}
      class e107_table {}
      $ns = new e107table;
      require_once e_THEME.$pref['sitetheme']."/theme.php";
      require_once e_THEME."templates/header_default.php";
      tablestyle(LAN_ECAP_TABLE_TITLE, $ecaptcha_template_form);
      require_once e_THEME."templates/footer_default.php";
    }
    else
    {
      if ($pref['ecaptcha_style'] == "1")
      {
        $ecaptcha_template_header = str_replace("{TEMPLATE_CSS}", "", $ecaptcha_template_header);
      }
      else
      {
        $ecaptcha_template_css    = $pref['themecss'] ? $pref['themecss'] : "style.css";
        $ecaptcha_template_header = str_replace("{TEMPLATE_CSS}", "
        <link rel='stylesheet' href='".e_THEME_ABS."{$pref['sitetheme']}/{$ecaptcha_template_css}' type='text/css' media='all' />
        <link rel='stylesheet' href='".e_FILE_ABS."e107.css' type='text/css' />", $ecaptcha_template_header);
      }

      echo $ecaptcha_template_header.$ecaptcha_template_form.$ecaptcha_template_footer;
    }

    exit;
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_check($ecaptcha_display)
  {
    global $pref, $ecaptcha_type, $ecaptcha_key;

    if (!$ecaptcha_type || $_POST['ecaptcha_force']) { return; }

    $_POST['ecaptcha_force'] = $ecaptcha_display;

    $ecaptcha_key       = ecaptcha_generate("key");
    $ecaptcha_code      = ecaptcha_generate("code");
    $ecaptcha_post      = serialize($_POST);
    $ecaptcha_ip        = getip();
    $ecaptcha_timestamp = time();

    $ecaptcha_code = mysql_real_escape_string($ecaptcha_code);
    $ecaptcha_post = mysql_real_escape_string($ecaptcha_post);
    $ecaptcha_ip   = mysql_real_escape_string($ecaptcha_ip);

    $mysql_query  = "INSERT INTO ".MPREFIX."ecaptcha (`key`,`code`,`post`,`ip`,`timestamp`) VALUES ('{$ecaptcha_key}','{$ecaptcha_code}','{$ecaptcha_post}','{$ecaptcha_ip}','{$ecaptcha_timestamp}')";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());

    echo "
    <div style='width:90%; text-align:center'>
      <div style='height:100px'><br /></div>
      <form method='post' action='' id='ecaptcha_form'>
        <input type='hidden' name='ecaptcha_reload'   value='{$ecaptcha_key}' />
        <input type='submit' name='ecaptcha_continue' value='".LAN_ECAP_JAVASCRIPT_CONTINUE."' />
      </form>
      <script type='text/javascript'>
      window.onload = function() { document.forms.ecaptcha_form.submit(); }
      </script>
    </div>";

    exit;
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_scan()
  {
    global $pref, $ecaptcha_type, $ecaptcha_triggers;

    if (USER && $pref['ecaptcha_file_bypass'])
    {
      foreach ($_FILES as $form => $file)
      {
        foreach ($file['size'] as $size)
        {
          if ($size > 1)
          {
            return;
          }
        }
      }
    }

    foreach ($ecaptcha_triggers as $trigger => $required)
    {
      if (!isset($_POST[$trigger]))
      {
        continue;
      }

      foreach ($required as $required_key => $required_value)
      {
        if (is_array($required_value))
        {
          foreach ($required_value as $value)
          {
            if (!$_POST[$required_key][$value])
            {
              continue 3;
            }
          }
        }
        elseif (!$_POST[$required_value])
        {
          continue 2;
        }
      }

      $ecaptcha_key       = ecaptcha_generate("key");
      $ecaptcha_code      = ecaptcha_generate("code");
      $ecaptcha_post      = serialize($_POST);
      $ecaptcha_ip        = getip();
      $ecaptcha_timestamp = time();
      $ecaptcha_display   = $_POST[$required[0]];

      $ecaptcha_code = mysql_real_escape_string($ecaptcha_code);
      $ecaptcha_post = mysql_real_escape_string($ecaptcha_post);
      $ecaptcha_ip   = mysql_real_escape_string($ecaptcha_ip);

      $mysql_query  = "INSERT INTO ".MPREFIX."ecaptcha (`key`,`code`,`post`,`ip`,`timestamp`) VALUES ('{$ecaptcha_key}','{$ecaptcha_code}','{$ecaptcha_post}','{$ecaptcha_ip}','{$ecaptcha_timestamp}')";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());

      ecaptcha_show($ecaptcha_key, $ecaptcha_code, $ecaptcha_display);

      return;
    }
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_validate()
  {
    global $pref, $ecaptcha_type, $ecaptcha_triggers;

    $ecaptcha_key = mysql_real_escape_string($_POST['ecaptcha_key']);
    $mysql_result = mysql_query("SELECT * FROM ".MPREFIX."ecaptcha WHERE `key` = '{$ecaptcha_key}' LIMIT 1") or die(mysql_error());
    $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);

    if (!$mysql_row) { ecaptcha_show("", "", ""); } // KEY HAS EXPIRED

    ecaptcha_clear($ecaptcha_key);

    if ($ecaptcha_type == "recaptcha")
    {
      $response = ecaptcha_validate_recaptcha();

      if ($response[0] == "true")
      {
        $_POST = unserialize($mysql_row['post']);
        ecaptcha_inspect();
        return;
      }

      $_POST = unserialize($mysql_row['post']);
      $_POST['ecaptcha_incorrect'] = $response[1];
      ecaptcha_scan();
      return;
    }

    if ($_POST['ecaptcha_audio_enable'])
    {
      $_POST = unserialize($mysql_row['post']);
      $_POST['ecaptcha_audio'] = "1";
      ecaptcha_scan();
      return;
    }

    $ecaptcha_code  = strtolower($mysql_row['code']);
    $submitted_code = strtolower($_POST['ecaptcha_code']);

    if ($submitted_code == $ecaptcha_code)
    {
      $_POST = unserialize($mysql_row['post']);
      ecaptcha_inspect();
      return;
    }

    $_POST = unserialize($mysql_row['post']);
    $_POST['ecaptcha_correct']   = $ecaptcha_code;
    $_POST['ecaptcha_incorrect'] = $submitted_code;
    ecaptcha_scan();
    return;
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_inspect()
  {
    global $pref;
    
    if ($_POST['ecaptcha_force']) { return; }

    $content_array = array("forum" => "post", "comments" => "comment");
    $search_array  = array("http:\/\/", "\[url\](?:(?!http).)", "\[url=(?:(?!http).)", "\[link\](?:(?!http).)", "\[link=(?:(?!http).)", " href=[^h][^h]");

    foreach ($content_array as $area => $content)
    {
      if (!isset($_POST[$content])) { continue; }

      if ($pref['ecaptcha_hotfix_charset'])
      {
        $_POST[$content] = function_exists("mb_convert_encoding") ? @mb_convert_encoding($_POST[$content], "UTF-8", "auto") : preg_replace("/[^\x20-\x7E]/", "", $_POST[$content]);
      }

      $_POST[$content] = preg_replace("/\[ecaptcha.*\]/iU",   "", $_POST[$content]);
      $_POST[$content] = preg_replace("/\[\/ecaptcha.*\]/iU", "", $_POST[$content]);
      $_POST[$content] = preg_replace("/\[ecaptcha=/iU",      "", $_POST[$content]);

      $search_count = 0;

      foreach ($search_array as $search)
      {
        preg_match_all("/{$search}/iU", $_POST[$content], $matches);

        $search_count += count($matches[0]);
      }

      if ($search_count > intval($pref['ecaptcha_links_'.$area.'_'.(USER ? "members" : "guests")]))
      {
        $pref['ecaptcha_notify_check'] = "1"; save_prefs();

        $_POST[$content] = "[ecaptcha=".getip()."_".(defined("USERID") ? USERID : "0")."_{$area}_".time()."]\r\r\r".trim($_POST[$content])."\r\r\r[/ecaptcha]";
      }
    }
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_clear($ecaptcha_key)
  {
    $mysql_result = mysql_query("DELETE FROM ".MPREFIX."ecaptcha WHERE `key` = '{$ecaptcha_key}' LIMIT 1") or die(mysql_error());

    @unlink(e_PLUGIN."ecaptcha/key_files/{$ecaptcha_key}.png");
    @unlink(e_PLUGIN."ecaptcha/key_files/{$ecaptcha_key}.mp3");

    $ecaptcha_timestamp = time() - 240; // SECONDS = 4 MINS BEFORE CODES EXPIRE
    $mysql_result       = mysql_query("SELECT `key` FROM ".MPREFIX."ecaptcha WHERE `timestamp` < '{$ecaptcha_timestamp}'") or die(mysql_error());

    while ($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
    {
      @unlink(e_PLUGIN."ecaptcha/key_files/{$mysql_row['key']}.png");
      @unlink(e_PLUGIN."ecaptcha/key_files/{$mysql_row['key']}.mp3");
    }

    $mysql_result = mysql_query("DELETE FROM ".MPREFIX."ecaptcha WHERE `timestamp` < '{$ecaptcha_timestamp}'") or die(mysql_error());
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_generate($type)
  {
    if ($type == "key")
    {
      return md5(time().$_SERVER['REMOTE_ADDR'].rand(0,9999));
    }

    global $pref;

    $character_list = "abcdefghkmnprstwxyzABCDEFGHKLMNPRSTWXYZ2346789"; // DIFFICULT CHARACTERS REMOVED
    $list_length    = strlen($character_list);
    $code_length    = rand($pref['ecaptcha_length_min'], $pref['ecaptcha_length_max']);

    for ($i=0; $i<$code_length; $i++)
    {
      $character_position = rand(0, $list_length - 1);
      $string .= $character_list[$character_position];
    }

    return $string;
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_image($ecaptcha_code, $ecaptcha_key)
  {
    $image_filename = e_PLUGIN."ecaptcha/key_files/{$ecaptcha_key}.png";

    if (file_exists($image_filename)) { return $image_filename; }
    if (!function_exists("imagepng")) { exit(LAN_ECAP_ERROR_GD); }
    if (!function_exists("ImageTTFText")) { exit(LAN_ECAP_ERROR_TTF); }
    if (!is_writable(e_PLUGIN."ecaptcha/key_files/")) { exit(LAN_ECAP_ERROR_WRITABLE); }

 //-----------------------------------------------------+

    $image_width     = 480;
    $image_height    = 100;

    $distortx_min    = 10;
    $distortx_max    = 20;
    $distorty_min    = 5;
    $distorty_max    = 10;

    $font_size_min   = 50;
    $font_size_max   = 70;
    $font_rotate_min = -50;
    $font_rotate_max = 50;
    $font_path_array = glob(e_PLUGIN."ecaptcha/font/*.ttf");

//-----------------------------------------------------+

    $image            = imagecreate($image_width, $image_height);
    $color_background = imagecolorallocate($image, 245, 245, 245);
    $color_font       = imagecolorallocate($image, 10, 10, 80);

//-----------------------------------------------------+

    $characters = strlen($ecaptcha_code);

    for ($i=0; $i<$characters; $i++)
    {
      $font_path = $font_path_array[rand(0, count($font_path_array) - 1)];
      $character = $ecaptcha_code[$i];
      $rotation  = rand($font_rotate_min, $font_rotate_max);
      $font_size = rand($font_size_min, $font_size_max);
      $font_x    = (($image_width - $font_size) / $characters) * $i + ($font_size / 2);
      $font_y    = ($image_height + $font_size) / 2;

      ImageTTFText($image, $font_size, $rotation, $font_x, $font_y, -$color_font, $font_path, $character);
    }

//-----------------------------------------------------+

    $temp_width  = $image_width  * 2;
    $temp_height = $image_height * 2;

    $distortx = rand($distortx_min, $distortx_max);
    $distorty = rand($distorty_min, $distorty_max);

    $temp_image = imagecreatetruecolor($temp_width, $temp_height);

    imagecopyresampled($temp_image, $image, 0, 0, 0, 0, $temp_width, $temp_height, $image_width, $image_height);

    for ($i = 0; $i < $temp_width; $i++)
    {
      imagecopy($temp_image, $temp_image, $i - 1, (sin($i / $distortx) * $distorty), $i, 0, 1, $temp_height);
    }

    imagecopyresampled($image, $temp_image, 0, 0, 0, 0, $image_width, $image_height, $temp_width, $temp_height);
    imagedestroy($temp_image);

//-----------------------------------------------------+

    imagepng($image,$image_filename);
    imagedestroy($image);

    return $image_filename;
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_audio($ecaptcha_code, $ecaptcha_key)
  {
    $audio_filename = e_PLUGIN."ecaptcha/key_files/{$ecaptcha_key}.mp3";

    if (file_exists($audio_filename))
    {
      return $audio_filename;
    }

    $ecaptcha_code = strtolower($ecaptcha_code);

//-----------------------------------------------------+

    $character_binary = file_get_contents(e_PLUGIN."ecaptcha/audio/silence.mp3");

    for ($i=0; $i<strlen($ecaptcha_code); $i++)
    {
      $character_binary .= file_get_contents(e_PLUGIN."ecaptcha/audio/{$ecaptcha_code[$i]}.mp3");
      $character_binary .= file_get_contents(e_PLUGIN."ecaptcha/audio/silence.mp3");
    }

//-----------------------------------------------------+

    $handle = fopen($audio_filename, 'w');

    fwrite($handle, $character_binary);

    fclose($handle);

    return $audio_filename;
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_html($string)
  {
    $string = get_magic_quotes_gpc() ? stripslashes($string) : $string;

    if (function_exists("mb_convert_encoding")) // REQUIRES http://php.net/mbstring
    {
      $string = htmlspecialchars($string, ENT_QUOTES);
      $string = mb_convert_encoding($string,"HTML-ENTITIES","auto");
    }
    elseif (CHARSET == "utf-8")
    {
      $string = utf8_decode($string);
      $string = htmlentities($string, ENT_QUOTES);
    }
    else
    {
      $string = htmlspecialchars($string, ENT_QUOTES);
    }

    return $string;
  }

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_validate_recaptcha()
  {
    global $pref; if (!$pref['ecaptcha_recaptcha_private']) { exit(LAN_ECAP_ERROR_PRIVATE_KEY); }

    $private_key = urlencode(stripslashes($pref['ecaptcha_recaptcha_private']));
    $remote_ip   = urlencode(stripslashes($_SERVER['REMOTE_ADDR']));
    $challenge   = urlencode(stripslashes($_POST['recaptcha_challenge_field']));
    $response    = urlencode(stripslashes($_POST['recaptcha_response_field']));

    if (!$private_key || !$remote_ip || !$challenge || !$response)
    {
      return array("0"=>"false", "1"=>"incorrect-captcha-sol");
    }

    $http_data     = "privatekey={$private_key}&remoteip={$remote_ip}&challenge={$challenge}&response={$response}";
    $http_request  = "POST /verify HTTP/1.0\r\n";
    $http_request .= "Host: api-verify.recaptcha.net\r\n";
    $http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
    $http_request .= "Content-Length: ".strlen($http_data)."\r\n";
    $http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
    $http_request .= "\r\n";
    $http_request .= $http_data;

    if (!$fp = @fsockopen("api-verify.recaptcha.net", 80, $errno, $errstr, 10))
    {
      echo "<div>ERROR: RECAPTCHA VERIFY SERVER DID NOT RESPOND</div>";
      return array("0"=>"false", "1"=>"incorrect-captcha-sol");
    }

    fwrite($fp, $http_request);

    $response = "";

    while (!feof($fp)) { $response .= fread($fp, 1160); }

    fclose($fp);

    $response = explode("\r\n\r\n", $response, 2);
    $response = explode("\n", $response[1]);

    if (!$response)
    {
      echo "<div>ERROR: RECAPTCHA VERIFY SERVER RETURNED EMPTY RESPONSE</div>";
      return array("0"=>"false", "1"=>"incorrect-captcha-sol");
    }

    return $response;
  }

//------------------------------------------------------------------------------------------------------------+

?>