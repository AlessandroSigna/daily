$(function()
{
	$('ul#Navigazione li a#Logout').clic(function(){
	if(confirm('Sei sicuro di voler effettuare il logout?'))
	{return true;}
	return false;
	})
});