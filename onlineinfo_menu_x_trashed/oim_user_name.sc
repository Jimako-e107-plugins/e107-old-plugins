global $user;
return "<span ".getuserclassinfo($user['user_id'])." ><b>".$user['user_name']."</b></span>";