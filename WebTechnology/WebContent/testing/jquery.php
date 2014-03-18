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
	<div id="content"></div>
	<div id="page">
		<ul class="pagination">
			<li id="prev" class="active nv"><a href="#">PREV</a></li>
			<li id="next" class="active nv"><a href="#">NEXT</a></li>
		</ul>
	</div>
	<button class="form-control">Delete</button>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	var tab = [];
	for (i = 0;i < 50 ; i++){
		tab[i] = i;
	}
	var curr;
	var pgLn = 10;
	var elNb = tab.length;
	var pgN = ( (elNb % pgLn) == 0 ) ? (Math.floor(elNb/pgLn) ) : ( (Math.floor(elNb/pgLn) ) +1 );
	function affichepage(nb,tab){
		for ( i = (nb -1)*pgLn; i< nb*pgLn; i++){
			$("#p"+(i - (nb -1)*pgLn)).text(tab[i]);
		}
	}

	
	function affiche(nb,tab){
		$("#content p").remove();
		for ( i = (nb - 1) * pgLn; (i < nb*pgLn) && (i <elNb); i++){
			$('<p>'+ tab[i] + '</p>').appendTo($("#content"));
			//$("#content").append("<p>0000</p>");
		}
		curr = nb;
		if (curr == 1){
			$("#prev").hide();
			$("#next").show();
		}
		else{
			$("#prev").show();
			if( curr == pgN)
				$("#next").hide();
			else
				$("#next").show();
		}
	}
	function genPag(){
		$(".pagination li:not(.nv)").remove();
		if (pgN == 1){
			$("#prev").hide();
			$("#next").hide();
		}else{
			$("#prev").after('<li class="active"><a href="#">1</a></li>');
			for (i = 2 ; i < (pgN + 1); i++){
				$("#next").before('<li><a href="#">'+ i +'</a></li>');
			}
		}
		
	}
	function main(){
		$(function() {
			affiche(1,tab);
			genPag();
			$('#page').on('click', 'li', function(){
				if ($(this).text() == "PREV"){
					$('.pagination li.active').each(function (){
						if( ( $(this).text()  != "PREV" ) && ( $(this).text() != "NEXT" ) )
							$(this).removeClass('active');
					});
					affiche( (curr -1) ,tab);
					$('.pagination li').each(function(){
						if ( $(this).text() == curr.toString())
							$(this).addClass('active');
					});
				}
			else if($(this).text() == "NEXT"){
					$('.pagination li.active').each(function (){
						if( ( $(this).text()  != "PREV" ) && ( $(this).text() != "NEXT" ) )
							$(this).removeClass('active');
					});
					affiche( (curr +1) ,tab);
					$('.pagination li').each(function(){
						if ( $(this).text() == curr.toString())
							$(this).addClass('active');
					});
				}
			else{
				var nb = parseInt($(this).text());
				//affichepage(nb,tab);
				affiche(nb,tab);
				$('.pagination li.active').each(function (){
					if( ( $(this).text()  != "PREV" ) && ( $(this).text() != "NEXT" ) )
						$(this).removeClass('active');
				});
				$(this).addClass('active');
			}
			}
			);
			$("button").click(function(){
				$(".pagination li:not(.nv)").remove();
				genPag();
			});
			//affichepage(5, tab);
		});
	}
	main();
	</script>
</body>
<script type="text/javascript">
<!--
/*
$('.pagination li').click(function(){
			if ($(this).text() == "PREV"){
					$('.pagination li.active').each(function (){
						if( ( $(this).text()  != "PREV" ) && ( $(this).text() != "NEXT" ) )
							$(this).removeClass('active');
					});
					affiche( (curr -1) ,tab);
					$('.pagination li').each(function(){
						if ( $(this).text() == curr.toString())
							$(this).addClass('active');
					});
				}
			else if($(this).text() == "NEXT"){
					$('.pagination li.active').each(function (){
						if( ( $(this).text()  != "PREV" ) && ( $(this).text() != "NEXT" ) )
							$(this).removeClass('active');
					});
					affiche( (curr +1) ,tab);
					$('.pagination li').each(function(){
						if ( $(this).text() == curr.toString())
							$(this).addClass('active');
					});
				}
			else{
				alert('click');
				var nb = parseInt($(this).text());
				//affichepage(nb,tab);
				affiche(nb,tab);
				$('.pagination li.active').each(function (){
					if( ( $(this).text()  != "PREV" ) && ( $(this).text() != "NEXT" ) )
						$(this).removeClass('active');
				});
				$(this).addClass('active');
			}
			});
			*/
//-->
</script>

</html>
