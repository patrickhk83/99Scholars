$(function(){
	$('#profile-tab a:first').tab('show');
	
	$('#journal-check').change(journalEnabler);
	$('#conf-check').change(conferenceEnabler);
	$('#chapter-check').change(chapterEnabler);
	$('#book-check').change(bookEnabler);
	
});

var journalEnabler = function() 
{
	var container = $('#journal-listing-container');
	
	if($('#journal-check').is(':checked'))
	{
		container.show(400);
	}
	else
	{
		container.hide(400);
	}
}

var conferenceEnabler = function() 
{
	var container = $('#conf-proc-container');
	
	if($('#conf-check').is(':checked'))
	{
		container.show(400);
	}
	else
	{
		container.hide(400);
	}
}

var chapterEnabler = function()
{
	var container = $('#book-chapter-container');
	
	if($('#chapter-check').is(':checked'))
	{
		container.show(400);
	}
	else
	{
		container.hide(400);
	}
}

var bookEnabler = function()
{
	var container = $('#book-container');
	
	if($('#book-check').is(':checked'))
	{
		container.show(400);
	}
	else
	{
		container.hide(400);
	}
}