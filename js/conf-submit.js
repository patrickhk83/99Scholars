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

				$('#autocomplete_tags').click(function(){
					$(this).val('');
				});

				$('#autocomplete_tags').autocomplete({
					minLength: 1,
					source:function( request, response ) {
						
			  		$.ajax({
			  			type : "POST",
			  			url:  suggest_url,
			  			dataType: "json" ,
			  			data: {term:request.term} ,
			  			error : function(request, status, error) {
			  		    alert(error);
			  		  },
			  			success: function(data) {
			  				//response(data);
			  				$('#list_suggest_tag').html(data);
			  			}
			  		});
					}
				});

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

				$('#autocomplete_tags').click(function(){
					$(this).val('');
				});

				$('#autocomplete_tags').autocomplete({
					minLength: 1,
					source:function( request, response ) {
						
			  		$.ajax({
			  			type : "POST",
			  			url:  suggest_url,
			  			dataType: "json" ,
			  			data: {term:request.term} ,
			  			error : function(request, status, error) {
			  		    alert(error);
			  		  },
			  			success: function(data) {
			  				//response(data);
			  				$('#list_suggest_tag').html(data);
			  			}
			  		});
					}
				});		
						
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

function addSelectedTag(tag_id , tag_name)
{
	var list_id = "li_tag" + tag_id;
	var b_is = false;
	$("#list_selected_tag li").each(function(index){
		if($(this).attr("id") == list_id)
		{
			b_is = true;
			return false;
		}
		
	});

	if(b_is == true) return false;

	var inner = "<li class='list-group-item' id='li_tag" + tag_id + "'>" + 
					"<div class='row'>" + 
						"<input type='hidden' name='selectedTag[" + tag_id + "][tag_id]' value='" + tag_id + "'>" + 
						"<div class='col-lg-10'><p>" + tag_name + "</p></div>" + 
						"<div class='col-lg-2'>" + 
							"<span class='glyphicon glyphicon-minus-sign del-category-btn' onclick='deleteSelectedTag(" + tag_id + ")'></span>" + 
						"</div>" + 
					"</div>" +
				"</li>";
	$("#list_selected_tag").append(inner);
}

function deleteSelectedTag(tag_id)
{
	$("#li_tag" + tag_id).remove(); 
}

function addNewTag(tag_name)
{
    $.ajax({
        type : "POST", 
        async : true, 
        url : add_tag_url, 
        dataType : "json", 
        timeout : 30000, 
        cache : false, 
        data : {term:tag_name}, 
        error : function(request, status, error) {
	        
        }, 
        success : function(response) {
        	addSelectedTag(response , tag_name);
        }
    });	
}
