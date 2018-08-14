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

  if (USER || $pref['pal_no_protection'])
  {
    $paypal_donate_jscript         = "";
    $paypal_donate_jscript_onclick = "";
    $paypal_donate_action          = "https://www.paypal.com/cgi-bin/webscr";
    $paypal_donate_email           = $pref['pal_business'];
  }
  else
  {  
    $paypal_donate_email   = preg_split("#(?<=.)(?=.)#s",$pref['pal_business']);
    $paypal_donate_email   = "'".implode("'  +  '", $paypal_donate_email)."'";
    $paypal_donate_jscript = "
    <script type='text/javascript'>
    function paypal_donate_set()
    {
      document.forms.paypal_donate_form.paypal_donate_email.value=$paypal_donate_email;
      document.forms.paypal_donate_form.action='https://www.paypal.com/cgi-bin/webscr';
    }
    </script>";
    $paypal_donate_jscript_onclick = "onclick='paypal_donate_set()'";
    $paypal_donate_action          = e_PLUGIN."donate_menu/";
    $paypal_donate_email           = "JAVASCRIPT_REQUIRED";
  }

//-----------------------------------------------------------------------------------------------------------+

  $text = "
  
  $paypal_donate_jscript
  
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
  
      <div>
      $pref[pal_text]<br />
      </div>

      <div style='padding-top:5px'>
        <input $paypal_donate_jscript_onclick name='submit' type='image' src='$image_path' alt='$image_text' title='$pref[pal_button_popup]' style='border:none' />
      </div>

    </div>
  </form>";

  $ns->tablerender($pref['pal_menu_caption'], $text);

//-----------------------------------------------------------------------------------------------------------+

?>