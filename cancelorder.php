<?php
    include_once 'header.php';
    include_once 'includes/connection.inc.php';//'includes/connection.inc.php';
    
    //session_start();
    
    print_r($_SESSION);
    if(!isset($_SESSION['usersUsername'])){
		echo "<script>
            alert('Please Login!')
            window.location.href = '/Login.php';
          </script>";
	}

    if(isset($_POST['submit'])){
        $oId = $_POST['orderid'];
        $reason = $_POST['reason'];
        $status = 'Cancellation Pending';

        $insertcancel = "INSERT INTO ordertracking (orderId, status, reason) VALUES ('$oId', '$status', '$reason')";
        $res = mysqli_query($conn, $insertcancel) or die("Bad Query: $insertcancel");
        if($res){
            $up_sql = "UPDATE orders SET orderstatus = '$status' WHERE Id = '$oId'";
            $updated = mysqli_query($conn, $up_sql) or die("Bad Query: $up_sql");
            //$row1 = mysqli_fetch_assoc($updated);
            
            $query1 = "SELECT * FROM ordereditems INNER JOIN details ON ordereditems.pId = details.pId WHERE ordereditems.orderId = '$oId'";
            $result1 = mysqli_query($conn, $query1) or die("Bad Query: $query1");
            while($row1 = mysqli_fetch_assoc($result1)){

                $sum = $row1['quantity'] + $row1['stock'];
                $prod_id = $row1['pId'];
                $upd_stock = "UPDATE details SET stock = '$sum' WHERE pId = '$prod_id'";
                $res = mysqli_query($conn, $upd_stock) or die("$upd_stock");
            }
            echo "<script>
            alert('Wait for the cancellation approval!')
            window.location.href = 'orders.php';
          </script>";
        }
    }

?>

<div class="container" style="margin-top: 150px;">
    <h2 class='text-center'><b>Items Ordered</b></h2>
        <section id="content">
				<div class="row">			 
					<div class="col-md-12">
                        <form action="" method="POST">
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
                                                    //$productsquery = "SELECT * FROM product1 WHERE Id = $pId";
                                                    $productsquery = "SELECT * FROM products INNER JOIN details ON products.Id = details.pId WHERE products.Id = $pId";
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
                            <label for="reason">Reason: </label>
                            <textarea name="reason" class="form-control mb-5" cols="30" rows="10" required></textarea>
                            <div class="row">
                                <input type="hidden" name="orderid" value="<?php echo $_GET['id'] ?>">
                                <input type="submit" name="submit" value="Cancel Order" class="btn btn-danger btn-lg mb-5">
                            </div>
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