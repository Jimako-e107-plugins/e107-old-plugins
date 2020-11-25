<?php

/* workaround for solving mystery of loading lan files */
if (!defined(("LAN_JOURNAL_A0"))) {  
    define("LAN_JOURNAL_A0",    	"UserJournals");
	define("LAN_JOURNAL_A0_SUM",   "UserJournals plugin for e107 website system");
	define("LAN_JOURNAL_A0_DESC",   "This plugin allows the e107 CMS to support individual journals for registered/logged-in users. Each user gets their own journal, and can write, edit, and delete their entries. Admin has the option of totally disabling User Journals, as well as restricting access to logged-in users only.");
}
