<?php
/**
 * This class is used to handle an xml file used for the database.
 * @author lonsomehell
 *
 */
class xmlFile {
	public $path;
	public $fields;
	public $nb;
	public $idn;
	public function __construct($path, $fields, $nb, $idn) {
		$this->path = $path;
		$this->fields = $fields;
		$this->nb = $nb;
		$this->idn = $idn;
	}
	private function createXmlNode($xml, $values) {
		$retVal = $xml->createElement ( $this->fields [1] );
		
		for($i = 2; $i < $this->nb; $i ++) {
			$tmp = $xml->createElement ( $this->fields [$i] );
			$tmpText = $xml->createTextNode ( $values [$i] );
			$tmp->appendChild ( $tmpText );
			
			$retVal->appendChild ( $tmp );
		}
		
		return $retVal;
	}
	public function addToXml($values) {
		if ($this->chekUnique ( $values [$this->idn] )) {
			$xml = new DOMDocument ();
			$xml->formatOutput = true;
			$xml->preserveWhiteSpace = false;
			$xml->load ( $this->path );
			
			$parent = $xml->getElementsByTagName ( $this->fields [0] )->item ( 0 );
			$child = $this->createXmlNode ( $xml, $values );
			$parent->appendChild ( $child );
			$xml->saveXML ();
			$status = $xml->save ( $this->path );
			return $status;
		}
		return false;
	}
	/**
	 * Returns an array from the xml file.
	 *
	 * @return multitype:multitype:string
	 */
	public function showXmlFile() {
		$xml = new DOMDocument ();
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load ( $this->path );
		
		$nodes = $xml->getElementsByTagName ( $this->fields [1] );
		$retVal = array ();
		foreach ( $nodes as $node ) {
			$values = array ();
			for($i = 2; $i < $this->nb; $i ++) {
				$tmp = $node->getElementsByTagName ( $this->fields [$i] );
				$tmp = $tmp->item ( 0 )->nodeValue;
				$values [$this->fields [$i]] = $tmp;
			}
			$retVal [] = $values;
		}
		return $retVal;
	}
	public function addToNode($id, $nb, $value) {
		$xml = new DOMDocument ();
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load ( $this->path );
		$nodes = $xml->getElementsByTagName ( $this->fields [1] );
		foreach ( $nodes as $node ) {
			
			$tmp = $node->getElementsByTagName ( $this->fields [$this->idn] );
			$tmp = $tmp->item ( 0 )->nodeValue;
			if ($tmp == $id) {
				$tmp2 = $node->getElementsByTagName ( $this->fields [$nb] );
				$val = $tmp2->item ( 0 )->nodeValue;
				$val = intval ( $val );
				$val = $val + $value;
				strval ( $val );
				$tmp2->item ( 0 )->nodeValue = $val;
				$xml->saveXML ();
				$status = $xml->save ( $this->path );
				return $status;
			}
		}
		return false;
	}
	public function updateNode($values, $id) {
		$xml = new DOMDocument ();
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load ( $this->path );
		$nodes = $xml->getElementsByTagName ( $this->fields [1] );
		foreach ( $nodes as $node ) {
			$tmp = $node->getElementsByTagName ( $this->fields [$this->idn] );
			$tmp = $tmp->item ( 0 )->nodeValue;
			if ($tmp == $id) {
				for($i = 2; $i < $this->nb; $i ++) {
					$tmp2 = $node->getElementsByTagName ( $this->fields [$i] );
					$tmp2->item ( 0 )->nodeValue = $values [$i];
				}
				$xml->saveXML ();
				$status = $xml->save ( $this->path );
				return $status;
			}
		}
		return false;
	}
	public function removeNode($id) {
		$xml = new DOMDocument ();
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load ( $this->path );
		$nodes = $xml->getElementsByTagName ( $this->fields [1] );
		
		foreach ( $nodes as $node ) {
			$tmp = $node->getElementsByTagName ( $this->fields [$this->idn] );
			$tmp = $tmp->item ( 0 )->nodeValue;
			if ($tmp == $id) {
				$parent = $xml->getElementsByTagName ( $this->fields [0] )->item ( 0 );
				$parent->removeChild ( $node );
				$xml->saveXML ();
				$status = $xml->save ( $this->path );
				return $status;
			}
		}
		return false;
	}
	private function chekUnique($id) {
		$xml = new DOMDocument ();
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load ( $this->path );
		$nodes = $xml->getElementsByTagName ( $this->fields [1] );
		foreach ( $nodes as $node ) {
			$tmp = $node->getElementsByTagName ( $this->fields [$this->idn] );
			$tmp = $tmp->item ( 0 )->nodeValue;
			if ($tmp == $id) {
				return false;
			}
		}
		return true;
	}
	/**
	 * Returns an array of the nodes that contain the field/value provided.
	 *
	 * @param array $fields
	 *        	The fields to be used.
	 * @param array $values        	
	 * @return multitype:multitype:string
	 */
	public function recherche($fields, $values) {
		$xml = new DOMDocument ();
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load ( $this->path );
		$nodes = $xml->getElementsByTagName ( $this->fields [1] );
		$retVal = array ();
		foreach ( $nodes as $node ) {
			$cont = 1;
			for($i = 0; $i < count ( $fields ); $i ++) {
				$tmp = $node->getElementsByTagName ( $fields [$i] );
				$tmp = $tmp->item ( 0 )->nodeValue;
				if ($tmp != $values [$i]) {
					$cont = 0;
				}
			}
			if ($cont == 1) {
				$array = array ();
				for($j = 2; $j < $this->nb; $j ++) {
					$tmp = $node->getElementsByTagName ( $this->fields [$j] );
					$tmp = $tmp->item ( 0 )->nodeValue;
					$array [$this->fields [$j]] = $tmp;
				}
				$retVal [] = $array;
			}
		}
		return $retVal;
	}
}
$fields = array ();
$fields [] = "produits";
$fields [] = "produit";
$fields [] = "id";
$fields [] = "qte";

$obj = new xmlFile ( "tmp.xml", $fields, 4, 2 );

?>