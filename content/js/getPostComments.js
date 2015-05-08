$(function() {
	var id = $("#postId").val();
	var page = $("#page").val();
	var requestUrl = "/comments/get/" + id + "?page=" + page;
	$.get(requestUrl, function(data){
        $(".comments").html(data);
    });
});