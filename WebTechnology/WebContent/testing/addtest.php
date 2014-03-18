<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
<link href="css/bootflat.css" rel="stylesheet" media="screen">
<link href="css/bootflat-extensions.css" rel="stylesheet" media="screen">
<link href="css/bootflat-square.css" rel="stylesheet" media="screen">
</head>

<body>
	<button id="getxml">xml</button>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	//var div = $(document.createElement('div'));
	function createElement(item){
		a = $('<a>',{class: 'pull-left' ,href: '#'}); 
		img = $('<img>' ,{class: 'media-object img-rounded'  ,alt:"48x48"});
		img.attr("src",item.img);
		a.append(img);
		div = $('<div>', {class: 'media-body'});
		h = $('<h4>' ,{class: 'media-heading'});
		h.text("Produit: " +item.nom);
		price = $('<p>',{class: 'price'});
		price.text("Prix: " +item.prix);
		div.append(h);
		div.append(price);
		retval = $('<div>', {class: 'media'});
		retval.append(a);
		retval.append(div);
		return retval;
	}

	/*$(function() {
		$("body").append( ($('<div>', {class: 'media'}) ).append(a) );
	});*/

	$(document).ready(function(){
		$("#getxml").click(function(){
			$.ajax({
				url: 'request.php',
				type: 'post',
				data: {'action': 'getxml'},
				dataType: 'json',
				success: function(data) {
					alert(data.length);
					$("body").append(createElement(data[0]));
							$.each(data,function(i,item){
								/*$("#Product"+i+" p:first").text("id: "+item.id);
								$("#Product"+i+" img").attr("src",item.img);
								$("#Product"+i+" h4").text("Produit: " +item.nom);
								$("#Product"+i+" .price").text("Prix: " +item.prix);
								$("div").show(1000);*/
								$("body").append(createElement(item));
								});
					},
					error: function(xhr, desc, err) {
						console.log(xhr);
						console.log("Details: " + desc + "\nError:" + err);
						}
					}); // end ajax call	
			});
		});
	</script>
</body>
</html>