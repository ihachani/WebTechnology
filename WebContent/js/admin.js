/**
 * 
 */

function createSelectFour() {
	$.ajax({
		url : 'fournisseur.php',
		type : 'post',
		data : {
			'action' : 'showfourn',
		},
		dataType : 'json',
		success : function(data) {
			$.each(function(index, value) {
				alert(value.name);
			});
		},
		error : function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

$(function() {
	createSelectFour();
});