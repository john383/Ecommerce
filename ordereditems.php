<?php
    include_once 'header.php';
    include_once 'includes/connection.inc.php';
    
    //session_start();
    
    //print_r($_SESSION);
    if(!isset($_SESSION['usersUsername'])){
		echo "<script>
            alert('Please Login!')
            window.location.href = 'Login.php';
          </script>";
	}

?>

<div class="container" style="margin-top: 150px;">
    <h2 class='text-center'><b>Items Ordered</b></h2>
        <section id="content">
				<div class="row">			 
					<div class="col-md-12">
                        <form action="">
                            <table class="table mb-5">
                                <tr class="text-center">
                                    <th width="30%">Products</th>  
                                    <th width="30%">Quantity</th>         
                                    <th width="30%">Price</th>
                                    <th width="10%">Total</th>
                                </tr>
                                <tbody>
                                    <?php
                                        $cId = $_SESSION['usersId'];

                                        if(isset($_GET['id'])){
                                            $oId = $_GET['id'];
                                        }

                                        $ordrquery = "SELECT * FROM orders INNER JOIN customers ON orders.Id = customers.Id WHERE orders.Id = '$oId' AND customers.userId = $cId";
                                        $ord_result = mysqli_query($conn, $ordrquery) or die("Bad Query: $ordrquery");
                                        $ord_row = mysqli_fetch_assoc($ord_result);

                                        $sql = "SELECT * FROM ordereditems WHERE orderId = $oId";
                                        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
                                        
                                        while($row = mysqli_fetch_assoc($result)){ 
                                            $pId = $row['pId'];
                                    ?>
                                        <tr>

                                            <td>
                                                <?php
                                                    $productsquery = "SELECT * FROM product1 WHERE Id = $pId";
                                                    $pResult = mysqli_query($conn, $productsquery) or die("Bad Query: $productsquery") ;

                                                    $prod_row = mysqli_fetch_assoc($pResult);
                                                    ?>

                                                <a href="productdetails.php?ID=<?php echo $pId ?>" style="text-decoration: none;"><?php echo $prod_row['pName']; ?></a>
                                            </td>
                                            <td class="text-center"><?php echo $row['quantity']; ?></td>
                                            <td class="text-center">₱ <?php echo number_format($row['pPrice'], 2); ?></td>
                                            <td class="text-end">₱ <?php echo number_format($row['quantity'] * $row['pPrice'], 2); ?></td>
                                        </tr>
`
                                    <?php
                                        }
                                    ?>

                                </tbody>
                                <tfooter>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Total Price:</th>
                                            <th class="text-end">₱ <?php echo number_format($ord_row['totalprice'], 2); ?></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Order Status:</th>
                                            <th class="text-end"><?php echo $ord_row['orderstatus']; ?></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Date Placed:</th>
                                            <th class="text-end"><?php echo $ord_row['timestamps']; ?></th>
                                        </tr>
                                </tfooter>
                            </table>
                        </form>		
					</div>
				</div>
	    </section>
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