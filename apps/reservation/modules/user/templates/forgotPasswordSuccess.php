<div id="content">
    <div class="login-box">
        <h1>Forgot Your Password?</h1>
        <div align="center" class="display-none" id="emailSent">
            <img src="/images/correct.png" height="50" width="50" alt="Password Reset" />
            <p>An email has been sent to your email ID.<br />Please follow the instructions given in the email.</p>
        </div>
        <form name="forgotPass" action="/user/forgotPassword" method="post" id="forgotPass" class="login-form">
            <input type="text" id="email" name="email" placeholder="Please enter your registered email id"/>
            <div class="btns">
            <input type="submit" id="getPassword" name="getPassword" value="Submit" class="btn" />
             <a href="/"><input type="button" value="Cancel" class="btn" /></a>
            </div>
            <div class="login-error clear display"><?php echo $errorMsg ?></div>
        </form>
    </div>
</div>
<!-- Content Ends -->


