
function eclassf_checkAll(checkWhat) {
  // Find all the checkboxes...
  var inputs = document.getElementsByTagName('input');

  // Loop through all form elements (input tags)
  for(index = 0; index < inputs.length; index++)
  {
    // ...if it's the type of checkbox we're looking for, toggle its checked status
    if(inputs[index].id == checkWhat)
      if(inputs[index].checked == 0)
      {
        inputs[index].checked = 1;
      }
      else if(inputs[index].checked == 1)
      {
        inputs[index].checked = 0;
      }
  }
}
/**
 *
 * @access public
 * @return void
 **/
function eclassf_checkcat(){
	var eclassf_adcat_ok=true;
	var eclassf_adcat_msg='<ul>';
	$('eclassf_catname').removeClassName('redit');

	if($F('eclassf_catname')==''){
		$('eclassf_catname').addClassName('redit');
		eclassf_adcat_ok=false;
		eclassf_adcat_msg ='<li>The category name is missing</li>';

	}
	eclassf_adcat_msg = eclassf_adcat_msg + '</ul>';
	if(!eclassf_adcat_ok){
		fb_message_box('validation',eclassf_adcat_msg);
	}
	return eclassf_adcat_ok;
}
function eclassf_checksubcat(){
	var eclassf_adcat_ok=true;
	var eclassf_adcat_msg='<ul>';
	$('eclassf_subname').removeClassName('redit');

	if($F('eclassf_subname')==''){
		$('eclassf_subname').addClassName('redit');
		eclassf_adcat_ok=false;
		eclassf_adcat_msg ='<li>The category name is missing</li>';
	}
	eclassf_adcat_msg = eclassf_adcat_msg + '</ul>';
	if(!eclassf_adcat_ok){
		fb_message_box('validation',eclassf_adcat_msg);
	}
	return eclassf_adcat_ok;
}
//Preloaded slideshow script- By Jason Moon
//For this script and more
//Visit http://www.dynamicdrive.com

// PUT THE URL'S OF YOUR IMAGES INTO THIS ARRAY...
var Slides = new Array('image1.gif','image2.gif','image3.gif');

// DO NOT EDIT BELOW THIS LINE!
function CacheImage(ImageSource) { // TURNS THE STRING INTO AN IMAGE OBJECT
   var ImageObject = new Image();
   ImageObject.src = ImageSource;
   return ImageObject;
}

function ShowSlide(Direction) {
   if (SlideReady) {
      NextSlide = CurrentSlide + Direction;
      // THIS WILL DISABLE THE BUTTONS (IE-ONLY)
      document.SlideShow.Previous.disabled = (NextSlide == 0);
      document.SlideShow.Next.disabled = (NextSlide ==
(Slides.length-1));
 if ((NextSlide >= 0) && (NextSlide < Slides.length)) {
            document.images['Screen'].src = Slides[NextSlide].src;
            CurrentSlide = NextSlide++;
            Message = 'Picture ' + (CurrentSlide+1) + ' of ' +
Slides.length;
            self.defaultStatus = Message;
            if (Direction == 1) CacheNextSlide();
      }
      return true;
   }
}

function Download() {
   if (Slides[NextSlide].complete) {
      SlideReady = true;
      self.defaultStatus = Message;
   }
   else setTimeout("Download()", 100); // CHECKS DOWNLOAD STATUS EVERY 100 MS
   return true;
}

function CacheNextSlide() {
   if ((NextSlide < Slides.length) && (typeof Slides[NextSlide] ==
'string'))
{ // ONLY CACHES THE IMAGES ONCE
      SlideReady = false;
      self.defaultStatus = 'Downloading next picture...';
      Slides[NextSlide] = CacheImage(Slides[NextSlide]);
      Download();
   }
   return true;
}

function StartSlideShow() {
   CurrentSlide = -1;
   Slides[0] = CacheImage(Slides[0]);
   SlideReady = true;
   ShowSlide(1);
}