<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="cart-header">
	<h4>Your cart</h4>
	<div class="total">Total: <div id="total"><?php echo isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0 ?></div>$</div>
</div>

<?php if (!$data['pizzas']) : ?>
	<section class='pizzas-container page' id='page'>

	</section>
<?php else : ?>

	<section class='pizzas-container page' id="page">
		<?php foreach ($data['pizzas'] as $pizza) : ?>
			<div class='pizza-container'>
				<img src='../img/pizza.svg'>
				<div>
					<h6><?php echo htmlspecialchars(ucfirst($pizza->title)); ?></h6>
					<ul class='ing'>
						<?php foreach (explode(',', $pizza->ingredients) as $ing) : ?>
							<li><?php echo htmlspecialchars($ing); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class='pizza-btn'>
					<input type='button' name='remove' value='Remove' id="<?php echo $pizza->id; ?>" price="<?php echo $pizza->price; ?>" class="remove-btn">
					<a href="<?php echo URLROOT; ?>/clients/details/<?php echo $pizza->id; ?>">More info</a>
				</div>
			</div>
		<?php endforeach; ?>
	</section>
<?php endif ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>