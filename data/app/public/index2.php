<!DOCTYPE html>
<html lang="en" ng-app="bda">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>BDA SURVEYS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
   
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/api.js"></script>



</head>
<body>
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container" ng-controller="authCtrl">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="images/bda.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <div ng-show="!isforget">
             <form class="form-signin" name="login_form" novalidate>
             	<h3 align="center">Login</h3>
                <input type="text" id="username" name="username" ng-model="user.username" class="form-control awsome-input" placeholder="Username"  autofocus required>
                <div class="m-t-xs" ng-show="login_form.username.$invalid && login_form.username.$dirty ">
                	<small class="text-danger" ng-show="login_form.username.$error.required">Username is required!</small>                  
                </div>

                <input type="password" id="Password" name="password" ng-model="user.password" class="form-control awsome-input" placeholder="Password" required>
                <div class="m-t-xs" ng-show="login_form.password.$invalid && login_form.password.$dirty ">
                	<small class="text-danger" ng-show="login_form.password.$error.required">Password is required!</small>             
                </div>

                
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" ng-disabled="login_form.$invalid" ng-click="signin()">Log In</button>
             </form>
             <a  ng-click="isforget = !isforget" class="forgot-password">
                Forget password?
             </a>
            </div>
            <div ng-show="isforget">
             <form class="form-signin" name="forget_form" novalidate>
                <h3 align="center">Forget password</h3>
                <input type="email" id="userEmail" name="email" ng-model="email" class="form-control awsome-input" placeholder="Email"  autofocus required>
                <div class="m-t-xs" ng-show="forget_form.email.$invalid && forget_form.email.$dirty ">
                	<small class="text-danger" ng-show="forget_form.email.$error.required">Email is required!</small>   
                	<small class="text-danger" ng-show="forget_form.email.$error">Email is not valid</small>               
                </div>

                
                
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" ng-disabled="forget_form.$invalid" ng-click="getNewPassword()">SEND</button>
             </form>
            </div>
            
        </div><!-- /card-container -->
    </div><!-- /container -->




<script src="js/angular.min.js"></script>
<script src="angular_app/app.js"></script>
<script src="angular_app/controllers/authCtrl.js"></script>


</body>
</html>
