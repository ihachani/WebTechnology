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

if ($_POST ['action'] == 'removeProd') {
	$status = $obj->removeNode ( $_POST ['id'] );
	if ($status == false)
		echo "Problem lors de la suppression de " . $_POST ['id'];
	else
		echo $_POST ['id'] . " supprimé avec success";
}

if ($_POST ['action'] == 'editNom') {
	$values = $obj->getNode ( $_POST ['id'] );
	$nValues = array ();
	$nValues [] = '';
	$nValues [] = '';
	$nValues [] = $values ['id'];
	// $nValues [] = $values ['nom'];
	$nValues [] = $_POST ['nom'];
	$nValues [] = $values ['prix'];
	$nValues [] = $values ['quantite'];
	$nValues [] = $values ['category'];
	$nValues [] = $values ['fournisseur'];
	$nValues [] = $values ['image'];
	$status = $obj->updateNode ( $nValues, $_POST ['id'] );
	if ($status == false)
		echo "Problem lors de la mise a jour de " . $_POST ['id'];
	else
		echo " mise a jour de " . $_POST ['id'] . " avec success";
}
?>