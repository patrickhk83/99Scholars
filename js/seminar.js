var baseUrl = '';
var moduleName = 'conference';
var baseConfUrl = '';
var baseProfileUrl = ''

$(function(){

	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";
	baseProfileUrl = baseUrl + 'user/profile/';

	$('#attachment-tab a:first').tab('show');
	
	$('.book-conf-btn').each(function(index){
		$(this).on('click', joinSeminar);
	});

	$('.cancel-book-btn').each(function(index){
		$(this).on('click', cancelBooking);
	});

	$('.topic-title').each(function(index){
		$(this).on('click', function(){
			$('#topics-container').effect('drop', function(){
				$('#topic-detail-container').show();
			});

			return false;
		});
	});

	$('#back-topic-link').on('click', function(){
		$('#topic-detail-container').hide();
		$('#topics-container').effect('slide');
		return false;
	});
});

var joinSeminar = function(e)
{
	var btn = $(e.target);
	displayProgress(btn);

	var confId = $('#conf-id').val();

	var url = baseConfUrl + 'attend/' + confId;

	$.get(url, function(data){

		if(data.status == 'ok')
		{
			var bookBtn = $('.book-conf-btn');
			bookBtn.removeClass('btn-default btn-primary book-conf-btn').addClass('btn-info cancel-book-btn');
			bookBtn.text('Cancel booking');

			$('.cancel-book-btn').each(function(index){
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
		}
		else
		{
			alert(data.message);
			btn.removeClass('btn-default').addClass('btn-primary');
			btn.text('Attend this seminar');
		}
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
		var bookBtn = $('.cancel-book-btn');
		bookBtn.removeClass('btn-info cancel-book-btn').addClass('btn-primary book-conf-btn');
		bookBtn.text('Attend this seminar');

		$('.book-conf-btn').each(function(index){
			$(this).on('click', joinSeminar);
		});

		$('#attendee-' + data.id).remove();
	});


	return false;
}

function displayProgress(btn)
{
	btn.removeClass('btn-primary btn-info').addClass('btn-default');
	btn.text('Working ').append('<img src="' + baseUrl + 'img/loader.gif">');
}