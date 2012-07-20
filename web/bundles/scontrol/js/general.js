var calendar = null;
var alertCro = null;
var alertBuf = new Array();
var alertFlg = new Array();
var alertCnt = 0;

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

function launch(event)
{
	location = this.id;
}

function foldMenu(event)
{	
	elem = this;
	
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

function ifSimularClick(idFrame, idObjete)
{
	var nouEvent = document.createEvent("MouseEvents");
	nouEvent.initMouseEvent("click", true, true, window,0,0,0,0,0,false,false,false,false,0, null);
	
	var objecte = document.getElementById(idFrame).contentWindow.document.getElementById(idObjete);  
	var canceled = !objecte.dispatchEvent(nouEvent);
}

function popupAuto(datm)
{
	if(datm != undefined)
		msg = datm;
	else
		msg = "...!";
	
	gId('popin').innerHTML = msg;
	aparecer('pop', 0, 70);
	window.setTimeout ("desaparecer('pop', 70)", 5000);
}

function popup(datm)
{
	if(datm != undefined)
		msg = datm;
	else
		msg = "...!";
	
	if(alertCro == null)
		alertCro = window.setInterval("showBox()",100);
		
	alertBuf.unshift(msg);
	alertFlg.unshift(40); 
}

function showBox()
{
	if(alertCnt != alertBuf.length)
	{
		alertCnt = alertBuf.length;
			
		if(alertCnt == 0)
		{
			gId('popin').innerHTML = '';
			$clearPop();
		}
		else
		{
			gId('popin').innerHTML = alertBuf.join("<hr><br>");
			gId('pop').style.display = 'block';	
		}
	}
	
	for(i = 0; i < alertFlg.length; i++)
	{
		alertFlg[i] -= 1;
		
		if(alertFlg[i] == 0)
		{
			alertBuf.pop();
			alertFlg.pop();	
		}	
	}	
}

function $clearPop(event)
{
	window.clearInterval(alertCro);
	alertCro = null;
	alertBuf = new Array();
	alertFlg = new Array();
	alertCnt = 0;
	gId('pop').style.display = 'none';
}

function showCalendar(ids, format)
{
	if(gId('VX'+ids) == null)
	{
		calendar = new Calendar();
		calendar.setFormat(format);
		creaPop('VX'+ids, calendar.draw(ids, 'loadDate'), 0, 0);
	}
	else
	{
		removeNode('VX'+ids);
	}
}

function loadDate(data, elem)
{
	if(data.innerHTML == '&lt;')
	{
		calendar.decMonth();
		gId('VX'+elem).innerHTML = calendar.draw(elem, 'loadDate');
	}
	else if(data.innerHTML == '&gt;')
	{
		calendar.incMonth();
		gId('VX'+elem).innerHTML = calendar.draw(elem, 'loadDate');
	}
	else if(data.innerHTML == '&gt;&gt;')
	{
		calendar.incYear();
		gId('VX'+elem).innerHTML = calendar.draw(elem, 'loadDate');
	}
	else if(data.innerHTML == '&lt;&lt;')
	{
		calendar.decYear();
		gId('VX'+elem).innerHTML = calendar.draw(elem, 'loadDate');
	}
	else if(data.innerHTML == '+&gt;')
	{
		for(i = 0; i < 10; i++)
			calendar.incYear();
		gId('VX'+elem).innerHTML = calendar.draw(elem, 'loadDate');
	}
	else if(data.innerHTML == '&lt;+')
	{
		for(i = 0; i < 10; i++)
			calendar.decYear();
		gId('VX'+elem).innerHTML = calendar.draw(elem, 'loadDate');
	}
	else 
	{
		if(data.innerHTML != 'X')
		{
			calendar.setDay(parseInt(data.innerHTML));
			gId(elem).value = calendar.getDate();
		}
		
		removeNode('VX'+elem);
		gId(elem).focus();
	}
}

function $viewEditKey(event)
{
	aparecer('dfSetKey');
}

function $canEditKey(event)
{
	gId("keyPass0").value = '';
	gId("keyPass1").value = '';
	gId("keyPass2").value = '';
	desaparecer('dfSetKey');
}

function $savEditKey(event)
{
	if(gId('keyPass0').value != '' && gId('keyPass1').value != '' & gId('keyPass2').value != '')
	{
		if(gId('keyPass1').value == gId('keyPass2').value != '')
		{
			ajaxAction
			(
				new Hash(['keyPass0', 'keyPass1']),
				gId("dfSetKeyPath").value,
				$setEditKey
			)
			
			$canEditKey();
		}
		else
			popup("Las Claves Suministradas No Coinciden");
	}
	else
		popup('Debe Proporcionar Su Clave Actual Y Una Nueva Clave Confirmada!');
}

function $setEditKey(response)
{
	popup(response.responseText);
}

function $helpCalendar(event)
{
	cell = this.parentNode;
	elem = gTag(cell, 'input')[0];
	showCalendar(elem.id);
}