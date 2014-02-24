var baseUrl = '';
var moduleName = 'conference';
var baseConfUrl = '';
var baseProfileUrl = '';

$(function(){
	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";
	baseProfileUrl = baseUrl + 'user/profile/';

	$('#attachment-tab a:first').tab('show');

	$("#delete_conference").click(delete_conference);
	$("#edit_conference").click(edit_conference);
});

var edit_conference = function()
{
	var confId = $('#conf-id').val();
	var url = baseConfUrl + "edit_conference/" + confId;
	location.replace(url);
}

var delete_conference = function()
{
	var confId = $('#conf-id').val();

	if(confirm("Are you sure?"))
	{
		var url = baseConfUrl + "delete_conference/" + confId;
		location.replace(url);
	}
	
}
