<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: support@naja7host.com
|        $Author: Mohamed Anouar Achoukhy $
+----------------------------------------------------------------------------------------------------+
*/
// lan  plugin 
define("IM_LAN_1", "nCode لتصغير الصور");
define("IM_LAN_2", "تصغير الصور تلقائيا في المشاركات و الأخبار");
define("IM_LAN_3", "تم  التثبيت بنجاح .");
define("IM_LAN_4", "تمت الترقية بنجاحl .");

// lan admin_menu 
define("IM_LAN_5", "إعدادات مصغر الصور");
define("IM_LAN_6", "الإعدادات");
define("IM_LAN_7", "مساعدة");

// lan admin_config 
define("IM_LAN_8", "العرض الأقصي");
define("IM_LAN_9", "صورة بعرض أكبر من هذا القياس سيتم تصغيرها . أدخل 0 للسماح بكل القياسات, أو اتركه فارغا لاستخدام الافتراضي.");
define("IM_LAN_10", "الطول الأقصى");
define("IM_LAN_11", "سيتم تصغير الصور التي تملك  طول أكبر من هذا القياس . أدخل 0 للسماح بكل الارتفاعات, أو اتركه فارغا لاستخدام القياس الافتراضي.");
define("IM_LAN_12", "حفظ الصورة كما هي");
define("IM_LAN_13", "تكبير في نفس الصفحة");
define("IM_LAN_14", "فتح في نفس الصفحة");
define("IM_LAN_14A", "فتح في صفحة جديدة");
define("IM_LAN_15", "فتح باستخدام tinybox");
define("IM_LAN_15B", "فتح باستخدام tinybox v2");
define("IM_LAN_15A", "فتح باستخدام fancebox");
define("IM_LAN_16", "طريقة التصغير");
define("IM_LAN_17", "حفظ الإعدادات");
define("IM_LAN_18", "الإعدادات العامة");
define("IM_LAN_19", "تفعيل مصغر الصور");
define("IM_LAN_20", "تم  حفظ  التغييرات بنجاح");
define("IM_LAN_21", "مساعدة ");
define("IM_LAN_22", "استعلام خاطيء");
define("IM_LAN_23", '
NCODE IMAGE RESIZER FOR E107 v0.75+
-------------------------------------
version: 1.0.1

I. What does it do
------------------
This plugin enables you to automatically resize every user-posted image which
is larger than given dimensions. Users can choose the maximum dimensions and the
resize method to use.
The resize methods are:
- No resizing
- Enlargement in the same document
- Enlargement in the same window (replacing the page content document)
- Enlargement in a new window
- Enlargement with Modal Box

It also adds an information bar (which is not displayed when the image is too
small) .

II. What does it not do
-----------------------
- It does not do server side resizing of images. Everything is done clientside
- It does not prevent long loading times. The images have to be downloaded completely
  by the client before the script can resize them.


III. Installation / Upgrade
----------------
1. Upload "resizer" folder to the ' . e_PLUGIN .' directory in your e107 installation.
2. go to plugins mager and install the plugin .
3. Set the setting as you want from  setting tab of this  .

The installation adds a couple of settings .


IV. Configuration
------------------
Administrators can change the maximum dimensions and resize mode in the options window.
These values will be the default for users without a setting of their own and
anonymous users.

V. Version history
------------------
1.0.1 (May 6th, 2007)
- first Release 


VI. Incompatibilities
---------------------
Incompatibilities have been reported with:
"Transparency PNG pictures with Internet Explorer 6 (server-side solution)"
(http://www.vbulletin.org/forum/showthread.php?t=93415)

VI. Copyright
-------------
please keep in mind that:
THIS IS PORTED PLUGIN from (nCode - www.ncode.nl - info@ncode.nl ) to e107 . 


VII. Dotations
--------------
Do you like this plugin ? Donations are highly appreciated. You can donate by PayPal or 
MoneyBookers to admin@naja7host.com. Feel free to add your comments, suggestions or 
recommendations to this donation.


');
/* reserved for next release

define("IM_LAN_24", "");
define("IM_LAN_25", "");
define("IM_LAN_26", "");
*/


?>