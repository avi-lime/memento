<?php
session_start();
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
if (isset($_REQUEST["btn_signin"])) {
    $email = $_REQUEST["email_signin"];
    $password = $_REQUEST["pass_signin"];
    $sanitized_email = mysqli_real_escape_string($conn, $email);
    $sanitized_password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM user WHERE email='$sanitized_email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $num = mysqli_num_rows($result);
    $error = "";
    if ($num > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($sanitized_password, $user["password"])) {
            $_SESSION["user"] = $user["id"];
            $_SESSION["username"] = $user["name"];
            $_SESSION['expire'] = time() + (60 * 60);
            redirect('index');
        } else {
            $error = "E-mail and Password don't match.";
        }
    } else {
        $error = "User doesn't exist.";
    }
    if ($error != "") {
        ?>
        <!-- alert -->
        <!-- add css file merako nahi malum konsa!! -->
        <div class="mb-4 alert alert-danger d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <?= $error ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }
} else if (isset($_REQUEST["btn_signup"])) {
    $name = $_POST['name_signup'];
    $email = $_POST['email_signup'];
    $password = $_POST['pass_signup'];
    $sanitized_name = mysqli_real_escape_string($conn, $name);
    $sanitized_email = mysqli_real_escape_string($conn, $email);
    $sanitized_password = mysqli_real_escape_string($conn, $password);
    $hashed_password = password_hash($sanitized_password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM user WHERE email='$sanitized_email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        ?>
            <script>alert("User Already exists")</script>
        <?php
    } else {
        $sql = "INSERT INTO user (name,email,password) VALUES ('$sanitized_name','$sanitized_email', '$hashed_password')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
}

function redirect($url)
{
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit;
    }
}
?>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap col-md-6">
                    <form action="" method="POST" class="sign-in-form">
                        <div class="logo">
                            <a href="index.php"><img src="img/mxm-black.png" alt="Clothing" /></a>
                        </div>
                        <div class="heading">
                            <h2>Welcome Back</h2>
                            <h6>Not Registered yet?</h6>
                            <a href="#" class="toggle">Sign up</a>
                        </div>
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" id="email_signin" name="email_signin" class="input-field" required />
                                <label>Email or Phone Number</label>
                            </div>
                            <div class="input-wrap d-flex" style="margin-bottom:10px">
                                <input type="password" id="pass_signin" name="pass_signin" class="input-field"
                                    required />
                                <label>Password</label>
                                <i class="fa-solid fa-eye ms-auto mt-3 me-1 z-3 passToggle" role="button"></i>
                            </div>
                            <a href="forgotpassword.php"
                                style="margin-left:230px;text-decoration:none;color:#9c95ae; font-size:15px;"> Forgot
                                Password</a>
                            <input type="submit" value="Sign In" id="btn_signin" name="btn_signin" class="sign-btn" />
                            <p class="text">
                                Forgotten your password or your login details?
                                <a href="contact.php">Get help</a> signing in
                            </p>
                        </div>
                    </form>
                    <form action="" method="POST" class="sign-up-form">
                        <div class="logo">
                            <img src="img/mxm-black.png" alt="Clothing" />
                        </div>
                        <div class="heading">
                            <h2>Get started</h2>
                            <h6>Already have an account?</h6>
                            <a href="#" class="toggle">Sign in</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" class="input-field" id="name_signup" name="name_signup" required />
                                <label>Name</label>
                            </div>

                            <div class="input-wrap">
                                <input type="email" minlength="4" id="email_signup" name="email_signup"
                                    class="input-field" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap d-flex">
                                <input type="password" minlength="4" id="pass_signup" name="pass_signup"
                                    class="input-field" required />
                                <label>Password</label>
                                <i class="fa-solid fa-eye ms-auto me-1 mt-3 z-3 passToggle" role="button"></i>
                            </div>
                            <input type="submit" value="Sign Up" id="btn_signup" name="btn_signup" class="sign-btn" />

                            <p class="text">
                                By signing up, I agree to the <a href="#">Terms of Services</a>
                                and <a href="#">Privacy Policy</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 d-none d-md-flex bg-image carousel"></div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        const inputs = document.querySelectorAll(".input-field");
        const toggle_btn = document.querySelectorAll(".toggle");
        const main = document.querySelector("main");
        const bullets = document.querySelectorAll(".bullets span");
        const images = document.querySelectorAll(".image");

        inputs.forEach(inp => {
            inp.addEventListener("focus", () => {
                inp.classList.add("active");
            });
            inp.addEventListener("blur", () => {
                if (inp.value != "") return;
                inp.classList.remove("active");
            });
        });

        toggle_btn.forEach(btn => {
            btn.addEventListener("click", () => {
                main.classList.toggle("sign-up-mode");
            });
        });

        function moveSlider() {
            let index = this.dataset.value;

            let currentImage = document.querySelector(`.img-${index}`);
            images.forEach(img => img.classList.remove("show"));
            currentImage.classList.add("show");

            const textSlider = document.querySelector(".text-group");
            textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

            bullets.forEach(bull => bull.classList.remove("active"));
            this.classList.add("active");
        }

        bullets.forEach((bullet) => {
            bullet.addEventListener("click", moveSlider);
        });

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
</body>

</html>