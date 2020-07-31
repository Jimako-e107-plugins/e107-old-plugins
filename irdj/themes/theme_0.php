<?php

// Theme 0

$text .="<table class width='100%' border='1' cellpadding='2'>
		<tr><td class width='100%'><h2>".$row['dj_name']." | ".$row['dj_genre']."</h2>
		</td></tr>
		<tr><td><center><img src='".$dj_photo."' align='left' alt='".$row['dj_name']."' /><p>".$row['dj_intro']."</p>
		<br /><h2><b>Location: ".$row['dj_location']."<br />
		<br />Age: ".$row['dj_age']."<br />
		<br />Genre: ".$row['dj_genre']."<br />
		</h2>
		</center></td></tr>	
		
		<tr>
		<td>".$row['dj_body']."</td>
		</tr>
		";

$text .="</table>";

?>