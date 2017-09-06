<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/languages/English.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:08 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

// Main plugin name
define("EHD_LAN_E107HELPER_DEVELOPER",    "e107Helper Project - Developers examples");

define("EHD_LAN_PAGE_10",           "Introduction");
define("EHD_LAN_PAGE_20",           "Ajax");
define("EHD_LAN_PAGE_30",           "Comments");
define("EHD_LAN_PAGE_35",           "Ratings");
define("EHD_LAN_PAGE_40",           "Textareas");
define("EHD_LAN_PAGE_50",           "Notifications (PM)");
define("EHD_LAN_PAGE_60",           "Charts");
define("EHD_LAN_PAGE_70",           "Tooltips");
define("EHD_LAN_PAGE_80",           "Miscellaneous");

define("EHD_LAN_BACK_TO_MAIN",      "Back to ".EHD_LAN_E107HELPER_DEVELOPER);

define("EHD_LAN_PAGE_10_P1",        "<strong>What is this plugin?</strong>");
define("EHD_LAN_PAGE_10_P2",        "Basically, it's a series of pages that are designed to show some of the features of The e107 Helper Project plugin.");
define("EHD_LAN_PAGE_10_P3",        "The Helper plugin is written and maintained by me, bugrain. It's aim is to allow quicker development of e107 plugins by bringing together common functionality in one place.");
define("EHD_LAN_PAGE_10_P4",        "Have a look through the rest of these pages to see what can be accomplished, then have a look a the PHP code that generates the pages to see how it's done - you'll find plenty of comments in the code to explain what's being done. The page layouts are a little basic, but that is deliberate - templating and shortcodes have been left out to keep the code simpler.");
define("EHD_LAN_PAGE_10_P5",        "Note: some of the code in this plugin is there to demonstrate the Helper plugin and some of it is just there to make this plugin work. Feel free to copy the way I've organised the code. However, I make no claim that this is the best way to write an e107 plugin - but it works for me.");
define("EHD_LAN_PAGE_10_P6",        "");
define("EHD_LAN_PAGE_10_P7",        "Use the following links to see the demonstration pages:");

// Page 20 - Ajax
define("EHD_LAN_PAGE_20_H1",        "Using JavaScript");
define("EHD_LAN_PAGE_20_H1_1",      "The JavaScript supplied with e107 Helper Project provides a series of functions that integrate with the e107 Ajax JavaScript.");
define("EHD_LAN_PAGE_20_H1_2",      "These functions can do fairly simple stuff such as notifying the user with a message to replacing parts of a web page. Most of the power, though, wil lcome from the PHP code you write on the server.");

define("EHD_LAN_PAGE_20_H2",        "Populate part of the page");
define("EHD_LAN_PAGE_20_H2_1",      "A simple example that sends a request to get some date (date/time) from the server which is sent back to the page and displayed in a DIV.");
define("EHD_LAN_PAGE_20_H2_2",      "Show me");

define("EHD_LAN_PAGE_20_H3",        "JavaScript alert");
define("EHD_LAN_PAGE_20_H3_1",      "Grab the users attention - use an alert popup.");
define("EHD_LAN_PAGE_20_H3_2",      "Alert me");

define("EHD_LAN_PAGE_20_H4",        "HTML popup 'dialog'");
define("EHD_LAN_PAGE_20_H4_1",      "Create your own forms using HTML to get user input without refreshing the whole page");
define("EHD_LAN_PAGE_20_H4_2",      "Ask me");

define("EHD_LAN_PAGE_20_H3",        "");
define("EHD_LAN_PAGE_20_H3_1",      "");
define("EHD_LAN_PAGE_20_H3_2",      "");

define("EHD_LAN_PAGE_20_H3",        "");
define("EHD_LAN_PAGE_20_H3_1",      "");
define("EHD_LAN_PAGE_20_H3_2",      "");

define("EHD_LAN_PAGE_20_H3",        "");
define("EHD_LAN_PAGE_20_H3_1",      "");
define("EHD_LAN_PAGE_20_H3_2",      "");

define("EHD_LAN_PAGE_20_H3",        "");
define("EHD_LAN_PAGE_20_H3_1",      "");
define("EHD_LAN_PAGE_20_H3_2",      "");

// Page 30 - Comments and Ratings
define("EHD_LAN_PAGE_30_H1",        "Adding comments and ratings to an item");
define("EHD_LAN_PAGE_30_H1_1",      "Comments and ratings can be added with a single call each and are linked to an item from your plugin, or even just to your plugin in general. All that is required is a unique text identifier for your plugin and a unique identifier for the item to have comments or be rated.");

define("EHD_LAN_PAGE_30_H2",        "Comments");
define("EHD_LAN_PAGE_30_H2_1",      "Comments associated with a pseudo item from this plugin. Note: once you have rated this item, you will not be able to rate it again.");

define("EHD_LAN_PAGE_30_H3",        "Ratings with text");
define("EHD_LAN_PAGE_30_H3_1",      "Ratings associated with a pseudo item from this plugin.");

define("EHD_LAN_PAGE_30_H4",        "Ratings, graphics display only");
define("EHD_LAN_PAGE_30_H4_1",      "This shows the ratings score (for the same item as above) in graphic form only. Rating by a user is not permitted in this case.");

define("EHD_LAN_PAGE_30_H5",        "Total comments");
define("EHD_LAN_PAGE_30_H5_1",      "This shows the number of comments (for the same item as above)");

// Page 40 - Textareas
define("EHD_LAN_PAGE_40_H1",        "Adding a textrea to a page/form");
define("EHD_LAN_PAGE_40_H1_1",      "Textareas can be esily created with a single call to e107 Helper, passing in various paramters to get the right look and functionality.");

define("EHD_LAN_PAGE_40_H2",        "Default");
define("EHD_LAN_PAGE_40_H2_1",      "All parameters left at default values.");

define("EHD_LAN_PAGE_40_H3",        "Content, Width and BBCodes");
define("EHD_LAN_PAGE_40_H3_1",      "Passed in some content, set the width to 30 columns and requested BBCode buttons.");

define("EHD_LAN_PAGE_40_H4",        "Width, BBCodes and Emoticons");
define("EHD_LAN_PAGE_40_H4_1",      "Set the width as a percentage (75%) of the available area and requested BBcode buttons and emoticon images links.");

// Page 60 - Charts
define("EHD_LAN_PAGE_60_H1",        "How it works");
define("EHD_LAN_PAGE_60_H1_1",      "The charts in e107 Helper Project are displayed using <strong>XML/SWF Charts</strong> from <a href='http://www.maani.us/xml_charts/'>maani.us</a>. The software is free to download and use, registration is possible if required (see web site for more details).");
define("EHD_LAN_PAGE_60_H1_2",      "The charts are displayed by a small flash file that reads the chart information from an XMl document. This document can be a file on a server or can be generated on the fly by PHP script (or, indeed, any server side programming language).");

define("EHD_LAN_PAGE_60_H2",        "Chart from an XML file");
define("EHD_LAN_PAGE_60_H2_1",      "Generates a chart from an XML file. One of the advantages of creating an XML file is that the code could be written to only generate the XML file when it needs to be updated. The file would then be cached by the browser.");

define("EHD_LAN_PAGE_60_H3",        "Chart from PHP script");
define("EHD_LAN_PAGE_60_H3_1",      "Generates a chart on the fly using PHP. No intermediate file is required using this method and the default chart size is overridden");

// Page 70 - Tooltips
define("EHD_LAN_PAGE_70_P1",        "This page demonstrates a few tooltip examples. Move your mouse over the link, image, etc. to see the tooltip.");
define("EHD_LAN_PAGE_70_P2",        "The code for this page is in the function <i>getPage70()</i> in the file <i>e107helpers_developer_class.php</i>.");

define("EHD_LAN_PAGE_70_H1",        "Simple tooltip for a link, just text - no caption");
define("EHD_LAN_PAGE_70_H1_1",      "This tooltip uses the default styling values.");
define("EHD_LAN_PAGE_70_T1_1",      "This is a link to Google");

define("EHD_LAN_PAGE_70_H2",        "Tooltip for an image with caption and text");
define("EHD_LAN_PAGE_70_H2_1",      "This tooltip is styled with some standard e107 CSS classes (forumheader, forumheader2, forumheader3).");
define("EHD_LAN_PAGE_70_T2_1",      "<p>This is the <strong>welcome</strong> image from the e107 newspost_images folder.</p><p>This folder is in the e107_images folder.</p><p>Notice that <strong><i>HTML</i></strong> can be used to format the tooltip text.</p>");
define("EHD_LAN_PAGE_70_T2_2",      "welcome.png");

define("EHD_LAN_PAGE_70_H3",        "Tooltip for some (span) text");
define("EHD_LAN_PAGE_70_H3_1",      " tooltip ");
define("EHD_LAN_PAGE_70_H3_2",      "This tooltip styles the tooltip caption but uses default CSS classes.");
define("EHD_LAN_PAGE_70_H3_3",      "<p>This is a a bit of text that has a tooltip for some of the text.</p><p>Some styling is done to emphasize the text with the tooltip and the tooltip itself has different styling to the image tooltip (above).</p>");
define("EHD_LAN_PAGE_70_T3_1",      "<p>The <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'> is a common graphical user interface element. It is used in conjunction with a cursor, usually a mouse pointer. The user hovers the cursor over an item, without clicking it, and a small box appears with supplementary information regarding the item being hovered over. A common variant, especially in older software, is displaying a description of the tool in a status bar, but such descriptions are not usually called <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'>s. Another system that aims to solve the same problem, but in a slightly different way, is balloon help. Another term for <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'>, used in Microsoft end-user documentation, is 'ScreenTip'.</p><p>Demonstrations of <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'> usage are prevalent on Web pages. Many graphical Web browsers display the title attribute of an HTML element as a <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'> when a user hovers the mouse cursor over that element; in such a browser you should be able to hover over Wikipedia images and hyperlinks and see a <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'> appear. Some browsers, notably Microsoft’s Internet Explorer, will also display the alt attribute of an image as a <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'> in the same manner; if a title attribute is also specified, it will override the alt attribute for <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'> content, however. Note that there is some debate over whether this latter usage (alternate text as a <strong style='border-bottom:1px solid;'>tooltip</strong style='border-bottom:1px solid;'>) is proper behavior.</p>");
define("EHD_LAN_PAGE_70_T3_2",      "Tooltip.");

// Page 80 - Miscellaneous
define("EHD_LAN_PAGE_80_H1",        "Other Functions");
define("EHD_LAN_PAGE_80_H1_1",      "Stuff that doesn't really fit in to any other category.");

define("EHD_LAN_PAGE_80_H2",        "Image toggle");
define("EHD_LAN_PAGE_80_H2_1",      "Toggle between two images on mouse click - click on the image below to see.");
?>
