<?php
	require_once("header.php");
	session_start();
?><div class="container">
  <h2>List of Beneficiaries</h2>
  <div align="right"><a href="add_bene.php"><button type="submit" class="button" name="submit">Add Beneficiary</button></a></div>
<?php 
//echo $_SESSION['mobileno'];
	$mobileno = $_SESSION['mobileno'];
	$select_bene = $database->query("SELECT * FROM add_bene WHERE user_mobno = '$mobileno'");
	$query = $database->fetchAll();
	if(!empty($query)){
?>  
  <table class="table table-striped" border = "1">
    <thead style="background-color:skyblue">
      <tr>
		<th>Sno</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($query as $key => $val){ ?>
      <tr>
		<td><?php echo $key; ?> </td>
        <td><?php echo $val['name']; ?> </td>
		<td><?php echo $val['email']; ?> </td>
		<td><?php echo $val['phone']; ?> </td>
      </tr>
	<?php } ?>
    </tbody>
  </table>
	<?php } ?>
	<div align="right"><a href="logout.php"><button type="submit" class="button" name="submit">Logout</button></a></div>
</div>
<?php
	require_once("footer.php");
 ?>

