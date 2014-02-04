var baseUrl = '';
var moduleName = 'conference';
var baseConfUrl = '';
var baseProfileUrl = '';

$(function(){

	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";
	baseProfileUrl = baseUrl + 'user/profile/';

	$('#attachment-tab a:first').tab('show');
	
	$( "#add-video-btn" ).click(opendialog);
	
	$( "#add-file-btn" ).click(opendialog2);
	
	$( "#add-photo-btn" ).click(opendialog3);
	
	$('.book-conf-btn').each(function(index){
		$(this).on('click', joinSeminar);
	});

	$('.cancel-book-btn').each(function(index){
		$(this).on('click', cancelBooking);
	});

	$('#add-topic-btn').on('click', addTopic);

	$('#back-topic-link').on('click', function(){
		$('#topic-detail').empty();
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
			
			var html = '<tr style="display:none" id="attendee-' + data.id + '">' + 
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

var opendialog = function(e)
{
	$("#video-upload-container").dialog({
			modal: true,
			width: 600
		});
	var content = 'Add YouTube\'s video';
	$( ".ui-dialog-title" ).html(content);
	$( "#add_video" ).click(function( e ) {
		uploadvideo();
		e.stopImmediatePropagation();
	      });
}

var opendialog2 = function(e)
{
	$('#file-upload-container').dialog({
			modal: true,
			width: 600
		});
	var content = 'Upload attachment for this event';
	$( ".ui-dialog-title" ).html(content);
	$( "#add_file" ).click(function( e ) {
		uploadfile();
		e.stopImmediatePropagation();
	      });
}

var opendialog3 = function(e)
{
	$('#photo-upload-container').dialog({
			modal: true,
			width: 600
		});
	var content = 'Upload photo of this event';
	$( ".ui-dialog-title" ).html(content);
	
	$( "#add_photo" ).click(function( e ) {
		$("#photo-upload-container").dialog('close');
		e.stopImmediatePropagation();
	      });
}

function uploadvideo() {
	var confId = $('#conf-id').val();
	var userId = $('#user-id').val();
	var url = baseConfUrl + 'upload/' + confId;
	var data = $('#form-video').serialize()+"&type=video";
		$("#video-upload-container").dialog('close');
	
	$.post(url, data, function(response){
		if (userId == response.id) {
			var content = '<div id="'+response.videoid+'"><iframe width="560" height="315" src="http://www.youtube.com/embed/'+response.videoid+'?rel=0" frameborder="0" allowfullscreen></iframe><p class="text-right" onclick="deletevideo(\''+confId+'\',\''+response.videoid+'\');"><a href="#">delete</a></p></div>';
		}else {
			var content = '<div id="'+response.videoid+'"><iframe width="560" height="315" src="http://www.youtube.com/embed/'+response.videoid+'?rel=0" frameborder="0" allowfullscreen></iframe>';
		}
		$("#flex-video").append(content);
	});
}

function uploadfile() {
	var confId = $('#conf-id').val();
	var url = baseConfUrl + 'uploadfile/' + confId;
	$("#file-upload-container").dialog('close');
	
	/*var fileInput = document.getElementById("filename");
	
	var files = fileInput.files;
	var file;
	var filename = new Array();
	var filesize = new Array();
	var filetype = new Array();

	for (var i = 0; i < files.length; i++) {
	    file = files.item(i);
	    file = files[i];
	
	    filename[i] = file.name+"|";
	    filesize[i] = file.size+"|";
	    filetype[i] = file.type+"|";
	}
	
	var desc = $('#filedesc').val();
	var data = "filedesc="+desc+"&name="+filename+"&size="+filesize+"&filetype="+filetype+"&type=file";*/
	/*var data = '';
	
	$.post(url, data,function(response){
		//var content = '<div id="'+response.videoid+'"><iframe width="560" height="315" src="http://www.youtube.com/embed/'+response.videoid+'?rel=0" frameborder="0" allowfullscreen></iframe><p class="text-right" onclick="deletevideo(\''+confId+'\',\''+response.videoid+'\');"><a href="#">delete</a></p></div>';
		//$("#flex-video").append(content);
	});*/
}

function deletefile(filename, confid,deleteid) {
	var url = baseConfUrl + 'delete/' + confid;
	var data = "filename="+filename+"&type=file";
	
	var r=confirm("Wanna delete this file?");
	if (r==true){
		$("#"+deleteid).remove();
		$.post(url, data, function(response){
		});
	}
}

function deletephoto(photoname, confid,deleteid) {
	var url = baseConfUrl + 'delete/' + confid;
	var data = "photoname="+photoname+"&type=photo";
	
	var r=confirm("Wanna delete this photo?");
	if (r==true)
	{
		$("#"+deleteid).remove();
		$.post(url, data, function(response){
		});
	}
}

function editfile(filename, confid, desc, edit_id){
	$('#filename1').html(filename);
	$('#filedesc').html(desc);
	$('#file-edit-container').dialog({
			modal: true,
			width: 600
		});
	var content = 'Edit file\'s description';
	$( ".ui-dialog-title" ).html(content);
	$( "#edit_file" ).click(function( e ) {
		var newdesc = $('#filedesc').val();
		edituploadfile(filename, confid, newdesc, edit_id);
		e.stopImmediatePropagation();
	      });
}

function edituploadfile(filename, confid, newdesc, editid){
	var url = baseConfUrl + 'update/' + confid;
	var data = "filename="+filename+"&desc="+newdesc+"&type=file";
	$("#file-edit-container").dialog('close');
	
	$.post(url, data, function(response){
		$('#'+editid).html(newdesc);
	});
}

function editphoto(photoname, confid, desc, update_id){
	$('#photodesc1').val(desc);
	$('#photo-edit-container').dialog({
			modal: true,
			width: 600
		});
	var content = 'Edit photo\'s caption';
	$( ".ui-dialog-title" ).html(content);
	$('#hiddenval').val(update_id);
	$('#hiddenname').val(photoname);
	$( "#edit_photo" ).click(function( e ) {
		var newdesc = $('#photodesc1').val();
		$newid = $('#hiddenval').val();
		$newname = $('#hiddenname').val();
		edituploadphoto($newname, confid, newdesc, $newid);
		e.stopImmediatePropagation();
	      });
}

function edituploadphoto(photoname, confid, newdesc, updateid){
	var url = baseConfUrl + 'update/' + confid;
	var data = "photoname="+photoname+"&desc="+newdesc+"&type=photo";
	$("#photo-edit-container").dialog('close');
	
	$.post(url, data, function(response){
		$('#'+updateid).attr('title',newdesc);
	});
}

function deletevideo(confid,videoid) {
	var url = baseConfUrl + 'delete/' + confid;
	var data = "videoid="+videoid+"&type=video";
	
	var r=confirm("Wanna delete this video?");
	if (r==true)
	{
		$("#"+videoid).remove();
		$.post(url, data, function(response){
		});
	}
}

var addTopic = function()
{
	var url = baseUrl + 'topic/create';

	var form_data = $('#topic-form').serialize();

	$.ajax({
	    type : "POST", 
	    async : true, 
	    url : url, 
	    dataType : "json", 
	    timeout : 30000, 
	    cache : false, 
	    data : form_data, 
	    error : function(request, status, error) {

	    }, 
	    success : function(response) {
			if(response.status == 'ok')
			{
				var html = $(response.html);

				$('#topics').append(html);
				html.effect('highlight');
			}
			else
			{
				alert(response.message);
			}
	    }
	});			
}

var addComment = function()
{
	var url = baseUrl + 'discuss/create';
	var form_data = $('#comment-form').serialize();
	$.ajax({
	    type : "POST", 
	    async : true, 
	    url : url, 
	    dataType : "json", 
	    timeout : 30000, 
	    cache : false, 
	    data : form_data, 
	    error : function(request, status, error) {

	    }, 
	    success : function(response) {
			if(response.status == 'ok')
			{
				var html = $(response.html);
				$('#comments').append(html);
				html.effect('highlight');
			}
			else
			{
				alert(response.message);
			}

	    }
	});		
}

var showTopic = function(topic_id)
{
	var url = baseUrl + 'topic/view/';// + topic_id;
	$('#topics-container').effect('drop', function(){

		$.ajax({
		    type : "POST", 
		    async : true, 
		    url : url, 
		    dataType : "json", 
		    timeout : 30000, 
		    cache : false, 
		    data : {term:topic_id}, 
		    error : function(request, status, error) {

		    }, 
		    success : function(response) {
				if(response.status == 'ok')
				{
					$('#topic-detail').html(response.html);
					$('#topic-detail-container').show();
					$('#add-comment-btn').on('click', addComment);
				}
				else
				{
					alert(response.message);
				}
		    }
		});			
	});

	return false;
}

function displayProgress(btn)
{
	btn.removeClass('btn-primary btn-info').addClass('btn-default');
	btn.text('Working ').append('<img src="' + baseUrl + 'img/loader.gif">');
}
