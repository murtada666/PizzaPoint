<?php require APPROOT . '/views/inc/header.php'; ?>

<?php if(!$data['pizzas']): ?>
	<section class='pizzas-container' id='page'>

	</section>
<?php  else: ?>

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
					<!-- <form action='<php echo URLROOT; ?>/clients/remove' method='POST'> -->
					<form class="remove-from-cart">
							<input type='submit' name='remove' value='remove'>
							<input type='hidden' name='product_id' value='<?php echo $pizza->id ?>'>
							<a href="<?php echo URLROOT; ?>/clients/details/<?php echo $pizza->id ;?>">more info</a>
					</form>
				</div>	
			</div>
	<?php endforeach; ?>
</section>
<?php  endif ?>


<?php require APPROOT . '/views/inc/footer.php'; ?>
