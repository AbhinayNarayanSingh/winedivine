<?php
    include "./header.php";
    // notAllowedIfSessionStart();

    successMsg('userregistered',"You are successfully registered!</br>plases sign in to access your account!"); 
    errorMsg('invalid',"Invalid Login Credentials"); 
 ?>

    <div class="sign" id="signIn">
        <form action="./backend.php?signIn" class="signForm" method="POST">
        <p style="margin: 3rem 0 1rem; width: 400px; text-align: center; line-height: normal;">Sign In, Get access to your Orders, Wishlist and Recommendations</p>

            <label for="">Mobile / Email</label>
            <input type="text" name="userMobileEmail" id="">
            <label for="pwd">Password</label>
            <input type="password" name="userPassword" id="pwd">
            <button type="submit">Sign In</button>
            <p style="margin: 2rem 0;">Not have an account? <span  style="color: blue;" onclick="sign()">Sign up now</span></p>

        </form>
    </div>
    
    <div class="sign hide" id="signUp">
        <form action="./backend.php?signup" class="signForm" name="myForm" method="POST" onsubmit="return formValidation()">
        <p style="margin: 3rem 0 1rem;">Sign up now, It's free and takes minutes</p>
            <label for=""> Name</label>
            <input type="text" name="userName" id="">
            <label for=""> Email</label>
            <input type="email" name="userEmail" id="">
            <label for="">Mobile</label>
            <input type="text" name="userMobNo" id="">
            <label for="pwd">Password</label>
            <input type="password" name="userPassword" id="pwd">
            <label for="pwd">confirm Password</label>
            <input type="password" name="userPasswordConfirm" id="pwd1">
            <p class="validation hide" style="margin-top: 1rem; color: red;">Alert: <span class="validationMsg"></span></p>
            <button type="submit" name="signUp">Sign In</button>
            <p style="margin: 2rem 0;">Already have an account? <span style="color: blue;" onclick="sign()">Sign In now</span></p>
        </form>
    </div>

    


        <?php include "./footer.php"; ?>