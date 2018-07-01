<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3, 1.4 by garyt  #
#######################################
*/

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");

if(!getperms("P")){
header("location:".e_BASE."index.php");
exit;
}

require_once(e_ADMIN."auth.php");
$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");

$pageid = "admin_menu_01";

//-------------------------------------------------------------------------------------------------------------------
$text = "
<br>
<center>
<div style='width:100%'>
<center>".AMS_INFO_S1."</center><br><br>
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='image' src='http://s160665355.online.de/e107_plugins/advraiplasys/images_sys/donation.png' border='0' name='submit' alt='Zahlen Sie mit PayPal - schnell, kostenlos und sicher!'>
<img alt='' border='0' src='https://www.paypal.com/de_DE/i/scr/pixel.gif' width='1' height='1'>
<input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----MIIHTwYJKoZIhvcNAQcEoIIHQDCCBzwCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYAjlCCTNRhGpoL9XVlY2fXg+ZsaYpHVF6Svt28OkQ6dOorxudVqyv86x4Zt4o48HWp5IwEy4dI6AwafmTPn2D2IlBQeTGnWcdL8YoDW75ba2M7V3fWzvQl+rVscpg9IM/3GTg2RSPEwul8R7/NYKGqqgGlCmbfEG9i9HX3USgZf9TELMAkGBSsOAwIaBQAwgcwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIq1ipJHDwjB+Agag8ohifL3zbYn28xk5gViEkCV9x9ScHGbf4fyAqoPliPPxWMLkZ5S+DFwisnPYdxADaWal8taF6XqeV8kI70QZT7AjTAQqn4eT8t6q6ngRbUF/AkY53KhiAm6KwqRYs43KP5zQKsoQl+19ONE8YZcSajQ+zcMLrod7H76M80WsE9Tje+nlWRwpY23PFgc9kI7MVKr5pAvjz6SrlZumVIwpitJATgxIEekegggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0wNzEyMjgyMTQzMzlaMCMGCSqGSIb3DQEJBDEWBBRN465m36ume+chOY1yEbxOb1fVyzANBgkqhkiG9w0BAQEFAASBgLo8BbkPQr4viLnUcgD/wO49MFfUDT0H575lF/4Xp3o5xZTX5gf/utdXeIfgOJxggxv96sUKDMowfXnDyO9pPtaOao9+9HQ1hBsRnPecWFLclLBtM8H7ktGzM1vWvX0oFsjdCunc0U9bH+rGIoq2gMch36NrTaCye9+CXrU1sbgL-----END PKCS7-----
'>
</form>";
$text .="
</div>
</center>
<br>";
$title = "<b>".AMS_PLGIN_S1." v".AMS_VER_S1."</b>";
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");
?>
