function showPartial(event)
{
	show("vime-vitral");
	show(this.id+"Par");
}

function hidePartial(event)
{
	hide(this.id.substring(0, this.id.length-2)+"Par");
	hide("vime-vitral");
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
	alert("En construcción");
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
