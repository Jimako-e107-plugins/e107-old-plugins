<?php

// Theme 1

$text .="<table class width='100%' border='1'>
		<tr><td class width='100%'><h2>".$row['dj_name']." | ".$row['dj_genre']."</h2>
		".$row['dj_intro']."
		</td></tr>
		<tr><td><img src='".$dj_photo."' align='left' alt='".$row['dj_name']."' />
		<br /><br /><b>Location: ".$row['dj_location']."<br />
		Age: ".$row['dj_age']."<br /></b>
		<p>".$row['dj_body']."</p>
		</td></tr>	
		";

$text .="</table>";

?>