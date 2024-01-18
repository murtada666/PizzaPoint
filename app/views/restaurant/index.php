<?php require APPROOT . '/views/inc/header.php'; ?>

<h4>Dashboard!</h4>

<?php if (!$data['pizzas']) : ?>
    <section class="pizzas-container">
        <h1 class="empty">there is no items yet!<h1>
    </section>
<?php else : ?>

    <section class="pizzas-container" id='res-index'>
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
                    <input type="submit" name="delete" value="Delete" class="remove-btn" id="<?php echo $pizza->id ?>">
                    <a href='<?php echo URLROOT . "/restaurants/update/" . $pizza->id; ?>'>update</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php endif ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>