function checkAll(){
	$("input:checkbox").prop('checked', true);
}

function uncheckAll(){
	$("input:checkbox").prop('checked', false);
}

function invertAll(){
	$("input:checkbox").prop("checked", function () { return (!this.checked); } );
}