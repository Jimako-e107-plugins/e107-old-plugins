<?php
global $e107;
if(USER) {
  $lip_exists = 0;
  $lip_ip = $e107->getip();
	$lip_use_table = $pref['lastip_use_table'];
	if($lip_use_table=="user") {
    $lip_num = $sql -> db_Select("user", "user_ip", "user_id = ".USERID.", and user_ip = '$lip_ip'");
    $lip_exists = $lip_num;
	}
	else {
	  $lip_num = $sql -> db_Select($lip_use_table, "user_ip, user_date", "user_id = ".USERID." order by user_date desc limit ".$pref['lastip_ips_per_user']);
    $lip_i = 0;
    while($lip_data = $sql -> db_Fetch()) {
      $lip_user_ips[$lip_i] = $lip_data[0];
      $lip_user_dts[$lip_i] = $lip_data[1];
      $lip_i++;
	  }
	  $lip_exists = in_array($lip_ip, $lip_user_ips);
	}
	if(!$lip_exists) {
    if($lip_use_table=="user") {
      $sql -> db_Update("user", "user_ip='$lip_ip' where user_id=".USERID);
    }
    else {
      $sql -> db_Insert($lip_use_table, USERID.",'$lip_ip',".time());
      if($lip_num == $pref['lastip_ips_per_user']) {
        $sql -> db_Delete($lip_use_table, "user_id=".USERID." and user_ip='$lip_user_ips[4]'");
      }
    }
	}
	else if($lip_use_table!="user" && $pref['lastip_change_date']) {
    $sql -> db_Update($lip_use_table, "user_date=".time()." where user_id=".USERID." and user_ip='$lip_ip'");
	}
}
?>