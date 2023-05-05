<?php
session_start();

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] == null) {
    redirect("login");
}

if (time() > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    redirect("login");
}
session_abort();

require_once("../global/api/conn.php");

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Nice Select -->
    <link rel="stylesheet" href="../css/nice-select.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/panel.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <title>Memento Admin</title>

    <link rel="icon" type="image/x-icon" href="../img/mxm-white.png" sizes="any">
    <link rel="shortcut icon" href="../img/mxm-white.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="../img/mxm-white.png">
</head>

<body>
    <div class="hero">
        <div class="sidebar active">
            <div class="brand">
                <a href="index" class="brand-link">
                    <i class="fa-solid fa-shirt"></i>
                </a>
                <a href="index" class="brand-link">
                    <span class="brand_name">MEMENTO</span>
                </a>
            </div>
            <div class="navigation">
                <ul class="items-list">
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Dashboard" data-bs-placement="right">
                        <a href="dashboard">
                            <i class="fa-solid fa-house"></i>
                            <span class="links_name">Dashboard</span>
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION["super"]) && $_SESSION["super"] == 1) {
                        ?>
                        <li class="item" data-bs-toggle="tooltip" data-bs-title="Admins" data-bs-placement="right">
                            <a href="admin">
                                <i class="fa-solid fa-id-badge"></i>
                                <span class="links_name">Admins</span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Categories" data-bs-placement="right">
                        <a href="category">
                            <i class="fa-solid fa-shapes"></i>
                            <span class="links_name">Categories</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Sub-Categories" data-bs-placement="right">
                        <a href="subcat">
                            <i class="fas fa-folder"></i>
                            <span class="links_name">Sub-Categories</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Products" data-bs-placement="right">
                        <a href="product">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span class="links_name">Products</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Users" data-bs-placement="right">
                        <a href="user">
                            <i class="fa-solid fa-users"></i>
                            <span class="links_name">Users</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Orders" data-bs-placement="right">
                        <a href="order">
                            <i class="fa-solid fa-box"></i>
                            <span class="links_name">Orders</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="message" data-bs-placement="right">
                        <a href="messages">
                            <i class="fa-solid fa-message"></i>
                            <span class="links_name">Messages</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="slider" data-bs-placement="right">
                        <a href="slider">
                            <i class="fa-regular fa-images"></i>
                            <span class="links_name">Slider</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <header class="header container-fluid">
            <div class="sidebar-toggler">
                <i class="fa-solid fa-bars"></i>
            </div>

            <div class="chat">
                <a href="#" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none">
                    <i class="fa-solid fa-message"></i>
                </a>
                <ul id="messages" class="dropdown-menu dropdown-menu-dark" style="width: 500px">

                </ul>
            </div>


            <div class="profile">

                <a href="#" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none">
                    <?php
                    $id = $_SESSION['admin'];

                    $query = "SELECT * FROM admin WHERE id=$id";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    echo $row["username"]; // show username 
                    
                    ?>
                    <i class="fa-solid fa-user ms-2"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <!-- <li>
                        <a class="dropdown-item" href="settings">
                            <i class="fa-solid fa-cog"></i>&nbsp;&nbsp;Settings
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li> -->
                    <li>
                        <form method="post" action="api/logout.php">
                            <button name="btnLogout" class="dropdown-item" type="submit">
                                <i class="fa-solid fa-sign-out"></i>&nbsp;&nbsp;Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>
        <div class="main container-fluid">