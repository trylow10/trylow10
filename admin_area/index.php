<?php 
session_start();
//if admin email is not loign
if(!isset($_SESSION['user_email'])){
	echo "<script>window.open('login.php?Not_admin?=You are not an Admin!','_self')</script>";
}else{



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
	<title>This is Admin Panel</title>
</head>

<body>
	<div class="main_wrapper">
		<div id="header"><h2 align="center">Admin Panel</h2></div>
			<div id="right">
				<h2 style="text-align: center;">Manage Content</h2>
			
				<a href="index.php?insert_product">Insert New Product</a>
				<a href="index.php?view_products">View All Product</a>
				<a href="index.php?insert_cat">Insert New Category</a>
				<a href="index.php?view_cats">View All Category</a>
				<a href="index.php?insert_brand">Insert New Brand</a>
				<a href="index.php?view_brands">View All Brands</a>
				<a href="index.php?view_customers">View Customers</a>
				<a href="index.php?view_orders">View Orders</a>
				<a href="index.php?view_payment">View Payments</a>
				<a href="logout.php">Admin Logout</a>

			</div>

			<div id="left">

				<h2 style="color: red; text-align: center;"><?php @$_GET['logged_in']; ?></h2>
				<?php
				if(isset($_GET['insert_product'])){
					include("insert_product.php");
				}

				if(isset($_GET['view_products'])){
					include("view_products.php");
				}

				if(isset($_GET['edit_pro'])){
					include("edit_pro.php");
				}


				if(isset($_GET['insert_cat'])){
					include("insert_cat.php");
				}

				if(isset($_GET['view_cats'])){
					include("view_cats.php");
				}

				if(isset($_GET['edit_cat'])){
					include("edit_cat.php");
				}

				if(isset($_GET['insert_brand'])){
					include("insert_brand.php");
				}
				if(isset($_GET['view_brands'])){
					include("view_brands.php");
				}

				if(isset($_GET['edit_brand'])){
					include("edit_brand.php");
				}


				if(isset($_GET['view_customers'])){
					include("view_customers.php");
				}

				?>
			</div>
		

	</div>	


</body>
</html>
<?php }//close of else
?>

