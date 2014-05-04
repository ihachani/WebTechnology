/**
 * 
 */
function createImageDiv(item) {
	retval = $('<div>', {
		class : 'imgdiv',
	}).css('background-image', 'url(' + item.image + ')');
	toolbar = $('<div>', {
		class : 'toolbar'
	});
	toolbar.append($('<p>').text(item.nom));
	price = $('<p>', {
		class : 'price'
	});
	price.html('<span>' + item.prix + '</span> DT');
	toolbar.append(price);
	toolbar.append($('<button>', {
		target : item.id
	}).text('acheter'));
	filtre = $('<div>', {
		class : 'filtre'
	});
	filtre.append(toolbar);
	retval.append(filtre);
	return retval;
}
function imageDivFiltre() {
	$(document).on('mouseenter', '.imgdiv', function() {
		$('.filtre', this).show(200);
	});
	$(document).on('mouseleave', '.imgdiv', function() {
		$('.filtre', this).hide(100);
	});
}
function showAll() {
	$.ajax({
		url : 'produit.php',
		type : 'post',
		data : {
			'action' : 'showprod',
		},
		dataType : 'json',
		success : function(data) {
			$.each(data, function(key, value) {
				// $('#main_view').append(createImageDiv(value));
				// tab = data;
			});
		},
		error : function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}
$(function() {
	imageDivFiltre();
	// showAll();
});
