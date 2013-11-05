var baseUrl = '';
var moduleName = 'profile';
var baseViewUrl = '';

var isEventLoaded = false;
var isPublicationLoaded = false;
var isProjectLoaded = false;
var isPresentationLoaded = false;

$(function(){

	baseUrl = $('#base-url').val();
	baseViewUrl = baseUrl + moduleName + "/";

	$('#profile-tab a:first').tab('show');

	$('#event-link').click(loadEventTab);
	$('#publication-link').click(loadPublicationTab);
	$('#project-link').click(loadProjectTab);
	$('#presentation-link').click(loadPresentationTab);

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

var loadEventTab = function()
{
	if(!isEventLoaded)
	{
		var url = baseViewUrl + 'event/' + $('#user-id').val();

		$.get(url, function(data){
			$('#event').html(data);
			isEventLoaded = true;
		});
	}
}

var loadPublicationTab = function()
{
	if(!isPublicationLoaded)
	{
		var url = baseViewUrl + 'publication/' + $('#user-id').val();

		$.get(url, function(data){
			$('#publication').html(data);
			isPublicationLoaded = true;

			$('#journal-check').change(journalEnabler);
			$('#conf-check').change(conferenceEnabler);
			$('#chapter-check').change(chapterEnabler);
			$('#book-check').change(bookEnabler);
		});
	}
}

var loadProjectTab = function()
{
	if(!isProjectLoaded)
	{
		var url = baseViewUrl + 'project/' + $('#user-id').val();

		$.get(url, function(data){
			$('#project').html(data);
			isProjectLoaded = true;
		});
	}
}

var loadPresentationTab = function()
{
	if(!isPresentationLoaded)
	{
		var url = baseViewUrl + 'presentation/' + $('#user-id').val();

		$.get(url, function(data){
			$('#presentation').html(data);
			isPresentationLoaded = true;
		});
	}
}