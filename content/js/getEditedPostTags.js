$(function() {
    var id = $("#postId").val();
    var requestUrl = "/tags/getEdit/" + id;
    $.get(requestUrl, function(data){
        $("#postTagsEdit").html(data);
    });

    var page = $("#page").val();
    requestUrl = "/tags/getAdd/" + id + "?page=" + page;
    $.get(requestUrl, function(data){
        $("#postTagsAdd").html(data);
    });
});