<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../global/html/require.html") ?>
    <title>SteamX</title>
</head>

<body>
    <?php
    include("../global/api/conn.php");
    session_start();
    if (!isset($_SESSION["admin"]) || $_SESSION["admin"] == null) {
        header("location: login.php");
    }

    if (time() > $_SESSION['expire']) {
        session_unset();
        session_destroy();
        header("location: login.php");
    }
    ?>
    <div class="hero">
        <div class="sidebar active">
            <div class="brand">
                <a href="index.php" class="brand-link">
                    <i class="fa-brands fa-steam"></i>
                </a>
                <a href="index.php" class="brand-link">
                    <span class="brand_name">MEMENTO</span>
                </a>
            </div>
            <div class="navigation">
                <ul class="items-list">
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Dashboard" data-bs-placement="right">
                        <a href="dashboard.php">
                            <i class="fa-solid fa-house"></i>
                            <span class="links_name">Dashboard</span>
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION["super"]) && $_SESSION["super"] == 1) {
                        ?>
                        <li class="item" data-bs-toggle="tooltip" data-bs-title="Admins" data-bs-placement="right">
                            <a href="admin.php">
                                <i class="fa-solid fa-id-badge"></i>
                                <span class="links_name">Admins</span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Categories" data-bs-placement="right">
                        <a href="category.php">
                            <i class="fa-solid fa-shapes"></i>
                            <span class="links_name">Categories</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Sub-Categories" data-bs-placement="right">
                        <a href="subcat.php">
                            <i class="fas fa-folder"></i>
                            <span class="links_name">Sub-Categories</span>
                        </a>
                    </li>
                    <li class="item" data-bs-toggle="tooltip" data-bs-title="Users" data-bs-placement="right">
                        <a href="user.php">
                            <i class="fa-solid fa-users"></i>
                            <span class="links_name">Users</span>
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
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li>
                        <a class="dropdown-item" href="settings.php">
                            Message
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

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
                    <li>
                        <a class="dropdown-item" href="settings.php">
                            <i class="fa-solid fa-cog"></i>&nbsp;&nbsp;Settings
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
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