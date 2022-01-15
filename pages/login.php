<?php require '../inc/handle_login.php' ?>


<?php include '../inc/header.php' ?>
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
                <input type='text' name='login-username' placeholder='Username'/>
                <input type='password' name='login-password' placeholder='Password'/>
                <button type='submit'>LOGIN</button>
            </form>
            <p>Don't have an account? <a href='register.php'>Register</a></p>
        </div>
    </div>
</body>
</html>