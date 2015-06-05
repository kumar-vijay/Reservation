<div id="content">
    <div class="login-box">
        <h1>Change Your Password</h1>
        <form method="post" action="/user/changePassword" name="userchangepassword" id="userchangepassword" class="login-form"> 
            <input type="password"  id="oldpassword" name="oldpassword" placeholder="Enter Existing Password"/>
            <input type="password"  id="newpassword" name="newpassword" placeholder="New password"/>
            <input type="password"  id="repeatnewpassword" name="repeatnewpassword" placeholder="Confirm New Password"/>
            <div class="btns">
                <input type="submit" value="Submit" class="btn" onsubmit="submitForm()"/>
                <input type="reset" value="Cancel" onclick="location.href = '/user/home';" class="btn" />
            </div>
            <div class="login-error clear"><?php echo $errorArr?></div>
        </form>
    </div>
</div>
<!-- Container Ends -->

