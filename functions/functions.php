<?php

$con = mysqli_connect("localhost","root","root","ecommerce");


if(mysqli_connect_errno()){
	echo "The connection was not established:"; 

}
//getting the user IP adress
	function getIp() {
    	$ip = $_SERVER['REMOTE_ADDR'];
 
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	$ip = $_SERVER['HTTP_CLIENT_IP'];
   		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
 
    	return $ip;
    	
	}//close of getip()


//add to cart features or creating the shopping cart
function cart(){
	if(isset($_GET['add_cart'])){
		global $con;
		$ip = getIp();
		$pro_id = $_GET['add_cart'];
		echo $ip;
		echo $pro_id;
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id' ";
		echo $check_pro;

		$run_check = mysqli_query($con,$check_pro);
		
		if($total = mysqli_num_rows($run_check)>0){
			
			echo "";
		}else{
			$insert_pro = "insert into cart(p_id,ip_add) values('$pro_id','$ip') ";
			$run_pro = mysqli_query($con,$insert_pro);
			echo "<script>window.open('index.php','_self')</script>";
		}
	}
}//close of cart ()


//getting the total added items
function total_items(){
	if(isset($_GET['add_cart'])){

		global $con;
		$ip = getIp();
		$get_items = "select * from cart where ip_add='$ip' ";
		$run_items = mysqli_query($con,$get_items);
		$count_items = mysqli_num_rows($run_items);

	}else{
	 global $con;
	 $ip = getIp();
	 $get_items = "select * from cart where ip_add='$ip' ";
	 $run_items = mysqli_query($con,$get_items);
	 $count_items = mysqli_num_rows($run_items);

	}//close of else
	echo $count_items;//display the total numbers selecte

}//close of total_items()


//getting the total price of the items in the carts
function total_price(){
	$total = 0;
	global $con;
	$ip = getIp();
	
	$sel_price = "select * from cart where ip_add='$ip' ";
	
	
	$run_price = mysqli_query($con,$sel_price);
	
	while($p_price = mysqli_fetch_array($run_price)){
		$pro_id  = $p_price['p_id'];	
		$pro_price = "select * from products where product_id ='$pro_id' ";
		$run_pro_price = mysqli_query($con,$pro_price);
		while($pp_price = mysqli_fetch_array($run_pro_price)){ 
			    $product_price = array($pp_price['product_price']);
				$totalcart= array_sum($product_price);
				$total +=$totalcart;	
			}	
	}//close of while
echo "Rs. ".$total;//display total cart

}




//getting the categories
function getCats(){
	global $con;
	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con,$get_cats);
	while ($row_cats=mysqli_fetch_array($run_cats)) {
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		
		echo "<li><a href ='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}

//getting the brands
function getBrands(){
	global $con;
	$get_brands = "select * from brands";
	$run_brands = mysqli_query($con,$get_brands);
	while ($row_brands=mysqli_fetch_array($run_brands)) {
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];
		

		echo "<li><a href ='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}//close of mothod getBrands()

function getPro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){


		global $con;
		$get_pro = "select * from products order by RAND() LIMIT 0,6";
		$run_pro = mysqli_query($con,$get_pro);
			while($row_pro = mysqli_fetch_array($run_pro)){

			$pro_id = $row_pro['product_id'];
			$pro_cat = $row_pro['product_cat'];
			$pro_brand = $row_pro['product_brand'];
			$pro_title = $row_pro['product_title'];
			$pro_price = $row_pro['product_price'];
			$pro_image = $row_pro['product_image'];

			echo"
				<div id='single_product'>
					<h3>$pro_title</h3>
					<img src ='admin_area/product_images/$pro_image' width='200px' height='200px'/>
				<p><b>Rs. $pro_price</b></p>

				<a href='details.php?pro_id=$pro_id'style='float:left;'>Details</a>
				
				<a href='index.php?id=$pro_id'>Add to cart</a>
			</div>	

			";
			}

		}//close of $_GET['brand']
	}//close of $_GET['cat']
}//close of getPro()


function getCatPro(){

	if(isset($_GET['cat'])){
		$cat_id = $_GET['cat'];


		global $con;
		$get_cat_pro = "select * from products where product_cat='$cat_id' ";
		$run_cat_pro = mysqli_query($con,$get_cat_pro);
		$count_cats = mysqli_num_rows($run_cat_pro);

		if($count_cats==0){
			echo"<h2 style='padding:20px'>There is no product in this categories</h2>";
			exit();
		}

			while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){

			$pro_id = $row_cat_pro['product_id'];
			$pro_cat = $row_cat_pro['product_cat'];
			$pro_brand = $row_cat_pro['product_brand'];
			$pro_title = $row_cat_pro['product_title'];
			$pro_price = $row_cat_pro['product_price'];
			$pro_image = $row_cat_pro['product_image'];

		

			echo"
				<div id='single_product'>
					<h3>$pro_title</h3>
					<img src ='admin_area/product_images/$pro_image' width='200px' height='200px'/>
				<p><b>Rs. $pro_price</b></p>

				<a href='details.php?pro_id=$pro_id'style='float:left;'>Details</a>
				<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
			</div>	
			";
			}
		
	}//close of $_GET['cat']
}//close of getPro()

function getBrandPro(){

	if(isset($_GET['brand'])){
		$brand_id = $_GET['brand'];


		global $con;
		$get_brand_pro = "select * from products where product_brand='$brand_id' ";
		$run_brand_pro = mysqli_query($con,$get_brand_pro);
		$count_brands = mysqli_num_rows($run_brand_pro);

		if($count_brands==0){
			echo"<h2 style='padding:20px'>No products where found associated with to this brand!!</h2>";
			exit();
		}

			while($row_brand_pro = mysqli_fetch_array($run_brand_pro)){

			$pro_id = $row_brand_pro['product_id'];
			$pro_cat = $row_brand_pro['product_cat'];
			$pro_brand = $row_brand_pro['product_brand'];
			$pro_title = $row_brand_pro['product_title'];
			$pro_price = $row_brand_pro['product_price'];
			$pro_image = $row_brand_pro['product_image'];

		

			echo"
				<div id='single_product'>
					<h3>$pro_title</h3>
					<img src ='admin_area/product_images/$pro_image' width='200px' height='200px'/>
				<p><b>Rs. $pro_price</b></p>

				<a href='details.php?pro_id=$pro_id'style='float:left;'>Details</a>
				<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
			</div>	
			";
			}
		
	}//close of $_GET['cat']
}//close of getPro()



?>