<?php
    include_once "includes/connection.inc.php"; 
    $sql = "SELECT * FROM products INNER JOIN details ON products.Id = details.pId;";
    $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");

    include_once 'header.php';
?>
<!------ All products ------------>  
 
<div class="container py-5">  
    <div class="row mt-4">
        <div class="row row-2" style="margin-top: 100px;">
            <h2 style="text-align: center;"><b>All Products</b></h2>
        </div>             
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php 
                //$sql = "SELECT * FROM product1 ORDER BY pName ASC;";
                $sql = "SELECT * FROM products INNER JOIN details ON products.Id = details.pId WHERE details.Status='Available' AND details.stock !='0' ORDER BY products.pName ASC;";
                $res = mysqli_query($conn, $sql);
                $checkresult = mysqli_num_rows($res)>0;
                        
                if($checkresult){
                    while($row = mysqli_fetch_assoc($res)){
            ?>
                <form class="form1" action="productdetails.php?ID=<?php $row['pId'] ?>">
                    <div class="cols-md-4">
                        <div class="card">
                            <img src="Uploads/<?php echo $row['pImg']; ?>" width="100%" height="320px">
                            <div class="card-body">
                            <a href="productdetails.php?ID=<?php echo $row['pId'] ?>" style="text-decoration: none;"><h5 class="card-title"><b><?php echo $row['pName']; ?></b></h5></a>
                                <p class="card-text">₱<?php echo $row['pPrice']; ?></p>
                                <?php echo "<a href='productdetails.php?ID={$row['pId']}' class='btn btn-primary'>View</a>"?>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
                    }
                }
            ?>
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


  