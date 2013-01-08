var $idPaci = '';
var $idFami = '';
var $idLabo = '';
var $idPers = '';

var $flagIf = '';
var $flagTa = false;

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
	gId("ifGen").src = ifUrl;
}

function goIf2(id, ifUrl)
{
	gId(id).src = ifUrl;
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
	if($flagIf == 'paci')
	{
		hide('dvIfra');
		show('dvPaci');
	}
	else
		reloadIf();
}

function loadState(event)
{
	var msg = gIf(this.id, "RMSG").value;
	
	if(msg != "LOAD" && msg != "NONE")
	{
		var par = msg.split("-");
		popup(par[1]);
		
		if($flagIf == 'paci' && par[0] == '0')
		{
			gId("jsPaciScCam").value = par[2];
			getPaci(event);
			redoIf(); 
		}

		if($flagIf == 'fami' && par[0] == '0')
			getFami();

		if($flagIf == 'labo' && par[0] == '0')
			getLabo();
	}
	else if(msg == "LOAD")
	{
		if($flagIf == 'fami')
			gIf("ifGen", "vimelab_scontrolbundle_hsfamitype_mdpaci").value = $idPaci;
		else if($flagIf == 'labo')
			gIf("ifGen", "vimelab_scontrolbundle_hslabotype_mdpaci").value = $idPaci;
		

		if($flagIf == 'wlabo')
			hide("ifGenBar");
		else
			show("ifGenBar");

		show("dvIfra");
		showPartial();
	}
}

function loadState2(event)
{
	var msg = gIf(this.id, "RMSG").value;

	if(msg != "LOAD")
		popup(msg);

	gIf("ifPers", "vimelab_scontrolbundle_hsperstype_mdpaci").value = $idPaci;
}

/* ### -+- MANEJO DE PACIENTES -+- ### */

function partialPaci(event)
{
	show('dvPaci');
	showPartial();
}

function formPaci(event)
{
	$flagIf = 'paci';
	goIf($_newPaci);
	hide("dvPaci");
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
	
	if(gId("jsPaciSexo").innerHTML == 'M')
		gId("jsPaciSexo").innerHTML = 'MASCULINO';
	else
		gId("jsPaciSexo").innerHTML = 'FEMENINO';

	getFami();
	getLabo();
	getPers();

	show("jsFami");
	show("jsLabo");	
	show("jsPers");

	hidePartial();	
}

/* ### -+- MANEJO DE A. FAMILIARES -+- ### */

function getFami(event)
{
	if($idPaci != '')
	{
		ajaxAction
		(
			new Hash(["*paci => "+$idPaci]),
			$_getFami,
			showFami
		);
	}
}

function showFami(response)
{

	if(response.responseText != "{}")
	{	
		var cont = '';

		var casos = ofJail(response.responseText);
		var l = casos.length;
		for(var i = 0; i < l; i ++)
		{
			var uni = casos[i];
			cont += "<tr><th>"+uni[0]+"</th><td>"+uni[1]+"</td><td>"+uni[2].toUpperCase()+"</td><th>"+uni[3]+"</th></tr>";
		}

		gId("jsFamiTab").innerHTML = cont;
	}
	else
		gId("jsFamiTab").innerHTML = "";

	$idFami = '';
	gId("jsFamiDet").value = "";
}

function delFami(event)
{
	if($idFami != '')
	{
		ajaxAction
		(
			new Hash(["*fami => "+$idFami]),
			$_delFami,
			msgFami
		);
	}
	else
		popup("Debe seleccionar un antecedente familiar!");	
}

function msgFami(response)
{
	var parts = response.responseText.split("-");
	popup(parts[1]);

	if(parts[0] == "0")
		getFami();
}

function selFami(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $idFami)
	{
		$idFami = tmp;
		row.style.background = "#C6DCC6";
		
		gId("jsFamiDet").value = row.cells[3].innerHTML; 
	}
	else
	{
		$idFami = '';
		row.style.background = "";
		
		gId("jsFamiDet").value = "";
	}
}

function partialFami(event)
{
	$flagIf = 'fami';
	goIf($_newFami);
}

/* ### -+- MANEJO DE A. Laborales -+- ### */

function getLabo(event)
{
	if($idPaci != '')
	{
		ajaxAction
		(
			new Hash(["*paci => "+$idPaci]),
			$_getLabo,
			showLabo
		);
	}
}

function showLabo(response)
{
	if(response.responseText != "{}")
	{	
		var cont = '';

		var casos = ofJail(response.responseText);
		var l = casos.length;
		for(var i = 0; i < l; i ++)
		{
			var uni = casos[i];
			cont += "<tr><th>"+uni[0]+"</th><td>"+uni[1]+"</td><td>"+uni[2].toUpperCase()+"</td><td>"+uni[3]+"</td></tr>";
		}

		gId("jsLaboTab").innerHTML = cont;
	}
	else
		gId("jsLaboTab").innerHTML = "";

	$idLabo = '';
}

function delLabo(event)
{
	if($idLabo != '')
	{
		ajaxAction
		(
			new Hash(["*labo => "+$idLabo]),
			$_delLabo,
			msgLabo
		);
	}
	else
		popup("Debe seleccionar un antecedente laboral!");	
}

function msgLabo(response)
{
	var parts = response.responseText.split("-");
	popup(parts[1]);

	if(parts[0] == "0")
		getLabo();
}

function selLabo(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $idLabo)
	{
		$idLabo = tmp;
		row.style.background = "#C6DCC6";
	}
	else
	{
		$idLabo = '';
		row.style.background = "";
	}
}

function partialLabo(event)
{
	$flagIf = 'labo';
	goIf($_newLabo);
}

function viewLabo(event)
{
	if($idLabo != '')
	{
		$flagIf = 'wlabo';
		goIf($_basLabo+"/"+$idLabo+"/show/2");		
	}
	else
		popup("Debe seleccionar un antecedente laboral!");	
}

/* ### -+- MANEJO DE A. PERSONALES -+- ### */

function getPers(event)
{
	if($idPaci != '')
	{
		ajaxAction
		(
			new Hash(["*paci => "+$idPaci]),
			$_getPers,
			showPers
		);
	}
}

function showPers(response)
{
	$idPers = response.responseText;
	
	if($idPers != '-1')
		goIf2("ifPers", $_basPers+"/"+$idPers+"/edit/2");
	else
		goIf2("ifPers", $_newPers);
}

function sendPers(event)
{
	ifSimularClick("ifPers", "sender");
}

function redoPers(event)
{
	gId("ifPers").contentWindow.location.reload();	
}

function swTam(event)
{
	if(!$flagTa)
		gId("jsPers").style.height = "94%";
	else
		gId("jsPers").style.height = "";

	$flagTa = !$flagTa;
}