var baseUrl = '';
var moduleName = 'messages';
var baseConfUrl = '';

$(function(){
	baseUrl = $('#base-url').val();
	baseConfUrl = baseUrl + moduleName + "/";
	$( "#add-message-btn" ).click(opendialog100);
	$('#message_edit_button').click(function() {
                                      message_edit();
                           });
});

var opendialog100= function(e)
{
	$("#new-message-container").dialog({
		   modal: true,
		   width: 450
	});
        
	var content = 'Send new message';
	$( ".ui-dialog-title" ).html(content);
	$( "#message_button" ).click(function( e ) {
                   messagesend();
                   e.stopImmediatePropagation();
	});
}
	
function messagesend() {
         var url = baseConfUrl + 'insert/' ;
         var data = "receiver_id="+$('#receiver_name').val()+"&message="+$('#send_message').val();
         $("#new-message-container").dialog('close');

         $.post(url, data, function(response){
                   location.reload();        
         });
}

/*function edittab(conversationid, receiverid) {
          var url = baseConfUrl + 'edit/'+conversationid ;
          
          $.get(url, function(data){
                   $('#container-message').html(data);
                   $('#message_edit_button').click(function() {
                                      message_edit(conversationid, receiverid);
                           });
          });
}*/

function message_edit() {
          var conversationid = $('#conv-id').val();
          var receiverid = $('#receiver-id').val();
          var url = baseConfUrl + 'addinsert/' ;
          var data = "receiver_id="+receiverid+"&message="+$('#send_edit_message').val()+"&conversationid="+conversationid;
          
          $.post(url, data, function(response){
                   $('#send_edit_message').val('');
                   location.reload();        
          });
}

