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
| $Source: e:\_repository\e107_plugins/election/handlers/election_constants.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/31 16:01:20 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files & Directories
define("ELECC_PLUGIN_DIR",           e_PLUGIN."election/");
define("ELECC_HANDLERS_DIR",         ELECC_PLUGIN_DIR."handlers/");
define("ELECC_CANDIDATE_IMAGES_DIR", ELECC_PLUGIN_DIR."candidateimages/");
define("ELECC_LANGUAGE_DIR",         ELECC_PLUGIN_DIR."languages/");
define("ELECC_ADMIN_LANGUAGE_DIR",   ELECC_PLUGIN_DIR."languages/admin/");
define("ELECC_SELF",                 ELECC_PLUGIN_DIR."election.php");

// Load the language file
include_lan(ELECC_LANGUAGE_DIR.e_LANGUAGE.".php");

// Load the admin language file if in an admin page
if (strpos(e_SELF, "admin_") !== false) {
   include_lan(ELECC_ADMIN_LANGUAGE_DIR.e_LANGUAGE.".php");
   require_once(e_PLUGIN."election/handlers/election_constants_admin.php");
}

// URL parameter array indicies
define("ELECC_MODE",                      0);
define("ELECC_ID",                        1);

// Page modes
define("ELECC_CANDIDATES_PAGE",           1);
define("ELECC_CANDIDATE_PAGE",            2);
define("ELECC_VOTE_PAGE",                 3);
define("ELECC_VOTES_PAGE",                4);

// Database table names
define("ELECC_ELECTIONS_TABLE",           "election_elections");
define("ELECC_CANDIDATES_TABLE",          "election_candidates");
define("ELECC_VOTERS_TABLE",              "election_voters");

// Database table order
define("ELECC_CANDIDATES_ORDER",          " order by election_candidate_name asc");
define("ELECC_VOTES_ORDER",               " order by election_voter_timestamp desc");

// Election ordering
define("ELECC_ELECTION_ORDER_KEY_0",      " order by election_id asc");
define("ELECC_ELECTION_ORDER_KEY_1",      " order by election_id desc");
define("ELECC_ELECTION_ORDER_KEY_2",      " order by election_name asc");
define("ELECC_ELECTION_ORDER_KEY_3",      " order by election_name desc");
define("ELECC_ELECTION_ORDER_KEY_4",      " order by election_start_date asc");
define("ELECC_ELECTION_ORDER_KEY_5",      " order by election_start_date desc");
define("ELECC_ELECTION_ORDER_KEY_6",      " order by election_end_date asc");
define("ELECC_ELECTION_ORDER_KEY_7",      " order by election_end_date desc");

// Miscellaneous
define("ELECC_POST_ARRAY",                "election_auc");
define("ELECC_UI",                        "ui");
define("ELECC_DB",                        "db");
define("ELECC_TRUNC",                     "truncate");
define("ELECC_TT",                        "election_tooltip");

?>