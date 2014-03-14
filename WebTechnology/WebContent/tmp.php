<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Testing php and js</title>
<script type="text/javascript" src="scripts/xmlScript.js"></script>
<script src="js/md5.min.js"></script>
</head>
<body>
	<form action="target.php" method="post">
		<input type="text" name="username" value="" /> <input type="submit"
			name="submit" value="Submit" />
	</form>
	<?php
	
	/*
	 * $xml=simplexml_load_file("xmls/Product/Homme/produitHomme.xml"); print_r($xml); foreach($xml->produit->children() as $child) { echo $child->getName() . ": " . $child . "<br>"; } echo $xml->produit->id . "<br>"; echo $xml->produit->nom . "<br>"; echo $xml->produit->image . "<br>"; echo $xml->produit->prix . "<br>"; echo $xml->produit->categorie;
	 */
	$xmlDoc = new DOMDocument ();
	$xmlDoc->load ( "xmls/Product/Homme/produitHomme.xml" );
	
	// print $xmlDoc->saveXML();
	/*
	 * affiche tous les produits.
	 */
	function affichage($xmlDoc) {
		$produits = $xmlDoc->getElementsByTagName ( "produit" );
		foreach ( $produits as $produit ) {
			$id = $produit->getElementsByTagName ( "id" );
			$id = $id->item ( 0 )->nodeValue;
			
			$categorie = $produit->getElementsByTagName ( "categorie" );
			$categorie = $categorie->item ( 0 )->nodeValue;
			
			$nom = $produit->getElementsByTagName ( "nom" );
			$nom = $nom->item ( 0 )->nodeValue;
			
			$prix = $produit->getElementsByTagName ( "prix" );
			$prix = $prix->item ( 0 )->nodeValue;
			
			echo "id: $id prix: $prix nom: $nom categorie: $categorie " . "<br>";
		}
	}
	/*
	 * affiche un produit.
	 */
	function afficheproduit($produit) {
		$id = $produit->getElementsByTagName ( "id" );
		$id = $id->item ( 0 )->nodeValue;
		
		$categorie = $produit->getElementsByTagName ( "categorie" );
		$categorie = $categorie->item ( 0 )->nodeValue;
		
		$nom = $produit->getElementsByTagName ( "nom" );
		$nom = $nom->item ( 0 )->nodeValue;
		
		$prix = $produit->getElementsByTagName ( "prix" );
		$prix = $prix->item ( 0 )->nodeValue;
		
		echo "id: $id prix: $prix nom: $nom categorie: $categorie " . "<br>";
	}
	
	/*
	 * affiche les produit ayants un nom == string
	 */
	function RechercheProductNom($xmlDoc, $string) {
		echo "Rechereche nom == $string" . "<br>";
		$retVal = array ();
		$produits = $xmlDoc->getElementsByTagName ( "produit" );
		foreach ( $produits as $produit ) {
			$nom = $produit->getElementsByTagName ( "nom" );
			$nom = $nom->item ( 0 )->nodeValue;
			if (strcasecmp ( $string, $nom ) == 0) {
				afficheProduit ( $produit );
				$retVal [] = $produit;
			}
		}
		return $retVal;
	}
	affichage($xmlDoc);
	?>
	
</body>
</html>
