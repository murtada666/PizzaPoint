<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="new-user">
    <h1 class="center" style="font-size: 2.6rem;">Edit your pizza</h1>
    <form action="<?php echo URLROOT . "/restaurants/update/" . $data['pizza']->id; ?>" method="POST">
        <div>
            <label>Title: </label>
            <input type="text" class="p-l" name="title" value="<?php echo htmlspecialchars($data['pizza']->title) ?? '' ?>">
            <div class="error">
                <?php echo $data['errors']['title'] ?>
            </div>
        </div>
        <div>
            <label>Ingredients (comma separated): </label>
            <input type="text" class="p-l" name="ingredients" value="<?php echo htmlspecialchars($data['pizza']->ingredients) ?? '' ?>">
            <div class="error">
                <?php echo $data['errors']['ingredients'] ?>
            </div>
        </div>
        <input type="submit" value="Submit" name="submit">
    </form>
    <div id="snackbar" class="signed-snackbar"></div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>