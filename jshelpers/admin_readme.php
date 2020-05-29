<?php
/*
+---------------------------------------------------------------+
| JSHelper by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/jshelpers/admin_readme.php,v $
| $Revision: 1.2 $
| $Date: 2008/01/01 21:52:11 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!getperms("P")) {
   // No permissions set, redirect to site front page
   header("location:".e_BASE."index.php");
   exit;
}
require_once(e_ADMIN."auth.php");

$pageid  = JSHELPER_LAN_ADMIN_PAGE_01;

$title   = JSHELPER_LAN_ADMIN_01." - ".JSHELPER_LAN_ADMIN_PAGE_01;
$text    = "
   <div style='padding:5px;'>
      <p>Includes JavaScript libraries and frameworks for use by e107 plugins.
      Use normal e107 plugin installtion procedures to install.</p>
      <p>Currently included are:</p>
      <ul>
         <li>Firebug Lite (<a href='http://www.getfirebug.com/' rel='external'>http://www.getfirebug.com/</a>)</li>
         <li>Prototip (<a href='http://www.nickstakenburg.com/projects/prototip/' rel='external'>http://www.nickstakenburg.com/projects/prototip/</a>)</li>
         <li>Prototype (<a href='http://www.prototypejs.org/' rel='external'>http://www.prototypejs.org/</a>)</li>
         <li>script.aculo.us (<a href='http://script.aculo.us/' rel='external'>http://script.aculo.us/</a>)</li>
         <li>Tablekit (<a href='http://www.millstream.com.au/view/code/tablekit/' rel='external'>http://www.millstream.com.au/view/code/tablekit/</a>)</li>
         <li>Extensions (extensions to script.aculo.us gathered from the web)</li>
      </ul>
      <p>For more details see <a href='http://wiki.e107.org/?title=JSHelper' rel='external'>the wiki page</a>.</p>
   </div>
   ";

$ns->tablerender($title, $text);

$title   = JSHELPER_LAN_ADMIN_01." - ".JSHELPER_LAN_ADMIN_PAGE_01;
$text    = "
      <table style='width:100%;'>
         <tr>
            <td class='forumheader2'>Fantabulous</td>
            <td class='forumheader3'>1.1</td>
         </tr>
         <tr>
            <td class='forumheader2'>Firebug Lite</td>
            <td class='forumheader3'>1.0</td>
         </tr>
         <tr>
            <td class='forumheader2'>Prototip</td>
            <td class='forumheader3'><script type='text/javascript'>document.write(Prototip.Version);</script></td>
         </tr>
         <tr>
            <td class='forumheader2'>Prototype JavaScript framework</td>
            <td class='forumheader3'><script type='text/javascript'>document.write(Prototype.Version);</script></td>
         </tr>
         <tr>
            <td class='forumheader2'>script.aculo.us</td>
            <td class='forumheader3'><script type='text/javascript'>document.write(Scriptaculous.Version);</script></td>
         </tr>
         <tr>
            <td class='forumheader2'>Tablekit</td>
            <td class='forumheader3'>1.2.1</td>
         </tr>
         <tr>
            <td class='forumheader2'>Extensions</td>
            <td class='forumheader3'>n/a</td>
         </tr>
      </table>
   ";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>