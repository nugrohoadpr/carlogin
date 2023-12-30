<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from the form
    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];

    // Find user in the database
    $user = $userCollection->findOne(['username' => $username]);

    if ($user && password_verify($password, $user['password'])) {
        // User found, set session variable and redirect
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

include 'menu.php';
?>

    <div class="container">
    <div class="row main-content bg-success text-center">
      <div class="col-md-4 text-center company__info">
        
      </div>
      <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
        <div class="container-fluid">
          <div class="row">
            <h2>Log In</h2>
          </div>
          <?php
                if (isset($error)) {
                    echo "<p style='color: red;'>$error</p>";
                }
            ?>
          <div class="row">
            <form action="login.php" method="post" class="form-group">
              <div class="row">
                <input type="text" name="username" id="username" class="form__input" placeholder="Username">
              </div>
              <div class="row">
                <!-- <span class="fa fa-lock"></span> -->
                <input type="password" name="password" id="password" class="form__input" placeholder="Password">
              </div>
              <div class="row">
                <input type="submit" value="Submit" class="btn">
              </div>
            </form>
          </div>
          <div class="row">
            <p>Don't have an account? <a href="register.php">Register Here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- End Example Code -->
</body>
</html>
