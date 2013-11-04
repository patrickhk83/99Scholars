$(function(){
	$('#attachment-tab a:first').tab('show');
	
	$('#join-btn').click(function () {
		alert('Thanks for joining this seminar');
		
		var html = '<tr style="display:none">' + 
			'<td width="40px"><img src="img/avatar.jpg" width="40"/></td>' +
		  '<td>' +
		    '<p><a href="#"><strong>John Doe</strong></a> <br/> <small class="text-muted">Massachusetts Institute of Technology</small></p>' +
		    '<p></p>' +
		  '</td>' +
		'</tr>';
		
		var ele = $(html);
		
		$('#attendee-list').append(ele);
		ele.show('slow');
		
		return false;
	});
});