<?php  require APPROOT . '/views/inc/header.php'; ?>

<div class="new-user">
        <h2>Login into your account</h2>
        <form action="<?php echo URLROOT; ?>/users/login" method="POST">
            <div>
                <label>E-mail: </label>
                <input type="email" class="p-l" name="email" value="<?php echo htmlspecialchars($data['email']) ?? '' ?>">
                <div class="error">
                    <?php echo $data['email_err'] ?>
                </div>
            </div>
            <div>
                <label>Password: </label>
                <input type="password" class="p-l" name="password" value="<?php echo htmlspecialchars($data['password']) ?? '' ?>">
                <div class="error">
                    <?php echo $data['password_err'] ?>
                </div>
            </div>
            <input type="submit" value="Submit" name="submit">
            <a href="<?php echo URLROOT;?>/users/register">Not registered yet?</a>
        </form>
        <div id="snackbar" class="signed-snackbar"></div>
    </div>

<?php  require APPROOT . '/views/inc/footer.php'; ?>
