<?php

$CHALLENGE_TEMPLATE = array();

$CHALLENGE_WRAPPER['challenge_menu']['CW_CHALLENGE_ICON']   = '<div class="pull-left"><a class=" " href="{CW_CHALLENGE_URL}">{---}</a> </div>';

 
$CHALLENGE_TEMPLATE['challenge_menu']['start']	= '<!-- Default News Template -->{SETIMAGE: w=100&h=100}';
$CHALLENGE_TEMPLATE['challenge_menu']['item'] = '
<div class="media"> 
     {CW_CHALLENGE_ICON} 
  <div >
    <h4 class="media-heading">{CW_CHALLENGE_NAME}</h4>
    <h5><i class="fa fa-clock"></i>{CW_CHALLENGE_STARTTIME}</h5>
    <p>{CW_CHALLENGE_SUMMARY}</p>
    <a href="{CW_CHALLENGE_URL}" class="more-link">'.LAN_MORE.'<span class="meta-nav">→</span></a>
  </div>
</div>
';

$CHALLENGE_TEMPLATE['challenge_menu']['end']	= '
<div class="cw_home text-center">{CW_CHALLENGE_HOME}</div>
';


$CHALLENGE_TEMPLATE['challenge_menu']['futureitem'] = '
<div class="alert alert-block alert-error alert-danger center">'.LAN_CW_ONLY_ADMINS.'
'.$CHALLENGE_TEMPLATE['challenge_menu']['item'].'</div>
';
 
 
$CHALLENGE_TEMPLATE['challenge_list']['start'] = '<div class=""> {SETIMAGE: w=600&h=450&x=1}';
 
$CHALLENGE_TEMPLATE['challenge_list']['item'] = '
<div class="row"> 
	<div class="thumbnail text-default col-sm-6 col-md-3">
		<div class="overlay-container">
			{CW_CHALLENGE_ICON}
			<div class="overlay-content">
				<h3 class="h4 headline">{CW_CHALLENGE_NAME}</h3>
				<p>{CW_CHALLENGE_SUMMARY}</p>
			</div><!-- /.overlay-content -->
		</div><!-- /.overlay-container -->
	</div>
	<div class="col-sm-6 col-md-9">
		<div class="h2">
       {CW_CHALLENGE_NAME}  
		</div> 
		{CW_CHALLENGE_SUMMARY}   
		<div class="thumbnail-meta">      
			 <i class="fa fa-clock"></i>{CW_CHALLENGE_STARTTIME} 
		</div>
		<div class="thumbnail-meta">
			<a href="{CW_CHALLENGE_URL}" class="more-link">'.LAN_MORE.'<span class="meta-nav">→</span></a>						</div>
	</div> 
</div> 
 ';
$CHALLENGE_TEMPLATE['challenge_list']['end']	= '
</div>
<div class="cw_pagination text-center">{CW_CHALLENGE_PAGINATION}</div>
';
$CHALLENGE_TEMPLATE['challenge_list']['futureitem'] =$CHALLENGE_TEMPLATE['challenge_list']['item']; 
 
$CHALLENGE_WRAPPER['challenge_view']['CW_CHALLENGE_ICON']   = '<div class="pull-left"><a class=" " href="{CW_CHALLENGE_URL}">{---}</a> </div>';

 
 
$CHALLENGE_TEMPLATE['challenge_view']['caption']	= LAN_CHALLENGE_004.': {CW_CHALLENGE_NAME}';

$CHALLENGE_TEMPLATE['challenge_view']['start']	= '<!-- Default News Template -->{SETIMAGE: w=100&h=100}';
$CHALLENGE_TEMPLATE['challenge_view']['item'] = '
<div class="media">
  
     {CW_CHALLENGE_ICON} 
  
  <div >
    <h4 class="media-heading">{CW_CHALLENGE_NAME}</h4>
    <h5><i class="fa fa-clock"></i>{CW_CHALLENGE_STARTTIME}</h5>
    <p>{CW_CHALLENGE_SUMMARY}</p>
    {CW_CHALLENGE_DESC} 
  </div>
</div>
';

$CHALLENGE_TEMPLATE['challenge_view']['end']	= '
<div class="cw_pagination">{CW_CHALLENGE_PAGINATION}</div>
';


$CHALLENGE_TEMPLATE['challenge_view']['futureitem'] = '
<div class="alert alert-block alert-error alert-danger center">'.LAN_CW_ONLY_ADMINS.'
'.$CHALLENGE_TEMPLATE['challenge_view']['item'].'</div>
';


$CHALLENGE_TEMPLATE['latest']['start']	= '<div class="row">{SETIMAGE: w=600&h=450&x=1}';
$CHALLENGE_TEMPLATE['latest']['item'] = '  
<div class="col-sm-6 col-md-3">
	<div class="thumbnail text-default">
		<div class="overlay-container">
			{CW_CHALLENGE_ICON}
			<div class="overlay-content">
				<h3 class="h4 headline">{CW_CHALLENGE_NAME}</h3>
				<p>{CW_CHALLENGE_SUMMARY}</p>
			</div><!-- /.overlay-content -->
		</div><!-- /.overlay-container -->
		<div class="thumbnail-meta">
       {CW_CHALLENGE_NAME}  
		</div>    
		<div class="thumbnail-meta">      
			 <i class="fa fa-clock"></i>{CW_CHALLENGE_STARTTIME} 
		</div>
		<div class="thumbnail-meta">
			<a href="{CW_CHALLENGE_URL}" class="more-link">'.LAN_MORE.'<span class="meta-nav">→</span></a>						</div>
	</div><!-- /.thumbnail -->
</div><!-- /.col -->';
$CHALLENGE_TEMPLATE['latest']['end']	= '
</div><div class="cw_home text-center">{CW_CHALLENGE_HOME}</div>
';


$CHALLENGE_TEMPLATE['latest']['futureitem'] = 
'  
<div class="col-sm-6 col-md-3">
	<div class="thumbnail text-default">
		<div class="overlay-container">
			{CW_CHALLENGE_ICON}
			<div class="overlay-content">
				<h3 class="h4 headline">{CW_CHALLENGE_NAME}</h3>
				<p>{CW_CHALLENGE_SUMMARY}</p>
			</div><!-- /.overlay-content -->
		</div><!-- /.overlay-container -->
		<div class="thumbnail-meta">      
      {CW_CHALLENGE_NAME} 
		</div>    
		<div class="thumbnail-meta">       
			 <i class="fa fa-clock"></i>{CW_CHALLENGE_STARTTIME}
       <span class="alert-danger center">'.LAN_CW_ONLY_ADMINS.'</span> 
		</div>
		<div class="thumbnail-meta">
			<a href="{CW_CHALLENGE_URL}" class="more-link">'.LAN_MORE.'<span class="meta-nav">→</span></a>						</div>
	</div><!-- /.thumbnail -->
</div><!-- /.col -->
';

 