<?php require APPROOT . '/views/inc/header.php'; ?>

<h4>Order details</h4>

<div class="details-container">
    <ol>
        <?php foreach ($data['order_details'] as $title) : ?>
            <li><?php echo $title; ?></li>
        <?php endforeach ?>
    </ol>
    <div class="order-form">
        <?php switch ($data['order_status']) {
            case 0:
                echo "<input class='order-details-btn' type='button' value='Confirm'>";
                break;
            case 1:
                echo "<input class='order-details-btn' type='button' value='Complete'>";
                break;
            case 2:
                echo "<input class='order-details-btn' type='button' value='Ship'>";
                break;
            default:
                echo "<a class='order-details-btn' href='../orders'>Return</a>";
        } ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>