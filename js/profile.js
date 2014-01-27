var baseUrl = '';
var moduleName = 'profile';
var baseViewUrl = '';

var isEventLoaded = false;
var isPublicationLoaded = false;
var isProjectLoaded = false;
var isPresentationLoaded = false;
var isFollowerLoaded = false;
var isFollowingLoaded = false;

$(function(){

	baseUrl = $('#base-url').val();
	baseViewUrl = baseUrl + moduleName + "/";

	$('#profile-tab a:first').tab('show');

	$('#event-link').click(loadEventTab);
	$('#publication-link').click(loadPublicationTab);
	$('#project-link').click(loadProjectTab);
	$('#presentation-link').click(loadPresentationTab);
	$('#following-link').click(loadFollowingTab);
	$('#follower-link').click(loadFollowerTab);

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

var projectEnabler = function()
{
	var container = $('#project-container');
	
	if($('#project-check').is(':checked'))
	{
		container.show(400);
	}
	else
	{
		container.hide(400);
	}
}

var presentationEnabler = function()
{
	var container = $('#presentation-container');
	
	if($('#presentation-check').is(':checked'))
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
			$('#project-check').change(projectEnabler);
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
			$('#presentation-check').change(presentationEnabler);
		});
	}
}

var loadFollowingTab = function()
{
	if(!isFollowingLoaded)
	{
		var url = baseViewUrl + 'following/' + $('#user-id').val();

		$.get(url, function(data){
			$('#following').html(data);
			isPresentationLoaded = true;
		});
	}
}

var loadFollowerTab = function()
{
	if(!isFollowerLoaded)
	{
		var url = baseViewUrl + 'follower/' + $('#user-id').val();

		$.get(url, function(data){
			$('#follower').html(data);
			isPresentationLoaded = true;
		});
	}
}

function followUserFacade(e)
{
	followUser(e.data.id, e.data.element);
}

function followUser(userId, element)
{
	var btn = $(element);
	displayProgress(btn);

	var url = baseUrl + 'user/follow/' + userId;

	$.get(url, function(data){
		btn.removeClass('btn-default').addClass('btn-warning');
		btn.text('Unfollow');

		btn.prop("onclick", null);

		btn.off('click').on('click', {id: userId, element: btn}, unfollowUserFacade);
	});
}

function unfollowUserFacade(e)
{
	unfollowUser(e.data.id, e.data.element);
}

function unfollowUser(userId, element)
{
	var btn = $(element);
	displayProgress(btn);

	var url = baseUrl + 'user/unfollow/' + userId;

	$.get(url, function(data){
		btn.removeClass('btn-default').addClass('btn-success');
		btn.text('Follow');

		btn.prop("onclick", null);

		btn.off('click').on('click', {id: userId, element: btn}, followUserFacade);
	});
}


function displayProgress(btn)
{
	btn.removeClass('btn-success btn-warning').addClass('btn-default');
	btn.text('Working ').append('<img src="' + baseUrl + 'img/loader.gif">');
}