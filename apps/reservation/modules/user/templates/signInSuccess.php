 <div id="content">
     <div class="login-box">
         <h1>Welcome to Submission System</h1>
         <h2>Please Login</h2>
        <form name="login" action="/user/SignIn" method="post" id="login" class="login-form">
            <input type="text" id="userName" name="userEmail" tabindex="1"  placeholder="Username"/>
            <input type="password" id="userPass" name="userPass" tabindex="2" placeholder="Password" />
            <input type="submit" id="login" name="login" value="LOGIN" class="btn" tabindex="3" />
            <a href="/user/forgotPassword" tabindex="4">Forgot your password?</a>
            <div class="login-error clear"><?php echo $errorMsg?></div>
        </form>
    </div>
</div>
<!-- Content Ends -->
