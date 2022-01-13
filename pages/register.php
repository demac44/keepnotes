<?php     
    $conn = new PDO("mysql:host=localhost;dbname=keepnotes", "root");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{} 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $new_user = $conn->prepare("INSERT INTO users (username, pass) VALUES (?, ?)");


    if(!empty($_POST)){
        $username = $_POST['username'];
        $c_pass = $_POST['confirm_pass'];
        $pass = $_POST['password'];

        if(strlen($username)<5 || strlen($username)>20){
            $error = "Username must be between 5 and 20 characters long!";
        }
        elseif(!ctype_alnum($username)){
            $error = "Username can contain only letters and numbers!";
        }
        elseif(str_contains($username, " ")){
            $error = "Username cannot contain empty space!";
        }
        elseif(strlen($pass)<8 && strlen($pass)>30){
            $error = "Password must be between 8 and 30 characters long!";
        }
        elseif($pass !== $c_pass){
            $error = "Passwords must match!";
        }
        elseif(str_contains($pass, " ")){
            $error= "Password cannot contain empty space!";
        }
        else {
            $new_user->bindParam(1, $username, PDO::PARAM_STR);
            $new_user->bindParam(2, $pass, PDO::PARAM_STR);
            $new_user->execute();
            header("Location: login.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/entry.css">
    <title>Register</title>
</head>
<body>
    <div class='navbar'>    
        <h1>KeepNotes</h1>
        <a href='login.php' class='entry-btn'>
            <p>Login</p>
        </a>     
    </div>
    <div class='login-container'>
        <div class='login-box'>
            <div class='dot'></div>
            <div class='login-title'><h1>Register</h1></div>
            <?php 
                if(!empty($error)) echo '<p class="error-msg">'.$error."</p>";
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>
                <input type='text' name='username' placeholder='Username'/>
                <input type='password' name='password' placeholder='Password'/>
                <input type='password' name='confirm_pass' placeholder='Confirm password'/>
                <button type='submit'>REGISTER</button>
            </form>
            <p>Already have an account? <a href='login.php'>Login</a></p>
        </div>
    </div>
</body>
</html>