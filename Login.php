<?php
    include_once 'header.php';
?>
    <div class="container-fluid" style="top: 130px; margin-bottom: 50px;">
        <div class="row ">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="includes/Login.inc.php" method="post" enctype="multipart/form-data">
                    <h2 class="text-center mb-5"><b>Login</b></h2>
                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "emptyinput"){
                                echo "<div class='alert alert-danger text-center'><p> Fill in all fields!</p></div>";
                            }else if ($_GET["error"] == "wronglogin") {
                                echo "<div class='alert alert-danger text-center'><p> Incorrect Information!</p></div>";
                            }      
                        }
                    ?>

                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" name="uid" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="pwd" class="form-control form-control-lg">
                    </div>
                    <div class="d-grid gap-2 mt-2" >
                        <button class="btn btn-primary btn-block btn-lg" name="submit" type="submit">Login</button>
                    </div>
                    <p class="text-center">Not yet a member? <a href="signup.php">Sign Up</a></p>
                    <p class="text-center"><a href="#">Forgot your password?</a></p>
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