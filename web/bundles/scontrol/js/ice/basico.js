var start = null;

function toJail(arr, gl, gr, ms)
{
	if(gl == undefined)
		gl = '{';
	
	if(gr == undefined)
		gr = '}';
	
	if(ms == undefined)
		ms = true;	
	
	var res = '';
	
	var j = arr.length;
	for(var i = 0; i < j; i++)
	{
		if(arr[i] instanceof Array)
			res += gl+toJail(arr[i], gl, gr, false)+gr;
		else 
			res += gl+arr[i]+gr;
	}
	
	if(ms)
		res = gl+res+gr;
	
	return res;
}

function ofJail(arr, gl, gr, ms)
{
	if(gl == undefined)
		gl = '{';
	
	if(gr == undefined)
		gr = '}';
	
	if(ms == undefined)
		ms = true;
		
	var res = new Array();
	var isData = false;
		
	var j = arr.length;
	var i = 0;
	while(i < j)
	{
		if(arr[i] == gl)
		{
			var ix = getPiece(arr, gl, gr, i);
			var tmp = arr.substring(i+1, ix); 
			res.push(ofJail(tmp, gl, gr, false));
			i = ix;
		}
		if(arr[i] == gr)
		{
			i += 1;
		}
		else
		{
			res.push(arr);
			isData = true;
			i = j;
		}			 
	}
	
	if(ms || isData)
		res = res[0];
	
	return res;
}

function getPiece(arr, gl, gr, or)
{
	if(gl == undefined)
		gl = '{';
	
	if(gr == undefined)
		gr = '}';
	
	if(or == undefined)
		or = 0;
		
	var ct = 0;
	var ix = -1;
	
	var j = arr.length;
	for(var i = or; i < j; i++)
	{
		if(arr[i] == gl)
		{
			ct += 1;
		}
		else if(arr[i] == gr)
		{
			ct -= 1;
		}
		
		if(ct == 0)
		{
			ix = i;
			break;
		}			 
	}
	
	return ix;	
}

function setCrono()
{
	start = new Date().getTime();
}

function getCrono(elem)
{
	gId(elem).innerHTML = (new Date().getTime()-start)/1000;
}

function getHoy()
{
    date = new Date();
    yy = date.getFullYear();
    mm = date.getMonth()+1;
    mm = mm > 9 ? mm : '0'+mm;
    dd = date.getDate();
    dd = dd > 9 ? dd : '0'+dd;

    return yy+"-"+mm+"-"+dd;
}

function getAhora()
{
    date = new Date();
    hh = date.getHours();
    hh = hh > 9 ? hh : '0'+hh;
    mm = date.getMinutes();
    mm = mm > 9 ? mm : '0'+mm;
    ss = date.getSeconds();
    ss = ss > 9 ? ss : '0'+ss;

    return hh+":"+mm+":"+ss;
}

function parArray(data, mode)
{
    if(typeof mode == "undefined")
    {
        mode = data;
    }

    if(data.length > mode.length)
    {
        for(var i = mode.length; i < data.length; i++)
            mode.push('');
    }
    else if(data.length < mode.length)
    {
        var lim = mode.length;
        for(var i = data.length; i < lim; i++)
            mode.pop();
    }

    for(var i = 0; i < data.length; i++)
    {
        if(mode[i] == '')
            mode[i] = data[i];
    }

    return mode;
}

function Hash(array, token)
{
    this.values = new Array();
    this.keys = new Array();

    if(typeof token == "undefined")
        token = ' => ';

    if(typeof array == "undefined")
        array = new Array();

    for(var i = 0; i < array.length; i++)
    {
        var temp = array[i].split(token);
        if(temp.length < 2)
        {
            this.keys.push('');
            this.values.push(temp[0]);
        }
        else if(temp.length == 2)
        {
            this.keys.push(temp[0]);
            this.values.push(temp[1]);
        }
        else
        {
            this.keys.push(temp[0]);
            var val = '';
            for(j = 1; j < temp.length; j++)
                val = val+temp[j];
        }
    }

    this.len = this.values.length;

    this.getValue = function(key)
    {
        if(typeof key == "undefined")
            key = '';

        var val = undefined;
        for(var i = 0; i < this.values.length; i++)
        {
            if(this.keys[i] == key)
            {
                val = this.values[i];
            }
        }

        return val;
    }

    this.getKey = function(val)
    {
        if(typeof val == "undefined")
            val = '';

        var key = undefined;
        for(var i = 0; i < this.keys.length; i++)
        {
            if(this.values[i] == val)
            {
                key = this.keys[i];
            }
        }

        return key;
    }

    this.listKeys = function()
    {
        return this.keys;
    }

    this.listValues = function()
    {
        return this.values;
    }
}
