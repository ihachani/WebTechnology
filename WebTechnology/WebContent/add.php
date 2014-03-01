<?php
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
function createProduct($xml, $s1, $s2, $s3, $s4) {
	//$retVal = new DOMElement ( "produit" );
	
	/*$current_b_tag = $xmlDoc->getElementById ( "produit" );
	$new_b_tag = $mydoc->createElement ( "id" );
	$new_b_tag->nodeValue = $s1;
	$result = $mydoc->getElementById ( "myBody" );
	$result->replaceChild ( $new_b_tag, $current_b_tag );*/
	
	$id = $xml->createElement ( "id" );
	$idText = $xml->createTextNode ( $s1 );
	$id->appendChild ( $idText );
	
	$nom = $xml->createElement ( "nom" );
	$nomText = $xml->createTextNode ( $s2 );
	$nom->appendChild ( $nomText );
	
	$prix = $xml->createElement ( "prix" );
	$prixText = $xml->createTextNode ( $s3 );
	$prix->appendChild ( $prixText );
	
	$categorie = $xml->createElement ( "categorie" );
	$categorieText = $xml->createTextNode ( $s4 );
	$categorie->appendChild ( $categorieText );
	
	$retVal = $xml->createElement("produit");
	$retVal->appendChild($id);
	$retVal->appendChild($nom);
	$retVal->appendChild($prix);
	$retVal->appendChild($categorie);
	
	/*$retVal->getElementsByTagName ( "id" )->nodeValue = $s1;
	$retVal->getElementsByTagName ( "nom" )->item ( 0 )->nodeValue = "$s2";
	$retVal->getElementsByTagName ( "prix" )->item ( 0 )->nodeValue = "$s3";
	$retVal->getElementsByTagName ( "categorie" )->item ( 0 )->nodeValue = "$s4";*/
	return $retVal;
}

$dom = new DOMDocument ();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom->load ( "xmls/Product/Homme/produitHomme.xml" );

$parent = $dom->getElementsByTagName ( "produits" )->item ( 0 );
$child = createProduct ( $dom,"111", "opps", "153", "chemise" );
$parent->appendChild ( $child );
affichage ( $dom );
?>