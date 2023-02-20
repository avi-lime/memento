<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memento Sign in & Sign UP</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/x-icon" href="img/mxm-white.png" sizes="any">
    <link rel="shortcut icon" href="img/mxm-white.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/mxm-white.png">
</head>
<?php
require_once("global/api/conn.php");
// session_start();
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
            $_SESSION["user"] = $user["user_id"];
            $_SESSION['expire'] = time() + (60 * 60);
            header('location: index.php');
        } else {
            $error = "E-mail and Password don't match.";
        }
    } else {
        $error = "User doesn't exist.";
    }
    if ($error != "") {
        ?>
        <!-- alert -->
        <div class="mb-4 alert alert-danger d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <?php echo $error ?>
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
?>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form action="" method="POST" class="sign-in-form">
                        <div class="logo">
                            <img src="img/mxm-black.png" alt="Clothing" />
                        </div>
                        <div class="heading">
                            <h2>Welcome Back</h2>
                            <h6>Not Registered yet?</h6>
                            <a href="#" class="toggle">Sign up</a>
                        </div>
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" id="email_signin" name="email_signin" class="input-field" required />
                                <label>Email</label>
                            </div>
                            <div class="input-wrap">
                                <input type="password" id="pass_signin" name="pass_signin" class="input-field"
                                    required />
                                <label>Password</label>
                            </div>
                            <input type="submit" value="Sign In" id="btn_signin" name="btn_signin" class="sign-btn" />
                            <p class="text">
                                Forgotten your password or your login details?
                                <a href="#">Get help</a> signing in
                            </p>
                        </div>
                    </form>
                    <form action="" method="POST" class="sign-up-form">
                        <div class="logo">
                            <img src="img/mxm-black.png" alt="Clothing" />
                            <h3>Clothing</h3>
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

                            <div class="input-wrap">
                                <input type="password" minlength="4" id="pass_signup" name="pass_signup"
                                    class="input-field" required />
                                <label>Password</label>
                            </div>

                            <input type="submit" value="Sign Up" id="btn_signup" name="btn_signup" class="sign-btn" />

                            <p class="text">
                                By signing up, I agree to the <a href="#">Terms of Services</a>
                                and <a href="#">Privacy Policy</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="img/login/cloth1.jpg" class="image img-1 show" alt="" />
                        <img src="img/login/image2.webp" class="image img-2" alt="" />
                        <img src="img/login/cloth3.jpg" class="image img-3" alt="" />
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Create your own style</h2>
                                <h2>Prepare your twinning hoddies</h2>
                                <h2>Customize as you like</h2>
                            </div>
                        </div>

                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
    </script>
</body>

</html>