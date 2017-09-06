<?php
/*
+---------------------------------------------------------------+
| Agenda by bugrain (www.bugrain.plus.com)
| see plugin.php for version information
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/agenda/admin_entries.php,v $
| $Revision: 1.5 $
| $Date: 2007/06/04 21:37:35 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }

   require(e_PLUGIN."agenda/agenda_variables.php");

   $configtitle   = AGENDA_LAN_ADMIN_1;

   $primaryid     = "id";                 // first column of your table.
   $e_wysiwyg     = "";                   // commas separated list of textareas to use wysiwyg with.
   $pageid        = "entries";            // unique name that matches the one used in admin_menu.php.
   $show_preset   = TRUE;                 // allow e107 presets to be saved for use in the form.

   require_once(e_ADMIN."auth.php");
   $rs = new agenda_form;

   if (isset($_POST['delete'])) {
      $message = ($agn_sql1->db_Delete($agenda->getAgendaTable(), "$primaryid='".$_POST['existing']."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
   }

   if (isset($message)) {
      $ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
   }

   $table_total = $agn_sql1->select($agenda->getAgendaTable(), "*");

   $text = "<div style='text-align:center'>
      <form method='post' action='".e_SELF."' id='myexistingform'>
      <table style='width:96%;margin-left:auto;margin-right:auto;' class='fborder'>
      <tr>
      <td colspan='2' class='forumheader' style='text-align:center'>";

   if (!$table_total) {
         $text .= LAN_EMPTY;
   } else {
         $text .= "<span class='defaulttext'>".LAN_EXISTING.":</span><select name='existing' class='tbox'>";
         while($erow = $agn_sql1->db_Fetch()) {
            extract($erow, EXTR_OVERWRITE);
            $text .= "<option value='$the_id_'>$agn_title</option>";
         }
         $text .= "</select>
            <input class='button' type='submit' name='delete' value='".LAN_DELETE."' onclick='return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL)."')' />
            </td></tr>";
   }

   $text .= "</table></form></div>";

   $ns -> tablerender($configtitle, $text);

   require_once(e_ADMIN."footer.php");
   exit;

?>