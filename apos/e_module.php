<?php
/*
+------------------------------------------------------------------------------+
| Auto Post on Signup v1.0
| Plugin by Martinj - www.martinj.co.uk
| July 2009
|   e107 Website System - e107.org
|  Plugin skeleton by nlstart
+------------------------------------------------------------------------------+
*/
// event trigger is $data['userveri']

global $e_event,$pref;

	if ($pref['user_reg_veri'] > 0) {
		$e_event -> register("userveri", "apos_userveri");
	}
	else {
		$e_event -> register("usersup", "apos_usersup");
	}

	
	function apos_userveri($data){
		global $pref;
		
			$aposUserId=$data['user_id'];
			$userData=get_user_data($aposUserId);
			
			$user = get_user_data($pref['apos_userid']);
			
			require_once(e_PLUGIN.'forum/forum_class.php');
				$forum = new e107forum;
				
				$forum_id=intval($pref['apos_forum']);
				$parent=0; // test
				$poster=array('post_userid'=>$pref['apos_userid'], 'post_user_name'=>$user['user_name']);
				$forum_sub=0; // test
								
					// Replacements
					$apos_find=array("[USERNAME]", "[REALNAME]","[LOGINNAME]");
					$apos_replace=array($data['user_name'], $data['user_name'], $data['user_loginname']);
					$pref['apos_text']=str_replace($apos_find,$apos_replace,$pref['apos_text']);
					$pref['apos_title']=str_replace($apos_find,$apos_replace,$pref['apos_title']);
					
			$iid = $forum->thread_insert($pref['apos_title'],$pref['apos_text'],$forum_id,$parent,$poster,1,0,$forum_sub);
	}

	function apos_usersup($data){	
			global $pref,$user;
			$user = get_user_data($pref['apos_userid']);

			require_once(e_PLUGIN.'forum/forum_class.php');
				$forum = new e107forum;
				
				$forum_id=intval($pref['apos_forum']);
				$parent=0; // test
				$poster=array('post_userid'=>$pref['apos_userid'], 'post_user_name'=>$user['user_name']);
				$forum_sub=0; // test
								
					// Replacements
					$apos_find=array("[USERNAME]", "[REALNAME]","[LOGINNAME]");
					$apos_replace=array($data['loginname'], $data['realname'], $data['name']);
					$pref['apos_text']=str_replace($apos_find,$apos_replace,$pref['apos_text']);
					$pref['apos_title']=str_replace($apos_find,$apos_replace,$pref['apos_title']);
					
			$iid = $forum->thread_insert($pref['apos_title'],$pref['apos_text'],$forum_id,$parent,$poster,1,0,$forum_sub);
	}
?>