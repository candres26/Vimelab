var $idRevi = '';
var $idChec = '';
var $idDeta = '';

var $flagLoad = true;
var $optIni = "<option value='@'>Seleccione...</option>";

/* ### -+- MANEJO DE PARCIALES -+- ### */

function showPartial(id)
{
	show("vime-vitral");
	show(id);
}

function hidePartial(id)
{	
	hide(id);
	hide("vime-vitral");
}

/* ### -+- MANEJO DE INTERNAL FRAMES -+- ### */

function goIf(id, ifUrl)
{
	gId(id).src = ifUrl;
}

function reloadIf(id)
{
	gId(id).contentWindow.location.reload();
}

function sendIf(id)
{
	ifSimularClick(id, "sender");
}

/* ### -+- CONTROL DE CARGA -+- ### */

function loadState(event)
{	
	var noClear = false;

	if($flagLoad)
	{	
		var msg = gIf(this.id, "RMSG").value;
		var par = msg.split("-");

		if(this.id == "ifRevi")
		{
			if(msg == "LOAD")
			{
				hide("dvRevi");
				show("dvIfRevi");
			}
			else
			{		
				popup(par[1]);

				if(par[0] == "0")
				{
					noClear = true;
					gId("jsReviScCam").value = "*"+par[2];
					getRevi(event);
					cancelRevi();
				}
			}
		}
		else if(this.id = "ifChec")
		{
			if(msg == "LOAD")
				gIf("ifChec", "vimelab_scontrolbundle_tcchectype_tcrevi").value = $idRevi;
			else
				popup(par[1]);
		}
	}

	if(!noClear)
		$flagLoad = true;
	else
		noClear = false;
}

/* Revision */

function partialRevi(event)
{
	gId("jsRevTi").innerHTML = "REVISIÓN TÉCNICA";
	show("dvRevi");
	showPartial("jsRevPar");
}

function hideRevi(event)
{
	hidePartial("jsRevPar");
}

function newRevi(event)
{
	goIf("ifRevi", $_newRevi);
}

function createRevi(event)
{
	sendIf("ifRevi");
}

function cancelRevi(event)
{
	$flagLoad = false;
	goIf("ifRevi", "");

	hide("dvIfRevi");
	show("dvRevi");
}

function getRevi(event)
{
	if(event.type == "load" || event.type == "click" || (event.type == "keypress" && event.keyCode == 13))
	{
		if(gId("jsReviScCam") != "")
		{
			ajaxAction
			(
				new Hash(["param => jsReviScCam"]),
				$_getRevi,
				listRevi
			);
		}
		else
			popup("Debe indicar un parámetro de busqueda!");
	}
}

function listRevi(response)
{
	var cont = '';
	if(response.responseText != "{}")
	{
		cont = "<table ondblclick='fixRevi(event)'>"
		
		var casos = ofJail(response.responseText);
		var l = casos.length;
		for(var i = 0; i < l; i ++)
		{
			var uni = casos[i];
			cont += "<tr title='Doble Click Para Cargar!'><th>"+uni[0]+"</th><td>"+uni[1]+"</td><td>"+uni[2].toUpperCase()+"</td><td>"
					+uni[3].toUpperCase()+"</td><th>"+uni[4]+"</th><th>"+uni[5]+"</th><th>"+uni[6]+"</th><th>"+uni[7]+"</th><th>"+uni[8]+"</th></tr>";
		}
		
		cont += "</table>";	
	}
	else
		cont = "<b>NO SE HALLARON COINCIDENCIAS</B>";
	
	gId("jsReviZn").innerHTML = cont;
}

function fixRevi(event)
{
	var datos = event.target.parentNode.cells;
	$idRevi = datos[0].innerHTML;
	$idChec = datos[8].innerHTML;

	gId("jsReviFech").innerHTML = datos[1].innerHTML;
	gId("jsReviSucu").innerHTML = datos[2].innerHTML;
	gId("jsReviPers").innerHTML = datos[3].innerHTML;
	gId("jsReviHini").value = datos[4].innerHTML;
	gId("jsReviHfin").value = datos[5].innerHTML;
	gId("jsReviEntr").value = datos[6].innerHTML;
	gId("jsReviResu").value = datos[7].innerHTML;

	show("jsChec");
	if($idChec != "-1")
		goIf("ifChec", $_basChec+"/"+$idChec+"/edit/2");
	else
		goIf("ifChec", $_newChec);

	getAspe();
	getDeta();
	show("jsDeta");

	gId("jsReviZn").innerHTML = "";
	hideRevi();
}

function foldRevi(event)
{
	if(event.type == "mouseover")
		gId("jsReviFold").style.width = "42px";
	else
		gId("jsReviFold").style.width = "";
}

function resizeRevi(event)
{
	if(gId("jsRevi").style.height != "45%")
		gId("jsRevi").style.height = "45%";
	else
		gId("jsRevi").style.height = "";
}

function updateRevi(event)
{
	if($idRevi != '')
	{	
		ajaxAction
		(
			new Hash(["*id => "+$idRevi, "hini => jsReviHini", "hfin => jsReviHfin", "entr => jsReviEntr", "resu => jsReviResu"]),
			$_updateRevi,
			msgRevi
		);
	}
	else
		popup("No se cargado ninguna revisión!");
}

function msgRevi(response)
{
	popup(response.responseText)
}

/* Chec */

function canChec(event)
{
	if($idChec != "-1")
		goIf("ifChec", $_basChec+"/"+$idChec+"/edit/2");
	else
		goIf("ifChec", $_newChec);
}

function sendChec(event)
{
	sendIf("ifChec");
}

/* Aspectos */

function getAspe(event)
{
	if($idRevi != '')
	{	
		ajaxAction
		(
			new Hash(["*tok => 0"]),
			$_getAspe,
			setAspe
		);
	}
	else
		popup("No se cargado ninguna revisión!");
}

function setAspe(response)
{
	var opts = $optIni;

	var casos = ofJail(response.responseText);
	var l = casos.length;
	for(var i = 0; i < l; i ++)
	{
		var uni = casos[i];
		opts += "<option value='"+uni[0]+"'>"+uni[1]+"</option>"
	}

	gId("aspecto").innerHTML = opts;
}

/* Detalles */

function getDeta(event)
{
	if($idRevi != '')
	{	
		ajaxAction
		(
			new Hash(["*id => "+$idRevi]),
			$_getDeta,
			setDeta
		);
	}
	else
		popup("No se cargado ninguna revisión!");
}

function setDeta(response)
{
	if(response.responseText != "{}")
	{	
		var cont = '';

		var casos = ofJail(response.responseText);
		var l = casos.length;
		for(var i = 0; i < l; i ++)
		{
			var uni = casos[i];
			cont += "<tr><th>"+uni[0]+"</th><th>"+uni[1]+"</th><td>"+uni[2].toUpperCase()+"</td><td>"+uni[3].toUpperCase()+"</td><th>"+
			uni[4].toUpperCase()+"</th><th>"+uni[5].toUpperCase()+"</th><th>"+uni[6].toUpperCase()+"</th><th>"+uni[7]+"</th></tr>";
		}

		gId("jsDetaTab").innerHTML = cont;
	}
	else
		gId("jsDetaTab").innerHTML = "";

	$idDeta = '';
	gId("aspecto").value = "@";
	gId("evitable").value = "@";
	gId("estimacion").value = "@";
	gId("probabilidad").value = "@";
	gId("consecuencia").value = "@";
	gId("detalle").value = "";
}

function selDeta(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $idDeta)
	{
		$idDeta = tmp;
		row.style.background = "#C6DCC6";
		
		gId("aspecto").value = row.cells[1].innerHTML;;
		gId("evitable").value = row.cells[3].innerHTML;;
		gId("estimacion").value = row.cells[4].innerHTML;;
		gId("probabilidad").value = row.cells[5].innerHTML;;
		gId("consecuencia").value = row.cells[6].innerHTML;;
		gId("detalle").value = row.cells[7].innerHTML;;
	}
	else
	{
		$idDeta = '';
		row.style.background = "";
		
		gId("aspecto").value = "@";
		gId("evitable").value = "@";
		gId("estimacion").value = "@";
		gId("probabilidad").value = "@";
		gId("consecuencia").value = "@";
		gId("detalle").value = "";
	}
}

function savDeta(event)
{
	if($idRevi != '' && gId("aspecto").value != "@" && gId("evitable").value != "@" && gId("estimacion").value != "@" && gId("probabilidad").value != "@" && gId("consecuencia").value != "@" && gId("detalle").value != "")
	{	
		ajaxAction
		(
			new Hash(["*revi => "+$idRevi, "*id => "+$idDeta, "aspecto", "evitable", "estimacion", "probabilidad", "consecuencia", "detalle"]),
			$_savDeta,
			msgDeta
		);
	}
	else
		popup("Debe completar los campos del formulario!");	
}

function delDeta(event)
{
	if($idDeta != '')
	{	
		ajaxAction
		(
			new Hash(["*id => "+$idDeta]),
			$_delDeta,
			msgDeta
		);
	}
	else
		popup("Debe selecionar un Aspecto-Detalle!");	
}

function msgDeta(response)
{
	var par = response.responseText.split("-");

	popup(par[1]);

	if(par[0] == 0)
		getDeta();
}