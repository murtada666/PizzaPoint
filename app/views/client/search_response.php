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
            <form class="add-form" id="add-form" data-product-id="<?php echo $pizza->id; ?>">
                <input type="submit" name="add" value="Add" id="add-submit">
                <a href="<?php echo URLROOT; ?>/clients/details/<?php echo $pizza->id; ?>">More Info</a>
            </form>
        </div>
    </div>
<?php endforeach; ?>