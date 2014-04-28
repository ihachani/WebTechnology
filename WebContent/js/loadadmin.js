/**
 * 
 */

function prodCreateLine() {
	$.ajax({
		url : 'produit.php',
		type : 'post',
		data : {
			'action' : 'showprod',
		},
		dataType : 'json',
		success : function(data) {
			$.each(data, function(key, value) {
				$('#container').append(createLine(value));
			});
		},
		error : function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}
function createLine(item) {
	retval = $('<div>');
	retval.append($('<div>', {
		class : 'tabHead'
	}).text(item.id));
	retval.append($('<div>', {
		class : 'tabHead'
	}).text(item.nom));
	retval.append($('<div>', {
		class : 'tabHead'
	}).text(item.prix));
	retval.append($('<div>', {
		class : 'tabHead'
	}).text(item.quantite));
	retval.append($('<div>', {
		class : 'tabHead'
	}).text(item.category));
	retval.append($('<div>', {
		class : 'tabHead'
	}).text(item.fournisseur));
	retval.append($('<div>', {
		class : 'tabHead'
	}).text(item.image));
	retval.append($('<button>', {
		class : 'supBut',
		target : item.id
	}).text('supprimer'));
	retval.append($('<button>', {
		class : 'editBut',
		target : item.id
	}).text('modifier'));
	return retval;
}
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
function loadGestion() {
	$("#container").load("gestion.html", prodCreateLine);
}
$(function() {
	$(document).on('click', '#fournisseur', loadFournAdd);
	$(document).on('click', '#produit', loadProdAdd);
	$(document).on('click', '#gestion', loadGestion);
});