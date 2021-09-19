<?php
    include_once 'header.php';
?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div signup">           
                <form action="includes/Signup.inc.php" method="post" class="row g-3" enctype="multipart/form-data">
                    <h2 class="text-center mb-5"><b>Create Account</b></h2>
                        <?php
                            if(isset($_GET["error"])){
                                if($_GET["error"] == "emptyinput"){
                                    echo "<div class='alert alert-danger text-center'><p> Fill in all fields!</p></div>";
                                }
                                elseif ($_GET["error"] == "invalidusername") {
                                    echo "<div class='alert alert-danger text-center'><p> Choose a proper username!</p></div>";
                                }
                                elseif ($_GET["error"] == "invalidemail") {
                                    echo "<div class='alert alert-danger text-center'><p> Choose a proper email!</p></div>";
                                }
                                elseif ($_GET["error"] == "passwordsdontmatch") {
                                    echo "<div class='alert alert-danger text-center'><p> Password doesn't match!</p></div>";
                                }
                                elseif ($_GET["error"] == "stmtfailed") {
                                    echo "<div class='alert alert-danger text-center'><p> Something went wrong, please try again!</p></div>";
                                }
                                elseif ($_GET["error"] == "usernameoremailtaken") {
                                    echo "<div class='alert alert-danger text-center'><p> Username/Email already taken!</p></div>";
                                }
                                elseif ($_GET["error"] == "none") {
                                    echo "<div class='alert alert-success text-center'><p> You have signed up!</p></div>";
                                }
                            }
                        ?>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control form-control-lg">
                        </div>    
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control form-control-lg">
                        </div>     
                        <div class="col-12">
                            <label for="sh_addrss" class="form-label">Address</label>
                            <input type="text" name="sh_addrss" class="form-control form-control-lg">
                        </div>      
                        <div class="col-md-6">
                            <label for="phone_num" class="form-label">Phone Number</label>
                            <input type="text" name="phone_num" class="form-control form-control-lg">
                        </div>     
                        <div class="col-md-6">
                            <label for="postal" class="form-label">Postal Code</label>
                            <input type="text" name="postal" class="form-control form-control-lg">
                        </div>   
                        <div class="col-md-6">
                            <label for="uid" class="form-label">Username</label>
                            <input type="text" name="uid" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-select form-select-lg">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-6">
                            <label for="pwd" class="form-label">Password</label>
                            <input type="password" name="pwd" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-6">
                            <label for="pwdrepeat" class="form-label">Confirm Password</label>
                            <input type="password" name="pwdrepeat" class="form-control form-control-lg">
                        </div>
                        
                        <div class="d-grid gap-2 mt-2" >
                            <button class="btn btn-primary btn-block btn-lg" name="submit" type="submit">Sign Up</button>
                        </div>
                        <p class="text-center">Already a member? <a href="Login.php">Sign In</a></p>
                </form>
                

            </div>
        </div> 
    </div>       

    <script type="text/javascript">
        window.addEventListener("scroll", function(){
            var header = document.querySelector("nav");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>

    <?php
        include_once 'footer.php';
    ?>