<?

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

  require_once "../../class2.php";
  require_once HEADERF;
  @include_once e_PLUGIN."donate_menu/languages/".e_LANGUAGE.".php";
  @include_once e_PLUGIN."donate_menu/languages/English.php";

//-----------------------------------------------------------------------------------------------------------+

  $cap_number_one  = rand(1,5);
  $cap_number_two  = rand(1,5);
  $cap_number_sum  = $cap_number_one + $cap_number_two;

  $pal_key_private = $pref['pal_key_private'];
  $pal_key_public  = md5($pal_key_private.$cap_number_sum.$pal_key_private.$_SERVER['REMOTE_ADDR']);
  $pal_key_check   = md5($pal_key_private.$_POST['cap_answer'].$pal_key_private.$_SERVER['REMOTE_ADDR']);

//-----------------------------------------------------------------------------------------------------------+
  
  if (!USER && $pal_key_check != $_POST['cap_key'] && !$pref['pal_no_protection'])
  {
    $text = "

    <form method='post' action='".e_PLUGIN."donate_menu/'>
      <div style='text-align:center'>
        <br />
        <br />
        ".LAN_PAL_PROTECTION_REASON."<br />
        <br />
        ".LAN_PAL_PROTECTION_ANSWER." $cap_number_one + $cap_number_two =
        <input              type='hidden' name='cap_key'    value='$pal_key_public' />
        <input class='tbox' type='text'   name='cap_answer' value='' size='5' maxlength='5' />
        <input class='tbox' type='submit' name='submit'     value='".LAN_PAL_PROTECTION_SUBMIT."' />
        <br />
        <br />
        <br />
      </div>
    </form>";
  }
  else
  {

//-----------------------------------------------------------------------------------------------------------+

    $paypal_donate_action = "https://www.paypal.com/cgi-bin/webscr";
    $paypal_donate_email  = $pref['pal_business'];

    $text = "
    
    <div style='text-align:center'>
      <br />
      ".LAN_PAL_PROTECTION_PASSED."<br />
      <br />
    </div>

    <form method='post' action='$paypal_donate_action' id='paypal_donate_form'>
      <div style='width:100%; margin-left:auto; margin-right:auto; text-align:center;'>

        <input type='hidden' name='cmd'      value='_xclick' />
        <input type='hidden' name='business' value='$paypal_donate_email' id='paypal_donate_email' />";

  if($pref['pal_item_name'])     { $text .="<input type='hidden' name='item_name'     value='$pref[pal_item_name]'     />"; }
  if($pref['pal_currency_code']) { $text .="<input type='hidden' name='currency_code' value='$pref[pal_currency_code]' />"; }
  if($pref['pal_no_shipping'])   { $text .="<input type='hidden' name='no_shipping'   value='$pref[pal_no_shipping]'   />"; }
  if($pref['pal_no_note'])       { $text .="<input type='hidden' name='no_note'       value='$pref[pal_no_note]'       />"; }
  if($pref['pal_cn'])            { $text .="<input type='hidden' name='cn'            value='$pref[pal_cn]'            />"; }
  if($pref['pal_return'])        { $text .="<input type='hidden' name='return'        value='$pref[pal_return]'        />"; }
  if($pref['pal_cancel_return']) { $text .="<input type='hidden' name='cancel_return' value='$pref[pal_cancel_return]' />"; }
  if($pref['pal_page_style'])    { $text .="<input type='hidden' name='page_style'    value='$pref[pal_page_style]'    />"; }
  if($pref['pal_lc'])            { $text .="<input type='hidden' name='lc'            value='$pref[pal_lc]'            />"; }
  if($pref['pal_item_number'])   { $text .="<input type='hidden' name='item_number'   value='$pref[pal_item_number]'   />"; }
  if($pref['pal_custom'])        { $text .="<input type='hidden' name='custom'        value='$pref[pal_custom]'        />"; }
  if($pref['pal_invoice'])       { $text .="<input type='hidden' name='invoice'       value='$pref[pal_invoice]'       />"; }
  if($pref['pal_amount'])        { $text .="<input type='hidden' name='amount'        value='$pref[pal_amount]'        />"; }
  if($pref['pal_tax'])           { $text .="<input type='hidden' name='tax'           value='$pref[pal_tax]'           />"; }

  $image_path = e_PLUGIN."donate_menu/images/$pref[pal_button_image]";

  $text .= "
  
        <div style='padding-top:5px'>
          <input name='submit' type='image' src='$image_path' alt='$image_text' title='$pref[pal_button_popup]' style='border:none' />
        </div>

      </div>
    </form>";
  
  }

//-----------------------------------------------------------------------------------------------------------+

  $ns->tablerender($pref['pal_menu_caption'], $text);
  
  require_once FOOTERF;

//-----------------------------------------------------------------------------------------------------------+

?>
