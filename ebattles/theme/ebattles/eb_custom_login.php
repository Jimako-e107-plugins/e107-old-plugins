<?php

// -----------------------------------------------------------------------------------------------------------+

  unset($tmp);

  $tmp .= "<div class='mediumtext' style='white-space:nowrap'>";

  if (!USER)
  {
    $tmp .= "	<form method='post' action='$_SERVER[PHP_SELF]'>
		<div>
		Username: <input class='tbox' type='text' name='username' size='15' value='' maxlength='20' />&nbsp;&nbsp;
		Password: <input class='tbox' type='password' name='userpass' size='15' value='' maxlength='20' />&nbsp;&nbsp;
		<input type='hidden' name='autologin' value='1' />
		<input class='button' type='submit' name='userlogin' value='Login' />
		&nbsp;&nbsp;&nbsp;&nbsp;<a href='".e_BASE."signup.php'>Signup</a>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href='".e_BASE."fpw.php'>Forgotten Password</a>
		</div>
		</form>";
  }
  else
  {
    $tmp .= "	Welcome <a href='".e_BASE."user.php?id.".USERID."'>".USERNAME."</a>
		<a href='".e_BASE."usersettings.php'>(Settings)</a> 
		.:. <a href='".e_BASE."index.php?logout'>Logout</a>
		.:. 
		";
  }

  if (USER && $pref[pm_sendemail])
  {
    $tmp .= "	<a href='".e_PLUGIN."pm_menu/pm.php'>Private Messages</a> .:. ";
  }

  if (ADMIN)
  {
    $tmp .= "	<a href='".e_BASE."e107_admin/admin.php'>Admin Area</a> .:. ";
  }

  $tmp .= "</div>";

  define("EB_CUSTOM_LOGIN", $tmp);

  unset($tmp);

// -----------------------------------------------------------------------------------------------------------+
  
  if (!USER)
  {
    $tmp .= "	<form method='post' action='$_SERVER[PHP_SELF]'>
    		<div>
		Username: <input class='tbox' type='text'     name='username' size='15' value='' maxlength='20' />&nbsp;&nbsp;
		Password: <input class='tbox' type='password' name='userpass' size='15' value='' maxlength='20' />&nbsp;&nbsp;
		<input type='hidden' name='autologin' value='1' />
		<input class='button' type='submit' name='userlogin' value='Login' />
		&nbsp;&nbsp;&nbsp;&nbsp;<a href='".e_BASE."signup.php'>Signup</a>
		</div>
		</form>";
  }
  else
  {
    $tmp .= "	Welcome ".USERNAME."&nbsp;&nbsp;&nbsp;
		.:. <a href='".e_BASE."index.php?logout'>Logout</a> 
		.:. ";
  }

  define("EB_CUSTOM_LOGIN_SMALL", $tmp);
  
  unset($tmp);

// -----------------------------------------------------------------------------------------------------------+

  if (strstr($_SERVER[PHP_SELF], "forum"))
  {
    if (!USER)
    {
      $tmp .= "	<form method='post' action='$_SERVER[PHP_SELF]'>
      		<div>
		Username: <input class='tbox' type='text'     name='username' size='15' value='' maxlength='20' />&nbsp;&nbsp;
		Password: <input class='tbox' type='password' name='userpass' size='15' value='' maxlength='20' />&nbsp;&nbsp;
		<input type='hidden' name='autologin' value='1' />
		<input class='button' type='submit' name='userlogin' value='Login' />
		&nbsp;&nbsp;&nbsp;&nbsp;<a href='".e_BASE."signup.php'>Signup</a>
		</div>
		</form>";
    }
    else
    {
      $tmp .= "	Welcome ".USERNAME."&nbsp;&nbsp;&nbsp;
		.:. <a href='".e_BASE."index.php?logout'>Logout</a> 
		.:. ";
    }
    
    $tmp = "<div style='text-align:center'>$tmp<hr /></div>";
    
  }
  
  define("EB_CUSTOM_LOGIN_FORUM", $tmp);
  
  unset($tmp);

// -----------------------------------------------------------------------------------------------------------+
  
?>