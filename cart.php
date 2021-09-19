<?php
    session_start();
    $product_ids = array();
    //session_destroy();
    
    //Check if add to cart button has been submitted
    if(filter_input(INPUT_POST, 'add_to_cart')){
        if(isset($_SESSION['shopping_cart'])){

            //keep track of how many products are in the shopping cart
            $count = count($_SESSION['shopping_cart']);

            //create sequential array for matching array keys to product id's
            $product_ids = array_column($_SESSION['shopping_cart'], 'ID');
            //pre_r($product_ids);

            if(!in_array(filter_input(INPUT_GET, 'ID'), $product_ids)){
                $_SESSION['shopping_cart'][$count] = array
                (
                    'ID' => filter_input(INPUT_GET, 'ID'),
                    'name' => filter_input(INPUT_POST, 'name'),
                    'price' => filter_input(INPUT_POST, 'price'),
                    'quantity' => filter_input(INPUT_POST, 'quantity')
                );
            }else{ //product already exist, increase quantity
                //match array key to id of the product being added to the cart
                for($i = 0; $i < count($product_ids); $i++){
                   if($product_ids[$i] == filter_input(INPUT_GET, 'ID')){
                       //add item quantity to the existing product in the array
                       $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                   } 
                }
            }

    }else{ //if shopping cart doesn't exist, create first product with array key 0
        //creating array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'ID' => filter_input(INPUT_GET, 'ID'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
    }

    if(filter_input(INPUT_GET, 'action') == 'delete'){
        //loop through all products in the shopping cart until it matches with GET id variable
        foreach($_SESSION['shopping_cart'] as $key => $product){
            if($product['ID'] == filter_input(INPUT_GET, 'ID')){
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
        <title>Shopping Cart</title>
        <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="Css/cart.css">
    </head>
<body>

<div class="container">
    <h2 class='text-center text-white'>Cart</h2>

   <table class="table table-bordered bg-white">
       <tr>
           <th>Image</th>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Total</th>
           <th>Action</th>
       </tr>

        <?php
            $total = 0;
            foreach($cart as $key => $value){
                // echo $key ." : ". $value['quantity'] . "<br>";
                
                $sql = "SELECT * FROM products where product_id = $key";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result)
        ?>
            
            <tr>
                <td><img src="admin/<?php echo $row['thumb']?> " alt=""></td>
                <td><a href="single.php?id=<?php echo $row['product_id']?>"><?php echo $row['product_name']?></a></td>
                <td><?php echo $row['price']?> </td>
                <td><?php echo $value['quantity']?></td>
                <td><?php echo $row['price'] * $value['quantity'] ?> </td>
                <td>
                    <a href="cart.php?action=delete&ID=<?php echo $row['ID']; ?>">
                        <div class="btn btn-danger">Remove</div>
                    </a>
                </td>
            </tr>

        <?php

$total = $total +  ($row['price'] * $value['quantity']);
    }
    
    ?>
      
   </table>

   <div class="text-right">
    <!-- <button class="btn mr-3">Update Cart</button> -->

    <a class="btn" href='checkout.php'>Checkout</a>
</div>
<div class="card">
<div class="card-header">Total</div>
<div class="card-body">
Total Amount: INR <?php echo $total; ?>.00/-
</div>
</div>

</div>

</body>
</html>
<script type="text/javascript">
        document.querySelector(".minus-btn").setAttribute("enabled", "disabled")

        var counter;
        
        var price = document.getElementById("finalprice").innerText;
        
        function priceTotal(){
                var total = counter * price;
                document.getElementById("finalprice").innerText = total;
            }
        
        document.querySelector(".plus-btn").addEventListener("click", function(){
            counter = document.getElementById("quantity").value
            counter++;
            
            document.getElementById("quantity").value = counter 
            if(counter > 1)
            {
                document.querySelector(".minus-btn").removeAttribute("disabled")
                document.querySelector(".minus-btn").classList.remove("disabled")
            }

            priceTotal()
            })
        document.querySelector(".minus-btn").addEventListener("click", function(){
            counter = document.getElementById("quantity").value
            counter--;
            
            document.getElementById("quantity").value = counter

            if(counter == 1)
            {
                document.querySelector(".minus-btn").setAttribute("disabled", "disabled")
            }

            priceTotal()
            })
    </script>