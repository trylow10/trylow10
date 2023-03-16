<?php  
session_start();
include("functions/functions.php");
include("includes/db.php");//db.php means making a connection
?>
<!DOCTYPE>


<html>
	<head> 
		<title>My Online Shop</title> 
		<link rel="stylesheet" href="styles/style.css " media="all" type="text/css" >
	<head>
<body>
	<!--Main containter or wrapper starts from here    -->
	<div class="main_wrapper">

		<!-- header starts from here-->
		<div class="header_wrapper"><!--this is header-->
			<a href="index.php"><img id="logo" src="images/logo.png"/></a>
			
			<img id="banner" src="images/ad_banner.PNG"/>

			
		</div><!-- close of class header_wrapper -->

		<!--Navigation Bar starts-->
		<div class="menubar">
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_products.php">All Product</a></li>
				<li><a href="customer/my_account.php">My Account</a></li>
				<li><a href="#">Sign Up</a></li>
				<li><a href="cart.php">Shopping Cart</a></li>
				<li><a href="#">Contact us</a></li>	

			</ul>

			<div id="form"> 
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a product" />
					<input type="submit" name="search" value="Search" />

				</form>


			</div>
		</div> <!--Navigation Bar ends-->
		
		<!--Content wrapper starts-->
		<div class="content_wrapper">

			<div id="sidebar">
				<div id="sidebar_title">Categories</div>
					
					<ul id="cats">

						<?php
							//show categories (list) from database  
							getCats();  
						?>	
					</ul>

					<div id="sidebar_title">Brands</div>
					<ul id="cats">
						<?php  getBrands(); ?>

					</ul>


				


			</div>

			<div id="content_area">

				<?php
				cart();
				?>
				<div id="shopping_cart">
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">Welcome Guest!
					<b style="color:yellow">Shopping Cart -</b>Total Items:<?php total_items(); ?> Total Price: <?php  total_price(); ?><a href="cart.php" style="color:yellow">Go to Cart</a>	


					</span>
				</div>

				<div id="products_box">
				<form action="customer_register.php" method="post" enctype="multipart/form-data">
					<table align="center" width="750px" >
						<tr align="center">
							<td colspan="8"><h2>Create an Account</h2></td>
						</tr>

						<tr>
							<td align="right">Customer Name:</td>
							<td><input type="text" name="c_name" required /></td>
						</tr>
						
						<tr>
							<td align="right">Customer Email:</td>
							<td><input type="text" name="c_email" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Password</td>
							<td><input type="password" name="c_pass" required /></td>
						</tr>

						<tr>
							<td align="right">Customer Image</td>
							<td><input type="file" name="c_image" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Country</td>
							<td>
							<select name="c_country">
								<option>Select a country</option>
								<option>Nepal</option>
								<option>India</option>
								<option>China</option>
							</select>
						</td>
						</tr>

						<tr>
							<td align="right">Customer City:</td>
							<td><input type="text" name="c_city" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Contact:</td>
							<td><input type="text" name="c_contact" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Address</td>
							<td><input type="text" name="c_address" required /></textarea></td>
						</tr>

						<tr align="center">
							
							<td colspan="6"><input type="submit" name="register" value="Create an account"></td>
						</tr>

						

					</table>	
				</form>
					
					
					
				</div>


			</div><!-- end of content area(This is content area)-->
		</div>	<!--content wrapper ends-->

		<div id="footer">
			<h2 style="text-align: center; padding-top: 30px;">&copy; 2022 by www.onlineshopping.com</h2>

		</div>

	</div><!-- close of main class main_wrapper-->
</body>
</html>		
<?php
if(isset($_POST['register'])){
	$ip = getIp();
	$c_name = $_POST['c_name'];
	$c_email = $_POST['c_email'];
	$c_pass = $_POST['c_pass'];
	$c_country = $_POST['c_country'];
	$c_city = $_POST['c_city'];
	$c_contact = $_POST['c_contact'];
	$c_address = $_POST['c_address'];
	$c_image = $_FILES['c_image']['name'];
	$c_image_tmp = $_FILES['c_image']['tmp_name'];

	move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

	 //$insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";



	$run_c = mysqli_query($con,"insert into customers(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')");
	
	
	$sel_cart="select * from cart where ip_add='$ip' ";

	$run_cart= mysqli_query($con,$sel_cart);

	$check_cart = mysqli_num_rows($run_cart);

	if($check_cart==0){
		$_SESSION['customer_email'] = $c_email ;
		echo"<script>alert('Registratrion has been created successful')</script>";
		echo"<script>window.open('customer/my_account.php','_self')</script>";

	}else{
		$_SESSION['customer_email'] = $c_email ;
		echo"<script>alert('Registratrion has been created successful')</script>";
		echo"<script>window.open('customer/checkout.php','_self')</script>";
	}


}

?>