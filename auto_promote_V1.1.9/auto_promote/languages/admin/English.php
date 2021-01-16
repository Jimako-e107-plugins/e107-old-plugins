<?php
/*
+---------------------------------------------------------------+
|	Auto Promote Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2009
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

define(APROM_THRESHOLDS,"<,less than~<=,less than or equal to~=,equal to~!=,not equal to~>=,greater than or equal to~>,greater than");
define(APROM_P0,"Forum Posts");
define(APROM_P1,"Chat Posts");
define(APROM_P2,"Days Membership");
define(APROM_P3,"Days since last visit");
define(APROM_P4,"Uploads");
define(APROM_P5,"Downloads");
define(APROM_P6,"User Ranking");

define(APROM_M01,"Automatically change userclass based on specified criteria");
define(APROM_M02,"Auto Promote Users");
define(APROM_M03,"Goto the admin section and configure your promotions. Make sure you have backups of the user table before using.");
define(APROM_M04,"Plugin upgraded. Check database validity, file integrity, do a plugin scan and confirm the configuration.");

define(APROM_AMESSAGE,"Hi there");
define(APROM_SUBJECT,"Your status on the site has changed.");
define(APROM_FOOTER,"This now means that your priviledges on the site have changed.<br />Regards from The Team");

define(APROM_AMESSAGEF1,"Because of the number of forum posts you have made is");
define(APROM_AMESSAGEF2,"You have been removed from the following userclass");
define(APROM_AMESSAGEF3,"You have been added to the following userclass");
define(APROM_AMESSAGEF4,"forum posts");

define(APROM_AMESSAGEC1,"Because of the number of chat box posts you have made is");
define(APROM_AMESSAGEC2,"You have been removed from the following userclass");
define(APROM_AMESSAGEC3,"You have been added to the following userclass");
define(APROM_AMESSAGEC4," chatbox posts");

define(APROM_AMESSAGED1,"Because the number of days you been a member for is");
define(APROM_AMESSAGED2,"You have been removed from the following userclass");
define(APROM_AMESSAGED3,"You have been added to the following userclass");
define(APROM_AMESSAGED4,"days");

define(APROM_AMESSAGEL1,"Because you have reached a contribution level which is");
define(APROM_AMESSAGEL2,"You have been removed from the following userclass");
define(APROM_AMESSAGEL3,"You have been added to the following userclass");
define(APROM_AMESSAGEL4," (which is based on a combination of forum posts, chatbox posts, visits and comments) ");

define(APROM_AMESSAGEV1,"Because the number of days since your last visit is ");
define(APROM_AMESSAGEV2,"You have been removed from the following userclass");
define(APROM_AMESSAGEV3,"You have been added to the following userclass");
define(APROM_AMESSAGEV4,"days");

define(APROM_A1, "Auto Promote Users");
define(APROM_A2, "Notify");
define(APROM_A3, "Promote on");
define(APROM_A4, "Threshold");
define(APROM_A5, "Remove from");
define(APROM_A6, "Assign To");
define(APROM_A7, "Yes");
define(APROM_A8, "No");
define(APROM_A9, "Save Changes");
define(APROM_A10, "Check for Updates");
define(APROM_A11, "Add New");
define(APROM_A12, "Delete");
define(APROM_A13, "Configure");
define(APROM_A14, "No Promotions Defined");
define(APROM_A15, "Promote Users");
define(APROM_A16, "Promoted users");
define(APROM_A17, "Affected");
define(APROM_A18, "Source and destination classes must be specified");
define(APROM_A19, "Completed");
define(APROM_A20, "Target userclass must be specified");
define(APROM_A21, "Completed");
define(APROM_A22, "Move Users");
define(APROM_A23, "Delete users");
define(APROM_A24, "Copy users");
define(APROM_A25, "You are now about to promote users based on the criteria set in the main configuration. If you have a large number of users you may need to increase the execution time.<br /><br />If you have enabled the notify users option then this may generate a large number of emails which could cause problems with your ISP.<br /><br />Ensure you have a tested backup before promoting.");
define(APROM_A26, "email");
define(APROM_A27, "PM");
define(APROM_A28, "Criteria");
define(APROM_A29, "Main Configuration");
define(APROM_A30, "Use theme CSS in email");
define(APROM_A31, "Email From name");
define(APROM_A32, "Email From address");
define(APROM_A33, "PM Sent as user");
define(APROM_A34, "Changes saved");
define(APROM_A35, "Plugin Active");
define(APROM_A36, "Readme");
define(APROM_A37, "Run continuously");
define(APROM_A38, "Affected");
define(APROM_A39, "Action");
define(APROM_A40, "Order");
define(APROM_A41, "Criteria");

define(APROM_HELP_C01,'Auto Promote');
define(APROM_HELP_C02,'Configuration');
define(APROM_HELP_C03,'Plugin Active');
define(APROM_HELP_C04,'Turn on or off the auto promote plugin');
define(APROM_HELP_C05,'Use theme CSS in email');
define(APROM_HELP_C06,'If turned on then the emails sent out will include the site\'s theme.');
define(APROM_HELP_C07,'Run continuously');
define(APROM_HELP_C08,'If turned on then the auto promote runs on every page load by all visitors. Enable this for testing. Normally should be disabled so it runs once per day.');
define(APROM_HELP_C09,'Email From name');
define(APROM_HELP_C10,'The name to be used on emails notifying class change.');
define(APROM_HELP_C11,'Email From address');
define(APROM_HELP_C12,'The email address to be used on emails notifying class change.');
define(APROM_HELP_C13,'PM Sent as user');
define(APROM_HELP_C14,'If notifying by PM then send as this user.');

define(APROM_HELP_C16,'Criteria');
define(APROM_HELP_C17,'Promote on');
define(APROM_HELP_C18,'Select the criteria on which to promote.');
define(APROM_HELP_C19,'Action');
define(APROM_HELP_C20,'select which action to check.');
define(APROM_HELP_C21,'Threshold');
define(APROM_HELP_C22,'The valuse to test the action against.');
define(APROM_HELP_C23,'Remove from');
define(APROM_HELP_C24,'Select the class to remove from. Only those in this class will have the criteria applied. Inactive means any member will match.');
define(APROM_HELP_C25,'Assign To');
define(APROM_HELP_C26,'Members matching this criteria will be added to this class.');
define(APROM_HELP_C27,'Notify');
define(APROM_HELP_C28,'Notify members of class change by PM or email (or no notification)');
define(APROM_HELP_C29,'Order');
define(APROM_HELP_C30,'The order in which the rules are applied.');
define(APROM_HELP_C31,'Delete');
define(APROM_HELP_C32,'Checking this box and saving changes will delete the rule.');

define(APROM_HELP_C34,'Promote');
define(APROM_HELP_C35,'Affected');
define(APROM_HELP_C36,'To view those members who will be affected by applying the criteria click the View Button');
define(APROM_HELP_C37,'Promote Users');
define(APROM_HELP_C38,'This will execute the promotions. This may take time with a lot of users and emailing/pming.');

define(APROM_HELP_C40,'Readme');
define(APROM_HELP_C41,'Readme');
define(APROM_HELP_C42,'Well, what do you think you\'d find?');

define(APROM_HELP_C44,'Update Check');
define(APROM_HELP_C45,'Update');
define(APROM_HELP_C46,'Check for updates');

define(APROM_D01,'Donate.');
define(APROM_D02,'<b><a href="http://www.keal.me.uk" >A Father Barry Plugin</a></b><br /><br />To support continued development of this and other e107 plugins please consider making a donation.');