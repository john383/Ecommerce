<?php
  include_once 'header.php';
  //session_start();
  include 'includes/connection.inc.php';

	if(!isset($_SESSION['usersUsername'])){
		echo "<script>
            alert('Please Login!')
            window.location.href = 'Login.php';
          </script>";
	}
  /*echo '<pre>';
print_r($_SESSION['usersId']);
echo '</pre>';*/
    $id = print_r($_SESSION['usersId'], TRUE);

    if(isset($_POST["submit"])){
      $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
      $pwd = mysqli_real_escape_string($conn, ($_POST["pwd"]));
      $cpwd = mysqli_real_escape_string($conn, ($_POST["cpwd"]));

      if($pwd == $cpwd){
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "UPDATE userdata SET usersName = '$fname', usersPwd = '$hashedPwd' WHERE usersId = $id ";
        $result = mysqli_query($conn, $sql);
        
        if($result){
          echo "<script>alert('Profile Updated Successfully')</script>";
        }else{
          echo "<script>alert('Update Failed')</script>";
        }
      }else{
        echo "<script>alert('Password not matched. Please try again')</script>";
      }
    }
?>

<div class="container-md" >
  <div class="row ">
    <div class="col-md-4 offset-md-4 form-div login">
      <form method="post" action="account1.php" class="row g-3">
      <h2 class="text-center mb-5"><b>User Profile</b></h2>
        <?php
          //sql = "SELECT * FROM userdata WHERE usersId=$id;";
          $sql = "SELECT * FROM userdata WHERE usersId=$id;";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
        ?>
          <div class="col-md-6">
              <label for="name" class="form-label">First Name</label>
              <input type="text" name="fname" class="form-control" value="<?php echo $row['first_name']; ?>" readonly>
          </div>
          <div class="col-md-6">
              <label for="lname" class="form-label">Last Name</label>
              <input type="text" name="lname" class="form-control" value="<?php echo $row['last_name']; ?>" readonly>
          </div>
          <div class="col-12">
              <label for="addrss" class="form-label">Address</label>
              <input type="text" name="addrss" class="form-control" value="<?php echo $row['userAddress']; ?>" required>
          </div>
          <div class="col-md-6">
              <label for="pNum" class="form-label">Phone Number</label>
              <input type="text" name="pNum" class="form-control" value="<?php echo $row['pNumber']; ?>" required>
          </div>
          <div class="col-md-6">
              <label for="postal" class="form-label">Postal</label>
              <input type="text" name="postal" class="form-control" value="<?php echo $row['postal_c']; ?>" required>
          </div>
          <div class="col-md-6">
              <label for="uname" class="form-label">Username</label>
              <input type="text" name="uname" class="form-control" value="<?php echo $row['usersUsername']; ?>" disabled required>
          </div>
          <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <input type="text" name="gender" class="form-control" value="<?php echo $row['gender']; ?>" disabled required>
          </div>
          <div class="col-12">
              <label for="email" class="form-label">Email Address</label>
              <input type="text" name="email" class="form-control" value="<?php echo $row['usersEmail']; ?>" disabled required>
          </div>
          <div class="col-md-6">
              <label for="pwd" class="form-label">Password</label>
              <input type="password" name="pwd" class="form-control" value="<?php echo $row['usersPwd']; ?>" required>
          </div>
          <div class="col-md-6">
              <label for="cpwd" class="form-label">Confirm Password</label>
              <input type="password" name="cpwd" class="form-control" value="<?php echo $row['usersPwd']; ?>" required>
          </div>
        <?php 
            }
          }
        ?>
        <div class="d-grid gap-2 mt-2">
                <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg mt-2">Update Profile</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
    include_once 'footer.php'
?>
