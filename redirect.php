<?php
    session_start();
    $cId = "";
    $cId = print_r($_SESSION['usersId'], TRUE);
    //print_r($cId);
    if($cId == 1){
        echo "<script>   
            window.location.href = 'Admin/insert.php';
        </script>";
        exit;
    }else{
        echo "<script>   
            window.location.href = 'index.php';
        </script>";
        exit;
    }