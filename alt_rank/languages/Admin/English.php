<?php
define("ALT_ADMIM_00", "Alternate ranks");
define("ALT_ADMIM_01", "Options");
define("ALT_ADMIM_02", "Description");
define("ALT_ADMIM_03", "This plugin helps the administrators to give/take additional badges/ranks members.<br />
Images can be displayed in the forum below the avatar, in the user table next to the usersnames and in the user profiles to their usernames.<br />
For now it is only a pilot version and nothing to adjust here, but read the instructions below on how to use it.<br /><br /><br />
You do not need any installation - just upload the plugin and it will appear in the installed.<br /><br />
<b>Instruction:</b><br /><br />
1. After uploading the plugin go to <a href='".e_ADMIN."db.php'>Admin/Tools/Database</a> and scan module directories to register a Short Code.<br /><br />
2. Then navigate to <a href='".e_ADMIN."userclass2.php'>Admin/Users/User classes</a> delete all others and create 10 new user classes.<br /><br />
3. From the folder e107_themes/templates/ copy the file user_template.php in the folder of your theme. From the folder e107_plugins/forum/templates/ copy the file forum_viewtopic_template.php in the folder of your theme.<br />
<b>It is possible to have them in your theme folder, so check first!</b><br /><br />
<b>Pay attention to</b> the order of creation of user classes is important because for search them later.<br />
For example, if you want to create user class Author and it should show the image 1.gif with the image AVT, then this class must be created first, and so<br /><br />
<b>Pay attention to</b>, that the names of the pictures are set in the file altrank.sc! If you use other images, should give their same names and put them in the folder e107_plugins/alt_rank/ranks.
<br /><br /><br /><br /><br />
Use freely!<br /><br /><br />
Look forward for improvements of the plugin with the addition of the ability to create and edit additional user classes from here and upload your pictures.
");