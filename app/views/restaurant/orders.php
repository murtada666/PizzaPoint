<?php require APPROOT . '/views/inc/header.php'; ?>
<?php
// Counter for order number.
$num_counter = 1;
?>
<!-- For loop is a Key Value pair to use the key(Index) in ['orders_details'] and make the index dynamically updated -->
<?php foreach ($data['orders'] as $loop_counter => $order) : ?>
	<div class="pizza-container process-height">
		<img src="../img/pizza.svg">
		<div>
			<h6><?php echo "Order Number: " .  $num_counter++; ?></h6>
			<h6>pizzas...</h6>
			<ul class="ing">
				<?php foreach ($data['orders_titles'][$loop_counter] as $single_order_title) : ?>
					<?php foreach ($single_order_title as $title) : ?>
						<li><?php echo htmlspecialchars($title); ?></li>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<input type="submit" name="" value="cook">
				<input type="hidden" name="order_id" value="<?php echo $order->order_id; ?>">
			</form>
		</div>
	</div>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>