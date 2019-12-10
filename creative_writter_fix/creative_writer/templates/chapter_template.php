<?php

$CHAPTER_TEMPLATE = array();

/*  Standard list of items in default menu */

 
$CHAPTER_TEMPLATE['chapter_menu']['start']	= '';
$CHAPTER_TEMPLATE['chapter_menu']['item'] = '
<div class="col-lg-3">
					<p class="lead">{CW_CHAPTER_NUMBER} "." {CW_CHAPTER_NAME}</p>
					<p><code>div.well</code></p>
					<div class="well text-center">
						<h4>Premium Sevice</h4>
						<p>You can use this template as your blog or portfolio</p>
						<p><a href="{CW_CHAPTER_URL}" class="btn btn-default btn-lg">'.LAN_MORE.' »</a></p>
					</div><!-- /.well -->
				</div>
<div class="media"> 
     {CW_CHAPTER_ICON} 
  <div >
    <h4 class="media-heading">{CW_CHAPTER_NAME}</h4>
    <h5><i class="fa fa-clock"></i>{CW_CHAPTER_STARTTIME}</h5>
    <p>{CW_CHAPTER_SUMMARY}</p>
    <a href="{CW_CHAPTER_URL}" class="more-link">'.LAN_MORE.'<span class="meta-nav">→</span></a>
  </div>
</div>
';
$CHAPTER_TEMPLATE['chapter_menu']['end']	= '
<div class="cw_home text-center">{CW_CHAPTER_HOME}</div>
';


 
$CHAPTER_TEMPLATE['chapter_list']['start'] = '<div class=""> {SETIMAGE: w=600&h=450&x=1}';
 
$CHAPTER_TEMPLATE['chapter_list']['item'] = '
		<div class="row row-fluid">
				<div class="col-md-12">
                   <h3 class="media-heading">{CW_CHAPTER_NAME}</h3>
                      <p>
                       	{CW_CHAPTER_SUMMARY}
					</p>
                    <p>
                       <a href="{CW_CHAPTER_URL}" class="btn btn-small btn-primary">'.LAN_READ_MORE.'</a>
                   </p>
 				</div>
		</div>
		<hr class="visible-xs" />
 ';
$CHAPTER_TEMPLATE['chapter_list']['end']	= '
</div>
<div class="cw_pagination text-center">{CW_CHAPTER_PAGINATION}</div>
';
 
 
 

 
$CHAPTER_TEMPLATE['chapter_view']['start']	= '<!-- Default News Template -->{SETIMAGE: w=100&h=100}';
$CHAPTER_TEMPLATE['chapter_view']['body'] =' 
<article class="post">
						<!-- Carousel -->
						<h2><i class="fa fa-book"></i> '. LAN_CHAPTER_NAME .': <span class="text-muted"> {CW_CHAPTER_NAME}</span></h2>
						<p class="lead">'. LAN_CW_BOOK .': {CW_CHAPTER_BOOK_TITLE}</p>
						<hr>
            
  <div class="panel panel-secondary">
     <div class="panel-heading">'.LAN_CHAPTER_009.'</div>
     <div class="panel-body">
        <div class="row">
            <div class="col-md-3">'.LAN_BOOK_CATEGORY.':</div>
            <div class="col-md-9">{CW_CHAPTER_CATEGORY_NAME}</div>
        </div> 
        <div class="row">
            <div class="col-md-3">'.LAN_BOOK_AUTHOR.':</div><div class="col-md-9">{CW_CHAPTER_BOOK_AUTHOR}</div>
        </div> 
        <div class="row">
            <div class="col-md-3">'.LAN_BOOK_CHARACTERS.':</div><div class="col-md-9">{CW_CHAPTER_BOOK_CHARACTERS}</div>
        </div> 
        <div class="row">
            <div class="col-md-3">'.LAN_BOOK_SUMMARY.':</div><div class="col-md-9">{CW_CHAPTER_BOOK_SUMMARY}</div>
        </div> 
     </div>
</div>


  <div class="panel panel-info">
     <div class="panel-heading">'.LAN_CHAPTER_010.'</div>
     <div class="panel-body">
        <div class="row">
            <div class="col-md-3">'.LAN_CHAPTER_VIEWS.':</div>
            <div class="col-md-9">{CW_CHAPTER_VIEWS}</div>
        </div> 
        <div class="row">
            <div class="col-md-3">'.LAN_CHAPTER_CREATED.':</div><div class="col-md-9">{CW_CHAPTER_CREATED=short}</div>
        </div> 
        <div class="row">
            <div class="col-md-3">'.LAN_CHAPTER_LASTUPDATE.':</div><div class="col-md-9">{CW_CHAPTER_LASTUPDATE=short}</div>
        </div> 
        <div class="row">
            <div class="col-md-3">'.LAN_CHAPTER_WORDCOUNT.':</div><div class="col-md-9">{CW_CHAPTER_WORDCOUNT}</div>
        </div> 
     </div>
</div>

<div class="panel panel-secondary">
		<div class="panel-heading text-center">
			<h3 class="panel-title">{CW_CHAPTER_NUMBER} .'.LAN_CHAPTER_NAME.'</h3>
		</div><!-- /.panel-heading -->
		<div class="panel-body padding-md">
			 {CW_CHAPTER_BODY}
		</div><!-- /.panel-body -->
	</div><!-- /.panel -->
';

$CHAPTER_TEMPLATE['chapter_view']['end']	= "
 {CW_CHAPTER_PREV_FULL}
 {CW_CHAPTER_NEXT_FULL}      
</article>
{CW_CHAPTER_COMMENTS}
 
";

/* template used for display first chapter in book view */

$CHAPTER_TEMPLATE['book_detail']['start']	= '<!-- Default News Template -->{SETIMAGE: w=100&h=100}';
$CHAPTER_TEMPLATE['book_detail']['body'] =' 
<div class="panel panel-body">
		<div class="panel-heading text-center">
						<!-- Carousel -->
						<h3> {CW_CHAPTER_NUMBER} .'. LAN_CHAPTER_NAME .': <span class="text-muted"> {CW_CHAPTER_NAME}</span></h3>
 
		<div class="panel-body padding-md">
			 {CW_CHAPTER_BODY}
		</div><!-- /.panel-body -->
		</div><!-- /.panel-body -->
	</div><!-- /.panel -->';

$CHAPTER_TEMPLATE['book_detail']['end']	= $CHAPTER_TEMPLATE['chapter_view']['end'].'
 
';


$CHAPTER_TEMPLATE['chaptercomment']['start']	= '
<div class="panel panel-secondary" id="comments">		
  <div class="panel-heading text-left">			
    <h3 class="panel-title">'.LAN_COMMENT_DISCUSSION.'</h3>		
  </div>    
  <div class="panel-body padding-md">		
    <div class="row">                            
       <div class="col-md-6 text-center">        
        <a href="#sitecomments" class="btn btn-primary btn-lg" data-toggle="tab" title="comments"> 
        '.LAN_COMMENT_BYE107.'</a>                        
      </div>   
      <div class="col-md-6 text-center">        
        <a href="#profile" class="btn btn-default btn-lg" data-toggle="tab" title="facebook">
        '.LAN_COMMENT_BYFB.' </a>                        
      </div>     
    </div>
 		 
';

$CHAPTER_TEMPLATE['chaptercomment']['end']	= '
		</div><!-- /.panel-body -->
	</div><!-- /.panel -->  
';
$CHAPTER_TEMPLATE['chaptercomment']['body']	= '
         
   
        <div class="tab-content text-center">                      
          <div class="tab-pane fade in active" id="sitecomments"> 
           {CW_CHAPTER_e107_COMMENTS}                                                        
          </div>                      
          <div class="tab-pane fade" id="profile">                          
            {CW_CHAPTER_FB_COMMENTS}                                    
          </div>                      
        </div>
 
 
';
$CHAPTER_WRAPPER['latest']['CW_CHAPTER_BOOK_EXTERNAL']   = '<span class="label label-success label-external">{---}</span>';

$CHAPTER_TEMPLATE['latest']['start']	= '<div class="row">{SETIMAGE: w=600&h=450&x=1}';
$CHAPTER_TEMPLATE['latest']['item'] = '  
<div class="col-lg-3">
<div class="well text-center">  {CW_CHAPTER_BOOK_EXTERNAL}
						<h4>{CW_CHAPTER_NUMBER} . {CW_CHAPTER_NAME}</h4>
						<p>{CW_CHAPTER_CATEGORY_NAME}</p>
						<p><a href="{CW_CHAPTER_URL}" class="btn btn-default btn-lg">'.LAN_MORE.' »</a></p>
					</div>

</div>';
$CHAPTER_TEMPLATE['latest']['end']	= '
</div><div class="cw_home text-center">{CW_CHAPTER_HOME}</div>
';

 

 