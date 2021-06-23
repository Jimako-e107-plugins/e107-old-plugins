#==============================================================================+
#   p_writer - A plugin for entering and showing stories, by Paul Kater
#
#   Plugin Support Website: [link=external=http://www.nlpagan.net]www.nlpagan.net[/link]
#
#   A story display plugin for the e107 Website System; visit [link=external=http://e107.org/]e107.org[/link]
#   For more plugins visit: [link=external=http://plugins.e107.org/]plugins.e107.org[/link]
#   or [link=external=http://www.e107coders.org/]e107coders.org[/link]
#
#==============================================================================+

Thank you for trying p_writer.

Purpose and history of the p_writer plugin
==========================================
The p_writer plugin is meant to help writers in showing (parts of) their work online.
The [b]front-end[/b] is an easy way to show stories and click through to chapters and their contents.
The [b]back-end[/b] contains the necessary software to enter new genres, storynames and chapters to the stories. Optionally you can add a storygroup to a story. Provisions to edit and/or delete stories are there also.
p_writer is [b]not[/b] meant to be a tool for writing stories. For this I can recommend [link=external=http://www.writerscafe.co.uk/]Writer's Café[/link].


Prerequisites
=============
* E107 core v0.7.* (or newer) installed.


Installation
============
a. Upload the p_writer plugin directory to your 'e107_plugins' folder. Although 'Upload plugin' from the Admin section might work, uploading your plugin files by using an FTP client program is recommended.
b. When working on Linux or Unix based server, CHMOD all directories to 755 and CHMOD all .php files to 644.
c. Login into e107 as administrator, go to Plugin Manager, install P_writer and give it a try.


Features
========
For visitors
* Overview of stories, optionally grouped on storygroup (preference setting)
* Click through to chapters in a story (if there is only 1 chapter, that will be shown immediately after clicking the story-name)
* Links to go to next/previous chapter or return to overview, at the bottom of a chapter
* Admins, when logged in, will see a small eye at the bottom right of each section. Clicking that will take you to the edit-mode of the appropriate item:
-- from the story overview to the main admin panel
-- from the chapter overview to editting the chapters of the story
-- from viewing chapter content to editing the actual chapter content

For admins
* Input and edit of single- or multi-chapter stories
* Genre selection
* Optional storygroups (to group stories of similar content/topic/main character together, e.g. on main character name)
* Story can be hidden from overview (e.g. for a work in progress)
* Show chapter-overview in 1 or 2 columns
* Option to switch to 2 column chapter overview automatically after a certain number of chapters has been reached to avoid lengthy pages.
* Deletion of a story (this also deletes all chapters)
* Manual ordering of story sequence inside a storygroup


Updates
=======
Not applicable.


Styling your stories
====================
Copy the template file (pw_template.php) from the p_writer/templates folder to your theme folder and adjust it there. The plugin checks if there is a customised template in your theme folder. If P_writer can't find it in the theme folder you use, it will use the default one. p_writer is set up to use the css-file from your current theme.


Demonstration
=============
For a demonstration of the front-end (the stuff that visitors see) on the web, go [link=external=http://www.nlpagan.net/e107/plugins/p_writer/p_writer.php]here[/link].


Changelog
=========
* June 2010: Initial version 1.0
* July 2010: Patch version 1.1
-Discovered a bad mistake in the update-section for chapter text. Please apply this patch immediately.
-Copying the file admin_pwconf.php is the fastest way as the error was in there.

Story loading
=============
To import my existing stories, I have created a crude 'importer'. If you are interested in it, get in touch with me through paul at nlpagan dot net. It is easily integrated into p_writer.


Future roadmap
==============
* Implement functionality for imagelink (to show a picture or coverart with your story)
* Admin interface screenshots on info-page
* Selection/filtering of genre on the visitor mainpage
* Selection of a specific storygroup on the visitor mainpage
* Interface changes


License
=======
p_writer is distributed as free open source code released under the terms and conditions of the [link=external=http://gnu.org/]GNU General Public License[/link].
