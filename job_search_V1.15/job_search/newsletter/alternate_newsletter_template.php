<?php

global $jobsearch_shortcodes;
define("NEWS_WIDTH", "100%");
if (!isset($JOBSCH_NEWS_HEADER))
{
    $JOBSCH_NEWS_HEADER = "<div style='text-align:right;'>{JOBTODAY=d M Y}</div><br />Welcome to our latest newsletter.  We have {JOB_NUMBER} vacancies for you to look at. <br /><br />The details are as follows<br /><hr>
	<table style='width:100%'>";
}
if (!isset($JOBSCH_NEWS_DETAIL))
{
    $JOBSCH_NEWS_DETAIL = "
    <tr>
		<td style='width:30%'><span 'style='color:red;'><b>Job Title</b><span><br />{JOBTITLE}<br /></td>
		<td style='width:30%'><span 'style='color:red;'><b>Details</b><span><br />{JOBDETAILS}<br /></td>
	 	<td style='width:20%'><span 'style='color:red;'><b>More Information</b><span><br />{JOB_MOREINFO}<br /></td>


	</tr>";
}
if (!isset($JOBSCH_NEWS_FOOTER))
{
    $JOBSCH_NEWS_FOOTER = "</table><hr><br />Regards<br />{JOB_JOBSENDER}<br /><br />For more information please go to {JOB_JOBSEARCHURL}<br />You have elected to subscribe to this
	newsletter. To unsubscribe please visit {JOB_JOBSEARCHUNSUBURL}";
}


?>