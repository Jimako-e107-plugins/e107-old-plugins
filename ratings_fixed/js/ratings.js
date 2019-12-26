/**
 * @Author: Luca Filosofi > {aSeptik} @gmail.com (c) '09
 * @Release Date: 29.09.2009
 * @Last Update: 19.12.2009
 *
 */
var $J = jQuery.noConflict();
/**
  * ajax location for e107
  *  
  */




/**
 * Rate function
 *
 */
function rateThis(parameterString, id) {
          
    var query = 'action=ratings&query=' + parameterString;

    $J('#response-' + id).fadeOut(200);
    
    $J.ajax({
        type: 'POST',
        url: rating_url.loc() + 'ajax.php',
        data: query,
        cache: false,
        complete: function(data) {

            $J('#response-' + id).html(data.responseText).fadeIn(200);
        },
        error: function() {
            alert('Ajax Request ' + query + ' Error!');
            //handle if error!
        }
    });

    return false;

};