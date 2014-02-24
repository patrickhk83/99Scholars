function delete_comment(comment_id)
{
	var baseUrl = $('#base-url').val();
	baseUrl = baseUrl + "comment/delete/" + comment_id;
	var data = null;
	var r=confirm("Wanna delete this file?");
	if (r==true){

		$.post(baseUrl, data, function(response){
			location.reload();	
		});
	}
/*	
	$('#username').html(user_name);
	$('#commentdesc').html(comment);
	$('#comment-edit-container').dialog({
			modal: true,
			width: 720
		});
	var content = 'Edit comment';
	$( ".ui-dialog-title" ).html(content);
	$( "#edit_comment" ).click(function( e ) {
		var newdesc = $('#commentdesc').val();
		edituploadfile(username, confid, newdesc, edit_id);
		e.stopImmediatePropagation();
	      });
*/	      
}
