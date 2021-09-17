<?php
	require_once("header.php");
?><div class="container">
<?php
	if(!empty($_GET) AND $_GET['error'] == "error")
	{
?>
		<p class="error">Invalid user data!</p>
<?php 
}
?>		
	<h1>User Registration Form</h1>
	<form method="post" action="action_page.php">
  <div class="form-group">
    <label for="validationDefault01">First name</label>
    <input type="text" class="form-control" name="firstname" id="validationDefault01" value="" placeholder="Enter First name" required>
  </div>
  <div class="form-group">
    <label for="validationDefault02">Last name</label>
    <input type="text" class="form-control" name="lastname" id="validationDefault02" value="" placeholder="Enter Last name" required>
  </div>
  <div class="form-group">
    <label for="validationDefault03">Mobile number</label>
    <input type="number" class="form-control" name="mobileno" id="validationDefault03" placeholder="Enter Mobile number" value="" required>
  </div>
  <button type="submit" class="button" name="submit" value="add_user">Submit</button>
</form>
</div>
<?php
	require_once("footer.php");
 ?>