<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_HTTP."index.php"); exit; }
require_once(e_ADMIN."auth.php");

$pageid  = JOURNAL_MENU_99;

$text .= "<div style='padding:5px;'>".
JOURNAL_A0." ".JOURNAL_VERSION." by bugrain<br>
<br>
A plugin for the e107 Website System (http://e107.org)<br>
<br>
Released under the terms and conditions of the<br>
GNU General Public License (http://gnu.org).<br>
<hr>
This plugin allows the e107 CMS to support individual journals for
registered/logged-in users. Each user gets their own journal, and
can write, edit, and delete their entries. Admin has the option of
totally disabling User Journals, as well as restricting access to
logged-in users only.
<br /><br />
THIS PLUGIN IS ONLY KNOWN TO WORK WITH e_107 VERSION .6+ and .7!
<br /><br />
<u>Features:</u>
<ul>
   <li>Individual journals for individual users</li>
   <li>Journals can be limited to specific users by userclass</li>
   <li>Journals viewing can be limited by user class</li>
   <li>Journal entries can be commented on by other</li>
</ul>

<hr>

<u>Changelog:</u>
<ul>
   <li>Please refere to the <a href='README.txt'>README.txt</a> file for full change details.
</ul>
</div>";

$ns->tablerender(JOURNAL_MENU_99, $text);

require_once(e_ADMIN."footer.php");
?>
