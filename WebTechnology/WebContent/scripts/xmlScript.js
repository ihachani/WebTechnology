/**
 * 
 */

function loadXMLDoc(dname) {
	if (window.XMLHttpRequest) {
		xhttp = new XMLHttpRequest();
	} else {
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.open("GET", dname, false);
	xhttp.send();
	return xhttp.responseXML;
}

function loadXMLString(txt) {
	if (window.DOMParser) {
		parser = new DOMParser();
		xmlDoc = parser.parseFromString(txt, "text/xml");
	} else // Internet Explorer
	{
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = "false";
		xmlDoc.loadXML(txt);
	}
	return xmlDoc;
}

function getProduct(xmlProduit){
	/*
	 * Works in firefox.(firefox treats whitespaces as child nodes).
	 * ie don't.
	 * google chrome (i don't know yet).
	 */
	
	product = new Array();
	product.push(xmlProduit.getElementsByTagName("produit")[0].childNodes[1].childNodes[0].nodeValue);
	product.push(xmlProduit.getElementsByTagName("produit")[0].childNodes[3].childNodes[0].nodeValue);
	product[2] = xmlProduit.getElementsByTagName("produit")[0].childNodes[5].childNodes[0].nodeValue;
	return product;
}

function showProduct(product){
	document.write("<p>" + product[0] + "</p>");
	document.write("<p>" + product[1] + "</p>");
	document.write("<p>" + product[2] + "</p>");
}

function getAllProducts(xmlProduit){
	/*
	 * For firefox for now
	 */
	xmlProducts = new Array();
	xmlProducts = xmlProduit.getElementsByTagName("produit");
	return xmlProducts;
}

function getProductFromArray(pos,products){
	product = new Array();
	product[0] = products[pos].childNodes[1].childNodes[0].nodeValue;
	product[1] = products[pos].childNodes[3].childNodes[0].nodeValue;
	product[2] = products[pos].childNodes[5].childNodes[0].nodeValue;
	return product;
}

function showAllProducts(products){
	for(i = 0; i < products.length ; i++){
		showProduct(getProductFromArray(i, products));
	}
}