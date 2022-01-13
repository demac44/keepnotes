<?php     
    $conn = new PDO("mysql:host=localhost;dbname=keepnotes", "root");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{} 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    if(!empty($_POST)){
        $username = $_POST['username'];
        $pass = $_POST['password'];

        $find_user = "SELECT * FROM users WHERE username='$username'";
        $user = $conn->query($find_user);

        foreach($user as $u){
            if($u['pass']===$pass){
                setcookie("user-auth", $u['user_id'], time()+3600);
                header("Location: index.php");
            }
            else $error = 'Invalid username or password!';
        }

        $error = "Invalid username or password";
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
    <title>Login</title>
</head>
<body>
    <div class='navbar'>    
        <h1>KeepNotes</h1>
        <a href='register.php' class='entry-btn'>
            <p>Register</p>
        </a>     
    </div>
    <div class='login-container'>
        <div class='login-box'>
            <div class='dot'></div>
            <div class='login-title'><h1>Login</h1></div>
            <?php if(!empty($error)) echo '<p class="error-msg">'.$error."</p>"; ?>
            <form action="login.php" method='post'>
                <input type='text' name='username' placeholder='Username'/>
                <input type='password' name='password' placeholder='Password'/>
                <button type='submit'>LOGIN</button>
            </form>
            <p>Don't have an account? <a href='register.php'>Register</a></p>
        </div>
    </div>
</body>
</html>