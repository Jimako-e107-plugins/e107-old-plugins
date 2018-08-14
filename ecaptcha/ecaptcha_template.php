<?php


$ecaptcha_template_header = "

<html>
  <head>
    <title>".SITENAME.": eCaptcha</title>
    {TEMPLATE_CSS}
  </head>
  <body>

";


$ecaptcha_template_footer = "

  </body>
</html>

";


$ecaptcha_template_form = "

<form method='post' action=''>
  <div class='defaulttext' style='margin:auto;text-align:center'>
    <br />
    <br />
    {TEMPLATE_INFO}
    <br />
    <br />
    <table style='margin:auto;text-align:center'>
      <tr>
        <td>
          {TEMPLATE_OBJECT}
        </td>
      </tr>
    </table>
    <br />
    {TEMPLATE_INPUT}
    <br />
    <br />
    <input type='hidden' name='ecaptcha_key' value='{TEMPLATE_KEY}' />
    <br />
    <br />
    <br />
    <div style='margin:auto;width:95%;border:2px solid'>
      <br />
      {TEMPLATE_DISPLAY}
      <br />
      <br />
    </div>
  </div>
</form>

";


// WHEN THEME LAYOUT IS ENABLED, eCaptcha CALLS header_default EARLIER THAN NORMAL
// PROBLEM IS header_default CALLS headerjs() WITHIN A PAGE eCaptcha IS INTECEPTING
// IF headerjs() USES SOMETHING WHICH IS NORMALLY SET BEFORE require_once(HEADERF);
// IT WILL THROW AN ERROR LIKE "Call to a member function on a non-object"
// THE WORKAROUND FOR THIS IS TO SET THAT 'SOMETHING' HERE.

require_once e_HANDLER."calendar/calendar_class.php"; global $cal; $cal = new DHTML_Calendar(true); // SIGNUP.PHP

?>
