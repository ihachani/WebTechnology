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
			$.each(data, function(index, value) {
				alert(value.nom);
			});
		},
		error : function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function addFour() {
	$.ajax({
		url : 'fournisseur.php',
		type : 'post',
		data : {
			'action' : 'addFourn',
			'nom' : $('#fourName').val()
		},
		dataType : 'text',
		success : function(data) {
			alert(data);
		},
		error : function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

$(function() {
	$(document).on('click', '#fourSubmit', addFour);
});