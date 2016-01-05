<?php
include 'htmlstart.html';
include 'db.php';
include 'functions.php';
//Sätt in i databasen innan menyn laddas
$get = $_GET['id'];
if(isset($_POST['name'])){
	//Kolla antal rader
	$sql="SELECT id FROM subcategories WHERE category_id=$_SESSION[categoryID]";
	if ($result=$link->prepare($sql)){
		$result->execute();
		$result->store_result();
		$num_rows = $result->num_rows;
		
	}else{
		die("MySQL error");
		}
	//Formverifikation
	if($_POST['name']==''){
		JSerror("Your string is empty.");
	}else if(strlen($_POST['name'])<2||strlen($_POST['name'])>10){
		JSerror("Your string is either too long or too short.");
	}else if($num_rows == 3){
		JSerror("Maximum amount of subcategories reached. Delete a category to make space.");
	}else{
		$stmt = $link->prepare("INSERT INTO subcategories(name,category_id) VALUES (?,?)");
		$stmt->bind_param("si", $_POST[name],$_SESSION[categoryID]);
		if($stmt->execute()){
			JSsuccess("Successfully added category <b>gg</b>!");
		}
		else{
			JSerror("Failed to insert into database.");
		}
	}

}
if(isset($_POST['removeName'])){
	//Ta bort en underkategori säkert från databasen
	$stmt = $link->prepare("DELETE FROM subcategories WHERE name=? AND category_id=?");
	$stmt->bind_param("si", $_POST[removeName],$_SESSION[categoryID]);
	if($stmt->execute()){
		JSsuccess("Successfully removed subcategory <b>$_POST[removeName]</b>!");
	}else{
		JSerror("An unexpected error has occured.");
	}
}
include 'menu.php';
include 'sidemenu.php';

echo "<div class='content'><p class='text'>";
?>
<!--div som visar felmeddelanden-->
<div class='content'><p class='text'>
<div class="notif error">
  <h2>Error!</h2>
  <p class='notifText'></p>
</div></p>
<?php
if(!isset($_SESSION['categoryName'])){die("Unexpected error.");}

echo "<div class='form-style'>
<div class='form-style-heading'>Add a subcategory for $_SESSION[categoryName]</div>
<form action='' method='post' class='validateForm'>
<label for='field1'><span name='field1'>Name <span class='required'>*</span></span><input type='text' class='input-field' name='name' placeholder='(2-10 characters)' /></label>
<label><span>&nbsp;</span><input type='submit' value='Submit' /></label>
</form>
</div>";
echo "<div class='form-style'>
<div class='form-style-heading'>Remove a subcategory from $_SESSION[categoryName]</div>
<form action='' method='post' class='validateForm'>
<label for='field4'><span>Subcategory <span class='required'>*</span></span><select name='removeName' class='select-field'>";


$sql="SELECT name,id FROM subcategories WHERE category_id=$_SESSION[categoryID]";
if ($result=$link->query($sql))
{
	while ($row=mysqli_fetch_row($result))
	{	
		echo "\n\t<option value='$row[0]'>$row[0]</option>";
		
	}
}

echo "\n</select></label>
<label><span></span><input type='submit' value='Delete' /></label>
</form>
</div>";
		
?>	

</form>
</div>