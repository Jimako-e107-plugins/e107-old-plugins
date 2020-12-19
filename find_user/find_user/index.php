<?php
/*
+---------------------------------------------------------------+
|        Tournaments plugin for e107 v0.7
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stratos Geroulis
|        http://www.stratosector.net/
|        stratosg@stratosector.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(HEADERF);

if(file_exists(e_PLUGIN."find_user/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."find_user/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."find_user/language/English.php");
}

if(isset($_POST['find_username'])){
	$username = mysql_real_escape_string($_POST['find_username']);
	$sql->mySQLresult = @mysql_query('SELECT user_id, user_name, user_email, user_hideemail FROM '.MPREFIX.'user WHERE user_name like \'%'.$username.'%\';');
	$row = $sql->db_Fetch();
	
	$users = array();
	while($row){
		$users[] = $row;
		$row = $sql->db_Fetch();
	}
	
	$text = '';
	if(count($users) == 0){
		$text .= FIND_USER_NONE;
	}
	elseif(count($users) == 20){
		$text .= FIND_USER_MANY;
	}
	else{
		$text = '<br>
				 <table width=\'90%\'>
					<tr>
						<th></th>
						<th>'.FIND_USER_FOUND_USER_ID.'</th>
						<th>'.FIND_USER_FOUND_USERNAME.'</th>
						<th>'.FIND_USER_FOUND_EMAIL.'</th>
					</tr>';
		
		foreach($users as $user){
			$text .= '<tr>
						<td width=\'20%\'><a href=\''.SITEURL.'user.php?id.'.$user['user_id'].'\'><img alt=\'profile\' src=\''.e_PLUGIN.'find_user/images/user.png\'></a></td>
						<td><center>'.$user['user_id'].'</center></td>
						<td><center>'.$user['user_name'].'</center></td>
						<td><center>'.($user['user_hideemail'] == 0 ? '<a href=\'mailto:'.$user['user_email'].'\'>'.$user['user_email'].'</a>' : '<i>'.FIND_USER_FOUND_EMAIL_HIDDEN.'</i>').'</center></td>
					  </tr>';
		}
		
		$text .= '</table>';
	}
	
	$text .= '<br>
			  <br>
			  <center><a href=\''.$_SERVER['SCRIPT_NAME'].'\'>'.FIND_USER_BACK.'</a></center>';
	
	$ns -> tablerender(FIND_USER_TITLE, $text);
	
	require_once(FOOTERF);
	exit;
}

$text = '<center>'.FIND_USER_DESC.'
		 <br>
		 <br>
		 <form name=\'find_user_form\' action=\''.$_SERVER['SCRIPT_NAME'].'\' method=\'post\'>
			'.FIND_USER_USERNAME.':&nbsp;<input type=\'text\' name=\'find_username\'>&nbsp;<input type=\'submit\' name=\'find_user_submit\' value=\''.FIND_USER_FIND.'\' class=\'button\'>
		 </form>';

$ns -> tablerender(FIND_USER_TITLE, $text);

require_once(FOOTERF);

?>