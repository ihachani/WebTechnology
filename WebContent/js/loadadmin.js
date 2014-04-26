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
			$.each(data, function(key, value) {
				$('#prodFourn').append(
						$("<option></option>").attr("value", value.nom).text(
								value.nom));
			});
		},
		error : function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}
function loadFournAdd() {
	$("#container").load("fournisseur.html");
}

function loadProdAdd() {
	$("#container").load("produit.html", createSelectFour);
}
$(function() {
	$(document).on('click', '#fournisseur', loadFournAdd);
	$(document).on('click', '#produit', loadProdAdd);
});