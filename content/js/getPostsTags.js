$(function() {
    $.each($(".post"), 
        function(i, el) {
            var input = el.getElementsByClassName("postId"); 
            var id = input[0].value;
            var requestUrl = "/tags/get/" + id;
            $.get(requestUrl, function(data){
                var divIdSelector = "#tags_" + id;
                $(divIdSelector).html(data);
            });
        })
});