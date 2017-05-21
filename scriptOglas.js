$().ready(function(){

//klic apija, ki vrača podatke
$("#vrni").click(function(){

	id=$("#id").val();
	url="api.php/oglasi/"+id;
	$.ajax({
    type: "GET",
    url: url,
	contentType: "application/json; charset=utf-8",
    success: function (data) {
        $("#vsebinadiv").html(data.vsebina);     
		  
         }
	});
	
});

//klic apija, pri čemer pošljemo podatke v json obliki iz obrazca
$("#dodaj").click(function(){

	
	url="api.php/oglasi/";
	data={};
	data.naslov=$("#naslov").val();
	data.vsebina=$("#vsebina").val();
	$.ajax({
    type: "POST",
    url: url,
	contentType: "application/json; charset=utf-8",
    data: JSON.stringify(data),
    dataType:"json",
    success: function (data) {
        $("#vsebinadiv").html(data.vsebina);     
		  
         }
	});
	
});


});
/*	
jQuery.ajax({
    type: "GET|POST|DELETE|PUT",
    url: url,
    data: data,
    dataType:"text|html|json|jsonp|script|xml"
    success: success_callback,
    error: error_callback
});
JSON.stringify(object),

*/