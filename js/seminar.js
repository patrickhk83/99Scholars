var baseUrl = '';
var moduleName = 'conference';
var baseConfUrl = '';
var baseProfileUrl = ''

$(function(){

	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";
	baseProfileUrl = baseUrl + 'user/profile/';

	$('#attachment-tab a:first').tab('show');
	
	$('#join-btn').on('click', joinSeminar);
	$('#suggest-join-btn').on('click', joinSeminar);
	$('#top-join-btn').on('click', joinSeminar);
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

		$('.book-conf-btn').each(function(index){
			$(this).off('click').on('click', cancelBooking);
		});

		alert('Thanks for joining this seminar');
		
		var html = '<tr style="display:none" id="attendee-"' + data.id + '>' + 
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

var cancelBooking = function(e)
{
	var btn = $(e.target);
	displayProgress(btn);

	var confId = $('#conf-id').val();

	var url = baseConfUrl + 'cancel/' + confId;

	$.get(url, function(data){
		var bookBtn = $('.book-conf-btn');
		bookBtn.removeClass('btn-info').addClass('btn-primary');
		bookBtn.text('Attend this seminar');

		$('#attendee-' + data.id).remove();
	});


	return false;
}

function displayProgress(btn)
{
	btn.removeClass('btn-primary btn-info').addClass('btn-default');
	btn.text('Working ').append('<img src="' + baseUrl + 'img/loader.gif">');
}