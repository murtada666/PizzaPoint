<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="order-details-header">
    <h4>Order details</h4>
    <a href="../orders" class="return-to-orders">Return to orders</a>
</div>

<div class="details-container">
    <ol>
        <?php foreach ($data['order_details'] as $title) : ?>
            <li><?php echo $title; ?></li>
        <?php endforeach ?>
    </ol>
    <div id="restaurant-order-form">
        <!-- The ID in the input tag represent the future order_status value of the order -->
        <?php switch ($data['order_status']) {
            case 0:
                echo "<input class='order-details-btn' status='1' id='" . $data['order_id'] . "' type='button' value='Confirm'>";
                break;
            case 1:
                echo "<input class='order-details-btn' status='2' id='" . $data['order_id'] . "' type='button' value='Complete'>";
                break;
            case 2:
                echo "<input class='order-details-btn' status='3' id='" . $data['order_id'] . "' type='button' value='Ship'>";
                break;
            default:
                echo "<a class='order-details-btn' href='../orders'>Return</a>";
        } ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>