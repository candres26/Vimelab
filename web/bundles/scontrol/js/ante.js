var $flagCan = '';
var $idPaci = '';

/* ### -+- MANEJO DE PARCIALES -+- ### */

function showPartial(event)
{
	show("vime-vitral");
	show("jsGenPar");
}

function hidePartial(event)
{	
	hide("jsGenPar");
	hide("vime-vitral");
	
	hide('dvPaci');
	hide('dvIfra');	
}

/* ### -+- MANEJO DE INTERNAL FRAMES -+- ### */

function goIf(ifUrl)
{
	gId("ifGen").contentWindow.location = ifUrl;
}

function reloadIf(event)
{
	gId("ifGen").contentWindow.location.reload();
}

function sendIf(event)
{
	ifSimularClick("ifGen", "sender");
}

function redoIf(event)
{
	if($flagCan == 'paci')
	{
		hide('dvIfra');
		show('dvPaci');
	}
}

function loadState(event)
{
	var msg = gIf(this.id, "RMSG").value;
	
	if(msg != "LOAD" && msg != "NONE")
	{
		var par = msg.split("-");
		popup(par[1]);
		
		if($flagCan == 'paci')
		{
			gId("jsPaciScCam").value = par[2];
			getPaci(event);
			redoIf(); 
		}
	}
}

/* ### -+- MANEJO DE PACIENTES -+- ### */

function partialPaci(event)
{
	show('dvPaci');
	showPartial();
}

function formPaci(event)
{
	$flagCan = 'paci';
	goIf($_newPaci);
	hide("dvPaci");
	show("dvIfra");
}

function getPaci(event)
{
	if(event.type == "load" || event.type == "click" || (event.type == "keypress" && event.keyCode == 13))
	{
		if(gId("jsPaciScCam") != "")
		{
			ajaxAction
			(
				new Hash(["param => jsPaciScCam"]),
				$_getPaci,
				setPaci
			);
		}
		else
			popup("Debe indicar un parámetro de busqueda!");
	}
}

function setPaci(response)
{
	var cont = '';
	if(response.responseText != "{}")
	{
		cont = "<table ondblclick='loadPaci(event)'>"
		
		var casos = ofJail(response.responseText);
		var l = casos.length;
		for(var i = 0; i < l; i ++)
		{
			var uni = casos[i];
			cont += "<tr title='Doble Click Para Cargar!'><th>"+uni[0]+"</th><td>"+uni[1]+"</td><td>"+uni[2].toUpperCase()+"</td><td>"
					+uni[3].toUpperCase()+"</td><th>"+uni[4].toUpperCase()+"</th><th>"+uni[5]+"</th><th>"+uni[6].toUpperCase()+"</th><th>"+uni[7]+"</th></tr>";
		}
		
		cont += "</table>";	
	}
	else
		cont = "<b>NO SE HALLARON COINCIDENCIAS</B>";
	
	gId("jsPaciZn").innerHTML = cont;
}

function loadPaci(event)
{
	var datos = event.target.parentNode.cells;
	$idPaci = datos[0].innerHTML;
	gId("jsPaciName").innerHTML = datos[2].innerHTML; 	
	gId("jsPaciDocu").innerHTML = datos[1].innerHTML;
	gId("jsPaciSexo").innerHTML = datos[4].innerHTML;	 	
	gId("jsPaciNaci").innerHTML = datos[7].innerHTML;	 	
	gId("jsPaciPtra").innerHTML = datos[6].innerHTML;	 	
	gId("jsPaciSucu").innerHTML = datos[3].innerHTML;
	
	hidePartial();	
}
