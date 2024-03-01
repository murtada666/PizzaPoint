<?php require APPROOT . '/views/inc/header.php'; ?>

<h1 class="res-header">Driver Orders</h1>

<div class="dash-table-container">
    <div class="dash-table">
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Order Status</th>
                <th>Restaurant Name</th>
                <th>Total price</th>
                <th>Submitted Datetime</th>
                <th>Details</th>
            </tr>
            <?php foreach ($data as $order) : ?>
                <tr>
                    <td><?php echo $order['customer_name'] ?></td>

                    <td>
                        <?php switch ($order['order_status']) {
                            case 0:
                                echo "<div class='status pending' value='pending'>Pending</div>";
                                break;
                            case 1:
                                echo "<div class='status confirmed' value='confirmed'>confirmed</div>";
                                break;
                            case 2:
                                echo "<div class='status completed' value='Received'>Completed</div>";
                                break;
                            case 3:
                                echo "<div class='status shipped' value='shipped'>In the way</div>";
                                break;
                            case 4:
                                echo "<div class='status delivered' value='delivered'>Delivered</div>";
                                break;
                            default:
                                echo "Invalid order status.";
                        } ?>
                    </td>
                    <td><?php echo $order['restaurant_name'] ?></td>
                    <td><?php echo $order['total'] ?>$</td>
                    <td><?php echo $order['date_time'] ?></td>
                    <td><a href="<?php echo URLROOT . '/drivers/order_details/' . $order['order_id'] ?>">View</a></td>
                </tr>
            <?php endforeach ?>
        </table>
        <div id="snackbar" class="updated-order-snackbar"></div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>