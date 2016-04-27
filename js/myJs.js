
function courseSave() 
{		
var e = document.getElementById("credit");
$.ajax(
{
	url : 'checkTime.php',
	data : {
		username : e,
		
		},
	success : function(data) {});		

}
