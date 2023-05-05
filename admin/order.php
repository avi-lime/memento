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
        $sql = "SELECT id, order_id, user_id, (SELECT name FROM product WHERE product.id=product_id) AS product, date, amount, quantity  FROM orders";
        $result = mysqli_query($conn, $sql);

        $output = '<thead>'
            . '<tr>'
            . '<th>ID</th>'
            . '<th>Order ID</th>'
            . '<th>User id</th>'
            . '<th>Product</th>'
            . '<th>Amount</th>'
            . '<th>Date</th>'
            . '<th>Quantity</th>'
            . '</tr>'
            . '</thead>'
            . '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {

            $date = date_format(date_create($row["date"]), "d/m/Y, H:i:s");
            $output .= '<tr>'
                . '<th scope="row">' . $row['id'] . '</td>'
                . ' <td>' . $row['order_id'] . '</td>'
                . '<td>' . $row['user_id'] . '</td>'
                . '<td>' . $row['product'] . '</td>'
                . '<td>₹' . $row['amount'] . '</td>'
                . '<td>' . $date . '</td>'
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