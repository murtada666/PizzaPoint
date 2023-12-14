<?php  require APPROOT . '/views/inc/header.php'; ?>
<div class="new-user signup">
    <h2>Create a new user</h2>
    <form action="<?php echo URLROOT; ?>/users/register" method="POST">
      <div>
        <label>Name: </label>
        <input type="text" class="p-l" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" >
        <div class="error">
          <?php echo $data['name_err']; ?>
        </div>
      </div>
      <div>
        <label>E-mail: </label>
        <input type="email" class="p-l" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
        <div class="error">
          <?php echo $data['email_err']; ?>
        </div>
      </div>
      <div> 
        <label>Password: </label>
        <input type="password" class="p-l" name="password" value="<?php echo htmlspecialchars($data['password']); ?>">
        <div class="error">
          <?php echo $data['password_err']; ?>
        </div>
        <input type="password" class="p-l" name="confirm_password" value="<?php echo htmlspecialchars($data['confirm_password']); ?>">
        <div class="error">
          <?php echo $data['confirm_password_err']; ?>
        </div>
      </div> 
      <input type="submit" value="Submit" name="submit" >
      <a href="<?php echo URLROOT ;?>/users/login">Already have an account?</a>
    </form>
  </div>

  <?php  require APPROOT . '/views/inc/footer.php'; ?>
