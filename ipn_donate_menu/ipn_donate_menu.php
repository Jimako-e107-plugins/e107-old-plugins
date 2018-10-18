<?

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

  if (USER || $pref['ipn_pal_no_protection'])
  {
    $ipn_paypal_donate_jscript         = "";
    $ipn_paypal_donate_jscript_onclick = "";
	if($pref['ipn_pal_sand']=="0"){
	$ipn_paypal_donate_action          = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	$ipn_paypal_donate_email           = $pref['ipn_pal_sand_email'];
	}else{
    $ipn_paypal_donate_action          = "https://www.paypal.com/cgi-bin/webscr";
	$ipn_paypal_donate_email           = $pref['ipn_pal_business'];
	}
  }
  else
  {  
    if($pref['ipn_pal_sand']=="0"){
		$ipn_paypal_donate_email   = preg_split("#(?<=.)(?=.)#s",$pref['ipn_pal_sand_email']);
	    $ipn_paypal_donate_email   = "'".implode("'  +  '", $ipn_paypal_donate_email)."'";
	    $ipn_paypal_donate_jscript = "
	    <script type='text/javascript'>
	    function ipn_paypal_donate_set()
	    {
	      document.forms.ipn_paypal_donate_form.ipn_paypal_donate_email.value=$ipn_paypal_donate_email;
	      document.forms.ipn_paypal_donate_form.action='https://www.sandbox.paypal.com/cgi-bin/webscr';
	    }
	    </script>";
	}else{
	    $ipn_paypal_donate_email   = preg_split("#(?<=.)(?=.)#s",$pref['ipn_pal_business']);
	    $ipn_paypal_donate_email   = "'".implode("'  +  '", $ipn_paypal_donate_email)."'";
	    $ipn_paypal_donate_jscript = "
	    <script type='text/javascript'>
	    function ipn_paypal_donate_set()
	    {
	      document.forms.ipn_paypal_donate_form.ipn_paypal_donate_email.value=$ipn_paypal_donate_email;
	      document.forms.ipn_paypal_donate_form.action='https://www.paypal.com/cgi-bin/webscr';
	    }
	    </script>";
	}
    $ipn_paypal_donate_jscript_onclick = "onclick='ipn_paypal_donate_set()'";
    $ipn_paypal_donate_action          = e_PLUGIN."ipn_donate_menu/";
    $ipn_paypal_donate_email           = "JAVASCRIPT_REQUIRED";
  }

//-----------------------------------------------------------------------------------------------------------+

  $text = "
  <div align='center' style='text-align: center'>";
  if($pref['ipn_pal_sand']=="0"){
  $text .= "<span class='wmessage'>".LAN_IPN_PAL_SANDBOX_WARN."</span>";
  }
  $text .= "$ipn_paypal_donate_jscript
  <form method='post' action='$ipn_paypal_donate_action' id='ipn_paypal_donate_form'>
      <input type='hidden' name='cmd'      value='_xclick' />
      <input type='hidden' name='business' value='$ipn_paypal_donate_email' id='ipn_paypal_donate_email' />";
  if($pref['ipn_pal_item_name'])     { $text .="<input type='hidden' name='item_name'     value='$pref[ipn_pal_item_name]'     />"; }
  if($pref['ipn_pal_currency_code']) { $text .="<input type='hidden' name='currency_code' value='$pref[ipn_pal_currency_code]' />"; }
  if($pref['ipn_pal_no_shipping'])   { $text .="<input type='hidden' name='no_shipping'   value='$pref[ipn_pal_no_shipping]'   />"; }
  if($pref['ipn_pal_no_note'])       { $text .="<input type='hidden' name='no_note'       value='$pref[ipn_pal_no_note]'       />"; }
  if($pref['ipn_pal_cn'])            { $text .="<input type='hidden' name='cn'            value='$pref[ipn_pal_cn]'            />"; }
  if($pref['ipn_pal_ipn_file'])      { $text .="<input type='hidden' name='notify_url'    value='$pref[ipn_pal_ipn_file]'      />"; }
  if($pref['ipn_pal_return'])        { $text .="<input type='hidden' name='return'        value='$pref[ipn_pal_return]'        />"; }
  if($pref['ipn_pal_cancel_return']) { $text .="<input type='hidden' name='cancel_return' value='$pref[ipn_pal_cancel_return]' />"; }
  if($pref['ipn_pal_page_style'])    { $text .="<input type='hidden' name='page_style'    value='$pref[ipn_pal_page_style]'    />"; }
  if($pref['ipn_pal_lc'])            { $text .="<input type='hidden' name='lc'            value='$pref[ipn_pal_lc]'            />"; }
  if($pref['ipn_pal_item_number'])   { $text .="<input type='hidden' name='item_number'   value='$pref[ipn_pal_item_number]'   />"; }
  if(USER){
  if($pref['ipn_pal_custom'] == '0') { $text .="<input type='hidden' name='custom'        value='" . USERID . "' 		       />"; }
  }
  if($pref['ipn_pal_invoice'])       { $text .="<input type='hidden' name='invoice'       value='$pref[ipn_pal_invoice]'       />"; }
  if($pref['ipn_pal_amount'])        { $text .="<input type='hidden' name='amount'        value='$pref[ipn_pal_amount]'        />"; }
  if($pref['ipn_pal_tax'])           { $text .="<input type='hidden' name='tax'           value='$pref[ipn_pal_tax]'           />"; }
  $image_path = e_PLUGIN."ipn_donate_menu/images/$pref[ipn_pal_button_image]";
  $text .= "
      $pref[ipn_pal_text]<br />";
  $text .= LAN_IPN_PAL_AMMOUNT . " <input class='tbox' name='amount' type='text' id='amount' value='$pref[ipn_pal_amount]' size='8' /> ". $pref['ipn_pal_currency_code'] ."<br />
        <input $ipn_paypal_donate_jscript_onclick name='submit' type='image' src='$image_path' alt='$image_text' title='$pref[ipn_pal_button_popup]' style='border:none' /><br /><br />";
		if($pref['ipn_pal_Show_Login_Warn'] == '0')
		{
			if(!USER){$text .= $pref['ipn_pal_Show_Login_Warn_Text'];}
		}
		
if($pref['ipn_pal_Show_Total'] == '0'){
	$total = 0;
	$sql -> db_Select("ipn_info", "*");
  	while($row = $sql-> db_Fetch()){
    	$total += $row['mc_gross'];
   	}
	$total = money_format("%n", $total);
	$text .= "<br/>" . LAN_IPN_PAL_TOTAL_TEXT_DEFAULT . " " . $total ." ". $pref['ipn_pal_currency_code'];
	}
		
    $text .= "</div>
  </form></div>";

  $ns->tablerender($pref['ipn_pal_menu_caption'], $text);

//-----------------------------------------------------------------------------------------------------------+

?>