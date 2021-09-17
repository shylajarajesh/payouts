<?php
	require_once("header.php");
?>
<div class="container">	
<?php
	if(!empty($_GET))
	{
		$err_msg = $_GET['error'];
?>
		<p class="error"><?php echo $err_msg; ?></p>
<?php 
}
?>		
	<h1>Add Beneficiary Details</h1>
	<form method="post" action="action_page.php">
  <div class="form-group">
    <label for="validationDefault01">Name</label>
    <input type="text" class="form-control" name="bene_name" id="validationDefault01" value="" placeholder="Enter your name" required>
  </div>
  <div class="form-group">
    <label for="validationDefault02">Email</label>
    <input type="email" class="form-control" name="email" id="validationDefault02" value="" placeholder="Enter your email" required>
  </div>
  <div class="form-group">
    <label for="validationDefault03">Mobile number</label>
    <input type="number" class="form-control" name="mobile_no" id="validationDefault03" placeholder="Enter Mobile number" value="" required>
  </div>
   <div class="form-group">
    <label for="validationDefault04">Bank account number</label>
    <input type="text" class="form-control" name="bank_accno" id="validationDefault04" value="" placeholder="Enter your account number" required>
  </div>
  <div class="form-group">
    <label for="validationDefault05">IFSC Code</label>
    <input type="text" class="form-control" name="ifsccode" id="validationDefault05" value="" placeholder="Enter IFSC Code" required>
  </div>
  <div class="form-group">
    <label for="validationDefault06">Address1</label>
    <input type="text" class="form-control" name="address1" id="validationDefault06" value="" placeholder="Enter your address" required>
  </div>
  <div class="form-group">
    <label for="validationDefault07">City</label>
    <input type="text" class="form-control" name="city" id="validationDefault07" value="" placeholder="Enter your city" required>
  </div>
  <div class="form-group">
    <label for="validationDefault08">State</label>
    <input type="text" class="form-control" name="state" id="validationDefault08" value="" placeholder="Enter your state" required>
  </div>
  <div class="form-group">
    <label for="validationDefault09">Pincode</label>
    <input type="text" class="form-control" name="pincode" id="validationDefault09" value="" placeholder="Enter your pincode" required>
  </div>
  <button type="submit" class="button" name="submit" value="add_bene">Submit</button>
</form>
</div>

<?php
	require_once("footer.php");
 ?>