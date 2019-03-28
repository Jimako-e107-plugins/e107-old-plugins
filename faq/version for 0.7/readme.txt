*****************************************************************
*
*	Plugin	:	FAQ  Plugin	
*
*	Author	:	Father Barry
*
*	Version	:	4.3
*
*	Date		:	13 November 2007
*
*	Status	:	Release
*				No responsibility can be accepted for the
*				failure of this plugin in any way shape or form
*				You use entirely at your own risk.
*				Based on original FAQ by Cameron
*
*	Copyright	:	Barry Keal 2005-2007
*
*	License	:	GPL
*
*	Website	:	www.keal.me.uk
*	
******************************************************************

Installation Instructions:
++++++++++++++++++++++++++
 - install using the Plugin Manager in Admin. For e107 v7xx Only

Upgrading - When upgrading check that the database is actually updated correctly using the database validity checker.  Use the Integrity Checker plugin to ensure the files are correct and the database scan directories to ensure the bbcode is recognized.

Version 4.3
Fixed bug with version .7.10
Added RSS

Version 4.1 and 4.2
Added simple mode so that you only need to create one category and sub category (to maintain compatibility) and the front page goes straight into the FAQs. Changed te version number (because 34 was a bit big)

Version 3.34 and 3.33
Multiple image upload (Maybe enhance this in next release or maybe not)
Fixed bug in admin new FAQ
Category icons
Fixed a couple of other bugs
Converted to template format
Checked with e107 77
Bbcode for inserting graphics
Make sure the graphics directory is read write (chmod 755)
Added optional rating
Added top ten menu
Added statistics page
Added optional logging to admin log
Added print to pdf (if pdf plugin installed)

Version 3.32
Improved security
Latest, status and notify for admin
Recent and New menu/page support
Top xx faqs can be shown in menu
Turn off Random FAQ
For BKONE - some compatibility with the old FAQ plugin by Cameron
This is an upgrade from 3.31.
Database validity check file
Integrity check file
FAQ views now shown. 


Version 3.31 (by Barry)
Added new print routine
Modded for version .7 search
Added send link to a friend
Made it work with .7
Made it more like my other plugins for consistent look and feel on the intranet
Printable page
email link
Added security for viewing according to user class

******** Note - as there is a new field called approve, you will need to 
******** approve all existing FAQs before they are visible.


Version 3.12 (by Cameron)
+++++++++++
	+ Rendertime displayed correctly in footer.
	+ Htmlarea updated to work with 0.617
	+ Minor alignment fixes of the layout.


Version 3.11 (by Cameron)
+++++++++++
	+ Comments can now be disabled correctly.

Version 3.1 (by Cameron)
+++++++++++
	+ XHTML 1.1 Compliant
	+ Delete Entry bug fixed. 
	+ Faq ordering fixed. 	
	+ Added Admin and guest options to class restriction.  
	+ Nested Comments - Thanks to Chavo. 
	+ FAQ sql added for database verification (via admin/database)

	Thankyou to bkwon for his help with testing this release. 


Version 3.0 (by Cameron)
+++++++++++
	+ Complete re-write.
	+ All New interface.
	+ Better handling of parents than previous versions.	
	+ Faq ordering added. 
	+ User-Submitting of Questions added.

 

Version 2.2 ( by Cameron )
+++++++++++

	+ Updated search function to match recent changes to the e107 core. .



Version 2.1 ( by Master-Devil )
+++++++++++

	+ Added image for the admin area.
	+ Corrected problem that gave incorrect link in the main menu
	+ Changed all FAQs references to FAQ
	+ Fixed some minor spelling issues



Version 2.0 ( by Cameron)
+++++++++++

 	+ Adapted for e107 v0.6+ ( not compatible with earlier versions )
	+ 0.6 autodetects the search function.. so no need to edit anything.
	+ User-Comments modified slightly. 
	+ improved view for comments.
	+ restored the missing Delete buttons.  
 

New in verion 1.3
+++++++++++++++++

	+ Multi-Language included
	+ Separated Search en FAQ from the language file E107 (gave them their own)
	+ Multi Language on search included
	+ The search as outlined below is included within the package.
	+ Can now use the HTML editor ( IE only)  

 
New in Version 1.2
+++++++++++++++++++

	+ User-Comments - Choose from All, Members,Admins, or a particular user-class.
	+ You can now use BBcode shortcut tags. 
	+ Search Feature added. (thanks for ReneJM for some of the code)
        + FAQ "Answer" is displayed on a separate page to avoid long pages. 
        + Other minor visual enhancements. 
	
	To-Do-List
	==========
	+ Multi-Language (thanks scaramousch - your files included)
	+ edit button on the faq "answer" page for admins only.

 
Just for Info

I use PDFCreator from  http://sourceforge.net/projects/pdfcreator/ as the PDF creator, a great free and comprehensive utility.

For editing I use PHP Edit from http://www.waterproof.fr/ 


