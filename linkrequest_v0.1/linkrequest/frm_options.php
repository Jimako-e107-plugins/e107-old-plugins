<?php
	require_once(e_HANDLER."userclass_class.php");

	$form_title = "<center>Link Request Options</center>";

	$form_text = "$message<p>"
				."<form method='POST' action='linkrequest_conf.php'>\n"
				."<input name='frmaction' type='hidden' value='UpdateOptions'>\n"
				."<table class='spacer'>\n"
				."<tr>\n"
				."<td class='spacer'>Contact Us UserClass<br />"
				."<span class='smalltext'>What users are authorized to view the link request form</span></td>\n"
				."<td class='spacer'>".r_userclass('sc_class', $pref['sc_class'])."</td>\n"
				."</tr>\n"
				."<tr><td colspan='2' class='spacer' style='text-align:center'>"
				."<input name='submit' type='submit' value='Save Options' class='button'>"
				."</td></tr>"
				."</table>\n</form>\n";
	$message = "";
?>
