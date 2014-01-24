var baseUrl = '';
var moduleName = 'conference';
var baseConfUrl = '';

$(function(){
	
	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";
	
	$('#schedule-tab a:first').tab('show');

	$("#schedule_session" ).click(function( e ) {
		session_add();
		e.stopImmediatePropagation();
	});
	$("#schedule_room" ).click(function( e ) {
		room_add();
		e.stopImmediatePropagation();
	});
	$("#schedule_time" ).click(function( e ) {
		time_add();
		e.stopImmediatePropagation();
	});
	$("#schedule_presentation" ).click(function( e ) {
		presentation_add();
		e.stopImmediatePropagation();
	});
	
	$("#session_room3" ).click(function(  ) {
		session_display_data_1();
	});
	
	$("#session_room3" ).change(function(  ) {
		session_display_data_1();
	});
	
	$("#presentation_slot" ).click(function(  ) {
		session_display_data_2();
	});
	
	$("#presentation_slot" ).change(function(  ) {
		session_display_data_2();
	});
});

	

function session_add() {
	var confId = $('#conf-id').val();
	var url = baseConfUrl + 'insert/' + confId;
	var data = $('#form-session').serialize()+"&type=session";
	
	$.post(url, data, function(response){
		var myDate=response.date;
		myDate=myDate.split("-");
		var content = '<tr><td>'+myDate[0]+'</td><td>'+response.name+'</td></tr>';
		$('#session_body').append(content);
		location.reload();
	});
}

function room_add() {
	var confId = $('#conf-id').val();
	var url = baseConfUrl + 'insert/' + confId;
	var data = $('#form-room').serialize()+"&session_id="+$('#session_room1').val()+"&type=room";
	
	$.post(url, data, function(response){
		var content = '<tr><td>'+response.name+'</td><td>'+response.session+'</td></tr>';
		$('#room_body').append(content);
		location.reload();
	});
}

function time_add() {
	var confId = $('#conf-id').val();
	var url = baseConfUrl + 'insert/' + confId;
	var data = $('#form-time').serialize()+"&session_id="+$('#session_room2').val()+"&type=time";
	
	$.post(url, data, function(response){
		var content = '<tr><td>'+response.session+'</td><td>'+response.start_time+'</td><td>'+response.end_time+'</td></tr>';
		$('#time_body').append(content);
		location.reload();
	});
}

function presentation_add() {
	var confId = $('#conf-id').val();
	var url = baseConfUrl + 'insert/' + confId;
	var data = $('#form-presentation').serialize()+"&session_id="+$('#session_room3').val()+"&room_id="+$('#presentation_room').val()+"&time_id="+$('#presentation_time').val()+"&end_time_id="+$('#presentation_endtime').val()+"&type=presentation";
	
	$.post(url, data, function(response){
		location.reload();
	});
}

function session_display_data_1() {
	var confId = $('#conf-id').val();
	var url = baseConfUrl + 'get/' + confId;
	var data = "session_id="+$('#session_room3').val();
	
	$.post(url, data, function(response){
		var content1 = '';
		var content2 = '';
		var myArray1 = '';
		var myArray2 = '';
		$('#presentation_room').empty();
		$('#presentation_time').empty();
		$.each( response.room, function( key, value ) {
			myArray1 = value.room.split('^^^^');
			content1 += '<option value="'+myArray1[1]+'">'+myArray1[0]+'</option>';
		});
		$('#presentation_room').append(content1);
		$.each( response.time, function( key, value ) {
			myArray2 = value.time.split('^^^^');
			content2 += '<option value="'+myArray2[1]+'">'+myArray2[0]+'</option>';
		});
		$('#presentation_time').append(content2);
	});
}

function session_display_data_2() {
	var value = $('#presentation_slot').val();
	if (value == 3) {
		var content = $('#presentation_time').html();
		$('#presentation_endtime').html(content);
	}else {
		$('#presentation_endtime').html('');
	}
}