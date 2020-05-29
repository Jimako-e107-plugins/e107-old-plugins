<?php
/*
+---------------------------------------------------------------+
| Yellow Pages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/admin_prefs_99.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:11 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
$text = "
   <div style='padding:5px;'>".
   YELL_NAME." ".YELL_VER." by bugrain<br>
   <br>
   A plugin for the e107 Website System (http://e107.org)<br>
   <br>
   Released under the terms and conditions of the<br>
   GNU General Public License (http://gnu.org).<br>
   <hr>
   <strong>If you have just upgraded from 1.0 to 1.1 you should <a href='admin_update.php'>update the database here</a></strong>
   <hr>
   ".YELL_DESC."
   <br /><br />
   <u>Features:</u>
   <ul>
      <li>Divide entries in to categories</li>
      <li>Categories can have (optional) sub-categories</li>
      <li>Store business name, contact name, description, telephone, e-mail, website and logo</li>
      <li>View listings by category or A to Z</li>
      <li>Visitors can submit entries, which must then be authorised by an administrator</li>
   </ul>

   <hr>

   <u>Changelog:</u>
   <ul>
      <li>Version 1.1 (02/Nov/2005):
         <ul>
            <li>+ Now uses The e107 Helper Project plugin</li>
            <li>+ Allow comments to be posted (by userclass)</li>
            <li>+ Allow entries to be rated (by userclass)</li>
            <li>+ Can now set various CSS styles in Admin preferences</li>
            <li>* Ordering is not alphabetic within category</li>
            <li>* Fatal error: Call to a member function on a non-object in search.php on line 13</li>
            <li>* Hand pointer cursor when over 'expandit' areas.</li>
   	   </ul>
   	</li>
      <li>Version 1.0:
         <ul>
            <li>Initial version</li>
   	   </ul>
   	</li>
   </ul>
   </div>";
?>
