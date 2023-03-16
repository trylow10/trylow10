<br>
<h2 style="text-align: center; ">Do you really want to delete your account?</h2><br><br>
<form action = "" method="post">
	<input type="submit" name="yes" value="Yes I want"/>
	<input type="submit" name="no" value="No"/>

</form>
<?php
include("includes/db.php");
	if(isset($_SESSION['customer_email'])){
	$user = $_SESSION['customer_email'];
	if(isset($_POST['yes'])){
		$delete_customer = "delete from customers where customer_email ='$user' ";
		
		$run_customer = mysqli_query($con,$delete_customer);
		echo "<script>alert('Your account has been deleted')</script>";
		echo "<script>window.open('logout.php','_self')</script>";
	}	

	if(isset($_POST['no'])){
		
		echo "<script>alert('Not deleted')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
	}	
	}				
?>