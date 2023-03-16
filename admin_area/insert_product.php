<?php
//making a connection only
include("includes/db.php");
session_start();
//if admin email is not loign
if(!isset($_SESSION['user_email'])){
	echo "<script>window.open('login.php?Not_admin?=You are not an Admin!','_self')</script>";
}else{
?>
<!DOCTYPE>
<html>
	<head>
		<title>Inserting Product</title>
		<script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/4/tinymce.min.js'></script>
  			<script>
  				tinymce.init({
    				selector: '#mytextarea'
  					});
  			</script>

	</head>
<body bgcolor="skyblue">
	<form action="insert_product.php" method="post" enctype="multipart/form-data">
		<table align="center" width="976px" border="2" bgcolor="187eae">
			<tr align="center">
				<td colspan="7"><h2>Insert New Post Here</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Product Title : </b></td>
				<td><input type="text" name="product_title" size="60" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Category</b></td>
				<td>
					<select name="product_cat" required>
						<option>Select a Category</option>
						<?php 
						//show category from data base
							$get_cats = "select * from categories";
							$run_cats = mysqli_query($con,$get_cats);
							while ($row_cats=mysqli_fetch_array($run_cats)) {
								$cat_id = $row_cats['cat_id'];
								$cat_title = $row_cats['cat_title'];
		
								echo "<option value='$cat_id'>$cat_title</option>";
							}
						?>
					</select>



				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Brand : </b></td>
				<td>
					<select name="product_brand" required>
						<option>Select a Brand</option>
						<?php 
							//show brands from database
							$get_brands = "select * from brands";
							$run_brands = mysqli_query($con,$get_brands);
							while ($row_brands=mysqli_fetch_array($run_brands)) {
							$brand_id = $row_brands['brand_id'];
							$brand_title = $row_brands['brand_title'];
		

							echo "<option value='$brand_id'>$brand_title</option>";
							}
						?>
					</select>

				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Image : </b></td>
				<td><input type="file" name="product_image" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Price : </b></td>
				<td><input type="text" name="product_price" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Description : </b></td>
				<td>
					<form method="post" >
						<textarea id="mytextarea" name="product_desc" cols="25"  rows="10" ></textarea></td>
					</form>		
			</tr>
			<tr>
				<td align="right"><b>Product Keywords : </b></td>
				<td><input type="text" name="product_keywords" size="50"></td>
			</tr>
			<tr align="center">
				<td colspan="7"><input type="submit" name="insert_post" value="Insert Product Now" required></td>
			</tr>
		</table>


	</form>


</body>
</html>



<?php
	//getting the data from form
	if(isset($_POST['insert_post'])){
		//getting the text data from the fields		
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_title = $_POST['product_title'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];
	
		//getting the image from the field or form
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		//save images in folder product_images
		move_uploaded_file($product_image_tmp, "product_images/$product_image");


		   $insert_product = "insert into products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) values('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords') ";
		 	
		
	 	//insert into table products
		$insert_pro  = mysqli_query($con,$insert_product);
		
		if($insert_pro) {
		echo "<script>alert('Products has been inserted')</script>";
		 echo "<script>window.open('index.php?insert_product','_self')</script>";
		}
	
	}

?>
<?php }?>
