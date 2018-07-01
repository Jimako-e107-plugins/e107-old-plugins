<?php
/**
 * $Id: English.php,v 1.9 2009/10/24 20:15:31 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.9 $
 * Last Modified: $Date: 2009/10/24 20:15:31 $
 *
 * Change Log:
 * $Log: English.php,v $
 * Revision 1.9  2009/10/24 20:15:31  michiel
 * Grouped recommendation for same user and type
 *
 * Revision 1.8  2009/10/23 15:48:58  michiel
 * Configure Site Penalty settings
 *
 * Revision 1.7  2009/10/22 21:29:47  michiel
 * Implemeted Time-based goals
 *
 * Revision 1.6  2009/10/22 17:28:25  michiel
 * - Implemented conditions
 * - Processing action upong changing the recommendation state
 * - Members can view the recommendations they've submitted themselves
 *
 * Revision 1.5  2009/10/22 15:03:37  michiel
 * Implemented customizable conditions
 *
 * Revision 1.4  2009/07/14 19:29:26  michiel
 * CVS Merge
 *
 * Revision 1.3.2.3  2009/07/13 18:53:56  michiel
 * - Added Sending PM
 * - Added medal reward
 *
 * Revision 1.3.2.2  2009/07/12 12:39:36  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.2  2009/07/12 11:49:42  michiel
 * Show list of changes after revalidate all
 *
 * Revision 1.3.4.1  2009/06/30 20:10:20  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.3  2009/06/28 15:06:16  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.3  2009/06/28 02:35:27  michiel
 * - Position of rank image in forum is configurable
 * - Medal/Ribbon counts can be shown in forum
 *
 * Revision 1.2.2.2  2009/06/27 16:58:19  michiel
 * Added image selector
 *
 * Revision 1.2.2.1  2009/06/27 15:54:05  michiel
 * Added 2nd image for medals and ribbons
 *
 * Revision 1.2  2009/06/26 09:23:43  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.3  2009/06/12 15:12:52  michiel
 * RELEASE 1.2
 *
 * Revision 1.1.2.2  2009/05/20 18:40:17  michiel
 * implemented Medal Bonus
 *
 * Revision 1.1.2.1  2009/04/01 19:26:49  michiel
 * Medal goal automated using e_rank.php
 *
 * Revision 1.1  2009/03/28 13:01:51  michiel
 * Initial CVS revision
 *
 *  
 */
// plugin.php
define('ADLAN_RS_PM_01', 'Rank System');
define('ADLAN_RS_PM_02', 'Rank System for e107. Ranks and Medals system for e107.');
define('ADLAN_RS_PM_03', 'The Rank System has been Successfully been Installed.');
define('ADLAN_RS_PM_04', 'The Rank System has been Successfully been Updated.');
// end
define('ADLAN_RS', 'Rank System');
define('ADLAN_RS_UPDOK', 'Updated settings');
define('ADLAN_RS_UPD', 'Update Settings');
// Start Main Menu
define('ADLAN_RS_MM', 'Rank System [Menu]');
define('ADLAN_RS_MM01', 'Main Configuration');
define('ADLAN_RS_MM02', 'Rank Categories');
define('ADLAN_RS_MM03', 'Ranks');
define('ADLAN_RS_MM04', 'Current Ranks');
define('ADLAN_RS_MM05', 'Medal Categories');
define('ADLAN_RS_MM06', 'Medal Goals');
define('ADLAN_RS_MM07', 'Medals');
define('ADLAN_RS_MM08', 'Current Medals');
define('ADLAN_RS_MM09', 'Rank Conditions');
define('ADLAN_RS_MM90', 'Read Me');
define('ADLAN_RS_MM91', 'Check for Updates');
// End Main Menu

// Start Condition Defenitions
define('ADLAN_RS_CDF1', 'Rank Conditions');
define('ADLAN_RS_CDF2', 'Order');
define('ADLAN_RS_CDF3', 'Name');
define('ADLAN_RS_CDF4', 'Is a negative value');
define('ADLAN_RS_CDF5', 'Has Comments');
define('ADLAN_RS_CDF6', 'Max value');
define('ADLAN_RS_CDF7', 'Factor');
define('ADLAN_RS_CDF8', 'ON bar');
define('ADLAN_RS_CDF9', 'OFF bar');
define('ADLAN_RS_CDF10', 'Trigger');
define('ADLAN_RS_CDF11', 'Update Condition');
define('ADLAN_RS_CDF12', 'Create Condition');
define('ADLAN_RS_CDF13', 'Edit Condition');
define('ADLAN_RS_CDF14', 'Are you sure you want to delete this condition?');
define('ADLAN_RS_CDF15', 'No Conditions!');
define('ADLAN_RS_CDF16', 'Existing Conditions');
define('ADLAN_RS_CDF17', 'Condition');
define('ADLAN_RS_CDF18', 'deleted');
define('ADLAN_RS_CDF19', 'created');
define('ADLAN_RS_CDF20', 'updated');
define('ADLAN_RS_CDF21', 'Enabled');
define('ADLAN_RS_CDF22', 'Description');
define('ADLAN_RS_CDF23', 'Predefined Conditions');
define('ADLAN_RS_CDF24', 'Start after');
define('ADLAN_RS_CDF25', 'days');
define('ADLAN_RS_CDF26', 'Penalty');
define('ADLAN_RS_CDF27', 'per');
define('ADLAN_RS_CDF28', 'Recovery');
define('ADLAN_RS_CDF29', 'visit');
define('ADLAN_RS_CDF30', 'Tools');
define('ADLAN_RS_CDF31', 'leave freeze as is');
define('ADLAN_RS_CDF32', 'freeze all');
define('ADLAN_RS_CDF33', 'unfreeze all');
define('ADLAN_RS_CDF34', 'Reset All Penalties');
define('ADLAN_RS_CDF35', 'Site Penalty is not being used for conditions...');
define('ADLAN_RS_CDF36', 'All users penalties are frozen');
define('ADLAN_RS_CDF37', 'All users penalties are unfrozen');
define('ADLAN_RS_CDF38', 'penalties were reset');
// End Condition Defenitions

// Start Condition Triggers
define('RANKS_CT_01', 'Manual assignment');
define('RANKS_CT_02', 'Site Involvement');
define('RANKS_CT_03', 'Site Penalty');
// End Condition Triggers

// Start Definitions Menu
define('ADLAN_RS_DEF1', 'Rank Category');
define('ADLAN_RS_DEF2', 'deleted');
define('ADLAN_RS_DEF3', 'saved');
define('ADLAN_RS_DEF4', 'updated');
define('ADLAN_RS_DEF5', 'Category Name');
define('ADLAN_RS_DEF6', 'Category Age (0 to disable)');
define('ADLAN_RS_DEF7', 'Update Rank Category');
define('ADLAN_RS_DEF8', 'Create Rank Category');
define('ADLAN_RS_DEF9', 'Clear form');
define('ADLAN_RS_DEF10', 'ID');
define('ADLAN_RS_DEF11', 'Category');
define('ADLAN_RS_DEF12', 'Age');
define('ADLAN_RS_DEF13', 'Are you sure you want to delete this category?');
define('ADLAN_RS_DEF14', 'No categories'); 
define('ADLAN_RS_DEF15', 'Existing Rank Categories');
define('ADLAN_RS_DEF16', 'Rank Name');
define('ADLAN_RS_DEF17', 'Rank Category');
define('ADLAN_RS_DEF18', 'Rank Image');
define('ADLAN_RS_DEF19', 'Rank Points');
define('ADLAN_RS_DEF20', 'Update Rank');
define('ADLAN_RS_DEF21', 'Create Rank');
define('ADLAN_RS_DEF22', 'Rank Reserved');
define('ADLAN_RS_DEF23', 'Are you sure you want to delete this rank?');
define('ADLAN_RS_DEF24', 'No ranks');
define('ADLAN_RS_DEF25', 'Existing Ranks');
define('ADLAN_RS_DEF26', 'Yes');
define('ADLAN_RS_DEF27', 'No');
define('ADLAN_RS_DEF28', 'Rank');
define('ADLAN_RS_DEF29', 'Order');
define('ADLAN_RS_DEF30', 'Category Class');
define('ADLAN_RS_DEF31', 'Wage');
// End Definitions Menu

// Medals Defenitions
define('ADLAN_RS_MDF1', 'Medal Category');
define('ADLAN_RS_MDF2', 'Category Name');
define('ADLAN_RS_MDF3', 'Category Type');
define('ADLAN_RS_MDF4', 'Medals');
define('ADLAN_RS_MDF5', 'Ribbons');
define('ADLAN_RS_MDF6', 'Update Medal Category');
define('ADLAN_RS_MDF7', 'Create Medal Category');
define('ADLAN_RS_MDF8', 'Clear form');
define('ADLAN_RS_MDF9', 'ID');
define('ADLAN_RS_MDF10', 'Type');
define('ADLAN_RS_MDF11', 'Name');
define('ADLAN_RS_MDF12', 'Are you sure you want to delete this category?');
define('ADLAN_RS_MDF13', 'No categories'); 
define('ADLAN_RS_MDF14', 'Existing Medal Categories');
define('ADLAN_RS_MDF15', 'Medal');
define('ADLAN_RS_MDF16', 'Deleted');
define('ADLAN_RS_MDF17', 'Stored');
define('ADLAN_RS_MDF18', 'Updated');
define('ADLAN_RS_MDF19', 'Order');
define('ADLAN_RS_MDF20', 'Image');
define('ADLAN_RS_MDF21', 'Description');
define('ADLAN_RS_MDF22', 'Goal');
define('ADLAN_RS_MDF23', 'Manually assigned');
define('ADLAN_RS_MDF24', 'Update Medal');
define('ADLAN_RS_MDF25', 'Create Medal');
define('ADLAN_RS_MDF26', 'Medal Type');
define('ADLAN_RS_MDF27', 'Category');
define('ADLAN_RS_MDF28', 'Are you sure you want to delete this medal?');
define('ADLAN_RS_MDF29', 'No Medals');
define('ADLAN_RS_MDF30', 'Existing Medals');
define('ADLAN_RS_MDF31', 'Ribbon');
define('ADLAN_RS_MDF32', 'Medal Goal');
define('ADLAN_RS_MDF33', 'Goal Name');
define('ADLAN_RS_MDF34', 'Target');
define('ADLAN_RS_MDF35', 'Required Value');
define('ADLAN_RS_MDF36', 'Update Goal');
define('ADLAN_RS_MDF37', 'Create Goal');
define('ADLAN_RS_MDF38', 'Are you sure you want to delete this goal?');
define('ADLAN_RS_MDF39', 'No Goals');
define('ADLAN_RS_MDF40', 'Site visits');
define('ADLAN_RS_MDF41', 'Forum Posts');
define('ADLAN_RS_MDF42', 'Chatbox posts');
define('ADLAN_RS_MDF43', 'Revalidate all medals');
define('ADLAN_RS_MDF44', 'Medal Reserved');
define('ADLAN_RS_MDF45', 'FAQ Posts');
define('ADLAN_RS_MDF46', 'Medal Res.');
define('ADLAN_RS_MDF47', 'Medal Bonus');
define('ADLAN_RS_MDF48', 'Overview Image');
define('ADLAN_RS_MDF49', 'Select Image');
define('ADLAN_RS_MDF50', '<br/><i>This is the bonus points being added to the rank points (increasing the rank)</i>');
define('ADLAN_RS_MDF51', 'Medal Reward');
define('ADLAN_RS_MDF52', '<br/><i>This is a one time reward (Gold System) payed to the user upon receiving this medal</i>');
define('ADLAN_RS_MDF53', 'Numeric value');
define('ADLAN_RS_MDF54', 'Time');
define('ADLAN_RS_MDF55', 'seconds');
define('ADLAN_RS_MDF56', 'minutes');
define('ADLAN_RS_MDF57', 'hours');
define('ADLAN_RS_MDF58', 'days');
define('ADLAN_RS_MDF59', 'weeks');
define('ADLAN_RS_MDF60', 'months');
define('ADLAN_RS_MDF61', 'years');

// End Medals Defenitions
// Start Main Settings
define('ADLAN_RS_C1', 'Main Configuration');
define('ADLAN_RS_C2', 'Allowed to modify rank points');
define('ADLAN_RS_C3', 'Allowed to assign reserved ranks');
define('ADLAN_RS_C4', 'Allowed to freeze ranks');
define('ADLAN_RS_C5', 'Allowed to freeze site penalty');
define('ADLAN_RS_C6', 'Allowed to modify own rank');
define('ADLAN_RS_C7', 'Status bar height');
define('ADLAN_RS_C8', 'Allowed to put in and out of prison');
define('ADLAN_RS_C9', 'Allowed to put on and off probation');
define('ADLAN_RS_C10', 'Allowed to kick');
//define('ADLAN_RS_C11', 'Auto probation/prison value (behaviour)<br/><i>(0 to disable)</i>');
define('ADLAN_RS_C12', 'In: ');
define('ADLAN_RS_C13', 'Out: ');
define('ADLAN_RS_C14', ' -Auto Prison by behaviour- ');
define('ADLAN_RS_C15', ' -Auto Probation by behaviour- ');
define('ADLAN_RS_C16', 'Authorizations');
define('ADLAN_RS_C17', 'Integration');
define('ADLAN_RS_C18', 'Logging');
define('ADLAN_RS_C19', 'GUI');
define('ADLAN_RS_C20', 'Integrate <i>kicked</i> flag with site ban');
define('ADLAN_RS_C21', 'Log actions into adminlog');
define('ADLAN_RS_C22', 'Show rank image in forum');
define('ADLAN_RS_C23', 'Fixed width <i>(0 for none)</i>');
define('ADLAN_RS_C24', 'Fixed height <i>(0 for none)</i>');
define('ADLAN_RS_C25', 'Allowed to exlude users from age limitations');
define('ADLAN_RS_C26', 'Allowed to modify medals');
define('ADLAN_RS_C27', 'reserved medals: ');
define('ADLAN_RS_C28', 'Userclasses for Probation');
define('ADLAN_RS_C29', 'Userclasses for Prison');
define('ADLAN_RS_C30', 'Allowed to recommend members');
define('ADLAN_RS_C31', 'Allowed to view recommendations');
define('ADLAN_RS_C32', 'Allowed to view details');
define('ADLAN_RS_C33', 'Flags for new members');
define('ADLAN_RS_C34', 'On Probation');
define('ADLAN_RS_C35', 'In Prison');
define('ADLAN_RS_C36', 'Allowed to change plugin settings');
define('ADLAN_RS_C37', 'Don\'t show');
define('ADLAN_RS_C38', 'After');
define('ADLAN_RS_C39', 'poster\'s name');
define('ADLAN_RS_C40', 'avatar');
define('ADLAN_RS_C41', 'level stars');
define('ADLAN_RS_C42', 'moderator image');
define('ADLAN_RS_C43', 'user ID');
define('ADLAN_RS_C44', 'join Date');
define('ADLAN_RS_C45', 'location');
define('ADLAN_RS_C46', 'number of posts');
define('ADLAN_RS_C47', 'last edit timestamp');
define('ADLAN_RS_C48', 'signature');
define('ADLAN_RS_C49', 'thread timestamp');
define('ADLAN_RS_C50', 'report thread image');
define('ADLAN_RS_C51', 'quote image');
define('ADLAN_RS_C52', 'custom title');
define('ADLAN_RS_C53', 'Line BReak');
define('ADLAN_RS_C54', 'None');
define('ADLAN_RS_C55', 'Before image');
define('ADLAN_RS_C56', 'After image');
define('ADLAN_RS_C57', 'Both');
define('ADLAN_RS_C58', '<strong>Notice</strong>: In case an other plugin (like the Gold System) changes the forum layout too, the rank info might be removed by that plugin on some positions!');
define('ADLAN_RS_C59', 'Show medal and ribbon count in forum');
define('ADLAN_RS_C60', 'Before');
define('ADLAN_RS_C61', 'rank image');
define('ADLAN_RS_C62', 'Send PM to member');
define('ADLAN_RS_C63', 'Never');
define('ADLAN_RS_C64', 'When receiving a medal/ribbon');
define('ADLAN_RS_C65', 'When rank changes');
define('ADLAN_RS_C66', 'Both');
define('ADLAN_RS_C67', 'PM Sender');
define('ADLAN_RS_C68', 'User States and Classes');
define('ADLAN_RS_C69', 'Status bar width');
define('ADLAN_RS_C70', 'Fixed');
define('ADLAN_RS_C71', 'Dynamic');
define('ADLAN_RS_C72', 'in User Profile');
define('ADLAN_RS_C73', 'in Ranks Overview');
define('ADLAN_RS_C74', 'pixels');
// End Main Settings

// Start Current Ranks
define('ADLAN_RS_M001', 'Modify User');
define('ADLAN_RS_M002', 'User ID');
define('ADLAN_RS_M003', 'User Name');
define('ADLAN_RS_M004', 'Rank');
define('ADLAN_RS_M005', 'Action');
define('ADLAN_RS_M006', 'Edit');
define('ADLAN_RS_M007', 'User');
define('ADLAN_RS_M008', 'Filter');
define('ADLAN_RS_M009', 'Freeze Rank');
define('ADLAN_RS_M010', 'Freeze Penalty');
define('ADLAN_RS_M011', '(automatic calculation)');
define('ADLAN_RS_M012', 'Reset Penalty');
define('ADLAN_RS_M013', '(automatic calculation, except when frozen)');
define('ADLAN_RS_M014', 'Special');
define('ADLAN_RS_M015', 'Revalidate All Ranks');
define('ADLAN_RS_M016', 'All Ranks have been revalidated');
define('ADLAN_RS_M017', 'No age limits');
define('ADLAN_RS_M018', 'Points');
define('ADLAN_RS_M019', 'Show Details');
define('ADLAN_RS_M020', 'Current Ranks - details');
define('ADLAN_RS_M021', 'Medal Bonus');
define('ADLAN_RS_M022', 'Current Ranks - overview');
define('ADLAN_RS_M023', 'Show Overview');
define('ADLAN_RS_M024', 'Global Rank settings');
define('ADLAN_RS_M025', 'Conditions');
define('ADLAN_RS_M026', 'Specials');
// End Current Ranks

// Start Current Medals
define('ADLAN_RS_MD01', 'All Medals have been revalidated');
define('ADLAN_RS_MD02', 'Current Medals');
define('ADLAN_RS_MD03', 'User ID');
define('ADLAN_RS_MD04', 'User Name');
define('ADLAN_RS_MD05', 'Action');
define('ADLAN_RS_MD06', 'Edit');
define('ADLAN_RS_MD07', 'User');
define('ADLAN_RS_MD08', 'Filter');
define('ADLAN_RS_MD09', 'Revalidate All Medals');
define('ADLAN_RS_MD10', 'Modify User');
define('ADLAN_RS_MD11', 'Date');
define('ADLAN_RS_MD12', 'Grant');
define('ADLAN_RS_MD13', 'Revoke');
define('ADLAN_RS_MD14', 'Medal revoked from user');
define('ADLAN_RS_MD15', 'Medal granted to user');
define('ADLAN_RS_MD16', 'Remarks');
define('ADLAN_RS_MD17', 'Grant medal');
define('ADLAN_RS_MD18', 'Cancel');
define('ADLAN_RS_MD19', 'Edit Remarks');
define('ADLAN_RS_MD20', 'Remarks saved');
define('ADLAN_RS_MD21', 'No Changes');
define('ADLAN_RS_MD22', 'Show');
define('ADLAN_RS_MD23', 'User');
define('ADLAN_RS_MD24', 'Granted');
// End Current Medals

//Start Recommendations
define('ADLAN_RS_RM01', 'Recommendations');
define('ADLAN_RS_RM02', '#');
define('ADLAN_RS_RM03', 'Recommended');
define('ADLAN_RS_RM04', 'By');
define('ADLAN_RS_RM05', 'Type');
define('ADLAN_RS_RM06', 'For');
define('ADLAN_RS_RM07', 'Motivation');
define('ADLAN_RS_RM08', 'Date');
define('ADLAN_RS_RM09', 'State');
define('ADLAN_RS_RM10', 'Open');
define('ADLAN_RS_RM11', 'Granted');
define('ADLAN_RS_RM12', 'Declined');
define('ADLAN_RS_RM13', 'Delete');
define('ADLAN_RS_RM14', 'Update');
define('ADLAN_RS_RM15', 'Recommendation was deleted');
define('ADLAN_RS_RM16', 'Recommendation was NOT deleted');
define('ADLAN_RS_RM17', 'Decline');
define('ADLAN_RS_RM18', 'Grant');
define('ADLAN_RS_RM19', 'custom');
define('ADLAN_RS_RM20', 'Closed');
define('ADLAN_RS_RM21', 'There are no open recommendations');
//End Recommendations

//Stat System (e107)
define('ADLAN_RS_SS01', 'Recommendations');
//End System

//New Install
define('ADLAN_RS_NI01', 'New Installation');
define('ADLAN_RS_NI02', 'Thank you for installing and using/trying the Rank System!<br/>This is a fresh (empty) installation. Do you want to load all kinds of default settings to start with (ranks, medals, etc) ?');
define('ADLAN_RS_NI03', 'Yes');
define('ADLAN_RS_NI04', 'No');
define('ADLAN_RS_NI05', 'Default settings have successfully been imported!');
define('ADLAN_RS_NI06', '<b>Error while importing default settings!</b>');
define('ADLAN_RS_NI07', 'Continue');

?>