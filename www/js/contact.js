$().ready(function(){
	$('#tableres').attr("data-target", 'handler/h_contact.php');
	coltab="Cliente.contactos";
});

function updateClient(opt) {
	console.log(opt.value);
//	console.log($("#tableres").attr("data-xtra"));
// debugger;
	$("#tableres").attr("data-xtra", opt.value);
	$("#xtra").val(opt.value);
	
	$("#tableres").bootstrapTable("refresh");
}
