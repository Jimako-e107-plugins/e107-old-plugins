<?php

  /*---------------------------------------------------------------------------------------------------------\
  |                                                                                                          |
  |	                                    DONATE PLUGIN FOR e107                                               |
  |                                                                                                          |
  |	                         + Lolo Irie     ( http://www.etalkers.org   )                                   |
  |                          + Cameron       ( http://www.e107coders.org )                                   |
  |                          + Barry Keal    ( http://www.keal.me.uk     )                                   |
  |                          + Richard Perry ( http://www.greycube.com   )                                   |
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
    $pref['pal_menu_caption']   = $_POST['pal_menu_caption'];
    $pref['pal_text']           = $_POST['pal_text'];
    $pref['pal_button_image']   = $_POST['pal_button_image'];
    $pref['pal_button_popup']   = $_POST['pal_button_popup'];
    $pref['pal_business']       = $_POST['pal_business'];
    $pref['pal_item_name']      = $_POST['pal_item_name'];
    $pref['pal_currency_code']  = $_POST['pal_currency_code'];
    $pref['pal_no_protection']  = $_POST['pal_no_protection'];
    $pref['pal_key_private']    = md5(rand(0,100).time());

    $pref['pal_no_shipping']    = $_POST['pal_no_shipping'];
    $pref['pal_no_note']        = $_POST['pal_no_note'];
    $pref['pal_cn']             = $_POST['pal_cn'];
    $pref['pal_return']         = $_POST['pal_return']        ? "http://".eregi_replace("http://", "", trim($_POST['pal_return']))        : "";
    $pref['pal_cancel_return']  = $_POST['pal_cancel_return'] ? "http://".eregi_replace("http://", "", trim($_POST['pal_cancel_return'])) : "";
    $pref['pal_page_style']     = $_POST['pal_page_style'];

    $pref['pal_lc']             = $_POST['pal_lc'];
    $pref['pal_item_number']    = $_POST['pal_item_number'];
    $pref['pal_custom']         = $_POST['pal_custom'];
    $pref['pal_invoice']        = $_POST['pal_invoice'];
    $pref['pal_amount']         = $_POST['pal_amount'];
    $pref['pal_tax']            = $_POST['pal_tax'];

    save_prefs();

    message_handler("MESSAGE", LAN_PAL_SETTINGS_SAVED);
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
      document.forms.paypal_donate_form.pal_button_image.value=sc;
    }
  </script>

  <div style='text-align:center'>
    <form method='post' action='".e_SELF."' id='paypal_donate_form'>
      <table style='width:95%' class='fborder'>

        <tr>
          <td class='forumheader' colspan='2'>".LAN_PAL_MAIN."</td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_PAL_MENUCAPTION."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_MENUCAPTION_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='pal_menu_caption' value='$pref[pal_menu_caption]' maxlength='30' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_PAL_MENUTEXT."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_MENUTEXT_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <textarea class='tbox' style='width:200px; height:140px' cols='25' rows='5' name='pal_text'>".$pref[pal_text]."</textarea>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_BUTTON."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_BUTTON_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='pal_button_image' value='$pref[pal_button_image]' />
            <br /><br />
            <input class='button' style='cursor:hand' type='button' value='".LAN_PAL_BUTTON_CHOOSE."' onclick='expandit(this)' />
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
            <b>".LAN_PAL_BUTTON_POPUP."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_BUTTON_POPUP_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='pal_button_popup' value='$pref[pal_button_popup]' maxlength='30' />
          </td>
        </tr>


        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top;'>
            <b>".LAN_PAL_BUSINESS."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_BUSINESS_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='pal_business' value='$pref[pal_business]' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%;vertical-align:top'>
            <b>".LAN_PAL_ITEMNAME."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_ITEMNAME_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='pal_item_name' value='$pref[pal_item_name]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_CURRENCY."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_CURRENCY_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='pal_currency_code'>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= $pref['pal_currency_code'] == "USD" ? "<option value='USD' selected='selected'> USD - United States Dollar </option>" : "<option value='USD'> USD - United States Dollar </option>";
  $text .= $pref['pal_currency_code'] == "GBP" ? "<option value='GBP' selected='selected'> GBP - Great Britain Pound  </option>" : "<option value='GBP'> GBP - Great Britain Pound  </option>";
  $text .= $pref['pal_currency_code'] == "EUR" ? "<option value='EUR' selected='selected'> EUR - Euro                 </option>" : "<option value='EUR'> EUR - Euro                 </option>";
  $text .= $pref['pal_currency_code'] == "CAD" ? "<option value='CAD' selected='selected'> CAD - Canadian Dollar      </option>" : "<option value='CAD'> CAD - Canadian Dollar      </option>";
  $text .= $pref['pal_currency_code'] == "JPY" ? "<option value='JPY' selected='selected'> JPY - Japanese Yen         </option>" : "<option value='JPY'> JPY - Japanese Yen         </option>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= "</select>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_PROTECTION."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_PROTECTION_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='pal_no_shipping'>
              <option ".($pref['pal_no_protection'] ? "selected='selected'" : "")." value='1'>".LAN_PAL_NO."</option>
              <option ".($pref['pal_no_protection'] ? "" : "selected='selected'")." value='0'>".LAN_PAL_YES."</option>
            </select>
          </td>
        </tr>

        <tr>
          <td colspan='2'>
            <div class='forumheader' style='text-align:left'>".LAN_PAL_OPTIONAL."</div>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_ADDRESS."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_ADDRESS_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='pal_no_shipping'>
              <option ".($pref['pal_no_shipping'] ? "selected='selected'" : "")." value='1'>".LAN_PAL_NO."</option>
              <option ".($pref['pal_no_shipping'] ? "" : "selected='selected'")." value='0'>".LAN_PAL_YES."</option>
            </select>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_NOTE."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_NOTE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <select class='tbox' name='pal_no_note'>
              <option ".($pref['pal_no_note'] ? "selected='selected'" : "")." value='1'>".LAN_PAL_NO."</option>
              <option ".($pref['pal_no_note'] ? "" : "selected='selected'")." value='0'>".LAN_PAL_YES."</option>
            </select>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_NOTECAPTION."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_NOTECAPTION_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_cn' value='$pref[pal_cn]' maxlength='30' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_SUCCESS_URL."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_SUCCESS_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_return' value='$pref[pal_return]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_CANCELURL."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_CANCELURL_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_cancel_return' value='$pref[pal_cancel_return]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_PAGESTYLE."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_PAGESTYLE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_page_style' value='$pref[pal_page_style]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td colspan='2'>
            <div class='forumheader' style='text-align:left'>".LAN_PAL_EXTRA."</div>
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_LOCALE."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_LOCALE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_lc' value='$pref[pal_lc]' maxlength='2' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_ITEMNUMBER."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_ITEMNUMBER_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' style='width:200px' type='text' name='pal_item_number' value='$pref[pal_item_number]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_CUSTOM."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_CUSTOM_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_custom' value='$pref[pal_custom]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_INVOICE."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_INVOICE_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_invoice' value='$pref[pal_invoice]' maxlength='127' />
          </td>
        </tr>

        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_AMMOUNT."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_AMMOUNT_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_amount' value='$pref[pal_amount]' />
          </td>
        </tr>
       
        <tr>
          <td class='forumheader3' style='width:60%; vertical-align:top'>
            <b>".LAN_PAL_TAX."</b><br />
            <br /><span class='smalltext'>".LAN_PAL_TAX_INFO."</span>
          </td>
          <td class='forumheader3' style='width:40%'>
            <input class='tbox' type='text' style='width:200px' name='pal_tax' value='$pref[pal_tax]' />
          </td>
        </tr>

        <tr>
          <td class='forumheader' style='text-align:right' colspan='2'>
            <input class='button' type='submit' name='save_settings' value='".LAN_PAL_SAVE_SETTINGS."' />
          </td>
        </tr>

      </table>
    </form>
  </div>";

//-----------------------------------------------------------------------------------------------------------+

  $ns -> tablerender(LAN_PAL_PLUGIN_CAPTION, $text);
  require_once(e_ADMIN."footer.php");

//-----------------------------------------------------------------------------------------------------------+
  
?>
