/*
+---------------------------------------------------------------+
|        Inbox Email - v0.1 by Mohamed Anouar Achoukhy
|        only for e107 website system
|        http://e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
global $message, $error , $tp, $sql;
	if ($pref['contact_plugin_enable'] == 1) 
	{ 
		if(!$error)
		{
			$sender_name = $tp->todb($_POST['author_name']);
			$sender = check_email($_POST['email_send']);
			$subject = $tp->todb($_POST['subject']);
			$body = $tp->toDB($_POST['body']);		
			if(!$sql->db_Insert("contact", "0, '$body' , '$sender_name' , '$sender' , '".date("Y/m/d H:i", time())."', '$subject' , '1'"))
				echo "error saving data form";
			//return $tp->toEmail($_POST['subject'],TRUE,"rawtext") ;
		}
	}	
//Mohamed Anouar Achoukhy / Naja7host.CoM