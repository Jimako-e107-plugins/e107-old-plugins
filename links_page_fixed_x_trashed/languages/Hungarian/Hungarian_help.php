<?php
/*
+---------------------------------------------------------------+
|        e107 website content management system Hungarian Language File
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|        Last Modified: 2016/08/19 14:01:20
|
|        $Author: Yesszus $
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN.'links_page/link_defines.php');
define("LAN_ADMIN_HELP_0", "Linkoldal - Súgó");

define("LAN_ADMIN_HELP_1", "<i>A kategóriák karbantartásához jelenleg minden kategória megjelenik az oldalon.</i><br /><br /><b>Részletes lista</b><br />Láthatsz egy kategória listát ikonnal, leírással, beállítási lehetőségekkel és sorrendi beállítással.<br /><br /><b>Ikonok értelmezése</b><br />
 
".ADMIN_LINK_ICON_EDIT." : kategória szerkesztése<br /><br />
".ADMIN_LINK_ICON_DELETE." : kategória törlése<br /><br />

<b>Sorrend</b><br />Itt manuálisan megváltoztathatod az összes kategória sorrendjét.<br />Meg kell változtatnod a kiválasztódobozban lévő értéket az általad kívántra, majd meg kell nyomnod az új sorrend gombot az elmentéshez.<br /><br />");

define("LAN_ADMIN_HELP_2", "<i>A link kategóriák létrehozása oldalon hozzáadhatod az új link kategóriákat</i><br /><br />Feltölthetsz új ikont, a feltöltés után hozzárendelheted az adott kategóriához.");
define("LAN_ADMIN_HELP_3", "<i>A linkek karbantartása oldalon először megjelenik az összes kategória.</i><br /><br />".LINK_ICON_LINK." : link a kategóriához<br /><br />".LINK_ICON_EDIT." : katt az ikonra a kategóriában lévő összes link megjelenítéséhez<br />");
define("LAN_ADMIN_HELP_4", "<i>A link létrehozása oldalon hozzáadhatsz új linket</i><br /><br />Feltölthetsz egy új ikont, majd hozzárendelheted a linkhez.<br /><br />A megnyitás módszere lehetőséget biztosít, hogy meghatározd, hogyan nyíljon meg a link, ha a felhasználó rákattint.");
define("LAN_ADMIN_HELP_5", "<i>A beküldött linkek oldalon megjelenik az összes, felhasználók által beküldött link</i><br /><br /><b>Részletes lista</b><br />Láthatod a link url-jét, a felhasználó nevét, aki beküldte a linket és a beállítási lehetőségeket.<br /><br /><b>Ikonok jelentése</b><br />
".ADMIN_LINK_ICON_EDIT." : Beküldött link áthelyezése a létrehozási formulába<br /><br />
".ADMIN_LINK_ICON_DELETE." : Beküldött link törlése<br />
");
define("LAN_ADMIN_HELP_6", "<i>A beállítások oldalon megváltoztathatod a linkek oldal plugin viselkedését</i><br /><br />
Általános beállítások<br />
Ezeket a beállításokat használja a teljes linkek oldal.<br /><br />
Személyes link kezelő<br />
A személyes link kezelő jogosultságokat ad a felhasználóknak, hogy karbantartsák saját saját beküldött linkjüket.<br /><br />
Kategória oldal<br />
Itt megváltoztathatod a kategória oldal beállításait.<br /><br />
Linkek megjelenítése oldal<br />
Ezeket a beállításokat alkalmazza a linkek oldal.<br /><br />
Hivatkozás oldal<br />
Ezeket a beállításokat alkalmazza a Top hivatkozás link oldal.<br /><br />
Értékelés oldal<br />
Ezeket a beállításokat alkalmazza a Top értékelés link oldal.<br />
");

define("LAN_ADMIN_HELP_7", "<i>A link kategória módosítása oldalon módosíthatod a létező link kategóriákat</i><br /><br />Feltölthetsz új ikont, majd hozzárendelheted a kategóriához.<br />Felülírhatod a dátumot a jelölődoboz bejelölésével.");

define("LAN_ADMIN_HELP_8", "<i>Ezen az oldalon megjelenik az adott kategóriában lévő összes link.</i><br /><br /><b>Részletes lista</b><br />Láthatod a linkek listáját, képeiket, nevüket, beállításukat és sorrendi elhelyezkedésüket.<br /><br /><b>Ikonok jelentése</b><br />
".ADMIN_LINK_ICON_EDIT." : link szerkesztése<br /><br />
".ADMIN_LINK_ICON_DELETE." : link törlése<br /><br />
<b>Sorrend</b><br />Itt manuálisan kiválaszthatod a linkek sorrendjét.<br />Változtasd meg a kiválasztódobozban lévő értéket az általad kívánt értékre és nyomd meg az új sorrend gombot a sorrend elmentéséhez.<br />");

define("LAN_ADMIN_HELP_9", "<i>A módosítás oldalon szerkesztheted a meglévő linkeket</i><br /><br />Feltölthetsz új ikont, majd hozzárendelheted a linkhez.<br /><br />A megnyitás módszerénél beállíthatod, hogy nyíljon meg a link, ha a felhasználó rákattint.");
define("LAN_ADMIN_HELP_10", "<i>A beküldött linkek oldalon hozzáadhatod a beküldött linket a meglévőkhöz</i><br /><br />Egy kis beküldött szöveg van a leírás mezőhöz.<br /><br />Feltölthetsz egy új ikont, majd hozzáadhatod a linkhez.<br /><br />A megnyitás mószerénél beállíthatod, hogyan nyíljon meg a link, ha a felhasználó rákattint.");
?>