# e107 Glossary plugin for version 2


## e107 Glossary plugin v0.01 by  Shirka

original version: ©Andre DUCLOS 2006 2006/08/30


## Read this if you update from old e107 version:

There is no support for legacy template system in this plugin. If your legacy theme didn't customize layout, it should work out of box. 

If you use custom template in your theme, please, customize it according new standard. 
There is old backup file of template in template folder, so just compare it with file glossarytable_template.php
It's easier than to maintance two different template systems. So try.

There are for now two different template files. One for table layout and one for bootstrap3. 

**glossarytable_template.php** - old table layout if bootstrap3 is not defined. 

If you use bootstrap theme but you want old table layout for your site, just copy this template 
under name glossarybootrap3_template.php under your theme/templates/glossary/ folder. 

**glossarybootstrap3_template.php** - is used if your theme has defined BOOTSTRAP with value 3.

This way it will be easier add support for bootstrap4 in future. 
 
