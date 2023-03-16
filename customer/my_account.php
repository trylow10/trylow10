<?php  
session_start();
include("functions/functions.php");
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
			<a href="../index.php"><img id="logo" src="images/logo.png"/></a>
			
			<img id="banner" src="images/ad_banner.PNG"/>

			
		</div><!-- close of class header_wrapper -->

		<!--Navigation Bar starts-->
		<div class="menubar">
			<ul id="menu">
				<li><a href="../index.php">Home</a></li>
				<li><a href="../all_products.php">All Product</a></li>
				<li><a href="../customer/my_account.php">My Account</a></li>
				<li><a href="#">Sign Up</a></li>
				<li><a href="../cart.php">Shopping Cart</a></li>
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
				<div id="sidebar_title">My Account:</div>
					<?php
					if(isset($_SESSION['customer_email'] )){
					$user = $_SESSION['customer_email'] ; 
					$get_img = "select * from customers where customer_email = '$user' ";
					$run_img = mysqli_query($con, $get_img);
					$row_img = mysqli_fetch_array($run_img);
					$c_image = $row_img['customer_image'];
					$c_name = $row_img['customer_name'];


					echo "<p style='text-align:center; border='2px solid white' '><img src='customer_images/$c_image' width='150px' height='150px'  /> ";
					}
					?>
					<ul id="cats">
						<li><a href="my_account.php?my_orders">My Orders</a></li>
						<li><a href="my_account.php?edit_account">Edit Account</a></li>
						<li><a href="my_account.php?change_pass">Change Password</a></li>
						<li><a href="my_account.php?delete_account">Delete Account</a></li>
						<!--<li><a href="my_account.php?logout.php">Logout</a></li>-->
					</ul>

					


				


			</div>

			<div id="content_area">

				<?php
				cart();
				?>
				<div id="shopping_cart">
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">
						<?php
						if(isset($_SESSION['customer_email'])){
							 echo "<b>welcome: </b>" .$_SESSION['customer_email'] ;
						}
						?> 
					
					<?php 
					if(!isset($_SESSION['customer_email'])){
						echo "<a href='../checkout.php' style='color:orange'>Login</a>";
					}else{
						echo "<a href='logout.php' style='color:orange'>Logout</a>";
					}


					?>

					</span>
				</div>

				<div id="products_box">
					
					<?php 
					if(!isset($_GET['my_orders'])){
					 if(!isset($_GET['edit_account'])){
					 	if(!isset($_GET['change_pass'])){
					 		if(!isset($_GET['delete_account'])){

						echo "
						<h2 style='padding:20px;'>Welcome : $c_name </h2>
						<b>You can see your order progress by clicking this link<a href='my_orders'>link</a></b>";
					}
					}
					}
					}
					?>




					<?php
					if(isset($_GET['edit_account'])){
						include("edit_account.php");
					}

					?>

					<?php
					if(isset($_GET['change_pass'])){
						include("change_pass.php");
					}
					?>

					

					<?php
					if(isset($_GET['delete_account'])){
						include("delete_account.php");
					}

					?>				
				</div>


			</div><!-- end of content area(This is content area)-->
		</div>	<!--content wrapper ends-->

		<div id="footer">
			<h2 style="text-align: center; padding-top: 30px;">&copy; 2022 by www.onlineshopping.com</h2>

		</div>

	</div><!-- close of main class main_wrapper-->
</body>
</html>		