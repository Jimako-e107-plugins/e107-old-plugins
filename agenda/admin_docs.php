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
| $Source: E:/cvs/cvsrepo/agenda/admin_docs.php,v $
| $Revision: 1.10 $
| $Date: 2005/11/13 16:10:40 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_ADMIN."auth.php");
   require(e_PLUGIN."agenda/agenda_variables.php");

$pageid  = "docs";
$caption = AGENDA_LAN_ADMIN_10;
$text = "";

/*if (file_exists(e_PLUGIN."updatecheckerx/updatechecker.php")) {
   require_once(e_PLUGIN."updatecheckerx/updatechecker.php");
   $text .= updateChecker(AGENDA_LAN_NAME, AGENDA_LAN_VER, "http://www.bugrain.plus.com/e107plugins/agenda.ver", "|");
}  */

$text .= "<div style='padding:5px;'><div class='forumheader'>".
AGENDA_LAN_NAME." v".AGENDA_LAN_VER." by bugrain (agenda@bugrain.plus.com)</div>
<p>
Thanks for trying Agenda, hope you like it. This section aims to provide a few guidelines to help you configure Agenda to your liking
and generally get you up and running. If you can't find what you need here or work it out for yourself then please get in touch and I
will try to respond as soon as I can.
</p>

<p>
To use this document, click on a title to expand/collapse the section.
</p>

<div class='forumheader'><span onclick=expandit('s1')>Introduction</span>
<div id='s1' class='forumheader3' style='display:block;'>
   <div class='forumheader' onclick=expandit('s1_1')>Overview
   <div id='s1_1' class='forumheader3' style='display:block;'>
      <p>
      Agenda is desinged to be a comprehensive calendar, appointment and event organiser. Born from frustration with existing e107 calendar plugins
      and the need for some features not available from current offerings I decided to write my own. Beginning life in May 2005 as the naffly named
      eAgenda it quickly evolved into something bigger than I'd expected and was renamed to Agenda.
      </p>
      <p>
      Agenda has been written with e107 v0.7 in mind but I have tried to make it compatible with v0.617. v0.7 has some nice features that I'd like to
      make use of but as it is still evolving I've stuck to more well known approaches, i.e. I've copied other people's way of doing things - just
      like any decent programmer ;-)
      </p>
      <p>
      There's still much I'd like to put in to Agenda at this stage and I'm sure it will continue to evolve. There's also a desire to release it and
      let other e107 website admins have a look at it and, hopefully, like and use it. So for the time being, enjoy Agenda and what it does; if it
      doesn't work then tell me; if it doesn't do what you want but think it could or should, again let me know. Thanks for trying Agenda, I hope
      the next thing you do is not hit the Agenda uninstall button.
      </p>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s1_2')>The Basics
   <div id='s1_2' class='forumheader3' style='display:none;'>
      <p>
      There's a few things you need to be aware of to get you going. Hopefully, Agenda is fairly easy to get started with - it's not that different
      form other calendar type applications - but the following sections may just help clarify a few early questions
      </p>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s1_3')>The Basics - Configuration
   <div id='s1_3' class='forumheader3' style='display:none;'>
      <p>
      There are many configuration and preference options for Agenda but you don't have to understand them all at once. In the main, the default
      settings should be usable for a first installation. However, in time you will probably want to change some of these options to change the look
      of Agenda pages, add subscriptions, limit access to certain parts of Agenda, etc.
      </p>
      <p>
      I've tried to split the configuration into several pages of related options. This means there are quite a few admin pages, but each of them has
      a managable number of options on them.
      </p>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s1_4')>The Basics - Types
   <div id='s1_4' class='forumheader3' style='display:none;'>
      <p>
      Types are something that, as far as I know, are different to other calendar type applications. Types are basically a way
      of customizing the fields that are displayed and completed when an entry is added to Agenda. Types are website admin definable - some example
      types are creatred when Agenda is installed.
      </p>
      <p>
      How types are name is entirely up to the website administrator. The example type are name to reflect the attributes of an the type, for example
      Timed, Untimed, Floating, Recurring. You could just as easily name your types as Birthday, Meeting, Reminder, etc. though there are reasons why
      I believe that this level of naming is better suited to Categories (see next section).
      </p>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s1_5')>The Basics - Categories
   <div id='s1_5' class='forumheader3' style='display:none;'>
      <p>
      Categories are similar to categories in other calendar applications. Generally speaking, they do not have any functionality and are more
      designed to act as a way of grouping similar entries, for example Meetings, Reminders, Concerts, etc.
      </p>
      <p>
      This style of naming and grouping is better suited to categories than types (in my opinion) as entries of different types can still be grouped,
      displayed and filtered by category. For example, a Meeting category could applied to timed ad hoc meetings and recurring meetings.
      Subscriptions (see below) are also handled at category level which is another good reason for using this style of naming.
      </p>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s1_6')>The Basics - Event Registration
   <div id='s1_6' class='forumheader3' style='display:none;'>
      <p>
      Event registration allows the event creator to add a question to the event. Users who view the event can then answer this question, thus
      registering interest in the event. For example, the question may be \"Can you attend the meeting?\" and the user can answer Yes or No.
      </p>
      <p>
      When an event is viewed the users response, if one has been made, will be displayed. If the user is an Admin user then the responses from
      all the users who have responded will be displayed.
      </p>
      <p>
      Response questions can be added, updated and deleted in the <strong>Registration</strong> section of the Agenda Admin area. One question can
      be used by many events if required.
      </p>
      <p>
      Once the questions have been defined you need to ensure that the Registration field is added to any Type that you want Event Registration
      to be allowed for.
      </p>
      <p>
      <strong>Note:</strong> once a question has been used and one or more responses have been registered then you should not change the answers
      otherwise the existing responses will become invalid. The only change you are allowed to make is to add more answers to the <strong>end</strong>
      of the list of possible answers. This is because the user responses are stored as the answer number (1,2,3,etc.) to save space in the database.
      </p>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s1_7')>The Basics - Subscriptions
   <div id='s1_7' class='forumheader3' style='display:none;'>
      <p>
      Subscriptions are a way of automating notification of upcoming events. Any category can be set up to allow users to subscribe to it or to be a
      'force notification' category. In either case, the website administrator can choose to have E-Mails sent in advance of the start date of the
      entry, on the start date or both.
      </p>
      <p>
      <strong>Allow subscription categories</strong>: E-Mails will be sent to all users who have subscribed to the category which the entry belongs to.
      </p>
      <p>
      <strong>Force notification categories</strong>: E-Mails will be sent to all users that belong to the user class specified for the 'force
      notification to' field for this  category.
      </p>
      <p>
      For this implementation of Agenda, subscription notification E-Mails can only be sent if (a) the Agenda Subscription menu is an active menu and
      (b) the Agenda Subscription menu is displayed on all pages. In actual fact, (b) is not strictly true but does increase the chance that the
      E-Mails will be sent on the correct day. This is because the current system relies on the menu being displayed at least once per day so that
      it can generate the E-Mails. This type of functionality is better suited to a 'cron' task and hopefully this will be available in future
      versions of Agenda.
      </p>
   </div>
   </div>
</div>
</div>

<div class='forumheader'><span onclick=expandit('s2')>".AGENDA_LAN_ADMIN_MENU_00."</span>
<div id='s2' class='forumheader3' style='display:none;'>
   <div class='forumheader' onclick=expandit('s2_1')>".AGENDA_LAN_ADMIN_MENU_03."
   <div id='s2_1' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to set the general Agenda preferences. These are preferences that relate to the whole of the Agenda plugin.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_31_0."</dt>
            <dd>Determines who can view Agenda pages. This is the top most security level and allows you to restrict the Agenda plugin to specific
            user classes.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_01_0."</dt>
            <dd>Determines which users are allowed to add entries to Agenda. Only users that have thie specified user class will be shown the drop
            down list of types from which a selection can be made and an entry added.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_02_0."</dt>
            <dd>Determines which users can add categories (*** not currently used, reserved for future use).</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_06_0."</dt>
            <dd>Select the day that the week should start on.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_14_0."</dt>
            <dd>Select the folder (which is in the <code>e107_images</code> folder) that the icons used by Agenda are stored in. Changing this
            folder doesnot affect any references to icons that have already been set. This means you can change this value to point to new icons
            folder at any time.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_19_0."</dt>
            <dd>Select the default view that is displayed when a visitor clicks on your link to the Agenda plugin.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_44_0."</dt>
            <dd>When this option is selected users will only be able to see entries that have they have added. They will not be able to see anybody
            else's entries. Admins will always see all entries, regardless of this setting.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_47_0."</dt>
            <dd>When switched on allows people to post comments agaisnt Agenda entries.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_48_0."</dt>
            <dd>When switched on allows people to rate Agenda entries.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_99_0."</dt>
            <dd><strong>For beta testers use only</strong>. Turns on debugging statements. Warning: this can produce a lot of output as is not intended
            for a production website.</dd>
      </dl>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_2')>".AGENDA_LAN_ADMIN_MENU_06."
   <div id='s2_2' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to set global Agenda display preferences. These preferences relate to the way pages are rendered and can help define the 'look' of the Agenda pages.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_16_0."</dt>
            <dd>This text will be displayed at the top of the main page for all Agenda pages.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_13_0."</dt>
            <dd>Set this to the text to use for the title of the Agenda Navigation Menu.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_32_0."</dt>
            <dd>Set this to the text to use for the title of the Agenda Subscriptions Menu.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_15_0."</dt>
            <dd>Display navigation controls such as View selector, Go To date field, Add entry selector on the main page or in the Agenda Navigation menu.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_26_0."</dt>
            <dd>Shows a link for each month of the year to allow quick one click access to that month.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_09_0."</dt>
            <dd>The Cascading Style Sheet class that will be used for headers within Agenda.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_10_0."</dt>
            <dd>The Cascading Style Sheet class that will be used for days in calendar views within Agenda.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_11_0."</dt>
            <dd>The Cascading Style Sheet class that will be used for the current day in calendar views within Agenda.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_12_0."</dt>
            <dd>The Cascading Style Sheet class that will be used for days with entries in calendar views within Agenda.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_07_0."</dt>
            <dd>Set the length for day names that are displayed when space is limited.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_37_0."</dt>
            <dd>When selected, more detailed tooltips (displayed when a user hovers their mouse over an entry) will be displayed.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_39_0."</dt>
            <dd>When selected, links in Agenda entries to other pages of your site will be opened in a new browser window/tab.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_40_0."</dt>
            <dd>When selected, links in Agenda entries to other sites will be opened in a new browser window/tab.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_41_0."</dt>
            <dd>When selected, days with entires will be shown in the Agenda menu.</dd>
      </dl>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_3')>".AGENDA_LAN_ADMIN_MENU_07."
   <div id='s2_3' class='forumheader3' style='display:none;'>
      <p>
      This section allows setting of preferences that relate to specific views and lets you tailor certain views to suit your needs.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_03_0."</dt>
            <dd>Select this checkbox to hide empty time slots in day views.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_04_0."</dt>
            <dd>Select this checkbox to hide days with no entries in week views.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_05_0."</dt>
            <dd>Select this checkbox to hide days with no entries in month list style views.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_08_0."</dt>
            <dd>Set the length that entry titles will be truncated to when displayed in views where space is limited, such as the month grid view.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_17_0."</dt>
            <dd>Select this checkbox to display icons for entries when space is limited, such as the month grid view.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_18_0."</dt>
            <dd>Select this checkbox to display start times for entries when space is limited, such as the month grid view.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_38_0."</dt>
            <dd>Determines the number of entries to be displayed in the Recent Events view.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_42_0."</dt>
            <dd>The title text for the Upcoming Events menu.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_43_0."</dt>
            <dd>Determines the number of days to be displayed in the Upcoming Events menu.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_45_0."</dt>
            <dd>Sets the number of weeks that are displayed when the Multiple Weeks (AKA Next X Weeks) view is shown. Full weeks will be shown,
            starting from the first weekday of the current week.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_46_0."</dt>
            <dd>Sets the number of weeks to be displayed in the Next Weeks menu. Full weeks will be shown, starting from the first weekday of the
            current week.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_49_0."</dt>
            <dd>When selected, the Location field will be displayed with a link to Google Maps. This is useful when the location is a place names
            that Google Maps can find (e.g. 'London' or 'High Street, Middlesbrough').</dd>
      </dl>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_4')>".AGENDA_LAN_ADMIN_MENU_02."
   <div id='s2_4' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to add, update and delete the categories that Agenda uses.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_00_0."</dt>
            <dd>The name of the category.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_01_0."</dt>
            <dd>A description for the category. This description is displayed to users on the subscriptions page.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_02_0."</dt>
            <dd>An icon for the category. You can change the icon location on the ".AGENDA_LAN_ADMIN_MENU_03." page.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_09_0."</dt>
            <dd>Determines which user class can add and view entries belonging to this category.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_03_0."</dt>
            <dd>Determines whether users can subscribe to this category or not. Subscriptions can be voluntary or automatic (with or without notification). When notification is set, e-mail's are sent when an entry for the category is added, edited or deleted.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_04_0."</dt>
            <dd>For forced subscriptions select the user class that will be notified.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_05_0."</dt>
            <dd>Determines if E-Mails are sent to subscribers. If they are they can be sent in advance, on the day of the entry or both.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_08_0."</dt>
            <dd>The text for the E-Mail that will be sent for 'on the day' subscriptions.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_07_0."</dt>
            <dd>The text for the E-Mail that will be sent for advanced notifcation subscritions.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_CATEGORY_06_0."</dt>
            <dd>How many days in advance should notifications be sent out for this category.</dd>
      </dl>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_5')>".AGENDA_LAN_ADMIN_MENU_12."
   <div id='s2_5' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to manage event registration questions.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_REG_00_0."</dt>
            <dd>Enter a question that can be posed when an event is viewed</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_REG_01_0."</dt>
            <dd>Select how you would like the responses to be displayed</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_REG_02_0."</dt>
            <dd>Enter possible answers to the question. You must enter one question per line for the answers to be displayed correctly.</dd>
      </dl>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_6')>".AGENDA_LAN_ADMIN_MENU_11."
   <div id='s2_6' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to manage global subscription settings.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_33_0."</dt>
            <dd>Turn subscriptions on or off. When subscriptions are off no subscription E-Mails will be sent out and the Subscription menu will not be shown.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_34_0."</dt>
            <dd>The name that subscription E-Mails will be sent from, defaults to Site Admin. Name.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_35_0."</dt>
            <dd>The E-Mail address that subscription E-Mails will be sent from, defaults to Site Admin E-Mail.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_36_0."</dt>
            <dd>A prefix that, if present, will be prepended to the subscription E-Mail subject line.</dd>
      </dl>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_7')>".AGENDA_LAN_ADMIN_MENU_04."
   <div id='s2_7' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to add, update and delete the entry types that Agenda uses.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_00_0."</dt>
            <dd>The name of the type.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_01_0."</dt>
            <dd>A description for the type. This description is displayed on the types help page available to the user.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_02_0."</dt>
            <dd>Tick this box to make entries of this type timed entries. Timed entries have a start time which is displayed when the entry is shown in a view.
            Untimed entries do not have a start time and are displayed first for any day, before any timed entries. Multiple timed entries for a day are displayed in time order.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_06_0."</dt>
            <dd>Tick this box to make entries of this type floating entries. A floating entry has a start date and is displayed on this day whilst todays date is before the entries start date.
            Once todays date is after the entries start date then the entry will be displayed on todays date until it is marked as complete, deleted, etc.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_07_0."</dt>
            <dd>Tick this box to make entries of this type recurring entries. A recurring entry has a start date and repeats periodically based on the selection made when the entry is added or updated.
            Recurring entries only have one entry in the database so updating a recurring entry will, in effect, update all occurrances.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_03_0."</dt>
            <dd>Highlight the entries in the list that will be diaplyed when entries of this type are added, updated and displayed.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_04_0."</dt>
            <dd>Choose which type of user can create entries of this type. Note that users must be in the user class seleted in ".AGENDA_LAN_ADMIN_MENU_03." for adding entries,
            this option is designed to limit specific types to sub-classes of users if required.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_TYPE_05_0."</dt>
            <dd>Choose which type of user can update and delete entries of this type.</dd>
      </dl>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_8')>".AGENDA_LAN_ADMIN_MENU_08."
   <div id='s2_8' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to define up to four custom fields that can be associated with an entry type. These custom fields will then be
      displayed when an entry of that type is added or updated.
      </p>
      <p>
      You must define your custom fields here first. You can then add them to the list of displayed fields on the Types page for any type that
      you want to display a custom field or fields.
      </p>
   </div>
   </div>
   <div class='forumheader' onclick=expandit('s2_9')>".AGENDA_LAN_ADMIN_MENU_05."
   <div id='s2_9' class='forumheader3' style='display:none;'>
      <p>
      This section allows you to import data from the e107 Events Calendar database.
      </p>
      <p>
      <strong>NOTE</strong> it is unlikely that this option will be completely successfull if you try and import data more than once without emptying
      the Agenda database first.
      </p>
      <dl>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_20_0."</dt>
            <dd>Displays lots of information about what happened during the install. Turning this off will reduce the information displayed and just give 'highlights'</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_21_0."</dt>
            <dd>Delete all entries from the Agenda database tables before importing. <strong>This option removes all data from all Agenda tables except the Types table</strong></dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_22_0."</dt>
            <dd>Import data from the standard e107 Calendar. Currently this is the only supported calendar to import data from.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_24_0." *</dt>
            <dd>Select the default Agenda type that timed entries will be set to. Timed entries are entries that have at least a start time.</dd>
         <dt style='font-weight:bold'>".AGENDA_LAN_ADMIN_PREFS_25_0." *</dt>
            <dd>Select the default Agenda type that 'all day' entries will be set to. 'All day' entries are entries that do not have a start or end time.</dd>
      </dl>
      <p>
      * For these options to work correctly you must have some types already defined in Agenda. By default, some sample types are added during the install.
      </p>
   </div>
   </div>
</div>
</div>

";

$ns->tablerender($caption,$text);

require_once(e_ADMIN."footer.php");
?>
