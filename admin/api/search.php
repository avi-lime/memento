<?php
include("../../global/api/conn.php");
$table = $_REQUEST["table"];
$toSearch = $_REQUEST["toSearch"];
$query = "SELECT * FROM $table WHERE name LIKE '%$toSearch%'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="p-1 col-xl-4 col-md-6 col-sm-12 mb-1">
        <div class="card bg-black text-white">
            <img src="../global/assets/images/<?php echo $row["image"] ?>" alt="" class="card-img-top"
                style="object-fit: cover" height="300px">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $row["id"] . ". " . $row["name"] ?>
                </h5>
                <!-- <p class="card-text line-clamp"><?php //echo $row["description"] ?></p> -->
                <div class="btn-group w-100" role="group" aria-label="Actions">
                    <!-- <button type="button" class="btn my-btn">View</button> -->
                    <a id="<?php echo $row["id"] ?>" role="button" class="btn my-btn btn-edit">Update</a>
                    <a role="button" href="api/delete.php?table=<? echo $table ?>&id=<?php echo $row['id'] ?>"
                        class="btn my-btn">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>