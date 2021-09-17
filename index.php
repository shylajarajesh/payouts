<?php
	require_once("header.php");
?>
<div class="container">
<?php
	if(!empty($_GET) AND $_GET['error'] == "error")
	{
?>
		<p class="error">Username and password not valid</p>
<?php 
}
?>	
	<h1>Login</h1>
	<form method="post" action="action_page.php">
  <div class="form-group">
    <label for="validationDefault01">User name</label>
    <input type="text" class="form-control" name="user_name" id="validationDefault01" value="" placeholder="Enter username" required>
  </div>
  <div class="form-group">
    <label for="validationDefault02">Password</label>
    <input type="text" class="form-control" name="password" id="validationDefault02" value="" placeholder="Enter password" required>
  </div>
   <button type="submit" class="button" name="submit" value="add_login">Submit</button>
</form>
 </div>
 <?php
	require_once("footer.php");
 ?>
 