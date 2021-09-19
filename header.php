<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RRC Apparel</title>
        <link rel="stylesheet" href="Css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/-->
        
    </head>
    <body>
        <nav>
            <a href="index.php" class="logo"><img src="Images/logo.png"></a>
            <ul id="MenuItems">
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="contactus.php">About Us</a></li>
            <?php
                if (isset($_SESSION["usersUsername"])){
                    echo "<li><a href='account1.php'>Account</a></li>";
                    //echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
                    echo "<li><a onClick=\"javascript: return confirm('Please make sure your cart is empty. Do you want to proceed?');\" href='includes/logout.inc.php'>Logout</a></li>"; 
                }else{
                    echo "<li><a href='Signup.php'>Sign Up</a></li>";
                    echo "<li><a href='Login.php'>Log In</a></li>";
                }
            ?>
            </ul>

            <a href='cart1.php'><i class='fa fa-shopping-cart fa-2x' style="text-decoration: none;"></i></a>
            <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">           
        </nav>

        <script type="text/javascript">
           var MenuItems = document.getElementById("MenuItems");

           MenuItems.style.maxHeight = "0px";

           function menutoggle(){
               if(MenuItems.style.maxHeight == "0px"){
                   MenuItems.style.maxHeight = "500px"
               }
               else{
                MenuItems.style.maxHeight = "0px";
               }
           }
       </script>

       