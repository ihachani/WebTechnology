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
function test() {
	alert($(this).text());
}
function removeProd() {
	$.ajax({
		url : 'produit.php',
		type : 'post',
		data : {
			'action' : 'removeProd',
			'id' : $(this).attr('target'),
		},
		dataType : 'text',
		success : function(data) {
			alert(data);
			loadGestion();
		},
		error : function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function editName() {
	if ($(this).siblings('input').val()) {
		if ($(this).siblings('input').val().indexOf('>') != -1
				|| $(this).siblings('input').val().indexOf('<') != -1) {
			alert('Character invalide');
		} else {
			$.ajax({
				url : 'produit.php',
				type : 'post',
				data : {
					'action' : 'editNom',
					'id' : $(this).parent().closest('div').attr('id'),
					'nom' : $(this).siblings('input').val(),
				},
				dataType : 'text',
				success : function(data) {
					alert(data);
					loadGestion();
				},
				error : function(xhr, desc, err) {
					console.log(xhr);
					console.log("Details: " + desc + "\nError:" + err);
				}
			});
		}
	} else
		alert('empty field');

}
function editPrix() {
	if ($(this).siblings('input').val()) {
		if (isNaN($(this).siblings('input').val())) {
			alert('Not a number');
		} else if ($(this).siblings('input').val() < 0) {
			alert('negative number');
		} else {
			$.ajax({
				url : 'produit.php',
				type : 'post',
				data : {
					'action' : 'editNom',
					'id' : $(this).parent().closest('div').attr('id'),
					'nom' : $(this).siblings('input').val(),
				},
				dataType : 'text',
				success : function(data) {
					alert(data);
					loadGestion();
				},
				error : function(xhr, desc, err) {
					console.log(xhr);
					console.log("Details: " + desc + "\nError:" + err);
				}
			});
		}
	} else
		alert('empty field');
}
function createEditMenu(elem) {
	retval = $('<div>', {
		class : 'editMenu',
		id : elem.attr('target')
	});
	retval.append($('<button>', {
		class : 'editNameBut',
	}).text('Nom'));
	retval.append($('<button>', {
		class : 'editPrixBut',
	}).text('Prix'));
	retval.append($('<button>', {
		class : 'editQuantiteBut',
	}).text('Quantite'));
	retval.append($('<button>', {
		class : 'editCategoryBut',
	}).text('Category'));
	retval.append($('<button>', {
		class : 'editFournisseurBut',
	}).text('Fournisseur'));
	retval.append($('<button>', {
		class : 'editImageBut',
	}).text('Image'));
	return retval;

}
function createNameDiv(id) {
	retval = $('<div>', {
		id : id,
		class : 'editMenu',
	});
	retval.append($('<input>', {
		type : 'text'
	}));
	retval.append($('<button>', {
		class : 'nameSubmit'
	}).text('Submit'));
	return retval;
}

function createPrixDiv(id) {
	retval = $('<div>', {
		id : id,
		class : 'editMenu',
	});
	retval.append($('<input>', {
		type : 'text'
	}));
	retval.append($('<button>', {
		class : 'prixSubmit'
	}).text('Submit'));
	return retval;
}

function showNameDiv() {
	menu = createNameDiv($(this).parent().closest('div').attr('id'));
	$(this).parent().closest('div').after(menu);
	menu.hide();
	$(this).parent().closest('div').hide(700).remove();
	// $(this).parent().closest('div');
	menu.show(400);
}

function showPrixDiv() {
	menu = createPrixDiv($(this).parent().closest('div').attr('id'));
	$(this).parent().closest('div').after(menu);
	menu.hide();
	$(this).parent().closest('div').hide(700).remove();
	// $(this).parent().closest('div');
	menu.show(400);
}

function showEditMenu() {
	menu = createEditMenu($(this));
	$(this).parent().closest('div').after(menu);
	menu.hide();
	menu.show(400);
}
/*
 * I must trait the update case by case.28/04 23:00.Ilyes Hachani
 */

$(function() {
	$(document).on('click', '#fourSubmit', addFour);
	$(document).on('click', '#prodSubmit', addProd);
	$(document).on('click', '.supBut', removeProd);
	$(document).on('click', '.editBut', showEditMenu);
	$(document).on('click', '.editNameBut', showNameDiv);
	$(document).on('click', '.nameSubmit', editName);
	$(document).on('click', '.editPrixBut', showPrixDiv);
	$(document).on('click', '.prixSubmit', editPrix);
});