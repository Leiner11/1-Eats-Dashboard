<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>1E1S | Login</title>
</head>
<body>
    <div class="login-box">
    <form method="POST" action="../php/register.php">
            <div class="login-header">
                <header>WELCOME, LET'S EAT</header>
            </div>
            <div class="input-box">
                <input type="email" class="input-field" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" id="stallname" name="stallname" placeholder="Business Name" required>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" id="password_confirmation" name="password_confirmation" placeholder="Re-Enter Password" required>
            </div>
            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<div class="notification">'. $_SESSION['error_message']. '</div>';
                unset($_SESSION['error_message']); // Clear the error message
            }
           ?>
            <?php
            if (isset($_SESSION['unmatched_message'])) {
                echo '<div class="notification">'. $_SESSION['unmatched_message']. '</div>';
                unset($_SESSION['unmatched_message']); // Clear the error message
            }
           ?>
            <div class="accept">
                <section>
                    <input type="checkbox" id="check" required>
                    <label for="check">I accept the <a href=#>Terms and Conditions</a></label>
                </section>
            <div class="input-submit">
                <button type="submit" button class="submit-btn" id="submit"></button>
                <label for="submit">Register</label>
            </div>
            <div class="sign-up-link">
                <p>Already have an account? <a href="../Login/loginPage.php">Login</a></p>
            </div>
        </div>
    </form>
</body>
</html>