<?php
include_once 'xmlFile.php';

$fields = array ();
$fields [] = "fournisseurs";
$fields [] = "fournisseur";
$fields [] = "nom";

$obj = new xmlFile ( 'xmls/fournisseurs.xml', $fields, 3, 2 );

if ($_POST ['action'] == 'showfourn') {
	$status = $obj->showXmlFile ();
	echo json_encode ( $status );
}
if ($_POST ['action'] == 'addFourn') {
	$values = array ();
	$values [] = '';
	$values [] = '';
	$values [] = $_POST ['nom'];
	$status = $obj->addToXml ( $values );
	if ($status == false) {
		echo "Problem lors du l'ajout du " . $_POST ['nom'];
	} else {
		echo $_POST ['nom'] . " ajouté";
	}
}
?>