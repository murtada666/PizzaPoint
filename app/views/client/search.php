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
                <form id="add-form">
                    <div>
                        <input type="submit" name="add" value="Add" id="add-submit">
                        <input type="hidden" name="product_id" value="<?php echo $pizza->id ?>">
                        <a href="<?php echo URLROOT; ?>/clients/details/<?php echo $pizza->id ;?>">More Info</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>