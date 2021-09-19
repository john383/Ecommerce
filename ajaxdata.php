<?php
    include_once 'includes/connection.inc.php';
    if(isset($_POST['pId'])){
        $pId = $_POST['pId'];
        $sql = "SELECT * FROM details WHERE pId = '$pId'";
        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        if($result){
            echo $row['pName'];
        }
    }
