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
| $Source: e:\_repository\e107_plugins/agenda/admin_readme.php,v $
| $Revision: 1.14 $
| $Date: 2006/05/03 21:09:48 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_HTTP."index.php"); exit; }
require_once(e_ADMIN."auth.php");

require(e_PLUGIN."agenda/agenda_variables.php");

$pageid  = "readme";
$caption = AGENDA_LAN_ADMIN_09;

if (file_exists(e_PLUGIN."updatechecker/updatechecker.php")) {
   require_once(e_PLUGIN."updatechecker/updatechecker.php");
   $text .= updateChecker(AGENDA_LAN_NAME, AGENDA_LAN_VER, "http://www.bugrain.plus.com/e107plugins/agenda.ver", "|");
}

$text .= "<div style='padding:5px;'>".
AGENDA_LAN_NAME." v".AGENDA_LAN_VER." by bugrain (agenda@bugrain.plus.com)<br>
<br>
A plugin for the e107 Website System (http://e107.org)<br>
<br>
Released under the terms and conditions of the<br>
GNU General Public License (http://gnu.org).<br>
<hr>

<p>Agenda is a calendar, appointment and event organiser.</p>

<p>
Agenda is configurable from the Admin area of e107. Many aspects of Agenda can be configured, from who can add and maintain entries
to styles used for drawing calendar views to managing types and categories - plus much more.
</p>

<p>Use normal e107 plugin installtion procedures to install Agenda.</p>

<u>Features:</u>
<ul>
   <li>Multiple calendar views - including day, week, month, year</li>
   <li>Multiple calendar entry types - timed, untimed, floating</li>
   <li>Entry types can be defined by the site administrator</li>
   <li>Categories can be subscribed to to get e-mail notification of upcoming events</li>
   <li>Event registration allows users to respond to a question about the event</li>
   <li>Can be used for individual calendars - users only see their own entries</li>
   <li>Configure who can add and maintain entries globally or by entry type</li>
   <li>Calendar navigation can be displayed on main page or in Calendar menu</li>
   <li>Configure the display of the calendar and individual views</li>
</ul>

<p>See the <a href='admin_docs.php'>Documentation</a> area for more details</p>

<hr>

   <div><span onclick=expandit('changelog') style='cursor:pointer'><u>Changelog:</u> (click to show/hide)</span>
      <div id='changelog'style='display:none;'>
      <br />(+ New Feature, - Removed Feature, * Bug fix)<br /><br />
      <ul>
         <li>1.6 (03May2006)</li>
            <ul>
               <li>+ Mark private entries so obvious they are private</li>
               <li>* (steved 14Jan2006, e-mail) Calendar menu shows negative totals on days with no events and incorrect month total.</li>
               <li>* (shmuelios 01Apr2006 bugrain forum) clicking Register or Deregister it displays 'undefined'</li>
               <li>* (bugrain) Recent entries shows private entries when it should not</li>
               <li>* (Benji Selano 08Jan2006 e-mail) When defining in the General Preferences that the week starts on Sunday, the Calendar app (When selecting the Start\End date of a task) always starts on Monday.</li>
               <li>* (bugrain 05Dec2005) Comments added to events are not showing up correctly in 'latest' menus</li>
               <li>* (KVN 15Nov2005) Default value for agn_end column should be -1.</li>
               <li>* (bugrain) Fix anchor link URL in Next Weeks menu</li>
               <li>* (bugrain) 2 day view not showing 2nd day items correctly (at all?)</li>
            </ul>
         <li>1.5 (13/Nov/2005)</li>
            <ul>
               <li>+ (Krutch  25Oct05) Show number of registrations by answer as well as total registrations.</li>
               <li>+ (shmuelios, Agenda 1.3 @ e107coders.org, 24Oct05) Add e_frontpage.php file</li>
               <li>+ (smiley, e-mail, 02Nov2005) Add no events message if no events in next X days on upcoming menu</li>
               <li>+ (bugrain) move Filter and Search buttons in to View drop down</li>
               <li>+ (bugrain) Dynamic hide/show of filtered entries.</li>
               <li>+ (Krutch  25Oct05) There is no way a user can unregister himself.</li>
               <li>+ (bugrain) Registration now uses Ajax technology so no page level refresh.</li>
               <li>+ (shmuelios, e-mail, 27OctNov2005) Link location field to Google maps</li>
               <li>+ (shmuelios, e-mail, 27OctNov2005) Make e-mail addresses HTML rather than mailto to help avoid spam</li>
               <li>+ (shmuelios, e107codres, 04Nov2005) Allow recent events view to have alternating styles</li>
               <li>+ (bugrain) Implement basic caching</li>
               <li>+ (Bill Schmidt) User classes for categories to make some entries private</li>
               <li>+ (bugrain) 'At A Glance' page - no. events owned, subscriptions, registrations, etc.</li>
               <li>- Filter and subscriptions views - they are now available from the At A Glance page.</li>
               <li>* (Krutch 25Oct05) When I delete a user his answer on the registration (and thus the count) still stays on the list.</li>
               <li>* (several) 'Stack overflow at line 15/Too much recursion' clicking on the dhtml calendar and select a date</li>
               <li>* (bugrain) Some general HTML tidy up (Warnings from HTMLTidy)</li>
               <li>* (Krutch 27Oct05) Registration always 1st option using IE/opera and radio buttons (actually a browser 'bug' with Agenda workaround).</li>
               <li>* (bugrain) Upcoming events were starting from current Agenda date rather than todays date</li>
               <li>* (bugrain) Sort user reponses into alphabetical order for registration display</li>
               <li>* (bugrain) Diary code for recurring events should be expanded to 'English' when entry is viewed</li>
               <li>* (bugrain) Use e107Helper DB class and removed local db_extra class.</li>
               <li>* (bugrain) Move JavaScript to agenda.js file and include once only per page.</li>
               <li>* (bugrain) Attempts to fail more gracefully if e107 Helper Project plugin not installed (or at least provide more info).</li>
            </ul>
         <li>1.4 (24/Oct/2005)</li>
            <ul>
               <li>+ Allow comments for entries, added global options to turn on/off</li>
               <li>+ Allow ratings for entries, added global options to turn on/off</li>
               <li>+ Display number of users who have registerd for an event</li>
               <li>+ Add print option to year view</li>
               <li>* Month list always starts with same day (Saturday) and only shows this months events</li>
               <li>* 2 day view has 'no events today' spanning both days when no events</li>
               <li>* Version number should not be in language file</li>
               <li>* Various issues with print views</li>
               <li>* Prevent guests from registering for events (user id needed)</li>
               <li>* Updated description for 'Navigation on main page' to clarify what it does</li>
               <li>* Untimed event for OCT 31 shows up in upcoming events as being on the 30th - daylight saving bug</li>
               <li>* Removed output from Subscriptions menu. Still needs to be enable to get subscriptions to work</li>
               <li>* In the mini calendar the picture is X because the path is wrong</li>
               <li>* Recurring items not on upcoming events menu</li>
               <li>* Today's date is highlighted multiple times in Next X Weeks views when the same day number is seen in the following month</li>
               <li>* Viewing an item no longer shows current 'user' date in item title area - was confusing.</li>
            </ul>
         <li>Version 1.3 (04/Oct/2005):
            <ul>
               <li>+ Add the [today] tab in upcoming events menu
               <li>+ Next Multiple Weeks view
               <li>+ Added Next Weeks Menu
               <li>+ Added subscriptions view
               <li>* Check for e107 version is incorrect (e107Helper class)
               <li>* Import fails (new columns)
               <li>* Subscriptions menu not showing correct values
               <li>* Missing column (agn_responses) in create Agenda table SQL
               <li>* slowdown using upcoming events menu
               <li>* private entries can be seen by entering URL direct.
            </ul>
         <li>Version 1.2 (02/Oct/2005):
            <ul>
               <li>Added event registration to allow users to register their interest in an event</li>
               <li>Added option to make all agenda entries private (apart from visible to admin users)</li>
               <li>Added print option to several views</li>
               <li>Added 'upcoming events' menu</li>
               <li>Option to open links in a new window</li>
               <li>Added detailed tooltips option</li>
               <li>Added option to display icons in menu</li>
               <li>Added recent addition view limit option</li>
               <li>Added ability to change item type</li>
               <li>Re-written to encapsulate much of Agenda common code in to a single class - helps prevent interference with other plugins</li>
               <li>Fixed some 0.617 subscription related bugs</li>
               <li>eCalendar import big fixes</li>
               <li>Other minor bug fixes</li>
            </ul>
         </li>
         <li>Version 1.1:
            <ul>
               <li>Fixed language file inclusion</li>
               <li>Fixed some minor SQL issues</li>
               <li>Added HTML title attributes (i.e. popups/tooltips) for entries when hovered over with mouse</li>
               <li>Can now import from eCalendar plugin</li>
               <li>Fixed display of Agenda menu when viewing on other pages - days with entries now show as having entries</li>
               <li>Added a new view - Recent Entries. (Basic for now, just shows last 25 entries)</li>
               <li>Other bug fixes</li>
            </ul>
         </li>
         <li>Version 1.0:
            <ul>
               <li>Added subscriptions</li>
               <li>Added documentation page in Admin area</li>
               <li>Now uses Update Checker plugin to automatically check for updates</li>
               <li>Added four Admin definable Custom Fields</li>
               <li>Added Entry Owners and Entry Complete to things that can be used to filter displayed entries</li>
               <li>Filtering now works by choosing things to hide - this is better when new categories, types, etc. are added</li>
               <li>Added some field validation - missing fields, invalid values</li>
            </ul>
         </li>
         <li>Version 0.4 beta:
            <ul>
               <li>Optional month links</li>
               <li>Attempts to make work with e107 v0.617</li>
               <li>Add items in batch mode option</li>
               <li>New view - 2 day</li>
               <li>Misc bug fixes</li>
            </ul>
         </li>
         <li>Version 0.3 beta:
            <ul>
               <li>Made it work with e107 v0.617 as well as v0.7</li>
            </ul>
         </li>
         <li>Version 0.2 beta:
            <ul>
               <li>Recurring events</li>
               <li>Import from e107 Calendar</li>
               <li>Agenda Search facility</li>
               <li>Entry filtering option</li>
               <li>Lots of bug fixing and layout tinkering</li>
      	   </ul>
      	</li>
         <li>Version 0.1 beta:
            <ul>
               <li>first beta release</li>
      	   </ul>
      	</li>
      </ul>
      </div>
   </div>
</div>";

$ns->tablerender($caption,$text);

require_once(e_ADMIN."footer.php");
?>
