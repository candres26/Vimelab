var peticion_http = null;
var start = null;

function setUrl(url)
{
	if(url[0] == '/')
		url = url.substr(1);
	url = location.protocol+'//'+location.host+'/'+url;
	return url;
}

function inicializa_xhr() 
{
	start = new Date().getTime();
	if(window.XMLHttpRequest) 
	{
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject) 
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function creaQuery(data)
{
	var mode = parArray(data.values, data.keys);
	data = data.values;
	var array = new Array();
	
	for(var i = 0; i < data.length; i++)
	{
		if(mode[i].charAt(0) == '*')
			array.push(mode[i].substring(1)+'='+data[i]);
		else
			array.push(mode[i]+'='+gId(data[i]).value);
	}
	array.push('nocache='+Math.random())
	var chain = array.join('&');
	return chain;
}

function getCrono(elem)
{
	gId(elem).innerHTML = (new Date().getTime()-start)/1000;
}

function ajaxRequest(data, url, area, crono, action, params)
{
	url = setUrl(url);
	peticion_http = inicializa_xhr();
		
	if(peticion_http) 
	{
		peticion_http.onreadystatechange = function()
		{
			if(peticion_http.readyState == 4)
			{
				if(peticion_http.status == 200)
				{	
					gId(area).innerHTML = peticion_http.responseText;
					
					if(typeof crono != "undefined" && crono != null)
						getCrono(crono);
					
					if(typeof action != "undefined")
						action(peticion_http.responseText, params);
				}
				else
					creaFlot('ajaxInfo'+Math.random(), peticion_http.responseText);
			}
		};
		
		peticion_http.open("POST", url, true);
		peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		peticion_http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		var query = creaQuery(data);
		peticion_http.send(query);
	}
}

function ajaxLoader(data, url, fields, token, crono, action, params)
{
	url = setUrl(url);
	peticion_http = inicializa_xhr();
		
	if(peticion_http) 
	{
		peticion_http.onreadystatechange = function()
		{
			if(peticion_http.readyState == 4)
			{
				if(peticion_http.status == 200)
				{
					if(typeof token == "undefined")
						token = '|:|';
					
					var resul = peticion_http.responseText.split(token);
					for(var i = 0; i < resul.length; i++)
						gId(fields[i]).value = resul[i];
					
					if(typeof crono != "undefined" && crono != null)
						getCrono(crono);
					
					if(typeof action != "undefined")
						action(peticion_http.responseText, params);
				}
				else
					creaFlot('ajaxInfo'+Math.random(), peticion_http.responseText);
			}
		};
		
		peticion_http.open("POST", url, true);
		peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		peticion_http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		var query = creaQuery(data);
		peticion_http.send(query);
	}
}

function ajaxAction(data, url, action, params)
{	
	url = setUrl(url);
	peticion_http = inicializa_xhr();
		
	if(peticion_http) 
	{
		peticion_http.onreadystatechange = function()
		{
			if(peticion_http.readyState == 4)
			{
				if(peticion_http.status == 200)
				{
					if(typeof action != "undefined")
						action(peticion_http, params);
				}
				else
					creaFlot('ajaxInfo'+Math.random(), peticion_http.responseText);
			}
		};
		
		peticion_http.open("POST", url, true);
		peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		peticion_http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		var query = creaQuery(data);
		peticion_http.send(query);
	}
}

function ajaxField(url, data, token)
{
	url = setUrl(url);
	peticion_http = inicializa_xhr();
		
	if(peticion_http) 
	{
		peticion_http.onreadystatechange = function()
		{
			if(peticion_http.readyState == 4)
			{
				if(peticion_http.status == 200)
				{
					if(typeof token == "undefined")
						token = '|:|';
						
					var resul = peticion_http.responseText.split(token);
					for(var i = 0; i < resul.length; i+=2)
					{
						if(gId(resul[i]) != null)
							gId(resul[i]).value = resul[i+1];
						else
							creaFlot('ajaxInfo'+Math.random(), resul[i+1], resul[i]);
					}
				}
				else
					creaFlot('ajaxInfo'+Math.random(), peticion_http.responseText);
			}
		};
		
		peticion_http.open("POST", url, true);
		peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		peticion_http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		var query = creaQuery(data);
		peticion_http.send(query);
	}
}
