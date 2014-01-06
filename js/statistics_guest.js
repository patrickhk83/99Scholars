$(function(){
  $('.datepicker').datepicker({
    autoclose: true
  });

  $("#select_actions").change(function() {
    var actions = $("#select_actions option:selected").val();
    var user_name = "Guest";
    var start_date = $("#start_date").val();
    var page_num = $("#page_num").val();
    var per_page = $("#per_page").val();

    
    if(start_date == '') start_date = "1234567890";
    else start_date = start_date.replace("/" , "-");

    var load_url = url + "/" + page_num + "/" + per_page + "/" + actions + "/" + user_name + "/" + start_date;
    location.replace(load_url);
    
  });

  $("#search_btn").click(function() {
    var actions = $("#select_actions option:selected").val();
    var user_name = "Guest";
    var start_date = $("#start_date").val();
    var page_num = $("#page_num").val();
    var per_page = $("#per_page").val();
    var start_date1;

    if(start_date == '') start_date1 = "1234567890";
    else start_date1 = start_date.replace("/" , "-");

    var load_url = url + "/" + page_num + "/" + per_page + "/" + actions + "/" + user_name + "/" + start_date1;
    location.replace(load_url);    
  });
});