var baseUrl = '';
var moduleName = 'conference';
var baseViewUrl = '';

var categoryCount = 1;

$(function(){

	baseUrl = $('#base-url').val();
	baseViewUrl = baseUrl + moduleName + "/";

 	$('#conf-type').change(showConfForm);
 });

var showConfForm = function()
{
	var confType = $('#conf-type').val();
	var url;

	switch(confType)
	{

		case '1':
			url = baseViewUrl + 'form/conference';
			$.get(url, function(data){
				$('#form-body').html(data);
				$('#add-category-btn').click(addCategory);	
				$('.datepicker').datepicker({
					autoclose: true
				});
			});
			
			break;

		case '2':
			url = baseViewUrl + 'form/seminar';
			$.get(url, function(data){
				$('#form-body').html(data);
				$('#add-category-btn').click(addCategory);
				$('.datepicker').datepicker({
					autoclose: true
				});
			});
			
			break;
	}

	$('#form-conference').validate();
	$('#address-form').show();
	$('#conf-submit-container').show();
}

var addCategory = function() 
{
	categoryCount++;
	var option = '<div id="category' + categoryCount + '">' +
	  				'<div class="form-inline">' +
	    				'<div class="form-group">' +
	    				'<select class="form-control category-option required" name="Category[' + categoryCount + '][category]">' +
	    	  			'<option value="">Choose Conference\'s Category</option>' +
	    	  			'<option value="1">Technology</option>' +
      	          	    '<option value="2">Linguistics</option>' +
      	          	    '<option value="3">Psychology</option>' +
	    				'</select>' +
	    				'</div>' +
	    				'<div class="form-group">' +
	    				'<span class="glyphicon glyphicon-minus-sign del-category-btn" onclick="delCategory(' + categoryCount + ')"></span>'
	    				'</div>' +
	  				'</div>' +
				'</div>';	
	$("#conf-category").append(option);
	return false;
}

function delCategory(catId)
{
	$('#category' + catId).remove();
	return false;
}