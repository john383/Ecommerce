<?php
    include_once 'header.php';
    //session_start();
    include '../includes/upload.inc.php';
    //include_once 'includes/connection.inc.php';

    if(!isset($_SESSION['usersUsername'])){
		echo "<script>
            alert('Please Login!')
            window.location.href = '../Login.php';
          </script>";
	}

    

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $editinfo = true;
        $rec = mysqli_query($conn, "SELECT * FROM products INNER JOIN details ON products.Id = details.pId WHERE products.Id = $id;");
        $record = mysqli_fetch_array($rec);
            /*echo '<pre>';
                print_r($record['pName']);
            echo '<pre>'; */
        $pname = print_r($record['pName'], TRUE); 
        $pdesc = print_r($record['pDesc'], TRUE); 
        $stock = print_r($record['stock'], TRUE);
        $size = print_r($record['pSize'], TRUE);  
        $price = print_r($record['pPrice'], TRUE); 
        $id = print_r($record['pId'], TRUE); 
      }
?>



<div class="container-fluid" style="margin-top: 150px; margin-bottom: 50px;">

    <div class="table-responsive">
            <table class="table">
                <tr>
                    <th width="10%">Products</th>
                    <th width="15%">Description</th>
                    <th width="10%">Price</th>
                    <th width="10%">Sizes</th>
                    <th width="5%">Stocks</th>
                    <th width="10%">Image 1</th>
                    <th width="10%">Image 2</th>
                    <th width="10%">Image 3</th>
                    <th width="10%">Image 4</th>
                    <th width="10%" colspan="2">Action</th>
                </tr>
                <tbody>
                    <?php 
                        //if(mysqli_num_rows($results) > 0){
                            while ($row = mysqli_fetch_array($results)){ 
                    ?>
                                <tr>
                                    <td><?php echo $row['pName']?></td>
                                    <td><?php echo $row['pDesc']?></td>
                                    <td><?php echo $row['pPrice']?></td>
                                    <td><?php echo $row['pSize']?></td>
                                    <td><?php echo $row['stock']?></td>
                                    <td><?php echo $row['pImg']?></td>
                                    <td><?php echo $row['pImg2']?></td>
                                    <td><?php echo $row['pImg3']?></td>
                                    <td><?php echo $row['pImg4']?></td>
                            
                                        <td>
                                            <a href="insert.php?edit=<?php echo $row['pId']; ?>"><button type="button" class="btn btn-success">Edit</button></a>
                                        </td>
                                        <td>
                                            <a href="includes/upload.inc.php?del=<?php echo $row['pId']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                        </td>

                                </tr>    
                    <?php  
                            }  
                        //}
                    ?>
                </tbody>
            </table>
    </div>

    <div class="row ">
        <div class="col-md-4 offset-md-4 form-div login">
            <form action="insert.php" method="POST" enctype="multipart/form-data">    
                <h1 class="text-center mb-5">Upload Product</h1>
                <div class="form-group">
                    <label>Product Name: </label>
                    <input type="text" name="pname" class="form-control form-control-lg" value="<?php echo $pname; ?>">
                </div>
                <div class="form-group">
                    <label>Product Description: </label>
                    <textarea name="prod_desc" rows="3" class="form-control form-control-lg"><?php echo $pdesc; ?></textarea>
                </div>
                <!--div class="form-group">
                
                </div-->
                <div class="row">
                    <div class="col-md-4">
                        <label>Size</label>
                        <select class="form-select form-select-lg mb-3" name="size" value="<?php echo $size; ?>">
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control form-control-lg" value="<?php echo $price; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Stocks</label>
                        <input type="text" name="stock" class="form-control form-control-lg" value="<?php echo $stock; ?>">
                    </div>    
                    
                </div>
                <div class="form-group">
                    <label>First Image</label>
                    <input type="file" name="img" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label>Second Image</label>
                    <input type="file" name="img2" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label>Third Image</label>
                    <input type="file" name="img3" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label>Fourth Image</label>
                    <input type="file" name="img4" class="form-control form-control-lg" required><br><br>
                </div>
                <div class="d-grid gap-2">
                    <!--button class="btn btn-primary btn-block btn-lg" name="submit" type="submit">Add Product</button-->
                    <?php if($editinfo == false): ?>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg mt-2">Save</button>
                    <?php else: ?>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">Add</button>
                        <button type="submit" name="update" class="btn btn-primary btn-block btn-lg">Update</button>
                    <?php endif ?>
                </div>
            </form>
        </div>
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
                }
                else{
                    MenuItems.style.maxHeight = "0px";
                }
            }
    </script>
