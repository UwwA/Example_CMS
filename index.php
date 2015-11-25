
<?php 

include 'htmlstart.html';
include 'db.php';
include 'functions.php';
include 'menu.php';
include 'sidemenu.php';

?> 
	
	
<div class='content'><p class='text'>
<div class="notif error">
  <h2>Just checking!</h2>
  <p class='notifText'>Insert notification message here. :P</p>
</div></p>

<?php
if(isset($_GET['item']))
{
	$id = $_GET['item'];
	$result = get_content($link,$id);
	while ($row = $result->fetch_assoc()) {
	echo "<h1>$row[name]</h1><p>" . $row['content'] . "</p>\n\t";
	}
}else{
	echo "<h1>Please select an item using the left menu</h1>";
}
	
	
	?>
<!--
<div class="form-style-2">
<div class="form-style-2-heading">Provide your information</div>
<form action="" method="post">
<label for="field1"><span>Name <span class="required">*</span></span><input type="text" class="input-field" name="field1" value="" /></label>
<label for="field2"><span>Email <span class="required">*</span></span><input type="text" class="input-field" name="field2" value="" /></label>
<label for="field4"><span>Regarding</span><select name="field4" class="select-field">
<option value="General Question">General</option>
<option value="Advertise">Advertisement</option>
<option value="Partnership">Partnership</option>
</select></label>
<label for="field5"><span>Message <span class="required">*</span></span><textarea name="field5" class="textarea-field"></textarea></label>

<label><span>&nbsp;</span><input type="submit" value="Submit" /></label>
</form>
</div>
-->
</div>
	</div>

</body>
</html>
