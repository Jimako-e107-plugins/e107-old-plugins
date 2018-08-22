# Alternate ranks v0.1

This plugin helps the administrators to give/take additional badges/ranks to members.

Images can be displayed in the forum below the avatar, in the user table next to the usersnames and in the user profiles to their usernames.

For now it is only a pilot version and nothing to adjust in the plugin, but read the instructions below on how to use it.

You do not need any installation - just upload the plugin and it will appear in the installed.

Instruction:
1. After uploading the plugin go to Admin/Tools/Database and scan module directories to register a Short Code.

2. Then navigate to Admin/Users/User classes delete all others and create 10 new user classes.

3. From the folder e107_themes/templates/ copy the file user_template.php in the folder of your theme. From the folder e107_plugins/forum/templates/ copy the file forum_viewtopic_template.php in the folder of your theme.
It is possible to have them in your theme folder, so check first!

Pay attention to the order of creation of user classes is important because for search them later.
For example, if you want to create user class Author and it should show the image 1.gif with the image AVT, then this class must be created first, and so.

Pay attention to that the names of the pictures are set in the file altrank.sc! If you use other images, should give their same names and put them in the folder e107_plugins/alt_rank/ranks.


Enjoy!


Look forward for improvements of the plugin with the addition of the ability to create and edit additional user classes from here and upload your pictures.

Thanks to @veskoto for litle help.

All questions and comments please post here.