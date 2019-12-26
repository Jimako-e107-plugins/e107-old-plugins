/**
 * @Author: Luca Filosofi > {aSeptik} @gmail.com (c) '09
 * @Release Date: 29.09.2009
 * @Last Update: 19.12.2009
 *
 */
//var $J = jQuery.noConflict();
/**
  * ajax location for e107
  *  
  */

var e107 = e107 || {'settings': {}, 'behaviors': {}};


jQuery(function ($) {

    // preferences
  var ratingsOpts = e107.settings.ratings;
   var js_path = ratingsOpts.js_path;   
 
   var rating_url = js_path.substring(0, js_path.lastIndexOf('/') - 2); 
 

});


/**
 * Rate function
 *
 */
function rateThis(parameterString, id) {
          
    var query = 'action=ratings&query=' + parameterString;

    // preferences
  var ratingsOpts = e107.settings.ratings;
   var js_path = ratingsOpts.js_path;   
 
   var rating_url = js_path.substring(0, js_path.lastIndexOf('/') - 2);  
     console.log(rating_url);
    $('#response-' + id).fadeOut(200);
    
    $.ajax({
        type: 'POST',
        url: rating_url  + 'ajax.php',
        data: query,
        cache: false,
        complete: function(data) {

            $('#response-' + id).html(data.responseText).fadeIn(200);
        },
        error: function() {
            alert('Ajax Request ' + query + ' Error!');
            //handle if error!
        }
    });

    return false;

};

