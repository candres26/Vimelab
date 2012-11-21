var $optIni = "<option value='@'>Seleccione...</option>";

var $msModo = 0;
var $emprId = "";
var $paciId = "";
var $paciDoc = "" ;
var $paciName = "";
var $paciSex = "";
var $histId = "";
var $histTi = "";
var $rutaId = "";

function loadState(event)
{
	msg = gIf(this.id, "RMSG").value;
	
	if(msg != "LOAD")
	{
		par = msg.split("-");
		popup(par[1]);
		
		if(this.id == "ifPaci")
		{
			gId("jsPaciScCam").value = par[2];
			getPaci(event);
			canPaci(); 
		}
	}
}

function showPartial(id)
{
	show("vime-vitral");
	show(id+"Par");
}

function hidePartial(event)
{
	hide(this.id.substring(0, this.id.length-2)+"Par");
	hide("vime-vitral");
}

function vistaPaci(event)
{
	if($msModo == 0)
		showPartial(this.id);
	else
		popup("Se ha creado una revisión con este paciente, imposible cambiarlo!");
}

function viewPaci(event)
{
	hide("jsPaciSc");
	hide("jsPaciZn");
	
	show("ifPaci");
	show("ifPaciBar");
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
	if(response.responseText != "")
	{
		
		fil = response.responseText.split("|-|");
		
		cont = "<table ondblclick='fixPaci(event)'>"
		
		for(i = 0; i < fil.length; i ++)
		{
			cam = fil[i].split("=>");
			cont += "<tr title='Boble Click Para Seleccionar!'><th>"+cam[0]+"</th><td>"+cam[1]+"</td><td>"+cam[2].toUpperCase()+"</td><td>"+cam[3].toUpperCase()+"</td><th>"+cam[4].toUpperCase()+"</th><th>"+cam[5].toUpperCase()+"</th></tr>";
		}
		
		cont += "</table>";	
	}
	else
		cont = "<b>NO SE HALLARON COINCIDENCIAS</B>";
	
	gId("jsPaciZn").innerHTML = cont;
}

function fixPaci(event)
{
	row = event.target.parentNode;
	$paciId = row.cells[0].innerHTML;
	$paciDoc = row.cells[1].innerHTML;
	$paciName = row.cells[2].innerHTML;
	$paciSex = row.cells[4].innerHTML;
	$emprId = row.cells[5].innerHTML;
	
	gId("jsPaciName").innerHTML = $paciName;
	gId("jsPaciDoc").innerHTML = $paciDoc;
	gId("jsPaciSuc").innerHTML = row.cells[3].innerHTML;
	
	SimularClick("jsPaciCx");
	gId("jsPaciZn").innerHTML = "";
	gId("jsPaciScCam").value = "";
}

function newPaci(event)
{
	ifSimularClick("ifPaci", "sender");
}

function canPaci(event)
{
	hide("ifPaci");
	hide("ifPaciBar");
	
	show("jsPaciSc");
	show("jsPaciZn");
	
	gId("ifPaci").contentWindow.location.reload();
}


function vistaHist(event)
{
	if($paciId != "")
	{
		if($msModo == 0)
		{
			if($paciSex == "F")
				gId("jsHistMesPac").style.display = "";
			else
				gId("jsHistMesPac").style.display = "none";
			
			getRuta();
		}
		else
			popup("Ya ha creado una Recisión!");
	}
	else
		popup("Debe selecionar un paciente!");	
}

function getRuta(event)
{
	if($emprId != "")
	{
		
		ajaxAction
		(
			new Hash(["*param => "+$emprId]),
			$_getRuta,
			setRuta
		);
		
	}
	else
		popup("Se desconoce la empresa!");
}

function setRuta(response)
{
	fil = response.responseText.split("|-|");
		
	cont = $optIni;
	
	for(i = 0; i < fil.length; i ++)
	{
		cam = fil[i].split("=>");
		cont += "<option value='"+cam[0]+"'>"+cam[1]+"</option>";
	}
	
	gId("jsHistRut").innerHTML = cont;
	
	showPartial("jsHist");
}

function newHist(event)
{
	if(gId("jsHistTip").value != "@" && gId("jsHistRut").value != "@")
	{
		ajaxAction
		(
			new Hash(["jsPersId", "*jsPaciId => "+$paciId, "jsHistMes", "jsHistTip", "jsHistRut"]),
			$_newHist,
			setHist
		);
	}
	else
		popup("Debe indicar un TIPO de Revisión y una HOJA DE RUTA!");
}

function setHist(response)
{
	if(response.responseText.substring(0, 1) == "0")
	{
		par = response.responseText.split(":");
		$histId = par[2];
		$histTi = par[5];
		$rutaId = par[3];
		
		txTipo = "";
		if ($histTi == "0")
			txTipo = "Ingreso";
		else if($histTi == "1")
			txTipo = "Periódico";
		else if($histTi == "2")
			txTipo = "Cambio De Puesto";
		else if($histTi == "3")
			txTipo = "Reincorporación";
		else
			txTipo = "Egreso";
		
		gId("jsHistId").innerHTML = $histId;
		gId("jsHistTipo").innerHTML = txTipo;
		gId("jsHistRuta").innerHTML = par[4];
		
		show("jsReco");
		show("jsDiag");
		show("jsCome");
		
		$msModo = 1;
		
		SimularClick("jsHistCx");
	}
	else
		popup(response.responseText);
}

function newCome(event)
{
	if($msModo == 1)
	{
		ajaxAction
		(
			new Hash(["jsComeDta", "*jsHistId => "+$histId]),
			$_newCome,
			setCome
		);
	}
	else
		popup("No se ha creado una Revisión!");
}

function setCome(response)
{
	par = response.responseText.split(":");
	
	if(par[0] == "0")
		gId("jsComeDta").style.background = "";
	
	popup(par[1]);
}

function tipCome(event) 
{
	  gId("jsComeDta").style.background = "#FDC2C1";
}