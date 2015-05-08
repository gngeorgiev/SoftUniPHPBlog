$(function() {
    $(".delete").click(function() {
    	var form = $( this ).parent();
    	bootbox.confirm("Are you sure you want to delete this item?", function(result) {
		        if(result) {
		        	form.submit();
		        }
		    });
    });
});