var categoryCount = 1;
var typeCount = 1;
var countryCount = 1;

$(function(){
	$('.datepicker').datepicker({
		autoclose: true
	});
	
	$('#category-option1').change(addCategory);
	$('#type-option1').change(addType);
	$('#country-option1').change(addCountry);

});

var addCategory = function() 
{
	categoryCount++;
	var option = '<div id="category-option' + categoryCount + '">' +
		'<div class="form-inline">' +
			'<select class="form-control criteria-option">' +
				'<option>Select More Category</option>' +
				'<option>Technology</option>' +
				'<option>Linguistics</option>' +
				'<option>Psychology</option>' +
			'</select> ' +
			'<span class="glyphicon glyphicon-minus-sign" onclick="delCategory(' + categoryCount + ')"></span>' +
		'</div>' +
	'</div>';
	
	$('#category-criteria').append(option);
	$('#category-option' + categoryCount).change(addCategory);
}

function delCategory(catId) 
{
	$('#category-option' + catId).remove();
}

var addType = function() 
{
	typeCount++;
	var option = '<div id="type-option' + typeCount + '">' +
		'<div class="form-inline">' +
			'<select class="form-control criteria-option">' +
				'<option>Select More Type</option>' +
				'<option>Conference</option>' +
				'<option>Seminar</option>' +
				'<option>Workshop</option>' +
				'<option>Webinar</option>' +
				'<option>Online Conference</option>' +
			'</select> ' +
			'<span class="glyphicon glyphicon-minus-sign" onclick="delType(' + typeCount + ')"></span>' +
		'</div>' +
	'</div>';
	
	$('#type-criteria').append(option);
	$('#type-option' + typeCount).change(addType);
}

function delType(typeId) 
{
	$('#type-option' + typeId).remove();
}

var addCountry = function() 
{
	countryCount++;
	var option = '<div id="country-option' + countryCount + '">' +
		'<div class="form-inline">' +
			'<select class="form-control criteria-option">' +
				'<option>Select More Country</option>' +
				'<option>Argentina</option>' +
				'<option>Brazil</option>' +
				'<option>China</option>' +
				'<option>Hong Kong</option>' +
				'<option>Singapore</option>' +
				'<option>Thailand</option>' +
			'</select> ' +
			'<span class="glyphicon glyphicon-minus-sign" onclick="delCountry(' + countryCount + ')"></span>' +
		'</div>' +
	'</div>';
	
	$('#country-criteria').append(option);
	$('#country-option' + countryCount).change(addCountry);
}

function delCountry(countryId) 
{
	$('#country-option' + countryId).remove();
}