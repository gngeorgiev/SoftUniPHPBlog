$(function() {
	var requestUrl = "/posts/popular";
	$.get(requestUrl, function(data){
        $("#popular-posts").html(data);
    });

    requestUrl = "/tags/popular";
	$.get(requestUrl, function(data){
        $("#popular-tags").html(data);
    });

    requestUrl = "/posts/recent";
	$.get(requestUrl, function(data){
        $("#recent-posts").html(data);
    });
});
