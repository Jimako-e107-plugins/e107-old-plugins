PView Gallery Template: Galleriffic1
Autor: R.F. Carter

DHTML Template, basierend auf dem Galleriffic Script (Standard)

Merkmale:
- Galerie Ansicht mit Album-Vorschaubild
- Album Ansicht mit Thumbnails und direkter Ansicht von Bildern
- Bild Ansicht mit Bild in Resizegröße, Bilddetails, Kommentareingabe, Bewertungsmöglichkeit
- Nicht alle Layout Optionen stehen zur Verfügung -> typisches Galleriffic Layout (fade in/out, mouseover Effekte)
- Spezielle Anzeigevarianten in der Album Ansicht nicht verfügbar (Galeriebilder)
- Kategorie Ansicht mit den aktuellsten Bildern
- User Ansicht mit den aktuellsten Bildern
- Mindestbreite für die Galerie beachten: 680px
- Einstellmöglichkeiten für Thumbnail Größe, Höhe und Breite (in Datei: usertemplate.php -> array $g1()) siehe unten
- Spalten im Album = nav_width / th_width(Ränder beachten!)

Beispiele zur Einstellung
--------------------------------------------

Box Breite 920px, drei Spalten Thumbnails in Albumansicht:
-----------------------------------------------------------
// Special Settings for this template
$g1 = array('th_height'=>'height:70px; ','th_width'=>'width:70px; ','img_width'=>'600px','cont_width'=>'610px','img_height'=>'400px','cont_height'=>'410px','nav_width'=>'280px','gal_height'=>'550px');

Box Breite 680px, zwei Spalten Thumbnails in Albumansicht:
-----------------------------------------------------------
// Special Settings for this template
$g1 = array('th_height'=>'height:80px; ','th_width'=>'width:80px; ','img_width'=>'450px','cont_width'=>'460px','img_height'=>'400px','cont_height'=>'410px','nav_width'=>'200px','gal_height'=>'550px');

Box Breite 1100px, vier Spalten Thumbnails in Albumansicht:
-----------------------------------------------------------
// Special Settings for this template
$g1 = array('th_height'=>'height:70px; ','th_width'=>'width:70px; ','img_width'=>'600px','cont_width'=>'610px','img_height'=>'400px','cont_height'=>'410px','nav_width'=>'280px','gal_height'=>'550px');