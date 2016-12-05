
$().ready(function() {
    //		adapt();
    	$('form').ajaxForm(function() { 
        console.log(this.id);
        });
});
