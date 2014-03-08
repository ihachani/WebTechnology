<?php
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
 *
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
	$retVal = array ();
	foreach ( $nodes as $node ) {
		$values = array ();
		for($i = 2; $i < $nb; $i ++) {
			$tmp = $node->getElementsByTagName ( $fields [$i] );
			$tmp = $tmp->item ( 0 )->nodeValue;
			$values [] = $tmp;
			echo "$fields[$i] : $tmp " . "<br>";
		}
		$retVal [] = $values;
	}
	return $retVal;
}

/**
 * This function will look for the 3rd field that matches
 * the $id and add the value to its 4th field.
 *
 * @param string $path
 *        	xml file path.
 * @param array $fields
 *        	the xml file fields.
 * @param string $id
 *        	the id value.
 * @param array $nb
 *        	the first is the id field number the second is the field to be updated number.
 * @param int $vlaue
 *        	the value to be added (+|-).
 */
function addToNode($path, $fields, $id, $nb, $value) {
	$xml = new DOMDocument ();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->load ( $path );
	$nodes = $xml->getElementsByTagName ( $fields [1] );
	foreach ( $nodes as $node ) {
		$tmp = $node->getElementsByTagName ( $fields [$nb [0]] );
		$tmp = $tmp->item ( 0 )->nodeValue;
		if ($tmp == $id) {
			$tmp2 = $node->getElementsByTagName ( $fields [$nb [1]] );
			$val = $tmp2->item ( 0 )->nodeValue;
			$val = intval ( $val );
			$val = $val + $value;
			strval ( $val );
			$tmp2->item ( 0 )->nodeValue = $val;
			$xml->saveXML ();
			$status = $xml->save ( $path );
			return $status;
		}
	}
	return false;
}

/**
 * Lookup an id inside the xml file and change the values
 * with the ones suplied inside the values array.
 *
 * @param string $path
 *        	xml file path.
 * @param array $fields
 *        	The xml file fields.
 * @param array $values
 *        	The new fields values.
 *        	The fields number and the values number must be equal.
 *        	The first 2 fields values must be provided as "none".
 * @param int $nb
 *        	The fields number.
 * @param string $id
 *        	The id value.
 * @param int $idn
 *        	The id's field number.
 * @return int false
 */
function updateNode($path, $fields, $values, $nb, $id, $idn) {
	$xml = new DOMDocument ();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->load ( $path );
	$nodes = $xml->getElementsByTagName ( $fields [1] );
	foreach ( $nodes as $node ) {
		$tmp = $node->getElementsByTagName ( $fields [$idn] );
		$tmp = $tmp->item ( 0 )->nodeValue;
		if ($tmp == $id) {
			for($i = 2; $i < $nb; $i ++) {
				$tmp2 = $node->getElementsByTagName ( $fields [$i] );
				$tmp2->item ( 0 )->nodeValue = $values [$i];
			}
			$xml->saveXML ();
			$status = $xml->save ( $path );
			return $status;
		}
	}
	return false;
}

/**
 * Remove the node with the id that matches the one given.
 *
 * @param string $path
 *        	xml file path.
 * @param array $fields
 *        	The xml file fields.
 * @param string $id
 *        	The id value.
 * @param int $nb
 *        	The id's field number.
 * @return int false
 *        
 */
function removeNode($path, $fields, $id, $nb) {
	$xml = new DOMDocument ();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->load ( $path );
	$nodes = $xml->getElementsByTagName ( $fields [1] );
	
	foreach ( $nodes as $node ) {
		$tmp = $node->getElementsByTagName ( $fields [$nb] );
		$tmp = $tmp->item ( 0 )->nodeValue;
		if ($tmp == $id) {
			$parent = $xml->getElementsByTagName ( $fields [0] )->item ( 0 );
			$parent->removeChild ( $node );
			$xml->saveXML ();
			$status = $xml->save ( $path );
			return $status;
		}
	}
	return false;
}
?>