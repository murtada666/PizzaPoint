<?php if(!$data): ?>

<?php else: ?>

<section class='pizzas-container' id='page'>
	<?php foreach ($data['pizzas'] as $pizza) : ?>
			<div class='pizza-container'>
				<img src='../img/pizza.svg'>
				<div >
					<h6><?php echo htmlspecialchars($pizza->title); ?></h6>
					<ul class='ing'>
						<?php foreach (explode(',', $pizza->ingredients) as $ing) : ?>
							<li><?php echo htmlspecialchars($ing); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class='pizza-btn'>
					<form onsubmit="return false;" class="remove-from-cart" data-product-id="<?php echo $pizza->id; ?>">
							<input type='submit' name='remove' value='Remove'>
							<a href="<?php echo URLROOT; ?>/clients/details/<?php echo $pizza->id ;?>">More info</a>
					</form>
				</div>	
			</div>
	<?php endforeach; ?>	
</section>

<?php endif ?> 