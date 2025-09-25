<?php

session_start();

$errors = [
  'login' => $_SESSION['login_error'] ?? '',
  'register' => $_SESSION['register_error'] ?? ''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error)
{
  return !empty($error) ? "<p class = 'error-message'>$error</p>" : '';
}

function isActiveForm($formName,$activeForm)
{
  return $formName == $activeForm ? "active" : "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Please</title>
  <link rel="stylesheet" href="css/loginStyle.css">
  <link rel ="icon" type ="image/x-icon" href="img/logo.png">
</head>
<body>
<h1>Hello User...</h1>


  <form class="form-box <?= isActiveForm('login',$activeForm); ?>" id = "login-form" action="php/login_register.php" method="post">
  <h2>Please Login:</h2>
    <?= showError($errors['login']); ?>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" placeholder="user" required>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password"  placeholder="password..." required>

  <button type="submit" name = "login">Login</button>

  <p>Not a user? Register <a href = "#" onclick = "showForm('register-form')">Here</a></p>
</form>

<form class="form-box <?= isActiveForm('register',$activeForm); ?>" id = "register-form" action ="php/login_register.php" method="post">
  <h2>Please Register:</h2>
  <?= showError($errors['register']); ?>
  <label for="username" >Username:</label>
  <input type="text"  name="username" placeholder="user" required>
  <label for="password">Password:</label>
  <input type="password" name="password"  placeholder="password..." required>

  <button type="submit" name = "register">Register</button>

  <p>Have an account? <a href = "#" onclick = "showForm('login-form')">Login</a></p>
</form>



<img class = "logo" src = "img/logo.png" alt = "Logo">

</body>
</html>

<script>
  function showForm(formID)
  {
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    document.getElementById(formID).classList.add("active");
  }
</script>
