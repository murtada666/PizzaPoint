<?php require APPROOT . '/views/inc/header.php'; ?>

<h4>Dashboard!</h4>


    <section class="pizzas-container" id='page' >
        <?php foreach ($data['pizzas'] as $pizza) : ?>
            <div class="pizza-res-container">
                <img src="<?php echo URLROOT; ?>/img/pizza.svg">
                <div>
                <h6><?php echo htmlspecialchars($pizza->title); ?></h6>
                    <ul class="ing">
                        <?php foreach (explode(',', $pizza->ingredients) as $ing) : ?>
                            <li><?php echo htmlspecialchars($ing); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pizza-btn">
						<input type="submit" name="delete" value="Delete">
						<input type="hidden" name="product_id" value="<?php echo $pizza->id ?>">
						<a href="update.php?id=<?php echo $pizza->id ?>">update</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
