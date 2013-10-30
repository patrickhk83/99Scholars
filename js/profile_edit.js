var baseEditUrl = document.URL;

$(function(){
	
	$('#profile-tab a:first').tab('show');
	$('#gen-info-save-btn').click(saveGeneralInfo);
});

var saveGeneralInfo = function()
{
	var url = baseEditUrl + '/general';
	var data = $('#gen-info-form').serialize();

	$.post(url, data, function(data){
		alert('ok');
	});
}