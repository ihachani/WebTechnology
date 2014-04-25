<?php
include_once 'xmlfile.php';
$fields = array ();
$fields [] = "fournisseurs";
$fields [] = "fournisseur";
$fields [] = "nom";
$obj = new xmlFile ( 'xmls/fournisseurs.xml', $fields, 3, 2 );

if ($_POST ['action'] == 'showfourn') {
	$status = $obj->showXmlFile ();
	echo json_encode ( $status );
}
?>