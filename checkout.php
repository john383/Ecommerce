<?php
    include_once 'header.php';
	//session_start();
    include_once 'includes/connection.inc.php';
	//include_once 'includes/checkout.inc.php';

	if(!isset($_SESSION['usersUsername'])){
		echo "<script>
		alert('Please Login!')
		window.location.href = 'Login.php';
	  </script>";
	}
	//pre_r($_SESSION);
	$cId = print_r($_SESSION['usersId'], TRUE);
	function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '<pre>';
	}
	
	//echo $_SESSION['shopping_cart'][1]['ID'];
	/*foreach($_SESSION['shopping_cart'] as $item) {
		$id = $item['ID'];
		$quantity = $item['price'];*/
		//$price 
		
		if(isset($_SESSION['shopping_cart'])){
			$total = 0;
			foreach($_SESSION['shopping_cart'] as $item){
				$id = $item['ID'];
				$quantity = $item['quantity'];

				//$sql_cart = "SELECT * FROM product1 where Id = $id";
				$sql_cart = "SELECT * FROM products INNER JOIN details ON products.Id = details.Id WHERE products.Id = $id";
				$result_cart = mysqli_query($conn, $sql_cart);
				$row = mysqli_fetch_assoc($result_cart);
				$total = $total +  ($row['pPrice'] * $quantity);

			}
		}

?>
<form method="POST" action="includes/checkout.inc.php">
	<div class="container">
		<section id="content" style="margin-top: 100px;">
			<div class="content-blog">
				<div class="page_header text-center text-dark py-5">
					<h2><b>Checkout</b></h2>
				</div>
					<div class="col">
						<div class="billing-details">
							<h3 class="uppercase text-center"><b>Shipping Address</b></h3>
							<?php
								$sql = "SELECT * FROM userdata WHERE usersId = '$cId'";
								$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");

								$row1 = mysqli_fetch_assoc($result);
							?>
								<div class="row">
									<div class="col-md-6">
										<label>First Name </label>
										<input class="form-control form-control-lg" name="fname"  type="text" value="<?php echo $row1['first_name']?>" readonly>
									</div>
									<div class="col-md-6">
										<label>Last Name </label>
										<input class="form-control form-control-lg" name="lname" type="text" value="<?php echo $row1['last_name']?>" readonly>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label>Email Address </label>
										<input class="form-control form-control-lg" name="email" type="email" value="<?php echo $row1['usersEmail']?>" readonly>
									</div>
									<div class="col-md-4">
										<label>Phone </label>
										<input class="form-control form-control-lg" name="Phone" id="billing_phone" type="text" value="<?php echo $row1['pNumber']?>" readonly>
									</div>
									<div class="col-md-2">
										<label>Postal Code </label>
										<input class="form-control form-control-lg" name='Postcode' type="text" value="<?php echo $row1['postal_c']?>" readonly>
									</div>
								</div>
								<div class="col-md-12">
									<label>Address </label>
									<input class="form-control form-control-lg" name="address"  type="text" value="<?php echo $row1['userAddress']?>" readonly>
								</div>
								
						</div>
					</div>	

				<h4 class="heading mt-5"><b>Your Order</b></h4>
				
				<table class="table table-bordered extra-padding bg-white text-dark">
					<tbody>
						<tr>
							<th>Cart Subtotal</th>
							<td><span class="amount">₱ <?php echo number_format($total, 2); ?></span></td>
						</tr>
						<tr>
							<th>Shipping and Handling</th>
							<td>
								Free Shipping				
							</td>
						</tr>
						<tr>
							<th>Order Total</th>
							<td><span class="amount"><b>₱ <?php echo number_format($total, 2); ?></b></span></td>
						</tr>
					</tbody>
				</table>

				<h4 class="heading mt-5"><b>Payment Method</b></h4>
				
				<div class="payment-method mt-5">
						<div class="row d-flex text-center">
								<div class="col-md-6">
									<input name="payment" id="radio2" value='COD' class="mr-2 css-checkbox" type="radio" required><span><b> Cash on Delivery</b></span>
								</div>
								<div class="col-md-6">
									<input name="payment" id="radio3" value='Paypal' class="mr-2 css-checkbox" type="radio" required><span><b> Paypal</b></span>
								</div>
						
						</div>
						<!--input name="agree" id="checkboxG2" type="checkbox" required><span> I've read and accept the <a href="#">terms &amp; conditions</a></span-->

				</div>
			</div>		 
			<div class="row">
				<div class="col-md-12 mb-5 mt-5 text-center">
					<input type="submit" class="btn btn-primary" name="submit" value="Place Order" />
				</div>
			</div>	
		</section>
	</div>
</form>

<?php
    include_once 'footer.php';
?>
    <script type="text/javascript">
        window.addEventListener("scroll", function(){
            var header = document.querySelector("nav");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>

    <script type="text/javascript">
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";

        function menutoggle(){
            if(MenuItems.style.maxHeight == "0px"){
               MenuItems.style.maxHeight = "500px"
            }else{
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>

