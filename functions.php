<?php
header('HTTP/1.0 403 Forbidden');
function get_categories($link){
	
	
}
function JSerror($error){
	$error .= " Please click again to close.";
	echo "<script type=text/javascript>$(document).ready(function(){
$(document).setError('$error');});</script>";
	
}

function get_subCategories($link,$id){
	$stmt = $link->prepare("SELECT name,id FROM subcategories WHERE subcategories.category_id=?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}
function get_menu_items($link,$id){
	$stmt = $link->prepare("SELECT menu_items.name,menu_items.id,menu_items.subcat_id FROM menu_items INNER JOIN subcategories ON subcategories.id=menu_items.subcat_id WHERE menu_items.subcat_id=?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}
function order_categories($link){
	$stmt = $link->prepare("SELECT cat_id FROM categories");
	$stmt->execute();
	$result = $stmt->get_result();
	$counter = 1;
	while ($row = $result->fetch_assoc()) {
		if($counter!==$row['cat_id']){
			$link->query("UPDATE categories SET cat_id=$counter WHERE cat_id=$row[cat_id]");
		}
		$counter++;
	}
}
function get_content($link,$id){
	$stmt = $link->prepare("SELECT name,content FROM menu_items WHERE id=?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}
?>