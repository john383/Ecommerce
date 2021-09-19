<?php
    include_once 'header.php';
    include 'includes/connection.inc.php';

    if(isset($_POST["submit"])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $uId = $_SESSION['usersId'];
    
        $query = "INSERT INTO feedback(userId, fname, email, subject, message) VALUES('$uId', '$name', '$email', '$subject', '$message')";
        $result = mysqli_query($conn, $query) or die ("Bad Query: $query");
    
        if($result){
            echo "<script>
            alert('Feedback Successfully Sent')
            window.location.href = 'index.php';
          </script>";
        }
    
    }
?>
    <div class="container-fluid" style="margin-top: 130px;">
        <h1 class="heading text-center">Our Team</h1>

        <div class="profiles">
            <div class="profile">
                <img src="Images/Ryan.jpg" alt="Image 1" class="profile-img">

                <h3 class="user-name text-center">Francis Ryan Pepito</h3>
                <h5 class="text-center">Developer</h5>
                <p class="text-center">rypepito30@gmail.com</p>
            </div>
            <div class="profile">
                <img src="Images/Christian.jpg" alt="Image 2" class="profile-img">

                <h3 class="user-name text-center">John Christian Rivera</h3>
                <h5 class="text-center">Developer</h5>
                <p class="text-center">jcrivera@lccl.ph.education</p>
            </div>
            <div class="profile">
                <img src="Images/Reymark.jpg" alt="Image 3" class="profile-img">

                <h3 class="user-name text-center">Reymark Gungob</h3>
                <h5 class="text-center">Developer</h5>
                <p class="text-center">rgungob@lccl.ph.education</p>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-4 offset-md-4 form-div mt-5">
                <form action="contactus.php" method="post">
                    <h2 class="text-center mb-5"><b>Send Feedback</b></h2>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea type="text" name="message" class="form-control form-control-lg"></textarea>
                    </div>
                    <div class="d-grid gap-2 mt-2" >
                        <button class="btn btn-primary btn-block btn-lg" name="submit" type="submit">Send Mail</button>
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
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>