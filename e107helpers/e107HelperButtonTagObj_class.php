<?php

// To Do : See e107HelperForm_class.php

/**
 * e107 Button Tag Object Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: e:\_repository\e107_plugins/e107helpers/e107HelperButtonTagObj_class.php,v $</li>
 * <li>$Date: 2006/05/08 20:07:16 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.1 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperForm
 */

/**
 * A private Helper class for the e107 CMS system.
 * Used by the e107HelperForm class.
 * A button tag is one which is submitted to the mid tier and is used to determine the action to take.
 * Button tags do not generally have actual values, their name is used to determine processing.
 * Each button tag object holds enough information to render the tag on the screen.
 * The Button Tag extends the Tag class.
 * Note: this class is normally instansiated by the e107HelperForm class.
 *
 * @package e107HelperForm
 */
class e107HelperButtonTagObj extends e107HelperTagObj {
   function e107HelperStaticTagObj($name, $tagType) {
      e107HelperTagObj::e107HelperTagObj($name, $tagType);
   }
}
?>