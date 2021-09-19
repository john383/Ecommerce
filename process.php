<?php
    $servername = "localhost";
    $dbUsername = "root";
    $password = "";
    $dbname = "sample";

    $conn = mysqli_connect($servername, $dbUsername, $password, $dbname);

    if (isset($_POST['uname']) && isset($_POST['pass'])){
        
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $uname = validate($_POST['uname']);
        $pass = validate($_POST['pass']);

        if(empty($uname)){
            header("Location: login2.php?error=emptyusername");
            exit();
        }else if(empty($pass)){
            header("Location: login2.php?error=emptypassword");
            exit();
        }else{
            $sql = "SELECT * FROM sample1 WHERE username = '$uname' AND password = '$pass'";
            $results = mysqli_query($conn, $sql);
            if(mysqli_num_rows($results) === 1){
                $row = mysqli_fetch_assoc($results);
                if($row['username'] === $uname && $row['password'] === $pass){
                    echo "<h1><b>Welcome $uname!<b></h1>";
                }
                //print_r($row);
            }else{
                header("Location: login2.php?error=incorrectinput");
                exit();
            }
        }
    }else{
        header("Location: login2.php");
        exit();
    }
?>
