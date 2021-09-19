<?php
    session_start();

	if(!isset($_SESSION['usersUsername'])){
		echo "<script>
                alert('Please Login!')
                window.location.href = 'Login.php';
            </script>";
	}

    if(filter_input(INPUT_GET, 'action') == 'delete'){
        //loop through all products in the shopping cart until it matches with GET id variable
        foreach($_SESSION['shopping_cart'] as $key => $row){
            if($row['ID'] == filter_input(INPUT_GET, 'ID')){
                //remove product from shopping cart when it matches with the GET id
                unset($_SESSION['shopping_cart'][$key]);
            }
        }
        //reset session array keys so they match with $product_ids numeric array
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
    //pre_r($_SESSION);

    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RRC Apparel</title>
        <link rel="stylesheet" href="Css/cart.css">
        <link rel="stylesheet" href="Css/style.css">     
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    <body>
        <nav>
            <a href="index.php" class="logo"><img src="Images/logo.png"></a>
            <ul id="MenuItems">
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <li><a href="myaccount.php">Orders</a></li>
                <li><a href="contactus.php">About Us</a></li>
                <?php
                    if (isset($_SESSION["usersUsername"])){
                        echo "<li><a href='account1.php'>Account</a></li>";
                        echo "<li><a onClick=\"javascript: return confirm('Please make sure your cart is empty. Do you want to proceed?');\" href='includes/logout.inc.php'>Logout</a></li>"; 
                    }else{

                        echo "<li><a href='Signup.php'>Sign Up</a></li>";
                        echo "<li><a href='Login.php'>Log In</a></li>";
                    }
                ?>
            </ul>

            <a href='cart1.php'><i class='fa fa-shopping-cart fa-2x'></i></a>
            <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">           
        </nav>
<div class="container">
    <div class="table-responsive" style="margin-top: 180px; min-height: calc(100vh - 100px - 288px);">
    <h3 class="text-center mb-3"><b>Shopping Cart</b></h3>
        <table class="table table-bordered">
            <tr>
                <th width="30%" class="text-center">Product</th>
                <th width="10%" class="text-center">Quantity</th>
                <th width="20%" class="text-center">Price</th>
                <th width="25%" class="text-center">Total</th>
                <th width="5%" class="text-center">Action</th>
            </tr>
            <?php
                if(!empty($_SESSION['shopping_cart'])):
                    $total = 0; 
                    foreach($_SESSION['shopping_cart'] as $key => $row):
            ?>
            <tr>
                <td><a href="productdetails.php?ID=<?php echo $row['ID'] ?>" style="text-decoration: none;"><?php echo $row['name'] ." ". $row['size']; ?></a></td>
                <td class="text-center"><?php echo $row['quantity']; ?></td>
                <td class="text-end">₱ <?php echo number_format($row['price'], 2); ?></td>
                <td class="text-end">₱ <?php echo number_format($row['quantity'] * $row['price'], 2); ?></td>
                <td>
                    <a href="cart1.php?action=delete&ID=<?php echo $row['ID']; ?>">
                        <div class="btn btn-danger">Remove</div>
                    </a>
                </td>
            </tr>
            <?php
                $total = $total + ($row['quantity'] * $row['price']);
                    endforeach;
            ?>
            <tr>
                <td colspan="3" align="right">Total Amount: </td>
                <td align="right">₱ <?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
            <tr>
                    <!--Show checkout only if the shopping cart is not empty-->
                <td colspan="5">
                    <?php
                        if(isset($_SESSION['shopping_cart'])):
                            if(count($_SESSION['shopping_cart']) > 0):
                    ?>
                        <a href="checkout.php" class="button">Checkout</a>
                    <?php 
                            endif; 
                        endif; 
                    ?>
                    <a href="product.php" class="btn btn-primary">Continue Shopping</a>
                </td>
            </tr>
            <?php
                endif;
            ?>
        </table>
    </div>
</div>
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
    <script type="text/javascript">
        function alrtmsg(){
            alert ("Item Successfully Removed!");
        }
    </script>