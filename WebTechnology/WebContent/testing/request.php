<?php
function showXmlFile($path, $fields, $nb) {
	$xml = new DOMDocument ();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->load ( $path );
	
	$nodes = $xml->getElementsByTagName ( $fields [1] );
	$retVal = array ();
	foreach ( $nodes as $node ) {
		$values = array ();
		for($i = 2; $i < $nb; $i ++) {
			$tmp = $node->getElementsByTagName ( $fields [$i] );
			$tmp = $tmp->item ( 0 )->nodeValue;
			$values [$fields [$i]] = $tmp;
		}
		$retVal [] = $values;
	}
	return $retVal;
}
if ($_POST ['action'] == 'request') {
	echo "ok";
}
if ($_POST ['action'] == 'getxml') {
	$fields = array ();
	$fields [] = "produits";
	$fields [] = "produit";
	$fields [] = "id";
	$fields [] = "nom";
	$fields [] = "prix";
	$fields [] = "img";
	$retval = showXmlFile ( "file.xml", $fields, 6 );
	echo json_encode ( $retval );
}
?>
