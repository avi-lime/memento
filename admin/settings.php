<?php
include("template/header.php");
include("../global/api/conn.php");
?>
<div class="card">
    <div class="container row">
        <h1>Settings</h1>
        <hr style="color: white">
        <form id="form1" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name='id' id="id" value="<?php
            if (!isset($_SESSION["admin"])) {
                header("location: ./login.php");
            } else
                echo $_SESSION["admin"]
                    ?>">
                <?php
            $query = "SELECT * FROM admin WHERE id=" . $_SESSION["admin"];
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class=" form-group">
                    <label>Username </label>
                    <input name="username" id="username" type="text" class="form-control mb-3"
                        value="<?php echo $row["username"] ?>">
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input name="email" id="email" type="email" class="form-control mb-3"
                        value="<?php echo $row["email"] ?>">
                </div>
                <div class="form-group">
                    <label>Change Password </label>
                    <input name="password" type="password" class="form-control mb-3">
                </div>
                <div class="form-group">
                    <label>Confirm Password *</label>
                    <input name="password" type="password" class="form-control mb-3" required>
                </div>
                <div>
                    <button type="submit" class="my-btn p-2 mb-3 me-2" name="btnSub" style="width:100px">Save</button>
                    <button id="btnDelM" class="my-btn p-2 mb-3">Delete Account</button>
                </div>
            <?php } ?>
        </form>
    </div>
</div>
<?php include("template/footer.html") ?>