<?php
include('login.php'); 
$log=new login();
$log->login();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="headcss.css">
    <style>
      .nav {
    width: 100%;
    height: 70px;
    background-color: black;
    color: aliceblue;
    padding: 20px;
    font-size: 30px; 
    font-weight: bold;
    padding-left: 50px;
}

</style>
</head>
  <body>
    <div class="nav">
      Pixer
    </div>
    <div class="innercontainer">
    <div class="content" >
      <p>Welcome to Pixer <p>
      <h1>A place that puts a world of possibilities at a single place,</h1>
      <h2>where you can upload and view 1000 of pictures</h2>
    </div>

    <div class="form" >
    <form method="post" enctype ="multipart/form-data"> 
    
        <h1>LOGIN</h1>
        <h3>Add a Profile Picure</h3>
        <input type="file" name="file"/>

        <input type="text" name="username" placeholder="Username"/>
        <input type="password" name="password" maxlength="10" placeholder="Password"/>
        <input type="email" name="email" placeholder="E-mail Address">
        <input type="text" maxlength="10" id="phonenumber" name="phone"  placeholder="Phone Number"/>
        
  
        <button type="submit" value="login" name="login">Login</button>
        <a href="signin.php">Already have an account? Sign in</a>

    </form>
    </div>
    </div>
  </body>
</html>