<?php
require_once("../../class2.php");
# $Id: config.inc.php,v 1.39.2.5 2005/08/20 09:46:44 jberanek Exp $

###########################################################################
#   MRBS Configuration File
#   Configure this file for your site.
#   You shouldn't have to modify anything outside this file.
###########################################################################

###################
# Database settings
###################
# Which database system: "pgsql"=PostgreSQL, "mysql"=MySQL
$dbsys = "mysql";
# Hostname of database server. For pgsql, can use "" instead of localhost
# to use Unix Domain Sockets instead of TCP/IP.
$db_host = "localhost";
# Database name:
$db_database = "site";
# Database login user name:
$db_login = "ian";
# Database login password:
$db_password = 'ian';
# Prefix for table names.  This will allow multiple installations where only
# one database is available
$db_tbl_prefix = "e107_mrbs_";
# Uncomment this to NOT use PHP persistent (pooled) database connections:
# $db_nopersist = 1;





################################
# Site identification information
#################################
$mrbs_admin = "Admin";
$mrbs_admin_email = "ian.beaver@mgeups.com";

# This is the text displayed in the upper left corner of every page. Either
# type the name of your organization, or you can put your logo like this :
# $mrbs_company = "<a href=http://www.your_organisation.com/>
# <img src=your_logo.gif border=0></a>";
#$mrbs_company = "";

# This is to fix URL problems when using a proxy in the environment.
# If links inside MRBS appear broken, then specify here the URL of
# your MRBS root directory, as seen by the users. For example:
# $url_base =  "http://webtools.uab.ericsson.se/oam";
# It is also recommended that you set this if you intend to use email
# notifications, to ensure that the correct URL is displayed in the
# notification.
$url_base = "";


###################
# Calendar settings
###################
# Note: Be careful to avoid specify options that displays blocks overlaping
# the next day, since it is not properly handled.

# Resolution - what blocks can be booked, in seconds.
# Default is half an hour: 1800 seconds.
$resolution = $pref['mrbs_resolution'];
#$resolution = 1800;

# Start and end of day, NOTE: These are integer hours only, 0-23, and
# morningstarts must be < eveningends. See also eveningends_minutes.
#$morningstarts = 7;
$morningstarts = $pref['mrbs_morningstarts'];
$eveningends = $pref['mrbs_eveningends'];
#$eveningends   = 19;

# Minutes to add to $eveningends hours to get the real end of the day.
# Examples: To get the last slot on the calendar to be 16:30-17:00, set
# eveningends=16 and eveningends_minutes=30. To get a full 24 hour display
# with 15-minute steps, set morningstarts=0; eveningends=23;
# eveningends_minutes=45; and resolution=900.
#$eveningends_minutes = 0;
$eveningends_minutes = $pref['mrbs_eveningends_minutes'];
# Start of week: 0 for Sunday, 1 for Monday, etc.
#$weekstarts = 0;
$weekstarts = $pref['mrbs_weekstarts'];
# Trailer date format: 0 to show dates as "Jul 10", 1 for "10 Jul"
#$dateformat = 0;
$dateformat = $pref['mrbs_dateformat'];
# Time format in pages. 0 to show dates in 12 hour format, 1 to show them
# in 24 hour format
#$twentyfourhour_format = 1;
$twentyfourhour_format = $pref['mrbs_twentyfourhour_format'];
########################
# Miscellaneous settings
########################

########################
# Miscellaneous settings
########################

# Maximum repeating entrys (max needed +1):
$max_rep_entrys = 365 + 1;

# Default report span in days:
$default_report_days = 60;

# Results per page for searching:
$search["count"] = 20;

# Page refresh time (in seconds). Set to 0 to disable
$refresh_rate = 0;

# should areas be shown as a list or a drop-down select box?
$area_list_format = "list";
#$area_list_format = "select";

# Entries in monthly view can be shown as start/end slot, brief description or
# both. Set to "description" for brief description, "slot" for time slot and
# "both" for both. Default is "both", but 6 entries per day are shown instead
# of 12.
$monthly_view_entries_details = "both";

# To view weeks in the bottom (trailer.inc) as week numbers (42) instead of
# 'first day of the week' (13 Oct), set this to TRUE
$view_week_number = FALSE;

# To display times on right side in day and week view, set to TRUE;
$times_right_side = FALSE;

# Control the active cursor in day/week/month views.
$javascript_cursor = true; # Change to false if clients have old browsers
                           # incompatible with JavaScript.
$show_plus_link = true; # Change to true to always show the (+) link as in
                        # MRBS 1.1.
$highlight_method = "hybrid"; # One of "bgcolor", "class", "hybrid".

# Define default starting view (month, week or day)
# Default is day
$default_view = "day";

# Define default room to start with (used by index.php)
# Room numbers can be determined by looking at the Edit or Delete URL for a
# room on the admin page.
# Default is 0
$default_room = 0;


###############################################
# Authentication settings - read AUTHENTICATION
###############################################
$auth["session"] = "cookie"; # How to get and keep the user ID. One of "http" "php" "cookie" "ip" "host" "nt" "omni".
$auth["type"] = "e107"; # How to validate the user/password. One of "none" "config" "pop3" "imap" "ldap".

# The various level two users (can modify other peoples settings)
# By default, only localhost is an administrator.
#$auth["admin"][] = "127.0.0.1";
#$auth["1"][] = "1";
#$auth["admin"][] = "10.0.0.1";
#$auth["admin"][] = "10.0.0.2";
#$auth["admin"][] = "10.0.0.3";

# 'auth_config' user database
# Format: $auth["user"]["name"] = "password";
#$auth["user"]["1"] = "1";
#$auth["user"]["alice"] = "a";
#$auth["user"]["bob"] = "b";

# 'session_http' configuration settings
#$auth["realm"]  = "mrbs";

# 'auth_ext' configuration settings
#$auth["prog"]   = "";
#$auth["params"] = "";

# 'auth_ldap' configuration settings
# Where is the LDAP server
#$ldap_host = "localhost";
# LDAP base distinguish names
#$ldap_base_dn[] = "ou=organizationalunit1,o=organization,c=MY";
#$ldap_base_dn[] = "ou=organizationalunit2,o=organization,c=MY";
#$ldap_base_dn[] = "ou=organizationalunit3,o=organization,c=MY";

# 'auth_ldap' extra configuration for ldap configuration of who can use
# the system
# If it's set, the $ldap_filter will be combined with the uid like this:
#   (&(uid=username)($ldap_filter))
# After binding to check the password, this check is used to see that
# they are a valid user of mrbs.
#$ldap_filter = "mrbsuser=y";

# 'auth_imap' configuration settings
# Where is the IMAP server
#$imap_host = "imap-server-name";
# The IMAP server port
#$imap_port = "143";

# 'auth_pop3' configuration settings
# Where is the POP3 server
#$pop3_host = "pop3-server-name";
# The POP3 server port
#$pop3_port = "110";

# 'auth_imap' configuration settings
# See AUTHENTICATION for details of how check against multiple servers
# Where is the IMAP server
$imap_host = "imap-server-name";
# The IMAP server port
$imap_port = "143";

# 'auth_pop3' configuration settings
# See AUTHENTICATION for details of how check against multiple servers
# Where is the POP3 server
$pop3_host = "smtp.mgeintra.com";
# The POP3 server port
$pop3_port = "110";


###############################################
# Email settings
###############################################

# Set to TRUE if you want to be notified when entries are booked. Default is
# FALSE
define ("MAIL_ADMIN_ON_BOOKINGS", TRUE);

# Set to TRUE if you want AREA ADMIN to be notified when entries are booked.
# Default is FALSE. Area admin emails are set in room_area admin page.
define ("MAIL_AREA_ADMIN_ON_BOOKINGS", TRUE);

# Set to TRUE if you want ROOM ADMIN to be notified when entries are booked.
# Default is FALSE. Room admin emails are set in room_area admin page.
define ("MAIL_ROOM_ADMIN_ON_BOOKINGS", TRUE);

# Set to TRUE if you want ADMIN to be notified when entries are deleted. Email
# will be sent to mrbs admin, area admin and room admin as per above settings,
# as well as to booker if MAIL_BOOKER is TRUE (see below).
define ("MAIL_ADMIN_ON_DELETE", TRUE);

# Set to TRUE if you want to be notified on every change (i.e, on new entries)
# but also each time they are edited. Default is FALSE (only new entries)
define ("MAIL_ADMIN_ALL", TRUE);

# Set to TRUE is you want to show entry details in email, otherwise only a
# link to view_entry is provided. Irrelevant for deleted entries. Default is
# FALSE.
define ("MAIL_DETAILS", TRUE);

# Set to TRUE if you want BOOKER to receive a copy of his entries as well any
# changes (depends of MAIL_ADMIN_ALL, see below). Default is FALSE. To know
# how to set mrbs to send emails to users/bookers, see INSTALL.
define ("MAIL_BOOKER", TRUE);

# If MAIL_BOOKER is set to TRUE (see above) and you use an authentication
# scheme other than 'auth_db', you need to provide the mail domain that will
# be appended to the username to produce a valid email address (ie.
# "@domain.com").
define ("MAIL_DOMAIN", '');

# If you use MAIL_DOMAIN above and username returned by mrbs contains extra
# strings appended like domain name ('username.domain'), you need to provide
# this extra string here so that it will be removed from the username.
define ("MAIL_USERNAME_SUFFIX", '');

# Set the name of the Backend used to transport your mails. Either "mail",
# "smtp" or "sendmail". Default is 'mail'. See INSTALL for more details.
define ("MAIL_ADMIN_BACKEND", "mail");

#*******************
# Sendmail settings

# Set the path of the Sendmail program (only used with "sendmail" backend).
# Default is "/usr/bin/sendmail"
define ("SENDMAIL_PATH", "C:/Inetpub/wwwroot/support/e107_plugins/bookingroom/Mail");

# Set additional Sendmail parameters (only used with "sendmail" backend).
# (example "-t -i"). Default is ""
define ("SENDMAIL_ARGS", '');

#*******************
# SMTP settings

# Set smtp server to connect. Default is 'localhost' (only used with "smtp"
# backend).
define ("SMTP_HOST", "smtp.address.com");

# Set smtp port to connect. Default is '25' (only used with "smtp" backend).
define ("SMTP_PORT", 25);

# Set whether or not to use SMTP authentication. Default is 'FALSE'
define ("SMTP_AUTH", FALSE);

# Set the username to use for SMTP authentication. Default is ""
define ("SMTP_USERNAME", '');

# Set the password to use for SMTP authentication. Default is ""
define ("SMTP_PASSWORD", '');

#****************************
# Miscellaneous settings

# Set the language used for emails (choose an available lang.* file).
# Default is 'en'.
define ("MAIL_ADMIN_LANG", 'en');

# Set the email address of the From field. Default is $mrbs_admin_email
define ("MAIL_FROM", $mrbs_admin_email);

# Set the recipient email. Default is $mrbs_admin_email. You can define
# more than one recipient like this "john@doe.com,scott@tiger.com"
define ("MAIL_RECIPIENTS", $mrbs_admin_email);

# Set email address of the Carbon Copy field. Default is ''. You can define
# more than one recipient (see MAIL_RECIPIENTS)
define ("MAIL_CC", '');

# Set the content of the Subject field for added/changed entries.
$mail["subject"] = "Entry added/changed for $mrbs_company MRBS";

# Set the content of the Subject field for deleted fields.
$mail["subject_delete"] = "Entry deleted for $mrbs_company MRBS";

# Set the content of the message when a new entry is booked. What you type
# here will be added at the top of the message body.
$mail["new_entry"] = "A new entry has been booked, here are the details:";

# Set the content of the message when an entry is modified. What you type
# here will be added at the top of the message body.
$mail["changed_entry"] = "An entry has been modified, here are the details:";

# Set the content of the message when an entry is deleted. What you type
# here will be added at the top of the message body.
$mail["deleted_entry"] = "An entry has been deleted, here are the details:";

##########
# Language
##########

# Set this to 1 to use UTF-8 in all pages and in the database, otherwise
# text gets enterered in the database in different encodings, dependent
# on the users' language
$unicode_encoding = 1;

# Set this to a different language specifier to default to different
# language tokens. This must equate to a lang.* file in MRBS.
# e.g. use "fr" to use the translations in "lang.fr" as the default
# translations
$default_language_tokens = "en";

# Set this to 1 to disable the automatic language changing MRBS performs
# based on the user's browser language settings. It will ensure that
# the language displayed is always the value of $default_language_tokens,
# as specified above
$disable_automatic_language_changing = 0;

# Set this to a valid locale (for the OS you run the MRBS server on)
# if you want to override the automatic locale determination MRBS
# performs
$override_locale = "";

# faq file language selection. IF not set, use the default english file.
# IF your language faq file is available, set $faqfilelang to match the
# end of the file name, including the underscore (ie. for site_faq_fr.html
# use "_fr"
$faqfilelang = "";

# This next require must be done after the definitions above, as the definitions
# are used in the included file
require_once "language.inc";

#############
# Entry Types
#############
# This array maps entry type codes (letters A through J) into descriptions.
# Each type has a color (see TD.x classes in the style sheet mrbs.css).
#    A=Pink  B=Blue-green  C=Peach  D=Yellow      E=Light blue
#    F=Tan   G=Red         H=Aqua   I=Light green J=Gray
# The value for each type is a short (one word is best) description of the
# type. The values must be escaped for HTML output ("R&amp;D").
# Please leave I and E alone for compatibility.
# If a type's entry is unset or empty, that type is not defined; it will not
# be shown in the day view color-key, and not offered in the type selector
# for new or edited entries.

$typel["A"] = $pref['mrbs_typeA'];
$typel["B"] = $pref['mrbs_typeB'];
$typel["C"] = $pref['mrbs_typeC'];
$typel["D"] = $pref['mrbs_typeD'];
$typel["E"] = $pref['mrbs_typeE'];
$typel["F"] = $pref['mrbs_typeF'];
$typel["G"] = $pref['mrbs_typeG'];
$typel["H"] = $pref['mrbs_typeH'];
$typel["I"] = $pref['mrbs_typeI'];
$typel["J"] = $pref['mrbs_typeJ'];

# $typel["A"] = "A";
# $typel["B"] = "B";
# $typel["C"] = "C";
# $typel["D"] = "D";
# $typel["E"] = get_vocab("external");
# $typel["F"] = "F";
# $typel["G"] = "G";
# $typel["H"] = "H";
# $typel["I"] = get_vocab("internal");
# $typel["J"] = "J";

##########################################
# PHP System Configuration - internal use, do not change
##########################################
# Disable magic quoting on database returns:
set_magic_quotes_runtime(0);

# Make sure notice errors are not reported, they can break mrbs code:
error_reporting (E_ALL ^ E_NOTICE);

# These variables specify the names of the tables in the database
# These should not need to be changed.  Please change $db_tbl_prefix
# in the database section above.
$tbl_area   = $db_tbl_prefix . "area";
$tbl_entry  = $db_tbl_prefix . "entry";
$tbl_repeat = $db_tbl_prefix . "repeat";
$tbl_room   = $db_tbl_prefix . "room";
$tbl_users  = $db_tbl_prefix . "users";

# MRBS developers, make sure to update this string before each release:
$mrbs_version = "";

?>