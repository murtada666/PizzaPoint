<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="details">
	<?php if ($data['pizza']) : ?>
		<h4><?php echo $data['pizza']->title; ?></h4>
		<p><?php echo date($data['pizza']->created_at); ?></p>
		<h5>Ingredients:</h5>
		<p><?php echo $data['pizza']->ingredients; ?></p>
		<div class="name">
			<h5>Restaurant name:</h5>
			<h6><?php echo $data['res_name']->name ;?> restaurant</h6>
		</div>
		<a href="<?php echo URLROOT; ?>/clients/restaurant/<?php echo $_SESSION['res_id'];?>" class="return">return</a>

	<?php else : ?>
		<h5>No such pizza exists.</h5>
	<?php endif ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>