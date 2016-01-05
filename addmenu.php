<?php
include 'htmlstart.html';
include 'db.php';
include 'functions.php';
//Sätt in i databasen innan menyn laddas
if(isset($_POST['name'])){
	//Kolla antal rader
	$sql="SELECT name,cat_id FROM categories";
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
	}else if($num_rows == 10){
		JSerror("Maximum amount of categories reached. Delete a category to make space.");
	}else{
		//Försök sätta in ny kategori i databasen, name är unique key
		$stmt = $link->prepare("INSERT INTO categories(name) VALUES (?)");
		$stmt->bind_param("s", $_POST[name]);
		if($stmt->execute()){
			JSsuccess("Successfully added category <b>$_POST[name]</b>!");
		}
		else{
			JSerror("Failed to insert into database. Make sure your entry is not a duplicate.");
		}
	}
}
if(isset($_POST['removeName'])){
	//Ta bort en kategori säkert från databasen
	$stmt = $link->prepare("DELETE FROM categories WHERE name=?");
	$stmt->bind_param("s", $_POST[removeName]);
	if($stmt->execute()){
		JSsuccess("Successfully removed category <b>$_POST[removeName]</b>!");
	}else{
		JSerror("An unexpected error has occured.");
	}
}
order_categories($link);
include 'menu.php';
include 'sidemenu.php';
?>
<!--div som visar felmeddelanden-->
<div class='content'><p class='text'>
<div class="notif error">
  <h2>Error!</h2>
  <p class='notifText'></p>
</div></p>
<div class="notif success">
  <h2>Success!</h2>
  <p class='notifText'></p>
</div>

<div class='form-style'>
<div class='form-style-heading'>Add a category to the top menu</div>
<form action='' method='post' class='validateForm'>
<label for='field1'><span name='field1'>Name <span class='required'>*</span></span><input type='text' class='input-field' name='name' placeholder='(2-10 characters)' /></label>
<label><span>&nbsp;</span><input type='submit' value='Submit' /></label>
</form>
</div>
<div class='form-style'>
<div class='form-style-heading'>Remove a category from the top menu</div>
<form action='' method='post' class='validateForm'>
<label for='field4'><span>Category <span class='required'>*</span></span><select name='removeName' class='select-field'>
<?php
$sql="SELECT name,cat_id FROM categories";

if ($result=$link->query($sql))
{
	while ($row=mysqli_fetch_row($result))
	{	
		echo "<option value='$row[0]'>$row[1]. $row[0]</option>\n\t";
	}
}
?>
</select></label>
<label><span>&nbsp;</span><input type='submit' value='Delete' /></label>
</form>
</div>

</form>
</div>