<?php     
    require '../inc/db.php';

    if(isset($_POST['login-username'])){
        $username = $_POST['login-username'];
        $pass = $_POST['login-password'];

        $find_user = "SELECT * FROM users WHERE username='$username'";
        $user = $conn->query($find_user);

        foreach($user as $u){
            if($u['pass']===$pass){
                setcookie("user-auth", $u['username'], time()+3600);
                header("Location: index.php");
            }
            else $error = 'Invalid username or password!';
        }

        $error = "Invalid username or password";
    }

?>