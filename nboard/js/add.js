var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject()
{
  var xmlHttp;
  if (window.ActiveXObject)
  {
    try {
      xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    catch (e) {
      xmlHttp = false;
    }
  }
  else  {
    try  {
      xmlHttp = new XMLHttpRequest();
    }
    catch (e)  {
      xmlHttp = false;
    }
  }
  if (!xmlHttp)
     alert("������ �������� ������� XMLHttpRequest.");
  else
      return xmlHttp;
}

function process()
{
  if (xmlHttp)  {
    try  {
      sel21 = encodeURIComponent(document.getElementById("cat").value);
      xmlHttp.open("POST", "doadd.php?id="+sel21, true);
      xmlHttp.onreadystatechange = handleRequestStateChange;
      xmlHttp.send(null);
    }
    catch (e) {
      alert("���������� ����������� � ��������:\n"+e.toString());
    }
  }
}

function handleRequestStateChange(){
  if (xmlHttp.readyState == 4) {
    if (xmlHttp.status == 200) {
       try {
         handleServerResponse();
       }
       catch (e) {
         alert("������ ������ ������: "+e.toString());
       }
     }
     else {
       alert("�������� �������� �� ����� ��������� ������:\n" + xmlHttp.statusText);
     }
  }
}

function handleServerResponse(){
	var xmlResponse = xmlHttp.responseXML;
	xmlRoot = xmlResponse.documentElement;
	titleArray = xmlRoot.getElementsByTagName("title");
	isbnArray = xmlRoot.getElementsByTagName("isbn");
	sel = document.getElementById("sub");
	sel.options.length = 1;
	for (var i=0; i<titleArray.length; i++) {
		var newOption = new Option("OPTION") ;
		newOption.text = isbnArray.item(i).firstChild.data;  
		newOption.value = titleArray.item(i).firstChild.data ;
		sel.options.add(newOption);
	}
	newOption = null;
}