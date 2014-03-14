<?php
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
	protected function createXmlNode($xml, $values) {
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
		$xml = new DOMDocument ();
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load ( $this->path );
		
		$parent = $xml->getElementsByTagName ( $this->fields [0] )->item ( 0 );
		$child = createXmlNode ( $xml, $this->fields, $values, $this->nb );
		$parent->appendChild ( $child );
		$xml->saveXML ();
		$status = $xml->save ( $this->path );
		return $status;
	}
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
}
$fields = array ();
$fields [] = "produits";
$fields [] = "produit";
$fields [] = "id";
$fields [] = "qte";
$values1 = array ();
$values1 [] = "none";
$values1 [] = "none";
$values1 [] = "z1";
$values1 [] = "20";
$values = array ();
$values [] = "none";
$values [] = "none";
$values [] = "z1";
$values [] = "20";
$obj = new xmlFile ( "xmls/tmp.xml", $fields, 4, 2 );
$obj->addToNode ( "z1", 3, 5 );
$array = $obj->showXmlFile ();
print_r ( $array );
?>