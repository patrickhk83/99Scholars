var baseUrl = '';
var moduleName = 'conference';
var baseConfUrl = '';

$(function(){

	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";

	$('#attachment-tab a:first').tab('show');
	
	$('#join-btn').click(joinSeminar);
	$('#suggest-join-btn').click(joinSeminar);
});

var joinSeminar = function()
{
	var confId = $('#conf-id').val();

	var url = baseConfUrl + 'attend/' + confId;

	$.get(url, function(data){

		alert('Thanks for joining this seminar');
		
		var html = '<tr style="display:none">' + 
			'<td width="40px"><img src="' + baseUrl + '/img/avatar.jpg" width="40"/></td>' +
		  '<td>' +
		    '<p><a href="#"><strong>John Doe</strong></a> <br/> <small class="text-muted">Massachusetts Institute of Technology</small></p>' +
		    '<p></p>' +
		  '</td>' +
		'</tr>';
		
		var ele = $(html);
		
		if($('#attendee-placeholder').length > 0)
		{
			$('#attendee-placeholder').hide();
		}
		
		$('#attendee-list').append(ele);
		ele.show('slow');
	});

	return false;
}