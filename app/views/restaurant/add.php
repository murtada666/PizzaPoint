<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="new-user">
    <h1 class="center add-header">Add new pizza</h1>
    <form id="add-pizza-form">
        <div>
            <label>Title: </label>
            <input type="text" class="p-l" id="title">
            <div class="error" id="title-err"> </div>
        </div>
        <div>
            <label>Ingredients (comma separated): </label>
            <input type="text" class="p-l" id="ingredients">
            <div class="error" id="ing-err"> </div>
        </div>
        <div>
            <label>Price(number): </label>
            <input type="text" class="p-l" id="price">
            <div class="error" id="price-err"> </div>
        </div>
        <input type="submit" value="Submit" name="submit" id="add-pizza-btn">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>