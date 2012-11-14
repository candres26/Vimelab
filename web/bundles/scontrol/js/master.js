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
