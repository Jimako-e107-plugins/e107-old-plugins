Autocomplete for PM
Version: 1.0
Date: January 19, 2005
Author:  Michael Rowe
Email:   mikerowe81@gmail.com

INSTALLATION: 
1. put autocomplete folder in PM folder. 
2. Copy the following line to pm.php right after the comments around line 19:

<---- BEGIN CUT HERE ---->   
include("autocomplete/autocomplete.php");
<----  END CUT HERE  ---->

NOTES: 
Edit autocomplete.css to customize the dropdown box.

If you use autocomplete, please let me know or post a comment on e107coders.org
Comments and/or suggestions would be appreciated

ABOUT THE AUTHOR:
I am a 24 year old IT Manager for Appalachian Bible College, in Bradley, WV (www.abc.edu).
I've never had any formal IT training, but just had a nack for picking things up. 
My Commodore 64 is really what got me started, back in the good ol' days.
I actually raise my own support to work at the Bible College, so if you feel led
to send me a donation, it would be greatly appreciated (michael.rowe@abc.edu). 
We actually use the e107 system for our campus portal, and it has worked great. 
Thanks to everyone who made it happen.

TECHNICAL STUFF: (for those who like to know how it works)
Built using the javascript library from http://script.aculo.us/
Most of the files in this folder come from them, so they did the hard work.

autocomplete.php - this file is what gets everything going. It sets the eplug_js
so that initialize.js gets included in the page header. Also, when a PM is submitted
to multiple users, the semicolons that seperate the names are converted to line
breaks since that is how mcfly parses multiple names, and I didn't want to change
any of the original code, so it's easy to keep autocomplete when an update comes out.

initialize.js - this file writes lines on the page so that the script.aculo.us library
gets called. It also adds an 'on_load' listener to the page so that the js functions that
add the autocomplete box and "Autocomplete Enabled" title run after the page has loaded.

ac_retrieve.php - this is the file that gets called when a user starts to type some
letters. The script.aculo.us library sends a POST to this file, which in turn runs the
query based on the POST and returns an unumbered list. This file could be updated
with features such as limiting the number of rows that are returned. Data included
in the <span class='informal'> tag gets displayed in the list, but does not get written
to the field when selected. So, you could potentially add any information that you
would want in the list. You could also tweak the query so that a search is made on
any other field.