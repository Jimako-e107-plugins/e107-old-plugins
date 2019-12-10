<?php      

$Books    =  e107::pref('creative_writer', 'bookterm_01') ? e107::pref('creative_writer', 'bookterm_01') : 'Books'; 
$Book     =  e107::pref('creative_writer', 'bookterm_02') ? e107::pref('creative_writer', 'bookterm_02') : 'Book';
$books    =  e107::pref('creative_writer', 'bookterm_03') ? e107::pref('creative_writer', 'bookterm_03') : 'books'; 
$book     =  e107::pref('creative_writer', 'bookterm_04') ? e107::pref('creative_writer', 'bookterm_04') : 'book';
$Chapters =  e107::pref('creative_writer', 'chapterterm_01') ? e107::pref('creative_writer', 'chapterterm_01') : 'Chapters';
$Chapter  =  e107::pref('creative_writer', 'chapterterm_02') ? e107::pref('creative_writer', 'chapterterm_02') : 'Chapter';
$chapters =  e107::pref('creative_writer', 'chapterterm_03') ? e107::pref('creative_writer', 'chapterterm_03') : 'chapters'; 
$chapter  =  e107::pref('creative_writer', 'chapterterm_04') ? e107::pref('creative_writer', 'chapterterm_04') : 'chapter';
               

define('CWRITER_01',"Creative Writing");
define('CWRITER_02',"Available ".$Books );
define('CWRITER_02a',"No available ".$Books );
define('CWRITER_03',"No categories defined");
define('CWRITER_04',"All Categories");
define('CWRITER_05',"All Genres");
define('CWRITER_06',"No genres defined");
define('CWRITER_07',"Any Character");
define('CWRITER_08',"No characters defined");
define('CWRITER_09',"Either");
define('CWRITER_10',"Incomplete");
 
define('CWRITER_16',"Cost");
define('CWRITER_17',"Either");
define('CWRITER_18',"No Cost");
define('CWRITER_19',"Chargeable");
define('CWRITER_20',"Any Author");
 
define('CWRITER_22',"Any");
define('CWRITER_23',"No Authors defined");
 
define('CWRITER_32',"Manage my ".$Books);
define('CWRITER_46',"Price to view complete book");
 
define('CWRITER_62',"Picture");
define('CWRITER_63',"Biography");
define('CWRITER_64',"Email");
define('CWRITER_65',"Contact details");
define('CWRITER_66',"Back to book list");
define('CWRITER_67',"Completed");
define('CWRITER_68',"Book Logo");
define('CWRITER_69',"Back to ".$book." details");
define('CWRITER_70',"Invalid ".$Chapter);
define('CWRITER_71',"Back to ".$Chapter." List");
define('CWRITER_72',"Create PDF of book");
define('CWRITER_73',"Email link to a friend");
define('CWRITER_74',"Creative writer e_book. Title");
 
define('CWRITER_76',"Views");
define('CWRITER_77',"words");


// MyBooks
//define('CWRITER_200',"Administer My ".$Books);

define('CWRITER_202',"Action");
define('CWRITER_203',"New ".$Book);
define('CWRITER_204',"Completed");
define('CWRITER_205',"Allow this ".$book." to be rated");
define('CWRITER_206',"Allow comments on this ".$book);
define('CWRITER_207',"Save");
define('CWRITER_208',"One off or part of a series");

define('CWRITER_212',"Key:");
define('CWRITER_213',"Back to list of books");
define('CWRITER_214',"Edit Chapter");
define('CWRITER_215',"Delete Chapter");

define('CWRITER_217',"Be the first to review this book.");
define('CWRITER_218',"View the book reviews");
define('CWRITER_219',"Book reviews on");
define('CWRITER_220',"Book review posted by");
define('CWRITER_221',"on");
define('CWRITER_222',"Write your review");
define('CWRITER_223',"Your review");
define('CWRITER_224',"Submit Review");
define('CWRITER_225',"You have no permission to see this option");

// MyChapters  DUPLICITY, no file mychapters

define('CWRITER_301',$Chapter." Title");
define('CWRITER_302',"Action");
define('CWRITER_303',"New ".$Chapter);

//define('CWRITER_305',"Allow this book to be rated");   DUPLICITY,
//define('CWRITER_306',"Allow comments on this book");   DUPLICITY,
//define('CWRITER_307',"Save");                         DUPLICITY,
define('CWRITER_308',"One off or part of a series");
define('CWRITER_309',$Chapter." Number");
define('CWRITER_310',$Chapter." Title");
define('CWRITER_311',"Pay for this ".$Chapter);
define('CWRITER_312',$Chapter." Body");
define('CWRITER_313',"Created");
define('CWRITER_314',"Last Updated");
define('CWRITER_315',$Chapter." Word Count");
define('CWRITER_316',"Views");
 
define('CWRITER_318',$Book."Title");
 
define('CWRITER_320',"Found in ".$Book);
					/*    used in search.php bug
define('ECLASSF_69', 'Found in advert :');
define('ECLASSF_70', 'Category');
define('ECLASSF_71', 'Description');
define('ECLASSF_72', 'Advert expires');  */
                /*
define('CWRITER_A1',"Creative Writer"); global
define('CWRITER_A2',"Creative Writer Menu");
define('CWRITER_A3',"Configuration");
define('CWRITER_A4',"Administer Genres");
define('CWRITER_A5',"Administer Images");
define('CWRITER_A6',"Administer Reviews");
define('CWRITER_A7',"Check for Updates");
define('CWRITER_A8',"Administer Categories");
define('CWRITER_A9',"Genre");
define('CWRITER_A10',"Genre Name");
                 */
                 /*
define('CWRITER_A11',"Genre Icon");
define('CWRITER_A12',"Genre Updated");
define('CWRITER_A13',"Genre in use - cannot delete");
define('CWRITER_A14',"Genre Deleted");
define('CWRITER_A15',"Confirm the deletion");
define('CWRITER_A16',"Unable to delete genre");
define('CWRITER_A17',"Edit Genre");
define('CWRITER_A18',"No Genres Defined");
define('CWRITER_A19',"Action");
define('CWRITER_A20',"Edit");
define('CWRITER_A21',"New");
define('CWRITER_A22',"Delete");
define('CWRITER_A23',"Confirm");
define('CWRITER_A24',"Update");


define('CWRITER_A25',"Approval Required for books");
define('CWRITER_A26',"Yes");
define('CWRITER_A27',"No");
define('CWRITER_A28',"Create Book Class");
define('CWRITER_A29',"Read Class");

 
 
define('CWRITER_A32',"Category Name");
define('CWRITER_A33',"Category Icon");
define('CWRITER_A34',"Category in use - cannot delete");
//define('CWRITER_A35',"Category Deleted");
 //define('CWRITER_A36',"Unable to delete category");
define('CWRITER_A37',"Edit Category");
define('CWRITER_A38',"Category Updated");
define('CWRITER_A39',"Read class");

define('CWRITER_A40',"Administer Images");
define('CWRITER_A41',"Image");
define('CWRITER_A42',"Delete");
define('CWRITER_A43',"Toggle");
define('CWRITER_A44',"Update");
define('CWRITER_A45',"No unassociated images");
define('CWRITER_A46',"Updated");
define('CWRITER_A47',"Images");
define('CWRITER_A48',"Administrator Class");
define('CWRITER_A49',"Date Format for calendar control");
define('CWRITER_A50',"Use ratings for books");
define('CWRITER_A51',"Use icons");
define('CWRITER_A52',"Display thumbnails");
define('CWRITER_A53',"Thumbnail Height");
define('CWRITER_A54',"Picture Height");
define('CWRITER_A55',"Picture Width");
define('CWRITER_A56',"Currency Symbol");
define('CWRITER_A57',"Books per page in list");
define('CWRITER_A58',"Terms and Conditions");
define('CWRITER_A59',"Meta tag description (leave blank for e107 default)");
define('CWRITER_A60',"Meta tag keywords (leave blank for e107 default)");
define('CWRITER_A61',"Save Changes");
define('CWRITER_A62',"Changes saved");
define('CWRITER_A63',"Use Comments on Books");
define('CWRITER_A64',"Configure Creative Writer");
define('CWRITER_A65',"Please go to the plugin configuration panel to configure Creative Writer.");
define('CWRITER_A66',"Use comments for books.");
define('CWRITER_A66A',"Use reviews for books.");
define('CWRITER_A67',"Display this book");
define('CWRITER_A68',"Book approved");
define('CWRITER_A69',"New book created");
define('CWRITER_A70',"Member");
define('CWRITER_A71',"Created a new book titled");
define('CWRITER_A72',"The book's ID is");
define('CWRITER_A73',"Books to be approved");
define('CWRITER_A74',"Books on system");
define('CWRITER_A75',"Creative Writer");
define('CWRITER_A76',"Book");   */
define('CWRITER_A77',"No Chapters/books");    // needed in RSS
define('CWRITER_A78',"Creative Writer ".$Chapters);   // needed in RSS
/*
define('CWRITER_A79',"Goto Books");     */
define('CWRITER_A80',"You are deleting chapter");
define('CWRITER_A81',"Cancel");
define('CWRITER_A82',"Delete");
define('CWRITER_A83',"Administer ".$Book);
define('CWRITER_A84',"You are Deleting ".$Book);
define('CWRITER_A85',"and all");
define('CWRITER_A86', $chapters); 
define('CWRITER_A87',"Book Logo/Picture");
define('CWRITER_A88',"Delete Picture");
define('CWRITER_A89',"Upload a picture");   /*
define('CWRITER_A90',"Author's Picture");
define('CWRITER_A91',"Save");
define('CWRITER_A92',"No biography for this author");
define('CWRITER_A93',"Book Pictures");
define('CWRITER_A94',"Biography Pictures");*/
                        

define('CWRITER_P01',"Created by Father Barry's Creative Writer Plugin for e107");
define('CWRITER_P02',"Creative Writer e_Book");
define('CWRITER_P03',"Contents");
define('CWRITER_P04',"Preface");
define('CWRITER_P05',"About the Author");
define('CWRITER_P06',"Biography");
define('CWRITER_P07',"Contact Details");
define('CWRITER_P08',"Email Address");
define('CWRITER_P09',"About the Book");
define('CWRITER_P10',"Summary");     /*  LAN_BOOK_035 */
define('CWRITER_P11',"Copyright and Disclaimer");
define('CWRITER_P12',"Warnings");
define('CWRITER_P13',"Information");
define('CWRITER_P14',"This book is found in the");
define('CWRITER_P15',"and");
define('CWRITER_P16',"genre");
define('CWRITER_P17',"Book created on");
define('CWRITER_P18',"Book last updated on");
define('CWRITER_P19',"The book contains");
define('CWRITER_P20',"chapters");
define('CWRITER_P21',"This book has");
define('CWRITER_P22',"words");
define('CWRITER_P23',"To download your own copy of the e_book visit");
define('CWRITER_P24',"Creative Writer");
define('CWRITER_P25',"This book was downloaded from");
define('CWRITER_P26',"where many more e_books can be found.");
define('CWRITER_P27',$Chapter);
define('CWRITER_P28',"Biography");
define('CWRITER_P29',"Biography");
define('CWRITER_P30',"Biography");


define('CWRITER_T01',"Views");
define('CWRITER_T02',"Rating");
define('CWRITER_T03',"from");
define('CWRITER_T04',"Votes");
define('CWRITER_T05',"Books published");
define('CWRITER_T06',"Top Books by Views");
define('CWRITER_T07',"Top Books by Rating");
define('CWRITER_T08',"Most Prolific Authors");
define('CWRITER_T09',"Top Categories by views");
define('CWRITER_T10',"Top Genres by views");
define('CWRITER_T11',"Top Categories by Books");
define('CWRITER_T12',"Top Genres by Books");
define('CWRITER_T13',"Books");
define('CWRITER_T14',"");

define('ECLASSF_A28', "Changes Saved");
define('ECLASSF_A3',"Categories");
define('ECLASSF_A17',"Classifieds Categories");
  
define('ECLASSF_A19',"Action");
define('ECLASSF_A20',"Edit");
define('ECLASSF_A21',"New");
define('ECLASSF_A22',"Delete");
define('ECLASSF_A23',"Confirm");
define('ECLASSF_A24',"Update");
define('ECLASSF_A25',"Category Name");
define('ECLASSF_A26',"Category Description");
define('ECLASSF_A27',"Category read class");
define('ECLASSF_95',"Icon");
           /*
define('CWRITER2_A5',"Submissions");
define('CWRITER2_A82',"Submitted Books");
define('CWRITER2_A83',"Approve");
define('CWRITER2_A84',"Delete");
define('CWRITER2_A85',"Book");
 
 
define('CWRITER2_A88',"Update");
define('CWRITER2_A89',"There are no books for approval");
define('CWRITER2_A90',"Toggle");
define('CWRITER2_A91',"Updates made");
              
define('CWRITER2_A92',"Administer Characters"); 
define('CWRITER2_A97',"Administer Books");
define('CWRITER2_A93',"Add new character");
define('CWRITER2_A94',"Add new genre");
define('CWRITER2_A95',"Add new category");
define('CWRITER2_A96',"Add new book");

define('CWRITER2_A98',"Add new chapter");
define('CWRITER2_A99',"Administer Chapters");
define('CWRITER2_A100',"Administer Reviews");
               */
               
/* manage books */
define('CWRITER_A67',"Display this ".$book);
define('CWRITER_A68',$Book." approved");

               
/* menu */               
define('LAN_CWRITER_97',"Edit my profile");


define('LAN_CHALLENGE_001', "Challenges");
define("LAN_CHALLENGE_002", "Only Admins see this.");
define("LAN_CHALLENGE_003", "All Challenges");     /* del */
define('LAN_CHALLENGE_004', "Challenge");

define("LAN_CHAPTER_001", $Chapters);
define('CWRITER_304',$Chapter); /* DEL */
define('LAN_CHAPTER_NAME', $Chapter);
 
define("LAN_CHAPTER_003", "All ".$chapters);



define('LAN_CHAPTER_009', $Book." Information");
define('LAN_CHAPTER_010', $Chapter." Information");
define('LAN_CHAPTER_049', "Next ".$chapter);
define('LAN_CHAPTER_050', "Previous ".$chapter);

define('LAN_CATEGORY_001',"No categories defined");

/* admin terms on frontentd */
define('LAN_MB_ADD_NEW_BOOK',"Add new ".$Book);
define('LAN_MB_ADD_NEW_CHAPTER',"Add new ".$Chapter);
define('LAN_MB_ADMINISTER_BOOKS',"Administer My ".$Books);   /*CWRITER_200*/
define('LAN_MB_ADMINISTER_CHAPTERS_IN_BOOK',"Administer ".$Chapters." in ".$Book);   /*CWRITER 300*/
define('LAN_MB_DELETE_BOOK',"Delete ".$Book); /*CWRITER_211*/
define('LAN_MB_EDIT_BOOK',"Edit ".$Book);  /*CWRITER_210*/
define('LAN_MB_EDIT_CHAPTERS',"Edit ".$Chapters);/*CWRITER_209*/

 


/*  general terms */
define('LAN_CW_BACK_TO_HOME', "Back to list of books");  
define('LAN_CW_BOOK', $Book);  
define('LAN_CW_CATEGORY', $Book." Category");
define('LAN_CW_SAVE', "Save");    
define("LAN_CW_ONLY_ADMINS", "Only Admins see this.");   
define("LAN_CW_ALL_CHALLENGES", "All Challenges"); 
define("LAN_CW_NO_CHALLENGES", "No challenges defined");  
define('LAN_CW_ALL_CATEGORIES',"All categories");     
define('LAN_CW_ALL_NO_CATEGORIES',"No categories defined");   
define('LAN_CW_ALL_CATEGORIES',"All Categories");   
define('LAN_CW_ALL_GENRES',"All Genres");       
define('LAN_CW_NO_GENRES',"No genres defined");    
define('LAN_CW_ANY_CHARACTER',"Any Character");   
define('LAN_CW_NO_CHARACTER',"No characters defined");
define('LAN_CW_EITHER',"Either");
define('LAN_CW_INCOMPLETE',"Incomplete");

// really sorry but LANs with numbering is too difficult to manage */
// LAN_name =  Shortcode CW_name 

define('LAN_BOOK_AUTHOR', "Author");
define('LAN_BOOK_CATEGORY', "Category");    
define('LAN_BOOK_COMPLETE',"Completed");         
define('LAN_BOOK_COMPLETION',"Completion");        
define('LAN_BOOK_CREATED', "Created");
define('LAN_BOOK_DETAILS', $Book." Details");      
define('LAN_BOOK_DISCLAIMER', "Copyright / disclaimer");    
define('LAN_BOOK_DISPLAY', "Display this book"); 
define('LAN_BOOK_EXTERNAL', "External");
define('LAN_BOOK_EXTERNAL_SOURCE', "External Source");   
define('LAN_BOOK_FILTER', "Filter");    
define('LAN_BOOK_GENRE', "Genre");            
define('LAN_BOOK_CHALLENGE', "Challenge");
define("LAN_BOOK_CHAPTERS", $Chapters);
define('LAN_BOOK_CHARACTER', "Character");   
define('LAN_BOOK_CHARACTERS', "Characters");
define('LAN_BOOK_IS_APPROVED', "Book approved");   
define('LAN_BOOK_IS_COMMENTED', "Allow comments on this ".$book);     
define('LAN_BOOK_IS_RATED', "Allow this ".$book." to be rated");    
define('LAN_BOOK_LASTUPDATE',"Last updated");   
define('LAN_BOOK_PART_OF_SERIES', "One off or part of a series");     
define('LAN_BOOK_SUMMARY', "Summary");
define('LAN_BOOK_RATING',"Rating");   
define('LAN_BOOK_REVIEW',"Reviews");  
define('LAN_BOOK_TITLE',"Title");  
define('LAN_BOOK_VIEWS',"Views");            
define('LAN_BOOK_UNIQUE', "Unique");         
define('LAN_BOOK_WARNINGS', "Warnings");
define('LAN_BOOK_WORDCOUNT', "Word Count"); 

define("LAN_CHAPTER_CREATED", "Created" );
define('LAN_CHAPTER_LASTUPDATE', "Last updated");
define("LAN_CHAPTER_VIEWS", "Views" );
define('LAN_CHAPTER_WORDCOUNT', "Word Count"); 

define('LAN_COMMENT_DISCUSSION', "Discussion"); 
define('LAN_COMMENT_BYE107', "Comment by this site"); 
define('LAN_COMMENT_BYFB', "Comment by Facebook"); 

define('LAN_BOOK_003', "Rating is not allowed");
define('LAN_BOOK_004', "Reviews are not allowed");
 
define('CWRITER_53',"Not yet rated");
define('CWRITER_54',"vote.");
define('CWRITER_55',"votes.");
define('CWRITER_56',"Please rate this book");
define('CWRITER_57',"Not yet rated");
define('CWRITER_58',"Thank you for rating");

 
 