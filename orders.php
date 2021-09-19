<?php
    include_once 'header.php';
    include_once 'includes/connection.inc.php';
    
    //session_start();
    
    print_r($_SESSION);
    if(!isset($_SESSION['usersUsername'])){
		echo "<script>
            alert('Please Login!')
            window.location.href = 'Login.php';
          </script>";
	}

?>

<div class="container mb-5" style="margin-top: 130px;">
    <h2 class='text-center mb-5'><b>Recent Orders</b></h2>
        <section id="content">
				<div class="row">			 
					<div class="col-md-12">
                        <form action="">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="20%" class="text-center">Order Id</th>  
                                    <!-- <th width="20%" class="text-start">Customer Details</th> -->
                                    <th width="20%" class="text-center">Order Date & Time Placed</th>         
                                    <th width="20%" class="text-center">Status</th>
                                    <th width="20%" class="text-center">Total</th>
                                    <th colspan='2' width="20" class="text-center">Action</th>
                                </tr>
                                <tbody>
                                    <?php
                                        $cId = $_SESSION['usersId'];

                                        $sql = "SELECT * FROM orders INNER JOIN customers ON orders.Id = customers.Id WHERE customers.userId = $cId ORDER BY orders.Id DESC";
                                        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
                                        
                                        while($row = mysqli_fetch_assoc($result)){      
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $row['Id']; ?></td>
                                            <!-- <td>
                                              <1?php echo $row['firstname']." ". $row['lastname']; ?><br>
                                              <1?php echo $row['email']; ?><br>
                                              <1?php echo $row['address1']; ?><br>
                                              <1?php echo $row['zip']; ?><br>
                                              <1?php echo $row['mobile']; ?>
                                            </td> -->
                                            <td class="text-center"><?php echo date("M d, Y h:i A", strtotime($row['timestamps'])); ?></td>
                                            <td class="text-center"><?php echo $row['orderstatus']; ?></td>
                                            <td class="text-end">₱ <?php echo number_format($row['totalprice'], 2); ?></td>
                                            <td class="text-center"><a href="vieworder.php?id=<?php echo $row['Id'] ?>" class="btn btn-success">View</a>
                                                                <?php if(($row["orderstatus"] != "Dispatched") && ($row["orderstatus"] != "Delivered") && ($row["orderstatus"] != "Cancellation Approved")){ ?>
                                                                    <a href="cancelorder.php?id=<?php echo $row['Id'] ?>" class="btn btn-danger">Cancel</a>
                                                                <?php }?>
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </form>		
					</div>
				</div>
	    </section>
              <!-- Modal>
      <div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title w-100 text-center" id="exampleModalLabel"><b>Login</b></h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div-->
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