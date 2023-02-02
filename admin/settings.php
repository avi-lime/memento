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
                echo $_SESSION["admin"] ?>">
                <div class=" form-group">
                    <label>Username </label>
                    <input required name="username" id="username" type="text" class="form-control mb-3">
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input required name="email" id="email" type="email" class="form-control mb-3">
                </div>
                <div class="form-group">
                    <label>Phone No </label>
                    <input required name="phno" id="phno" type="number" class="form-control mb-3">
                </div>
                <div class="form-group">
                    <label>Image </label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="imgfile" id="imgfile" accept=".png,.jpg,.jpeg">

                    </div>
                </div>
                <div class="form-group">
                    <label>Change Password </label>
                    <input name="password" type="password" class="form-control mb-3">
                </div>
                <div>
                    <button type="submit" class="my-btn p-2 mb-3 me-2" name="btnSub" style="width:100px">Save</button>
                    <button id="btnDelM" class="my-btn p-2 mb-3">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
<?php include("../global/html/footer.html") ?>