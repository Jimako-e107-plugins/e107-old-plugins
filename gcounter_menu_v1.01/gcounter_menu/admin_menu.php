<?php

if(e_LANGUAGE != "English" && file_exists(e_PLUGIN."gcounter_menu/languages/admin/".e_LANGUAGE.".php"))
{
	include_once(e_PLUGIN."gcounter_menu/languages/admin/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."gcounter_menu/languages/admin/English.php");
}


$gcount_text="
<table class = 'fborder' style = 'width:100%;' >
<tr>
<td style='text-align:center' class='button'><a href='adminconfig.php' style='text-align:center; cursor:hand; cursor:pointer; text-decoration:none;' title ='" . GCOUNT_A12 . "' >" . GCOUNT_A12 . "</a></td>
</tr>
<tr>
<td style='text-align:center' class='button'><a href='admindigits.php' style='text-align:center; cursor:hand; cursor:pointer; text-decoration:none;' title ='" . GCOUNT_A13 . "' >" . GCOUNT_A13 . "</a></td>
</tr>
</table>";

$ns -> tablerender(GCOUNT_A1, $gcount_text);

?>
