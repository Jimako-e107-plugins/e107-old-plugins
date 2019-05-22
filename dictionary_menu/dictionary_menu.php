<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     �Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/powered_by_menu/powered_by_menu.php,v $
|     $Revision: 1.8 $
|     $Date: 2006/01/22 20:44:41 $
|     $Author: streaky $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

$text = "
<div style='text-align: center'>
<div class='spacer'>
<form method='get' action='http://dictionary.reference.com/search'>
<table border='0' cellspacing='4' cellpadding='4' bgcolor='#cccccc'>
<tr>
<td valign='middle' align='left'>
&nbsp;<strong style='font-family: arial,helvetica,sans-serif; font-size: 115%; color: #000000;'>Search:</strong>&nbsp;
<select name='db' style='font-size:11pt; font-family: arial,helvetica,sans-serif;'>
<option value='dictionary'>Dictionary.com</option>
<option value='thesaurus'>Thesaurus.com</option>
<option value='encyclopedia'>Reference.com</option>
<option value='web'>the Web</option>
</select>
&nbsp;<strong style='font-family: arial,helvetica,sans-serif; font-size: 115%; color: #000000;'>for</strong>
&nbsp;<input type='text' name='q' size='20' maxlength='50' style='font-size:11pt;'>
&nbsp;<input type='submit' value='Go' style='font-weight:bold; font-size:11pt; font-family: arial,helvetica,sans-serif;'>
</td>
</tr>
</table>
</form>
</div>


</div>";
$ns -> tablerender('Dictionary',  $text, 'Dictionary');
?>