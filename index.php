
<?php 

include 'htmlstart.html';
include 'db.php';
include 'functions.php';
include 'menu.php';
include 'sidemenu.php';
//Om användaren är inne på en sida för en item
if(isset($_GET['item']))
{
	$id = $_GET['item'];
	$result = get_content($link,$id);
	//Skriv ut information
	while ($row = $result->fetch_assoc()) {
		echo "<h1>$row[name]</h1><p>" . $row['content'] . "</p>\n\t";
	}
//Om användaren är inne på startsidan
}else if(!isset($_GET['item'])&&$_GET['id']==0){
	echo "<h1>Welcome to the homepage of this Custom CMS. </h1>" .
	"<p>Feel free to edit anything as you see fit. This site is made for testing purposes only. CSS is designed and tested for 1920x1080 in Chrome and may not be compatible with other resolutions or browsers.</p>";
}
else{
	echo "<h1>Please select an item using the left menu</h1>";
}	
	
	?>

	</div>
</div>

</body>
</html>
