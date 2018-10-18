<?

//-----------------------------------------------------------------------------------------------------------+

define("LAN_IPN_PAL_PLUGIN_CAPTION",          "PayPal IPN Donation Menu");
define("LAN_IPN_PAL_CONFIGURATION",           "Configuration");
define("LAN_IPN_PAL_SETTINGS_SAVED",          "Settings Saved");
define("LAN_IPN_PAL_SAVE_SETTINGS",           "Save Settings");

define("LAN_IPN_PAL_PROTECTION_REASON",       "To prevent spam reaching the PayPal address,");
define("LAN_IPN_PAL_PROTECTION_ANSWER",       "Please answer");
define("LAN_IPN_PAL_PROTECTION_SUBMIT",       "Submit");
define("LAN_IPN_PAL_PROTECTION_PASSED",       "Please click below to make the donation.");

define("LAN_IPN_PAL_YES",                     "Yes");
define("LAN_IPN_PAL_NO",                      "No");
define("LAN_IPN_PAL_DEBUG",                   "Debug - SandBox");
define("LAN_IPN_PAL_MAIN",                    "Main");
define("LAN_IPN_PAL_OPTIONAL",                "Optional");
define("LAN_IPN_PAL_EXTRA",                   "Extra");

define("LAN_IPN_PAL_TOTAL",					  "Show Total:");
define("LAN_IPN_PAL_TOTAL_INFO",			  "Show the sum of all donations recevied so far in the menu.");
define("LAN_IPN_PAL_TOTAL_TEXT",			  "Show Total Text:");
define("LAN_IPN_PAL_TOTAL_TEXT_INFO",		  "Text to show before the Total Donations recevied so far in the menu.");
define("LAN_IPN_PAL_TOTAL_TEXT_DEFAULT",	  "Total Donations:");

//-----------------------------------------------------------------------------------------------------------+

define("LAN_IPN_PAL_SAND",             		  "Sandbox Mode:");
define("LAN_IPN_PAL_SAND_INFO",        		  "Use Plugin in PayPal development mode.");
define("LAN_IPN_PAL_SANDBOX_WARN",			  "SANDBOX ON - DO NOT USE");

define("LAN_IPN_PAL_SAND_BUS",                "Sandbox PayPal Email or PayPal Business ID:");
define("LAN_IPN_PAL_SAND_BUS_INFO",           "This must be a Sandbox PayPal account. (Not needed for production use).");

define("LAN_IPN_PAL_MENUCAPTION",             "Menu Caption:");
define("LAN_IPN_PAL_MENUCAPTION_INFO",        "Text shown at top of the menu.");
define("LAN_IPN_PAL_MENUCAPTION_DEFAULT",     "Donate with PayPal");

define("LAN_IPN_PAL_MENUTEXT",                "Menu Text:");
define("LAN_IPN_PAL_MENUTEXT_INFO",           "Text above button image, should be formatted using XHTML such as &lt;br /&gt; for new lines.");

define("LAN_IPN_PAL_BUTTON",                  "Button Image:");
define("LAN_IPN_PAL_BUTTON_INFO",             "Upload your own into '/ipn_donate_menu/images/'");
define("LAN_IPN_PAL_BUTTON_CHOOSE",           "Choose");

define("LAN_IPN_PAL_BUTTON_POPUP",            "Button Popup:");
define("LAN_IPN_PAL_BUTTON_POPUP_INFO",       "Appears when the mouse pointer hovers over the button.");
define("LAN_IPN_PAL_BUTTON_POPUP_DEFAULT",    "Make a Donation with PayPal");

define("LAN_IPN_PAL_BUSINESS",                "Live PayPal Email or PayPal Business ID:");
define("LAN_IPN_PAL_BUSINESS_INFO",           "This must be a valid Live PayPal account.");

define("LAN_IPN_PAL_ITEMNAME",                "Donation Description:");
define("LAN_IPN_PAL_ITEMNAME_INFO",           "If left blank, the donor will see a field which they can fill in themselves.");

define("LAN_IPN_PAL_CURRENCY",                "Currency:");
define("LAN_IPN_PAL_CURRENCY_INFO",           "Sets the currency that the amount is to be paid in.");

define("LAN_IPN_PAL_PROTECTION",              "Spam Protection:");
define("LAN_IPN_PAL_PROTECTION_INFO",         "Prevents spambots from harvesting the PayPal email address.");

//-----------------------------------------------------------------------------------------------------------+

define("LAN_IPN_PAL_ADDRESS",                 "Request a Postal Address:");
define("LAN_IPN_PAL_ADDRESS_INFO",            "Asks the donor to provide a postal address.");

define("LAN_IPN_PAL_NOTE",                    "Request a Note:");
define("LAN_IPN_PAL_NOTE_INFO",               "Asks the donor to provide a short note with the payment.");

define("LAN_IPN_PAL_NOTECAPTION",             "Custom Note Caption:");
define("LAN_IPN_PAL_NOTECAPTION_INFO",        "Text that is shown above the note.");

define("LAN_IPN_PAL_SUCCESS_URL",             "Successful Payment URL");
define("LAN_IPN_PAL_SUCCESS_INFO",            "Link donors will be redirected here after completing their payment. Example: www.yoursite.com/thankyou.php");

define("LAN_IPN_PAL_IPN_URL",             	  "IPN Return URL");
define("LAN_IPN_PAL_IPN_INFO",           	  "PayPal IPN Notification will be sent here. Example: www.yoursite.com/ipn.php");
define("LAN_IPN_PAL_IPN_NOTIF",				  "Send IPN Debug Emails");
define("LAN_IPN_PAL_IPN_NOTIF_INFO",		  "Email address to send IPN Debug emails. (Leave Empty to disable)");

define("LAN_IPN_PAL_CANCELURL",               "Cancel Payment URL");
define("LAN_IPN_PAL_CANCELURL_INFO",          "Link donors will be redirected here if they click Cancel. Example: www.yoursite.com/cancel.php");

define("LAN_IPN_PAL_PAGESTYLE",               "Page Style Name:");
define("LAN_IPN_PAL_PAGESTYLE_INFO",          "Log into PayPal to create styles. (My Account >> Profile >> Custom Payment Pages).");

//-----------------------------------------------------------------------------------------------------------+

define("LAN_IPN_PAL_LOCALE",                  "Locale:");
define("LAN_IPN_PAL_LOCALE_INFO",             "Defaults to US English, use a two digit 'ISO 3166-1 Code' to change.");

define("LAN_IPN_PAL_ITEMNUMBER",              "Item Number:");
define("LAN_IPN_PAL_ITEMNUMBER_INFO",         "If set is shown below the item name.");

define("LAN_IPN_PAL_CUSTOM",                  "Send USER_ID:");
define("LAN_IPN_PAL_CUSTOM_INFO",             "Not shown to donor, passed back for tracking payments. (Only if User logged in)");
define("LAN_IPN_PAL_LOGIN_WARN",			  "Show Notice to Users:");
define("LAN_IPN_PAL_LOGIN_WARN_INFO",		  "Displays a message to users who are not signed-in.");
define("LAN_IPN_PAL_LOGIN_MSG_INFO",		  "Text to Display to users who are not signed-in.");
define("LAN_IPN_PAL_LOGIN_WARN_DEFAULT",	  "<strong>You are not signed-in<strong><br>Donations will not be logged to your account.");

define("LAN_IPN_PAL_INVOICE",                 "Invoice:");
define("LAN_IPN_PAL_INVOICE_INFO",            "Not shown to donor, passed back for tracking payments.");

define("LAN_IPN_PAL_AMMOUNT",                 "Amount:");
define("LAN_IPN_PAL_AMMOUNT_INFO",            "Sets default payment value, blank allows donor to set the amount.");

define("LAN_IPN_PAL_TAX",                     "Tax:");
define("LAN_IPN_PAL_TAX_INFO",                "Override any tax settings that are part of a donors profile.");

//-----------------------------------------------------------------------------------------------------------+

?>
