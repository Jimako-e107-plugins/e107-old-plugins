function confirmDeleteCat() {
	f_cat_id=document.form_select_cat.cat_id.value;
	if ( f_cat_id == '') {
	alert ("Не выбрана запись для удаления");
	} else {
		if (confirm("Вы действительно хотите удалить категорию?")) {
			return true;
		} else {
			return false;
		}
	}
}
function confirmDeleteSubcat() {
	f_cat_id=document.form_select_subcat.cat_id.value;
	if ( f_cat_id == '') {
	alert ("Не выбрана запись для удаления");
	} else {
		if (confirm("Вы действительно хотите удалить под-категорию?")) {
			return true;
		} else {
			return false;
		}
	}
}
function confirmDeleteNotice() {
	    if (confirm("Вы действительно хотите удалить объявление?")) {
       return true;
	    } else {
	        return false;
	    }
	}
function expandit(curobj){
folder=ns6?curobj.nextSibling.nextSibling.style:document.all[curobj.sourceIndex+1].style
if (folder.display=="none")
folder.display=""
else
folder.display="none"
}
function confirmDeleteBan() {
f_ban_id=document.form_banner_edit.ban_id.value;
	if (confirm("Вы действительно хотите удалить банер?")) {
		return true;
	} else {
		return false;
	}
}