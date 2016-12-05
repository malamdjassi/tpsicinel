$().ready(function(){
	$.validate({
		modules : 'html5, security',
	lang: 'pt'
	});

	$("#flogin").ajaxForm({
		success: function(responseText, statusText, xhr, $form) {
			$.each($("#flogin").find(".alert"), function(key, val){
				$(val).hide();
			});
			if (responseText.errcode == 200) {
				window.location.replace("index.php");

			} else if (responseText.errcode == 400) {
				$("#erroId").show();
			} else if (responseText.errcode == 401) {
				$("#erroPassword").show();
			}
		}
	});
});


function tryLogin() {

}
