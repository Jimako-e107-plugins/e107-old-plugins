<?php

$CREATIVE_WRITER_TEMPLATE = array();
 
 
$CREATIVE_WRITER_TEMPLATE['booklist']['start'] = "<table id='cw_results' class='fborder' style='width:100%' >
			<tr>
				<td class='fcaption' colspan='6'>" . CWRITER_02 . "</td>
			</tr>
				<tr>
				<td class='forumheader2' style='width:40%'>" . LAN_BOOK_TITLE . "</td>
				<td class='forumheader2' style='text-align:center;width:15%'>" . LAN_BOOK_CATEGORY . "</td>
				<td class='forumheader2' style='text-align:center;width:15%'>" . LAN_BOOK_GENRE . "</td>
				<td class='forumheader2' style='text-align:center;width:10%'>" . LAN_BOOK_AUTHOR . "</td>
				<td class='forumheader2' style='width:10%; text-align:right;'>" . LAN_BOOK_CHAPTERS . "</td>
				<td class='forumheader2' style='width:10%; text-align:center;'>" . LAN_BOOK_COMPLETE . "</td>
			</tr>{SETIMAGE: w=50&h=50}";
			
$CREATIVE_WRITER_TEMPLATE['booklist']['start-2'] = "<table id='cw_results' class='fborder' style='width:100%' >
			<tr>
				<td class='fcaption' colspan='6'>" . CWRITER_02 . "</td>
			</tr>
				<tr>
				<td class='forumheader2' style='width:40%'>" . LAN_BOOK_TITLE . "</td>
				<td class='forumheader2' style='text-align:center;width:20%'>" . LAN_BOOK_CATEGORY . "</td>
				<td class='forumheader2' style='text-align:center;width:20%'>" . LAN_BOOK_GENRE . "</td>
				<td class='forumheader2' style='text-align:center;width:10%'>" . LAN_BOOK_AUTHOR . "</td>
				<td class='forumheader2' style='width:10%; text-align:right;'>" . LAN_BOOK_CHAPTERS . "</td>
			</tr>{SETIMAGE: w=50&h=50}";			
			
$CREATIVE_WRITER_TEMPLATE['booklist']['item'] = "
<tr>
<td class='forumheader3'>{CW_BOOK_TITLE_URL} {CW_BOOK_RATING_SIMPLE}</td>
<td class='forumheader3 text-center'><span class='smalltext'>{CW_CATEGORY_ICON}{CW_CATEGORY_NAME}</span></td>
<td class='forumheader3 text-center'><span class='smalltext'>{CW_GENRE_ICON}{CW_GENRE_NAME}</span></td>
<td class='forumheader3 text-center'>{CW_BOOK_AUTHOR}</td>
<td class='forumheader3' style='text-align:right;' >{CW_BOOK_CHAPTERS}</td>
<td class='forumheader3' style='text-align:center;'>{CW_BOOK_COMPLETE}</td>
			</tr>
";
$CREATIVE_WRITER_TEMPLATE['booklist']['item-2'] = "
<tr>
<td class='forumheader3'>{CW_BOOK_TITLE_URL} {CW_BOOK_RATING_SIMPLE}</td>
<td class='forumheader3 text-center'><span class='smalltext'>{CW_CATEGORY_ICON}{CW_CATEGORY_NAME}</span></td>
<td class='forumheader3 text-center'><span class='smalltext'>{CW_GENRE_ICON}{CW_GENRE_NAME}</span></td>
<td class='forumheader3 text-center'>{CW_BOOK_AUTHOR}</td>
<td class='forumheader3' style='text-align:right;' >{CW_BOOK_CHAPTERS}</td>
 
			</tr>
";
$CREATIVE_WRITER_TEMPLATE['booklist']['end'] = '
</table>
<div class="cw_pagination">{CW_PAGINATION}</div> 
<div class="managebook">{CW_ADMIN_MANAGEBOOKS} | {CW_ADMIN_NEWBOOK}</div> ';

$CREATIVE_WRITER_TEMPLATE['booklist']['nobooks'] = '
</table>
<hr><div class="row"><div class="col-md-12">'.CWRITER_02a.'</div></div>  
<div class="managebook">{CW_ADMIN_MANAGEBOOKS}</div> ';                               
 

$CREATIVE_WRITER_TEMPLATE['filter']['open']	= "
<form action='{CW_WRITER_HOME: link=1}' method='post' id='cwform' >
		<table id='cw_filter' class='fborder' style='width:100%' >
"; 

$CREATIVE_WRITER_TEMPLATE['filter']['captions']	= "
			<tr>
				<td class='forumheader3'>" . LAN_BOOK_CATEGORY . "</td>
				<td class='forumheader3'>" . LAN_BOOK_GENRE . "</td>
				<td class='forumheader3'>" . LAN_BOOK_CHARACTER . "</td>
				<td class='forumheader3'>" . LAN_BOOK_AUTHOR . "</td>
				<td class='forumheader3'>" . LAN_BOOK_COMPLETION . "</td>
				<td class='forumheader3'>" . LAN_BOOK_FILTER . "</td>
			</tr> ";
			
$CREATIVE_WRITER_TEMPLATE['filter']['captions-2']	= "
			<tr>
				<td class='forumheader3'>" . LAN_BOOK_CATEGORY . "</td>
				<td class='forumheader3'>" . LAN_BOOK_GENRE . "</td>
				<td class='forumheader3'>" . LAN_BOOK_CHARACTER . "</td>
				<td class='forumheader3'>" . LAN_BOOK_AUTHOR . "</td>
				<td class='forumheader3'>" . LAN_BOOK_FILTER . "</td>
			</tr> ";
      
$CREATIVE_WRITER_TEMPLATE['filter']['close'] = "       
				<td class='forumheader3'><input type='submit' class='btn btn-primary btn-block' name='dofilter' value='" . LAN_BOOK_FILTER . "' /></td>
			</tr>
			</table>
			</form>";
      
$CREATIVE_WRITER_TEMPLATE['homefilter']['open']	=  "<form action='{CW_WRITER_HOME: link=1}' method='post' id='cwform' class='form-inline'>
							<div class='row'>";
$CREATIVE_WRITER_TEMPLATE['homefilter']['captions']	= '';  /* captions are part of columns*/ 

$CREATIVE_WRITER_TEMPLATE['filter']['column']	=   "
			<tr>
				<td class='forumheader3'>{CWRITER_CATSEL}</td>
				<td class='forumheader3'>{CWRITER_GENSEL}</td>
				<td class='forumheader3'>{CWRITER_CHARSEL}</td>
				<td class='forumheader3'>{CWRITER_AUTHSEL}</td>
				<td class='forumheader3'>{CWRITER_COMPSEL}</td>"; 
        
$CREATIVE_WRITER_TEMPLATE['filter']['column-2']	=   "
			<tr>
				<td class='forumheader3'>{CWRITER_CATSEL}</td>
				<td class='forumheader3'>{CWRITER_GENSEL}</td>
				<td class='forumheader3'>{CWRITER_CHARSEL}</td>
				<td class='forumheader3'>{CWRITER_AUTHSEL}</td>
			 "; 
				        
$CREATIVE_WRITER_TEMPLATE['homefilter']['column']	= '               
								<div class="col-md-2">
									<label for="">' . LAN_BOOK_CATEGORY . ':</label>
									{CWRITER_CATSEL}
								</div><!-- /.col -->
								<div class="col-md-2">
									<label for="">' . LAN_BOOK_GENRE . ':</label>
									{CWRITER_GENSEL}
								</div><!-- /.col -->
								<div class="col-md-2">
									<label for="">' . LAN_BOOK_CHARACTERS . ':</label>
									{CWRITER_CHARSEL}
								</div><!-- /.col -->
								<div class="col-md-2">
									<label for="">' . LAN_BOOK_AUTHOR . ':</label>
									{CWRITER_AUTHSEL}
								</div><!-- /.col -->
								<div class="col-md-2">
									<label for="">' . LAN_BOOK_COMPLETION . ':</label>
									{CWRITER_COMPSEL}
								</div><!-- /.col -->
								 ';
								 
$CREATIVE_WRITER_TEMPLATE['homefilter']['column-2']	= '               
								<div class="col-md-3">
									<label for="">' . LAN_BOOK_CATEGORY . ':</label>
									{CWRITER_CATSEL}
								</div><!-- /.col -->
								<div class="col-md-2">
									<label for="">' . LAN_BOOK_GENRE . ':</label>
									{CWRITER_GENSEL}
								</div><!-- /.col -->
								<div class="col-md-3">
									<label for="">' . LAN_BOOK_CHARACTERS . ':</label>
									{CWRITER_CHARSEL}
								</div><!-- /.col -->
								<div class="col-md-2">
									<label for="">' . LAN_BOOK_AUTHOR . ':</label>
									{CWRITER_AUTHSEL}
								</div><!-- /.col -->
								 ';
            
$CREATIVE_WRITER_TEMPLATE['homefilter']['close'] = '       
				<div class="col-md-2">  <label for="">Ready?</label>
               <input type="submit" class="btn btn-primary btn-block" name="dofilter" value="' . LAN_BOOK_FILTER . '" /></td>
			          </div>
							</div>
						</form>';
  
  
$CREATIVE_WRITER_TEMPLATE['mybooks']['breadcrumbs'] = '{CW_BREADCRUMBS}';
$CREATIVE_WRITER_TEMPLATE['mybooks']['start'] = '
<div class="managebook"> {CW_ADMIN_NEWBOOK}</div> 
<table class="fborder" style="width:100%;">
	<tr>
		<td class="fcaption" style="width:75%;">' . LAN_CW_BOOK . '</td>
		<td class="fcaption" style="width:25%;text-align:center;">' . CWRITER_202 . '</td>
	</tr>
';
$CREATIVE_WRITER_TEMPLATE['mybooks']['item'] = "<tr>
		<td class='forumheader3' style='width:75%;'>{CW_BOOK_TITLE}</td>
		<td class='forumheader3' style='width:25%;text-align:center;'>
			{CW_MB_BOOK_EDIT_CHAPTERS}
			{CW_MB_BOOK_EDIT}
			{CW_MB_BOOK_DELETE}
		</td>
	</tr>";

$CREATIVE_WRITER_TEMPLATE['mybooks']['end'] = "
    <tr>
		<td colspan='2' class='forumheader2' >" . CWRITER_212 . "
		<span class='btn btn-xs btn-default'><i class='fa fa-2x fa-list-ol'></i> </span>" . LAN_MB_EDIT_CHAPTERS . "
		<span class='btn btn-xs btn-warning'><i class='fa fa-2x fa-pencil'></i> </span>" . LAN_MB_EDIT_BOOK . "		
		<span class='btn btn-xs btn-danger'><i class='fa fa-2x  fa-times'></i> </span>". LAN_MB_DELETE_BOOK ."
		</td>
	</tr>
    <tr>
		<td colspan='2' class='fcaption' >&nbsp;</td>
	</tr>
</table>";

$CREATIVE_WRITER_TEMPLATE['mychapters']['breadcrumbs'] = '{CW_BREADCRUMBS}';
$CREATIVE_WRITER_TEMPLATE['mychapters']['start'] = '
<div class="managebook"> {CW_ADMIN_NEWCHAPTER}</div> 
<table class="fborder" style="width:100%;">
	<tr>
    <td class="fcaption" style="width:5%;">' . CWRITER_304 . '</td>
		<td class="fcaption" style="width:70%;">' . CWRITER_301 . '</td>
		<td class="fcaption" style="width:25%;text-align:center;">' . CWRITER_302 . '</td>
	</tr>
';

$CREATIVE_WRITER_TEMPLATE['mychapters']['end'] = "
    <tr>
		<td colspan='3' class='forumheader2' >" . CWRITER_212 . " 
		<span class='btn btn-xs btn-warning'><i class='fa fa-2x fa-pencil'></i> </span>" . CWRITER_214 . "		
		<span class='btn btn-xs btn-danger'><i class='fa fa-2x  fa-times'></i> </span>". CWRITER_215 ."
		</td>
	</tr>
    <tr>
		<td colspan='3' class='fcaption' >&nbsp;</td>
	</tr>
</table>";