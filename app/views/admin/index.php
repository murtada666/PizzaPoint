<?php require APPROOT . '/views/inc/header.php'; ?>
    
<h1 class="admin-header">Sections</h1>
<div class="admin-main-container">
    <a href="clients" class="clients-btn">Clients</a>
    <a href="restaurants" class="restaurants-btn">Restaurants</a>
    <a href="drivers" class="drivers-btn">Drivers</a>
</div>

<section class="info-section">
    <h2>Some information</h2>
    <div class="info-container">
        <?php foreach ($data as $box_data) :  ?>
            <?php foreach ($box_data as $name => $value) :  ?>
                <div class="info-box">
                    <div class="box-title"><?php print_r(ucwords($name)); ?></div>
                    <div class="box-content"><?php print_r($value); ?></div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>