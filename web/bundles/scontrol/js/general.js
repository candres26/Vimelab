function go(dir)
{
    location = dir;
}

function getUser(path)
{
	ajaxAction
	(
		new Hash(['*tok => 0']),
		path,
		setUser
	);
}

function setUser(response)
{
	gId('sisuser').innerHTML = response.responseText;
}

function foldMenu(elem)
{
	if(elem.style.height == '' || elem.style.height == '18px')
		elem.style.height = 'auto';
	else
		elem.style.height = '18px';
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
