<?php
$products = array();
$product = array();
$currentTeg = "";
function getProducts() {
	global $products, $product;
	$parser=xml_parser_create();
	xml_set_element_handler($parser,"start","stop");
	xml_set_character_data_handler($parser,"char");
	$fp=fopen("xml/shop.xml","r");
	while ($data=fread($fp,4096)){
		xml_parse($parser,$data,feof($fp)) or
		die (sprintf("XML Error: %s at line %d",
		xml_error_string(xml_get_error_code($parser)),
		xml_get_current_line_number($parser)));
	}
	xml_parser_free($parser);
	return $products;
}

function start($parser, $elem, $element_attrs){
	global $product,$currentTeg;
	switch($elem){
		case "ITEM":
			$product["NAME"] = $element_attrs["NAME"];
			break;
		case "DISPLAY":
			$currentTeg = "DISPLAY";
			break;
		case "IMAGE":
			$currentTeg = "IMAGE";
			break;
		case "ITEMS":
			break;
		default:
			$product[$elem] = $element_attrs["VALUE"];
			break;
    }
}

function stop($parser, $element_name){
	global $products,$product,$currentTeg;
	if($element_name=="ITEM")
		$products[] = $product;
	$currentTeg= "";
}

function char($parser, $data){
	global $product,$currentTeg;
	if($currentTeg == "IMAGE" || $currentTeg == "DISPLAY")
		$product[$currentTeg] = $data;
}
?>