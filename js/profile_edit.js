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

	$('#gen-info-save-btn').click(updateGeneralInfo);

	$('#degree-link').click(loadDegreeTab);
});

var updateGeneralInfo = function()
{
	var url = baseEditUrl + 'update/general';
	var data = $('#gen-info-form').serialize();

	$.post(url, data, function(data){
		alert('ok');
	});
}

var saveDegreeInfo = function()
{
	var url = baseEditUrl + 'create/degree';
	var data = $('#degree-form').serialize();

	$.post(url, data, function(data){
		alert('ok');
	});
}


var loadDegreeTab = function()
{
	if(!isDegreeLoaded)
	{
		var url = baseEditUrl + 'edit/degree';

		$.get(url, function(data){
			$('#degree').html(data);
			isDegreeLoaded = true;
			$('#add-degree-btn').click(saveDegreeInfo);
		});
	}
}