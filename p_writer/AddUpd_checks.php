<?php

	$Er=0;
	$text = '';
	// if name of story is empty, then say so.
	if ( empty($_POST['newstory']))
	{
		$text .= PADM_18 . "<br />";
		$Er=1;
	}
	if ( intval($_POST['newyear']) == 0)
	{
		$text .= PADM_19 . ".<br />";
		$Er=1;
	}

	if ($Er == 1)
	{
		$text .= BackButton();
		$title = PADM_20;
		$ns -> tablerender($title, $text);
		require_once(e_ADMIN."footer.php");
		exit;
	}
	
?>
