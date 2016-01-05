<?php
include 'htmlstart.html';
include 'db.php';
include 'functions.php';
//Sätt in i databasen innan menyn laddas
if(isset($_POST['name'])){
	//Kolla antal rader
	$sql="SELECT name,subcat_id FROM menu_items WHERE subcat_id=$_GET[item_id]";
	if ($result=$link->prepare($sql)){
		$result->execute();
		$result->store_result();
		$num_rows = $result->num_rows;
		
	}else{
		die("MySQL error");
	}
	//Formverifikation
	if($_POST['name']==''||$_POST['content']==''){
		JSerror("Your string is empty.");
	}else if(strlen($_POST['name'])<2||strlen($_POST['name'])>10){
		JSerror("Your string is either too long or too short.");
	}else if($num_rows == 5){
		JSerror("Maximum amount of items for this subcategory reached. Delete an item to make space.");
	}else{
		$stmt = $link->prepare("INSERT INTO menu_items(name,content,subcat_id) VALUES (?,?,?)");
		$stmt->bind_param("ssi", $_POST[name],$_POST[content],$_GET[item_id]);
		if($stmt->execute()){
			JSsuccess("Successfully added item <b>$_POST[name]</b>!");
		}
		else{
			JSerror("Failed to insert into database.");
		}
		
	}

}
if(isset($_POST['removeName'])){
	//Ta bort säkert från databasen
	$stmt = $link->prepare("DELETE FROM menu_items WHERE name=? AND subcat_id=?");
	$stmt->bind_param("si", $_POST[removeName],$_GET[item_id]);
	if($stmt->execute()){
		JSsuccess("Successfully removed item <b>$_POST[removeName]</b>!");
	}else{
		JSerror("An unexpected error has occured.");
	}
}
order_categories($link);
include 'menu.php';
include 'sidemenu.php';

?>
<!--div som visar notiser-->
<div class='content'><p class='text'>
<div class="notif error">
  <h2>Error!</h2>
  <p class='notifText'></p>
</div></p>
<div class="notif success">
  <h2>Success!</h2>
  <p class='notifText'></p>
</div>
<?php
$sql = "SELECT name FROM subcategories WHERE id=$_GET[item_id]";
$name = $link->query($sql)->fetch_object()->name;

echo "<div class='form-style'>
<div class='form-style-heading'>Add an item to $name</div>
<form action='' method='post' >
<label for='field1'><span name='field1'>Name <span class='required'>*</span></span><input type='text' class='input-field' name='name' placeholder='(2-10 characters)' /></label>
<label for='field5'><span>Info <span class='required'>*</span></span><textarea name='content' class='textarea-field' placeholder='(2-2000 characters)'></textarea></label>
<label><span>&nbsp;</span><input type='submit' value='Submit' /></label>
</form>
</div>";
echo "<div class='form-style'>
<div class='form-style-heading'>Remove an item from $name</div>
<form action='' method='post'>
<label for='field4'><span>Category <span class='required'>*</span></span><select name='removeName' class='select-field'>";
$sql="SELECT name FROM menu_items WHERE subcat_id=$_GET[item_id]";

if ($result=$link->query($sql))
{
	while ($row=mysqli_fetch_row($result))
	{	
		echo "<option value='$row[0]'> $row[0]</option>\n\t";
	}
}

echo "</select></label>
<label><span>&nbsp;</span><input type='submit' value='Delete' /></label>
</form>
</div>";

?>	

</form>
</div>