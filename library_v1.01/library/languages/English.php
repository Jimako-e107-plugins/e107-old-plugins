<?php 
/* 
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/languages/English.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:18 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
define("PAGE_NAME", "Library management");

define("BIBLIO_ADMIN_1", "Admin preferences");
define("BIBLIO_ADMIN_2", "Who can control the plugin into it's internal system ? ");
define("BIBLIO_ADMIN_3", "Who can access the plugin (see it) ? ");
define("BIBLIO_ADMIN_4", "Settings saved");
define("BIBLIO_ADMIN_5", "Save settings");
define("BIBLIO_ADMIN_6", "Configuration");
define("BIBLIO_ADMIN_7", "Preferences");
define("BIBLIO_ADMIN_7b", "Advance settings");
define("BIBLIO_ADMIN_8", "Is there another class who can manage the loans ?");
define("BIBLIO_ADMIN_9", "Who can loan documents (is a member) ?");
define("BIBLIO_ADMIN_10", "The members can signal their loans themselves...");
define("BIBLIO_ADMIN_11", "The members can signal the return themselves...");
define("BIBLIO_ADMIN_12", "The members can see the list of all the loans...");
define("BIBLIO_ADMIN_13", "The members can add documents to the repertory...");
define("BIBLIO_ADMIN_14", "The members can edit the summary of the documents...");
define("BIBLIO_ADMIN_15", "Number of documents loanable");
define("BIBLIO_ADMIN_16", "Max lenght of loans (in days)");
define("BIBLIO_ADMIN_17", "Message to show when editing/adding documents");
define("BIBLIO_ADMIN_18", "Please fill the maximum of fields.<br />It is not probable that someone will complete them for you later...<br />Thanks ! ");

define("BIBLIO_PLUGIN_1", "Library");
define("BIBLIO_PLUGIN_2", "A complete library loaning management system, developped for a real library, you may also use it to share your collection of DVD or else.");
define("BIBLIO_PLUGIN_4", "Installed, please set the global access rights, then go to the advance management area (client-side) of your library management system.");

define("YES", "Yes");
define("NO", "No");
define("AUTHOR", "Author");
define("TITLE", "Title");
define("SUBTITLE", "Subtitle");
define("SUMMARY", "Summary");
define("STATUS", "Status");
define("EDIT_THIS", "Edit this document");
define("CATEGORY", "Category");
define("ACTIVE", "activated");
define("NOTACTIVE", "deactivated");


define("BIBLIO_OPTION_1", "Options");
define("BIBLIO_OPTION_2", "<strong>Loans</strong>");
define("BIBLIO_OPTION_3", "<strong>Returns</strong>");
define("BIBLIO_OPTION_4", "<strong>List of loans</strong>");
define("BIBLIO_OPTION_5", "<strong>Add a document</strong>");
define("BIBLIO_OPTION_6", "<strong>Advance settings</strong>");
define("BIBLIO_OPTION_7", "List of all the documents ");
define("BIBLIO_OPTION_WELCOME", "<strong>Welcome into the library management system of ".SITENAME.".</strong>");
define("BIBLIO_OPTION_MEMBER_10", ",  you have the rights to loan still <i>");
define("BIBLIO_OPTION_MEMBER_11", " documents</i>.");
define("BIBLIO_OPTION_NOTMEMBER_12", ", you don't have the necessary rights, you can consult the documents of the library, but you can't loan them.");
define("BIBLIO_OPTION_GUEST_13", "Welcome dear guest!<br />You're not <a href='".e_BASE."signup.php' title='How to...'>a user</a> (or not connected), but you can always consult the documents available in the library if you come to see visit us and if the doors are open.<br />Unfortunately, you won't be able to leave with the tresors you'll discover...");
define("BIBLIO_OPTION_ADMINGROUP_1", "Library comity");
define("BIBLIO_OPTION_ADMINGROUP_2", "Permanency group");
define("BIBLIO_OPTION_ADMINGROUP_3", "You are also a member of the group ");
define("BIBLIO_OPTION_ADMINGROUP_4", ", you have access to numerous options to improve and exploit this management system.");
define("BIBLIO_OPTION_8", "Search a document");
define("BIBLIO_OPTION_", "");
define("BIBLIO_OPTION_", "");
define("BIBLIO_OPTION_", "");
define("BIBLIO_OPTION_", "");


define("BIBLIO_LIST_TITLE", "List of the documents");
define("BIBLIO_OPTION_CAT_ALL", "All the documents");
define("BIBLIO_LIST_1", "Choose the category");
define("BIBLIO_LIST_2", " of the category : ");
define("BIBLIO_LIST_3", "of the category ");
define("BIBLIO_LIST_4", "Available for loan");
define("BIBLIO_LIST_5", "Available in consultation only");
define("BIBLIO_LIST_6", "Loaned by : ");
define("BIBLIO_LIST_7", "Settling date !");
define("BIBLIO_LIST_8", "Contact");
define("BIBLIO_LIST_9", "Loaner");
define("BIBLIO_LIST_", "");
define("BIBLIO_LIST_", "");

define("BIBLIO_EMPRUNT_TITLE", "Management of the loans");
define("BIBLIO_EMPRUNT_ERROR_1", "You didn't specify the loaner !!!");
define("BIBLIO_EMPRUNT_ERROR_2", "Attention, this user is exceeding the quantity of documents he can loan!\\nHe can still loan :");
define("BIBLIO_EMPRUNT_MESSAGE_3", "Loan(s) saved(s). Thank you.");
define("BIBLIO_EMPRUNT_1", " documents to return :");
define("BIBLIO_EMPRUNT_2", "Add one or many loans");
define("BIBLIO_EMPRUNT_3", "Loaned documents");
define("BIBLIO_EMPRUNT_4", "Enter every loaned documents");
define("BIBLIO_EMPRUNT_5", "Write a <u>part</u> of the <strong>title</strong> or of the <strong>subtitle</strong>,
 wait 1 or 2 seconds and a list of documents including those title will appear.
 Select the right document with the arrows or the mouse and stroke 'Enter'.<br />
To add another document, directly write after the capture of the first.");
define("BIBLIO_EMPRUNT_6", "Validate the loans");
define("BIBLIO_EMPRUNT_7", "The document cannot be found??");
define("BIBLIO_EMPRUNT_8", "Is he in the list of documents <strong>NOT</strong>-loanable?");
define("BIBLIO_EMPRUNT_9", "See the list");
define("BIBLIO_EMPRUNT_10", "No, the document is not in the list, <a href='".e_SELF."?ajout'>clic here to add it to the repertory.</a>");
define("BIBLIO_EMPRUNT_", "");

define("BIBLIO_RETOUR_TITLE", "Management of the returns");
define("BIBLIO_RETOUR_1", "This user don't have anymore loan, thanks.");
define("BIBLIO_RETOUR_2", "Returned ? ");
define("BIBLIO_RETOUR_3", "Loaned by ");
define("BIBLIO_RETOUR_4", "Validate the return of documents");
define("BIBLIO_RETOUR_5", "Who is the loaner?");
define("BIBLIO_RETOUR_6", "You don't know the loaner?");
define("BIBLIO_RETOUR_7", "Retourn one (many) document(s) without knowledge of the loaners");
define("BIBLIO_RETOUR_8", "Returned documents");
define("BIBLIO_RETOUR_9", "Validate the return");
define("BIBLIO_RETOUR_10", "Select all the returned documents");
define("BIBLIO_RETOUR_11", "Thank you, the documents have been saved as returned.");
define("BIBLIO_RETOUR_12", "Please return those documents the most rapidly possible...");
define("BIBLIO_RETOUR_", "");
define("BIBLIO_RETOUR_", "");
define("BIBLIO_RETOUR_", "");
define("BIBLIO_RETOUR_", "");

define("BIBLIO_LISTEMPRUNT_TITLE", "List of the loans and notices");
define("BIBLIO_LISTEMPRUNT_1", "List of the unreturned loans !");
define("BIBLIO_LISTEMPRUNT_", "");
define("BIBLIO_LISTEMPRUNT_", "");
define("BIBLIO_LISTEMPRUNT_", "");

define("BIBLIO_AJOUT_TITLE", "Adding documents");
define("BIBLIO_AJOUT_ERROR_1", "You can&#39;t use the character: _ or ; in the title or the subtitle.\\nPlease change it.\\n");
define("BIBLIO_AJOUT_ERROR_2", "This document is already listed in the database (Title), please add it as a specimen.\\n");
define("BIBLIO_AJOUT_ERROR_3", "This document is already present in the database or you wrote incorrectly the ISBN code (put only numbers),\\nPlease correct your errors.\\n");
define("BIBLIO_AJOUT_ERROR_4", "You&#39;ve leaved empty a required field\\n");
define("BIBLIO_AJOUT_ERROR_5", "You must specify the category !\\n");
define("BIBLIO_AJOUT_ERROR_TEXT", "An error as occured when creating the documents. Please contact the webmaster.");
define("BIBLIO_AJOUT_3", "Category :");
define("BIBLIO_AJOUT_4", "Authorised loan ?");
define("BIBLIO_AJOUT_5", "ISBN number :");
define("BIBLIO_AJOUT_6", "Title :");
define("BIBLIO_AJOUT_7", "Subtitle :");
define("BIBLIO_AJOUT_8", "Author(s) : ");
define("BIBLIO_AJOUT_1", "Add an author");
define("BIBLIO_AJOUT_2", "Clic to open");
define("BIBLIO_AJOUT_9", "Add a document to the database");
define("BIBLIO_AJOUT_10", "Add the document");
define("BIBLIO_AJOUT_", "");

define("BIBLIO_EDIT_TITLE", "Edition of the documents");
define("BIBLIO_EDIT_ERROR_1", "An error as occured while editing the document. Please contact the webmaster.");
define("BIBLIO_EDIT_2", "Edit the document");
define("BIBLIO_EDIT_3", "Edit document");
define("BIBLIO_EDIT_4", "Create a category ?");
define("BIBLIO_EDIT_5", "Write the name of the new category.");
define("BIBLIO_EDIT_6", " (put only numbers)");
define("BIBLIO_EDIT_7", "NAME");
define("BIBLIO_EDIT_8", "First name");
define("BIBLIO_EDIT_9", "Editor");
define("BIBLIO_EDIT_10", "Collection");
define("BIBLIO_EDIT_11", "Year of publication");
define("BIBLIO_EDIT_12", "Number of speciment");
define("BIBLIO_EDIT_", "");
define("BIBLIO_EDIT_", "");
define("BIBLIO_EDIT_", "");

define("BIBLIO_NOTICE_TITLE", "Manual of the library management system");
define("BIBLIO_NOTICE_1", "Notice");
define("BIBLIO_NOTICE_2", "Activated options");
define("BIBLIO_NOTICE_3", "Which group(s) can manage the loans ?");
define("BIBLIO_NOTICE_4", "Who can loan documents (is a member) ?");
define("BIBLIO_NOTICE_5", "Number of loanable books :");
define("BIBLIO_NOTICE_6", "documents");
define("BIBLIO_NOTICE_7", "Max lenght of loans :");
define("BIBLIO_NOTICE_8", "days");
define("BIBLIO_NOTICE_9", "The members can ...");
define("BIBLIO_NOTICE_10", "Declare the loans themselves ?");
define("BIBLIO_NOTICE_11", "Declare the returns themselves ?");
define("BIBLIO_NOTICE_12", "Consult the list of all the loans ?");
define("BIBLIO_NOTICE_13", "Add new documents to the database ?");

define("BIBLIO_AUTOCOMPLETE_1", "Click to submit");
define("BIBLIO_AUTOCOMPLETE_2", "<ul>\n<li>Error! You must modify your attribution variable.<br />
                   Possible choices are : 'ac_liste_multichoice' , 'ac_liste' , 'ac_member'<br />
                   If not, your gonna need to modify the file autocomplete/ac_retrieve.php to ensure your needs</li>\n</ul>");


define("BIBLIO_PERMISSION_1", "You do not have the required permissions to access this page.<br /><br />Please <a href='".e_BASE."contact.php'>contact the webmaster</a> if this is an error.<br /><br />Thank you.");
define("BIBLIO_PERMISSION_2", "Permissions denied");

define("BIBLIO_MENU_1", "Library");
define("BIBLIO_MENU_2", "Pssst...<br />
Don't forget your loans :<br />");


define("BIBLIO_EMAIL_TITLE", "Email exemple : Notice of loaned documents at the  ".SITENAME." library");
define("BIBLIO_EMAIL_ALT_LIST", "NOT YET WORKING, this is only a preview");
define("BIBLIO_EMAIL_ERROR", "There was a problem, the registration mail was not sent, please contact the website administrator.");
define("BIBLIO_EMAIL_", "");
define("BIBLIO_EMAIL_", "");
define("BIBLIO_EMAIL_", "");



?>
