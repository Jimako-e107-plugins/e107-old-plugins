<?php
global $sc_style;

$sc_style['PW_STORY_ID']['pre'] = "";
$sc_style['PW_STORY_ID']['post'] = "";

$sc_style['PW_STORY2_ID']['pre'] = "";
$sc_style['PW_STORY2_ID']['post'] = "";

$sc_style['PW_STORY_NAME']['pre'] = "";
$sc_style['PW_STORY_NAME']['post'] = "";

$sc_style['PW_STORY_NAME2']['pre'] = "";
$sc_style['PW_STORY_NAME2']['post'] = "";

$sc_style['PW_STORYGROUP']['pre'] = "<u>";
$sc_style['PW_STORYGROUP']['post'] = "</u>";

$sc_style['PW_YEAR_WRITTEN']['pre'] = "";
$sc_style['PW_YEAR_WRITTEN']['post'] = "";

$sc_style['PW_GENRE_NAME']['pre'] = "";
$sc_style['PW_GENRE_NAME']['post'] = "";

$sc_style['PW_CHAPTER_NUMBER']['pre'] = "";
$sc_style['PW_CHAPTER_NUMBER']['post'] = "";

$sc_style['PW_CHAPTER_NUMBER2']['pre'] = "";
$sc_style['PW_CHAPTER_NUMBER2']['post'] = "";

$PW_TABLEINIT = "<table width=100%>";

$PW_HDR_STORY_OVERV = "
	<th>Story name</th>
	<th>Date Written</th>
	<th>Genre</th>";

$PW_CHAPTER_OVERV = "
	<th>Story name</th>
	<th>Date Written</th>
	<th>Genre</th>";

$PW_STORYGROUP = "
	<tr><td><br />* {PW_STORYGROUP}</td></tr>";

$PW_STORYROW = "
	<tr>
		<td><a href='p_writer.php?sid={PW_STORY_ID}'>{PW_STORY_NAME}</a></td>
		<td>{PW_YEAR_WRITTEN}</td>
		<td>{PW_GENRE_NAME}</td>
	</tr>";

$PW_CHAPTER_HDR ='
	<tr>
		<td><b>{PW_STORY_NAME}</b></td>
	</tr>';

$PW_CHAPTER_LINE_1 = '
	<tr>
		<td>{PW_CHAPTER_NUMBER}<a href="' . e_SELF . '?read={PW_STORY_ID}.{PW_CHAPTER_NUMBER}">{PW_CHAPTER_NAME}</a></td>
	</tr>';

$PW_CHAPTER_LINE_2 = '
	<tr>
		<td>{PW_CHAPTER_NUMBER}<a href="' . e_SELF . '?read={PW_STORY_ID}.{PW_CHAPTER_NUMBER}">{PW_CHAPTER_NAME}</a></td>
		<td>{PW_CHAPTER_NUMBER2}<a href="' . e_SELF . '?read={PW_STORY2_ID}.{PW_CHAPTER_NUMBER2}">{PW_CHAPTER_NAME2}</a></td>
	</tr>';

$PW_BOT = "</table>";

$PW_RETURN_OVERVIEW .= '<hr><p><a href="' . e_SELF . '">{PW_RETURN_OVERVIEW}</a></p>';

$PW_READ_CHAPTER = "{PW_READ_CHAPTER}";

$PW_CHAPTER_NAVIGATE = "
	<br \><hr><br \>
	<table width=100% border=0>
		<tr>
			<td width=33% style=\"text-align: left;\">
				{PW_READ_PREVIOUSCHAPTER}
			</td>
			<td style=\"text-align: center;\" width=33%>
				{PW_READ_ALLCHAPTER}
			</td>
			<td style=\"text-align: right;\" width=33%>
				{PW_READ_NEXTCHAPTER}
			</td>
		</tr>
	</table>
";
?>
