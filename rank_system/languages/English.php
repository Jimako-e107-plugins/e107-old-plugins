<?php
/**
 * $Id: English.php,v 1.7 2009/10/22 21:29:44 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.7 $
 * Last Modified: $Date: 2009/10/22 21:29:44 $
 *
 * Change Log:
 * $Log: English.php,v $
 * Revision 1.7  2009/10/22 21:29:44  michiel
 * Implemeted Time-based goals
 *
 * Revision 1.6  2009/10/22 17:28:24  michiel
 * - Implemented conditions
 * - Processing action upong changing the recommendation state
 * - Members can view the recommendations they've submitted themselves
 *
 * Revision 1.5  2009/10/22 15:20:25  michiel
 * Show bonus points and reward in Medal Overview
 *
 * Revision 1.4  2009/10/22 15:03:37  michiel
 * Implemented customizable conditions
 *
 * Revision 1.3  2009/07/14 19:29:07  michiel
 * CVS Merge
 *
 * Revision 1.2.2.2  2009/07/13 18:53:40  michiel
 * - Added Sending PM
 * - Added medal reward
 *
 * Revision 1.2.2.1  2009/07/05 20:30:30  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.2.4.1  2009/06/30 20:10:15  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.2  2009/06/28 15:05:54  michiel
 * Merged from dev_01_03
 *
 * Revision 1.1.4.1  2009/06/28 02:35:05  michiel
 * - Position of rank image in forum is configurable
 * - Medal/Ribbon counts can be shown in forum
 *
 * Revision 1.1  2009/03/28 13:01:46  michiel
 * Initial CVS revision
 *
 *  
 */

define('RANKS_DENIED', 'You\'re not authorized to view this page');

define('RANKS_01', 'Rank System');
//define('RANKS_02', 'Skill');
//define('RANKS_03', 'Teamplay');
//define('RANKS_04', 'Involvement');
//define('RANKS_05', 'Involvement (site)');
//define('RANKS_06', 'Behaviour');
//define('RANKS_07', 'Penalty (site)');
define('RANKS_08', 'Remarks');
define('RANKS_09', 'In Prison');
define('RANKS_10', 'On Probation');
define('RANKS_11', 'Kicked');
define('RANKS_12', 'Categories');
define('RANKS_13', 'Specials');
define('RANKS_14', 'Ranks');
define('RANKS_15', 'Rank');
define('RANKS_16', 'Required points');
define('RANKS_17', 'Required age');
define('RANKS_18', 'Current users');
define('RANKS_19', 'New Member');
define('RANKS_20', 'Conditions');

define('RANKS_CT_01', 'Manual assignment');
define('RANKS_CT_02', 'Site Involvement');
define('RANKS_CT_03', 'Site Penalty');

define('RANKS_ED_01', 'Edit rank');
define('RANKS_ED_02', 'You are not allowed to edit ranks!');
define('RANKS_ED_03', 'You are not allowed to edit your own rank!');
define('RANKS_ED_04', 'Kick');
define('RANKS_ED_05', 'Unkick');
define('RANKS_ED_06', 'Into Prison');
define('RANKS_ED_07', 'Out of Prison');
define('RANKS_ED_08', 'On Probation');
define('RANKS_ED_09', 'Off Probation');
define('RANKS_ED_10', 'Access Denied!');
define('RANKS_ED_11', 'Cancel');
define('RANKS_ED_12', 'Exclude user from age limitations');

define('RANKS_FRM_01', 'Medals:');
define('RANKS_FRM_02', 'Ribbons:');

define('RANKS_GS_01', 'Your ');
define('RANKS_GS_02', '\'s wage');
define('RANKS_GS_03', 'Reward for receiving the ');
define('RANKS_GS_04', ' medal');
define('RANKS_GS_05', ' ribbon');

define('RANKS_LOG_01', 'Changed rank settings of');
define('RANKS_LOG_02', 'sent into prison');
define('RANKS_LOG_03', 'released out of prison');
define('RANKS_LOG_04', 'put on probation');
define('RANKS_LOG_05', 'put off probation');
define('RANKS_LOG_06', 'kicked');
define('RANKS_LOG_07', 'unkicked');

define('RANKS_LNK_01', 'Ranks');

define('RANKS_MED_01', 'Medals');
define('RANKS_MED_02', 'Name');
define('RANKS_MED_03', 'Category');
define('RANKS_MED_04', 'Type');
define('RANKS_MED_05', 'Description');
define('RANKS_MED_06', 'Medal');
define('RANKS_MED_07', 'Ribbon');
define('RANKS_MED_08', 'Members who have received this medal');
define('RANKS_MED_09', 'Members who have received this ribbon');
define('RANKS_MED_10', 'Nobody');
define('RANKS_MED_11', 'Medals &amp; Ribbons');
define('RANKS_MED_12', 'Edit Medals');
define('RANKS_MED_13', 'Member');
define('RANKS_MED_14', 'Reason');
define('RANKS_MED_15', 'Awarded on');
define('RANKS_MED_16', 'Medals');
define('RANKS_MED_17', 'Ribbons');
define('RANKS_MED_18', 'All');
define('RANKS_MED_19', 'Bonus points');
define('RANKS_MED_20', 'Reward');

define('RANKS_MED_ED_01', 'You are not allowed to edit your own medals!');
define('RANKS_MED_ED_02', 'You are not allowed to edit medals!');
define('RANKS_MED_ED_03', 'Medal Name');
define('RANKS_MED_ED_04', 'Date granted');
define('RANKS_MED_ED_05', 'Action');
define('RANKS_MED_ED_06', 'Grant Medal');
define('RANKS_MED_ED_07', 'Revoke');
define('RANKS_MED_ED_08', 'Return to profile');
define('RANKS_MED_ED_09', 'Remarks');

define('RANKS_RM_01', 'Recommendation');
define('RANKS_RM_02', 'You are not allowed to post recommendations!');
define('RANKS_RM_03', 'Recommend for rank level');
define('RANKS_RM_04', 'Complaint about behaviour');
define('RANKS_RM_05', 'Recommend for medal');
define('RANKS_RM_06', 'Recommendation type');
define('RANKS_RM_07', 'Recommend member');
define('RANKS_RM_08', 'Next ->');
define('RANKS_RM_09', 'Motivation');
define('RANKS_RM_10', 'Submit Recommendation');
define('RANKS_RM_11', 'Your recommendation has been sent!<br>Thank you.');
define('RANKS_RM_12', 'Your recommendation has <strong>NOT</strong> been sent!<br>Please contact site admin.');
define('RANKS_RM_13', 'View Recommendations');
define('RANKS_RM_14', 'From');
define('RANKS_RM_15', 'For');
define('RANKS_RM_16', 'Show');
define('RANKS_RM_17', 'Type');
define('RANKS_RM_18', 'Date');
define('RANKS_RM_19', 'No recommendations');
define('RANKS_RM_20', 'this user');
define('RANKS_RM_21', 'All');
define('RANKS_RM_22', 'State');
define('RANKS_RM_23', 'You have not submitted a recommendation yet...');
define('RANKS_RM_24', 'View my Recommendations');

define('RANKS_NF_01', 'Rank Recommendation');
define('RANKS_NF_02', 'Rank Recommendation submitted');
define('RANKS_NF_03', 'A new recommendation has been submitted by');
define('RANKS_NF_04', 'Recommended member');
define('RANKS_NF_05', 'Recommendation');
define('RANKS_NF_06', 'Motivation');

define('RANKS_PM_01', 'You have been awarded a medal!');
define('RANKS_PM_02', 'You have been awarded a ribbon!');
define('RANKS_PM_03', 'Hi {USER_NAME}!<br/><br/>Congratulations!<br/>You have been awared the <strong>{MEDAL_NAME}</strong> medal!<br/>{MEDAL_IMAGE}');
define('RANKS_PM_04', 'Hi {USER_NAME}!<br/><br/>Congratulations!<br/>You have been awared the <strong>{MEDAL_NAME}</strong> ribbon!<br/>{MEDAL_IMAGE}');
define('RANKS_PM_05', 'The reason for this was:<br/><blockquote>{DESCRIPTION}</blockquote>');
define('RANKS_PM_06', 'By receiving this medal/ribbon, you\'ve also received a reward of <strong>{MEDAL_REWARD} {GOLD_CURRENCY}</strong>.');
define('RANKS_PM_07', 'You have been promoted!');
define('RANKS_PM_08', 'You have been degraded!');
define('RANKS_PM_09', 'Hi {USER_NAME}!<br/><br/>Congratulations!<br/>You have been promoted!<br/><br/>You are now a <strong>{RANK_NAME}</strong>!<br/>{RANK_IMAGE}');
define('RANKS_PM_10', 'Hi {USER_NAME}!<br/><br/>I\'m sorry to inform you, but you have been degraded!<br/><br/>You are now a <strong>{RANK_NAME}</strong>.<br/>{RANK_IMAGE}');

define('RANKS_UP_01', 'Rank points:');
define('RANKS_UP_02', 'Medal bonus:');
define('RANKS_UP_03', 'Total:');
define('RANKS_UP_04', 'Next rank:');
define('RANKS_UP_05', '<i>Age Limit</i>');
define('RANKS_UP_06', '-');
define('RANKS_UP_07', '<i>rank is static</i>');

/*
define('RANKS_USR_01', 'Users');
define('RANKS_USR_02', 'Rank');
define('RANKS_USR_03', 'User');
define('RANKS_USR_04', 'Medals');
define('RANKS_USR_05', 'Ribons');
*/

?>