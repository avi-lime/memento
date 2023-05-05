<?php
session_start();
require_once("../global/api/conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/login.css">
    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


    <link rel="icon" type="image/x-icon" href="../img/mxm-white.png" sizes="any">
    <link rel="shortcut icon" href="../img/mxm-white.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="../img/mxm-white.png">

    <title>Login</title>
</head>

<body class="login_body">
    <?php
    if (isset($_REQUEST["submit"])) {
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];

        $sanitized_email = mysqli_real_escape_string($conn, $email);
        $sanitized_password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM admin WHERE email='$sanitized_email'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $num = mysqli_num_rows($result);

        $error = "";
        if ($num > 0) {
            $admin = mysqli_fetch_assoc($result);
            if (password_verify($sanitized_password, $admin["password"])) {
                $_SESSION["admin"] = $admin["id"];
                $_SESSION["super"] = $admin["superadmin"];
                $_SESSION['expire'] = time() + (60 * 60);
                redirect("dashboard");
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
                    <?= $error ?>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
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

    <form action="" method="post" class="login_form">
        <div class="login_title">
            <h2>MEMENTO</h2>
        </div>

        <div class="form_group">
            <label for="email">E-mail</label>
            <input class="form_input" type="email" name="email" id="email" autocomplete="email" autofocus required>
            <span class="underline-animation"></span>
        </div>
        <div class="form_group">
            <label for="password">Password</label>
            <input class="form_input" type="password" name="password" id="password" autocomplete="current-password"
                required>
            <span class="underline-animation"></span>
        </div>
        <div class="form_group">
            <button class="login_btn btn" name="submit" type="submit">SIGN IN <i
                    class="fa-solid fa-arrow-right"></i></button>
        </div>
    </form>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>