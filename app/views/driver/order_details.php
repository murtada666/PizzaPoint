<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="order-details-header">
    <h4>Order details</h4>
    <a href="../index" class="return-to-orders">Return to orders</a>
</div>

<div class="details-container">
    <ol>
        <?php foreach ($data['order_details'] as $title) : ?>
            <li><?php echo $title; ?></li>
        <?php endforeach ?>
    </ol>
    <div id="driver-order-form">
        <!-- The ID in the input tag represent the future order_status value of the order -->
        <?php switch ($data['order_status']) {
            case 3:
                echo "<input class='order-details-btn' status='4' id='" . $data['order_id'] . "' type='button' value='Delivered'>";
                break;
            default:
                echo "<a class='order-details-btn' href='../index'>Return</a>";
        } ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>