<?php
/*
+---------------------------------------------------------------+
|        Prune Inactive Users for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// Subject for the email to inactive user
define(PRUNE_ASUBJECT, "Use it or lose it! Membership of " . SITENAME . " is being reviewed");
// Email contents for not logged in recently
// $_REQUEST['prune_days'] is the number of days you entered
define(PRUNE_AMESSAGEL1, "The administrator of " . SITENAME . " is purging accounts that have not been active within the last " . $pref['prune_days'] . " days. ");
define(PRUNE_AMESSAGEL2, "Before deleting your account we are giving you the option to visit the site again if you wish.  If you do not visit within the next week your account will be deleted. ");
define(PRUNE_AMESSAGEL3, "Regards - " . SITENAME . " Administrator");
// Email contents for not making a forum post recently
define(PRUNE_AMESSAGEF1, "The administrator of " . SITENAME . " is purging accounts that have not made a contribution to the forums within the last " . $pref['prune_days'] . " days. ");
define(PRUNE_AMESSAGEF2, "Before deleting your account we are giving you the option to visit the site again and make a forum contribution.  If you do not visit within the next week your account will be deleted. ");
define(PRUNE_AMESSAGEF3, "Regards - " . SITENAME . " Administrator");
// Email contents for not making a sufficient forum posts
define(PRUNE_AMESSAGEFP1, "The administrator of " . SITENAME . " is purging accounts that have not made a useful contribution to the forums.");
define(PRUNE_AMESSAGEFP2, "Before deleting your account we are giving you the option to visit the site again and make forum contributions.  If you do not visit within the next week your account will be deleted. ");
define(PRUNE_AMESSAGEFP3, "Regards - " . SITENAME . " Administrator");
// Email contents for not making a sufficient chat posts
define(PRUNE_AMESSAGECB1, "The administrator of " . SITENAME . " is purging accounts that have not made a good contribution to the chatbox.");
define(PRUNE_AMESSAGECB2, "Before deleting your account we are giving you the option to visit the site again and make a bigger contribution.  If you do not visit within the next week your account will be deleted. ");
define(PRUNE_AMESSAGECB3, "Regards - " . SITENAME . " Administrator");
// Email contents for not making a sufficient comments
define(PRUNE_AMESSAGEC1, "The administrator of " . SITENAME . " is purging accounts that have not made a contribution to the site with comments ");
define(PRUNE_AMESSAGEC2, "Before deleting your account we are giving you the option to visit the site again and make a bigger contribution.  If you do not visit within the next week your account will be deleted. ");
define(PRUNE_AMESSAGEC3, "Regards - " . SITENAME . " Administrator");
// Email contents for not making a sufficient visits
define(PRUNE_AMESSAGEV1, "The administrator of " . SITENAME . " is purging accounts that have not made a contribution to the site by regularly visiting. ");
define(PRUNE_AMESSAGEV2, "Before deleting your account we are giving you the option to visit the site again and make a bigger contribution.  If you do not visit within the next week your account will be deleted. ");
define(PRUNE_AMESSAGEV3, "Regards - " . SITENAME . " Administrator");
// Email to say account now deleted
define(PRUNE_AMESSAGED1, "The administrator of " . SITENAME . " has purged accounts that have not made a contribution to the site or logged in within the last " . $pref['prune_days'] . " days. ");
define(PRUNE_AMESSAGED2, "Your account has now been deleted and your user name and password are no longer valid.  If you wish to use the site you will have to re register.");
define(PRUNE_AMESSAGED3, "Regards - " . SITENAME . " Administrator");
// Email to say account demoted
define(PRUNE_AMESSAGEDM1, "The administrator of " . SITENAME . " has purged accounts that have not made a contribution to the site or logged in within the last " . $pref['prune_days'] . " days. ");
define(PRUNE_AMESSAGEDM2, "Your account has now had some privileges removed.");
define(PRUNE_AMESSAGEDM3, "Regards - " . SITENAME . " Administrator");

define(PRUNE_Preamble, "Hi there");

define(PRUNE_HELP_0, "Prune Users");
define(PRUNE_HELP_1, "Configure");
define(PRUNE_HELP_2, "User Joined before");
define(PRUNE_HELP_3, "Only select users who joined your site before this date. Blank to omit this selection");
define(PRUNE_HELP_4, "Last Visit before");
define(PRUNE_HELP_5, "Only select users who have not visited your site since this date. Blank to omit this selection");
define(PRUNE_HELP_6, "Select On");
define(PRUNE_HELP_7, "Chose whether to search on last logged in date or on the last forum posting date, number of forum posts, chat posts, comments, visits or total posts.");
define(PRUNE_HELP_8, "Pruning Threshold");
define(PRUNE_HELP_9, "The minumum number of posts or visits (see above) or the number of days since last forum post.");
define(PRUNE_HELP_10, "Exclude Admins");
define(PRUNE_HELP_11, "Omit from the search anybody who has admin status. Admins can not be deleted but it is useful to determine ineffective admins.");
define(PRUNE_HELP_12, "Notify on deletion");
define(PRUNE_HELP_13, "Do you wish to send an email to the user when they are deleted. (Does not affect the reminder emails).");
define(PRUNE_HELP_14, "Action");
define(PRUNE_HELP_15, "Chose whether to email the user to warn them you are purging inactive accounts or do the deletions or class change.  If deleting see the previous option if you want to notify them their account has been deleted.");
define(PRUNE_HELP_16, "Prune from class");
define(PRUNE_HELP_17, "Instead of deleting users you can remove them from a user class. Only those in the specified class will be listed. Set to no one to ignore this selection.");
define(PRUNE_HELP_18, "Users per page");
define(PRUNE_HELP_19, "Restrict the number of users displayed.  Remember if you have email notifications on that large numbers of emails may result in spam blacklisting.");
define(PRUNE_HELP_20, "General");
define(PRUNE_HELP_21, "Configure the options first, then click on the <i>Prune Users</i> link in the menu.<br />These options also affect the status display on the admin main page which gives a display of potential deletions according to your settings.");

define(PRUNE_A1, "Prune Inactive Users");
define(PRUNE_A2, "Last visit was before");
define(PRUNE_A3, "Proceed");
define(PRUNE_A4, "User name");
define(PRUNE_A5, "Last Activity");
define(PRUNE_A6, "Delete");
define(PRUNE_A7, "Failed to delete");
define(PRUNE_A8, "Deleted OK");
define(PRUNE_A9, "No users meet this criteria");
define(PRUNE_A10, "Continue");
define(PRUNE_A11, "You must specify a period of more than 0 days");
define(PRUNE_A12, "more than ");
define(PRUNE_A13, " days ago");
define(PRUNE_A14, "<strong>WARNING</strong> This will delete the users you have selected.  They will not be recoverable unless you restore from a backup (you do have a backup don't you?). Proceed at your peril.");
define(PRUNE_A15, "You forgot to select any users");
define(PRUNE_A16, "Select on");
define(PRUNE_A17, "Last visit (Only)");
define(PRUNE_A18, "Last Forum post more than threshold (days) ago");
define(PRUNE_A19, "No postings");
define(PRUNE_A20, "Prune Users");
define(PRUNE_A21, "Configure");
define(PRUNE_A22, "Changes Saved");
define(PRUNE_A23, "Email from (name)");
define(PRUNE_A24, "Email from (address)");
define(PRUNE_A25, "Action");
define(PRUNE_A26, "Send email to selected users");
define(PRUNE_A27, "Delete selected users");
define(PRUNE_A28, "Email Sent OK");
define(PRUNE_A29, "Email Send failed");
define(PRUNE_A30, "A notification email will be sent to the selected users");
define(PRUNE_A31, "Notify user of deletion");
define(PRUNE_A32, "No");
define(PRUNE_A33, "Yes");
define(PRUNE_A34, "Never visited");
define(PRUNE_A35, "Remove admin status before trying to delete or email");
define(PRUNE_A36, "Select All");
define(PRUNE_A37, "Unselect All");
define(PRUNE_A38, "Save");
define(PRUNE_A39, "Last visit was before");
define(PRUNE_A40, "Selecting members on");
define(PRUNE_A41, "Action to be taken");
define(PRUNE_A42, "Emailing Users");
define(PRUNE_A43, "Deleting Users");
define(PRUNE_A44, "User Joined");
define(PRUNE_A45, "Prunable users");
define(PRUNE_A46, "Check for Updates");
define(PRUNE_A47, "Remove from class");
define(PRUNE_A48, "Removed from class");
define(PRUNE_A49, "Prune from class");
define(PRUNE_A50, "Readme");
define(PRUNE_A51, "Goto the admin section and configure then prune your users");
define(PRUNE_A52, "Min forum post count (threshold: posts)");
define(PRUNE_A53, "Min chat post count (threshold: chats)");
define(PRUNE_A54, "Min comment post count (threshold: comments)");
define(PRUNE_A55, "Pruning threshold");
define(PRUNE_A56, "Forum");
define(PRUNE_A57, "Chat");
define(PRUNE_A58, "Comment");
define(PRUNE_A59, "Last Visit");
define(PRUNE_A60, "Last Post");
define(PRUNE_A61, "Minimum Visits (threshold: visits)");
define(PRUNE_A62, "Exclude admins");
define(PRUNE_A63, "Total prunable users:");
define(PRUNE_A64, "User joined before");
define(PRUNE_A65, "Total forum posts, chats and comments (threshold: all posts)");
define(PRUNE_A66, "Users who joined before");
define(PRUNE_A67, "Admins");
define(PRUNE_A68, "Included");
define(PRUNE_A69, "Excluded");
define(PRUNE_A70, "Visits");
define(PRUNE_A71, "Sum of Forum, Comment, and Chat posts");
define(PRUNE_A72, "Users per page");

?>