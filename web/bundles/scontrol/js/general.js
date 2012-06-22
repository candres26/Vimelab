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
