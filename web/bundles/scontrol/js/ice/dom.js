function gId(name)
{
    return document.getElementById(name);
}

function gIf(ifId, obId)
{
	return document.getElementById(ifId).contentWindow.document.getElementById(obId);
}

function gTag(elem, tag)
{
    return elem.getElementsByTagName(tag);
}

function switchView(ids)
{
    if(gId(ids).style.display == 'none')
        gId(ids).style.display = 'block';
    else
        gId(ids).style.display = 'none';
}

function alargar(ids, tam, lim)
{
    if(tam == undefined)
        tam = 0;

    if(lim == undefined)
        lim = 100;

    var suma = 5;
    var obj = gId(ids);

    alert(obj.offsetHeigth);

    tam += suma;

    if (tam <= lim)
    {
        obj.style.height = tam+"%";
        window.setTimeout ("alargar('"+ids+"', "+tam+", "+lim+");", 100);
    }
}

function aparecer(ids, color, lim)
{
    if(color == undefined)
        color = 0;

    if(lim == undefined)
        lim = 100;

    var suma = 5;
    var obj = gId(ids);

    obj.style.display = "block";
    color += suma;

    if(color <= lim)
    {
        obj.style.filter = 'alpha(opacity='+color+')';
        obj.style.opacity = color /100;
        obj.style.MozOpacity = color /100;
        obj.style.KHTMLOpacity = color /100;
        window.setTimeout ("aparecer('"+ids+"', "+color+", "+lim+");", 100);
    }
}

function desaparecer(ids, color, lim)
{
    if(color == undefined)
        color = 100;

    if(lim == undefined)
        lim = 0;

    var resta = 5;
    var obj = gId(ids);

    obj.style.display = "block";
    color -= resta;

    if(color <= lim)
        obj.style.display = "none";

    if(color >= lim)
    {
        obj.style.filter = 'alpha(opacity='+color+')';
        obj.style.opacity = color /100;
        obj.style.MozOpacity = color /100;
        obj.style.KHTMLOpacity = color /100;
        window.setTimeout ("desaparecer('"+ids+"', "+color+");", 100);
    }
}

function switchHeigt(ids, minH, maxH)
{
    if(gId(ids).style.height == minH)
        gId(ids).style.height = maxH;
    else
        gId(ids).style.height = minH;
}

function switchWidth(ids, minW, maxW)
{
    if(gId(ids).style.width == minW)
        gId(ids).style.width = maxW;
    else
        gId(ids).style.width = minW;
}

function removeNode(id)
{
    var node = gId(id);
    node.parentNode.removeChild(node);
}

function show(ids)
{
    gId(ids).style.display = 'inline';
}

function hide(ids)
{
    gId(ids).style.display = 'none';
}

function clean(fields)
{
    for(var i=0; i < fields.length; i++)
        gId(fields[i]).value = '';
}

function creaFlot(id, cont, titulo, base)
{
    if(typeof base == "undefined")
            base = "#B8C2DC";
    if(typeof titulo == "undefined")
            titulo = "Click Aqui Para Cerrar";

    main = document.createElement("DIV");
    main.id = id;
    main.style.width = "100%";
    main.style.height = "100%";
    main.style.position = "absolute";
    main.style.top = "0px";
    main.style.left = "0px";

    div = document.createElement("DIV");
    div.style.width = "100%";
    div.style.height = "100%";
    div.style.position = "absolute";
    div.style.top = "0px";
    div.style.left = "0px";
    div.style.background = base;
    div.style.opacity = "0.2";

    table = document.createElement("TABLE");
    table.style.width = "100%";
    table.style.height = "100%";
    table.style.position = "absolute";
    table.style.top = "0px";
    table.style.left = "0px";

    tr = document.createElement("TR");
    td = document.createElement("TD");
    td.setAttribute("align", "center");

    tableI = document.createElement("TABLE");
    tableI.style.background = "#FFFFFF";
    tableI.setAttribute("cellspacing", "5");
    tableI.style.border = "1px solid #2E94CB";
    tableI.style.padding = "10px";

    trT = document.createElement("TR");

    tdC = document.createElement("TD");
    tdC.setAttribute("class", "btnHelpCerrar");
    tdC.setAttribute("onClick", "removeNode('"+id+"');");
    tdC.innerHTML = '<h3>'+titulo+'</h3>';
    tdC.setAttribute("align", "center");
    tdC.style.cursor = "pointer";
    tdC.style.border = "1px solid #2E94CB";
    tdC.style.padding = "2px";

    trT.appendChild(tdC);

    trI = document.createElement("TR");
    tdI = document.createElement("TD");
    tdI.setAttribute("align", "center");
    td.style.overflow = "auto";
    tdI.style.maxHeigt = '100%';

    datdiv = document.createElement("DIV");
    datdiv.style.overflow = "auto";
    datdiv.style.maxHeight = '530px';
    datdiv.innerHTML = cont;

    tdI.appendChild(datdiv);
    trI.appendChild(tdI);

    tableI.appendChild(trT);
    tableI.appendChild(trI);

    td.appendChild(tableI);
    tr.appendChild(td);
    table.appendChild(tr);
    main.appendChild(div);
    main.appendChild(table);
    document.body.appendChild(main);
}

function creaPop(id, cont, posX, posY)
{
    if(typeof posX == "undefined")
            posX = 0;
    if(typeof posY == "undefined")
            posY = 0;
    if(typeof base == "undefined")
            base = "#B8C2DC";

    main = document.createElement("DIV");
    main.id = id;
    main.style.position = "absolute";
    main.style.top = posY+'%';
    main.style.left = posX+'%';
    main.innerHTML = cont;
    document.body.appendChild(main);
}

function formFocus(elem, control)
{
    var arr = gTag(gId(elem), control);
    if(arr.length > 0)
    {
        for(var i=0; i<arr.length; i++)
        {
            if(!arr[i].getAttribute('readonly') && !arr[i].getAttribute('disabled'))
            {
                arr[i].focus();
                break;
            }
        }
    }
}
