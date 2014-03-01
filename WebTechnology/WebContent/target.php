<?php
$var = $_POST ["username"];
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
	$retVal = array ();
	$produits = $xmlDoc->getElementsByTagName ( "produit" );
	foreach ( $produits as $produit ) {
		$nom = $produit->getElementsByTagName ( "nom" );
		$nom = $nom->item ( 0 )->nodeValue;
		// if ($nom == $string) {
		if (strcasecmp ( $string, $nom ) == 0) { // Case insensitive comparaison.
			afficheProduit ( $produit );
			$retVal [] = $produit;
		}
	}
	return $retVal;
}

/*
 * $arr = array(); $arr[0]=0; echo "$arr[0]";
 */

$arr = RechercheProductNom ( $xmlDoc, $var );
?>