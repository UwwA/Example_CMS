<div class='container'>
<?php
echo "<div class='menu'>";
if(isset($_GET['id'])&&$_GET['id']!=0){
	$id = $_GET['id'];

	$result = get_subCategories($link,$id);
	while ($row = $result->fetch_assoc()) {
		
		echo "<p class='menutext'>" . $row['name'] . "</p>\n\t";
		$result2 = get_menu_items($link,$row['id']);
		while ($row2 = $result2->fetch_assoc()) {
			echo  "<p class='itemtext'><a href='/experimental/index/$_GET[id]/$row2[id]'> $row2[name]</a> </p> ";
		}
		
		if($result2->num_rows==0){
			echo "<p class='itemtext'>There are no items for this category yet.</p>";
		}
		echo "<a href='/experimental/additem/'><p class='itemtext'>Add a new item.</p></a>";
		
	}
	if($result->num_rows==0){
		echo "<p class='menutext'>There are no subcategories for this topic yet.</p>";
		}
	echo "<br><a href='/experimental/addcategory/'><p class='itemtext'>Create a new subcategory</p></a><br>\n";
}else{
echo "<p class='menutext'>Subcategories are not available for this page.</p>";
}
echo "</div>";
?>