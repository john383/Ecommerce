<?php
        if(isset($_GET['ID'])){
            include_once 'includes/connection.inc.php';
            $ID = mysqli_real_escape_string($conn, $_GET['ID']);
    
            //$sql = "SELECT * FROM product1 WHERE Id='$ID'";
            $sql = "SELECT * FROM products INNER JOIN details ON products.Id = details.pId WHERE details.pId = '$ID';";
            $res = mysqli_query($conn, $sql) or die("Bad Query: $sql");
            $row = mysqli_fetch_array($res);
        }

    include_once 'header.php';
        //session_start();
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
                    'size' => filter_input(INPUT_POST, 'size'),
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
            echo '<script>alert("Added to Cart Successfully!")</script>';
        }else{ //if shopping cart doesn't exist, create first product with array key 0
            //creating array using submitted form data, start from key 0 and fill it with values
            $_SESSION['shopping_cart'][0] = array
            (
                'ID' => filter_input(INPUT_GET, 'ID'),
                'name' => filter_input(INPUT_POST, 'name'),
                'size' => filter_input(INPUT_POST, 'size'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );
            echo '<script>alert("Added to Cart Successfully!")</script>';
        }
    }
    
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

?>

<!----------------product details--------------->
    <div class="small-container single-product">
        <a href="product.php" class="btn btn-secondary mt-2" style="margin-left: 7px;">Back</a>
        <div class="row">
        
            <div class="col-2">
                <div class="main_image">
                    <img src="Uploads/<?php echo $row['pImg']?>" width="100%" height="500px" id="product-img">
                </div>
                <!-- <div class="small-img-row mt-2">
                    <div class="small-img-col">
                        <img src="Uploads/<1?php echo $row['pImg']?>" width="100%" height="150px" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="Uploads/<1?php echo $row['pImg2']?>" width="100%" height="150px" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="Uploads/<1?php echo $row['pImg3']?>" width="100%" height="150px" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="Uploads/<1?php echo $row['pImg4']?>" width="100%" height="150px" class="small-img">
                    </div>
                </div> -->
            </div>
                
            <div class="col-2">
                <div class="container1">
                
                    <form method="POST" action="productdetails.php?action=add&ID=<?php echo $row['pId'];?>" class="form2">
                        <h1 id="productname"><?php echo $row['pName']; ?></h1>
                        <p class="total-price">
                            ₱ 
                            <span id="price"><?php echo number_format($row['pPrice'], 2); ?></span>
                        </p>
                        <input type="text" name="size" id="size" class="form-control-lg" style="width: 80px; cursor: pointer;" value="<?php echo $row['pSize']; ?>" readonly>
                        <div class="quantity">
                            <!--button class="btn minus-btn disabled" type="button"><b>-</b></button-->
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $row['stock'];?>">
                            <!--button class="btn plus-btn" type="button"><b>+</b></button--><h5 style="margin-top: 10px; margin-left: 10px"> <?php echo $row['stock'];?> Piece Available</h5>
                        </div>
                        <input type="hidden" name="name" value="<?php echo $row['pName'];?>" />
                        <input type="hidden" name="price" id="price" value="<?php echo $row['pPrice'];?>" />
                        <input type="submit" name="add_to_cart" class="btn btn-primary btn-lg mt-2" value="Add to Cart" style="margin-top: 5px;" />
                        <!--button type="submit" name="add_to_cart" class="btn btn-outline-secondary btn-lg mt-2">Add to Cart</button-->
                    </form>
                    <h3>Details</h3>
                    <p><?php echo $row['pDesc']; ?></p>
                </div>
            </div>
        </div>   
    </div>
    <!--div class="small-container">
        <div class="row row-2">
            <h2>Related Products</h2>
            <a href="product.php">View More</a>
        </div>

    </div>
    <---- featured products >

    <div class="small-container">
        <div class="row">
                <-?php 
                    $sql = "SELECT * FROM product;";
                    $res = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($res)>0){
                        while($row = mysqli_fetch_array($res)){
                          ?>
                          <form class="form1" action="productdetails.php?ID=<-?php $row['pId'] ?>">
                            <div class="col-4">

                            <img src="Uploads/<-?php echo $row['pImg']; ?>">
                            <div class="middle" >
                            <-?php echo "<a href='productdetails.php?ID={$row['pId']}'>View</a>"?>
                            </div>
                            <h4><-?php echo $row['pName']; ?></h4>
                            <p>₱<-?php echo $row['pPrice']; ?></p>
                            </form>
                            </div>
                          <-?php  
                        }
                    }
                ?>
        </div>
    </div-->

<?php
    include_once 'footer.php';
?>

    <script type="text/javascript">
        window.addEventListener("scroll", function(){
            var header = document.querySelector("nav");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <!----------------JS for Product Gallery---------------->
    <script type="text/javascript">
        var productimg = document.getElementById("product-img")
        var smallimg = document.getElementsByClassName("small-img")

        smallimg[0].onclick = function(){
            productimg.src = smallimg[0].src
        }
        smallimg[1].onclick = function(){
            productimg.src = smallimg[1].src
        }
        smallimg[2].onclick = function(){
            productimg.src = smallimg[2].src
        }
        smallimg[3].onclick = function(){
            productimg.src = smallimg[3].src
        }
    </script>

    <script>
    function alrtmsg(){
        alert ('Successfully Added to Cart');
    }
    </script>

    <!--script type="text/javascript">
        document.querySelector(".minus-btn").setAttribute("enabled", "disabled")

        document.querySelector(".plus-btn").addEventListener("click", function(){
            counter = document.getElementById("quantity").value
            counter++;
            
            document.getElementById("quantity").value = counter 
            if(counter > 1){
                document.querySelector(".minus-btn").removeAttribute("disabled")
                document.querySelector(".minus-btn").classList.remove("disabled")
            }
        })
        document.querySelector(".minus-btn").addEventListener("click", function(){
            counter = document.getElementById("quantity").value
            counter--;
            
            document.getElementById("quantity").value = counter

            if(counter == 1)
            {
                document.querySelector(".minus-btn").setAttribute("disabled", "disabled")
            }
        })
    </script> 
    <script>
        function Fetchstate(ID){
            $.ajax({
                type: 'post',
                url: 'ajaxdata.php',
                data: { pId : ID},
                success: function(data){
                    $('#productname').html(data);
                    $('#price').html(data);
                }
            })
        }
    </script-->
