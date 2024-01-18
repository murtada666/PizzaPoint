<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="search-container">
    <div>
        <form class='center search-card' id="search-form">
            <label for="search" style="font-size: 20px;">Search For Your Favorite Pizza</label>
            <div class="search-inner-container">
                <input type="text" name='search' value="<?php echo htmlspecialchars($data['search']); ?>" class="search" id="search-content">
                <input type="hidden" name='res_id' value=<?php echo $_SESSION['res_id']; ?> id="res-id">
                <input type="submit" name="submit" value="Submit" class="search-submit" id="search-submit">
            </div>
        </form>
    </div>
</section>
<h4>Pizzas!</h4>

<?php if (!$data['pizzas']) : ?>
	<section class='pizzas-container page'>

	</section>
<?php else : ?>
    <section class="pizzas-container page" id='page' >
        <?php foreach ($data['pizzas'] as $pizza) : ?>
            <div class="pizza-container">
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
                    <input type="button" name="add" value="Add" id="<?php echo $pizza->id; ?>" class="add-btn">
                    <a href="<?php echo URLROOT; ?>/clients/details/<?php echo $pizza->id; ?>">More Info</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php endif ?>

    <!-- SnackBar -->
    <div id="snackbar"></div>

<?php require APPROOT . '/views/inc/footer.php'; ?>