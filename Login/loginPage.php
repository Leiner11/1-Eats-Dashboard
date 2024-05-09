<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css" />
    <title>1E1S | Login</title>
  </head>
  <body>
    <div class="login-box">
      <div class="login-header">
        <header>Feeling Hungry?</header>
      </div>
      <form action="../php/login.php" method="post">
        <div class="input-box">
          <input
            type="email"
            class="input-field"
            placeholder="Email"
            name="email"
            required
          />
        </div>
        <div class="input-box">
          <input
            type="password"
            class="input-field"
            placeholder="Password"
            name="password"
            required
          />
        </div>
        <?php 
          if (isset($_SESSION['login_error']) && $_SESSION['login_error']):?>
              <div class="error-message">Invalid email or password.</div>
              <?php 
              // Unset the 'login_error' session variable after displaying the message
              unset($_SESSION['login_error']); 
            ?>
          <?php endif;?>
        <div class="forgot">
          <!--<section>
            <input type="checkbox" id="check" />
            <label for="check">Remember me</label>
          </section>!-->
          <section>
            <a href="#">Forgot password</a>
          </section>
        </div>
        <div class="input-submit">
          <button class="submit-btn" id="submit"></button>
          <label for="submit">LOGIN</label>
        </div>
        <div class="sign-up-link">
          <p>
            Don't have account? <a href="../Register/register.php">Register</a>
          </p>
        </div>
      </form>
    </div>
  </body>
</html>
