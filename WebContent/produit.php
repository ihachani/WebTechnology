<?php
include_once 'xmlFile.php';
$fields = array ();
$fields [] = 'produits';
$fields [] = 'produit';
$fields [] = 'id';
$fields [] = 'nom';
$fields [] = 'prix';
$fields [] = 'quantite';
$fields [] = 'category';
$fields [] = 'fournisseur';
$fields [] = 'image';

$obj = new xmlFile ( 'xmls/produits.xml', $fields, 9, 2 );

if ($_POST ['action'] == 'addProd') {
	$values = array ();
	$values [] = '';
	$values [] = '';
	$values [] = $_POST ['id'];
	$values [] = $_POST ['nom'];
	$values [] = $_POST ['prix'];
	$values [] = $_POST ['quantite'];
	$values [] = $_POST ['category'];
	$values [] = $_POST ['fournisseur'];
	$values [] = $_POST ['image'];
	
	$status = $obj->addToXml ( $values );
	if ($status == false)
		echo "Problem lors de l'ajout de " . $_POST ['id'];
	else
		echo $_POST ['id'] . " ajouté avec success";
}
if ($_POST ['action'] == 'showprod') {
	$status = $obj->showXmlFile ();
	echo json_encode ( $status );
}
?>