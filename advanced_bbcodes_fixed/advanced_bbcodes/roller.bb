/*
+---------------------------------------------------------------+
|        Plugin: Advanced BBcodes - Roller
|        Version: 0.4
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

echo '<div>
<script type="text/javascript">

/*
Roller Coaster Script-
By JavaScript Kit
Over 200+ free scripts here!
*/

var fs=1
var direction="right"
function rollertext(whichone){
var thetext=whichone
for (i=0;i<thetext.length;i++){
document.write(thetext.charAt(i).fontsize(fs))

if (fs<7&&direction=="right")
fs++
else if (fs==7){
direction="left"
fs--
}
else if (fs==1){
direction="right"
fs++
}
else if (fs>1&&direction=="left")
fs--

}
}
//Change below text to your won
rollertext("'.$code_text.'")
</script>
</div>';