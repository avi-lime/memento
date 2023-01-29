<!DOCTYPE html>
<?php 
    require_once "clearcache.php";
    session_start();
?>
<html lang="en">
<?php
    include "conn.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link href="img/icon.png" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="css/fontgoogle.css" rel="stylesheet"> 

<!-- Icon Font Stylesheet -->
<link href="css/all.min.css" rel="stylesheet">
<link href="css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../Admin/css/all.min.css" crossorigin>

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
</head>

<body class="login_body">
    <form action="" method="post" class="login_form">
        <div class="login_title">
            <h2>ECOM</h2>
        </div>
        <div class="form_group">
            <label for="username">Email</label>
            <input class="form_input" type="email" name="username" id="username" required autocomplete="username" autofocus>
            <span class="underline-animation"></span>
        </div>
        <div class="form_group">
            <label for="password">Password</label>
            <input class="form_input" type="password" name="password" id="password" required autocomplete="current-password">
            <div class="form_group account">
            <span style="text-align: right;" ><a href="forgetpass.php">Change password?</a></span>
            </div>
            <span class="underline-animation"></span>
        </div>
        <div class="form_group">
            <label id="invalidtxt" name="invalidtxt" ></label>
            <input class="login_btn" name="btnsignin" id="btnsignin" value="SIGN IN"type="submit"></button>
        </div>
        <div class="form_group account">
            <span>Don't have an account? <a href="register.php?">Sign up</a></span>
        </div>
    </form>
</body>
<?php
try{
if(isset($_REQUEST['btnsignin'])){
    $username=$_REQUEST['username'];
    $pass=$_REQUEST['password'];
    $result=mysqli_query($conn,"SELECT * FROM tbladmin WHERE username ='".$username."' AND pass ='".$pass."'");
    if($result->num_rows >0){
        header("location:dashboard.php");
        $username=$result->fetch_assoc();
        $_SESSION['username']=$username['company'];
    }else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <i class='fa fa-exclamation-circle me-2'></i>An icon &amp; dismissing danger alert—check it out!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
}
}catch(Exception $e){
    echo $e;
}
?>

    <script src="../Admin/js/jquery-3.4.1.min.js"></script>
    <script src="../Admin/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
</html>