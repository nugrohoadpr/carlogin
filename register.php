<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from the form
    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];
    $email = strtolower($_POST['email']);

    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Username, email, and password cannot be empty';
    } else {
        $existingUser = $userCollection->findOne(['$or' => [['username' => $username], ['email' => $email]]]);

        if ($existingUser) {
            $error = 'Username already exists';
        }else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Insert new user into the database
            $userCollection->insertOne(['username' => $username, 'password' => $hashedPassword, 'email' => $email]);
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit;
        }
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
            <h2>Register</h2>
          </div>
          <?php
                if (isset($error)) {
                    echo "<p style='color: red;'>$error</p>";
                }
            ?>
          <div class="row">
            <form action="register.php" method="post" class="form-group">
              <div class="row">
                <input type="text" name="username" id="username" class="form__input" placeholder="Username">
              </div>
              <div class="row">
                <input type="text" name="email" id="email" class="form__input" placeholder="Email">
              </div>
              <div class="row">
                <input type="password" name="password" id="password" class="form__input" placeholder="Password">
              </div>
              <div class="row">
                <input type="submit" value="Submit" class="btn">
              </div>
            </form>
          </div>
          <div class="row">
            <p>have an account? <a href="login.php">Login Here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- End Example Code -->
</body>
</html>