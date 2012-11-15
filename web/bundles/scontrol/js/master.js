var $optIni = "<option value='@'>Seleccione...</option>";

var $msModo = 0;
var $paciId = "";
var $paciDoc = "" ;
var $paciName = "";
var $paciSex = "";

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
			cont += "<tr title='Boble Click Para Seleccionar!'><th>"+cam[0]+"</th><td>"+cam[1]+"</td><td>"+cam[2].toUpperCase()+"</td><td>"+cam[3].toUpperCase()+"</td><th>"+cam[4].toUpperCase()+"</th></tr>";
		}
		
		cont += "</table>"	
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
	$paciSex = row.cells[4].innerHTML
	
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
		if($paciSex == "F")
			gId("jsHistMesPac").style.display = "";
		else
			gId("jsHistMesPac").style.display = "none";
			
		showPartial(this.id);
	}
	else
		popup("Debe selecionar un paciente!");	
}
