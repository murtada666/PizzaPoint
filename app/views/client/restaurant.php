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
<section class="pizzas-container" id='page' id='page-content'>
    <?php foreach ($data['pizzas'] as $pizza) : ?>
        <div class="pizza-container">
            <img src="<?php echo URLROOT;?>/img/pizza.svg">
            <div>
                <h6><?php echo htmlspecialchars($pizza->title); ?></h6>
                <ul class="ing">
                    <?php foreach (explode(',', $pizza->ingredients) as $ing) : ?>
                        <li><?php echo htmlspecialchars($ing); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="pizza-btn">
                <form class="add-form" id="add-form" data-product-id="<?php echo $pizza->id; ?>">
                        <input type="submit" name="add" value="Add" id="add-submit" >
                        <a href="<?php echo URLROOT; ?>/clients/details/<?php echo $pizza->id ;?>">More Info</a>
                </form>
            </div>
        </div>  
    <?php endforeach; ?>
    <div id="snackbar">This is a Snackbar!</div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
