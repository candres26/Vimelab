function Calendar(Vy, Vm, Vd)
{
	this.monthList = new Hash(['Enero => 31', 'Febrero => 28', 'Marzo => 31', 'Abril => 30', 'Mayo => 31', 'Junio => 30', 'Julio => 31', 'Agosto => 31', 'Septiembre => 30', 'Octubre => 31', 'Noviembre => 30', 'Diciembre => 31']);
	this.dayList = ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sáb'];
	this.format = 'yyyy-mm-dd';
	
	this.make = function(Vy, Vm, Vd)
	{
		if(typeof Vy != "undefined")
		{
			if(typeof Vm == "undefined")
				Vm = 0;
			
			if(typeof Vd == "undefined")
				Vd = 1;
				
			this.date = new Date(Vy, Vm, Vd);
		}
		else
			this.date = new Date();
		
		this.yy = this.date.getFullYear();
		this.mm = this.date.getMonth();
		this.dd = this.date.getDate();
		this.dia = this.date.getDay();
	}
	
	this.getFormat = function()
	{
		
		return this.format;
	}
	
	this.getNomDay = function()
	{
		return this.dayList[this.dia];
	}
	
	this.getDate = function()
	{
		var tmp = this.format;
		tmp = tmp.replace('yyyy', ''+this.getYear());
		tmp = tmp.replace('mm', ''+this.getMonth());
		tmp = tmp.replace('dd', ''+this.getDay());
		return tmp;
	}
	
	this.getYear = function()
	{
		return ''+this.yy;
	}
	
	this.getMonth = function()
	{
		var month = this.mm+1;
		if(month < 10)
			month = '0'+month;
		return month;
	}
	
	this.getDay = function()
	{
		var day = this.dd;
		if(day < 10)
			day = '0'+day;
		return day;
	}
	
	this.setFormat = function(val)
	{
		if(typeof val != "undefined")
			this.format = val;
	}
	
	this.setYear = function(val)
	{
		this.yy = val;
		this.make(this.yy, this.mm, this.dd);
	}
	
	this.setMonth = function(val)
	{
		if(val <= 11 && val >= 0)
			this.mm = val;
		else if((val) > 11)
		{
			this.mm = 0;
			this.setYear(this.yy+1);
		}
		else if(val < 0)
		{
			this.mm = 11;
			this.setYear(this.yy-1);
		}
		
		var fact = 0;
		if(this.mm == 1 && ((this.yy % 4 == 0) && ((this.yy % 100 != 0) || (this.yy % 400 == 0))))
			fact = 1;
		
		if(this.dd > (parseInt(this.monthList.values[this.mm])+fact))
			this.dd = (parseInt(this.monthList.values[this.mm])+fact);
			
		this.make(this.yy, this.mm, this.dd);
	}
	
	this.setDay = function(val)
	{
		var fact = 0;
		if(this.mm == 1 && ((this.yy % 4 == 0) && ((this.yy % 100 != 0) || (this.yy % 400 == 0))))
			fact = 1;
		
		if(val > 0 && val <= (parseInt(this.monthList.values[this.mm])+fact))
		{
			this.dd = val;
		}
		else if(val <= 0)
		{
			this.setMonth(this.mm-1);
			if(this.mm != 1)
				this.dd = parseInt(this.monthList.values[this.mm]);
			else
			{
				if((this.yy % 4 == 0) && ((this.yy % 100 != 0) || (this.yy % 400 == 0)))
					this.dd = parseInt(this.monthList.values[this.mm])+1;
				else
					this.dd = parseInt(this.monthList.values[this.mm]);
			}
		}
		else if(val > (parseInt(this.monthList.values[this.mm])+fact))
		{
			this.setMonth(this.mm+1)
			this.dd = 1;
		}
		
		this.make(this.yy, this.mm, this.dd);
	}
	
	this.incYear = function()
	{
		this.setYear(this.yy+1);
	}
	
	this.incMonth = function()
	{
		this.setMonth(this.mm+1);
	}
	
	this.incDay = function()
	{
		this.setDay(this.dd+1);
	}
	
	this.decYear = function()
	{
		this.setYear(this.yy-1);
	}
	
	this.decMonth = function()
	{
		this.setMonth(this.mm-1);
	}
	
	this.decDay = function()
	{
		this.setDay(this.dd-1);
	}
	
	this.valida = function(val)
	{
		var pat = this.getFormat();
		pat = pat.replace('yyyy', '[0-9]{4}');
		pat = pat.replace('mm', '[0-9]{2}');
		pat = pat.replace('dd', '[0-9]{2}');
		pat = '^'+pat+'$';
		pat = new RegExp(pat);
		
		if(pat.test(val))
		{
			var ptn = this.getFormat().search('yyyy');
			var Sy = val.substring(ptn, ptn+4);
			ptn = this.getFormat().search('mm');
			var Sm = val.substring(ptn, ptn+2);
			ptn = this.getFormat().search('dd');
			var Sd = val.substring(ptn, ptn+2);
			
			while(Sy.charAt(0) == '0' && Sy.length > 1)
				Sy = Sy.substring(1);
			while(Sm.charAt(0) == '0' && Sm.length > 1)
				Sm = Sm.substring(1);
			while(Sd.charAt(0) == '0' && Sd.length > 1)
				Sd = Sd.substring(1);
			
			Sy = parseInt(Sy);
			Sm = parseInt(Sm);
			Sm = parseInt(Sm);
			
			var fact = 0;
			if((Sm-1) == 1 && ((Sy % 4 == 0) && ((Sy % 100 != 0) || (Sy % 400 == 0))))
			fact = 1;
			
			var By = (Sy >= 0);
			var Bm = (Sm >= 0 && Sm <=12);
			var Bd = false;
			
			if( Bm && (Sm-1) <= 11)
			{
				var idm = 0;
				if(Sm > 0)
				{	
					idm = Sm-1;
					Bd = ( Sd >= 0 && Sd <= (parseInt(this.monthList.values[idm])+fact) );
				}
				else
				{
					Bd = (Sd >= 0 && Sd <= 31);
				}
			}
			
			return (By && Bm && Bd);
		}
		else
			return false;
	}
	
	this.draw = function(ids, action)
	{
		this.setDay(1);
		var fact = 0;
		if(this.mm == 1 && ((this.yy % 4 == 0) && ((this.yy % 100 != 0) || (this.yy % 400 == 0))))
			fact = 1;
		
		var code = '<div class=\'XAGCalendar\'><table class=\'Calendar\'>';
		code = code+'<tr class=\'CalendarMark\'><td colspan=\'6\'>ICE Calendar</td><td class=\'CalendarButton\' onClick=\''+action+'(this, "'+ids+'")\'>X</td></tr>';
		code = code+'<tr class=\'CalendarMark\'><td class=\'CalendarButton\' onClick=\''+action+'(this, "'+ids+'")\'><+</td><td class=\'CalendarButton\' onClick=\''+action+'(this, "'+ids+'")\'><<</td><td colspan=\'3\'>'+this.yy+'</td><td class=\'CalendarButton\' onClick=\''+action+'(this, "'+ids+'")\'>>></td><td class=\'CalendarButton\' onClick=\''+action+'(this, "'+ids+'")\'>+></td></tr>';
		code = code+'<tr class=\'CalendarMark\'><td class=\'CalendarButton\' onClick=\''+action+'(this, "'+ids+'")\'><</td><td colspan=\'5\'>'+this.monthList.keys[this.mm]+'</td><td class=\'CalendarButton\' onClick=\''+action+'(this, "'+ids+'")\'>></td></tr>';
		code = code+'<tr class=\'CalendarWeek\'><td>Dom</td><td>Lun</td><td>Mar</td><td>Mie</td><td>Jue</td><td>Vie</td><td>Sab</td></tr>';
			
		var tmp = '';	
		var lim = (parseInt(this.monthList.values[this.mm])+fact);
		var mov = 0;
		
		for(var i=0; i<this.dia; i++)
		{
			mov++;
			tmp = tmp+'<td></td>';
		}
		
		for(var i=mov; i<(lim+mov); i++)
		{
			tmp = tmp+'<td onClick=\''+action+'(this, "'+ids+'")\'>'+((i-mov)+1)+'</td>';
			
			if( ((i+1) % 7) == 0)
			{
				code = code+'<tr>'+tmp+'</tr>';
				tmp = '';	
			}
		}
		
		if(tmp != '')
				code = code+'<tr>'+tmp+'</tr>';
		code = code+'</table></div>';
		
		return code;
	}
	
	this.make(Vy, Vm-1, Vd);
}
