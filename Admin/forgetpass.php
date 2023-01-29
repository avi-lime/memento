<!DOCTYPE html>
<html lang="en">
<?php
    include "conn.php";
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register</title>
</head>

<body class="login_body">
    <form action="" method="post" class="login_form">
        <div class="login_title">
            <h2>ECOM</h2>
        </div>
        <div class="form_group">
            <label for="email">Email</label>
            <input class="form_input" type="email" name="email" id="email" required autocomplete="email">
            <span class="underline-animation"></span>
        </div>
        <div class="form_group">
            <label for="password">Enter new Password</label>
            <input class="form_input" type="password" name="password" id="password"  required>
            <span class="underline-animation"></span>
        </div>
        <div class="form_group">
            <label for="email">Confirm Password</label>
            <input class="form_input" type="password" name="confirmpassword" id="confirmpassword" required>
            <span class="underline-animation"></span>
        </div>
        <div class="form_group">
            <button class="login_btn" id="btn" name="btn" type="submit">Next <i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div class="form_group account">
            <span>Just remember your password!!!! <a href="register.php">Sign in</a></span>
        </div>
    </form>
</body>
<?php
if(isset($_REQUEST['btn'])){
    $email=$_REQUEST['email'];
    $password=$_REQUEST['password'];
    $conpassword=$_REQUEST['confirmpassword'];
    $query="SELECT * FROM tbladmin WHERE username='$email'";
    mysqli_query($conn,$query) or die(mysqli_error($conn));
    $result=mysqli_query($conn,$query);
    if($password!=$conpassword){
        echo"<script>
        alert('KUCh nahi hota');
        </script>";
    }else if($result->num_rows >0){
        $insertquery="UPDATE tbladmin SET pass ='$password' WHERE username='$email' ";
        mysqli_query($conn,$insertquery) or die (mysqli_error($conn));
        echo"<script>alert('Password Change successfully!!!!>_<')
        window.location.replace('login.php')</script>";
    }else{
        echo"<script>alert('Company does not exists!!!!!')</script>";
    }
}
?>
</html>