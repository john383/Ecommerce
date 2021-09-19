<?php
    include_once 'header.php';
    //session_start();

    include_once "includes/connection.inc.php"; 
    $sql = "SELECT * FROM products INNER JOIN details ON products.Id = details.pId WHERE details.Status='Available';";
    $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");

    /*pre_r($_SESSION);

    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }*/
?>
        <section class="banner">
            <h1>Welcome to RRC Apparel!</h1>
            <a href="product.php">Explore Now &#8594;</a>
        </section>    

<div class="container py-5">
    <!------ Latest products ------------>
    <h2 class="title"><b>Latest Products</b></h2>

        <div class="row mt-4">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php 
                    //$sql = "SELECT * FROM product1 ORDER BY Id DESC LIMIT 4;";
                    $sql = "SELECT * FROM products INNER JOIN details ON products.Id = details.pId WHERE details.Status='Available' ORDER BY products.Id DESC LIMIT 4;";
                    $res = mysqli_query($conn, $sql);
                    $checkresult = mysqli_num_rows($res)>0;
                        
                    if($checkresult){
                        while($row = mysqli_fetch_assoc($res)){
                ?>
                
                    <form class="form1" action="productdetails.php?ID=<?php $row['pId'] ?>">
                        <div class="cols-md-4 mt-3">
                            <div class="card">
                                <img src="Uploads/<?php echo $row['pImg']; ?>" width="100%" height="320px">

                                <div class="card-body">
                                    <a href="productdetails.php?ID=<?php echo $row['pId'] ?>" style="text-decoration: none;"><h5 class="card-title" style="cursor: pointer;"><b><?php echo $row['pName']; ?></b></h5></a>
                                    <p class="card-text">₱ <?php echo $row['pPrice']; ?></p>
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


    
      

       
   