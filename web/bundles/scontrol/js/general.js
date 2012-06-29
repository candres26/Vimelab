function go(dir)
{
    location = dir;
}

function init()
{
	getUser();
}

function SimularClick(idObjete)
{
	var nouEvent = document.createEvent("MouseEvents");
	nouEvent.initMouseEvent("click", true, true, window,0,0,0,0,0,false,false,false,false,0, null);
	
	var objecte = document.getElementById(idObjete);
	var canceled = !objecte.dispatchEvent(nouEvent);
}

function popup(datm)
{
	if(datm != undefined)
		msg = datm;
	else
		msg = "...!";
	
	gId('popin').innerHTML = msg;
	aparecer('pop', 0, 70);
	window.setTimeout ("desaparecer('pop', 70)", 5000);
}
