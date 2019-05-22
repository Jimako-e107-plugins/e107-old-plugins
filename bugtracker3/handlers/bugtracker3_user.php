<?
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_user.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2006/11/12 20:02:55 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 user
 * Holds information relating to the current user and what they are allowed to do in Bugtracker3
 */
class bugtracker3User {
   var $privs;    // an array of application privilieges, index on app ID
   var $admin;    // admin status combined with admin preferences
   var $prefs;    // current users prefs

   /**
    * Constructor
    * @param $apps  a Bugtracker3 application object or an array of Bugtracker3 application objects
    * @param $prefs a record from the User Prefs table for the current user
    */
   function bugtracker3User($apps, $prefs) {
      global $pref;
      if (!is_array($apps)) {
         $applist[$apps->getId()] = $apps;
      } else {
         $applist = $apps;
      }

      $this->admin = (ADMIN && $pref['bugtracker3_adminedit'] == 1) ? true : false;

      foreach ($applist as $app) {
         $this->privs[$app->getId()]["post"] = $this->canPostApp($app);
         $this->privs[$app->getId()]["edit"] = $this->canEditApp($app);
         $this->privs[$app->getId()]["view"] = $this->canViewApp($app);
      }

      $this->prefs = $prefs;
   }

   // Privilege checks
   function canViewApp($app) {
      return $this->privs[$app->getId()]["view"] = $this->admin || check_class($app->getViewClass()) || $app->isVisible();
   }
   function canEditApp($app) {
      return $this->privs[$app->getId()]["edit"] = $this->admin || check_class($app->getEditClass()) || USERID == $app->getOwnerId();
   }
   function canPostApp($app) {
      return $this->privs[$app->getId()]["post"] = $this->admin || check_class($app->getPostClass()) || USERID == $app->getOwnerId();
   }
   function canView($appid) {
      return (isset($this->privs[$appid]["view"]) && $this->privs[$appid]["view"]===true);
   }
   function canEdit($appid) {
      return (isset($this->privs[$appid]["edit"]) && $this->privs[$appid]["edit"]===true);
   }
   function canPost($appid) {
      return (isset($this->privs[$appid]["post"]) && $this->privs[$appid]["post"]===true);
   }
   function canViewBug($bug) {
      return $this->canView($bug->getApplicationId());
   }

   // Getters
   function getFilter() {
      return (isset($this->prefs["bugtracker3_user_prefs_filter"])) ? $this->prefs["bugtracker3_user_prefs_filter"] : false;
   }
}
?>