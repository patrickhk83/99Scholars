var isDegreeLoaded = false;

var baseEditUrl = document.URL + '/';

$(function(){
	
	$('.datepicker').datepicker({
		autoclose: true
	});

	$('#profile-tab a:first').tab('show');
	$('#gen-info-save-btn').click(saveGeneralInfo);

	$('#degree-link').click(loadDegreeTab);
});

var saveGeneralInfo = function()
{
	var url = baseEditUrl + 'general';
	var data = $('#gen-info-form').serialize();

	$.post(url, data, function(data){
		alert('ok');
	});
}

var loadDegreeTab = function()
{
	if(!isDegreeLoaded)
	{
		var url = baseEditUrl + 'degree';

		$.get(url, function(data){
			$('#degree').html(data);
			isDegreeLoaded = true;
		});
	}
}