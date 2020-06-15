<?php

// To Do : See e107HelperForm_class.php

/**
 * e107 DB Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: E:/cvs/cvsrepo/e107helpers/e107HelperDB_class.php,v $</li>
 * <li>$Date: 2006/01/12 05:58:21 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.2 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperLogger
 */

/**
 * A private Helper class for the e107 CMS system.
 * This is the class that provides extra database functionality. It extends the e107 db class.
 *
 * @package e107Helper
 * @subpackage e107HelperDB
 */
class e107HelperDB extends db {
   /**
    * Insert a row into the table allowing for incomplete set of columns<br />
    * <br />
    * Example:<br />
    * <code>$agn_sql1->db_Insert("links", "0, 'News', 'news.php', '', '', 1, 0, 0, 0");</code>
    * @param string  database table name
    * @param string  sql query
    * @param boolean true to turn on debug
    * @param string  set to anything but empty string to log messages to database table dblog
    * @param string  additional text to be logged if logging to database table dblog
    * @return boolean
    */
   function db_InsertPart($table, $arg, $debug = FALSE, $log_type="", $log_remark="") {
      global $e107Helper;
      $mes = e107::getMessage();
      $mes->addError('You are using not supported code db_InsertPart() !  Replace it by using insert() method');
      echo $mes->render();
 
   }
}

?>