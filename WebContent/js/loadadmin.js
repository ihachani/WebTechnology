/**
 * 
 */

function loadFournAdd() {
	$("#container").load("fournisseur.html");
}

function loadProdAdd() {
	$("#container").load("produit.html");
}
$(function() {
	$(document).on('click', '#fournisseur', loadFournAdd);
	$(document).on('click', '#produit', loadProdAdd);
});