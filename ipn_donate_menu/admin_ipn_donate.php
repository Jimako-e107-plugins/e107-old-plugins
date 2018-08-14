<?php

  /*---------------------------------------------------------------------------------------------------------\
  |                                                                                                          |
  |	                                  IPN DONATE PLUGIN FOR e107                                             |
  |                                                                                                          |
  |	                         + Lolo Irie     ( http://www.etalkers.org   )                                   |
  |                          + Cameron       ( http://www.e107coders.org )                                   |
  |                          + Barry Keal    ( http://www.keal.me.uk     )                                   |
  |                          + Richard Perry ( http://www.greycube.com   )                                   |
  |                          + Klutsh        ( http://www.x-projects.org )                                   |
  |                                                                                                          |
  |	        Released under the terms and conditions of the GNU General Public License (http://gnu.org)       |
  |                                                                                                          |
  \---------------------------------------------------------------------------------------------------------*/

//-----------------------------------------------------------------------------------------------------------+

  require_once"../../class2.php";
  if(!getperms("P")) { header("location:".e_BASE."index.php"); }
  require_once e_ADMIN."auth.php";
  @include_once e_PLUGIN."donate_menu/languages/".e_LANGUAGE.".php";
  @include_once e_PLUGIN."donate_menu/languages/English.php";

//-----------------------------------------------------------------------------------------------------------+
  
  if(isset($_POST['save_settings']))
  {
	$pref['ipn_pal_sand']           = $_POST['ipn_pal_sand'];
	$pref['ipn_pal_sand_email']		= $_POST['ipn_pal_sand_email'];
    $pref['ipn_pal_menu_caption']   = $_POST['ipn_pal_menu_caption'];
    $pref['ipn_pal_text']           = $_POST['ipn_pal_text'];
    $pref['ipn_pal_button_image']   = $_POST['ipn_pal_button_image'];
    $pref['ipn_pal_button_popup']   = $_POST['ipn_pal_button_popup'];
    $pref['ipn_pal_business']       = $_POST['ipn_pal_business'];
    $pref['ipn_pal_item_name']      = $_POST['ipn_pal_item_name'];
    $pref['ipn_pal_currency_code']  = $_POST['ipn_pal_currency_code'];
    $pref['ipn_pal_no_protection']  = $_POST['ipn_pal_no_protection'];
    $pref['ipn_pal_key_private']    = md5(rand(0,100).time());
	$pref['ipn_pal_Show_Total']		= $_POST['ipn_pal_Show_Total'];
	$pref['ipn_pal_Show_Total_Text']= $_POST['ipn_pal_Show_Total_Text'];

    $pref['ipn_pal_no_shipping']    = $_POST['ipn_pal_no_shipping'];
    $pref['ipn_pal_no_note']        = $_POST['ipn_pal_no_note'];
    $pref['ipn_pal_cn']             = $_POST['ipn_pal_cn'];
	$pref['ipn_pal_ipn_notif']		= $_POST['ipn_pal_ipn_notif'];
	$pref['ipn_pal_ipn_file']       = $_POST['ipn_pal_ipn_file']	  ? "http://".eregi_replace("http://", "", trim($_POST['ipn_pal_ipn_file']))        : "";
    $pref['ipn_pal_return']         = $_POST['ipn_pal_return']        ? "http://".eregi_replace("http://", "", trim($_POST['ipn_pal_return']))        : "";
    $pref['ipn_pal_cancel_return']  = $_POST['ipn_pal_cancel_return'] ? "http://".eregi_replace("http://", "", trim($_POST['ipn_pal_cancel_return'])) : "";
    $pref['ipn_pal_page_style']     = $_POST['ipn_pal_page_style'];

    $pref['ipn_pal_lc']             = $_POST['ipn_pal_lc'];
    $pref['ipn_pal_item_number']    = $_POST['ipn_pal_item_number'];
    $pref['ipn_pal_custom']         = $_POST['ipn_pal_custom'];
	$pref['ipn_pal_Show_Login_Warn']= $_POST['ipn_pal_Show_Login_Warn'];
	$pref['ipn_pal_Show_Login_Warn_Text'] = $_POST['ipn_pal_Show_Login_Warn_Text'];
    $pref['ipn_pal_invoice']        = $_POST['ipn_pal_invoice'];
    $pref['ipn_pal_amount']         = $_POST['ipn_pal_amount'];
    $pref['ipn_pal_tax']            = $_POST['ipn_pal_tax'];

    save_prefs();

    message_handler("MESSAGE", LAN_IPN_PAL_SETTINGS_SAVED);
  }

//-----------------------------------------------------------------------------------------------------------+

  $file_handle = opendir(e_PLUGIN."donate_menu/images");

  while ($file_name = readdir($file_handle))
  {
    if ($file_name == "." || $file_name == "..") { continue; }

    $iconlist[] = $file_name;
  }

  closedir($file_handle);

//-----------------------------------------------------------------------------------------------------------+

  $text = "
  
  <script type='text/javascript'>
    function addtext(sc)
    {
      document.forms.paypal_donate_form.ipn_pal_button_image.value=sc;
    }
  </script>

  <div style='text-align:center'>
    <form method='post' action='".e_SELF."' id='paypal_donate_form'>
      <table style='width:80%' class='fborder'>

        <tr>
          <td class='forumheader' colspan='2'>".LAN_IPN_PAL_DEBUG."</td>
        </tr>

		<tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_SAND."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_SAND_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='ipn_pal_sand'>
              <option ".($pref['ipn_pal_sand'] ? "selected='selected'" : "")." value='1'>".LAN_IPN_PAL_NO."</option>
              <option ".($pref['ipn_pal_sand'] ? "" : "selected='selected'")." value='0'>".LAN_IPN_PAL_YES."</option>
            </select>
          </td>
        </tr>
		
		<tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_IPN_PAL_SAND_BUS."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_SAND_BUS_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_sand_email' value='$pref[ipn_pal_sand_email]' maxlength='30' />
          </td>
        </tr>
		
		<tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_IPN_NOTIF."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_IPN_NOTIF_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_ipn_notif' value='$pref[ipn_pal_ipn_notif]' maxlength='30' />
          </td>
        </tr>
		
		<tr>
          <td class='forumheader' colspan='2'>".LAN_IPN_PAL_MAIN."</td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_IPN_PAL_MENUCAPTION."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_MENUCAPTION_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_menu_caption' value='$pref[ipn_pal_menu_caption]' maxlength='30' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_IPN_PAL_MENUTEXT."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_MENUTEXT_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <textarea class='tbox' style='width:200px; height:140px' cols='25' rows='5' name='ipn_pal_text'>".$pref[ipn_pal_text]."</textarea>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_BUTTON."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_BUTTON_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_button_image' value='$pref[ipn_pal_button_image]' />
            <br /><br />
            <input class='button' style='cursor:hand' type='button' value='".LAN_IPN_PAL_BUTTON_CHOOSE."' onclick='expandit(this)' />
            <div style='display:none'>";
//-----------------------------------------------------------------------------------------------------------+
  while (list($key, $icon)=each($iconlist))
  {
    $text .= " <a href='javascript:addtext(\"$icon\")'><img src='".e_PLUGIN."donate_menu/images/$icon' style='border:0px' alt='' /></a>";
  }
//-----------------------------------------------------------------------------------------------------------+
  $text .= "</div>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top;'>
            <b>".LAN_IPN_PAL_BUTTON_POPUP."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_BUTTON_POPUP_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_button_popup' value='$pref[ipn_pal_button_popup]' maxlength='30' />
          </td>
        </tr>


        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top;'>
            <b>".LAN_IPN_PAL_BUSINESS."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_BUSINESS_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_business' value='$pref[ipn_pal_business]' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_IPN_PAL_ITEMNAME."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_ITEMNAME_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_item_name' value='$pref[ipn_pal_item_name]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_CURRENCY."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_CURRENCY_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='ipn_pal_currency_code'>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= $pref['ipn_pal_currency_code'] == "USD" ? "<option value='USD' selected='selected'> USD - United States Dollar </option>" : "<option value='USD'> USD - United States Dollar </option>";
  $text .= $pref['ipn_pal_currency_code'] == "GBP" ? "<option value='GBP' selected='selected'> GBP - Great Britain Pound  </option>" : "<option value='GBP'> GBP - Great Britain Pound  </option>";
  $text .= $pref['ipn_pal_currency_code'] == "EUR" ? "<option value='EUR' selected='selected'> EUR - Euro                 </option>" : "<option value='EUR'> EUR - Euro                 </option>";
  $text .= $pref['ipn_pal_currency_code'] == "CAD" ? "<option value='CAD' selected='selected'> CAD - Canadian Dollar      </option>" : "<option value='CAD'> CAD - Canadian Dollar      </option>";
  $text .= $pref['ipn_pal_currency_code'] == "JPY" ? "<option value='JPY' selected='selected'> JPY - Japanese Yen         </option>" : "<option value='JPY'> JPY - Japanese Yen         </option>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= "</select>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_PROTECTION."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_PROTECTION_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='ipn_pal_no_shipping'>
              <option ".($pref['ipn_pal_no_protection'] ? "selected='selected'" : "")." value='1'>".LAN_IPN_PAL_NO."</option>
              <option ".($pref['ipn_pal_no_protection'] ? "" : "selected='selected'")." value='0'>".LAN_IPN_PAL_YES."</option>
            </select>
          </td>
        </tr>
		
		<tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_IPN_URL."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_IPN_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_ipn_file' value='$pref[ipn_pal_ipn_file]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td colspan='2'>
            <div class='forumheader' style='text-align:left'>".LAN_IPN_PAL_OPTIONAL."</div>
          </td>
        </tr>
		
		<tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_CUSTOM."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_CUSTOM_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
			<select class='tbox' name='ipn_pal_custom'>
              <option ".($pref['ipn_pal_custom'] ? "selected='selected'" : "")." value='1'>".LAN_IPN_PAL_NO."</option>
              <option ".($pref['ipn_pal_custom'] ? "" : "selected='selected'")." value='0'>".LAN_IPN_PAL_YES."</option>
            </select>
          </td>
        </tr>
		
		<tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_LOGIN_WARN."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_LOGIN_WARN_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='ipn_pal_Show_Login_Warn'>
              <option ".($pref['ipn_pal_Show_Login_Warn'] ? "selected='selected'" : "")." value='1'>".LAN_IPN_PAL_NO."</option>
              <option ".($pref['ipn_pal_Show_Login_Warn'] ? "" : "selected='selected'")." value='0'>".LAN_IPN_PAL_YES."</option>
            </select>
          </td>
        </tr>
		
		 <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_IPN_PAL_LOGIN_WARN."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_LOGIN_MSG_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <textarea class='tbox' style='width:200px; height:140px' cols='25' rows='5' name='ipn_pal_Show_Login_Warn_Text'>".$pref[ipn_pal_Show_Login_Warn_Text]."</textarea>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_ADDRESS."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_ADDRESS_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='ipn_pal_no_shipping'>
              <option ".($pref['ipn_pal_no_shipping'] ? "selected='selected'" : "")." value='1'>".LAN_IPN_PAL_NO."</option>
              <option ".($pref['ipn_pal_no_shipping'] ? "" : "selected='selected'")." value='0'>".LAN_IPN_PAL_YES."</option>
            </select>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_NOTE."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_NOTE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='ipn_pal_no_note'>
              <option ".($pref['ipn_pal_no_note'] ? "selected='selected'" : "")." value='1'>".LAN_IPN_PAL_NO."</option>
              <option ".($pref['ipn_pal_no_note'] ? "" : "selected='selected'")." value='0'>".LAN_IPN_PAL_YES."</option>
            </select>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_NOTECAPTION."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_NOTECAPTION_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_cn' value='$pref[ipn_pal_cn]' maxlength='30' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_SUCCESS_URL."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_SUCCESS_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_return' value='$pref[ipn_pal_return]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_CANCELURL."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_CANCELURL_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_cancel_return' value='$pref[ipn_pal_cancel_return]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_PAGESTYLE."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_PAGESTYLE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_page_style' value='$pref[ipn_pal_page_style]' maxlength='127' />
          </td>
        </tr>
		
		<tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_TOTAL."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_TOTAL_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='ipn_pal_Show_Total'>
              <option ".($pref['ipn_pal_Show_Total'] ? "selected='selected'" : "")." value='1'>".LAN_IPN_PAL_NO."</option>
              <option ".($pref['ipn_pal_Show_Total'] ? "" : "selected='selected'")." value='0'>".LAN_IPN_PAL_YES."</option>
            </select>
          </td>
        </tr>
		
		<tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_TOTAL_TEXT."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_TOTAL_TEXT_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_Show_Total_Text' value='$pref[ipn_pal_Show_Total_Text]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td colspan='2'>
            <div class='forumheader' style='text-align:left'>".LAN_IPN_PAL_EXTRA."</div>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_LOCALE."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_LOCALE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_lc' value='$pref[ipn_pal_lc]' maxlength='2' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_ITEMNUMBER."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_ITEMNUMBER_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='ipn_pal_item_number' value='$pref[ipn_pal_item_number]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_INVOICE."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_INVOICE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_invoice' value='$pref[ipn_pal_invoice]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_AMMOUNT."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_AMMOUNT_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_amount' value='$pref[ipn_pal_amount]' />
          </td>
        </tr>
       
        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_IPN_PAL_TAX."</b><br />
            <br /><span class='smalltext'>".LAN_IPN_PAL_TAX_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='ipn_pal_tax' value='$pref[ipn_pal_tax]' />
          </td>
        </tr>

        <tr>
          <td class='forumheader' style='text-align:right' colspan='2'>
            <input class='button' type='submit' name='save_settings' value='".LAN_IPN_PAL_SAVE_SETTINGS."' />
          </td>
        </tr>

      </table>
    </form>
  </div>";

//-----------------------------------------------------------------------------------------------------------+

  $ns -> tablerender(LAN_IPN_PAL_PLUGIN_CAPTION, $text);
  require_once(e_ADMIN."footer.php");

//-----------------------------------------------------------------------------------------------------------+
  
?>
