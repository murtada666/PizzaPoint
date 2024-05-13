<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="new-user signup">
  <h2>Add a new driver</h2>
  <form action="<?php echo URLROOT; ?>/users/register" method="POST">
    <div>
      <label>Name: </label>
      <input type="text" class="p-l" name="name" id="name" value="<?php echo htmlspecialchars($data['name']); ?>">
      <div class="error" id="name-err">
        <?php echo $data['name_err']; ?>
      </div>
    </div>
    <div>
      <label>E-mail: </label>
      <input type="email" class="p-l" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>">
      <div class="error" id="email-err">
        <?php echo $data['email_err']; ?>
      </div>
    </div>
    <div>
      <label>Password: </label>
      <input type="password" class="p-l" name="password" id="password" value="<?php echo htmlspecialchars($data['password']); ?>">
      <div class="error" id="password-err">
        <?php echo $data['password_err']; ?>
      </div>
      <input type="password" class="p-l" name="confirm_password" id="confirm_password" value="<?php echo htmlspecialchars($data['confirm_password']); ?>">
      <div class="error" id="confirm-password-err">
        <?php echo $data['confirm_password_err']; ?>
      </div>
    </div>
    <input type="submit" value="Submit" id="new-driver-submit-btn" name="submit">
  </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>