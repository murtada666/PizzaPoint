<?php require APPROOT . '/views/inc/header.php'; ?>
<h4>Restaurants!</h4>

<div class="res-container" >
		<?php foreach ($data['restaurants'] as $restaurant) : ?>
				<div class="res">
					<img src="<?php echo URLROOT;?>/img/pizza.svg">

					<div class="name-container">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
							<div>
								<a class="res-name" href="restaurant/<?php echo $restaurant->id ?>"><?php echo $restaurant->name; ?></a>
							</div>
						</form>
					</div>
				</div>
		<?php endforeach; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>