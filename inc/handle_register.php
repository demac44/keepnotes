<?php 
    require '../inc/db.php';

    $check_username = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $new_user = $conn->prepare("INSERT INTO users (username, pass) VALUES (?, ?)"); 

    if(isset($_POST['register-username'])){
        $username = $_POST['register-username'];
        $pass = $_POST['register-password'];
        $c_pass = $_POST['confirm_pass'];

        $username_exists = false;
        
        $check_username = $conn->query("SELECT username FROM users WHERE username = '$username'");

        foreach($check_username as $usr){
            if($usr['username']===$username){
                $username_exists=true;
            }
        }

        if($username_exists){
            $error = "Username already taken!";
        }
        elseif(strlen($username)<5 || strlen($username)>20){
            $error = "Username must be between 5 and 20 characters long!";
        }
        elseif(!ctype_alnum($username)){
            $error = "Username can contain only letters and numbers!";
            }
            elseif(strlen($pass)<8 || strlen($pass)>30){
                $error = "Password must be between 8 and 30 characters long!";
            }
            elseif(str_contains($pass, " ")){
                $error= "Password cannot contain empty space!";
            }
            elseif($pass !== $c_pass){
                $error = "Passwords must match!";
            }
            else {
                $new_user->bindParam(1, $username, PDO::PARAM_STR);
                $new_user->bindParam(2, $pass, PDO::PARAM_STR);
                $new_user->execute();
                header("Location: login.php");
            }
        }
    
    ?>