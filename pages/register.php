<?php require '../inc/handle_register.php' ?>

<?php include '../inc/header.php' ?>
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
                <input type='text' name='register-username' placeholder='Username'/>
                <input type='password' name='register-password' placeholder='Password'/>
                <input type='password' name='confirm_pass' placeholder='Confirm password'/>
                <button type='submit'>REGISTER</button>
            </form>
            <p>Already have an account? <a href='login.php'>Login</a></p>
        </div>
    </div>
</body>
</html>