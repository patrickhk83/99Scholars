var isDegreeLoaded = false;

var baseUrl = '';
var moduleName = 'profile';
var baseEditUrl = '';

$(function(){
	
	baseUrl = $('#base-url').val();
	baseEditUrl = baseUrl + moduleName + "/";

	$('.datepicker').datepicker({
		autoclose: true
	});

	$('#profile-tab a:first').tab('show');
	$('#gen-info-save-btn').click(saveGeneralInfo);

	$('#degree-link').click(loadDegreeTab);
});

var saveGeneralInfo = function()
{
	var url = baseEditUrl + 'update/general';
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