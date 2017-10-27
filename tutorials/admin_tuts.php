<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(e_ADMIN."auth.php");
if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}
// Include plugin language file, check first for site's preferred language
@include_once(e_PLUGIN."tutorials/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."tutorials/languages/English.php");

if($_POST['submitprefs']){
	$pref['tuts_ordercby'] = $_POST['order_cfield'];
	$pref['tuts_ordercdir'] = $_POST['order_cdirection'];
	$pref['tuts_ordertby'] = $_POST['order_tfield'];
	$pref['tuts_ordertdir'] = $_POST['order_tdirection'];
	$pref['tuts_showmenu'] = $_POST['showmenu'];
	$pref['tuts_menulist'] = $_POST['menulist'];
	$pref['tuts_menunum'] = $_POST['menu_num'];
	$pref['tuts_allowusersub'] = $_POST['allowusersub'];
	$pref['tuts_allownotify'] = $_POST['allownotify'];
	$pref['tuts_killaftertimeout'] = $_POST['killafter'];
	save_prefs();
	$message = TUT_MSSG_CHANGE;
}

if($message){
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}

$text .= '<form name="form1" method="post" action="'.e_SELF.'">
  <table class="fborder" width="100%">
    <tr>
      <td class="fcaption">'.TUT_CONF_L1.'</td>
      <td class="forumheader3"><select name="order_cfield" id="order_cfield">
        <option ';if($pref['tuts_ordercby'] == 'id'){ $text .= 'selected ';} $text .= 'value="id">'.TUT_CONF_L2.'</option>
        <option ';if($pref['tuts_ordercby'] == 'name'){ $text .= 'selected ';} $text .= 'value="name">'.TUT_CONF_L3.'</option>
        <option ';if($pref['tuts_ordercby'] == 'poster_id'){ $text .= 'selected ';} $text .= 'value="poster_id">'.TUT_CONF_L4.'</option>
        <option ';if($pref['tuts_ordercby'] == 'indexed'){ $text .= 'selected ';} $text .= 'value="indexed">'.TUT_CONF_L5.'</option>
      </select>
      </td>
    </tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L6.'</td>
		<td class="forumheader3"><select name="order_cdirection" id="order_cdirection">
		  <option ';if($pref['tuts_ordercdir'] == 'Desc'){ $text .= 'selected ';} $text .= 'value="Desc">'.TUT_CONF_L7.'</option>
		  <option ';if($pref['tuts_ordercdir'] == 'Asc'){ $text .= 'selected ';} $text .= 'value="Asc">'.TUT_CONF_L8.'</option>
		  </select>
		</td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L9.'</td>
		<td class="forumheader3"><select name="order_tfield" id="order_tfield">
		  <option ';if($pref['tuts_ordertby'] == 'id'){ $text .= 'selected ';} $text .= 'value="id">'.TUT_CONF_L2.'</option>
		  <option ';if($pref['tuts_ordertby'] == 'name'){ $text .= 'selected ';} $text .= 'value="name">'.TUT_CONF_L3.'</option>
		  <option ';if($pref['tuts_ordertby'] == 'views'){ $text .= 'selected ';} $text .= 'value="views">'.TUT_CONF_L10.'</option>
		  <option ';if($pref['tuts_ordertby'] == 'accept_date'){ $text .= 'selected ';} $text .= 'value="accept_date">'.TUT_CONF_L11.'</option>
		  </select>
		</td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L12.'</td>
		<td class="forumheader3"><select name="order_tdirection" id="order_tdirection">
		  <option ';if($pref['tuts_ordertdir'] == 'Desc'){ $text .= 'selected ';} $text .= 'value="Desc">'.TUT_CONF_L7.'</option>
		  <option ';if($pref['tuts_ordertdir'] == 'Asc'){ $text .= 'selected ';} $text .= 'value="Asc">'.TUT_CONF_L8.'</option>
		  </select>
		</td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L21.'</td>
		<td class="forumheader3"><select name="menunum" id="menunum">
		  <option ';if($pref['tuts_menunum'] == '10'){ $text .= 'selected ';} $text .= 'value="10">10</option>
		  <option ';if($pref['tuts_menunum'] == '20'){ $text .= 'selected ';} $text .= 'value="20">20</option>
		  <option ';if($pref['tuts_menunum'] == '40'){ $text .= 'selected ';} $text .= 'value="40">40</option>
		  <option ';if($pref['tuts_menunum'] == '50'){ $text .= 'selected ';} $text .= 'value="50">50</option>
		  <option ';if($pref['tuts_menunum'] == '100'){ $text .= 'selected ';} $text .= 'value="100">100</option>
		  </select>
		</td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L16.'</td>
		<td class="forumheader3"><select name="menulist" id="menulist">
		  <option ';if($pref['tuts_menulist'] == 'new'){ $text .= 'selected ';} $text .= 'value="new">'.TUT_CONF_L17.'</option>
		  <option ';if($pref['tuts_menulist'] == 'views'){ $text .= 'selected ';} $text .= 'value="views">'.TUT_CONF_L18.'</option>
		  <option ';if($pref['tuts_menulist'] == 'rated'){ $text .= 'selected ';} $text .= 'value="rated">'.TUT_CONF_L19.'</option>
		  </select>
		</td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L20.'</td>
		<td class="forumheader3"><select name="menu_num" id="menu_num">
		  <option ';if($pref['tuts_menunum'] == '5'){ $text .= 'selected ';} $text .= 'value="5">5</option>
		  <option ';if($pref['tuts_menunum'] == '10'){ $text .= 'selected ';} $text .= 'value="10">10</option>
		  <option ';if($pref['tuts_menunum'] == '15'){ $text .= 'selected ';} $text .= 'value="15">15</option>
		  <option ';if($pref['tuts_menunum'] == '20'){ $text .= 'selected ';} $text .= 'value="20">20</option>
		  <option ';if($pref['tuts_menunum'] == '40'){ $text .= 'selected ';} $text .= 'value="40">40</option>
		  <option ';if($pref['tuts_menunum'] == '50'){ $text .= 'selected ';} $text .= 'value="50">50</option>
		  <option ';if($pref['tuts_menunum'] == '100'){ $text .= 'selected ';} $text .= 'value="100">100</option>
		  
		  </select>
		</td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L24.'</td>
		<td class="forumheader3"><input name="allowusersub" type="checkbox" value="true"';
		if($pref['tuts_allowusersub']){
			$text.=' checked="checked"';
		}
		$text .= ' /></td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L22.'</td>
		<td class="forumheader3"><input name="allownotify" type="checkbox" value="true"';
		if($pref['tuts_allownotify']){
			$text.=' checked="checked"';
		}
		$text .= ' /></td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_CONF_L23.'</td>
		<td class="forumheader3"><input name="killafter" type="text" value="'.$pref['tuts_killaftertimeout'].'" /></td>
	</tr>
  </table>
  <input name="submitprefs" type="submit" value="'.TUT_BUTTON_SUBMIT.'"><input name="reset" type="reset" value="'.TUT_BUTTON_RESET.'">
</form>';

$ns->tablerender(TUT_ADMIN_TITLE, $text);
require_once(e_ADMIN."footer.php");
?>
