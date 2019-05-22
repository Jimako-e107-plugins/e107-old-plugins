<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/languages/English_notice.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:18 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
$notice_complete = "
This management system gives you the opportunity to keep the state of the loans of the documents of the {SITENAME} library.
<p>
The advanced options are controled by the group <i>{$biblio_admin1}</i>. <br />
This group also manage the members of the group <i>{$biblio_admin2}</i>.<br />
The loans are managed by the group <i>{$biblio_admin1}</i>".($biblio_admin2 != '' ? " and <i>{$biblio_admin2}</i>":"").". <br />
</p>
<p>
The loans can be declared by the members of the group <i>{$biblio_admin1}</i>".($biblio_admin2 != '' ? " or <i>{$biblio_admin2}</i>":"").".<br />
There is the possibility to declare its loans themself being {$biblio_membre} if the option is activated. (Currently <strong>".(($pref['biblio_perm_emprunt'] == '1') ? ACTIVE:NOTACTIVE)."</strong>)
</p>
<fieldset><legend><em><u>To declare a loan</u></em></legend>
You must access the option <strong><em>{BIBLIO_OPTION_2}</em></strong>.
<hr align='center' width='50%' />
<ul>
  <li>You are a <strong>member of {$biblio_admin1} or {$biblio_admin2}</strong> ?
    <ol>
      <li>You must <strong>select the loaner</strong> in the proposed list. </li>
      <li>Vous devez ensuite <strong>sélectionner les documents empruntés</strong>.      </li>
      <ul>
        <li>NB. For this operation, you'll be <strong>assisted by an <em>autocomplete function</em></strong>.<br />
          You'll only need to enter a few characters of the title OR the subtitle OR the author name, so that the system sort all the entries of the database and send you back only the documents containing the indicated characters.<br />
          This operation is automatic. You can test it with the search function under the options. It's working on the same basis...</li>
        <li>You only have to select the document by highlighting it and pressing <strong><em>Enter.</em></strong></li>
        <li>You'll be able to add as many documents that you wish in this field. Don't modify the returned titles in the textarea !! </li>
      </ul>
      <li>Clic on Save the loans </li>
    </ol>
  </li>
</ul>
<hr align='center' width='50%' />
<ul>
  <li>You are a <strong>{$biblio_membre}</strong> and the option <strong>declare your loans yourself is activated</strong> ?
    <ol>
      <li>You must then <strong>select THE loaned document</strong>.
        <ul>
        <li>NB. For this operation, you'll be <strong>assisted by an <em>autocomplete function</em></strong>.<br />
          You'll only need to enter a few characters of the title OR the subtitle OR the author name, so that the system sort all the entries of the database and send you back only the documents containing the indicated characters.<br />
          This operation is automatic. You can test it with the search function under the options. It's working on the same basis...</li>
        <li>You only have to select the document by highlighting it and pressing <strong><em>Enter.</em></strong></li>
          <li><strong><em>You'll only be able to loan one document at a time</em></strong>. Don't modify the returned titles in the textarea !!</li>
        </ul>
      </li>
      <li>Clic on Save the loans.</li>
    </ol>
  </li>
</ul>
</fieldset>
<p>
The returns may be declared by the members of the group <i>{$biblio_admin1}</i> or <i>{$biblio_admin2}</i>.<br />
There is the possibility to declare yourself your return being {$biblio_membre} if the option is activated. (Currently <strong>".(($pref['biblio_perm_retour'] == '1') ? ACTIVE:NOTACTIVE)."</strong>)
</p>
<fieldset><legend><em><u>To declare the return of document(s)</u></em></legend>
You must access the option <strong><em>".BIBLIO_OPTION_3."</em></strong>.
<hr align='center' width='50%' />
<ul>
  <li>You are a <strong>member of {$biblio_admin1} or {$biblio_admin2}</strong> ? <br />
  	  You have 2 options :
    <ol>
      <li>You must <strong>select the loaner</strong> in the proposed list. </li>
      <ul>
        <li>This list is composed of all the current loaner saved in the database.<br />
          If the loaner is not present, it is because he didn't declared it's loan.</li>
		 <li>The list of documents borrowed by the selected user will then appear. Select the returned documents.</li>
		 <li>A list of this user unreturned documents will appear at the end of this operation. You'll be able to prevent the user of it's remaining loans.</li>
      </ul>
      <li>You'll also be able to put return documents <strong>without knowing the loaner</strong>.      </li>
      <ul>
        <li>Cliqc on the button of selection of the borrowed documents,</li>
		<li>The complete list of the loans saved will be presented,</li>
        <li>Select all the returned documents.</li>
      </ul>
    </ol>
  </li>
</ul>
<hr align='center' width='50%' />
<ul>
  <li>You are a <strong>{$biblio_membre}</strong> and the option <strong>declare your returns is activated</strong> ?
    <ul>
      <li>The list of all your borrowed documents will appear,
      </li>
        <li>Select all the returned documents.</li>
	  <li>A list of your unreturned documents will appear after the operation.</li>
    </ul>
  </li>
</ul>
</fieldset>
<fieldset><legend><em><u>Consult the list of all the loans</u></em></legend>
You must access the option <strong><em>".BIBLIO_OPTION_4."</em></strong>.
<ul>
  <li>The list of all the saved loans and the details of the loaners will be visible.</li>
  <li>You'll be able to automatically post an email to the late user in this page.</li>
</ul>
</fieldset>
<fieldset><legend><em><u>Add documents to the database</u></em></legend>
You must access the option <strong><em>".BIBLIO_OPTION_5."</em></strong>.
<ul>
  <li>You'll be able to enter a maximum of details for the documents.</li>
  <li>Please do so when adding documents.</li>
  <li>You have the ability to create new categories of documents if the proposed categories don't suit the added documents.</li>
</ul>
</fieldset>
<fieldset><legend><em><u>Modify(complet) the informations of a document</u></em></legend>
First do a <strong>search</strong> for the document <strong>by category</strong>.<br />
On the left of the document, you'll find an image <img src='".e_IMAGE."/admin_images/edit_16.png' alt='' />, clic this image to edit the details of the documents.<br />
The <strong>{$biblio_membre}</strong> will be able to modify only the summary of the documents.

</fieldset>


";
?>
