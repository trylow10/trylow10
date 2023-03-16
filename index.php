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

					<span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">
						<?php
						

						// $abc = $_GET['id'];
						// echo "Hello rohit $abc";
						if(isset($_SESSION['customer_email'])){
							 echo "<b>welcome: </b>" .$_SESSION['customer_email'] ."<b style='color:yellow;'>Your </b>";
						}else{
							echo "<b>Welcome Guest</b>";
						}
						?> 
					<b style="color:yellow">Shopping Cart -</b>Total Items:<?php total_items(); ?> Total Price: <?php  total_price(); ?><a href="cart.php" style="color:yellow">Go to Cart</a>	
					<?php 
					if(!isset($_SESSION['customer_email'])){
						echo "<a href='checkout.php' style='color:orange'>Login</a>";
					}else{
						echo "<a href='logout.php' style='color:orange'>Logout</a>";
					}


					?>

					</span>
				</div>

				<div id="products_box">

					<?php 	
					//get ip address of local machine
					//echo $ip = getIp(); ?>
					
					<?php
					//show all product in home page
						getPro();

					?>

					<?php getCatPro(); ?>

					<?php getBrandPro(); ?>
				</div>


			</div><!-- end of content area(This is content area)-->
		</div>	<!--content wrapper ends-->

		<div id="footer">
			<h2 style="text-align: center; padding-top: 30px;">&copy; 2022 by www.onlineshopping.com</h2>

		</div>

	</div><!-- close of main class main_wrapper-->
</body>
</html>		