<?php

$sql="SELECT name,cat_id FROM categories";
if ($result=$link->query($sql))
  {
	echo "<div class='topbar'>";
	echo "<a href='/index'><div class='topbar-item left'><h1 class='topmenu'><i class='fa fa-home'></i></h1></div></a>\n\t";
	while ($row=mysqli_fetch_row($result))
		
    {	//Sätt session till den kategori som användaren är inne på
		if(isset($_GET['id'])&&$row[1]==$_GET['id']){
			$_SESSION['categoryName'] = $row[0];
			$_SESSION['categoryID'] = $row[1];
		}
    echo "<a href='/index/$row[1]'><div class='topbar-item left'><h1 class='topmenu'>" . $row[0] . "</h1></div></a>\n\t";
    }
	echo "<a href='/addmenu/' title='Add or Remove a topic'><div class='topbar-item right'><h1 class='topmenu'><i class='fa fa-plus-circle'></i> / <i class='fa fa-minus-circle'></i></h1></div></a>";

	echo "</div>";
	mysqli_free_result($result);
}else{
	echo "Unable to retreieve menu from DB.";
}
?>