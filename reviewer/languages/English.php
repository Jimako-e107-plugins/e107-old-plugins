<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
define(REVIEWER_PAGETITLE, "Reviewer");
// rate terms and conditions
define(REVIEWER_TANDC, "This review section is for information purposes only. <b>Under NO circumstances</b> shall the site owner tolerate people posting defamatory, misrepresented, libelous content in this review section.<br /><br />
The purpose of the review is to share your experiences. We would like you to write your experience with other members. Although we respect your freedom of speech, we hope you respect our website and that our website is for information purposes only. To report abuse please use the contact us form.<br /><br />
We reserve the right to remove any reviews at any time without notice . <b>All posts are the responsibilty of the poster and the site owner accepts no responsibilty from the information provided.</b>");
define(REVIEWER_TANDC01, "Reviews : Terms and Conditions for Posting Reviews");
define(REVIEWER_TANDC02, "I Accept");
define(REVIEWER_TANDC03, "I do not Accept");


define(REVIEWER_P001, "Reviews in Category :");
define(REVIEWER_P002, "Reviews for :");
define(REVIEWER_P003, "Add / Edit Review :");
// default rate descriptions
define(REVIEWER_RATE1, "Rate 1");
define(REVIEWER_RATE2, "Rate 2");
define(REVIEWER_RATE3, "Rate 3");
define(REVIEWER_RATE4, "Rate 4");
define(REVIEWER_RATE5, "Rate 5");
define(REVIEWER_RATE6, "Rate 6");
define(REVIEWER_RATE7, "Rate 7");
define(REVIEWER_RATE8, "Rate 8");
define(REVIEWER_RATE9, "Rate 9");
define(REVIEWER_RATE10, "Rate 10");

define(REVIEWER_H001, "Reviews");
define(REVIEWER_H002, "No categories defined");
define(REVIEWER_H003, "Category");
define(REVIEWER_H004, "Select");
define(REVIEWER_H005, "View");
define(REVIEWER_H006, "Visit Site");
define(REVIEWER_H007, "Overall Rating");
define(REVIEWER_H008, "Invalid Security Code");
define(REVIEWER_H009, "Some Fields not completed");
define(REVIEWER_H010, "Review");
define(REVIEWER_H011, "Rating");
define(REVIEWER_H012, "Number of Reviews");
define(REVIEWER_H013, "Last Reviewed");
define(REVIEWER_H014, "Action");
define(REVIEWER_H015, "Confirm Deletion");
define(REVIEWER_H016, "Delete");
define(REVIEWER_H017, "Cancel");
define(REVIEWER_H018, "Are you sure you wish to delete this review and any associated comments?");
define(REVIEWER_H019, "Be the first to write a review");
define(REVIEWER_H020, "Back");
define(REVIEWER_H021, "Create an item for review");
define(REVIEWER_H022, "Approval");
define(REVIEWER_H023, "Your submission will be automatically approved");
define(REVIEWER_H024, "Your submission will need to be approved by an admin");
define(REVIEWER_H025, "No Reviews");
define(REVIEWER_H026, "Invalid item");
define(REVIEWER_H027, "Review of item");
define(REVIEWER_H028, " at ");
define(REVIEWER_H029, "In category");
define(REVIEWER_H030, "Back");

define(REVIEWER_V001, "Reviewed by");
define(REVIEWER_V002, "Review date");
define(REVIEWER_V003, "Review");
define(REVIEWER_V004, "Action");
define(REVIEWER_V005, "Add your Review");
define(REVIEWER_V006, "Save Changes");
define(REVIEWER_V007, "Your changes have been submitted");
define(REVIEWER_V008, "From");
define(REVIEWER_V009, "Reviews");
define(REVIEWER_V010, "Thank you, your review has been added.");
define(REVIEWER_V011, "You have already reviewed this.");
define(REVIEWER_V012, "Thank you for your review");
define(REVIEWER_V013, "[IP Logged]");
define(REVIEWER_V014, "<b>Please Rate on the following basis:</b>");
define(REVIEWER_V015, "Poor: ");
define(REVIEWER_V016, "Below Average: ");
define(REVIEWER_V017, "Average: ");
define(REVIEWER_V018, "Above Average: ");
define(REVIEWER_V019, "Excellent: ");
define(REVIEWER_V020, "Invalid item number");
define(REVIEWER_V021, "Email link to a friend");
define(REVIEWER_V022, "Printable Version");
define(REVIEWER_V024, "Reviews in Category");
define(REVIEWER_V025, "Rating");
define(REVIEWER_V026, "Review");


define(REVIEWER_A001, "Reviews");
define(REVIEWER_A002, "A Plugin to list and solicit reviewer from users");
define(REVIEWER_A003, "Reviews");
define(REVIEWER_A004, "Plugin installed. Please do an integrity check and database validity check. Then go and configure the plugin.");
define(REVIEWER_A005, "Plugin Upgraded. Please do an integrity check and database validity check. Then go and check the configuration.");
define(REVIEWER_A006, "Reviews Read Class");
define(REVIEWER_A007, "Reviews Submit Class");
define(REVIEWER_A008, "Reviews Admin Class");
define(REVIEWER_A009, "Admin Class");
define(REVIEWER_A010, "Post Review Class");
define(REVIEWER_A011, "Read Class");
define(REVIEWER_A012, "Changes Saved");
define(REVIEWER_A013, "Number of categories per page");
define(REVIEWER_A014, "Number of Reviews per page");
define(REVIEWER_A015, "Use rating 1");
define(REVIEWER_A016, "Use rating 2");
define(REVIEWER_A017, "Use rating 3");
define(REVIEWER_A018, "Use rating 4");
define(REVIEWER_A019, "Use rating 5");
define(REVIEWER_A020, "Allow comments on reviews");
define(REVIEWER_A021, "Main Configuration");
define(REVIEWER_A022, "Force disclaimer");
define(REVIEWER_A023, "Save Changes");
define(REVIEWER_A024, "Default Category");
define(REVIEWER_A025, "No Categories Defined");
define(REVIEWER_A026, "Total Reviews");
define(REVIEWER_A027, "Reviewer");
define(REVIEWER_A028, "Title:");
define(REVIEWER_A029, "Use rating 6");
define(REVIEWER_A030, "Use rating 7");
define(REVIEWER_A031, "Use rating 8");
define(REVIEWER_A032, "Use rating 9");
define(REVIEWER_A033, "Use rating 10");
define(REVIEWER_A034, "Duplicate all items to this category :-");
define(REVIEWER_A035, "Duplicate");
define(REVIEWER_A036, "Duplicate Category");
define(REVIEWER_A037, "Use Category Rate info");
define(REVIEWER_A038, "Tick to recalculate all reviews");
define(REVIEWER_A039, "Recalculate");
define(REVIEWER_A040, "Number of reviews in menu");
define(REVIEWER_A041, "Recalculate all reviews");
define(REVIEWER_A042, "Recalculation completed");
define(REVIEWER_A043, "Recalculation not processed. Tick the box to recalculate.");
// admin menu items
define(REVIEWER_M002, "Reviews Lister");
define(REVIEWER_M003, "Main Configuration");
define(REVIEWER_M004, "Categories");
define(REVIEWER_M005, "Items");
define(REVIEWER_M006, "Read Me");
define(REVIEWER_M007, "Check for Updates");
define(REVIEWER_M008, "Recalculate reviews");
define(REVIEWER_M009, "Approve Items");
// admin config
define(REVIEWER_AC001, "Reviews Lister");
define(REVIEWER_AC002, "Administer Categories");
define(REVIEWER_AC003, "Categories");
define(REVIEWER_AC004, "Action");
define(REVIEWER_AC005, "Edit");
define(REVIEWER_AC006, "New");
define(REVIEWER_AC007, "Delete");
define(REVIEWER_AC008, "Confirm");
define(REVIEWER_AC009, "Update");
define(REVIEWER_AC010, "No categories defined");
define(REVIEWER_AC011, "Category Name");
define(REVIEWER_AC012, "Category Description");
define(REVIEWER_AC013, "Category Icon");
define(REVIEWER_AC014, "Save");
define(REVIEWER_AC015, "Category added");
define(REVIEWER_AC016, "Unable to add.");
define(REVIEWER_AC017, "Changes saved");
define(REVIEWER_AC018, "Unable to save changes.");
define(REVIEWER_AC019, "Adding record");
define(REVIEWER_AC020, "Editing record");
define(REVIEWER_AC021, "You must confirm the deletion");
define(REVIEWER_AC022, "Category deleted");
define(REVIEWER_AC023, "Unable to delete category");
define(REVIEWER_AC024, "Items attached to this category. Unable to delete.");
define(REVIEWER_AC025, "Category name already exists");
define(REVIEWER_AC026, "Terms and Conditions (Leave blank for REVIEWER_TANDC from language file)");
define(REVIEWER_AC027, "Create items for review");
define(REVIEWER_AC028, "Auto approve items for review");
define(REVIEWER_AC029, "Use half reviews");
define(REVIEWER_AC030, "Link Icon");
define(REVIEWER_AC031, "Allow users to edit their own reviews");
define(REVIEWER_AC032, "Allow users to edit their own items");



define(REVIEWER_AI001, "Review Lister");
define(REVIEWER_AI002, "Administer Items");
define(REVIEWER_AI003, "Edit Items");
define(REVIEWER_AI004, "Category");
define(REVIEWER_AI005, "Select");
define(REVIEWER_AI006, "Review Items");
define(REVIEWER_AI007, "Name");
define(REVIEWER_AI008, "Description");
define(REVIEWER_AI009, "Link URL");
define(REVIEWER_AI010, "Action");
define(REVIEWER_AI011, "Confirm");
define(REVIEWER_AI012, "Save Changes");
define(REVIEWER_AI013, "Add Item");
define(REVIEWER_AI014, "Item Name");
define(REVIEWER_AI015, "Add a new item");
define(REVIEWER_AI016, "Item added");
define(REVIEWER_AI017, "Item name already exists");
define(REVIEWER_AI018, "Order");
define(REVIEWER_AI019, "Changes saved");
define(REVIEWER_AI020, "Picture");
define(REVIEWER_AI021, "No Picture");
define(REVIEWER_AI022, "Are you sure you wish to delete item");
define(REVIEWER_AI023, "Delete Item");
define(REVIEWER_AI024, "Delete");
define(REVIEWER_AI025, "Cancel");
define(REVIEWER_AI026, "and all the reviews associated with it?");
define(REVIEWER_AI027, "Item Deleted");
define(REVIEWER_AI028, "Use secure image for anon reviews");
define(REVIEWER_AI028, "Use secure image for anon reviews");
define(REVIEWER_AI029, "Create/Edit review");
define(REVIEWER_AI030, "Approved");
define(REVIEWER_AI031, "Upload");
define(REVIEWER_AI032, "Poster");
define(REVIEWER_AI033, "Review items to be approved");
define(REVIEWER_AI034, "Use SEO");
define(REVIEWER_AI035, 'Requires Apache mod rewrite. IIS users will need to create their own rewrite module. If an error occurs you may need to check permissions and edit the .htaccess file directly. If you modify the .htaccess file yourself for any reason, keep a copy. You can create a link in sitelinks to reviewer.html.');
define(REVIEWER_AI036, "Error working with .htaccess file. Something buggered up. ");
define(REVIEWER_AI037, 'Success~Unable to create temporary file~Unable to delete old.htaccess~Unable to rename .htaccess to old.htaccess~Unable to rename temporary file to .htaccess~Unable to write to temporary file');
define(REVIEWER_AI038, 'Missing fields');


define(REVIEWER_N01, "Reviewer");
define(REVIEWER_N02, "New Review Posted");
define(REVIEWER_N03, "A review by");
define(REVIEWER_N04, "Review details");
define(REVIEWER_N05, "In category");
define(REVIEWER_N06, "Item Name");
define(REVIEWER_N07, "Review Updated");
define(REVIEWER_N08, "Review Edited");
define(REVIEWER_N09, "New Review Item");
define(REVIEWER_N10, "Review item Edited");

define(REVIEWER_S01, "Posted");
define(REVIEWER_S02, "Review Detail");
define(REVIEWER_S03, "Found in review");

define(REVIEWER_L01, "Latest Reviews");
define(REVIEWER_L02, "There are");
define(REVIEWER_L03, "reviews");
define(REVIEWER_L04, "in");
define(REVIEWER_L05, "categories");
define(REVIEWER_L06, "The latest are for:");
define(REVIEWER_L07, "Posted on");
define(REVIEWER_L08, "Posted by");

define(REVIEWER_L09, "Review Categories");
define(REVIEWER_L10, "has");
define(REVIEWER_L11, "item");
define(REVIEWER_L12, "items");

define(REVIEWER_L13, "Most Reviewed Items");
define(REVIEWER_L14, "With");
define(REVIEWER_L15, "review");
define(REVIEWER_L16, "reviews");
define(REVIEWER_L17, "The most reviewed are");

define(REVIEWER_L18, "Top Reviewers");
define(REVIEWER_L19, "Our Top Reviewers are");
define(REVIEWER_L20, "with");
define(REVIEWER_L21, "review");
define(REVIEWER_L22, "reviews");
define(REVIEWER_L23, "Top Items in each category");
define(REVIEWER_L24, "No categories defined");
define(REVIEWER_L25, "No items in this category");
define(REVIEWER_L26, "Category");
define(REVIEWER_L27, "See all Reviewers");

define(REVIEWER_EM1, "View Review");
define(REVIEWER_EM2, "Review of");
define(REVIEWER_EM3, "In category");
define(REVIEWER_EM4, "Review by");
define(REVIEWER_EM5, "reviewed on");
define(REVIEWER_EM6, "Overall Rating");
define(REVIEWER_EM7, "From");
define(REVIEWER_EM8, "Reviews");

define(REVIEWER_R50, "World Class");
define(REVIEWER_R45, "Outstanding");
define(REVIEWER_R40, "Most Excellent");
define(REVIEWER_R35, "Excellent");
define(REVIEWER_R30, "Very Fine");
define(REVIEWER_R25, "Fine");
define(REVIEWER_R20, "Average");
define(REVIEWER_R15, "Ordinary");
define(REVIEWER_R10, "Poor");
define(REVIEWER_R05, "Bad");
define(REVIEWER_R00, "Avoid");


define(REVIEWER_IM01, "Latest Items");
define(REVIEWER_IM02, "The latest items for review are");
define(REVIEWER_IM03, "Last updated");

define(REVIEWER_SI01, "Submitted Items");
define(REVIEWER_SI02, "Title");
define(REVIEWER_SI03, "Description");
define(REVIEWER_SI04, "Poster");
define(REVIEWER_SI05, "Approve");
define(REVIEWER_SI06, "Delete");
define(REVIEWER_SI07, "Toggle");
define(REVIEWER_SI08, "Update");
define(REVIEWER_SI09, "No items need approving");
define(REVIEWER_SI10, "Reviewer");
define(REVIEWER_SI11, "Updates Processed");

define(REVIEWER_UL01, "Reviews by member");
define(REVIEWER_UL02, "Date");
define(REVIEWER_UL03, "Item");
define(REVIEWER_UL04, "Review");
define(REVIEWER_UL05, "Rating");
define(REVIEWER_UL06, "View");
define(REVIEWER_UL07, "Reviews by");

define(REVIEWER_RL01, "All Reviews by members");
define(REVIEWER_RL02, "Reviewer");
define(REVIEWER_RL03, "Number of reviews");
define(REVIEWER_RL04, "Date of Last Review");


define(REVIEWER_LIST01, "No reviews to display");
// lang for rss
define(REVIEWER_RSS01, "Reviewer");
define(REVIEWER_RSS02, "RSS Feed for Reviewer Latest Reviews");
define(REVIEWER_RSS03, "RSS Feed for Reviewer Latest Items");
define(REVIEWER_RSS04, "Latest review on");
define(REVIEWER_RSS05, "Latest item for review");
define(REVIEWER_RSS06, "Review RSS Feeds");
define(REVIEWER_RSS07, "Keep up to date with our reviews using our RSS feeds");
define(REVIEWER_RSS08, "Item Feeds");
define(REVIEWER_RSS09, "Review Feeds");

define(FB_D01,'Donate.');
define(FB_D02,'<b><a href="http://www.keal.me.uk" >A Father Barry Plugin</a></b><br /><br />To support continued development of this and other e107 plugins please consider making a donation.');
