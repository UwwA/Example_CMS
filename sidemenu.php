<div class='container'>
<?php
echo "<div class='menu'>";
//Om användaren är inne på en subkategori som inte är startsidan
if(isset($_GET['id'])&&$_GET['id']!=0){
	$id = $_GET['id'];
	$result = get_subCategories($link,$id);
	//Hämta meny från databas
	while ($row = $result->fetch_assoc()) {
		echo "<p class='menutext'>" . $row['name'] . "</p>\n\t";
		$result2 = get_menu_items($link,$row['id']);
		while ($row2 = $result2->fetch_assoc()) {
			echo  "<p class='itemtext'><a href='/index/$_GET[id]/$row2[id]'> $row2[name]</a> </p> ";
		}
		
		if($result2->num_rows==0){
			echo "<p class='itemtext'>There are no items for this category yet.</p>";
		}
		echo "<a href='/additem/$row[id]'><p class='itemtext'>Add a new item.</p></a>";
		
	}
	//Om subkategorier inte finns för denna kategorin
	if($result->num_rows==0){
		echo "<p class='menutext'>There are no subcategories for this topic yet.</p>";
		}
	echo "<br><a href='/addsubcat/'><p class='itemtext'>Manage subcategories</p></a><br>\n";
}else{
echo "<p class='menutext'>Subcategories are not available for this page.</p>";
}
echo "</div>";
?>