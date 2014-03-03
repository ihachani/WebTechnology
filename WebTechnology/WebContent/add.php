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
	// $retVal = new DOMElement ( "produit" );
	
	/*
	 * $current_b_tag = $xmlDoc->getElementById ( "produit" ); $new_b_tag = $mydoc->createElement ( "id" ); $new_b_tag->nodeValue = $s1; $result = $mydoc->getElementById ( "myBody" ); $result->replaceChild ( $new_b_tag, $current_b_tag );
	 */
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
	
	$retVal = $xml->createElement ( "produit" );
	$retVal->appendChild ( $id );
	$retVal->appendChild ( $nom );
	$retVal->appendChild ( $prix );
	$retVal->appendChild ( $categorie );
	
	/*
	 * $retVal->getElementsByTagName ( "id" )->nodeValue = $s1; $retVal->getElementsByTagName ( "nom" )->item ( 0 )->nodeValue = "$s2"; $retVal->getElementsByTagName ( "prix" )->item ( 0 )->nodeValue = "$s3"; $retVal->getElementsByTagName ( "categorie" )->item ( 0 )->nodeValue = "$s4";
	 */
	return $retVal;
}
function addProduct($xml, $s1, $s2, $s3, $s4, $path) {
	$parent = $xml->getElementsByTagName ( "produits" )->item ( 0 );
	$child = createProduct ( $xml, $s1, $s2, $s3, $s4 );
	$parent->appendChild ( $child );
	$xml->saveXML ();
	$a = $xml->save ( $path );
	return $a;
}
/**
 * Creates a DOMNode out of the informations provided.
 *
 * @param DOMDocument $xml        	
 * @param array $fields        	
 * @param array $values        	
 * @param integer $nb        	
 * @return DOMNode
 */
function createXmlNode($xml, $fields, $values, $nb) {
	/*
	 * $nodes = array (); $nodesText = array ();
	 */
	$retVal = $xml->createElement ( $fields [1] );
	for($i = 2; $i < $nb; $i ++) {
		/*
		 * $nodes [$i - 2] $retVal = $xml->createElement ( $fields [1] ); $nodesText [$i - 2] = $xml->createTextNode ( $values [$i] ); $nodes [$i - 2]->appendChild ( $nodesText [$i - 2] );
		 */
		
		$tmp = $xml->createElement ( $fields [$i] );
		$tmpText = $xml->createTextNode ( $values [$i] );
		$tmp->appendChild ( $tmpText );
		
		$retVal->appendChild ( $tmp );
	}
	
	return $retVal;
}

/**
 * The fields array contains the xml file fields names.
 * The values array contains the values of the new node to be added.
 * The path is the xml file path.
 * nb represents the nombre of fields.(total number)
 *
 * @param string $path        	
 * @param array $fields        	
 * @param array $values        	
 * @param integer $nb        	
 * @return integer/bool
 */
function addToXml($path, $fields, $values, $nb) {
	$xml = new DOMDocument ();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->load ( $path );
	
	$parent = $xml->getElementsByTagName ( $fields [0] )->item ( 0 );
	$child = createXmlNode ( $xml, $fields, $values, $nb );
	$parent->appendChild ( $child );
	$xml->saveXML ();
	$status = $xml->save ( $path );
	return $status;
}

/**
 * Shows the xml file and returns an array that contains the values.
 * @param string $path
 * @param array $fields
 * @param integer $nb
 * @return multitype:multitype:string
 */
function showXmlFile($path, $fields, $nb) {
	$xml = new DOMDocument ();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->load ( $path );
	
	$nodes = $xml->getElementsByTagName ( $fields [1] );
	$retVal = array();
	foreach ( $nodes as $node ) {
		$values = array();
		for($i = 2; $i < $nb; $i ++) {
			$tmp = $node->getElementsByTagName ( $fields[$i] );
			$tmp = $tmp->item ( 0 )->nodeValue;
			$values[] = $tmp;
			echo "$fields[$i] : $tmp " . "<br>" ;
		}
		$retVal[] = $values;
	}
	return $retVal;
}
/*
 * $path = "xmls/Product/Homme/produitHomme.xml"; $dom = new DOMDocument (); $dom->formatOutput = true; $dom->preserveWhiteSpace = false; $dom->load ( $path ); addProduct ( $dom, "1", "azerty", "fff", "lol", $path );
 */
$path = "xmls/tmp.xml";
/*
 * $xml = new DOMDocument (); $xml->formatOutput = true; $xml->preserveWhiteSpace = false; $xml->load ( $path );
 */
$fields = array ();
$fields [] = "azerty";
$fields [] = "qwerty";
$fields [] = "ahmed";
$fields [] = "zedfg";
$values = array ();
$values [] = "none";
$values [] = "none";
$values [] = "123";
$values [] = "loooool";

/*
 * for ( $i = 0 ; $i < 3 ;$i++){ echo $fields[$i] . ":" . $values[$i] . "<br>"; }
 */

addToXml ( $path, $fields, $values, 4 );
$array = showXmlFile ($path, $fields, 4);
print_r($array);
/*
$xml = new DOMDocument ();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load ( $path );

affichage ( $xml );*/
?>