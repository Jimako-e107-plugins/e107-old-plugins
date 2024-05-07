Coppermine v1.35c [0.7] with watermark 
Thanks to McFly and the other guys behind coppermine

Hello!
I have changed the files in Coppermine v1.35c so it 
watermarks your uploaded photos. 
I am not the author of this hack, I found it in a forum 
and changed the files after the information. 

How to install?

1.Just unzip the files and upload it to your
/e107_plugins/ directory.


2.Open the mysql tables.txt and import it to your 
mysql database using for a example PhpMyAdmin

And then it should works

Some more information 

insert into e107_CPG_config (name, value) values ('watermark_file', '/your/full/path/to/logo.png');
The watermark_file you can change in your coppermine settings

insert into e107_CPG_config (name, value) values ('where_put_watermark', 'bottomright')
Where to put the image you can change in your coppermine settings.


I hope it  work.
It works at my page:
Example image:
http://www.stinget.se/e107_plugins/coppermine_menu/albums/userpics/10001/normal_P1010017.JPG

Best regards
kleppen83
http://www.stinget.se
http://www.topcats.nu
http://www.e107coders.org



 
