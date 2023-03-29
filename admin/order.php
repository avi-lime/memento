<?php
include("template/header.php");
include("../global/api/conn.php");


?>
<div class="card">
    <h1>Order</h1>
    <hr>



    <table id="table" class="table table-responsive text-center">
        <caption>List of Orders</caption>
        <?php
        // filling up the table
        $table = "orders";
        $sql = "SELECT * FROM orders";
        $result = mysqli_query($conn, $sql);

        $output = '<thead>'
            . '<tr>'
            . '<th>ID</th>'
            .'<th>Order ID</th>'
            . '<th>User id</th>'
            . '<th>Product ID</th>'
            // . '<th>Image</th>'
            . '<th>Addres</th>'
            . '<th>amount</th>'
            . '<th>status</th>'
            . '<th>date</th>'
            . '<th>Quantity</th>'
            . '</tr>'
            . '</thead>'
            . '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<tr>'
                . '<th scope="row">' . $row['id'] . '</td>'
                .' <td>'.$row['order_id'].'</td>'
                . '<td>' . $row['user_id'] . '</td>'
                . '<td>' . $row['product_id'] . '</td>'
                // . "<td><img style='height:200px; width:200px; object-fit:cover' class='rounded-circle' alt='img' src='../assets/images/" . $row['image'] . "'></td>"
                . '<td>' . $row['address_id'] . '</td>'
                . '<td>' . $row['amount'] . '</td>'
                . '<td>' . $row['status'] . '</td>'
                . '<td>' . $row['date'] . '</td>'
                . '<td>' . $row['quantity'] . '</td>'
                . '</td>'
                . '</tr>';
        }
        $output .= "</tbody>";
        echo $output;
        ?>
    </table>
</div>
<script>
    $(document).ready(function () {

        $("#table").DataTable();

    })
</script>
<?php include("template/footer.html") ?>