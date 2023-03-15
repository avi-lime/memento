<?php
include("template/header.php");
include("../global/api/conn.php");
?>
<div class="card">
    <h1>Dashboard</h1>
    <hr>
    <div class="row">
        <?php
        $table = array(
            'category' => "Categories",
            'subcat' => "Sub-Cat",
            'product' => "Products",
            'user' => "Users",
            'orders' => "Orders"
        );
        foreach ($table as $key => $value) {
            ?>

            <div class="p-1 col-xxl-2 col-lg-4 col-sm-6 mb-1">
                <div class="card bg-black text-white ratio ratio-4x3">
                    <div class="card-body text-center">
                        <h3 class="card-title">
                            <?= $value ?>
                        </h3>
                        <hr>
                        <label class="display-6">
                            <?php $result = mysqli_query($conn, "SELECT COUNT(id) FROM $key");
                            $array = mysqli_fetch_array($result);
                            echo $array[0];
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
</div>

<?php include("template/footer.html") ?>