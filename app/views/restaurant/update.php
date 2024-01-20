<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="new-user">
    <h1 class="center" style="font-size: 2.6rem;">Edit your pizza</h1>
    <form id="item-update-form" class="update-item" value='<?php echo $data['pizza']->id; ?>'>
        <div>
            <label>Title: </label>
            <input type="text" class="p-l" name="title" value="<?php echo htmlspecialchars($data['pizza']->title) ?? '' ?>" id="update-title">
            <div class="error" id="title-err"> </div>
        </div>
        <div>
            <label>Ingredients (comma separated): </label>
            <input type="text" class="p-l" name="ingredients" value="<?php echo htmlspecialchars($data['pizza']->ingredients) ?? '' ?>" id="update-ing">
            <div class="error" id="ing-err"> </div>
        </div>
        <input type="submit" value="Submit" name="submit" id="update-submit-btn">
    </form>
    <div id="snackbar" class="signed-snackbar"></div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>