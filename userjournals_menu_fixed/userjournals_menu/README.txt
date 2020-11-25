==============================================================================================
User Journals - 0.4 - by bugrain 11-Dec-2005
http://www.bugrain.plus.com
Email: bugrain@bugrain.plus.com

==============================================================================================
This e107 plugin for use with the e107 CMS system (e107.org),
is free software that I release under the GNU General Public License.
You may redistribute and/or modify this program under the terms of that license
as published by the Free Software Foundation.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

==============================================================================================
Original author:
User Journals plugin for e107 (http://e107.org/)
Copyleft 2003 by Del Rudolph (http://www.downinit.com/)
Released under the GNU GPL (http://www.gnu.org/)

==============================================================================================
Purpose:
This plugin allows the e107 CMS to support individual journals for
registered/logged-in users. Each user gets their own journal, and
can write, edit, and delete their entries. Admin has the option of
totally disabling User Journals, as well as restricting access to
logged-in users only.

THIS PLUGIN IS ONLY KNOWN TO WORK WITH e_107 VERSION .6+ and .7!

==============================================================================================
Installation:
1) Unzip file
2) Upload the created files to your e107_plugins directory, making sure
	to maintain the existing directory structure.
3) Visit e107 Admin -> Plugin Manager and install UserJournals
4) Follow the instructions given there to complete your installation

==============================================================================================
Upgrade:
1) Unzip file
2) Upload files to your e107_plugins/userjournals_menu, replacing all files
3) Go to Admin > Plugin Manager to update UserJournals
4) Go to Admin > UserJournals to update your settings

==============================================================================================
Version History:

0.8 -- 31-Aug-2006 by bugrain
   + (bugtracker #41) [gui] Set number of bloggers in menu
   + (bugtracker #74) [core] Writer menu customization
   * (bugtracker #28) [gui] Menu links to individual bloggers are broken
   * (bugtracker #29) [gui] Blogger name at top of page can be wrong
   * (bugtracker #89) [gui] New/recent entries are incorrect

0.71 -- 09-May-2006 by bugrain
   * Fixed templating bug where template ariables were not visibale globally when not on UJ main page
   * Fixed multi-use of $sql bug in templates
   * Fixed missing blog date in menu (teamplates)

0.7 -- 09-May-2006 by bugrain
   + (bugrain, 06May2006) Add templating ability
   + (bugrain) Split menu in to two
   + (bugrain) Show comments in list new/recent menus and pages
   + (TED K, e-mail, 04May2006) Blog categories
   + (pcolson, e107coders, 23Jan2006) An option to change/keep original the datestamp
   * (bugrain, 06May2006) Fix for list plugin listing new entries correctly
   * (bugrain, 12Jan2005) If blog length<preview length there is no link to blog so you cannot see comments/ratings
   * (Steffen Tronstad, email, 03Feb2006) Cannot comment on 'short' blogs.
   * (bugrain) Remove blogger name from URL parameters (was causing problems for some names)
   * (bugrain) RSS is broke if upgraded from pre-RSS version of UserJournals
   * (bugrain) Emoticon availability now follows Emoteicon preference
   * (70r3, bugtracker@e107coders, 01Jan2006) When UJ is uninstalled, remove comments for all blogs.

0.6 -- 12-Jan-2006 by bugrain
   + (Bill Shmidt, email, 29Dec2005) Make mood and now playing optional via admin page.
   * (webturtle0, e107coders, 31Dec2005) Unpublished blogs should not be counted in blog totals
   * (mankan, e107coders, 30Dec2005) New synopsis can not be saved (SQL error)
   * (bugrain, 03Jan2006) Extra RSS icon left in from some e107 Helepr testing removed
   * (bugrain, 11Jan2006) Ensure unpublished blogs not shown in 'New item' menus
   * (bugrain, 11Jan2006) Ensure unpublished blogs not shown in search results

0.5 -- 27-Dec-2005 by bugrain
   + (bugrain, 11Dec2005) Add e_list.php to show new blogs in the e107 list new/recent menus and pages.
   + (bugrain, 11Dec2005) Allow admins to delete blogs.
   + (wolfey, e107coders, 12Dec2005) Add main page with options as per 'Blog Writer' menu.
   + (srfax, e107coders, 11Dec2005) Include photo from user profiles on bloggers main page.
   + (bugrain, 11Dec2005) Add RSS links, make optional.
   + (70r3, e107coders, 18Dec2005) Add option to publish blogs (to allow blogs to be written over time and published when finished)
   + (bugrain) Add a link to 'all blogs'
   * (bugrain, 11Dec2005) List of bloggers (menu and default page) should be ordered by most recent poster.
   * (GileS@e107coders, 12Dec2005) User names with spaces show with %20 instead of space.
   * (bugrain, 16Dec2005) Synopsis and blogs are not parsed for BB codes
   * (70r3, bugtracker@e107coders, 19Dec2005) Mood settings need language translation

0.4 -- 11-Dec-2005 by bugrain
   + Requires e107 helper Project plugin v0.4+
   + renamed userjournal_conf.php to admin_conf.php
   + added admin_readme.php for view from admin aread
   + Added some more language defines
   + Menu split in to two sections for blog readers and writers.
   + Allow blogs to be rated.
   + Each user can have a blog Sysnopsis (overview).
   + New preferences: Page title and menu title can be set by Admin.
   + New preference: user class settings for readers, writers, commenters, raters.
   + New preference: Subject line in menu and blog preview text length can be set by Admin.
   + New preference: Number of recent entries for current user can be set by Admin.
   + New menu entries: Link to a list of all bloggers, link to each users blog.
   + Blog comments now handled as standard e107 comments.

0.31 -- 08-May-2005 by bkwon
	+ Updated to e107 v0.7 compatible
	+ Added database upgrade for 0.2+ to 0.31
	Known bug: When editing a journal, now playing field becomes blank and needs to be entered again

	Files changed by this update (from 0.3):
		plugin.php
		userjournals.php

0.30 -- 30-Jan-2005 by SKiTZ716 (skitzo.at.stupid5pin.com) http://www.stupid5pin.com/e107
	+ Added mood images and now playing

0.23 -- 15-Jan-2005 by bkwon
	+ Search
	+ Edit Comment (and associated admin setting)
	+ After saving Comment, redirect page back to journal
	+ After saving edited Journal, redirect page back to journal
	+ Bug fix: when deleting a journal, associated comments are now deleted
	+ Bug fix: text parsing of apostrophe caused SQL error
	+ XHTML 1.1 compliance

	Files changed by this update (from 0.22):
		plugin.php
		userjournals.php
		userjournals_conf.php
		/languages/admin/English.php
		/languages/English.php

	New files:
		e_search.php
		search.php

0.22 -- 28-Dec-04 by bkwon

	Added "My Last 7 Entries" in menu, Edit and Delete when user is viewing a journal
	Files changed by this update (from 0.21):
		plugin.php
		userjournals.php
		userjournals_menu.php
		userjournals_menu/languages/English.php

0.21 -- 06-Nov-04 by bkwon

	Added support for bbcode and emotes and tested for v0.617

0.2 -- Second rendition of User Journals -- e107 v600 compatibility
August 17-31, 2003
	rewrite of most parts
	added comments to journal posts
	should be multi-language-able

0.1 -- First rendition of User Journals
July 07, 2003
	added emoticon support (emoticons must be site-wide enabled by admin)
July 08, 2003
	Squashed bug with spaces in username (Thanks, Lolo Irie)
	Added 'Five most recent Journal entries' (Thanks gefy)
July 09, 2003
	Fixed table rendering problem in IE (Thanks, Lolo Irie)
July 13, 2003
	Fixed bug preventing deletion of journal entries
