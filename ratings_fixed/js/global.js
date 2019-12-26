var rating_url = new
function() {

    var js_path = document.getElementById('ratings_js').src;

    this.loc = function() {

        var ajax_path = js_path.substring(0, js_path.lastIndexOf('/') - 2);

        return ajax_path;

    };

}