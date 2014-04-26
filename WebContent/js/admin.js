/**
 * 
 */

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

function addProdphp() {
	$.ajax({
		url : 'produit.php',
		type : 'post',
		data : {
			'action' : 'addProd',
			'id' : $('#prodID').val(),
			'nom' : $('#prodName').val(),
			'prix' : $('#prodPrix').val(),
			'quantite' : 0,
			'category' : $("#prodCat").val(),
			'fournisseur' : $("#prodFourn option:selected").text(),
			'image' : 'assets/img.png'
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

function addProd() {
	if ($("#prodPrix").val() && $("#prodName").val() && $("#prodID").val()) {
		if ($("#prodName").val().indexOf('<') != -1
				|| $("#prodName").val().indexOf('>') != -1
				|| $("#prodID").val().indexOf('<') != -1
				|| $("#prodID").val().indexOf('>') != -1)
			alert('Character invalide');
		else {
			if (isNaN(val = $("#prodPrix").val())) {
				alert('not a number');
			} else {
				if (val < 0) {
					alert('negative number');
				} else {
					addProdphp();
				}

			}
		}

	} else
		alert('a field is empty');

}
$(function() {
	$(document).on('click', '#fourSubmit', addFour);
	$(document).on('click', '#prodSubmit', addProd);
});