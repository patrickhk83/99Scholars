var categoryCount = 1;

$(function(){
 	$('.datepicker').datepicker();
 	
 	$('#add-category-btn').click(addCategory);
 });

var addCategory = function() 
{
	categoryCount++;
	var option = '<div id="category' + categoryCount + '">' +
	  				'<div class="form-inline">' +
	    				'<div class="form-group">' +
	    				'<select class="form-control category-option">' +
	    	  			'<option>Choose Conference\'s Category</option>' +
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