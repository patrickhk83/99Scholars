var baseUrl = '';
var moduleName = 'conference';
var baseConfUrl = '';
var baseProfileUrl = ''

$(function(){

	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";
	baseProfileUrl = baseUrl + 'user/profile/';

	$('#attachment-tab a:first').tab('show');
	
	$('#join-btn').click(joinSeminar);
	$('#suggest-join-btn').click(joinSeminar);
	$('#top-join-btn').click(joinSeminar);
});

var joinSeminar = function(e)
{
	var btn = $(e.target);
	displayProgress(btn);

	var confId = $('#conf-id').val();

	var url = baseConfUrl + 'attend/' + confId;

	$.get(url, function(data){

		var bookBtn = $('.book-conf-btn');
		bookBtn.removeClass('btn-default btn-primary').addClass('btn-info');
		bookBtn.text('Cancel booking');

		alert('Thanks for joining this seminar');
		
		var html = '<tr style="display:none">' + 
			'<td width="40px"><img src="' + baseUrl + '/img/avatar.jpg" width="40"/></td>' +
		  '<td>' +
		    '<p><a href="' + baseProfileUrl + data.id + '"><strong>' + data.name + '</strong></a> <br/> <small class="text-muted">Massachusetts Institute of Technology</small></p>' +
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

function displayProgress(btn)
{
	btn.removeClass('btn-primary btn-info').addClass('btn-default');
	btn.text('Working ').append('<img src="' + baseUrl + 'img/loader.gif">');
}