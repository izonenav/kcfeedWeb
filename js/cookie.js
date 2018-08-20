$(document).ready(function()
{
	var introPopup = Cookies.get('introPopup');
	if(introPopup !== 'N')
	{
		$("#myModal").modal();
	}
	else
	{
		return;
	}
})

function noShowPopup()
{
	Cookies.set('introPopup', 'N', { expires: 1 });
}