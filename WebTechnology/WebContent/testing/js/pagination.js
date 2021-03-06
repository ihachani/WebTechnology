var curr;
var pgLn = 10;
var elNb ;
var pgN ;

// var elNb = tab.length;
// var pgN = ((elNb % pgLn) == 0) ? (Math.floor(elNb / pgLn)) :
// ((Math.floor(elNb
// / pgLn)) + 1);

/**
 * Used to create a product for the dom.
 * 
 * @param item
 * @returns {___jqueryobject_retval}
 */
function createElement(item) {
	a = $('<a>', {
		class : 'pull-left',
		href : '#'
	});
	img = $('<img>', {
		class : 'media-object img-rounded',
		alt : "48x48"
	});
	img.attr("src", item.img);
	a.append(img);
	div = $('<div>', {
		class : 'media-body'
	});
	h = $('<h4>', {
		class : 'media-heading'
	});
	h.text("Produit: " + item.nom);
	price = $('<p>', {
		class : 'price'
	});
	price.text("Prix: " + item.prix);
	div.append(h);
	div.append(price);
	retval = $('<div>', {
		class : 'media'
	});
	retval.append(a);
	retval.append(div);
	return retval;
}

function affiche(nb, tab) {
	$("#content *").remove();
	for (var i = (nb - 1) * pgLn; (i < nb * pgLn) && (i < elNb); i++) {
		createElement(tab[i]).appendTo($("#content"));
	}
	curr = nb;
	if (curr == 1) {
		$("#prev").hide();
		$("#next").show();
	} else {
		$("#prev").show();
		if (curr == pgN)
			$("#next").hide();
		else
			$("#next").show();
	}
}

function genPag() {
	$(".pagination li:not(.nv)").remove();
	if (pgN == 1) {
		$("#prev").hide();
		$("#next").hide();
	} else {
		$("#prev").after('<li class="active"><a href="#">1</a></li>');
		for (i = 2; i < (pgN + 1); i++) {
			$("#next").before('<li><a href="#">' + i + '</a></li>');
		}
	}

}
function updatepgL(data,nb){
	pgLn = nb;
	elNb = data.length;
	pgN = ((elNb % pgLn) == 0) ? (Math.floor(elNb / pgLn)) : ((Math.floor(elNb
			/ pgLn)) + 1);
	affiche(1, data);
	genPag();
}
function main(tab) {
	$(function() {
		affiche(1, tab);
		genPag();
		$('#page').on(
				'click',
				'li',
				function() {
					if ($(this).text() == "PREV") {
						$('.pagination li.active').each(
								function() {
									if (($(this).text() != "PREV")
											&& ($(this).text() != "NEXT"))
										$(this).removeClass('active');
								});
						affiche((curr - 1), tab);
						$('.pagination li').each(function() {
							if ($(this).text() == curr.toString())
								$(this).addClass('active');
						});
					} else if ($(this).text() == "NEXT") {
						$('.pagination li.active').each(
								function() {
									if (($(this).text() != "PREV")
											&& ($(this).text() != "NEXT"))
										$(this).removeClass('active');
								});
						affiche((curr + 1), tab);
						$('.pagination li').each(function() {
							if ($(this).text() == curr.toString())
								$(this).addClass('active');
						});
					} else {
						var nb = parseInt($(this).text());
						affiche(nb, tab);
						$('.pagination li.active').each(
								function() {
									if (($(this).text() != "PREV")
											&& ($(this).text() != "NEXT"))
										$(this).removeClass('active');
								});
						$(this).addClass('active');
					}
				});
		$("button").click(function() {
			$(".pagination li:not(.nv)").remove();
			genPag();
		});
	});
}