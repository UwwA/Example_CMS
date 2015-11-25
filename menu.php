<?php
	
$sql="SELECT name,cat_id FROM categories";

if ($result=$link->query($sql))
  {
	echo "<div class='topbar'>";
  // Fetch one and one row
  echo "<a href='/experimental/index'><div class='topbar-item left'><h1><i class='fa fa-home'></i></h1></div></a>\n\t";
  while ($row=mysqli_fetch_row($result))
    {
	if(isset($_GET['id'])&&$row[1]==$_GET['id']){$_SESSION['categoryName'] = $row[0];}
    echo "<a href='/experimental/index/$row[1]'><div class='topbar-item left'><h1 >" . $row[0] . "</h1></div></a>\n\t";
    }
	echo "<a href='/experimental/addmenu/'><div class='topbar-item right'><h1><i class='fa fa-plus-circle'></i> / <i class='fa fa-minus-circle'></i></h1></div></a>";

	echo "</div>";
  // Free result set
  mysqli_free_result($result);
}
?>