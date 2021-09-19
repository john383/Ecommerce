<?php
  include_once 'header.php';
  include 'includes/controller.inc.php';

  if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $editinfo = true;
    $rec = mysqli_query($conn, "SELECT * FROM info WHERE id=$id");
    $record = mysqli_fetch_array($rec);
    $name = $record['fName'];
    $ph_number = $record['pNumber'];
    $iaddress = $record['uAddress'];
    $pos_code = $record['uPostal'];
    $id = $record['id'];
  }

?>
<div class="container-md" style="margin-top: 150px;">
  <?php if(isset($_SESSION['msg'])): ?>
    <div class="msg">
      <?php
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      ?>
    </div>
  <?php endif ?>
  <div class="table-responsive">
    <table class="table">
          <tr>
            <th width="25%">Name</th>
            <th width="15%">Phone</th>
            <th width="30%">Address</th>
            <th width="15%">Postal Code</th>
            <th width="5%" colspan="2">Action</th>
          </tr>
      <tbody>
        <?php 
          while ($row = mysqli_fetch_array($results)){ ?>
          <tr>
            <td><?php echo $row['fName']?></td>
            <td><?php echo $row['pNumber']?></td>
            <td><?php echo $row['uAddress']?></td>
            <td><?php echo $row['uPostal']?></td>
            <td>
              <a href="account.php?edit=<?php echo $row['id']; ?>"><button type="button" class="btn btn-success">Edit</button></a>
            </td>
            <td>
              <a href="includes/controller.inc.php?del=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
            </td>
          </tr>    
        <?php  }  ?>
      </tbody>
    </table>
  </div>
  <div class="row ">
    <div class="col-md-4 offset-md-4 form-div login">
      <form method="post" action="includes/controller.inc.php" class="row g-3">
        <h2 class="text-center mb-5"><b>Add a New Address</b></h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <div class="col-12">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
        </div>
        <div class="col-12">
          <label for="address" class="form-label">Address</label>
          <input type="text" name="address" class="form-control" value="<?php echo $iaddress; ?>" required>
        </div>
        <div class="col-md-6">
          <label for="ph_number" class="form-label">Phone</label>
          <input type="text" name="ph_number" class="form-control" value="<?php echo $ph_number; ?>" required>
        </div>
        <div class="col-md-6">
          <label for="pos_code" class="form-label">Postal Code</label>
          <input type="text" name="pos_code" class="form-control" value="<?php echo $pos_code; ?>" required>
        </div>
        <div class="d-grid gap-2 mt-2">
          <?php if($editinfo == false): ?>
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg mt-2">Save</button>
          <?php else: ?>
            <button type="submit" name="update" class="btn btn-primary btn-block btn-lg">Update</button>
          <?php endif ?>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
    include_once 'footer.php'
?>
