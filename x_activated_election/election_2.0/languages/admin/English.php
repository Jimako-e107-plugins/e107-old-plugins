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
| $Source: e:\_repository\e107_plugins/election/languages/admin/English.php,v $
| $Revision: 1.4 $
| $Date: 2008/02/10 15:19:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Menu pages
define("ELEC_ADMIN_MENU_10",                       "Preferences");
define("ELEC_ADMIN_MENU_20",                       "Elections");
define("ELEC_ADMIN_MENU_30",                       "Candidates");
define("ELEC_ADMIN_MENU_50",                       "Batch preferences");
define("ELEC_ADMIN_MENU_99",                       "Read Me");

// Election ordering
define("ELEC_LAN_ELECTION_ORDER_VALUE_0",          "Date created (ID) ascending");
define("ELEC_LAN_ELECTION_ORDER_VALUE_1",          "Date created (ID) descending");
define("ELEC_LAN_ELECTION_ORDER_VALUE_2",          "Name ascending");
define("ELEC_LAN_ELECTION_ORDER_VALUE_3",          "Name descending");
define("ELEC_LAN_ELECTION_ORDER_VALUE_4",          "Start date ascending");
define("ELEC_LAN_ELECTION_ORDER_VALUE_5",          "Start date descending");
define("ELEC_LAN_ELECTION_ORDER_VALUE_6",          "End date ascending");
define("ELEC_LAN_ELECTION_ORDER_VALUE_7",          "End date descending");

// Template stuff
define("ELEC_ADMIN_TEMPLATE_TYPE_APPS",            "elections");
define("ELEC_ADMIN_TEMPLATE_TYPE_APP",             "app");
define("ELEC_ADMIN_TEMPLATE_TYPE_USE_GLOBAL",      "Use global template");

// Admin text - preferences
define("ELEC_ADMIN_PREFS_PAGE_TITLE",              "Page title");
define("ELEC_ADMIN_PREFS_PAGE_TITLE_1",            "");
define("ELEC_ADMIN_PREFS_PAGE_TITLE_2",            "Title prefix that will be displayed at the top of each page");
define("ELEC_ADMIN_PREFS_SEPARATOR",               "Breadcrumb separator");
define("ELEC_ADMIN_PREFS_SEPARATOR_1",             "");
define("ELEC_ADMIN_PREFS_SEPARATOR_2",             "Used to separate the different elements of the page title when displayed as a bredcrumb trail");
define("ELEC_ADMIN_PREFS_VIEW_CLASS",              "Election access");
define("ELEC_ADMIN_PREFS_VIEW_CLASS_1",            "");
define("ELEC_ADMIN_PREFS_VIEW_CLASS_2",            "Select the userclass for users who are allowed to access Election pages. Note: individual election access can be futher restricted on the Elections admin page.");
define("ELEC_ADMIN_PREFS_TOOLTIPS",                "Tooltips");
define("ELEC_ADMIN_PREFS_TOOLTIPS_1",              "");
define("ELEC_ADMIN_PREFS_TOOLTIPS_2",              "Turns tooltip display on or off");
define("ELEC_ADMIN_PREFS_TEMPLATE",                "Global Template");
define("ELEC_ADMIN_PREFS_TEMPLATE_1",              "");
define("ELEC_ADMIN_PREFS_TEMPLATE_2",              "The template to be used for all pages not relating to a single election and all elections that use the global template.");
define("ELEC_ADMIN_PREFS_ORDER",                   "Election list order");
define("ELEC_ADMIN_PREFS_ORDER_1",                 "");
define("ELEC_ADMIN_PREFS_ORDER_2",                 "Select the order to display the elections on the main elections list page");
define("ELEC_ADMIN_PREFS_CANDIDATES_PER_PAGE",     "Candidates per page");
define("ELEC_ADMIN_PREFS_CANDIDATES_PER_PAGE_1",   "");
define("ELEC_ADMIN_PREFS_CANDIDATES_PER_PAGE_2",   "The number of candidates that will be listed on the candidates list page before paging is invoked.");
define("ELEC_ADMIN_PREFS_ELECTIONS_PER_PAGE",      "Elections per page");
define("ELEC_ADMIN_PREFS_ELECTIONS_PER_PAGE_1",    "");
define("ELEC_ADMIN_PREFS_ELECTIONS_PER_PAGE_2",    "The number of elections that will be listed on a the elections list page before paging is invoked.");

// Admin text - elections
define("ELEC_ADMIN_ELECTION_NAME",                 "Name");
define("ELEC_ADMIN_ELECTION_NAME_1",               "");
define("ELEC_ADMIN_ELECTION_NAME_2",               "");
define("ELEC_ADMIN_ELECTION_DESCRIPTION",          "Description");
define("ELEC_ADMIN_ELECTION_DESCRIPTION_1",        "");
define("ELEC_ADMIN_ELECTION_DESCRIPTION_2",        "");
define("ELEC_ADMIN_ELECTION_ICON",                 "Icon");
define("ELEC_ADMIN_ELECTION_ICON_1",               "");
define("ELEC_ADMIN_ELECTION_ICON_2",               "Select an icon for this election");
define("ELEC_ADMIN_ELECTION_START_DATE",           "Start Date");
define("ELEC_ADMIN_ELECTION_START_DATE_1",         "");
define("ELEC_ADMIN_ELECTION_START_DATE_2",         "The date and time that the election will start");
define("ELEC_ADMIN_ELECTION_END_DATE",             "End Date");
define("ELEC_ADMIN_ELECTION_END_DATE_1",           "");
define("ELEC_ADMIN_ELECTION_END_DATE_2",           "The date and time that the election will end");
define("ELEC_ADMIN_ELECTION_POINTS_PER_VOTE",      "Points per vote");
define("ELEC_ADMIN_ELECTION_POINTS_PER_VOTE_1",    "");
define("ELEC_ADMIN_ELECTION_POINTS_PER_VOTE_2",    "Enter the number of points per vote, one value per line. The number of entries here will determine how many candidates voters can vote for.");
define("ELEC_ADMIN_ELECTION_CLOSED",               "Closed");
define("ELEC_ADMIN_ELECTION_CLOSED_1",             "");
define("ELEC_ADMIN_ELECTION_CLOSED_2",             "Closed elections can be viewed but can not have new votes posted.");
define("ELEC_ADMIN_ELECTION_VIEW_CLASS",           "View Class");
define("ELEC_ADMIN_ELECTION_VIEW_CLASS_1",         "");
define("ELEC_ADMIN_ELECTION_VIEW_CLASS_2",         "Select the userclass that is allowed to view this election");
define("ELEC_ADMIN_ELECTION_RESULTS_CLASS",        "Results class");
define("ELEC_ADMIN_ELECTION_RESULTS_CLASS_1",      "");
define("ELEC_ADMIN_ELECTION_RESULTS_CLASS_2",      "Select the userclass that is allowed to view the standings/results for this election");
define("ELEC_ADMIN_ELECTION_VOTE_CLASS",           "Vote Class");
define("ELEC_ADMIN_ELECTION_VOTE_CLASS_1",         "");
define("ELEC_ADMIN_ELECTION_VOTE_CLASS_2",         "Select the userclass people who can vote. This must be a group of members as voting is tracker by user ID.");
define("ELEC_ADMIN_ELECTION_OWNER",                "Owner");
define("ELEC_ADMIN_ELECTION_OWNER_1",              "");
define("ELEC_ADMIN_ELECTION_OWNER_2",              "Select an owner for this election");
define("ELEC_ADMIN_ELECTION_RATINGS",              "Candidate ratings");
define("ELEC_ADMIN_ELECTION_RATINGS_1",            "");
define("ELEC_ADMIN_ELECTION_RATINGS_2",            "Allow candidates to be rated");
define("ELEC_ADMIN_ELECTION_COMMENTS",             "Candidate comments");
define("ELEC_ADMIN_ELECTION_COMMENTS_1",           "");
define("ELEC_ADMIN_ELECTION_COMMENTS_2",           "Allow comments for candidates");
define("ELEC_ADMIN_ELECTION_TEMPLATE",             "Template");
define("ELEC_ADMIN_ELECTION_TEMPLATE_1",           "");
define("ELEC_ADMIN_ELECTION_TEMPLATE_2",           "Select a template to be used for displaying this elections pages");
define("ELEC_ADMIN_ELECTION_RESTRICTION_TEXT",     "Vote restriction text");
define("ELEC_ADMIN_ELECTION_RESTRICTION_TEXT_1",   "");
define("ELEC_ADMIN_ELECTION_RESTRICTION_TEXT_2",   "");

// Admin text - candidates
define("ELEC_ADMIN_CANDIDATE_NAME",                "Name");
define("ELEC_ADMIN_CANDIDATE_NAME_1",              "");
define("ELEC_ADMIN_CANDIDATE_NAME_2",              "");
define("ELEC_ADMIN_CANDIDIDATE_ELECTION",          "Elections");
define("ELEC_ADMIN_CANDIDIDATE_ELECTION_1",        "");
define("ELEC_ADMIN_CANDIDIDATE_ELECTION_2",        "The election(s) that this candidate will be included in");
define("ELEC_ADMIN_CANDIDATE_TITLE",               "Title");
define("ELEC_ADMIN_CANDIDATE_TITLE_1",             "");
define("ELEC_ADMIN_CANDIDATE_TITLE_2",             "");
define("ELEC_ADMIN_CANDIDATE_DESCRIPTION",         "Description");
define("ELEC_ADMIN_CANDIDATE_DESCRIPTION_1",       "");
define("ELEC_ADMIN_CANDIDATE_DESCRIPTION_2",       "");
define("ELEC_ADMIN_CANDIDATE_ICON",                "Icon");
define("ELEC_ADMIN_CANDIDATE_ICON_1",              "");
define("ELEC_ADMIN_CANDIDATE_ICON_2",              "Select an icon for this candidate");
define("ELEC_ADMIN_CANDIDATE_IMAGE",               "Image");
define("ELEC_ADMIN_CANDIDATE_IMAGE_1",             "");
define("ELEC_ADMIN_CANDIDATE_IMAGE_2",             "Select an image for this candidate");
define("ELEC_ADMIN_CANDIDATE_TEMPLATE",            "Template");
define("ELEC_ADMIN_CANDIDATE_TEMPLATE_1",          "");
define("ELEC_ADMIN_CANDIDATE_TEMPLATE_2",          "Select a template to be used for displaying this candidates page");
define("ELEC_ADMIN_CANDIDATE_LINK_DESC",           "Link description");
define("ELEC_ADMIN_CANDIDATE_LINK_DESC_1",         "");
define("ELEC_ADMIN_CANDIDATE_LINK_DESC_2",         "Enter a description for the candidate link URL.");
define("ELEC_ADMIN_CANDIDATE_LINK_URL",            "Link URL");
define("ELEC_ADMIN_CANDIDATE_LINK_URL_1",          "");
define("ELEC_ADMIN_CANDIDATE_LINK_URL_2",          "Enter a URL to a page with more details of this candidate.");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_VALUE",   "Vote restriction value");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_VALUE_1", "");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_VALUE_2", "");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_FIELD",   "Vote restriction field");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_FIELD_1", "");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_FIELD_2", "");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_HEADER",  "Vote Restriction Parameters");
define("ELEC_ADMIN_CANDIDATE_RESTRICTION_DESC",    "Vote restriction allows you to prevent voters from being allowed to vote from some candidates. It works by entering a <strong>value</strong> that is matched against an <strong>extended user field</strong>, if there is a match then the user cannot vote for this candidate.");

define("ELEC_ADMIN_BATCH_PREFS_DESC",              "Tick each field that should appear in the repeating group part of the Candidates admin page. Setting the value to 1 turns off batch processing.");

