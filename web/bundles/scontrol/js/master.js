var $optIni = "<option value='@'>Seleccione...</option>";

var $msModo = 0;
var $emprId = "";
var $paciId = "";
var $paciDoc = "" ;
var $paciName = "";
var $paciSex = "";
var $histId = "";
var $histTi = "";
var $ptraId = "";
var $ptraTi = "";
var $respId = "";
var $rutaId = "";
var $audiId = "";
var $visuId = "";
var $biomId = "";
var $espiId = "";
var $extrId = "";
var $sistId = "";
var $recoIdx = -1;
var $recoSrIdx = -1;
var $diagIdx = -1;
var $diagSrIdx = -1;
var $pregIdx = -1;
var $laboIdx = -1;
var $isCarga = false;

function loadState(event)
{
	msg = gIf(this.id, "RMSG").value;
	
	if(msg != "LOAD" && msg != "NONE")
	{
		par = msg.split("-");
		popup(par[1]);
		
		if(this.id == "ifPaci")
		{
			gId("jsPaciScCam").value = par[2];
			getPaci(event);
			canPaci(); 
		}
		else if(this.id == "ifAudi")
		{
			$audiId = par[0];
			hide("jsAudiCre");
			gId('jsAudiLed').style.background = "#0000FF";
		}
		else if(this.id == "ifVisu")
		{
			$visuId = par[0];
			hide("jsVisuCre");
			gId('jsVisuLed').style.background = "#0000FF";
		}
		else if(this.id == "ifBiom")
		{
			$biomId = par[0];
			hide("jsBiomCre");
			gId('jsBiomLed').style.background = "#0000FF";
		}
		else if(this.id == "ifEspi")
		{
			$espiId = par[0];
			hide("jsEspiCre");
			gId('jsEspiLed').style.background = "#0000FF";
		}
		else if(this.id == "ifExtr")
		{
			$extrId = par[0];
			hide("jsExtrCre");
			gId('jsExtrLed').style.background = "#0000FF";
		}
		else if(this.id == "ifSist")
		{
			$sistId = par[0];
			hide("jsSistCre");
			gId('jsSistLed').style.background = "#0000FF";
		}
	}
	else if(msg != "NONE")
	{
		if(this.id == "ifAudi")
		{
			gIf("ifAudi", "vimelab_scontrolbundle_mdauditype_mdhist").value = $histId;
			showPartial("jsAudi");
		}
		else if(this.id == "ifVisu")
		{
			gIf("ifVisu", "vimelab_scontrolbundle_mdvisutype_mdhist").value = $histId;
			showPartial("jsVisu");
		}
		else if(this.id == "ifBiom")
		{
			gIf("ifBiom", "vimelab_scontrolbundle_mdbiomtype_mdhist").value = $histId;
			showPartial("jsBiom");
		}
		else if(this.id == "ifEspi")
		{
			gIf("ifEspi", "vimelab_scontrolbundle_mdespitype_mdhist").value = $histId;
			showPartial("jsEspi");
		}
		else if(this.id == "ifExtr")
		{
			gIf("ifExtr", "vimelab_scontrolbundle_mdextrtype_mdhist").value = $histId;
			showPartial("jsExtr");
		}
		else if(this.id == "ifSist")
		{
			gIf("ifSist", "vimelab_scontrolbundle_mdsisttype_mdhist").value = $histId;
			showPartial("jsSist");
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
			cont += "<tr title='Doble Click Para Seleccionar!'><th>"+cam[0]+"</th><td>"+cam[1]+"</td><td>"+cam[2].toUpperCase()+"</td><td>"
					+cam[3].toUpperCase()+"</td><th>"+cam[4].toUpperCase()+"</th><th>"
					+cam[5]+"</th><th>"+cam[6]+"</th><th>"+cam[7].toUpperCase()+"</th></tr>";
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
	$ptraId = row.cells[6].innerHTML;
	$ptraTi = row.cells[7].innerHTML;
	
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
			popup("Ya ha creado una Revisión!");
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
		gId("jsProtTra").innerHTML = $ptraTi;
		
		show("jsReco");
		show("jsDiag");
		show("jsCome");
		show("jsAudi");
		show("jsVisu");
		show("jsBiom");
		show("jsEspi");
		show("jsExtr");
		show("jsSist");
		show("jsProt");
		show("jsExam");
		
		$msModo = 1;
		
		getProto();
		
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

function vistaReco(event)
{
	if($msModo == 1)
		showPartial("jsReco");
	else
		popup("No se ha creado una Revisión!");
}

function getReco(event)
{
	if(event.type == "click" || (event.type == "keypress" && event.keyCode == 13))
	{
		ajaxAction
		(
			new Hash(["param => jsRecoCam", "*min => 1900", "*max => 1000000"]),
			$_getPato,
			setPato
		);
	}
}

function setPato(response)
{
	$recoSrIdx = -1;
	
	if(response.responseText != "")
	{
		
		fil = response.responseText.split("|-|");
		
		cont = ""
		
		for(i = 0; i < fil.length; i ++)
		{
			cam = fil[i].split("=>");
			cont += "<tr><th>"+cam[0]+"</th><td>"+cam[1]+"</td><td>"+cam[2].toUpperCase()+"</td></tr>";
		}	
	}
	else
		cont = "<b>NO SE HALLARON COINCIDENCIAS</B>";
	
	gId("jsRecoZn").innerHTML = cont;
}

function newReco(event)
{
	if($recoSrIdx != -1)
	{
		ajaxAction
		(
			new Hash(["*jsHistId => "+$histId, "*jsPatoId => "+$recoSrIdx]),
			$_newDiag,
			setReco
		);
	}
	else
		popup("Debe selecionar una Recomendación!");
}

function setReco(response)
{
	if(response.responseText == "0")
		popup("Recomendación creada con exito!");
	else
		popup("Imposible crear Recomendación!");
	
	$recoSrIdx = -1;
	tab = gId("jsRecoZn");
	for(i = 0; i < tab.rows.length; i++)
		tab.rows[i].style.background = "";
}

function refreshReco(event)
{	
	$recoIdx = -1;
	ajaxAction
	(
		new Hash(["*param => "+$histId, "*min => 1900", "*max => 1000000"]),
		$_getDiag,
		showReco
	);
}

function showReco(response)
{
	cont = ""
	
	if(response.responseText != "")
	{
		fil = response.responseText.split("|-|");
		
		for(i = 0; i < fil.length; i ++)
		{
			cam = fil[i].split("=>");
			cont += "<tr><th>"+cam[0]+"</th><td>"+cam[1]+"</td></tr>";
		}	
	}
	
	gId("jsRecoTab").innerHTML = cont;
	hide("vime-vitral");
	hide("jsRecoPar");
}

function delReco(event)
{
	if($recoIdx != -1)
	{
		ajaxAction
		(
			new Hash(["*param => "+$recoIdx]),
			$_delDiag,
			isDelReco
		);
	}
	else
		popup("Debe selcionar una Recomendación!");
}

function isDelReco(response)
{
	if(response.responseText = "0")
		popup("Recomendación eliminada con exito!");
	else
		popup("Imposble eliminar Recomendación!");
		
	$recoIdx = -1;
	refreshReco();
}

function selReco(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $recoIdx)
	{
		$recoIdx = tmp;
		row.style.background = "#C6DCC6";
	}
	else
	{
		$recoIdx = -1;
		row.style.background = "";
	}
}

function selRecoSr(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $recoSrIdx)
	{
		$recoSrIdx = tmp;
		row.style.background = "#C6DCC6";
	}
	else
	{
		$recoSrIdx = -1;
		row.style.background = "";
	}
}

function vistaDiag(event)
{
	if($msModo == 1)
		showPartial("jsDiag");
	else
		popup("No se ha creado una Revisión!");
}

function getDiag(event)
{
	if(event.type == "click" || (event.type == "keypress" && event.keyCode == 13))
	{
		ajaxAction
		(
			new Hash(["param => jsDiagCam", "*min => 0", "*max => 1900"]),
			$_getPato,
			setPato2
		);
	}
}

function setPato2(response)
{
	$diagSrIdx	= -1;
	if(response.responseText != "")
	{
		
		fil = response.responseText.split("|-|");
		
		cont = ""
		
		for(i = 0; i < fil.length; i ++)
		{
			cam = fil[i].split("=>");
			cont += "<tr><th>"+cam[0]+"</th><td>"+cam[1]+"</td><td>"+cam[2].toUpperCase()+"</td></tr>";
		}	
	}
	else
		cont = "<b>NO SE HALLARON COINCIDENCIAS</B>";
	
	gId("jsDiagZn").innerHTML = cont;
}

function newDiag(event)
{
	if($diagSrIdx != -1)
	{
		ajaxAction
		(
			new Hash(["*jsHistId => "+$histId, "*jsPatoId => "+$diagSrIdx]),
			$_newDiag,
			setDiag
		);
	}
	else
		popup("Debe selecionar un Diagnostico!");
}

function setDiag(response)
{
	if(response.responseText == "0")
		popup("Diagnostico creado con exito!");
	else
		popup("Imposible crear Diagnostico!");
	
	$diagSrIdx = -1;
	tab = gId("jsDiagZn");
	for(i = 0; i < tab.rows.length; i++)
		tab.rows[i].style.background = "";
}

function refreshDiag(event)
{	
	$diagIdx = -1;
	ajaxAction
	(
		new Hash(["*param => "+$histId, "*min => 0", "*max => 1900"]),
		$_getDiag,
		showDiag
	);
}

function showDiag(response)
{
	cont = ""
	
	if(response.responseText != "")
	{
		fil = response.responseText.split("|-|");
		
		for(i = 0; i < fil.length; i ++)
		{
			cam = fil[i].split("=>");
			cont += "<tr><th>"+cam[0]+"</th><td>"+cam[1]+"</td></tr>";
		}	
	}
	
	gId("jsDiagTab").innerHTML = cont;
	hide("vime-vitral");
	hide("jsDiagPar");
}

function delDiag(event)
{
	if($diagIdx != -1)
	{
		ajaxAction
		(
			new Hash(["*param => "+$diagIdx]),
			$_delDiag,
			isDelDiag
		);
	}
	else
		popup("Debe selcionar un Diagnostico!");
}

function isDelDiag(response)
{
	if(response.responseText = "0")
		popup("Diagnostico eliminado con exito!");
	else
		popup("Imposble eliminar Diagnostico!");
		
	$recoIdx = -1;
	refreshDiag();
}

function selDiag(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $diagIdx)
	{
		$diagIdx = tmp;
		row.style.background = "#C6DCC6";
	}
	else
	{
		$diagIdx = -1;
		row.style.background = "";
	}
}

function selDiagSr(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $diagSrIdx)
	{
		$diagSrIdx = tmp;
		row.style.background = "#C6DCC6";
	}
	else
	{
		$diagSrIdx = -1;
		row.style.background = "";
	}
}

/* ##################################### */

function vistaAudi(event)
{
	if($audiId == "")
		gId("ifAudi").contentWindow.location.reload();
	else
		showPartial(this.id);
}

function newAudi(event)
{
	ifSimularClick("ifAudi", "sender");
}

function vistaVisu(event)
{
	if($visuId == "")
		gId("ifVisu").contentWindow.location.reload();
	else
		showPartial(this.id);
}

function newVisu(event)
{
	ifSimularClick("ifVisu", "sender");
}

function vistaBiom(event)
{
	if($biomId == "")
		gId("ifBiom").contentWindow.location.reload();
	else
		showPartial(this.id);
}

function newBiom(event)
{
	ifSimularClick("ifBiom", "sender");
}

function vistaEspi(event)
{
	if($espiId == "")
		gId("ifEspi").contentWindow.location.reload();
	else
		showPartial(this.id);
}

function newEspi(event)
{
	ifSimularClick("ifEspi", "sender");
}

function vistaExtr(event)
{
	if($extrId == "")
		gId("ifExtr").contentWindow.location.reload();
	else
		showPartial(this.id);
}

function newExtr(event)
{
	ifSimularClick("ifExtr", "sender");
}

function vistaSist(event)
{
	if($sistId == "")
		gId("ifSist").contentWindow.location.reload();
	else
		showPartial(this.id);
}

function newSist(event)
{
	ifSimularClick("ifSist", "sender");
}

/* ##################################################################################### */

function getProto(event)
{
	ajaxAction
	(
		new Hash(["*ptra => "+$ptraId]),
		$_getProt,
		showProto
	);
}

function showProto(response)
{
	opt = $optIni;
	par = response.responseText.split("|-|");
	
	for(i = 0; i < par.length; i++)
	{
		cmp = par[i].split("=>");
		opt += "<option value='"+cmp[0]+"'>"+cmp[1]+"</option>";
	}
		
	gId("jsProtOp").innerHTML = opt;
}

function getQues(event)
{
	$pregIdx = -1;
	clearPreg();
	
	if(gId("jsProtOp").value != "@")
	{
		ajaxAction
		(
			new Hash(["jsProtOp", "*hist => "+$histId]),
			$_getQues,
			showQues
		);
	}
	else
		gId("jsProtTab").innerHTML = "";	
}

function showQues(response)
{
	cont = ""
	
	if(response.responseText != "")
	{
		fil = response.responseText.split("|-|");
		
		for(i = 0; i < fil.length; i ++)
		{
			cam = fil[i].split("=>");
			cont += "<tr><th>"+cam[0]+"</th><td>"+cam[1]+"</td><th>"+cam[2]+"</th><th>"+cam[3]+"</th><th>"+cam[4]+"</th></tr>";
		}	
	}
	
	gId("jsProtTab").innerHTML = cont;
}


function selPreg(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $pregIdx)
	{
		$pregIdx = tmp;
		row.style.background = "#C6DCC6";
		
		if(row.cells[2].innerHTML != "{}")
		{
			$respId = row.cells[2].innerHTML; 
			
			if(row.cells[3].innerHTML == "S")
				gId("jsProtSel_S").checked = "checked";
			else
				gId("jsProtSel_N").checked = "checked";
			
			gId("jsProtDet").value = row.cells[4].innerHTML;
		}
		else
			clearPreg();
	}
	else
	{
		$pregIdx = -1;
		row.style.background = "";
		
		clearPreg();
	}
}

function clearPreg(event)
{
	$respId = "";
	gId("jsProtSel_S").checked = "";
	gId("jsProtSel_N").checked = "";
	gId("jsProtDet").value = "";
}

function savPreg(event)
{
	if($pregIdx > -1 && (gId("jsProtSel_S").checked || gId("jsProtSel_N").checked))
	{
		res = "";
		if(gId("jsProtSel_S").checked)
				res = "S";
			else
				res = "N";
				
		ajaxAction
		(	
			new Hash(["*hist => "+$histId, "*preg => "+$pregIdx, "*resp => "+$respId, "*resu => "+res, "*deta => "+gId("jsProtDet").value]),
			$_savQues,
			fixQues
		);
	}
	else
		popup("Debe selecionar una pregunta y su resultado S/N");
}

function fixQues(response)
{
	if(response.responseText == "0")
		popup("Respuesta guardada con exito!");
	else
		popup("Imposible guardar respuesta!");
		
	getQues();
}

function delPreg(event)
{
	if($respId != "")
	{		
		ajaxAction
		(	
			new Hash(["*resp => "+$respId]),
			$_delQues,
			remQues
		);
	}
	else
		popup("Debe selecionar una pregunta ya contestada!");
}

function remQues(response)
{
	if(response.responseText == "0")
		popup("Respuesta eliminada con exito!");
	else
		popup("Imposible eliminar respuesta!");
		
	getQues();
}

/* ##################################################################################### */

function selExam(event)
{
	for(i = 0; i < this.rows.length; i++)
		this.rows[i].style.background = "";
	
	row = event.target.parentNode;
	tmp = row.cells[0].innerHTML;
	
	if(tmp != $laboIdx)
	{
		$laboIdx = tmp;
		row.style.background = "#C6DCC6";
		
		gId("jsExamEx").value = row.cells[4].innerHTML; 
		gId("jsExamSr").value = row.cells[5].innerHTML; 
		
		if(row.cells[2].innerHTML == "S")
			gId("jsExamSel_S").checked = "checked";
		else
			gId("jsExamSel_N").checked = "checked";
		
		gId("jsExamDet").value = row.cells[3].innerHTML;
	}
	else
	{
		$laboIdx = -1;
		row.style.background = "";
		
		clearExam();
	}
}

function savExam(event)
{
	if(gId("jsExamEx").value != "@" && gId("jsExamSr").value != "@" && (gId("jsExamSel_S").checked || gId("jsExamSel_N").checked) && gId("jsExamDet").value != "")
	{	
		res = "";
		if(gId("jsExamSel_S").checked)
			res = "S";
		else
			res = "N";
				
		ajaxAction
		(	
			new Hash(["*hist => "+$histId, "jsExamEx", "jsExamSr", "*esta => "+res, "jsExamDet"]),
			$_savExam,
			setExam
		);
	}
	else
		popup("Debe selecionar un examen, servicio, estado y resultado del examen!");
}

function setExam(response)
{
	if(response.responseText == "0")
		popup("Examen guardado con exito!");
	else
		popup("Imposible guardar examen!");
		
	getExam();
}

function delExam(event)
{
	if($laboIdx > -1)
	{			
		ajaxAction
		(	
			new Hash(["*exam => "+$laboIdx]),
			$_delExam,
			remExam
		);
	}
	else
		popup("Debe selecionar un examen guardado!");
}

function remExam(response)
{
	if(response.responseText == "0")
		popup("Examen eliminado con exito!");
	else
		popup("Imposible eliminar examen!");
		
	getExam();
}

function getExam(event)
{
	$laboIdx = -1;
	clearExam();
	
	ajaxAction
	(	
		new Hash(["*hist => "+$histId]),
		$_getExam,
		showExam
	);
}

function showExam(response)
{
	cont = ""
	
	if(response.responseText != "")
	{
		fil = response.responseText.split("|-|");
		
		for(i = 0; i < fil.length; i ++)
		{
			cam = fil[i].split("=>");
			cont += "<tr><th>"+cam[0]+"</th><td>"+cam[1]+"</td><th>"+cam[2]+"</th><th>"+cam[3]+"</th><th>"+cam[4]+"</th><th>"+cam[5]+"</th></tr>";
		}	
	}
	
	gId("jsExamTab").innerHTML = cont;
}

function clearExam(event)
{
	gId("jsExamEx").value = "@"; 
	gId("jsExamSr").value = "@";	
	gId("jsExamSel_S").checked = "";
	gId("jsExamSel_N").checked = "";
	gId("jsExamDet").value = "";
}

/* ##################################################################################### */

function masterLoad(event)
{
	var res = ofJail($LOADER);
	var pac = res[0];
	var his = res[1];
	var sim = res[2]; 
	
	$paciId = pac[0];
	$paciDoc = pac[1];
	$paciName = pac[2];
	$paciSex = pac[4];
	$emprId = pac[5];
	$ptraId = pac[6];
	$ptraTi = pac[7];
	
	gId("jsPaciName").innerHTML = $paciName;
	gId("jsPaciDoc").innerHTML = $paciDoc;
	gId("jsPaciSuc").innerHTML = pac[3];
	
	$histId = his[0];
	$histTi = his[3];
	$rutaId = his[1];
	
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
	gId("jsHistRuta").innerHTML = his[2];
	gId("jsProtTra").innerHTML = $ptraTi;
	gId("jsComeDta").value = his[4];
	
	if(sim[0] != -1)
	{
		$audiId = sim[0];
		gId("ifAudi").contentWindow.location = $_audi+"/"+$audiId+"/show/4";
		hide("jsAudiCre");
		gId('jsAudiLed').style.background = "#0000FF";
	}
	
	if(sim[1] != -1)
	{
		$visuId = sim[1];
		gId("ifVisu").contentWindow.location = $_visu+"/"+$visuId+"/show/4";
		hide("jsVisuCre");
		gId('jsVisuLed').style.background = "#0000FF";
	}
	
	if(sim[2] != -1)
	{
		$biomId = sim[2];
		gId("ifBiom").contentWindow.location = $_biom+"/"+$biomId+"/show/4";
		hide("jsBiomCre");
		gId('jsBiomLed').style.background = "#0000FF";
	}
	
	if(sim[3] != -1)
	{
		$espiId = sim[3];
		gId("ifEspi").contentWindow.location = $_espi+"/"+$espiId+"/show/4";
		hide("jsEspiCre");
		gId('jsEspiLed').style.background = "#0000FF";
	}
	
	if(sim[4] != -1)
	{
		$extrId = sim[4];
		gId("ifExtr").contentWindow.location = $_extr+"/"+$extrId+"/show/4";
		hide("jsExtrCre");
		gId('jsExtrLed').style.background = "#0000FF";
	}
	
	if(sim[5] != -1)
	{
		$sistId = sim[4];
		gId("ifSist").contentWindow.location = $_sist+"/"+$sistId+"/show/4";
		hide("jsSistCre");
		gId('jsSistLed').style.background = "#0000FF";
	}
	
	show("jsReco");
	show("jsDiag");
	show("jsCome");
	show("jsAudi");
	show("jsVisu");
	show("jsBiom");
	show("jsEspi");
	show("jsExtr");
	show("jsSist");
	show("jsProt");
	show("jsExam");
	
	$msModo = 1;
	
	getProto();		
	refreshReco();
	refreshDiag();
	getExam();
}
