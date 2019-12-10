<?php

$BOOK_TEMPLATE = array();

 
$BOOK_WRAPPER['book']['CW_BOOK_LOGO']   = '<div class="row tr"><div class="col-md-12">{---}</div></div>';
 
$BOOK_WRAPPER['book']['CW_BOOK_DISCLAIMER'] = '<div class="row tr"><div class="col-md-3 td">'.LAN_BOOK_DISCLAIMER.':</div><div class="col-md-9 td">{---}</div></div>';
$BOOK_WRAPPER['book']['CW_BOOK_WARNINGS'] = '<div class="row tr"><div class="col-md-3 td">'.LAN_BOOK_WARNINGS.':</div><div class="col-md-9 td">{---}</div></div>';
$BOOK_WRAPPER['book']['CW_BOOK_COMPLETE'] = '<div class="row tr"><div class="col-md-3 td">'.LAN_BOOK_COMPLETE.':</div><div class="col-md-9 td">{---}</div></div>';
$BOOK_WRAPPER['book']['CW_BOOK_SERIES'] = '<div class="row tr"><div class="col-md-3 td">'.LAN_BOOK_PART_OF_SERIES.':</div><div class="col-md-9 td">{---}</div></div>';

 
$BOOK_TEMPLATE['book_view']['start']	= '{SETIMAGE: w=150&h=150}';
$BOOK_TEMPLATE['book_view']['body'] =' 
<article class="post">
						<!-- Carousel -->
						<h2><i class="fa fa-book"></i> '. LAN_BOOK_TITLE .': <span class="text-muted"> {CW_BOOK_TITLE}</span></h2>
						<p class="lead">'. LAN_BOOK_DETAILS .' </p>
						<hr>
            
<div class="panel panel-secondary">
  <div class="panel-heading">'.LAN_CHAPTER_001.'</div>
  <div class="panel-body">
    <div class="row"> <div class="col-md-12 text-center">{CW_BOOK_CHAPTERS_LIST}</div></div>  
  </div>
</div>
 
  <div class="panel panel-info table table-striped table-bordered">
     <div class="panel-heading">'.LAN_BOOK_DETAILS.'</div>
     <div class="panel-body tbody table-bordered">
        <div class="row tr">
            <div class="col-md-3 td ">'.LAN_BOOK_TITLE.':</div><div class="col-md-9 td">{CW_BOOK_TITLE}</div></div> 
        <div class="row tr">
            <div class="col-md-3 td">'.LAN_BOOK_SUMMARY.':</div><div class="col-md-9 td">{CW_BOOK_SUMMARY}</div>
        </div> 
        <div class="row tr">
            <div class="col-md-3 td t">'.LAN_BOOK_CATEGORY.':</div><div class="col-md-9 td">{CW_CATEGORY_ICON}{CW_CATEGORY_NAME}</div>
        </div> 
        <div class="row tr">
            <div class="col-md-3 td ">'.LAN_BOOK_GENRE.':</div><div class="col-md-9 td">{CW_GENRE_ICON}{CW_GENRE_NAME}</div>
        </div>  
        <div class="row tr">
            <div class="col-md-3 td">'.LAN_BOOK_AUTHOR.':</div><div class="col-md-9 td">{CW_BOOK_AUTHOR}</div>
        </div> 
        <div class="row tr ">
            <div class="col-md-3 td ">'.LAN_BOOK_CHARACTERS.':</div><div class="col-md-9 td">{CW_BOOK_CHARACTERS}</div>
        </div>         
  {CW_BOOK_WARNINGS}
  {CW_BOOK_DISCLAIMER}
        <div class="row tr">
            <div class="col-md-3 td">'.LAN_BOOK_WORDCOUNT.':</div><div class="col-md-9 td">{CW_BOOK_WORDCOUNT}</div>
        </div>
        <div class="row tr">
            <div class="col-md-3 td ">'.LAN_BOOK_CHAPTERS.':</div><div class="col-md-9 td">{CW_BOOK_CHAPTERS}</div>
        </div>
        <div class="row tr">
            <div class="col-md-3 td">'.LAN_BOOK_CREATED.':</div><div class="col-md-9 td">{CW_BOOK_CREATED}</div>
        </div>    
        <div class="row tr">
            <div class="col-md-3 td ">'.LAN_BOOK_LASTUPDATE.':</div><div class="col-md-9 td">{CW_BOOK_LASTUPDATE}</div>
        </div>    
		{CW_BOOK_COMPLETE} 
		{CW_BOOK_SERIES}    
        <div class="row tr">
            <div class="col-md-3 td  ">'.LAN_BOOK_VIEWS.':</div><div class="col-md-9 td">{CW_BOOK_VIEWS}</div>
        </div>
        <div class="row tr">
            <div class="col-md-3 td  ">'.LAN_BOOK_REVIEW.':</div><div class="col-md-9 td">{CW_BOOK_REVIEW}</div>
        </div>
        <div class="row tr">
            <div class="col-md-3 td  ">'.LAN_BOOK_RATING.':</div><div class="col-md-9 td">{CW_BOOK_RATING}</div>
        </div>        
     </div>
</div> 
  ';

$BOOK_TEMPLATE['book_view']['end']	= ' 
';
 
 

 