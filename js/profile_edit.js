var baseUrl = '';
var moduleName = 'profile';
var baseEditUrl = '';

var isDegreeLoaded = false;
var isPositionLoaded = false;
var isJournalLoaded = false;
var isconfprocLoaded = false;
var ischapterLoaded = false;
var isbookLoaded = false;
var isprojectLoaded = false;
var ispresentationLoaded = false;
var counter = 2;

$(function(){
	
	baseUrl = $('#base-url').val();
	baseEditUrl = baseUrl + moduleName + "/";

	$('.datepicker').datepicker({
		autoclose: true
	});

	$('#profile-tab a:first').tab('show');

	$('#gen-info-save-btn').click(updateGeneralInfo);

	$('#degree-link').click(loadDegreeTab);
	$('#position-link').click(loadPositionTab);
	$('#journal-link').click(loadJournalTab);
	$( "#confproc-link" ).click(function() {
		loadconfprocTab();
	      });
	$( "#chapter-link" ).click(function() {
		loadchapterTab();
	      });
	$( "#project-link" ).click(function() {
		loadprojectTab();
	      });
	$( "#book-link" ).click(function() {
		loadbookTab();
	      });
	$( "#presentation-link" ).click(function() {
		loadpresentationTab();
	      });
});

var updateGeneralInfo = function()
{
	var url = baseEditUrl + 'update/general';
	var data = $('#gen-info-form').serialize();

	$.post(url, data, function(data){
		alert('ok');
	});
}

var saveDegreeInfo = function()
{
	var url = baseEditUrl + 'create/degree';
	var data = $('#degree-form').serialize();

	$.post(url, data, function(data){
		alert('ok');
		//TODO: get display text from json response
		var degree_type = $('#degree-type').val();
		var html = '<tr><td>' + $('#degree-type option[value="' + degree_type + '"]').text() + ', ' + $('#major').val() + ', ' + $('#graduated-university').val() + ', ' + $('#graduated-year').val() + '</td>' +
					'<td><span class="glyphicon glyphicon-pencil"></span></td>' + 
            		'<td><span class="glyphicon glyphicon-trash"></span></td>';

        $('#degree-container').append(html);
        $('#degree-form')[0].reset();
	});
}

var savePositionInfo = function()
{
	var url = baseEditUrl + 'create/position';
	var data = $('#position-form').serialize();

	$.post(url, data, function(data){
		alert('ok');
		//TODO: get display text from json response

		var html = '<tr><td>' + $('#position-title').val() + '<br>' +
                  '<span class="text-muted">' + 
                  $('#position-department').val() + ', ' + $('#position-institute').val() +
                  '</span></td>' +
                  '<td><span class="glyphicon glyphicon-pencil"></span></td>' +
                  '<td><span class="glyphicon glyphicon-trash"></span></td></tr>'

        $('#position-container').append(html);
        $('#position-form')[0].reset();
	});
}

var saveJournalInfo = function()
{
	var url = baseEditUrl + 'create/journal';
	var data = $('#journal-form').serialize();

	$.post(url, data, function(data){
		//alert('ok');
		var html = '<tr><td>' + data.result_to_display + '</td>' +
					'<td><span class="glyphicon glyphicon-pencil"></span></td>' +
                  	'<td><span class="glyphicon glyphicon-trash"></span></td></tr>'

		$('#journal-container').append(html);
		$('#journal-form')[0].reset();
	});
}

var saveconfprocInfo = function()
{
	var url = baseEditUrl + 'create/confproc';
	var data = $('#confproc-form').serialize();

	$.post(url, data, function(data){
		var html = '<tr><td>' + data.result_to_display.last_name + ' ' + data.result_to_display.first_name + ' ' + data.result_to_display.year + ' ' + data.result_to_display.title + ' ' + data.result_to_display.conference + '</td>' +
					'<td><span id="' + data.result_to_display.id + '" title="edit" onclick="editconfprocform(\''+data.result_to_display.first_name+'\',\''+data.result_to_display.last_name+'\',\''+data.result_to_display.year+'\',\''+data.result_to_display.title+'\',\''+data.result_to_display.conference+'\',\''+data.result_to_display.status+'\',\''+data.result_to_display.start+'\',\''+data.result_to_display.end+'\',\''+data.result_to_display.id+'\');" class="glyphicon glyphicon-pencil"></span></td>' +
                  	'<td><span class="glyphicon glyphicon-trash" onclick="deleteconfprocform(\''+data.result_to_display.id+'\');"></span></td></tr>'

		$('#confproc-container').append(html);
		$('#confproc-form')[0].reset();
	});
}

var savechapterInfo = function()
{
	var url = baseEditUrl + 'create/chapter';
	var data = $('#chapter-form').serialize();

	$.post(url, data, function(data){
		var html = '<tr><td>' + data.result_to_display.last_name + ' ' + data.result_to_display.first_name + ' ' + data.result_to_display.year + ' ' + data.result_to_display.title + ' ' + data.result_to_display.book_chapter + '</td>' +
					'<td><span id="' + data.result_to_display.id + '" title="edit" onclick="editchapterform(\''+data.result_to_display.first_name+'\',\''+data.result_to_display.last_name+'\',\''+data.result_to_display.year+'\',\''+data.result_to_display.title+'\',\''+data.result_to_display.book_chapter+'\',\''+data.result_to_display.status+'\',\''+data.result_to_display.start+'\',\''+data.result_to_display.end+'\',\''+data.result_to_display.id+'\');" class="glyphicon glyphicon-pencil"></span></td>' +
                  	'<td><span class="glyphicon glyphicon-trash" onclick="deletechapterform(\''+data.result_to_display.id+'\');"></span></td></tr>'

		$('#chapter-container').append(html);
		$('#chapter-form')[0].reset();
	});
}

var saveprojectInfo = function()
{
	var url = baseEditUrl + 'create/project';
	var data = $('#project-form').serialize();

	$.post(url, data, function(data){
		var html = '<tr><td>' + data.result_to_display.last_name + ' ' + data.result_to_display.first_name + ' ' + data.result_to_display.year + ' ' + data.result_to_display.title + ' ' + data.result_to_display.project_name + '</td>' +
					'<td><span id="' + data.result_to_display.id + '" title="edit" onclick="editprojectform(\''+data.result_to_display.first_name+'\',\''+data.result_to_display.last_name+'\',\''+data.result_to_display.year+'\',\''+data.result_to_display.title+'\',\''+data.result_to_display.project_name+'\',\''+data.result_to_display.status+'\',\''+data.result_to_display.start+'\',\''+data.result_to_display.end+'\',\''+data.result_to_display.id+'\');" class="glyphicon glyphicon-pencil"></span></td>' +
                  	'<td><span class="glyphicon glyphicon-trash" onclick="deleteprojectform(\''+data.result_to_display.id+'\');"></span></td></tr>'

		$('#project-container').append(html);
		$('#project-form')[0].reset();
	});
}

var savepresentationInfo = function()
{
	var url = baseEditUrl + 'create/presentation';
	var data = $('#presentation-form').serialize();

	$.post(url, data, function(data){
		var html = '<tr><td>' + data.result_to_display.last_name + ' ' + data.result_to_display.first_name + ' ' + data.result_to_display.year + ' ' + data.result_to_display.title + ' ' + data.result_to_display.presentation_name + '</td>' +
					'<td><span id="' + data.result_to_display.id + '" title="edit" onclick="editpresentationform(\''+data.result_to_display.first_name+'\',\''+data.result_to_display.last_name+'\',\''+data.result_to_display.year+'\',\''+data.result_to_display.title+'\',\''+data.result_to_display.presentation_name+'\',\''+data.result_to_display.status+'\',\''+data.result_to_display.start+'\',\''+data.result_to_display.end+'\',\''+data.result_to_display.id+'\');" class="glyphicon glyphicon-pencil"></span></td>' +
                  	'<td><span class="glyphicon glyphicon-trash" onclick="deletepresentationform(\''+data.result_to_display.id+'\');"></span></td></tr>'

		$('#presentation-container').append(html);
		$('#presentation-form')[0].reset();
	});
}

var savebookInfo = function()
{
	var url = baseEditUrl + 'create/book';
	var data = $('#book-form').serialize();

	$.post(url, data, function(data){
		var html = '<tr><td>' + data.result_to_display.last_name + ' ' + data.result_to_display.first_name + ' ' + data.result_to_display.year + ' ' + data.result_to_display.title + ' ' + data.result_to_display.book_name + '</td>' +
					'<td><span id="' + data.result_to_display.id + '" title="edit" onclick="editbookform(\''+data.result_to_display.first_name+'\',\''+data.result_to_display.last_name+'\',\''+data.result_to_display.year+'\',\''+data.result_to_display.title+'\',\''+data.result_to_display.book_name+'\',\''+data.result_to_display.status+'\',\''+data.result_to_display.start+'\',\''+data.result_to_display.end+'\',\''+data.result_to_display.id+'\');" class="glyphicon glyphicon-pencil"></span></td>' +
                  	'<td><span class="glyphicon glyphicon-trash" onclick="deletebookform(\''+data.result_to_display.id+'\');"></span></td></tr>'

		$('#book-container').append(html);
		$('#book-form')[0].reset();
	});
}

var loadDegreeTab = function()
{
	if(!isDegreeLoaded)
	{
		var url = baseEditUrl + 'edit/degree';

		$.get(url, function(data){
			$('#degree').html(data);
			isDegreeLoaded = true;
			$('#add-degree-btn').click(saveDegreeInfo);
		});
	}
}

var loadPositionTab = function()
{
	if(!isPositionLoaded)
	{
		var url = baseEditUrl + 'edit/position';

		$.get(url, function(data){
			$('#position').html(data);
			isPositionLoaded = true;
			$('#add-position-btn').click(savePositionInfo);

			/*$('#position-from').datepicker({
				autoclose: true
			});

			$('#position-to').datepicker({
				autoclose: true
			});*/
		});
	}
}

var loadJournalTab = function()
{
	if(!isJournalLoaded)
	{
		var url = baseEditUrl + 'edit/journal';
		
		$.get(url, function(data){
			$('#journal').html(data);
			isJournalLoaded = true;
			$('#add-journal-btn').click(saveJournalInfo);
			$('#add_bttn').click(addmoreinputs);
		});
	}
}

function loadconfprocTab()
{
	var url = baseEditUrl + 'edit/confproc';
	$.get(url, function(data){
		$('#confproc').html(data);
		isconfprocLoaded = true;
		$('#add-confproc-btn').click(saveconfprocInfo);
	});
}

function loadchapterTab() {
	var url = baseEditUrl + 'edit/chapter';
	$.get(url, function(data){
		$('#chapter').html(data);
		ischapterLoaded = true;
		$('#add-chapter-btn').click(savechapterInfo);
	});
}

function loadprojectTab() {
	var url = baseEditUrl + 'edit/project';
	$.get(url, function(data){
		$('#project').html(data);
		isprojectLoaded = true;
		$('#add-project-btn').click(saveprojectInfo);
	});
}

function loadpresentationTab() {
	var url = baseEditUrl + 'edit/presentation';
	$.get(url, function(data){
		$('#presentation').html(data);
		ispresentationLoaded = true;
		$('#add-presentation-btn').click(savepresentationInfo);
	});
}

function loadbookTab() {
	var url = baseEditUrl + 'edit/book';
	$.get(url, function(data){
		$('#book').html(data);
		isbookLoaded = true;
		$('#add-book-btn').click(savebookInfo);
	});
}

function addmoreinputs() {
	$("#add-input-box").append('<input type="text" class="form-control" name="has_coauthor'+counter+'" style="margin-top: 5px;">');
	counter++;
}

function editconfprocform(first_name,last_name,year,title,conference,status,start,end,id)
{
	var url = baseEditUrl + 'edit/confprocedit';
	
	$.get(url, function(data){
		$('#confproc').html(data);
		$('#confproc-title1').val(title);
		$('#confproc1').val(conference);
		$('#confproc-status1').val(status);
		$('#confproc-year1').val(year);
		$('#confproc-start1').val(start);
		$('#confproc-end1').val(end);
		$( "#add-confproc-btn1" ).click(function() {
			updateconfprocInfo(id);
		});
	});
}

function updateconfprocInfo(id)
{
	var url = baseEditUrl + 'update/confproc';
	var data = $('#confproc-form1').serialize()+"&id="+id;
	
	$.post(url, data, function(data){
		$( "#confproc-link" ).trigger( "click" );
	});
}

function deleteconfprocform(id)
{
	var url = baseEditUrl + 'delete/confproc';
	var data = "id="+id;
	
	$.post(url, data, function(data){
		$( "#confproc-link" ).trigger( "click" );
	});
}

function editchapterform(first_name,last_name,year,title,book_chapter,status,start,end,id)
{
	var url = baseEditUrl + 'edit/chapteredit';
	
	$.get(url, function(data){
		$('#chapter').html(data);
		$('#chapter-title1').val(title);
		$('#chapter1').val(book_chapter);
		$('#chapter-status1').val(status);
		$('#chapter-year1').val(year);
		$('#chapter-start1').val(start);
		$('#chapter-end1').val(end);
		$( "#add-chapter-btn1" ).click(function() {
			updatechapterInfo(id);
		});
	});
}

function updatechapterInfo(id)
{
	var url = baseEditUrl + 'update/chapter';
	var data = $('#chapter-form1').serialize()+"&id="+id;
	
	$.post(url, data, function(data){
		$( "#chapter-link" ).trigger( "click" );
	});
}

function deletechapterform(id)
{
	var url = baseEditUrl + 'delete/chapter';
	var data = "id="+id;
	
	$.post(url, data, function(data){
		$( "#chapter-link" ).trigger( "click" );
	});
}

function editprojectform(first_name,last_name,year,title,project_name,status,start,end,id)
{
	var url = baseEditUrl + 'edit/projectedit';
	
	$.get(url, function(data){
		$('#project').html(data);
		$('#project-title1').val(title);
		$('#project1').val(project_name);
		$('#project-status1').val(status);
		$('#project-year1').val(year);
		$('#project-start1').val(start);
		$('#project-end1').val(end);
		$( "#add-project-btn1" ).click(function() {
			updateprojectInfo(id);
		});
	});
}

function updateprojectInfo(id)
{
	var url = baseEditUrl + 'update/project';
	var data = $('#project-form1').serialize()+"&id="+id;
	
	$.post(url, data, function(data){
		$( "#project-link" ).trigger( "click" );
	});
}

function deleteprojectform(id)
{
	var url = baseEditUrl + 'delete/project';
	var data = "id="+id;
	
	$.post(url, data, function(data){
		$( "#project-link" ).trigger( "click" );
	});
}


function editpresentationform(first_name,last_name,year,title,presentation_name,status,start,end,id)
{
	var url = baseEditUrl + 'edit/presentationedit';
	
	$.get(url, function(data){
		$('#presentation').html(data);
		$('#presentation-title1').val(title);
		$('#presentation1').val(presentation_name);
		$('#presentation-status1').val(status);
		$('#presentation-year1').val(year);
		$('#presentation-start1').val(start);
		$('#presentation-end1').val(end);
		$( "#add-presentation-btn1" ).click(function() {
			updatepresentationInfo(id);
		});
	});
}

function updatepresentationInfo(id)
{
	var url = baseEditUrl + 'update/presentation';
	var data = $('#presentation-form1').serialize()+"&id="+id;
	
	$.post(url, data, function(data){
		$( "#presentation-link" ).trigger( "click" );
	});
}

function deletepresentationform(id)
{
	var url = baseEditUrl + 'delete/presentation';
	var data = "id="+id;
	
	$.post(url, data, function(data){
		$( "#presentation-link" ).trigger( "click" );
	});
}

function editbookform(first_name,last_name,year,title,book_name,status,start,end,id)
{
	var url = baseEditUrl + 'edit/bookedit';
	
	$.get(url, function(data){
		$('#book').html(data);
		$('#book-title1').val(title);
		$('#book1').val(book_name);
		$('#book-status1').val(status);
		$('#book-year1').val(year);
		$('#book-start1').val(start);
		$('#book-end1').val(end);
		$( "#add-book-btn1" ).click(function() {
			updatebookInfo(id);
		});
	});
}

function updatebookInfo(id)
{
	var url = baseEditUrl + 'update/book';
	var data = $('#book-form1').serialize()+"&id="+id;
	
	$.post(url, data, function(data){
		$( "#book-link" ).trigger( "click" );
	});
}

function deletebookform(id)
{
	var url = baseEditUrl + 'delete/book';
	var data = "id="+id;
	
	$.post(url, data, function(data){
		$( "#book-link" ).trigger( "click" );
	});
}
