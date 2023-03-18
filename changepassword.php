<?php
session_start();
if (!isset($_SESSION["email"]) || $_SESSION["email"] == null)
    header("location: forgotpassword");
require_once("global/api/conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memento Sign in & Sign up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/x-icon" href="img/mxm-white.png" sizes="any">
    <link rel="shortcut icon" href="img/mxm-white.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/mxm-white.png">
</head>
<?php
if (isset($_REQUEST['btn_change'])) {
    $pass = $_REQUEST['pass'];
    $confirmpass = $_REQUEST['confirmpass'];
    if ($pass == $confirmpass) {
        $sanitized_password = mysqli_real_escape_string($conn, $pass);
        $sanitized_email=mysqli_real_escape_string($conn,$_SESSION["email"]);
        $hashed_password = password_hash($sanitized_password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password='$hashed_password' WHERE email='$sanitized_email'";
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $_SESSION["email"] = null;
        ?>
            <script>alert("Password Has been Updated");window.location.href="login.php";</script>
        <?php
        //header("location:login");
    } else {
        echo "<script>alert('Password does not match')</script>";
    }
}
?>

<body>
    <main>
        <div class="box">
            <div class="forms-wrap col-md-6">
                <form action="" method="POST" class="sign-in-form">
                    <div class="logo">
                        <a href="index"><img src="img/mxm-black.png" alt="Clothing" /></a>
                    </div>
                    <div class="heading">
                        <h3>Create new password</h3>
                        <h6>We'll ask for this password whenever you sign in.</h6>
                    </div>
                    <div class="actual-form">
                        <div class="input-wrap  d-flex  " style="margin-bottom: 8px;">
                            <input type="password" id="pass" name="pass" class="input-field" required
                                placeholder="New Password" />
                                <i class="fa-solid fa-eye ms-auto mt-3 me-1 z-3 passToggle" role="button"></i>
                        </div>
                        <div class="input-wrap d-flex">
                            <input type="password" id="confirmpass" name="confirmpass" class="input-field" required
                                placeholder="Confirm New Password" />
                                <i class="fa-solid fa-eye ms-auto mt-3 me-1 z-3 passToggle" role="button"></i>
                        </div>
                        <input type="submit" value="Continue" id="btn_change" name="btn_change" class="sign-btn" />
                        <p class="text">
                            Forgotten your password or your login details?
                            <a href="contact.php">Get help</a> signing in
                        </p>
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-none d-md-flex bg-image carousel"></div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
<script>
$(document).ready(function () {
            $(".passToggle").click(function () {
                $(this).toggleClass("fa-eye")
                $(this).toggleClass("fa-eye-slash")
                let passField = $(this).siblings("input")
                if (passField.attr("type") == "password") passField.attr("type", "text")
                else passField.attr("type", "password")
            })
        })
</script>
</html>